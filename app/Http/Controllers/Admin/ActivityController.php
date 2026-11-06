<?php
// app/Http/Controllers/Admin/ActivityController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Attraction;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ActivityController extends Controller
{
    private const IMAGE_FIELDS = [
        'main_image' => 'activities',
        'banner_top_image' => 'activities/banner',
        'banner_left_image' => 'activities/banner',
        'banner_right_image' => 'activities/banner',
        'og_image' => 'activities/seo',
        'twitter_card_image' => 'activities/seo',
    ];

    // Returned by validate() but they are list / child-table data, never Activity columns
    private const CHILD_KEYS = [
        'highlights',
        'know_before_you_go',
        'sidebar_points',
        'map_points',
        'policy_titles',
        'policy_points',
        'faq_questions',
        'faq_answers',
        'package_titles',
        'package_duration_labels',
        'package_descriptions',
        'package_includes',
        'package_old_prices',
        'package_new_prices',
        'package_save_texts',
        'package_recommended',
        'attraction_ids',
    ];

    private array $pendingDeletes = [];   // old files, removed only after a successful commit
    private array $uploaded = [];         // new files, removed if the save fails

    private function storeFile($file, string $dir): string
    {
        $path = $file->store($dir, 'public');
        $this->uploaded[] = $path;
        return $path;
    }

    private function queueDelete(?string $path): void
    {
        if ($path) {
            $this->pendingDeletes[] = $path;
        }
    }

    private function flushDeletes(): void
    {
        foreach (array_unique($this->pendingDeletes) as $path) {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        $this->pendingDeletes = [];
        $this->uploaded = [];
    }

    private function rollbackFiles(): void
    {
        foreach ($this->uploaded as $path) {
            Storage::disk('public')->delete($path);
        }
        $this->pendingDeletes = [];
        $this->uploaded = [];
    }

    private function failure(Request $request, \Throwable $e, string $verb)
    {
        report($e);
        $msg = config('app.debug')
            ? $e->getMessage()
            : "Could not {$verb} the activity. Nothing was saved. Please try again.";

        return $request->expectsJson()
            ? response()->json(['message' => $msg], 500)
            : back()->withInput()->with('error', $msg);
    }

    private function success(Request $request, string $message)
    {
        if ($request->expectsJson()) {
            session()->flash('success', $message);
            return response()->json(['redirect' => route('admin.activities.index')]);
        }

        return redirect()->route('admin.activities.index')->with('success', $message);
    }

    private function applySeoDefaults(array $v, string $slug): array
    {
        $name = $v['name'];
        $location = trim((string) ($v['location_label'] ?? ''));
        $body = trim(preg_replace('/\s+/', ' ', strip_tags(
            ($v['banner_description'] ?? null) ?: ($v['about_content'] ?? null) ?: ($v['more_about_content'] ?? '')
        )));

        $v['h1'] = ($v['h1'] ?? null) ?: $name;
        $v['meta_title'] = ($v['meta_title'] ?? null)
            ?: Str::limit($location ? "{$name} | {$location}" : $name, 60, '');
        $v['meta_description'] = ($v['meta_description'] ?? null)
            ?: Str::limit($body ?: "Book {$name}" . ($location ? " in {$location}" : '') . ' online with instant confirmation.', 160, '');
        $v['og_title'] = ($v['og_title'] ?? null) ?: $v['meta_title'];
        $v['og_description'] = ($v['og_description'] ?? null) ?: $v['meta_description'];
        $v['canonical_url'] = ($v['canonical_url'] ?? null) ?: url('/activities/' . $slug);
        $v['robots'] = ($v['robots'] ?? null) ?: 'index, follow';

        return $v;
    }

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
        $validated = $this->validatedData($request);

        try {
            DB::transaction(function () use ($request, $validated) {
                $validated['slug'] = $this->uniqueSlug($validated['name']);
                $validated = $this->handleUploads($request, $validated);
                $validated = $this->prepareData($request, $validated);

                $activity = Activity::create($validated);

                $this->syncAll($request, $activity);
            });
        } catch (\Throwable $e) {
            $this->rollbackFiles();
            return $this->failure($request, $e, 'save');
        }

        $this->flushDeletes();

        return $this->success($request, 'Activity created successfully.');
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
        $validated = $this->validatedData($request, $activity->id);

        try {
            DB::transaction(function () use ($request, $activity, $validated) {
                if ($validated['name'] !== $activity->name) {
                    $validated['slug'] = $this->uniqueSlug($validated['name'], $activity->id);
                }

                $validated = $this->handleUploads($request, $validated, $activity);
                $validated = $this->prepareData($request, $validated, $activity);

                $activity->update($validated);

                $this->syncAll($request, $activity);
            });
        } catch (\Throwable $e) {
            $this->rollbackFiles();
            return $this->failure($request, $e, 'update');
        }

        $this->flushDeletes();

        return $this->success($request, 'Activity updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        foreach (array_keys(self::IMAGE_FIELDS) as $field) {
            $this->queueDelete($activity->{$field});
        }

        $activity->delete();
        $this->flushDeletes();

        return redirect()
            ->route('admin.activities.index')
            ->with('success', 'Activity deleted successfully.');
    }

    private function validatedData(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate($this->rules(), [], $this->attributes());

        return Arr::except($validated, self::CHILD_KEYS);
    }

    /**
     * Fields derived from the request (lists, duration text, flags).
     * Runs after validation, inside the transaction.
     */
    private function prepareData(Request $request, array $validated, ?Activity $activity = null): array
    {
        $validated['about_title'] = $validated['about_title'] ?? null ?: $validated['name'];
        $validated['highlights'] = $this->parseList($request->input('highlights', []));
        $validated['know_before_you_go'] = $this->parseList($request->input('know_before_you_go', []));
        $validated['sidebar_points'] = $this->parseList($request->input('sidebar_points', []));
        $validated['map_points'] = $this->parseList($request->input('map_points', []));
        $validated['status'] = $request->input('status', $activity?->status ?? 'draft');
        $validated['featured'] = $request->boolean('featured');
        $validated['duration_text'] = Activity::formatDuration(
            $validated['duration_from'],
            $validated['duration_to'] ?? null,
            $validated['duration_unit']
        );
        $validated['duration_hours'] = Activity::durationInHours(
            $validated['duration_from'],
            $validated['duration_to'] ?? null,
            $validated['duration_unit']
        );
        $validated['free_cancellation_text'] = !empty($validated['free_cancellation_hours']) ? 'Free Cancellation' : null;
        $validated = $this->applySeoDefaults($validated, $validated['slug'] ?? $activity?->slug);
        
        return $validated;
    }

    private function syncAll(Request $request, Activity $activity): void
    {
        $this->syncPackages($request, $activity);
        $this->syncPolicies($request, $activity);
        $this->syncFaqs($request, $activity);
        $this->syncAttractions($request, $activity);
    }

    /**
     * Store uploaded images. Old files are queued for deletion and only
     * removed after the transaction commits; new files are removed if it fails.
     */
    private function handleUploads(Request $request, array $validated, ?Activity $activity = null): array
    {
        foreach (self::IMAGE_FIELDS as $field => $folder) {
            if ($request->hasFile($field)) {
                if ($activity) {
                    $this->queueDelete($activity->{$field});
                }
                $validated[$field] = $this->storeFile($request->file($field), $folder);
            }
        }

        return $validated;
    }

    /** Packages repeater — full replace strategy. */
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

            $activity->packages()->create([
                'title' => $title,
                'duration_label' => $request->input("package_duration_labels.$index"),
                'description' => $request->input("package_descriptions.$index"),
                'includes' => $this->parseList($request->input("package_includes.$index", [])),
                'old_price' => $request->input("package_old_prices.$index") ?: null,
                'new_price' => $request->input("package_new_prices.$index") ?: null,
                'save_text' => $request->input("package_save_texts.$index"),
                'is_recommended' => $request->boolean("package_recommended.$index"),
                'sort_order' => $order,
            ]);
        }
    }

    /** Policies repeater — full replace; block = title + points. */
    private function syncPolicies(Request $request, Activity $activity): void
    {
        if (!$request->has('policy_titles')) {
            return;
        }

        $activity->policies()->delete();

        $order = 0;

        foreach ($request->input('policy_titles') as $index => $title) {
            $title = trim((string) $title);

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

    /** FAQs repeater — full replace; parallel question/answer arrays. */
    private function syncFaqs(Request $request, Activity $activity): void
    {
        if (!$request->has('faq_questions')) {
            return;
        }

        $activity->faqs()->delete();

        $order = 0;
        $answers = $request->input('faq_answers', []);

        foreach ($request->input('faq_questions', []) as $index => $question) {
            $question = trim((string) $question);
            $answer = trim((string) ($answers[$index] ?? ''));

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

    /** Linked Attractions via pivot; row order = sort_order. */
    private function syncAttractions(Request $request, Activity $activity): void
    {
        if (!$request->has('attraction_ids')) {
            return;
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

    private function attributes(): array
    {
        return [
            'activity_category_id' => 'category',
            'name' => 'activity name',
            'duration_from' => 'duration',
            'duration_to' => 'duration (to)',
            'duration_unit' => 'duration unit',
            'free_cancellation_hours' => 'free cancellation',
            'package_titles.*' => 'package title',
            'package_includes.*.*' => 'package include',
            'package_old_prices.*' => 'package old price',
            'package_new_prices.*' => 'package new price',
            'policy_titles.*' => 'policy title',
            'policy_points.*.*' => 'policy point',
            'faq_questions.*' => 'FAQ question',
            'faq_answers.*' => 'FAQ answer',
            'attraction_ids.*' => 'attraction',
        ];
    }

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'activity_category_id' => 'nullable|exists:activity_categories,id',
            'country_id' => 'nullable|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'location_label' => 'nullable|string|max:255',

            'banner_tag' => 'nullable|string|max:100',
            'banner_description' => 'nullable|string|max:500',

            'main_image' => 'nullable|image|max:3072',
            'video_url' => 'nullable|string|max:255',

            'banner_top_image' => 'nullable|image|max:3072',
            'banner_top_label' => 'nullable|string|max:100',
            'banner_top_title' => 'nullable|string|max:150',

            'banner_left_image' => 'nullable|image|max:3072',
            'banner_left_label' => 'nullable|string|max:100',
            'banner_left_title' => 'nullable|string|max:150',

            'banner_right_image' => 'nullable|image|max:3072',
            'banner_right_label' => 'nullable|string|max:100',
            'banner_right_title' => 'nullable|string|max:150',

            'duration_text' => 'nullable|string|max:50',
            'free_cancellation_text' => 'nullable|string|max:100',
            'duration_from' => 'required|numeric|min:0.25|max:999',
            'duration_to' => 'nullable|numeric|gt:duration_from|max:999',
            'duration_unit' => ['required', Rule::in(array_keys(config('search.duration_units')))],
            'free_cancellation_hours' => ['nullable', Rule::in(config('search.cancellation_hours'))],

            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',

            'starting_price' => 'nullable|numeric|min:0',
            'price_unit' => 'nullable|string|max:50',
            'status' => 'nullable|in:draft,published,unpublished',
            'featured' => 'nullable|boolean',

            'about_title' => 'nullable|string|max:255',
            'about_content' => 'nullable|string',
            'more_about_title' => 'nullable|string|max:255',
            'more_about_content' => 'nullable|string',
            'highlights' => 'nullable|array',
            'highlights.*' => 'nullable|string|max:255',
            'what_to_expect_content' => 'nullable|string',
            'know_before_you_go' => 'nullable|array',
            'know_before_you_go.*' => 'nullable|string|max:255',
            'sidebar_points' => 'nullable|array',
            'sidebar_points.*' => 'nullable|string|max:255',

            'map_embed_url' => 'nullable|string',
            'map_address' => 'nullable|string',
            'map_points' => 'nullable|array',
            'map_points.*' => 'nullable|string|max:255',
            'map_directions_url' => 'nullable|string|max:500',

            'policy_titles' => 'nullable|array',
            'policy_titles.*' => 'nullable|string|max:150',
            'policy_points' => 'nullable|array',
            'policy_points.*.*' => 'nullable|string|max:255',

            'faq_questions' => 'nullable|array',
            'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers' => 'nullable|array',
            'faq_answers.*' => 'nullable|string',

            'package_titles' => 'nullable|array',
            'package_titles.*' => 'nullable|string|max:255',
            'package_duration_labels' => 'nullable|array',
            'package_duration_labels.*' => 'nullable|string|max:100',
            'package_descriptions' => 'nullable|array',
            'package_descriptions.*' => 'nullable|string|max:500',
            'package_includes' => 'nullable|array',
            'package_includes.*.*' => 'nullable|string|max:150',
            'package_old_prices' => 'nullable|array',
            'package_old_prices.*' => 'nullable|numeric|min:0',
            'package_new_prices' => 'nullable|array',
            'package_new_prices.*' => 'nullable|numeric|min:0',
            'package_save_texts' => 'nullable|array',
            'package_save_texts.*' => 'nullable|string|max:50',
            'package_recommended' => 'nullable|array',

            'attraction_ids' => 'nullable|array',
            'attraction_ids.*' => 'nullable|exists:attractions,id',

            'h1' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'canonical_url' => 'nullable|string|max:500',
            'robots' => 'nullable|string|max:50',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|image|max:2048',
            'twitter_card_image' => 'nullable|image|max:2048',
        ];
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

    private function parseList($raw): array
    {
        return collect(is_array($raw) ? $raw : [])
            ->map(fn($item) => trim((string) $item))
            ->filter()
            ->values()
            ->all();
    }
}