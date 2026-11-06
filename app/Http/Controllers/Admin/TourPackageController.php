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
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TourPackageController extends Controller
{
    private const IMAGE_FIELDS = ['main_image', 'top_image', 'bottom_left_image', 'bottom_right_image', 'og_image', 'twitter_card_image', 'group_offer_image'];

    // Returned by validate() but they are child-table / pivot data, never TourPackage columns
    private const CHILD_KEYS = [
        'sub_category_ids',
        'amenity_ids',
        'destination_ids',
        'attraction_ids',
        'activity_ids',
        'duropt_ids',
        'duropt_labels',
        'duropt_prices',
        'duropt_images',
        'deleted_duration_options',
        'stop_ids',
        'stop_names',
        'deleted_stops',
        'highlight_ids',
        'highlight_texts',
        'deleted_highlights',
        'itin_ids',
        'itin_day_numbers',
        'itin_titles',
        'itin_contents',
        'deleted_itinerary',
        'hotel_stay_ids',
        'hotel_ids',
        'hotel_day_labels',
        'hotel_titles',
        'hotel_check_ins',
        'hotel_check_outs',
        'hotel_breakfast',
        'hotel_lunch',
        'hotel_dinner',
        'deleted_hotels',
        'include_ids',
        'include_texts',
        'deleted_includes',
        'exclude_ids',
        'exclude_texts',
        'deleted_excludes',
        'policy_ids',
        'policy_titles',
        'policy_contents',
        'deleted_policies',
        'faq_ids',
        'faq_questions',
        'faq_answers',
        'deleted_faqs',
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

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        while (
            TourPackage::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }

    private function failure(Request $request, \Throwable $e, string $verb)
    {
        report($e);
        $msg = config('app.debug')
            ? $e->getMessage()
            : "Could not {$verb} the tour package. Nothing was saved. Please try again.";

        return $request->expectsJson()
            ? response()->json(['message' => $msg], 500)
            : back()->withInput()->with('error', $msg);
    }

    private function success(Request $request, string $message)
    {
        if ($request->expectsJson()) {
            session()->flash('success', $message);
            return response()->json(['redirect' => route('admin.tourpackages.index')]);
        }

        return redirect()->route('admin.tourpackages.index')->with('success', $message);
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate($this->rules(), [], $this->attributes());

        return Arr::except($validated, self::CHILD_KEYS);
    }

    private function attributes(): array
    {
        return [
            'sub_category_ids' => 'sub categories',
            'name' => 'package name',
            'duration_days' => 'days',
            'duration_nights' => 'nights',
            'duropt_labels.*' => 'duration option label',
            'stop_names.*' => 'route stop name',
            'highlight_texts.*' => 'highlight text',
            'include_texts.*' => 'include text',
            'exclude_texts.*' => 'exclude text',
            'itin_titles.*' => 'itinerary day title',
            'policy_titles.*' => 'policy title',
            'faq_questions.*' => 'FAQ question',
            'hotel_ids.*' => 'hotel',
        ];
    }
    private array $relations = [
        'subCategories',
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

    private function primarySubCategoryId(Request $request): ?int
    {
        $id = collect($request->input('sub_category_ids', []))->filter()->first();
        return $id ? (int) $id : null;
    }

    // Used by create() and edit()
    private function groupedSubCategories()
    {
        return SubCategory::with('category:id,name')
            ->orderBy('name')
            ->get(['id', 'name', 'category_id'])
            ->groupBy(fn($s) => $s->category->name ?? 'Uncategorised')
            ->sortKeys();
    }

    public function index()
    {
        $tourPackages = TourPackage::with(['subCategories'])->latest()->paginate(20);
        return view('admin.tourpackage.index', compact('tourPackages'));
    }

    public function create()
    {
        $subCategories = $this->groupedSubCategories();
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
        $validated = $this->validatedData($request);

        try {
            DB::transaction(function () use ($request, $validated) {
                $validated['slug'] = $this->uniqueSlug($validated['name']);
                $validated['sub_category_id'] = $this->primarySubCategoryId($request);
                $validated['status'] = $request->status ?? 'draft';
                $validated['duration_text'] = TourPackage::formatDuration(
                    (int) $validated['duration_days'],
                    (int) $validated['duration_nights']
                );
                $validated['featured'] = $request->boolean('featured');
                $validated['h1'] = $validated['h1'] ?: $validated['name'];
                $validated['og_title'] = $validated['og_title'] ?: $validated['meta_title'];
                $validated['og_description'] = $validated['og_description'] ?: $validated['meta_description'];
                $validated['canonical_url'] = $validated['canonical_url'] ?: url('/tour-package/' . $validated['slug']);

                foreach (self::IMAGE_FIELDS as $field) {
                    if ($request->hasFile($field)) {
                        $validated[$field] = $this->storeFile($request->file($field), 'tourpackages/' . $field);
                    }
                }

                $tourPackage = TourPackage::create($validated);
                $this->saveAllChildren($tourPackage, $request);
            });
        } catch (\Throwable $e) {
            $this->rollbackFiles();
            return $this->failure($request, $e, 'save');
        }

        $this->flushDeletes();

        return $this->success($request, 'Tour Package added successfully.');
    }

    public function edit(TourPackage $tourpackage)
    {
        $tourpackage->load($this->relations);

        $subCategories = $this->groupedSubCategories();
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
        $validated = $this->validatedData($request);

        try {
            DB::transaction(function () use ($request, $tourpackage, $validated) {
                $validated['status'] = $request->status ?? $tourpackage->status;
                $validated['sub_category_id'] = $this->primarySubCategoryId($request);
                $validated['duration_text'] = TourPackage::formatDuration(
                    (int) $validated['duration_days'],
                    (int) $validated['duration_nights']
                );
                $validated['featured'] = $request->boolean('featured');
                $validated['h1'] = $validated['h1'] ?: $validated['name'];
                $validated['og_title'] = $validated['og_title'] ?: $validated['meta_title'];
                $validated['og_description'] = $validated['og_description'] ?: $validated['meta_description'];
                $validated['canonical_url'] = $validated['canonical_url']
                    ?: $tourpackage->canonical_url
                    ?: url('/tour-package/' . $tourpackage->slug);

                foreach (self::IMAGE_FIELDS as $field) {
                    if ($request->hasFile($field)) {
                        $this->queueDelete($tourpackage->{$field});
                        $validated[$field] = $this->storeFile($request->file($field), 'tourpackages/' . $field);
                    }
                }

                $tourpackage->update($validated);
                $this->saveAllChildren($tourpackage, $request);
            });
        } catch (\Throwable $e) {
            $this->rollbackFiles();
            return $this->failure($request, $e, 'update');
        }

        $this->flushDeletes();

        return $this->success($request, 'Tour Package updated successfully.');
    }

    public function destroy(TourPackage $tourpackage)
    {
        $tourpackage->load(['durationOptions']);

        foreach (self::IMAGE_FIELDS as $field) {
            $this->queueDelete($tourpackage->{$field});
        }
        foreach ($tourpackage->durationOptions as $option) {
            $this->queueDelete($option->image);
        }

        $tourpackage->delete();
        $this->flushDeletes();

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
            'sub_category_ids' => 'required|array|min:1',
            'sub_category_ids.*' => 'required|exists:sub_categories,id',
            'name' => 'required|string|max:255',
            'status' => 'nullable|in:draft,published,unpublished',
            'featured' => 'nullable|boolean',

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
            'duropt_labels.*' => 'required_with:duropt_ids.*,duropt_prices.*,duropt_images.*|nullable|string|max:50',
            'duropt_prices' => 'nullable|array',
            'duropt_prices.*' => 'nullable|numeric',
            'duropt_images' => 'nullable|array',
            'duropt_images.*' => 'nullable|image|max:1024',
            'deleted_duration_options' => 'nullable|string',

            // Route stops
            'stop_ids' => 'nullable|array',
            'stop_ids.*' => 'nullable|integer',
            'stop_names' => 'nullable|array',
            'stop_names.*' => 'required_with:stop_ids.*|nullable|string|max:100',
            'deleted_stops' => 'nullable|string',

            // Highlights (check-list)
            'highlight_ids' => 'nullable|array',
            'highlight_ids.*' => 'nullable|integer',
            'highlight_texts' => 'nullable|array',
            'highlight_texts.*' => 'required_with:highlight_ids.*|nullable|string|max:255',
            'deleted_highlights' => 'nullable|string',

            // Itinerary
            'itin_ids' => 'nullable|array',
            'itin_ids.*' => 'nullable|integer',
            'itin_day_numbers' => 'nullable|array',
            'itin_day_numbers.*' => 'nullable|integer',
            'itin_titles' => 'nullable|array',
            'itin_titles.*' => 'required_with:itin_ids.*|nullable|string|max:255',
            'itin_contents' => 'nullable|array',
            'itin_contents.*' => 'nullable|string',
            'deleted_itinerary' => 'nullable|string',

            // Hotel stays — linked to real Hotel records
            'hotel_stay_ids' => 'nullable|array',
            'hotel_stay_ids.*' => 'nullable|integer',
            'hotel_ids' => 'nullable|array',
            'hotel_ids.*' => 'required_with:hotel_stay_ids.*,hotel_day_labels.*,hotel_titles.*,hotel_check_ins.*,hotel_check_outs.*|nullable|exists:hotels,id',
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
            'include_texts.*' => 'required_with:include_ids.*|nullable|string|max:255',
            'deleted_includes' => 'nullable|string',
            'exclude_ids' => 'nullable|array',
            'exclude_ids.*' => 'nullable|integer',
            'exclude_texts' => 'nullable|array',
            'exclude_texts.*' => 'required_with:exclude_ids.*|nullable|string|max:255',
            'deleted_excludes' => 'nullable|string',

            // Policies
            'policy_ids' => 'nullable|array',
            'policy_ids.*' => 'nullable|integer',
            'policy_titles' => 'nullable|array',
            'policy_titles.*' => 'required_with:policy_ids.*|nullable|string|max:255',
            'policy_contents' => 'nullable|array',
            'policy_contents.*' => 'nullable|string',
            'deleted_policies' => 'nullable|string',

            // FAQs
            'faq_ids' => 'nullable|array',
            'faq_ids.*' => 'nullable|integer',
            'faq_questions' => 'nullable|array',
            'faq_questions.*' => 'required_with:faq_ids.*,faq_answers.*|nullable|string|max:255',
            'faq_answers' => 'nullable|array',
            'faq_answers.*' => 'nullable|string',
            'deleted_faqs' => 'nullable|string',

            // Linked entities (pivot)
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
            $relation->whereIn('id', $ids)->get()->each(fn($row) => $this->queueDelete($row->{$imageColumn}));
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
                    $this->queueDelete($existing?->image);
                }
                $data['image'] = $this->storeFile($request->file("duropt_images.$i"), 'tourpackages/duration-options');
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
        $tp->subCategories()->sync(array_filter($request->input('sub_category_ids', [])));
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