<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPageDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingPageDestinationController extends Controller
{
    /**
     * This page has exactly one row — get it or create an empty one
     * the first time anyone opens the settings screen.
     */
    public function edit()
    {
        $landingPage = LandingPageDestination::firstOrCreate([]);

        return view('admin.landing-pages.destinations-edit', compact('landingPage'));
    }

    public function update(Request $request)
    {
        $landingPage = LandingPageDestination::firstOrCreate([]);

        $validated = $request->validate([
            // ---- Hero ----
            'hero_heading' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string|max:1000',
            'hero_video' => 'nullable|mimes:mp4,mov,webm|max:51200',

            // ---- Destinations Grid ----
            'destinations_heading' => 'nullable|string|max:255',
            'destinations_description' => 'nullable|string|max:1000',

            // ---- Featured Tour Packages ----
            'packages_heading' => 'nullable|string|max:255',
            'packages_description' => 'nullable|string|max:1000',

            // ---- Why Travel Simple ----
            'why_travel_heading' => 'nullable|string|max:255',
            'why_travel_description' => 'nullable|string|max:1000',
            'why_icons.*' => 'nullable|string|max:50',
            'why_titles.*' => 'nullable|string|max:150',
            'why_descriptions.*' => 'nullable|string|max:500',

            // ---- Highlight Section ----
            'highlight_image' => 'nullable|image',
            'highlight_tag' => 'nullable|string|max:100',
            'highlight_heading' => 'nullable|string|max:255',
            'highlight_description' => 'nullable|string|max:1000',
            'highlight_points.*' => 'nullable|string|max:255',
            'highlight_cta_text' => 'nullable|string|max:100',
            'highlight_cta_url' => 'nullable|string|max:255',

            // ---- Experiences ----
            'experiences_heading' => 'nullable|string|max:255',
            'experiences_description' => 'nullable|string|max:1000',
            'experience_images.*' => 'nullable|image',
            'experience_existing_images.*' => 'nullable|string',
            'experience_titles.*' => 'nullable|string|max:150',
            'experience_descriptions.*' => 'nullable|string|max:500',
            'experience_link_urls.*' => 'nullable|string|max:255',

            // ---- Travel Guides ----
            'guides_heading' => 'nullable|string|max:255',
            'guides_description' => 'nullable|string|max:1000',
            'guide_images.*' => 'nullable|image',
            'guide_existing_images.*' => 'nullable|string',
            'guide_categories.*' => 'nullable|string|max:100',
            'guide_titles.*' => 'nullable|string|max:150',
            'guide_descriptions.*' => 'nullable|string|max:500',
            'guide_link_urls.*' => 'nullable|string|max:255',

            // ---- FAQs ----
            'faqs_heading' => 'nullable|string|max:255',
            'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers.*' => 'nullable|string',
        ]);

        // Plain fields
        $landingPage->fill($request->only([
            'hero_heading',
            'hero_description',
            'destinations_heading',
            'destinations_description',
            'packages_heading',
            'packages_description',
            'why_travel_heading',
            'why_travel_description',
            'highlight_tag',
            'highlight_heading',
            'highlight_description',
            'highlight_cta_text',
            'highlight_cta_url',
            'experiences_heading',
            'experiences_description',
            'guides_heading',
            'guides_description',
            'faqs_heading',
        ]));

        // Hero video
        if ($request->hasFile('hero_video')) {
            if ($landingPage->hero_video) {
                Storage::disk('public')->delete($landingPage->hero_video);
            }
            $landingPage->hero_video = $request->file('hero_video')->store('landing-pages/destinations', 'public');
        }

        // Highlight single image
        if ($request->hasFile('highlight_image')) {
            if ($landingPage->highlight_image) {
                Storage::disk('public')->delete($landingPage->highlight_image);
            }
            $landingPage->highlight_image = $request->file('highlight_image')->store('landing-pages/destinations', 'public');
        }

        // icon+title+description repeater (Why Travel Simple)
        $landingPage->why_travel_items = $this->syncBenefitItems($request);

        // simple list repeater
        $landingPage->highlight_points = $this->parseList($request->input('highlight_points', []));

        // image+fields repeaters
        $landingPage->experience_items = $this->syncExperienceItems($request, $landingPage);
        $landingPage->guide_items = $this->syncGuideItems($request, $landingPage);

        // question+answer pairs
        $landingPage->faqs = $this->syncPairs(
            $request->input('faq_questions', []),
            $request->input('faq_answers', []),
            'question',
            'answer'
        );

        $landingPage->save();

        return redirect()
            ->route('admin.landing-pages.destinations.edit')
            ->with('success', 'Destinations landing page updated successfully.');
    }

    /**
     * icon (keyword) + title + description repeater, same shape and icon
     * keyword set as the Activities landing page's "Why Book With Us".
     */
    private function syncBenefitItems(Request $request): array
    {
        $icons = $request->input('why_icons', []);
        $titles = $request->input('why_titles', []);
        $descriptions = $request->input('why_descriptions', []);
        $items = [];

        foreach ($titles as $index => $title) {
            $title = trim($title);

            if ($title === '') {
                continue;
            }

            $items[] = [
                'icon' => $icons[$index] ?? 'star',
                'title' => $title,
                'description' => trim($descriptions[$index] ?? ''),
            ];
        }

        return $items;
    }

    /**
     * Experiences repeater — each row may upload a new image or keep the
     * previous one via experience_existing_images[idx]. Same carry-forward
     * pattern as the hero slider on the Activities landing page.
     */
    private function syncExperienceItems(Request $request, LandingPageDestination $landingPage): array
    {
        if (!$request->has('experience_titles')) {
            return $landingPage->experience_items ?? [];
        }

        $existingPaths = collect($landingPage->experience_items ?? [])->pluck('image')->filter()->all();
        $retained = array_filter($request->input('experience_existing_images', []));

        foreach ($existingPaths as $path) {
            if (!in_array($path, $retained, true)) {
                Storage::disk('public')->delete($path);
            }
        }

        $titles = $request->input('experience_titles', []);
        $descriptions = $request->input('experience_descriptions', []);
        $linkUrls = $request->input('experience_link_urls', []);
        $files = $request->file('experience_images', []);
        $items = [];

        foreach ($titles as $index => $title) {
            $title = trim($title);

            if ($title === '') {
                continue;
            }

            if (isset($files[$index]) && $files[$index]) {
                $imagePath = $files[$index]->store('landing-pages/destinations/experiences', 'public');
            } else {
                $imagePath = $request->input("experience_existing_images.$index") ?: null;
            }

            $items[] = [
                'image' => $imagePath,
                'title' => $title,
                'description' => trim($descriptions[$index] ?? ''),
                'link_url' => trim($linkUrls[$index] ?? ''),
            ];
        }

        return $items;
    }

    /**
     * Travel Guides repeater — same carry-forward image pattern as above,
     * plus a category field.
     */
    private function syncGuideItems(Request $request, LandingPageDestination $landingPage): array
    {
        if (!$request->has('guide_titles')) {
            return $landingPage->guide_items ?? [];
        }

        $existingPaths = collect($landingPage->guide_items ?? [])->pluck('image')->filter()->all();
        $retained = array_filter($request->input('guide_existing_images', []));

        foreach ($existingPaths as $path) {
            if (!in_array($path, $retained, true)) {
                Storage::disk('public')->delete($path);
            }
        }

        $categories = $request->input('guide_categories', []);
        $titles = $request->input('guide_titles', []);
        $descriptions = $request->input('guide_descriptions', []);
        $linkUrls = $request->input('guide_link_urls', []);
        $files = $request->file('guide_images', []);
        $items = [];

        foreach ($titles as $index => $title) {
            $title = trim($title);

            if ($title === '') {
                continue;
            }

            if (isset($files[$index]) && $files[$index]) {
                $imagePath = $files[$index]->store('landing-pages/destinations/guides', 'public');
            } else {
                $imagePath = $request->input("guide_existing_images.$index") ?: null;
            }

            $items[] = [
                'image' => $imagePath,
                'category' => trim($categories[$index] ?? ''),
                'title' => $title,
                'description' => trim($descriptions[$index] ?? ''),
                'link_url' => trim($linkUrls[$index] ?? ''),
            ];
        }

        return $items;
    }

    private function syncPairs(array $a, array $b, string $keyA, string $keyB): array
    {
        $pairs = [];

        foreach ($a as $index => $valA) {
            $valA = trim($valA);
            $valB = trim($b[$index] ?? '');

            if ($valA === '' || $valB === '') {
                continue;
            }

            $pairs[] = [$keyA => $valA, $keyB => $valB];
        }

        return $pairs;
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