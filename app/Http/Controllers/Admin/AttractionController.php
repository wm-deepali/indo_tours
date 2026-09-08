<?php
// app/Http/Controllers/Admin/AttractionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attraction;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
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

        $validated['h1'] = $validated['h1'] ?: $validated['name'];
        $validated['og_title'] = $validated['og_title'] ?: $validated['meta_title'];
        $validated['og_description'] = $validated['og_description'] ?: $validated['meta_description'];
        $validated['canonical_url'] = $validated['canonical_url'] ?: url('/attractions/' . $validated['slug']);

        $validated['best_for_tags'] = $this->parseTags($request->input('best_for_tags'));
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['status'] = $request->input('status', 'draft');

        Attraction::create($validated);

        return redirect()
            ->route('admin.attractions.index')
            ->with('success', 'Attraction created successfully.');
    }

    public function edit(Attraction $attraction)
    {
        $countries = Country::where('status', 'active')->orderBy('sort_order')->get();
        $states = State::where('country_id', $attraction->country_id)->orderBy('sort_order')->get();
        $cities = City::where('state_id', $attraction->state_id)->orderBy('sort_order')->get();

        return view('admin.attraction.edit', compact('attraction', 'countries', 'states', 'cities'));
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

        $validated['h1'] = $validated['h1'] ?: $validated['name'];
        $validated['og_title'] = $validated['og_title'] ?: $validated['meta_title'];
        $validated['og_description'] = $validated['og_description'] ?: $validated['meta_description'];
        $validated['canonical_url'] = $validated['canonical_url']
            ?: url('/attractions/' . ($validated['slug'] ?? $attraction->slug));

        $validated['best_for_tags'] = $this->parseTags($request->input('best_for_tags'));
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['status'] = $request->input('status', $attraction->status);

        $attraction->update($validated);

        return redirect()
            ->route('admin.attractions.index')
            ->with('success', 'Attraction updated successfully.');
    }

    public function destroy(Attraction $attraction)
    {
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
            'duration_text' => 'nullable|string|max:100',
            'best_time_text' => 'nullable|string|max:100',
            'rating' => 'nullable|numeric|min:0|max:5',
            'review_count' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'h1' => 'nullable|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',
            'canonical_url' => 'nullable|string|max:255',
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