<?php
// app/Http/Controllers/Admin/TourPackageController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\State;
use App\Models\City;
use App\Models\SubCategory;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourPackageController extends Controller
{
    private array $relations = [
        'features', 'durationOptions', 'routeStops', 'highlights',
        'itineraryDays', 'hotelStays.hotel', 'includes', 'excludes', 'policies', 'faqs',
    ];

    public function index()
    {
        $tourPackages = TourPackage::with('subCategory')->latest()->paginate(20);
        return view('admin.tourpackage.index', compact('tourPackages'));
    }

    public function create()
    {
        $subCategories = SubCategory::orderBy('name')->get(['id', 'name']);
        $hotels = Hotel::orderBy('name')->get(['id', 'name']);
        $countries = Country::orderBy('name')->get(['id', 'name']);

        return view('admin.tourpackage.create', compact('subCategories', 'hotels', 'countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $validated['slug'] = Str::slug($request->name);
        $validated['status'] = $request->status ?? 'draft';

        foreach (['main_image', 'top_image', 'bottom_left_image', 'bottom_right_image', 'og_image'] as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('tourpackages/' . $field, 'public');
            }
        }

        $tourPackage = TourPackage::create($validated);
        $this->saveAllChildren($tourPackage, $request);

        return redirect()->route('admin.tourpackages.index')->with('success', 'Tour Package added successfully.');
    }

    public function edit(TourPackage $tourpackage)
    {
        $tourpackage->load($this->relations);

        $subCategories = SubCategory::orderBy('name')->get(['id', 'name']);
        $hotels = Hotel::orderBy('name')->get(['id', 'name']);
        $countries = Country::orderBy('name')->get(['id', 'name']);

        $states = $tourpackage->country_id
            ? State::where('country_id', $tourpackage->country_id)->orderBy('name')->get(['id', 'name'])
            : collect();

        $cities = $tourpackage->state_id
            ? City::where('state_id', $tourpackage->state_id)->orderBy('name')->get(['id', 'name'])
            : collect();

        return view('admin.tourpackage.edit', [
            'tourPackage' => $tourpackage,
            'subCategories' => $subCategories,
            'hotels' => $hotels,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
        ]);
    }

    public function update(Request $request, TourPackage $tourpackage)
    {
        $validated = $request->validate($this->rules());

        $validated['status'] = $request->status ?? $tourpackage->status;

        foreach (['main_image', 'top_image', 'bottom_left_image', 'bottom_right_image', 'og_image'] as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('tourpackages/' . $field, 'public');
            }
        }

        $tourpackage->update($validated);
        $this->saveAllChildren($tourpackage, $request);

        return redirect()->route('admin.tourpackages.index')->with('success', 'Tour Package updated successfully.');
    }

    public function destroy(TourPackage $tourpackage)
    {
        $tourpackage->delete();
        return redirect()->route('admin.tourpackages.index')->with('success', 'Tour Package deleted successfully.');
    }

    private function saveAllChildren(TourPackage $tp, Request $request): void
    {
        $this->saveFeatures($tp, $request);
        $this->saveDurationOptions($tp, $request);
        $this->saveRouteStops($tp, $request);
        $this->saveHighlights($tp, $request);
        $this->saveItineraryDays($tp, $request);
        $this->saveHotelStays($tp, $request);
        $this->saveSimpleTextList($tp, $request, 'includes', 'include_texts', 'include_ids', 'deleted_includes');
        $this->saveSimpleTextList($tp, $request, 'excludes', 'exclude_texts', 'exclude_ids', 'deleted_excludes');
        $this->savePolicies($tp, $request);
        $this->saveFaqs($tp, $request);
    }

    private function rules(): array
    {
        return [
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required|string|max:255',
            'status' => 'nullable|in:draft,published,unpublished',

            'country_id' => 'nullable|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',

            'banner_tag_text' => 'nullable|string|max:255',
            'banner_intro' => 'nullable|string',
            'main_image' => 'nullable|image|max:3072',
            'top_image' => 'nullable|image|max:3072',
            'bottom_left_image' => 'nullable|image|max:3072',
            'bottom_right_image' => 'nullable|image|max:3072',
            'video_url' => 'nullable|string|max:255',

            'duration_text' => 'nullable|string|max:100',
            'old_price' => 'nullable|numeric|min:0',
            'price' => 'nullable|numeric|min:0',
            'price_unit_text' => 'nullable|string|max:100',

            'overview_title' => 'nullable|string|max:255',
            'overview_content' => 'nullable|string',
            'map_embed_url' => 'nullable|string',

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',
            'canonical_url' => 'nullable|string|max:255',

            // Features
            'feature_ids' => 'nullable|array', 'feature_ids.*' => 'nullable|integer',
            'feature_texts' => 'nullable|array', 'feature_texts.*' => 'nullable|string|max:100',
            'feature_images' => 'nullable|array', 'feature_images.*' => 'nullable|image|max:1024',
            'deleted_features' => 'nullable|string',

            // Duration options
            'duropt_ids' => 'nullable|array', 'duropt_ids.*' => 'nullable|integer',
            'duropt_labels' => 'nullable|array', 'duropt_labels.*' => 'nullable|string|max:50',
            'duropt_prices' => 'nullable|array', 'duropt_prices.*' => 'nullable|numeric',
            'duropt_images' => 'nullable|array', 'duropt_images.*' => 'nullable|image|max:1024',
            'deleted_duration_options' => 'nullable|string',

            // Route stops
            'stop_ids' => 'nullable|array', 'stop_ids.*' => 'nullable|integer',
            'stop_names' => 'nullable|array', 'stop_names.*' => 'nullable|string|max:100',
            'deleted_stops' => 'nullable|string',

            // Highlights (check-list)
            'highlight_ids' => 'nullable|array', 'highlight_ids.*' => 'nullable|integer',
            'highlight_texts' => 'nullable|array', 'highlight_texts.*' => 'nullable|string|max:255',
            'deleted_highlights' => 'nullable|string',

            // Itinerary
            'itin_ids' => 'nullable|array', 'itin_ids.*' => 'nullable|integer',
            'itin_day_numbers' => 'nullable|array', 'itin_day_numbers.*' => 'nullable|integer',
            'itin_titles' => 'nullable|array', 'itin_titles.*' => 'nullable|string|max:255',
            'itin_contents' => 'nullable|array', 'itin_contents.*' => 'nullable|string',
            'deleted_itinerary' => 'nullable|string',

            // Hotel stays — now linked to real Hotel records
            'hotel_stay_ids' => 'nullable|array', 'hotel_stay_ids.*' => 'nullable|integer',
            'hotel_ids' => 'nullable|array', 'hotel_ids.*' => 'nullable|exists:hotels,id',
            'hotel_day_labels' => 'nullable|array', 'hotel_day_labels.*' => 'nullable|string|max:50',
            'hotel_titles' => 'nullable|array', 'hotel_titles.*' => 'nullable|string|max:255',
            'hotel_check_ins' => 'nullable|array', 'hotel_check_ins.*' => 'nullable|string|max:50',
            'hotel_check_outs' => 'nullable|array', 'hotel_check_outs.*' => 'nullable|string|max:50',
            'hotel_breakfast' => 'nullable|array', 'hotel_breakfast.*' => 'nullable|in:0,1',
            'hotel_lunch' => 'nullable|array', 'hotel_lunch.*' => 'nullable|in:0,1',
            'hotel_dinner' => 'nullable|array', 'hotel_dinner.*' => 'nullable|in:0,1',
            'deleted_hotels' => 'nullable|string',

            // Includes / Excludes
            'include_ids' => 'nullable|array', 'include_ids.*' => 'nullable|integer',
            'include_texts' => 'nullable|array', 'include_texts.*' => 'nullable|string|max:255',
            'deleted_includes' => 'nullable|string',
            'exclude_ids' => 'nullable|array', 'exclude_ids.*' => 'nullable|integer',
            'exclude_texts' => 'nullable|array', 'exclude_texts.*' => 'nullable|string|max:255',
            'deleted_excludes' => 'nullable|string',

            // Policies
            'policy_ids' => 'nullable|array', 'policy_ids.*' => 'nullable|integer',
            'policy_titles' => 'nullable|array', 'policy_titles.*' => 'nullable|string|max:255',
            'policy_contents' => 'nullable|array', 'policy_contents.*' => 'nullable|string',
            'deleted_policies' => 'nullable|string',

            // FAQs
            'faq_ids' => 'nullable|array', 'faq_ids.*' => 'nullable|integer',
            'faq_questions' => 'nullable|array', 'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers' => 'nullable|array', 'faq_answers.*' => 'nullable|string',
            'deleted_faqs' => 'nullable|string',
        ];
    }

    private function deleteMarked($relation, ?string $csv): void
    {
        if (!$csv) return;
        $ids = array_filter(explode(',', $csv));
        if (!empty($ids)) $relation->whereIn('id', $ids)->delete();
    }

    private function saveFeatures(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->features(), $request->deleted_features);
        if (!$request->filled('feature_texts')) return;

        foreach ($request->feature_texts as $i => $text) {
            if (!$text) continue;
            $data = ['text' => $text, 'sort_order' => $i];
            if ($request->hasFile("feature_images.$i")) {
                $data['icon_image'] = $request->file("feature_images.$i")->store('tourpackages/features', 'public');
            }
            $id = $request->feature_ids[$i] ?? null;
            $id ? $tp->features()->where('id', $id)->update($data) : $tp->features()->create($data);
        }
    }

    private function saveDurationOptions(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->durationOptions(), $request->deleted_duration_options);
        if (!$request->filled('duropt_labels')) return;

        foreach ($request->duropt_labels as $i => $label) {
            if (!$label) continue;
            $data = [
                'days_label' => $label,
                'price' => $request->duropt_prices[$i] ?? null,
                'sort_order' => $i,
            ];
            if ($request->hasFile("duropt_images.$i")) {
                $data['image'] = $request->file("duropt_images.$i")->store('tourpackages/duration-options', 'public');
            }
            $id = $request->duropt_ids[$i] ?? null;
            $id ? $tp->durationOptions()->where('id', $id)->update($data) : $tp->durationOptions()->create($data);
        }
    }

    private function saveRouteStops(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->routeStops(), $request->deleted_stops);
        if (!$request->filled('stop_names')) return;

        foreach ($request->stop_names as $i => $name) {
            if (!$name) continue;
            $data = ['name' => $name, 'sort_order' => $i];
            $id = $request->stop_ids[$i] ?? null;
            $id ? $tp->routeStops()->where('id', $id)->update($data) : $tp->routeStops()->create($data);
        }
    }

    private function saveHighlights(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->highlights(), $request->deleted_highlights);
        if (!$request->filled('highlight_texts')) return;

        foreach ($request->highlight_texts as $i => $text) {
            if (!$text) continue;
            $data = ['text' => $text, 'sort_order' => $i];
            $id = $request->highlight_ids[$i] ?? null;
            $id ? $tp->highlights()->where('id', $id)->update($data) : $tp->highlights()->create($data);
        }
    }

    private function saveItineraryDays(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->itineraryDays(), $request->deleted_itinerary);
        if (!$request->filled('itin_titles')) return;

        foreach ($request->itin_titles as $i => $title) {
            $content = $request->itin_contents[$i] ?? '';
            if (!$title && !$content) continue;
            $data = [
                'day_number' => $request->itin_day_numbers[$i] ?? ($i + 1),
                'title' => $title,
                'content' => $content,
                'sort_order' => $i,
            ];
            $id = $request->itin_ids[$i] ?? null;
            $id ? $tp->itineraryDays()->where('id', $id)->update($data) : $tp->itineraryDays()->create($data);
        }
    }

    private function saveHotelStays(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->hotelStays(), $request->deleted_hotels);
        if (!$request->filled('hotel_ids')) return;

        foreach ($request->hotel_ids as $i => $hotelId) {
            if (!$hotelId) continue;
            $data = [
                'hotel_id' => $hotelId,
                'day_label' => $request->hotel_day_labels[$i] ?? null,
                'title' => $request->hotel_titles[$i] ?? null,
                'check_in' => $request->hotel_check_ins[$i] ?? null,
                'check_out' => $request->hotel_check_outs[$i] ?? null,
                'breakfast_included' => (bool) ($request->hotel_breakfast[$i] ?? false),
                'lunch_included' => (bool) ($request->hotel_lunch[$i] ?? false),
                'dinner_included' => (bool) ($request->hotel_dinner[$i] ?? false),
                'sort_order' => $i,
            ];
            $stayId = $request->hotel_stay_ids[$i] ?? null;
            $stayId ? $tp->hotelStays()->where('id', $stayId)->update($data) : $tp->hotelStays()->create($data);
        }
    }

    // Shared by includes/excludes since both are simple {id, text, sort_order} lists
    private function saveSimpleTextList(TourPackage $tp, Request $request, string $relation, string $textKey, string $idKey, string $deletedKey): void
    {
        $this->deleteMarked($tp->{$relation}(), $request->{$deletedKey});
        if (!$request->filled($textKey)) return;

        foreach ($request->{$textKey} as $i => $text) {
            if (!$text) continue;
            $data = ['text' => $text, 'sort_order' => $i];
            $id = $request->{$idKey}[$i] ?? null;
            $id ? $tp->{$relation}()->where('id', $id)->update($data) : $tp->{$relation}()->create($data);
        }
    }

    private function savePolicies(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->policies(), $request->deleted_policies);
        if (!$request->filled('policy_titles')) return;

        foreach ($request->policy_titles as $i => $title) {
            $content = $request->policy_contents[$i] ?? '';
            if (!$title && !$content) continue;
            $data = ['title' => $title, 'content' => $content, 'sort_order' => $i];
            $id = $request->policy_ids[$i] ?? null;
            $id ? $tp->policies()->where('id', $id)->update($data) : $tp->policies()->create($data);
        }
    }

    private function saveFaqs(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->faqs(), $request->deleted_faqs);
        if (!$request->filled('faq_questions')) return;

        foreach ($request->faq_questions as $i => $question) {
            $answer = $request->faq_answers[$i] ?? '';
            if (!$question && !$answer) continue;
            $data = ['question' => $question, 'answer' => $answer, 'sort_order' => $i];
            $id = $request->faq_ids[$i] ?? null;
            $id ? $tp->faqs()->where('id', $id)->update($data) : $tp->faqs()->create($data);
        }
    }
}