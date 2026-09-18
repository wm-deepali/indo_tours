<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPageAttraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingPageAttractionController extends Controller
{
    public function edit()
    {
        $landingPage = LandingPageAttraction::firstOrCreate([]);

        return view('admin.landing-pages.attractions-edit', compact('landingPage'));
    }

    public function update(Request $request)
    {
        $landingPage = LandingPageAttraction::firstOrCreate([]);

        $request->validate([
            'hero_heading' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string|max:1000',
            'hero_video' => 'nullable|mimes:mp4,mov,webm|max:51200',

            'destinations_heading' => 'nullable|string|max:255',
            'destinations_description' => 'nullable|string|max:1000',

            'featured_heading' => 'nullable|string|max:255',
            'featured_description' => 'nullable|string|max:1000',

            'must_visit_heading' => 'nullable|string|max:255',
            'must_visit_description' => 'nullable|string|max:1000',

            'promo_eyebrow' => 'nullable|string|max:100',
            'promo_heading' => 'nullable|string|max:255',
            'promo_description' => 'nullable|string|max:1000',
            'promo_image' => 'nullable|image',
            'promo_primary_text' => 'nullable|string|max:100',
            'promo_primary_url' => 'nullable|string|max:255',
            'promo_secondary_text' => 'nullable|string|max:100',
            'promo_secondary_url' => 'nullable|string|max:255',

            'guides_heading' => 'nullable|string|max:255',
            'guides_description' => 'nullable|string|max:1000',
            'guide_categories.*' => 'nullable|string|max:100',
            'guide_titles.*' => 'nullable|string|max:150',
            'guide_descriptions.*' => 'nullable|string|max:500',
            'guide_link_urls.*' => 'nullable|string|max:255',
            'guide_images.*' => 'nullable|image',
            'guide_existing_images.*' => 'nullable|string',

            'faqs_heading' => 'nullable|string|max:255',
            'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers.*' => 'nullable|string',
        ]);

        $landingPage->fill($request->only([
            'hero_heading',
            'hero_description',
            'destinations_heading',
            'destinations_description',
            'featured_heading',
            'featured_description',
            'must_visit_heading',
            'must_visit_description',
            'promo_eyebrow',
            'promo_heading',
            'promo_description',
            'promo_primary_text',
            'promo_primary_url',
            'promo_secondary_text',
            'promo_secondary_url',
            'guides_heading',
            'guides_description',
            'faqs_heading',
        ]));

        if ($request->hasFile('hero_video')) {
            if ($landingPage->hero_video) {
                Storage::disk('public')->delete($landingPage->hero_video);
            }
            $landingPage->hero_video = $request->file('hero_video')->store('landing-pages/attractions', 'public');
        }

        if ($request->hasFile('promo_image')) {
            if ($landingPage->promo_image) {
                Storage::disk('public')->delete($landingPage->promo_image);
            }
            $landingPage->promo_image = $request->file('promo_image')->store('landing-pages/attractions', 'public');
        }

        $landingPage->guide_items = $this->syncGuideItems($request, $landingPage);

        $landingPage->faqs = $this->syncPairs(
            $request->input('faq_questions', []),
            $request->input('faq_answers', []),
            'question',
            'answer'
        );

        $landingPage->save();

        return redirect()
            ->route('admin.landing-pages.attraction.edit')
            ->with('success', 'Attractions landing page updated successfully.');
    }

    /**
     * Same carry-forward image pattern as LandingPageDestinationController's
     * experience/guide repeaters.
     */
    private function syncGuideItems(Request $request, LandingPageAttraction $landingPage): array
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
                $imagePath = $files[$index]->store('landing-pages/attractions/guides', 'public');
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
}