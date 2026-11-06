<?php
// app/Http/Controllers/Admin/AttractionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attraction;
use App\Models\AttractionBudgetTier;
use App\Models\AttractionCarryGroup;
use App\Models\AttractionCategory;
use App\Models\AttractionFaq;
use App\Models\AttractionSeason;
use App\Models\AttractionTransport;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttractionController extends Controller
{
    private const IMAGE_FIELDS = [
        'image' => 'attractions',
        'og_image' => 'attractions/seo',
        'twitter_card_image' => 'attractions/seo',
        'about_image' => 'attractions/about',
        'offer_image' => 'attractions/offer',
    ];

    // Returned by validate() but they are child-table data, never Attraction columns
    private const CHILD_KEYS = [
        'gallery_images',
        'gallery_titles',
        'gallery_subtitles',
        'gallery_titles_existing',
        'gallery_subtitles_existing',
        'deleted_galleries',
        'highlight_icons',
        'highlight_titles',
        'highlight_descriptions',
        'highlight_titles_existing',
        'highlight_descriptions_existing',
        'highlight_icons_existing',
        'deleted_highlights',
        'experience_images',
        'experience_titles',
        'experience_descriptions',
        'experience_durations',
        'experience_titles_existing',
        'experience_descriptions_existing',
        'experience_durations_existing',
        'experience_images_existing',
        'deleted_experiences',
        'place_images',
        'place_tags',
        'place_titles',
        'place_descriptions',
        'place_button_texts',
        'place_titles_existing',
        'place_tags_existing',
        'place_descriptions_existing',
        'place_button_texts_existing',
        'place_images_existing',
        'deleted_places',
        'itinerary_days',
        'itinerary_titles',
        'itinerary_stops',
        'itinerary_popular',
        'season_months',
        'season_titles',
        'season_descriptions',
        'season_tags',
        'season_active',
        'transport_types',
        'transport_names',
        'transport_subs',
        'transport_descriptions',
        'budget_tier_names',
        'budget_price_ranges',
        'budget_price_units',
        'budget_notes',
        'budget_features',
        'budget_recommended',
        'carry_titles',
        'carry_items',
        'faq_questions',
        'faq_answers',
        'offer_perks',
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

    /**
     * Queue an old image for deletion, unless another column of the same
     * attraction points at the same file (og/twitter default to the main image).
     */
    private function queueOwnImageDelete(Attraction $attraction, string $field): void
    {
        $old = $attraction->{$field};
        if (!$old) {
            return;
        }

        foreach (array_keys(self::IMAGE_FIELDS) as $other) {
            if ($other !== $field && $attraction->{$other} === $old) {
                return;
            }
        }

        $this->queueDelete($old);
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
            : "Could not {$verb} the attraction. Nothing was saved. Please try again.";

        return $request->expectsJson()
            ? response()->json(['message' => $msg], 500)
            : back()->withInput()->with('error', $msg);
    }

    private function success(Request $request, string $message)
    {
        if ($request->expectsJson()) {
            session()->flash('success', $message);
            return response()->json(['redirect' => route('admin.attractions.index')]);
        }

        return redirect()->route('admin.attractions.index')->with('success', $message);
    }

    public function index()
    {
        $attractions = Attraction::with(['country', 'state', 'city'])
            ->orderBy('sort_order')
            ->latest()
            ->paginate(15);

        return view('admin.attraction.index', compact('attractions'));
    }

    public function create()
    {
        $countries = Country::where('status', 'active')->orderBy('sort_order')->get();
        $categories = AttractionCategory::published()->orderBy('sort_order')->orderBy('name')->get();

        return view('admin.attraction.create', compact('countries', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatedData($request);

        try {
            DB::transaction(function () use ($request, $validated) {
                $validated['slug'] = $this->uniqueSlug($validated['name']);

                foreach (self::IMAGE_FIELDS as $field => $dir) {
                    if ($request->hasFile($field)) {
                        $validated[$field] = $this->storeFile($request->file($field), $dir);
                    }
                }

                // OG / Twitter images default to the main image
                $validated['og_image'] = $validated['og_image'] ?? ($validated['image'] ?? null);
                $validated['twitter_card_image'] = $validated['twitter_card_image'] ?? $validated['og_image'];

                $validated = $this->prepareData($request, $validated);

                $attraction = Attraction::create($validated);

                $this->syncAll($request, $attraction);
            });
        } catch (\Throwable $e) {
            $this->rollbackFiles();
            return $this->failure($request, $e, 'save');
        }

        $this->flushDeletes();

        return $this->success($request, 'Attraction created successfully.');
    }

    public function edit(Attraction $attraction)
    {
        $countries = Country::where('status', 'active')->orderBy('sort_order')->get();
        $states = State::where('country_id', $attraction->country_id)->orderBy('sort_order')->get();
        $cities = City::where('state_id', $attraction->state_id)->orderBy('sort_order')->get();
        $categories = AttractionCategory::published()->orderBy('sort_order')->orderBy('name')->get();
        $galleries = $attraction->galleries()->orderBy('sort_order')->get();
        $highlights = $attraction->highlights()->orderBy('sort_order')->get();
        $experiences = $attraction->experiences()->orderBy('sort_order')->get();
        $places = $attraction->places()->orderBy('sort_order')->get();
        $itineraries = $attraction->itineraries()->with('stops')->orderBy('sort_order')->get();
        $seasons = $attraction->seasons()->orderBy('sort_order')->get();
        $transports = $attraction->transports()->orderBy('sort_order')->get();
        $budgetTiers = $attraction->budgetTiers()->orderBy('sort_order')->get();
        $carryGroups = $attraction->carryGroups()->orderBy('sort_order')->get();
        $faqs = $attraction->faqs()->orderBy('sort_order')->get();

        return view('admin.attraction.edit', compact(
            'attraction',
            'countries',
            'categories',
            'states',
            'cities',
            'galleries',
            'highlights',
            'experiences',
            'places',
            'itineraries',
            'seasons',
            'transports',
            'budgetTiers',
            'carryGroups',
            'faqs'
        ));
    }

    public function update(Request $request, Attraction $attraction)
    {
        $validated = $this->validatedData($request);

        try {
            DB::transaction(function () use ($request, $attraction, $validated) {
                if ($validated['name'] !== $attraction->name) {
                    $validated['slug'] = $this->uniqueSlug($validated['name'], $attraction->id);
                }

                foreach (self::IMAGE_FIELDS as $field => $dir) {
                    if ($request->hasFile($field)) {
                        $this->queueOwnImageDelete($attraction, $field);
                        $validated[$field] = $this->storeFile($request->file($field), $dir);
                    }
                }

                $validated = $this->prepareData($request, $validated, $attraction);

                $attraction->update($validated);

                $this->syncAll($request, $attraction);
            });
        } catch (\Throwable $e) {
            $this->rollbackFiles();
            return $this->failure($request, $e, 'update');
        }

        $this->flushDeletes();

        return $this->success($request, 'Attraction updated successfully.');
    }

    public function destroy(Attraction $attraction)
    {
        foreach (array_keys(self::IMAGE_FIELDS) as $field) {
            $this->queueDelete($attraction->{$field});
        }
        foreach ($attraction->galleries as $row) {
            $this->queueDelete($row->image);
        }
        foreach ($attraction->highlights as $row) {
            $this->queueDelete($row->icon);
        }
        foreach ($attraction->experiences as $row) {
            $this->queueDelete($row->image);
        }
        foreach ($attraction->places as $row) {
            $this->queueDelete($row->image);
        }

        $attraction->delete();
        $this->flushDeletes();

        return redirect()
            ->route('admin.attractions.index')
            ->with('success', 'Attraction deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate($this->rules(), [], $this->attributes());

        return Arr::except($validated, self::CHILD_KEYS);
    }

    /** Derived columns; runs inside the transaction. */
    private function prepareData(Request $request, array $validated, ?Attraction $attraction = null): array
    {
        $slug = $validated['slug'] ?? $attraction?->slug;

        $validated['offer_perks'] = array_values(array_filter($request->input('offer_perks', [])));
        $site = config('app.name');
        $body = trim(preg_replace('/\s+/', ' ', strip_tags(
            ($validated['short_description'] ?? null)
            ?: ($validated['description'] ?? null)
            ?: ($validated['about_content'] ?? null)
            ?: ($validated['about_more_content'] ?? '')
        )));
        $name = $validated['name'];

        $validated['h1'] = ($validated['h1'] ?? null) ?: $name;
        $validated['meta_title'] = ($validated['meta_title'] ?? null)
            ?: Str::limit($name . ($site ? ' | ' . $site : ''), 60, '');
        $validated['meta_description'] = ($validated['meta_description'] ?? null)
            ?: Str::limit($body ?: "Explore {$name}: best time to visit, things to do, itinerary, budget and tour packages.", 160, '');
        $validated['og_title'] = ($validated['og_title'] ?? null) ?: $validated['meta_title'];
        $validated['og_description'] = ($validated['og_description'] ?? null) ?: $validated['meta_description'];
        $validated['canonical_url'] = ($validated['canonical_url'] ?? null) ?: url('/attractions/' . $slug);
        $validated['robots'] = ($validated['robots'] ?? null) ?: 'index, follow';
        $validated['best_for_tags'] = $this->parseTags($request->input('best_for_tags'));
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_must_visit'] = $request->boolean('is_must_visit');
        $validated['status'] = $request->input('status', $attraction?->status ?? 'draft');

        return $validated;
    }

    private function syncAll(Request $request, Attraction $attraction): void
    {
        $this->syncGalleries($request, $attraction);
        $this->syncHighlights($request, $attraction);
        $this->syncExperiences($request, $attraction);
        $this->syncPlaces($request, $attraction);
        $this->syncItineraries($request, $attraction);
        $this->syncSeasons($request, $attraction);
        $this->syncTransports($request, $attraction);
        $this->syncBudgetTiers($request, $attraction);
        $this->syncCarryGroups($request, $attraction);
        $this->syncFaqs($request, $attraction);
    }

    /** Delete rows whose ids are in the CSV; image files are removed after commit. */
    private function deleteMarked($relation, ?string $csv, ?string $imageColumn = null): void
    {
        if (!$csv) {
            return;
        }
        $ids = array_filter(explode(',', $csv));
        if (empty($ids)) {
            return;
        }

        if ($imageColumn) {
            $relation->whereIn('id', $ids)->get()->each(fn($row) => $this->queueDelete($row->{$imageColumn}));
        }

        $relation->whereIn('id', $ids)->delete();
    }

    private function syncGalleries(Request $request, Attraction $attraction): void
    {
        $this->deleteMarked($attraction->galleries(), $request->input('deleted_galleries'), 'image');

        foreach ($request->input('gallery_titles_existing', []) as $id => $title) {
            $attraction->galleries()->where('id', $id)->update([
                'title' => $title,
                'subtitle' => $request->input("gallery_subtitles_existing.$id"),
            ]);
        }

        if ($request->hasFile('gallery_images')) {
            $nextOrder = (int) $attraction->galleries()->max('sort_order');

            foreach ($request->file('gallery_images') as $index => $file) {
                if (!$file) {
                    continue;
                }

                $nextOrder++;

                $attraction->galleries()->create([
                    'image' => $this->storeFile($file, 'attractions/gallery'),
                    'title' => $request->input("gallery_titles.$index"),
                    'subtitle' => $request->input("gallery_subtitles.$index"),
                    'sort_order' => $nextOrder,
                ]);
            }
        }
    }

    private function syncHighlights(Request $request, Attraction $attraction): void
    {
        $this->deleteMarked($attraction->highlights(), $request->input('deleted_highlights'), 'icon');

        foreach ($request->input('highlight_titles_existing', []) as $id => $title) {
            $highlight = $attraction->highlights()->where('id', $id)->first();
            if (!$highlight) {
                continue;
            }

            $highlight->title = $title;
            $highlight->description = $request->input("highlight_descriptions_existing.$id");

            if ($request->hasFile("highlight_icons_existing.$id")) {
                $this->queueDelete($highlight->icon);
                $highlight->icon = $this->storeFile($request->file("highlight_icons_existing.$id"), 'attractions/highlights');
            }

            $highlight->save();
        }

        $nextOrder = (int) $attraction->highlights()->max('sort_order');

        foreach ($request->input('highlight_titles', []) as $index => $title) {
            if (!$title) {
                continue;
            }

            $nextOrder++;

            $attraction->highlights()->create([
                'icon' => $request->hasFile("highlight_icons.$index")
                    ? $this->storeFile($request->file("highlight_icons.$index"), 'attractions/highlights')
                    : null,
                'title' => $title,
                'description' => $request->input("highlight_descriptions.$index"),
                'sort_order' => $nextOrder,
            ]);
        }
    }

    private function syncExperiences(Request $request, Attraction $attraction): void
    {
        $this->deleteMarked($attraction->experiences(), $request->input('deleted_experiences'), 'image');

        foreach ($request->input('experience_titles_existing', []) as $id => $title) {
            $experience = $attraction->experiences()->where('id', $id)->first();
            if (!$experience) {
                continue;
            }

            $experience->title = $title;
            $experience->description = $request->input("experience_descriptions_existing.$id");
            $experience->duration_text = $request->input("experience_durations_existing.$id");

            if ($request->hasFile("experience_images_existing.$id")) {
                $this->queueDelete($experience->image);
                $experience->image = $this->storeFile($request->file("experience_images_existing.$id"), 'attractions/experiences');
            }

            $experience->save();
        }

        $nextOrder = (int) $attraction->experiences()->max('sort_order');

        foreach ($request->input('experience_titles', []) as $index => $title) {
            if (!$title) {
                continue;
            }

            $nextOrder++;

            $attraction->experiences()->create([
                'image' => $request->hasFile("experience_images.$index")
                    ? $this->storeFile($request->file("experience_images.$index"), 'attractions/experiences')
                    : null,
                'title' => $title,
                'description' => $request->input("experience_descriptions.$index"),
                'duration_text' => $request->input("experience_durations.$index"),
                'sort_order' => $nextOrder,
            ]);
        }
    }

    private function syncPlaces(Request $request, Attraction $attraction): void
    {
        $this->deleteMarked($attraction->places(), $request->input('deleted_places'), 'image');

        foreach ($request->input('place_titles_existing', []) as $id => $title) {
            $place = $attraction->places()->where('id', $id)->first();
            if (!$place) {
                continue;
            }

            $place->title = $title;
            $place->tag = $request->input("place_tags_existing.$id");
            $place->description = $request->input("place_descriptions_existing.$id");
            $place->button_text = $request->input("place_button_texts_existing.$id");

            if ($request->hasFile("place_images_existing.$id")) {
                $this->queueDelete($place->image);
                $place->image = $this->storeFile($request->file("place_images_existing.$id"), 'attractions/places');
            }

            $place->save();
        }

        $nextOrder = (int) $attraction->places()->max('sort_order');

        foreach ($request->input('place_titles', []) as $index => $title) {
            if (!$title) {
                continue;
            }

            $nextOrder++;

            $attraction->places()->create([
                'image' => $request->hasFile("place_images.$index")
                    ? $this->storeFile($request->file("place_images.$index"), 'attractions/places')
                    : null,
                'tag' => $request->input("place_tags.$index"),
                'title' => $title,
                'description' => $request->input("place_descriptions.$index"),
                'button_text' => $request->input("place_button_texts.$index"),
                'sort_order' => $nextOrder,
            ]);
        }
    }

    /** "How Many Days" plans — full replace strategy. */
    private function syncItineraries(Request $request, Attraction $attraction): void
    {
        if (!$request->has('itinerary_titles')) {
            return; // not submitted — leave existing data untouched
        }

        $attraction->itineraries()->delete(); // cascades to stops via FK

        $order = 0;

        foreach ($request->input('itinerary_titles') as $index => $title) {
            if (!$title) {
                continue;
            }

            $order++;

            $itinerary = $attraction->itineraries()->create([
                'days' => (int) ($request->input("itinerary_days.$index") ?: 0),
                'title' => $title,
                'is_popular' => $request->boolean("itinerary_popular.$index"),
                'sort_order' => $order,
            ]);

            $stopOrder = 0;

            foreach (array_filter($request->input("itinerary_stops.$index", [])) as $stopName) {
                $stopOrder++;
                $itinerary->stops()->create([
                    'stop_name' => $stopName,
                    'sort_order' => $stopOrder,
                ]);
            }
        }
    }

    /** "Best Time to Visit" seasons — full replace strategy. */
    private function syncSeasons(Request $request, Attraction $attraction): void
    {
        if (!$request->has('season_titles')) {
            return;
        }

        $attraction->seasons()->delete();

        $order = 0;

        foreach ($request->input('season_titles') as $index => $title) {
            if (!$title) {
                continue;
            }

            $order++;

            AttractionSeason::create([
                'attraction_id' => $attraction->id,
                'months' => $request->input("season_months.$index"),
                'title' => $title,
                'description' => $request->input("season_descriptions.$index"),
                'tags' => $this->parseTags($request->input("season_tags.$index")),
                'is_active' => $request->boolean("season_active.$index"),
                'sort_order' => $order,
            ]);
        }
    }

    /** "How to Reach" transport options — full replace strategy. */
    private function syncTransports(Request $request, Attraction $attraction): void
    {
        if (!$request->has('transport_names')) {
            return;
        }

        $attraction->transports()->delete();

        $order = 0;

        foreach ($request->input('transport_names') as $index => $name) {
            if (!$name) {
                continue;
            }

            $order++;

            AttractionTransport::create([
                'attraction_id' => $attraction->id,
                'mode_type' => $request->input("transport_types.$index") ?: 'other',
                'mode_name' => $name,
                'mode_sub' => $request->input("transport_subs.$index"),
                'description' => $request->input("transport_descriptions.$index"),
                'sort_order' => $order,
            ]);
        }
    }

    /** "Estimated Budget" tiers — full replace strategy. */
    private function syncBudgetTiers(Request $request, Attraction $attraction): void
    {
        if (!$request->has('budget_tier_names')) {
            return;
        }

        $attraction->budgetTiers()->delete();

        $order = 0;

        foreach ($request->input('budget_tier_names') as $index => $tierName) {
            if (!$tierName) {
                continue;
            }

            $order++;

            AttractionBudgetTier::create([
                'attraction_id' => $attraction->id,
                'tier_name' => $tierName,
                'price_range' => $request->input("budget_price_ranges.$index"),
                'price_unit' => $request->input("budget_price_units.$index") ?: '/ day',
                'note' => $request->input("budget_notes.$index"),
                'features' => array_values(array_filter($request->input("budget_features.$index", []))),
                'is_recommended' => $request->boolean("budget_recommended.$index"),
                'sort_order' => $order,
            ]);
        }
    }

    /** "What to Carry" groups — full replace strategy. */
    private function syncCarryGroups(Request $request, Attraction $attraction): void
    {
        if (!$request->has('carry_titles')) {
            return;
        }

        $attraction->carryGroups()->delete();

        $order = 0;

        foreach ($request->input('carry_titles') as $index => $title) {
            if (!$title) {
                continue;
            }

            $order++;

            AttractionCarryGroup::create([
                'attraction_id' => $attraction->id,
                'title' => $title,
                'items' => array_values(array_filter($request->input("carry_items.$index", []))),
                'sort_order' => $order,
            ]);
        }
    }

    /** FAQs — full replace strategy. */
    private function syncFaqs(Request $request, Attraction $attraction): void
    {
        if (!$request->has('faq_questions')) {
            return;
        }

        $attraction->faqs()->delete();

        $order = 0;

        foreach ($request->input('faq_questions') as $index => $question) {
            if (!$question) {
                continue;
            }

            $order++;

            AttractionFaq::create([
                'attraction_id' => $attraction->id,
                'question' => $question,
                'answer' => $request->input("faq_answers.$index"),
                'sort_order' => $order,
            ]);
        }
    }

    private function attributes(): array
    {
        return [
            'category_id' => 'category',
            'country_id' => 'country',
            'state_id' => 'state',
            'city_id' => 'city',
            'name' => 'attraction name',
            'gallery_images.*' => 'gallery image',
            'highlight_icons.*' => 'highlight icon',
            'highlight_titles.*' => 'highlight title',
            'experience_titles.*' => 'experience title',
            'place_titles.*' => 'place title',
            'itinerary_days.*' => 'itinerary days',
            'itinerary_titles.*' => 'itinerary plan title',
            'itinerary_stops.*.*' => 'itinerary stop',
            'season_titles.*' => 'season title',
            'transport_names.*' => 'transport label',
            'budget_tier_names.*' => 'budget tier name',
            'budget_features.*.*' => 'budget feature',
            'carry_titles.*' => 'carry group title',
            'carry_items.*.*' => 'carry item',
            'faq_questions.*' => 'FAQ question',
            'faq_answers.*' => 'FAQ answer',
        ];
    }

    private function rules(): array
    {
        return [
            'category_id' => 'nullable|exists:attraction_categories,id',
            'is_must_visit' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|in:draft,published,unpublished',
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'map_location' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:3072',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'about_image' => 'nullable|image|max:3072',
            'about_content' => 'nullable|string',
            'offer_badge_text' => 'nullable|string|max:100',
            'offer_title' => 'nullable|string|max:255',
            'offer_description' => 'nullable|string|max:500',
            'offer_perks' => 'nullable|array',
            'offer_perks.*' => 'nullable|string|max:150',
            'offer_image' => 'nullable|image|max:2048',
            'offer_button_text' => 'nullable|string|max:100',
            'offer_button_url' => 'nullable|string|max:255',
            'duration_text' => 'nullable|string|max:100',
            'best_time_text' => 'nullable|string|max:100',
            'best_for_tags' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'h1' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:3072',
            'canonical_url' => 'nullable|string|max:255',
            'twitter_card_image' => 'nullable|image|max:3072',
            'robots' => 'nullable|string|max:50',

            'about_more_title' => 'nullable|string|max:255',
            'about_more_content' => 'nullable|string',

            'promo_eyebrow' => 'nullable|string|max:100',
            'promo_title' => 'nullable|string|max:255',
            'promo_description' => 'nullable|string|max:500',
            'promo_button_text' => 'nullable|string|max:100',
            'promo_button_url' => 'nullable|string|max:255',

            // Gallery
            'deleted_galleries' => 'nullable|string',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|max:3072',
            'gallery_titles.*' => 'nullable|string|max:255',
            'gallery_subtitles.*' => 'nullable|string|max:255',
            'gallery_titles_existing.*' => 'nullable|string|max:255',
            'gallery_subtitles_existing.*' => 'nullable|string|max:255',

            // Highlights
            'deleted_highlights' => 'nullable|string',
            'highlight_icons.*' => 'nullable|image|max:1024',
            'highlight_titles.*' => 'nullable|string|max:255',
            'highlight_descriptions.*' => 'nullable|string|max:500',
            'highlight_icons_existing.*' => 'nullable|image|max:1024',
            'highlight_titles_existing.*' => 'nullable|string|max:255',
            'highlight_descriptions_existing.*' => 'nullable|string|max:500',

            // Experiences
            'deleted_experiences' => 'nullable|string',
            'experience_images.*' => 'nullable|image|max:3072',
            'experience_titles.*' => 'nullable|string|max:255',
            'experience_descriptions.*' => 'nullable|string|max:500',
            'experience_durations.*' => 'nullable|string|max:50',
            'experience_images_existing.*' => 'nullable|image|max:3072',
            'experience_titles_existing.*' => 'nullable|string|max:255',
            'experience_descriptions_existing.*' => 'nullable|string|max:500',
            'experience_durations_existing.*' => 'nullable|string|max:50',

            // Places
            'deleted_places' => 'nullable|string',
            'place_images.*' => 'nullable|image|max:3072',
            'place_tags.*' => 'nullable|string|max:100',
            'place_titles.*' => 'nullable|string|max:255',
            'place_descriptions.*' => 'nullable|string|max:500',
            'place_button_texts.*' => 'nullable|string|max:100',
            'place_images_existing.*' => 'nullable|image|max:3072',
            'place_tags_existing.*' => 'nullable|string|max:100',
            'place_titles_existing.*' => 'nullable|string|max:255',
            'place_descriptions_existing.*' => 'nullable|string|max:500',
            'place_button_texts_existing.*' => 'nullable|string|max:100',

            // Itineraries
            'itinerary_days.*' => 'nullable|integer|min:1|max:60',
            'itinerary_titles.*' => 'nullable|string|max:255',
            'itinerary_stops.*.*' => 'nullable|string|max:100',

            // Travel info
            'season_months.*' => 'nullable|string|max:100',
            'season_titles.*' => 'nullable|string|max:100',
            'season_descriptions.*' => 'nullable|string|max:500',
            'season_tags.*' => 'nullable|string|max:255',

            'transport_types.*' => 'nullable|string|in:air,road,train,other',
            'transport_names.*' => 'nullable|string|max:100',
            'transport_subs.*' => 'nullable|string|max:150',
            'transport_descriptions.*' => 'nullable|string|max:500',

            'budget_tier_names.*' => 'nullable|string|max:100',
            'budget_price_ranges.*' => 'nullable|string|max:100',
            'budget_price_units.*' => 'nullable|string|max:50',
            'budget_notes.*' => 'nullable|string|max:255',
            'budget_features.*.*' => 'nullable|string|max:150',

            'carry_titles.*' => 'nullable|string|max:100',
            'carry_items.*.*' => 'nullable|string|max:150',

            // FAQs
            'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers.*' => 'nullable|string|max:1000',
        ];
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        while (
            Attraction::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }

    private function parseTags(?string $raw): array
    {
        if (!$raw) {
            return [];
        }

        return collect(explode(',', $raw))
            ->map(fn($tag) => trim($tag))
            ->filter()
            ->values()
            ->all();
    }
}