<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\Amenity;
use App\Models\Activity;
use App\Models\Attraction;
use App\Models\Destination;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourPackageController extends Controller
{
    private array $relations = [
        'amenities',
        'durationOptions',
        'routeStops',
        'highlights',
        'itineraryDays',
        'hotelStays.hotel',
        'includes',
        'excludes',
        'policies',
        'faqs',
        'destinations',
        'attractions',
        'activities',
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
        $destinations = Destination::orderBy('name')->get(['id', 'name']);
        $attractions = Attraction::orderBy('name')->get(['id', 'name']);
        $activities = Activity::orderBy('name')->get(['id', 'name']);
        $amenities = Amenity::active()->orderBy('sort_order')->orderBy('name')->get(['id', 'name', 'icon']);

        return view('admin.tourpackage.create', compact(
            'subCategories',
            'hotels',
            'countries',
            'destinations',
            'attractions',
            'activities',
            'amenities'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $validated['slug'] = Str::slug($request->name);
        $validated['status'] = $request->status ?? 'draft';

        // duration_text is generated from Days + Nights (never typed by hand)
        $validated['duration_text'] = TourPackage::formatDuration(
            (int) $validated['duration_days'],
            (int) $validated['duration_nights']
        );
        $validated['featured'] = $request->boolean('featured');
        $validated['h1'] = $validated['h1'] ?: $validated['name'];
        $validated['og_title'] = $validated['og_title'] ?: $validated['meta_title'];
        $validated['og_description'] = $validated['og_description'] ?: $validated['meta_description'];
        $validated['canonical_url'] = $validated['canonical_url'] ?: url('/tour-package/' . $validated['slug']);

        foreach (['main_image', 'top_image', 'bottom_left_image', 'bottom_right_image', 'og_image', 'twitter_card_image', 'group_offer_image'] as $field) {
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
        $destinations = Destination::orderBy('name')->get(['id', 'name']);
        $attractions = Attraction::orderBy('name')->get(['id', 'name']);
        $activities = Activity::orderBy('name')->get(['id', 'name']);

        // Active amenities + any inactive ones already linked to this package,
        // so saving the form doesn't silently detach them.
        $amenities = Amenity::where('is_active', true)
            ->orWhereIn('id', $tourpackage->amenities->pluck('id'))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name', 'icon', 'is_active']);

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
            'destinations' => $destinations,
            'attractions' => $attractions,
            'activities' => $activities,
            'amenities' => $amenities,
        ]);
    }

    public function update(Request $request, TourPackage $tourpackage)
    {
        $validated = $request->validate($this->rules());

        $validated['status'] = $request->status ?? $tourpackage->status;

        // duration_text is generated from Days + Nights (never typed by hand)
        $validated['duration_text'] = TourPackage::formatDuration(
            (int) $validated['duration_days'],
            (int) $validated['duration_nights']
        );
        $validated['featured'] = $request->boolean('featured');
        $validated['h1'] = $validated['h1'] ?: $tourpackage->name;
        $validated['og_title'] = $validated['og_title'] ?: $validated['meta_title'];
        $validated['og_description'] = $validated['og_description'] ?: $validated['meta_description'];
        $validated['canonical_url'] = $validated['canonical_url'] ?: $tourpackage->canonical_url ?: url('/tour-package/' . $tourpackage->slug);

        foreach (['main_image', 'top_image', 'bottom_left_image', 'bottom_right_image', 'og_image', 'twitter_card_image', 'group_offer_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($tourpackage->{$field}) {
                    Storage::disk('public')->delete($tourpackage->{$field});
                }
                $validated[$field] = $request->file($field)->store('tourpackages/' . $field, 'public');
            }
        }

        $tourpackage->update($validated);
        $this->saveAllChildren($tourpackage, $request);

        return redirect()->route('admin.tourpackages.index')->with('success', 'Tour Package updated successfully.');
    }

    public function destroy(TourPackage $tourpackage)
    {
        // 'features' is kept here only to clean up icon files from legacy feature rows
        $tourpackage->load(['features', 'durationOptions']);

        foreach (['main_image', 'top_image', 'bottom_left_image', 'bottom_right_image', 'og_image', 'twitter_card_image', 'group_offer_image'] as $field) {
            if ($tourpackage->{$field}) {
                Storage::disk('public')->delete($tourpackage->{$field});
            }
        }

        foreach ($tourpackage->features as $feature) {
            if ($feature->icon_image) {
                Storage::disk('public')->delete($feature->icon_image);
            }
        }

        foreach ($tourpackage->durationOptions as $option) {
            if ($option->image) {
                Storage::disk('public')->delete($option->image);
            }
        }

        $tourpackage->delete();

        return redirect()->route('admin.tourpackages.index')->with('success', 'Tour Package deleted successfully.');
    }

    private function saveAllChildren(TourPackage $tp, Request $request): void
    {
        $this->saveDurationOptions($tp, $request);
        $this->saveRouteStops($tp, $request);
        $this->saveHighlights($tp, $request);
        $this->saveItineraryDays($tp, $request);
        $this->saveHotelStays($tp, $request);
        $this->saveSimpleTextList($tp, $request, 'includes', 'include_texts', 'include_ids', 'deleted_includes');
        $this->saveSimpleTextList($tp, $request, 'excludes', 'exclude_texts', 'exclude_ids', 'deleted_excludes');
        $this->savePolicies($tp, $request);
        $this->saveFaqs($tp, $request);
        $this->syncLinkedEntities($tp, $request);
    }

    private function rules(): array
    {
        return [
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required|string|max:255',
            'status' => 'nullable|in:draft,published,unpublished',
            'featured' => 'nullable|boolean',

            'country_id' => 'nullable|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',

            'banner_tag_text' => 'nullable|string|max:255',
            'banner_intro' => 'nullable|string',
            'main_image' => 'nullable|image',
            'top_image' => 'nullable|image',
            'bottom_left_image' => 'nullable|image',
            'bottom_right_image' => 'nullable|image',
            'video_url' => 'nullable|string|max:255',

            'duration_days' => 'required|integer|min:1|max:30',
            'duration_nights' => 'required|integer|min:0|lte:duration_days',
            'old_price' => 'nullable|numeric|min:0',
            'price' => 'nullable|numeric|min:0',
            'price_unit_text' => 'nullable|string|max:100',

            'overview_title' => 'nullable|string|max:255',
            'overview_content' => 'nullable|string',
            'map_embed_url' => 'nullable|string',

            'group_offer_badge_text' => 'nullable|string|max:100',
            'group_offer_title' => 'nullable|string|max:255',
            'group_offer_description' => 'nullable|string',
            'group_offer_button1_text' => 'nullable|string|max:100',
            'group_offer_button1_url' => 'nullable|string|max:255',
            'group_offer_image' => 'nullable|image|max:2048',

            'promo_badge_text' => 'nullable|string|max:100',
            'promo_title' => 'nullable|string|max:255',
            'promo_description' => 'nullable|string',
            'promo_button_text' => 'nullable|string|max:100',
            'promo_button_url' => 'nullable|string|max:255',
            'promo_end_at' => 'nullable|date',

            'h1' => 'nullable|string|max:255',
            'robots' => 'nullable|string|max:50',
            'twitter_card_image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',
            'canonical_url' => 'nullable|string|max:255',

            // Amenities (pivot)
            'amenity_ids' => 'nullable|array',
            'amenity_ids.*' => 'nullable|exists:amenities,id',

            // Duration options
            'duropt_ids' => 'nullable|array',
            'duropt_ids.*' => 'nullable|integer',
            'duropt_labels' => 'nullable|array',
            'duropt_labels.*' => 'nullable|string|max:50',
            'duropt_prices' => 'nullable|array',
            'duropt_prices.*' => 'nullable|numeric',
            'duropt_images' => 'nullable|array',
            'duropt_images.*' => 'nullable|image|max:1024',
            'deleted_duration_options' => 'nullable|string',

            // Route stops
            'stop_ids' => 'nullable|array',
            'stop_ids.*' => 'nullable|integer',
            'stop_names' => 'nullable|array',
            'stop_names.*' => 'nullable|string|max:100',
            'deleted_stops' => 'nullable|string',

            // Highlights (check-list)
            'highlight_ids' => 'nullable|array',
            'highlight_ids.*' => 'nullable|integer',
            'highlight_texts' => 'nullable|array',
            'highlight_texts.*' => 'nullable|string|max:255',
            'deleted_highlights' => 'nullable|string',

            // Itinerary
            'itin_ids' => 'nullable|array',
            'itin_ids.*' => 'nullable|integer',
            'itin_day_numbers' => 'nullable|array',
            'itin_day_numbers.*' => 'nullable|integer',
            'itin_titles' => 'nullable|array',
            'itin_titles.*' => 'nullable|string|max:255',
            'itin_contents' => 'nullable|array',
            'itin_contents.*' => 'nullable|string',
            'deleted_itinerary' => 'nullable|string',

            // Hotel stays — now linked to real Hotel records
            'hotel_stay_ids' => 'nullable|array',
            'hotel_stay_ids.*' => 'nullable|integer',
            'hotel_ids' => 'nullable|array',
            'hotel_ids.*' => 'nullable|exists:hotels,id',
            'hotel_day_labels' => 'nullable|array',
            'hotel_day_labels.*' => 'nullable|string|max:50',
            'hotel_titles' => 'nullable|array',
            'hotel_titles.*' => 'nullable|string|max:255',
            'hotel_check_ins' => 'nullable|array',
            'hotel_check_ins.*' => 'nullable|string|max:50',
            'hotel_check_outs' => 'nullable|array',
            'hotel_check_outs.*' => 'nullable|string|max:50',
            'hotel_breakfast' => 'nullable|array',
            'hotel_breakfast.*' => 'nullable|in:0,1',
            'hotel_lunch' => 'nullable|array',
            'hotel_lunch.*' => 'nullable|in:0,1',
            'hotel_dinner' => 'nullable|array',
            'hotel_dinner.*' => 'nullable|in:0,1',
            'deleted_hotels' => 'nullable|string',

            // Includes / Excludes
            'include_ids' => 'nullable|array',
            'include_ids.*' => 'nullable|integer',
            'include_texts' => 'nullable|array',
            'include_texts.*' => 'nullable|string|max:255',
            'deleted_includes' => 'nullable|string',
            'exclude_ids' => 'nullable|array',
            'exclude_ids.*' => 'nullable|integer',
            'exclude_texts' => 'nullable|array',
            'exclude_texts.*' => 'nullable|string|max:255',
            'deleted_excludes' => 'nullable|string',

            // Policies
            'policy_ids' => 'nullable|array',
            'policy_ids.*' => 'nullable|integer',
            'policy_titles' => 'nullable|array',
            'policy_titles.*' => 'nullable|string|max:255',
            'policy_contents' => 'nullable|array',
            'policy_contents.*' => 'nullable|string',
            'deleted_policies' => 'nullable|string',

            // FAQs
            'faq_ids' => 'nullable|array',
            'faq_ids.*' => 'nullable|integer',
            'faq_questions' => 'nullable|array',
            'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers' => 'nullable|array',
            'faq_answers.*' => 'nullable|string',
            'deleted_faqs' => 'nullable|string',

            'destination_ids' => 'nullable|array',
            'destination_ids.*' => 'nullable|exists:destinations,id',
            'attraction_ids' => 'nullable|array',
            'attraction_ids.*' => 'nullable|exists:attractions,id',
            'activity_ids' => 'nullable|array',
            'activity_ids.*' => 'nullable|exists:activities,id',

        ];
    }

    private function deleteMarked($relation, ?string $csv, ?string $imageColumn = null): void
    {
        if (!$csv)
            return;
        $ids = array_filter(explode(',', $csv));
        if (empty($ids))
            return;

        if ($imageColumn) {
            $relation->whereIn('id', $ids)->get()->each(function ($row) use ($imageColumn) {
                if ($row->{$imageColumn}) {
                    Storage::disk('public')->delete($row->{$imageColumn});
                }
            });
        }

        $relation->whereIn('id', $ids)->delete();
    }

    private function saveDurationOptions(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->durationOptions(), $request->deleted_duration_options, 'image');
        if (!$request->filled('duropt_labels'))
            return;

        foreach ($request->duropt_labels as $i => $label) {
            if (!$label)
                continue;
            $data = [
                'days_label' => $label,
                'price' => $request->duropt_prices[$i] ?? null,
                'sort_order' => $i,
            ];
            $id = $request->duropt_ids[$i] ?? null;

            if ($request->hasFile("duropt_images.$i")) {
                if ($id) {
                    $existing = $tp->durationOptions()->find($id);
                    if ($existing && $existing->image) {
                        Storage::disk('public')->delete($existing->image);
                    }
                }
                $data['image'] = $request->file("duropt_images.$i")->store('tourpackages/duration-options', 'public');
            }

            $id ? $tp->durationOptions()->where('id', $id)->update($data) : $tp->durationOptions()->create($data);
        }
    }

    private function saveRouteStops(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->routeStops(), $request->deleted_stops);
        if (!$request->filled('stop_names'))
            return;

        foreach ($request->stop_names as $i => $name) {
            if (!$name)
                continue;
            $data = ['name' => $name, 'sort_order' => $i];
            $id = $request->stop_ids[$i] ?? null;
            $id ? $tp->routeStops()->where('id', $id)->update($data) : $tp->routeStops()->create($data);
        }
    }

    private function saveHighlights(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->highlights(), $request->deleted_highlights);
        if (!$request->filled('highlight_texts'))
            return;

        foreach ($request->highlight_texts as $i => $text) {
            if (!$text)
                continue;
            $data = ['text' => $text, 'sort_order' => $i];
            $id = $request->highlight_ids[$i] ?? null;
            $id ? $tp->highlights()->where('id', $id)->update($data) : $tp->highlights()->create($data);
        }
    }

    private function saveItineraryDays(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->itineraryDays(), $request->deleted_itinerary);
        if (!$request->filled('itin_titles'))
            return;

        foreach ($request->itin_titles as $i => $title) {
            $content = $request->itin_contents[$i] ?? '';
            if (!$title && !$content)
                continue;
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
        if (!$request->filled('hotel_ids'))
            return;

        foreach ($request->hotel_ids as $i => $hotelId) {
            if (!$hotelId)
                continue;
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
        if (!$request->filled($textKey))
            return;

        foreach ($request->{$textKey} as $i => $text) {
            if (!$text)
                continue;
            $data = ['text' => $text, 'sort_order' => $i];
            $id = $request->{$idKey}[$i] ?? null;
            $id ? $tp->{$relation}()->where('id', $id)->update($data) : $tp->{$relation}()->create($data);
        }
    }

    private function savePolicies(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->policies(), $request->deleted_policies);
        if (!$request->filled('policy_titles'))
            return;

        foreach ($request->policy_titles as $i => $title) {
            $content = $request->policy_contents[$i] ?? '';
            if (!$title && !$content)
                continue;
            $data = ['title' => $title, 'content' => $content, 'sort_order' => $i];
            $id = $request->policy_ids[$i] ?? null;
            $id ? $tp->policies()->where('id', $id)->update($data) : $tp->policies()->create($data);
        }
    }

    private function saveFaqs(TourPackage $tp, Request $request): void
    {
        $this->deleteMarked($tp->faqs(), $request->deleted_faqs);
        if (!$request->filled('faq_questions'))
            return;

        foreach ($request->faq_questions as $i => $question) {
            $answer = $request->faq_answers[$i] ?? '';
            if (!$question && !$answer)
                continue;
            $data = ['question' => $question, 'answer' => $answer, 'sort_order' => $i];
            $id = $request->faq_ids[$i] ?? null;
            $id ? $tp->faqs()->where('id', $id)->update($data) : $tp->faqs()->create($data);
        }
    }

    private function syncLinkedEntities(TourPackage $tp, Request $request): void
    {
        $tp->amenities()->sync(array_filter($request->input('amenity_ids', [])));
        $tp->destinations()->sync($this->buildSyncPayload($request->destination_ids ?? []));
        $tp->attractions()->sync($this->buildSyncPayload($request->attraction_ids ?? []));
        $tp->activities()->sync($this->buildSyncPayload($request->activity_ids ?? []));
    }

    private function buildSyncPayload(array $ids): array
    {
        $payload = [];
        $order = 0;
        foreach ($ids as $id) {
            if (!$id)
                continue;
            $payload[$id] = ['sort_order' => $order++];
        }
        return $payload;
    }

}