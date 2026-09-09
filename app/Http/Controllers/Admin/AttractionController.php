<?php
// app/Http/Controllers/Admin/AttractionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attraction;
use App\Models\AttractionBudgetTier;
use App\Models\AttractionCarryGroup;
use App\Models\AttractionExperience;
use App\Models\AttractionGallery;
use App\Models\AttractionHighlight;
use App\Models\AttractionPlace;
use App\Models\AttractionSeason;
use App\Models\AttractionTransport;
use App\Models\AttractionFaq;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttractionController extends Controller
{
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

        return view('admin.attraction.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $validated['slug'] = $this->uniqueSlug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('attractions', 'public');
        }

        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('attractions/seo', 'public');
        } else {
            $validated['og_image'] = $validated['image'] ?? null;
        }

        if ($request->hasFile('about_image')) {
            $validated['about_image'] = $request->file('about_image')->store('attractions/about', 'public');
        }

        if ($request->hasFile('offer_image')) {
            $validated['offer_image'] = $request->file('offer_image')->store('attractions/offer', 'public');
        }

        $validated['offer_perks'] = array_values(array_filter($request->input('offer_perks', [])));
        $validated['h1'] = $validated['h1'] ?: $validated['name'];
        $validated['og_title'] = $validated['og_title'] ?: $validated['meta_title'];
        $validated['og_description'] = $validated['og_description'] ?: $validated['meta_description'];
        $validated['canonical_url'] = $validated['canonical_url'] ?: url('/attractions/' . $validated['slug']);

        $validated['best_for_tags'] = $this->parseTags($request->input('best_for_tags'));
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['status'] = $request->input('status', 'draft');

        $attraction = Attraction::create($validated);

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

        return redirect()
            ->route('admin.attractions.index')
            ->with('success', 'Attraction created successfully.');
    }

    public function edit(Attraction $attraction)
    {
        $countries = Country::where('status', 'active')->orderBy('sort_order')->get();
        $states = State::where('country_id', $attraction->country_id)->orderBy('sort_order')->get();
        $cities = City::where('state_id', $attraction->state_id)->orderBy('sort_order')->get();
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
        $validated = $this->validateData($request, $attraction->id);

        if ($validated['name'] !== $attraction->name) {
            $validated['slug'] = $this->uniqueSlug($validated['name'], $attraction->id);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('attractions', 'public');
        }

        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('attractions/seo', 'public');
        }

        if ($request->hasFile('about_image')) {
            if ($attraction->about_image) {
                Storage::disk('public')->delete($attraction->about_image);
            }
            $validated['about_image'] = $request->file('about_image')->store('attractions/about', 'public');
        }

        if ($request->hasFile('offer_image')) {
            if ($attraction->offer_image) {
                Storage::disk('public')->delete($attraction->offer_image);
            }
            $validated['offer_image'] = $request->file('offer_image')->store('attractions/offer', 'public');
        }

        $validated['offer_perks'] = array_values(array_filter($request->input('offer_perks', [])));
        $validated['h1'] = $validated['h1'] ?: $validated['name'];
        $validated['og_title'] = $validated['og_title'] ?: $validated['meta_title'];
        $validated['og_description'] = $validated['og_description'] ?: $validated['meta_description'];
        $validated['canonical_url'] = $validated['canonical_url']
            ?: url('/attractions/' . ($validated['slug'] ?? $attraction->slug));

        $validated['best_for_tags'] = $this->parseTags($request->input('best_for_tags'));
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['status'] = $request->input('status', $attraction->status);

        $attraction->update($validated);

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

        return redirect()
            ->route('admin.attractions.index')
            ->with('success', 'Attraction updated successfully.');
    }

    public function destroy(Attraction $attraction)
    {
        foreach ($attraction->galleries as $gallery) {
            Storage::disk('public')->delete($gallery->image);
        }

        foreach ($attraction->highlights as $highlight) {
            if ($highlight->icon) {
                Storage::disk('public')->delete($highlight->icon);
            }
        }

        foreach ($attraction->experiences as $experience) {
            if ($experience->image) {
                Storage::disk('public')->delete($experience->image);
            }
        }

        foreach ($attraction->places as $place) {
            if ($place->image) {
                Storage::disk('public')->delete($place->image);
            }
        }

        $attraction->delete();

        return redirect()
            ->route('admin.attractions.index')
            ->with('success', 'Attraction deleted successfully.');
    }

    // Cascading dropdown: states for a given country
    public function getStates(Country $country)
    {
        return State::where('country_id', $country->id)
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get(['id', 'name']);
    }

    // Cascading dropdown: cities for a given state
    public function getCities(State $state)
    {
        return City::where('state_id', $state->id)
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->get(['id', 'name']);
    }

    /**
     * Handle the gallery repeater: delete removed rows, update titles/subtitles
     * on existing rows, and create rows for newly uploaded images.
     */
    private function syncGalleries(Request $request, Attraction $attraction): void
    {
        if ($request->filled('deleted_galleries')) {
            $deletedIds = array_filter(explode(',', $request->input('deleted_galleries')));

            $toDelete = AttractionGallery::where('attraction_id', $attraction->id)
                ->whereIn('id', $deletedIds)
                ->get();

            foreach ($toDelete as $gallery) {
                Storage::disk('public')->delete($gallery->image);
                $gallery->delete();
            }
        }

        if ($request->has('gallery_titles_existing')) {
            foreach ($request->input('gallery_titles_existing') as $id => $title) {
                AttractionGallery::where('id', $id)
                    ->where('attraction_id', $attraction->id)
                    ->update([
                        'title' => $title,
                        'subtitle' => $request->input("gallery_subtitles_existing.$id"),
                    ]);
            }
        }

        if ($request->hasFile('gallery_images')) {
            $nextOrder = (int) AttractionGallery::where('attraction_id', $attraction->id)->max('sort_order');

            foreach ($request->file('gallery_images') as $index => $file) {
                if (!$file) {
                    continue;
                }

                $nextOrder++;

                $attraction->galleries()->create([
                    'image' => $file->store('attractions/gallery', 'public'),
                    'title' => $request->input("gallery_titles.$index"),
                    'subtitle' => $request->input("gallery_subtitles.$index"),
                    'sort_order' => $nextOrder,
                ]);
            }
        }
    }

    /**
     * Handle the "Why Visit" highlights repeater.
     */
    private function syncHighlights(Request $request, Attraction $attraction): void
    {
        if ($request->filled('deleted_highlights')) {
            $deletedIds = array_filter(explode(',', $request->input('deleted_highlights')));

            $toDelete = AttractionHighlight::where('attraction_id', $attraction->id)
                ->whereIn('id', $deletedIds)
                ->get();

            foreach ($toDelete as $highlight) {
                if ($highlight->icon) {
                    Storage::disk('public')->delete($highlight->icon);
                }
                $highlight->delete();
            }
        }

        if ($request->has('highlight_titles_existing')) {
            foreach ($request->input('highlight_titles_existing') as $id => $title) {
                $highlight = AttractionHighlight::where('id', $id)
                    ->where('attraction_id', $attraction->id)
                    ->first();

                if (!$highlight) {
                    continue;
                }

                $highlight->title = $title;
                $highlight->description = $request->input("highlight_descriptions_existing.$id");

                if ($request->hasFile("highlight_icons_existing.$id")) {
                    if ($highlight->icon) {
                        Storage::disk('public')->delete($highlight->icon);
                    }
                    $highlight->icon = $request->file("highlight_icons_existing.$id")
                        ->store('attractions/highlights', 'public');
                }

                $highlight->save();
            }
        }

        if ($request->has('highlight_titles')) {
            $nextOrder = (int) AttractionHighlight::where('attraction_id', $attraction->id)->max('sort_order');

            foreach ($request->input('highlight_titles') as $index => $title) {
                if (!$title) {
                    continue;
                }

                $nextOrder++;

                $icon = null;
                if ($request->hasFile("highlight_icons.$index")) {
                    $icon = $request->file("highlight_icons.$index")->store('attractions/highlights', 'public');
                }

                $attraction->highlights()->create([
                    'icon' => $icon,
                    'title' => $title,
                    'description' => $request->input("highlight_descriptions.$index"),
                    'sort_order' => $nextOrder,
                ]);
            }
        }
    }

    /**
     * Handle the "Experiences to Explore" repeater.
     */
    private function syncExperiences(Request $request, Attraction $attraction): void
    {
        if ($request->filled('deleted_experiences')) {
            $deletedIds = array_filter(explode(',', $request->input('deleted_experiences')));

            $toDelete = AttractionExperience::where('attraction_id', $attraction->id)
                ->whereIn('id', $deletedIds)
                ->get();

            foreach ($toDelete as $experience) {
                if ($experience->image) {
                    Storage::disk('public')->delete($experience->image);
                }
                $experience->delete();
            }
        }

        if ($request->has('experience_titles_existing')) {
            foreach ($request->input('experience_titles_existing') as $id => $title) {
                $experience = AttractionExperience::where('id', $id)
                    ->where('attraction_id', $attraction->id)
                    ->first();

                if (!$experience) {
                    continue;
                }

                $experience->title = $title;
                $experience->description = $request->input("experience_descriptions_existing.$id");
                $experience->duration_text = $request->input("experience_durations_existing.$id");

                if ($request->hasFile("experience_images_existing.$id")) {
                    if ($experience->image) {
                        Storage::disk('public')->delete($experience->image);
                    }
                    $experience->image = $request->file("experience_images_existing.$id")
                        ->store('attractions/experiences', 'public');
                }

                $experience->save();
            }
        }

        if ($request->has('experience_titles')) {
            $nextOrder = (int) AttractionExperience::where('attraction_id', $attraction->id)->max('sort_order');

            foreach ($request->input('experience_titles') as $index => $title) {
                if (!$title) {
                    continue;
                }

                $nextOrder++;

                $image = null;
                if ($request->hasFile("experience_images.$index")) {
                    $image = $request->file("experience_images.$index")->store('attractions/experiences', 'public');
                }

                $attraction->experiences()->create([
                    'image' => $image,
                    'title' => $title,
                    'description' => $request->input("experience_descriptions.$index"),
                    'duration_text' => $request->input("experience_durations.$index"),
                    'sort_order' => $nextOrder,
                ]);
            }
        }
    }

    /**
     * Handle the "Places to Visit" repeater.
     */
    private function syncPlaces(Request $request, Attraction $attraction): void
    {
        if ($request->filled('deleted_places')) {
            $deletedIds = array_filter(explode(',', $request->input('deleted_places')));

            $toDelete = AttractionPlace::where('attraction_id', $attraction->id)
                ->whereIn('id', $deletedIds)
                ->get();

            foreach ($toDelete as $place) {
                if ($place->image) {
                    Storage::disk('public')->delete($place->image);
                }
                $place->delete();
            }
        }

        if ($request->has('place_titles_existing')) {
            foreach ($request->input('place_titles_existing') as $id => $title) {
                $place = AttractionPlace::where('id', $id)
                    ->where('attraction_id', $attraction->id)
                    ->first();

                if (!$place) {
                    continue;
                }

                $place->title = $title;
                $place->tag = $request->input("place_tags_existing.$id");
                $place->description = $request->input("place_descriptions_existing.$id");
                $place->button_text = $request->input("place_button_texts_existing.$id");

                if ($request->hasFile("place_images_existing.$id")) {
                    if ($place->image) {
                        Storage::disk('public')->delete($place->image);
                    }
                    $place->image = $request->file("place_images_existing.$id")
                        ->store('attractions/places', 'public');
                }

                $place->save();
            }
        }

        if ($request->has('place_titles')) {
            $nextOrder = (int) AttractionPlace::where('attraction_id', $attraction->id)->max('sort_order');

            foreach ($request->input('place_titles') as $index => $title) {
                if (!$title) {
                    continue;
                }

                $nextOrder++;

                $image = null;
                if ($request->hasFile("place_images.$index")) {
                    $image = $request->file("place_images.$index")->store('attractions/places', 'public');
                }

                $attraction->places()->create([
                    'image' => $image,
                    'tag' => $request->input("place_tags.$index"),
                    'title' => $title,
                    'description' => $request->input("place_descriptions.$index"),
                    'button_text' => $request->input("place_button_texts.$index"),
                    'sort_order' => $nextOrder,
                ]);
            }
        }
    }

    /**
     * Handle the "How Many Days" itinerary plans — full replace strategy.
     * Deletes all existing plans + stops for this attraction and recreates
     * them from the submitted arrays, in submitted order.
     */
    private function syncItineraries(Request $request, Attraction $attraction): void
    {
        if (!$request->has('itinerary_titles')) {
            return; // no itinerary fields submitted at all — leave existing data untouched
        }

        $attraction->itineraries()->delete(); // cascades to stops via FK

        $order = 0;

        foreach ($request->input('itinerary_titles') as $index => $title) {
            if (!$title) {
                continue;
            }

            $order++;

            $itinerary = $attraction->itineraries()->create([
                'days' => $request->input("itinerary_days.$index", 0),
                'title' => $title,
                'is_popular' => $request->boolean("itinerary_popular.$index"),
                'sort_order' => $order,
            ]);

            $stops = array_filter($request->input("itinerary_stops.$index", []));
            $stopOrder = 0;

            foreach ($stops as $stopName) {
                $stopOrder++;
                $itinerary->stops()->create([
                    'stop_name' => $stopName,
                    'sort_order' => $stopOrder,
                ]);
            }
        }
    }

    /**
     * Handle "Best Time to Visit" seasons — full replace strategy.
     */
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

    /**
     * Handle "How to Reach" transport options — full replace strategy.
     */
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
                'mode_type' => $request->input("transport_types.$index", 'other'),
                'mode_name' => $name,
                'mode_sub' => $request->input("transport_subs.$index"),
                'description' => $request->input("transport_descriptions.$index"),
                'sort_order' => $order,
            ]);
        }
    }

    /**
     * Handle "Estimated Budget" tiers — full replace strategy.
     */
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

            $features = array_values(array_filter($request->input("budget_features.$index", [])));

            AttractionBudgetTier::create([
                'attraction_id' => $attraction->id,
                'tier_name' => $tierName,
                'price_range' => $request->input("budget_price_ranges.$index"),
                'price_unit' => $request->input("budget_price_units.$index") ?: '/ day',
                'note' => $request->input("budget_notes.$index"),
                'features' => $features,
                'is_recommended' => $request->boolean("budget_recommended.$index"),
                'sort_order' => $order,
            ]);
        }
    }

    /**
     * Handle "What to Carry" groups — full replace strategy.
     */
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

            $items = array_values(array_filter($request->input("carry_items.$index", [])));

            AttractionCarryGroup::create([
                'attraction_id' => $attraction->id,
                'title' => $title,
                'items' => $items,
                'sort_order' => $order,
            ]);
        }
    }

    /**
     * Handle FAQs — full replace strategy.
     */
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

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'map_location' => 'nullable|string|max:255',
            'image' => 'nullable|image',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'about_image' => 'nullable|image',
            'about_content' => 'nullable|string',
            'offer_badge_text' => 'nullable|string|max:100',
            'offer_title' => 'nullable|string|max:255',
            'offer_description' => 'nullable|string|max:500',
            'offer_perks.*' => 'nullable|string|max:150',
            'offer_image' => 'nullable|image|max:2048',
            'offer_button_text' => 'nullable|string|max:100',
            'offer_button_url' => 'nullable|string|max:255',
            'duration_text' => 'nullable|string|max:100',
            'best_time_text' => 'nullable|string|max:100',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'h1' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image',
            'canonical_url' => 'nullable|string|max:255',

            'gallery_images.*' => 'nullable|image',
            'gallery_titles.*' => 'nullable|string|max:255',
            'gallery_subtitles.*' => 'nullable|string|max:255',

            'highlight_icons.*' => 'nullable|image|max:1024',
            'highlight_titles.*' => 'nullable|string|max:255',
            'highlight_descriptions.*' => 'nullable|string|max:500',

            'experience_images.*' => 'nullable|image',
            'experience_titles.*' => 'nullable|string|max:255',
            'experience_descriptions.*' => 'nullable|string|max:500',
            'experience_durations.*' => 'nullable|string|max:50',

            'place_images.*' => 'nullable|image',
            'place_tags.*' => 'nullable|string|max:100',
            'place_titles.*' => 'nullable|string|max:255',
            'place_descriptions.*' => 'nullable|string|max:500',
            'place_button_texts.*' => 'nullable|string|max:100',

            'itinerary_days.*' => 'nullable|integer|min:1|max:60',
            'itinerary_titles.*' => 'nullable|string|max:255',
            'itinerary_stops.*.*' => 'nullable|string|max:100',

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

            'about_more_title' => 'nullable|string|max:255',
            'about_more_content' => 'nullable|string',

            'promo_eyebrow' => 'nullable|string|max:100',
            'promo_title' => 'nullable|string|max:255',
            'promo_description' => 'nullable|string|max:500',
            'promo_button_text' => 'nullable|string|max:100',
            'promo_button_url' => 'nullable|string|max:255',

            'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers.*' => 'nullable|string|max:1000',
        ]);
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