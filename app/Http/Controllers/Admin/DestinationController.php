<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Destination;
use App\Models\DestinationGallery;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::with(['country', 'state', 'city'])
            ->orderBy('sort_order')
            ->latest()
            ->paginate(15);

        return view('admin.destination.index', compact('destinations'));
    }

    public function create()
    {
        $countries = Country::where('status', 'active')->orderBy('sort_order')->get();

        return view('admin.destination.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $validated['slug'] = $this->uniqueSlug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('destinations', 'public');
        }

        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('destinations/seo', 'public');
        } else {
            $validated['og_image'] = $validated['image'] ?? null;
        }

        if ($request->hasFile('why_visit_image')) {
            $validated['why_visit_image'] = $request->file('why_visit_image')->store('destinations/highlights', 'public');
        }

        $validated['h1'] = $validated['h1'] ?: $validated['name'];
        $validated['og_title'] = $validated['og_title'] ?: $validated['meta_title'];
        $validated['og_description'] = $validated['og_description'] ?: $validated['meta_description'];
        $validated['canonical_url'] = $validated['canonical_url'] ?: url('/destinations/' . $validated['slug']);

        $validated['best_for_tags'] = $this->parseTags($request->input('best_for_tags'));
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['status'] = $request->input('status', 'draft');
        $validated['season_highlights'] = $this->parseSeasonHighlights($request);

        $destination = Destination::create($validated);

        $this->syncBanner($request, $destination);
        $this->syncActivities($request, $destination);
        $this->syncGallery($request, $destination);
        $this->syncMatches($request, $destination);
        $this->syncAreas($request, $destination);
        $this->syncHighlights($request, $destination);
        $this->syncPlaces($request, $destination);
        $this->syncRoutes($request, $destination);
        $this->syncJourneyDays($request, $destination);
        $this->syncSeasons($request, $destination);
        $this->syncBudgetTiers($request, $destination);
        $this->syncBudgetBreakdown($request, $destination);
        $this->syncFaqs($request, $destination);

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination created successfully.');
    }

    public function edit(Destination $destination)
    {
        $countries = Country::where('status', 'active')->orderBy('sort_order')->get();
        $states = State::where('country_id', $destination->country_id)->orderBy('sort_order')->get();
        $cities = City::where('state_id', $destination->state_id)->orderBy('sort_order')->get();
        $destination->load('galleries', 'matches', 'areas', 'highlights', 'places', 'banner', 'activities', 'routes', 'journeyDays', 'seasons', 'budgetTiers', 'budgetBreakdown', 'faqs');

        return view('admin.destination.edit', compact('destination', 'countries', 'states', 'cities'));
    }

    public function update(Request $request, Destination $destination)
    {
        $validated = $this->validateData($request, $destination->id);

        if ($validated['name'] !== $destination->name) {
            $validated['slug'] = $this->uniqueSlug($validated['name'], $destination->id);
        }

        if ($request->hasFile('image')) {
            $this->deleteImage($destination->image);
            $validated['image'] = $request->file('image')->store('destinations', 'public');
        }

        if ($request->hasFile('og_image')) {
            $this->deleteImage($destination->og_image);
            $validated['og_image'] = $request->file('og_image')->store('destinations/seo', 'public');
        }

        if ($request->hasFile('why_visit_image')) {
            $this->deleteImage($destination->why_visit_image);
            $validated['why_visit_image'] = $request->file('why_visit_image')->store('destinations/highlights', 'public');
        }

        $validated['h1'] = $validated['h1'] ?: $validated['name'];
        $validated['og_title'] = $validated['og_title'] ?: $validated['meta_title'];
        $validated['og_description'] = $validated['og_description'] ?: $validated['meta_description'];
        $validated['canonical_url'] = $validated['canonical_url']
            ?: url('/destinations/' . ($validated['slug'] ?? $destination->slug));

        $validated['best_for_tags'] = $this->parseTags($request->input('best_for_tags'));
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['status'] = $request->input('status', $destination->status);
        $validated['season_highlights'] = $this->parseSeasonHighlights($request);

        $destination->update($validated);

        if ($request->filled('remove_gallery_ids')) {
            $toDelete = DestinationGallery::where('destination_id', $destination->id)
                ->whereIn('id', $request->input('remove_gallery_ids'))
                ->get();
            foreach ($toDelete as $g) {
                $this->deleteImage($g->image);
            }
            DestinationGallery::whereIn('id', $toDelete->pluck('id'))->delete();
        }

        if ($request->filled('remove_match_ids')) {
            $toDelete = \App\Models\DestinationMatch::where('destination_id', $destination->id)
                ->whereIn('id', $request->input('remove_match_ids'))
                ->get();
            foreach ($toDelete as $m) {
                $this->deleteImage($m->icon);
            }
            \App\Models\DestinationMatch::whereIn('id', $toDelete->pluck('id'))->delete();
        }

        if ($request->filled('remove_area_ids')) {
            $toDelete = \App\Models\DestinationArea::where('destination_id', $destination->id)
                ->whereIn('id', $request->input('remove_area_ids'))
                ->get();
            foreach ($toDelete as $a) {
                $this->deleteImage($a->image);
            }
            \App\Models\DestinationArea::whereIn('id', $toDelete->pluck('id'))->delete();
        }

        if ($request->filled('remove_highlight_ids')) {
            $toDelete = \App\Models\DestinationHighlight::where('destination_id', $destination->id)
                ->whereIn('id', $request->input('remove_highlight_ids'))
                ->get();
            foreach ($toDelete as $h) {
                $this->deleteImage($h->icon);
            }
            \App\Models\DestinationHighlight::whereIn('id', $toDelete->pluck('id'))->delete();
        }

        if ($request->filled('remove_place_ids')) {
            $toDelete = \App\Models\DestinationPlace::where('destination_id', $destination->id)
                ->whereIn('id', $request->input('remove_place_ids'))
                ->get();
            foreach ($toDelete as $p) {
                $this->deleteImage($p->image);
            }
            \App\Models\DestinationPlace::whereIn('id', $toDelete->pluck('id'))->delete();
        }

        if ($request->filled('remove_activity_ids')) {
            $toDelete = \App\Models\DestinationActivity::where('destination_id', $destination->id)
                ->whereIn('id', $request->input('remove_activity_ids'))
                ->get();
            foreach ($toDelete as $act) {
                $this->deleteImage($act->image);
            }
            \App\Models\DestinationActivity::whereIn('id', $toDelete->pluck('id'))->delete();
        }

        if ($request->filled('remove_route_ids')) {
            \App\Models\DestinationRoute::where('destination_id', $destination->id)
                ->whereIn('id', $request->input('remove_route_ids'))
                ->delete();
        }

        if ($request->filled('remove_journey_ids')) {
            $toDelete = \App\Models\DestinationJourneyDay::where('destination_id', $destination->id)
                ->whereIn('id', $request->input('remove_journey_ids'))
                ->get();
            foreach ($toDelete as $j) {
                $this->deleteImage($j->image);
            }
            \App\Models\DestinationJourneyDay::whereIn('id', $toDelete->pluck('id'))->delete();
        }

        if ($request->filled('remove_faq_ids')) {
            \App\Models\DestinationFaq::where('destination_id', $destination->id)
                ->whereIn('id', $request->input('remove_faq_ids'))
                ->delete();
        }

        $this->updateExistingRoutes($request, $destination);
        $this->syncRoutes($request, $destination);
        $this->updateExistingJourneyDays($request, $destination);
        $this->syncJourneyDays($request, $destination);
        $this->syncBanner($request, $destination);
        $this->updateExistingActivities($request, $destination);
        $this->syncActivities($request, $destination);
        $this->updateExistingPlaces($request, $destination);
        $this->updateExistingAreas($request, $destination);
        $this->updateExistingHighlights($request, $destination);
        $this->updateExistingGallery($request, $destination);
        $this->syncGallery($request, $destination);
        $this->updateExistingMatches($request, $destination);
        $this->syncMatches($request, $destination);
        $this->syncAreas($request, $destination);
        $this->syncHighlights($request, $destination);
        $this->syncPlaces($request, $destination);
        $this->syncSeasons($request, $destination);
        $this->syncBudgetTiers($request, $destination);
        $this->syncBudgetBreakdown($request, $destination);
        $this->updateExistingFaqs($request, $destination);
        $this->syncFaqs($request, $destination);

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination)
    {
        $this->deleteImage($destination->image);
        $this->deleteImage($destination->og_image);
        $this->deleteImage($destination->why_visit_image);

        foreach ($destination->galleries as $g) {
            $this->deleteImage($g->image);
        }

        $destination->galleries()->delete();
        $destination->delete();

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination deleted successfully.');
    }

    /**
     * Delete a stored image from the public disk if it exists.
     */
    private function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'image' => 'nullable|image|max:2048',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'more_about_intro' => 'nullable|string|max:255',
            'more_about_content' => 'nullable|string',
            'verdict_title' => 'nullable|string|max:255',
            'recommended_for' => 'nullable|string|max:255',
            'duration_text' => 'nullable|string|max:100',
            'best_time_text' => 'nullable|string|max:100',
            'budget_text' => 'nullable|string|max:100',
            'budget_intro_text' => 'nullable|string|max:255',
            'budget_note' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'h1' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',
            'canonical_url' => 'nullable|string|max:255',
            'twitter_card_image' => 'nullable|string|max:255',
            'robots' => 'nullable|string|max:50',
            'why_visit_image' => 'nullable|image',
            'why_visit_media_tag' => 'nullable|string|max:255',
        ]);
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        while (
            Destination::where('slug', $slug)
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

    private function updateExistingGallery(Request $request, Destination $destination): void
    {
        if (!$request->has('existing_gallery')) {
            return;
        }

        $removeIds = $request->input('remove_gallery_ids', []);

        foreach ($request->input('existing_gallery') as $galleryId => $item) {
            if (in_array($galleryId, $removeIds)) {
                continue; // already deleted above, skip re-updating it
            }

            $gallery = $destination->galleries()->find($galleryId);

            if (!$gallery) {
                continue;
            }

            $data = [
                'title' => $item['title'] ?? null,
                'subtitle' => $item['subtitle'] ?? null,
            ];

            if ($request->hasFile("existing_gallery.$galleryId.image")) {
                $this->deleteImage($gallery->image);
                $data['image'] = $request->file("existing_gallery.$galleryId.image")->store('destinations/gallery', 'public');
            }

            $gallery->update($data);
        }
    }

    private function syncGallery(Request $request, Destination $destination): void
    {
        if (!$request->has('gallery')) {
            return;
        }

        foreach ($request->input('gallery') as $index => $item) {
            $imagePath = null;

            if ($request->hasFile("gallery.$index.image")) {
                $imagePath = $request->file("gallery.$index.image")->store('destinations/gallery', 'public');
            }

            if (!$imagePath && empty($item['title'])) {
                continue; // skip empty rows
            }

            $destination->galleries()->create([
                'image' => $imagePath,
                'title' => $item['title'] ?? null,
                'subtitle' => $item['subtitle'] ?? null,
                'sort_order' => $index,
            ]);
        }
    }

    private function updateExistingMatches(Request $request, Destination $destination): void
    {
        if (!$request->has('existing_match')) {
            return;
        }

        $removeIds = $request->input('remove_match_ids', []);

        foreach ($request->input('existing_match') as $matchId => $item) {
            if (in_array($matchId, $removeIds)) {
                continue;
            }

            $match = $destination->matches()->find($matchId);

            if (!$match) {
                continue;
            }

            $data = [
                'want' => $item['want'] ?? $match->want,
                'offer_text' => $item['offer_text'] ?? $match->offer_text,
            ];

            if ($request->hasFile("existing_match.$matchId.icon")) {
                $this->deleteImage($match->icon);
                $data['icon'] = $request->file("existing_match.$matchId.icon")->store('destinations/matches', 'public');
            }

            $match->update($data);
        }
    }

    private function syncMatches(Request $request, Destination $destination): void
    {
        if (!$request->has('match')) {
            return;
        }

        foreach ($request->input('match') as $index => $item) {
            $iconPath = null;

            if ($request->hasFile("match.$index.icon")) {
                $iconPath = $request->file("match.$index.icon")->store('destinations/matches', 'public');
            }

            if (empty($item['want']) && empty($item['offer_text'])) {
                continue; // skip empty rows
            }

            $destination->matches()->create([
                'icon' => $iconPath,
                'want' => $item['want'] ?? null,
                'offer_text' => $item['offer_text'] ?? null,
                'sort_order' => $index,
            ]);
        }
    }

    private function updateExistingAreas(Request $request, Destination $destination): void
    {
        if (!$request->has('existing_area')) {
            return;
        }

        $removeIds = $request->input('remove_area_ids', []);

        foreach ($request->input('existing_area') as $areaId => $item) {
            if (in_array($areaId, $removeIds)) {
                continue;
            }

            $area = $destination->areas()->find($areaId);

            if (!$area) {
                continue;
            }

            $data = [
                'name' => $item['name'] ?? $area->name,
                'tag' => $item['tag'] ?? null,
                'stay_duration' => $item['stay_duration'] ?? null,
                'why_text' => $item['why_text'] ?? null,
                'nearby_text' => $item['nearby_text'] ?? null,
            ];

            if ($request->hasFile("existing_area.$areaId.image")) {
                $this->deleteImage($area->image);
                $data['image'] = $request->file("existing_area.$areaId.image")->store('destinations/areas', 'public');
            }

            $area->update($data);
        }
    }

    private function syncAreas(Request $request, Destination $destination): void
    {
        if (!$request->has('area')) {
            return;
        }

        foreach ($request->input('area') as $index => $item) {
            $imagePath = null;

            if ($request->hasFile("area.$index.image")) {
                $imagePath = $request->file("area.$index.image")->store('destinations/areas', 'public');
            }

            if (!$imagePath && empty($item['name'])) {
                continue;
            }

            $destination->areas()->create([
                'image' => $imagePath,
                'name' => $item['name'] ?? null,
                'tag' => $item['tag'] ?? null,
                'stay_duration' => $item['stay_duration'] ?? null,
                'why_text' => $item['why_text'] ?? null,
                'nearby_text' => $item['nearby_text'] ?? null,
                'sort_order' => $index,
            ]);
        }
    }

    private function updateExistingHighlights(Request $request, Destination $destination): void
    {
        if (!$request->has('existing_highlight')) {
            return;
        }

        $removeIds = $request->input('remove_highlight_ids', []);

        foreach ($request->input('existing_highlight') as $highlightId => $item) {
            if (in_array($highlightId, $removeIds)) {
                continue;
            }

            $highlight = $destination->highlights()->find($highlightId);

            if (!$highlight) {
                continue;
            }

            $data = [
                'title' => $item['title'] ?? $highlight->title,
                'description' => $item['description'] ?? null,
            ];

            if ($request->hasFile("existing_highlight.$highlightId.icon")) {
                $this->deleteImage($highlight->icon);
                $data['icon'] = $request->file("existing_highlight.$highlightId.icon")->store('destinations/highlights', 'public');
            }

            $highlight->update($data);
        }
    }

    private function syncHighlights(Request $request, Destination $destination): void
    {
        if (!$request->has('highlight')) {
            return;
        }

        foreach ($request->input('highlight') as $index => $item) {
            $iconPath = null;

            if ($request->hasFile("highlight.$index.icon")) {
                $iconPath = $request->file("highlight.$index.icon")->store('destinations/highlights', 'public');
            }

            if (empty($item['title'])) {
                continue;
            }

            $destination->highlights()->create([
                'icon' => $iconPath,
                'title' => $item['title'] ?? null,
                'description' => $item['description'] ?? null,
                'sort_order' => $index,
            ]);
        }
    }

    private function updateExistingPlaces(Request $request, Destination $destination): void
    {
        if (!$request->has('existing_place')) {
            return;
        }

        $removeIds = $request->input('remove_place_ids', []);

        foreach ($request->input('existing_place') as $placeId => $item) {
            if (in_array($placeId, $removeIds)) {
                continue;
            }

            $place = $destination->places()->find($placeId);

            if (!$place) {
                continue;
            }

            $data = [
                'name' => $item['name'] ?? $place->name,
                'description' => $item['description'] ?? null,
                'is_featured' => isset($item['is_featured']) ? true : false,
            ];

            if ($request->hasFile("existing_place.$placeId.image")) {
                $this->deleteImage($place->image);
                $data['image'] = $request->file("existing_place.$placeId.image")->store('destinations/places', 'public');
            }

            $place->update($data);
        }
    }

    private function syncPlaces(Request $request, Destination $destination): void
    {
        if (!$request->has('place')) {
            return;
        }

        foreach ($request->input('place') as $index => $item) {
            $imagePath = null;

            if ($request->hasFile("place.$index.image")) {
                $imagePath = $request->file("place.$index.image")->store('destinations/places', 'public');
            }

            if (!$imagePath && empty($item['name'])) {
                continue;
            }

            $destination->places()->create([
                'image' => $imagePath,
                'name' => $item['name'] ?? null,
                'description' => $item['description'] ?? null,
                'is_featured' => isset($item['is_featured']),
                'sort_order' => $index,
            ]);
        }
    }

    private function updateExistingActivities(Request $request, Destination $destination): void
    {
        if (!$request->has('existing_activity')) {
            return;
        }

        $removeIds = $request->input('remove_activity_ids', []);

        foreach ($request->input('existing_activity') as $activityId => $item) {
            if (in_array($activityId, $removeIds)) {
                continue; // already deleted above, skip re-updating it
            }

            $activity = $destination->activities()->find($activityId);

            if (!$activity) {
                continue;
            }

            $data = [
                'tag' => $item['tag'] ?? null,
                'title' => $item['title'] ?? $activity->title,
                'description' => $item['description'] ?? null,
                'is_featured' => isset($item['is_featured']),
            ];

            if ($request->hasFile("existing_activity.$activityId.image")) {
                $this->deleteImage($activity->image);
                $data['image'] = $request->file("existing_activity.$activityId.image")->store('destinations/activities', 'public');
            }

            $activity->update($data);
        }
    }

    private function syncActivities(Request $request, Destination $destination): void
    {
        if (!$request->has('activity')) {
            return;
        }

        foreach ($request->input('activity') as $index => $item) {
            $imagePath = null;

            if ($request->hasFile("activity.$index.image")) {
                $imagePath = $request->file("activity.$index.image")->store('destinations/activities', 'public');
            }

            if (!$imagePath && empty($item['title'])) {
                continue; // skip empty rows
            }

            $destination->activities()->create([
                'image' => $imagePath,
                'tag' => $item['tag'] ?? null,
                'title' => $item['title'] ?? null,
                'description' => $item['description'] ?? null,
                'is_featured' => isset($item['is_featured']),
                'sort_order' => $destination->activities()->count() + $index,
            ]);
        }
    }

    private function syncBanner(Request $request, Destination $destination): void
    {
        if (!$request->filled('banner') && !$request->hasFile('banner_image')) {
            return;
        }

        $bannerData = $request->input('banner', []);
        $bannerId = $bannerData['id'] ?? null;
        unset($bannerData['id']);

        $bannerData['perks'] = !empty($bannerData['perks'])
            ? array_map('trim', explode(',', $bannerData['perks']))
            : null;

        $existingBanner = $bannerId
            ? \App\Models\DestinationBanner::where('id', $bannerId)->where('destination_id', $destination->id)->first()
            : null;

        if ($request->hasFile('banner_image')) {
            if ($existingBanner) {
                $this->deleteImage($existingBanner->image);
            }
            $bannerData['image'] = $request->file('banner_image')->store('destinations/banners', 'public');
        }

        if ($existingBanner) {
            $existingBanner->update($bannerData);
        } elseif (array_filter($bannerData)) {
            $destination->banner()->create($bannerData);
        }
    }

    // ---- Routes ----
    private function updateExistingRoutes(Request $request, Destination $destination): void
    {
        if (!$request->has('existing_route')) {
            return;
        }

        $removeIds = $request->input('remove_route_ids', []);

        foreach ($request->input('existing_route') as $routeId => $item) {
            if (in_array($routeId, $removeIds)) {
                continue;
            }

            $route = $destination->routes()->find($routeId);

            if (!$route) {
                continue;
            }

            $route->update([
                'days' => $item['days'] ?? $route->days,
                'label' => $item['label'] ?? $route->label,
                'subtitle' => $item['subtitle'] ?? null,
                'path' => !empty($item['path']) ? array_map('trim', explode(',', $item['path'])) : null,
                'note' => $item['note'] ?? null,
            ]);
        }
    }

    private function syncRoutes(Request $request, Destination $destination): void
    {
        if (!$request->has('route')) {
            return;
        }

        foreach ($request->input('route') as $index => $item) {
            if (empty($item['days']) || empty($item['label'])) {
                continue; // skip empty rows
            }

            $destination->routes()->create([
                'days' => $item['days'],
                'label' => $item['label'],
                'subtitle' => $item['subtitle'] ?? null,
                'path' => !empty($item['path']) ? array_map('trim', explode(',', $item['path'])) : null,
                'note' => $item['note'] ?? null,
                'sort_order' => $destination->routes()->count() + $index,
            ]);
        }
    }

    // ---- Journey days ----
    private function updateExistingJourneyDays(Request $request, Destination $destination): void
    {
        if (!$request->has('existing_journey')) {
            return;
        }

        $removeIds = $request->input('remove_journey_ids', []);

        foreach ($request->input('existing_journey') as $dayId => $item) {
            if (in_array($dayId, $removeIds)) {
                continue;
            }

            $day = $destination->journeyDays()->find($dayId);

            if (!$day) {
                continue;
            }

            $data = [
                'day_number' => $item['day_number'] ?? $day->day_number,
                'title' => $item['title'] ?? $day->title,
                'flow_text' => $item['flow_text'] ?? null,
                'stay_text' => $item['stay_text'] ?? null,
                'food_text' => $item['food_text'] ?? null,
                'is_departure' => isset($item['is_departure']),
            ];

            if ($request->hasFile("existing_journey.$dayId.image")) {
                $this->deleteImage($day->image);
                $data['image'] = $request->file("existing_journey.$dayId.image")->store('destinations/journey', 'public');
            }

            $day->update($data);
        }
    }

    private function syncJourneyDays(Request $request, Destination $destination): void
    {
        if (!$request->has('journey')) {
            return;
        }

        foreach ($request->input('journey') as $index => $item) {
            if (empty($item['title'])) {
                continue;
            }

            $imagePath = null;

            if ($request->hasFile("journey.$index.image")) {
                $imagePath = $request->file("journey.$index.image")->store('destinations/journey', 'public');
            }

            $destination->journeyDays()->create([
                'day_number' => $item['day_number'] ?? null,
                'title' => $item['title'],
                'image' => $imagePath,
                'flow_text' => $item['flow_text'] ?? null,
                'stay_text' => $item['stay_text'] ?? null,
                'food_text' => $item['food_text'] ?? null,
                'is_departure' => isset($item['is_departure']),
                'sort_order' => $destination->journeyDays()->count() + $index,
            ]);
        }
    }

    private function syncSeasons(Request $request, Destination $destination): void
    {
        if (!$request->has('season')) {
            return;
        }

        $destination->seasons()->delete();

        foreach ($request->input('season') as $index => $item) {
            if (empty($item['name'])) {
                continue;
            }

            $destination->seasons()->create([
                'range_text' => $item['range_text'] ?? null,
                'name' => $item['name'],
                'description' => $item['description'] ?? null,
                'sort_order' => $index,
            ]);
        }
    }

    private function parseSeasonHighlights(Request $request): ?array
    {
        if (!$request->has('season_highlight')) {
            return null;
        }

        return collect($request->input('season_highlight'))
            ->filter(fn($item) => !empty($item['label']) && !empty($item['value']))
            ->values()
            ->all();
    }

    private function syncBudgetTiers(Request $request, Destination $destination): void
    {
        if (!$request->has('budget_tier')) {
            return;
        }

        $destination->budgetTiers()->delete();

        foreach ($request->input('budget_tier') as $index => $item) {
            if (empty($item['name'])) {
                continue;
            }

            $destination->budgetTiers()->create([
                'name' => $item['name'],
                'price_from' => $item['price_from'] ?? null,
                'price_to' => $item['price_to'] ?? null,
                'price_suffix' => $item['price_suffix'] ?? null,
                'description' => $item['description'] ?? null,
                'is_featured' => !empty($item['is_featured']),
                'badge_text' => $item['badge_text'] ?? null,
                'sort_order' => $index,
            ]);
        }
    }

    private function syncBudgetBreakdown(Request $request, Destination $destination): void
    {
        if (!$request->has('budget_breakdown')) {
            return;
        }

        $destination->budgetBreakdown()->delete();

        foreach ($request->input('budget_breakdown') as $index => $item) {
            if (empty($item['label']) || $item['percent'] === null) {
                continue;
            }

            $destination->budgetBreakdown()->create([
                'label' => $item['label'],
                'percent' => $item['percent'],
                'sort_order' => $index,
            ]);
        }
    }

    private function updateExistingFaqs(Request $request, Destination $destination): void
    {
        if (!$request->has('existing_faq')) {
            return;
        }

        $removeIds = $request->input('remove_faq_ids', []);

        foreach ($request->input('existing_faq') as $faqId => $item) {
            if (in_array($faqId, $removeIds)) {
                continue;
            }

            $faq = $destination->faqs()->find($faqId);

            if (!$faq) {
                continue;
            }

            $faq->update([
                'question' => $item['question'] ?? $faq->question,
                'answer' => $item['answer'] ?? $faq->answer,
            ]);
        }
    }

    private function syncFaqs(Request $request, Destination $destination): void
    {
        if (!$request->has('faq')) {
            return;
        }

        foreach ($request->input('faq') as $index => $item) {
            if (empty($item['question']) || empty($item['answer'])) {
                continue; // skip empty rows
            }

            $destination->faqs()->create([
                'question' => $item['question'],
                'answer' => $item['answer'],
                'sort_order' => $destination->faqs()->count() + $index,
            ]);
        }
    }
}