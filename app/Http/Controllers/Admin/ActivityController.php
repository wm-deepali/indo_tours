<?php
// app/Http/Controllers/Admin/ActivityController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Attraction;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with(['country', 'state', 'city', 'category'])
            ->orderBy('sort_order')
            ->latest()
            ->paginate(15);

        return view('admin.activity.index', compact('activities'));
    }

    public function create()
    {
        $countries = Country::where('status', 'active')->orderBy('sort_order')->get();
        $categories = ActivityCategory::where('status', 'active')->orderBy('sort_order')->get();
        $attractions = Attraction::where('status', 'published')->orderBy('name')->get();

        return view('admin.activity.create', compact('countries', 'categories', 'attractions'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $validated['slug'] = $this->uniqueSlug($validated['name']);

        $validated = $this->handleUploads($request, $validated);

        $validated['about_title'] = $validated['about_title'] ?: $validated['name'];
        $validated['highlights'] = $this->parseList($request->input('highlights', []));
        $validated['know_before_you_go'] = $this->parseList($request->input('know_before_you_go', []));
        $validated['sidebar_points'] = $this->parseList($request->input('sidebar_points', []));
        $validated['map_points'] = $this->parseList($request->input('map_points', []));
        $validated['status'] = $request->input('status', 'draft');
        $validated['featured'] = $request->boolean('featured');

        $activity = Activity::create($validated);

        $this->syncPackages($request, $activity);
        $this->syncPolicies($request, $activity);
        $this->syncFaqs($request, $activity);
        $this->syncAttractions($request, $activity);

        return redirect()
            ->route('admin.activities.index')
            ->with('success', 'Activity created successfully.');
    }

    public function edit(Activity $activity)
    {
        $countries = Country::where('status', 'active')->orderBy('sort_order')->get();
        $categories = ActivityCategory::where('status', 'active')->orderBy('sort_order')->get();
        $states = State::where('country_id', $activity->country_id)->orderBy('sort_order')->get();
        $cities = City::where('state_id', $activity->state_id)->orderBy('sort_order')->get();
        $packages = $activity->packages;
        $policies = $activity->policies;
        $faqs = $activity->faqs;
        $attractions = Attraction::where('status', 'published')->orderBy('name')->get();

        return view('admin.activity.edit', compact(
            'activity',
            'countries',
            'categories',
            'states',
            'cities',
            'packages',
            'policies',
            'faqs',
            'attractions'
        ));
    }

    public function update(Request $request, Activity $activity)
    {
        $validated = $this->validateData($request, $activity->id);

        if ($validated['name'] !== $activity->name) {
            $validated['slug'] = $this->uniqueSlug($validated['name'], $activity->id);
        }

        $validated = $this->handleUploads($request, $validated, $activity);

        $validated['about_title'] = $validated['about_title'] ?: $validated['name'];
        $validated['highlights'] = $this->parseList($request->input('highlights', []));
        $validated['know_before_you_go'] = $this->parseList($request->input('know_before_you_go', []));
        $validated['sidebar_points'] = $this->parseList($request->input('sidebar_points', []));
        $validated['map_points'] = $this->parseList($request->input('map_points', []));
        $validated['status'] = $request->input('status', $activity->status);
        $validated['featured'] = $request->boolean('featured');

        $activity->update($validated);

        $this->syncPackages($request, $activity);
        $this->syncPolicies($request, $activity);
        $this->syncFaqs($request, $activity);
        $this->syncAttractions($request, $activity);

        return redirect()
            ->route('admin.activities.index')
            ->with('success', 'Activity updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        foreach ([
            $activity->main_image,
            $activity->banner_top_image,
            $activity->banner_left_image,
            $activity->banner_right_image,
        ] as $image) {
            if ($image) {
                Storage::disk('public')->delete($image);
            }
        }

        $activity->delete();

        return redirect()
            ->route('admin.activities.index')
            ->with('success', 'Activity deleted successfully.');
    }

    /**
     * Handle the 4 banner image uploads, deleting old files on update.
     */
    private function handleUploads(Request $request, array $validated, ?Activity $activity = null): array
    {
        $map = [
            'main_image' => 'activities',
            'banner_top_image' => 'activities/banner',
            'banner_left_image' => 'activities/banner',
            'banner_right_image' => 'activities/banner',
        ];

        foreach ($map as $field => $folder) {
            if ($request->hasFile($field)) {
                if ($activity && $activity->{$field}) {
                    Storage::disk('public')->delete($activity->{$field});
                }
                $validated[$field] = $request->file($field)->store($folder, 'public');
            }
        }

        return $validated;
    }

    /**
     * Handle the Packages repeater — full replace strategy, same pattern
     * as budget tiers on the Attraction module.
     */
    private function syncPackages(Request $request, Activity $activity): void
    {
        if (!$request->has('package_titles')) {
            return; // no package fields submitted — leave existing data untouched
        }

        $activity->packages()->delete();

        $order = 0;

        foreach ($request->input('package_titles') as $index => $title) {
            if (!$title) {
                continue;
            }

            $order++;

            $includes = $this->parseList($request->input("package_includes.$index", []));

            $activity->packages()->create([
                'title' => $title,
                'duration_label' => $request->input("package_duration_labels.$index"),
                'description' => $request->input("package_descriptions.$index"),
                'includes' => $includes,
                'old_price' => $request->input("package_old_prices.$index") ?: null,
                'new_price' => $request->input("package_new_prices.$index") ?: null,
                'save_text' => $request->input("package_save_texts.$index"),
                'is_recommended' => $request->boolean("package_recommended.$index"),
                'sort_order' => $order,
            ]);
        }
    }

    /**
     * Handle the Policies repeater — full replace strategy. Each row is a
     * block (title + JSON points column), same shape as ActivityPackage.
     */
    private function syncPolicies(Request $request, Activity $activity): void
    {
        if (!$request->has('policy_titles')) {
            return;
        }

        $activity->policies()->delete();

        $order = 0;

        foreach ($request->input('policy_titles') as $index => $title) {
            $title = trim($title);

            if ($title === '') {
                continue;
            }

            $points = $this->parseList($request->input("policy_points.$index", []));

            if (empty($points)) {
                continue;
            }

            $order++;

            $activity->policies()->create([
                'title' => $title,
                'points' => $points,
                'sort_order' => $order,
            ]);
        }
    }

    /**
     * Handle the FAQs repeater — full replace strategy. Parallel
     * faq_questions[] / faq_answers[] arrays, one row per pair.
     */
    private function syncFaqs(Request $request, Activity $activity): void
    {
        if (!$request->has('faq_questions')) {
            return;
        }

        $activity->faqs()->delete();

        $order = 0;
        $questions = $request->input('faq_questions', []);
        $answers = $request->input('faq_answers', []);

        foreach ($questions as $index => $question) {
            $question = trim($question);
            $answer = trim($answers[$index] ?? '');

            if ($question === '' || $answer === '') {
                continue;
            }

            $order++;

            $activity->faqs()->create([
                'question' => $question,
                'answer' => $answer,
                'sort_order' => $order,
            ]);
        }
    }

    /**
     * Sync selected Attractions (existing Attraction module records) shown
     * in this activity's "Top Attractions" section, via the activity_attraction
     * pivot. Row order in the form determines sort_order.
     */
    private function syncAttractions(Request $request, Activity $activity): void
    {
        if (!$request->has('attraction_ids')) {
            return; // field not submitted — leave existing selections untouched
        }

        $sync = [];
        $order = 0;

        foreach ($request->input('attraction_ids') as $attractionId) {
            if (!$attractionId) {
                continue;
            }

            $order++;
            $sync[$attractionId] = ['sort_order' => $order];
        }

        $activity->attractions()->sync($sync);
    }

    // Cascading dropdowns reuse the same generic logic as the Attraction
    // module — point the JS at admin/attractions/states/{country} and
    // admin/attractions/cities/{state}, no need to duplicate these routes.

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'activity_category_id' => 'nullable|exists:activity_categories,id',
            'country_id' => 'nullable|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'location_label' => 'nullable|string|max:255',

            'banner_tag' => 'nullable|string|max:100',
            'banner_description' => 'nullable|string|max:500',

            'main_image' => 'nullable|image',
            'video_url' => 'nullable|string|max:255',

            'banner_top_image' => 'nullable|image',
            'banner_top_label' => 'nullable|string|max:100',
            'banner_top_title' => 'nullable|string|max:150',

            'banner_left_image' => 'nullable|image',
            'banner_left_label' => 'nullable|string|max:100',
            'banner_left_title' => 'nullable|string|max:150',

            'banner_right_image' => 'nullable|image',
            'banner_right_label' => 'nullable|string|max:100',
            'banner_right_title' => 'nullable|string|max:150',

            'duration_text' => 'nullable|string|max:50',
            'free_cancellation_text' => 'nullable|string|max:100',

            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',

            'starting_price' => 'nullable|numeric|min:0',
            'price_unit' => 'nullable|string|max:50',
            'featured' => 'nullable|boolean',

            'about_title' => 'nullable|string|max:255',
            'about_content' => 'nullable|string',
            'highlights.*' => 'nullable|string|max:255',
            'what_to_expect_content' => 'nullable|string',
            'know_before_you_go.*' => 'nullable|string|max:255',
            'sidebar_points.*' => 'nullable|string|max:255',

            'map_embed_url' => 'nullable|string',
            'map_address' => 'nullable|string',
            'map_points.*' => 'nullable|string|max:255',
            'map_directions_url' => 'nullable|string|max:500',

            'policy_titles.*' => 'nullable|string|max:150',
            'policy_points.*.*' => 'nullable|string|max:255',

            'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers.*' => 'nullable|string',

            'package_titles.*' => 'nullable|string|max:255',
            'package_duration_labels.*' => 'nullable|string|max:100',
            'package_descriptions.*' => 'nullable|string|max:500',
            'package_includes.*.*' => 'nullable|string|max:150',
            'package_old_prices.*' => 'nullable|numeric|min:0',
            'package_new_prices.*' => 'nullable|numeric|min:0',
            'package_save_texts.*' => 'nullable|string|max:50',

            'attraction_ids.*' => 'nullable|exists:attractions,id',
        ]);
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        while (
            Activity::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }

    private function parseList(array $raw): array
    {
        return collect($raw)
            ->map(fn($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }

}