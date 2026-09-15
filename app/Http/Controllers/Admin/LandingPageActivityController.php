<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPageActivity;
use Illuminate\Http\Request;
use App\Models\Attraction;
use Illuminate\Support\Facades\Storage;

class LandingPageActivityController extends Controller
{
    /**
     * This page has exactly one row — get it or create an empty one
     * the first time anyone opens the settings screen.
     */

    public function edit()
    {
        $landingPage = LandingPageActivity::firstOrCreate([]);
        $attractions = Attraction::where('status', 'active')->orderBy('name')->get();

        return view('admin.landing-pages.activities-edit', compact('landingPage', 'attractions'));
    }

    public function update(Request $request)
    {
        $landingPage = LandingPageActivity::firstOrCreate([]);

        $validated = $request->validate([
            // ---- Hero ----
            'hero_badge_text' => 'nullable|string|max:100',
            'hero_heading' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string|max:1000',
            'hero_cta_text' => 'nullable|string|max:100',
            'hero_cta_url' => 'nullable|string|max:255',
            'hero_slide_images.*' => 'nullable|image',
            'hero_slide_alts.*' => 'nullable|string|max:255',
            'hero_slide_existing_images.*' => 'nullable|string',

            // ---- Intro ----
            'intro_heading' => 'nullable|string|max:255',
            'intro_description' => 'nullable|string|max:1000',

            // ---- Offer Promo ----
            'offer_badge_text' => 'nullable|string|max:100',
            'offer_heading' => 'nullable|string|max:255',
            'offer_description' => 'nullable|string|max:1000',
            'offer_cta_text' => 'nullable|string|max:100',
            'offer_cta_url' => 'nullable|string|max:255',
            'offer_countdown_end' => 'nullable|date',

            // ---- Group Offer Banner ----
            'group_offer_badge_text' => 'nullable|string|max:100',
            'group_offer_heading' => 'nullable|string|max:255',
            'group_offer_description' => 'nullable|string|max:1000',
            'group_offer_perks.*' => 'nullable|string|max:255',
            'group_offer_cta1_text' => 'nullable|string|max:100',
            'group_offer_cta1_url' => 'nullable|string|max:255',
            'group_offer_cta2_text' => 'nullable|string|max:100',
            'group_offer_cta2_url' => 'nullable|string|max:255',
            'group_offer_image' => 'nullable|image',

            // ---- Planning Guide ----
            'planning_eyebrow' => 'nullable|string|max:100',
            'planning_heading' => 'nullable|string|max:255',
            'planning_block_titles.*' => 'nullable|string|max:255',
            'planning_block_contents.*' => 'nullable|string',

            // ---- Why Book With Us ----
            'benefits_heading' => 'nullable|string|max:255',
            'benefits_description' => 'nullable|string|max:1000',
            'benefit_icons.*' => 'nullable|string|max:50',
            'benefit_titles.*' => 'nullable|string|max:150',
            'benefit_descriptions.*' => 'nullable|string|max:500',

            // ---- Final CTA ----
            'final_cta_heading' => 'nullable|string|max:255',
            'final_cta_description' => 'nullable|string|max:1000',
            'final_cta1_text' => 'nullable|string|max:100',
            'final_cta1_url' => 'nullable|string|max:255',
            'final_cta2_text' => 'nullable|string|max:100',
            'final_cta2_url' => 'nullable|string|max:255',

            'related_destinations_heading' => 'nullable|string|max:255',
            'related_destinations_description' => 'nullable|string|max:1000',
            'related_destination_ids.*' => 'nullable|exists:attractions,id',

            'seo_links_heading' => 'nullable|string|max:255',
            'seo_links_description' => 'nullable|string|max:1000',
            'seo_block_headings.*' => 'nullable|string|max:150',
            'seo_link_texts.*.*' => 'nullable|string|max:150',
            'seo_link_urls.*.*' => 'nullable|string|max:255',
        ]);

        // Plain fields
        $landingPage->fill($request->only([
            'hero_badge_text',
            'hero_heading',
            'hero_description',
            'hero_cta_text',
            'hero_cta_url',
            'intro_heading',
            'intro_description',
            'offer_badge_text',
            'offer_heading',
            'offer_description',
            'offer_cta_text',
            'offer_cta_url',
            'offer_countdown_end',
            'group_offer_badge_text',
            'group_offer_heading',
            'group_offer_description',
            'group_offer_cta1_text',
            'group_offer_cta1_url',
            'group_offer_cta2_text',
            'group_offer_cta2_url',
            'planning_eyebrow',
            'planning_heading',
            'benefits_heading',
            'benefits_description',
            'final_cta_heading',
            'final_cta_description',
            'final_cta1_text',
            'final_cta1_url',
            'final_cta2_text',
            'final_cta2_url',
            'related_destinations_heading',
            'related_destinations_description',
            'seo_links_heading',
            'seo_links_description',
        ]));

        // Hero slider images (repeater with file upload + carried-over existing image)
        $landingPage->hero_slider_images = $this->syncSliderImages($request, $landingPage);

        // Group offer single image
        if ($request->hasFile('group_offer_image')) {
            if ($landingPage->group_offer_image) {
                Storage::disk('public')->delete($landingPage->group_offer_image);
            }
            $landingPage->group_offer_image = $request->file('group_offer_image')->store('landing-pages/activities', 'public');
        }

        // Simple list repeater
        $landingPage->group_offer_perks = $this->parseList($request->input('group_offer_perks', []));

        // title+content pairs
        $landingPage->planning_blocks = $this->syncPairs(
            $request->input('planning_block_titles', []),
            $request->input('planning_block_contents', []),
            'title',
            'content'
        );

        // Related destinations — picked Attraction IDs, order = row order
        $landingPage->related_destination_ids = collect($request->input('related_destination_ids', []))
            ->filter()
            ->values()
            ->all();

        // icon+title+description triples
        $landingPage->benefits_items = $this->syncBenefitItems($request);
        // SEO link blocks
        $landingPage->seo_link_blocks = $this->syncSeoLinkBlocks($request);

        $landingPage->save();

        return redirect()
            ->route('admin.landing-pages.activities.edit')
            ->with('success', 'Activities landing page updated successfully.');
    }

    /**
     * Hero slider repeater — each row may upload a new image or keep the
     * previous one via hero_slide_existing_images[idx]. Deletes only the
     * files that are being replaced/removed.
     */
    private function syncSliderImages(Request $request, LandingPageActivity $landingPage): array
    {
        if (!$request->has('hero_slide_alts') && !$request->hasFile('hero_slide_images')) {
            return $landingPage->hero_slider_images ?? [];
        }

        $existingPaths = collect($landingPage->hero_slider_images ?? [])->pluck('image')->filter()->all();
        $retained = array_filter($request->input('hero_slide_existing_images', []));

        foreach ($existingPaths as $path) {
            if (!in_array($path, $retained, true)) {
                Storage::disk('public')->delete($path);
            }
        }

        $alts = $request->input('hero_slide_alts', []);
        $files = $request->file('hero_slide_images', []);
        $slides = [];

        foreach ($alts as $index => $alt) {
            if (isset($files[$index]) && $files[$index]) {
                $imagePath = $files[$index]->store('landing-pages/activities/slides', 'public');
            } else {
                $imagePath = $request->input("hero_slide_existing_images.$index") ?: null;
            }

            if (!$imagePath) {
                continue; // skip slides with no image at all
            }

            $slides[] = ['image' => $imagePath, 'alt' => trim($alt)];
        }

        return $slides;
    }

    /**
     * icon (keyword) + title + description repeater for benefit cards.
     */
    private function syncBenefitItems(Request $request): array
    {
        $icons = $request->input('benefit_icons', []);
        $titles = $request->input('benefit_titles', []);
        $descriptions = $request->input('benefit_descriptions', []);
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
     * Generic title/content pair repeater (used by Planning Guide blocks).
     */
    private function syncPairs(array $titles, array $contents, string $titleKey, string $contentKey): array
    {
        $pairs = [];

        foreach ($titles as $index => $title) {
            $title = trim($title);
            $content = trim($contents[$index] ?? '');

            if ($title === '' && $content === '') {
                continue;
            }

            $pairs[] = [$titleKey => $title, $contentKey => $content];
        }

        return $pairs;
    }

    /**
     * SEO Links footer — each block has a heading and a repeater of
     * text+url link pairs. A block is skipped if it has no heading.
     */
    private function syncSeoLinkBlocks(Request $request): array
    {
        $headings = $request->input('seo_block_headings', []);
        $linkTexts = $request->input('seo_link_texts', []);
        $linkUrls = $request->input('seo_link_urls', []);
        $blocks = [];

        foreach ($headings as $blockIndex => $heading) {
            $heading = trim($heading);

            if ($heading === '') {
                continue;
            }

            $links = [];
            $texts = $linkTexts[$blockIndex] ?? [];
            $urls = $linkUrls[$blockIndex] ?? [];

            foreach ($texts as $linkIndex => $text) {
                $text = trim($text);
                $url = trim($urls[$linkIndex] ?? '');

                if ($text === '' || $url === '') {
                    continue;
                }

                $links[] = ['text' => $text, 'url' => $url];
            }

            if (empty($links)) {
                continue;
            }

            $blocks[] = ['heading' => $heading, 'links' => $links];
        }

        return $blocks;
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