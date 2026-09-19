<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactPageController extends Controller
{
    /**
     * Singleton page — get it or create an empty row the first time
     * anyone opens the settings screen.
     */
    public function edit()
    {
        $contactPage = ContactPage::firstOrCreate([]);

        return view('admin.contact-page.edit', compact('contactPage'));
    }

    public function update(Request $request)
    {
        $contactPage = ContactPage::firstOrCreate([]);

        $validated = $request->validate([
            // ---- Banner ----
            'banner_image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,avif|max:5120',
            'banner_heading' => 'nullable|string|max:255',
            'banner_description' => 'nullable|string|max:1000',

            // ---- Get in touch ----
            'touch_heading' => 'nullable|string|max:255',
            'touch_description' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',

            // ---- Opening hours repeater ----
            'hours_ranges.*' => 'nullable|string|max:100',
            'hours_texts.*' => 'nullable|string|max:500',

            // ---- Offices repeater ----
            'office_headings.*' => 'nullable|string|max:255',
            'office_addresses.*' => 'nullable|string|max:500',
            'office_map_urls.*' => 'nullable|url|max:500',
            'office_map_embeds.*' => 'nullable|string|max:2000',

            // ---- FAQs repeater ----
            'faqs_heading' => 'nullable|string|max:255',
            'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers.*' => 'nullable|string',

            // ---- Promo ----
            'promo_eyebrow' => 'nullable|string|max:100',
            'promo_heading' => 'nullable|string|max:255',
            'promo_description' => 'nullable|string|max:500',
            'promo_image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,avif|max:5120',
        ]);

        $contactPage->fill($request->only([
            'banner_heading',
            'banner_description',
            'touch_heading',
            'touch_description',
            'phone',
            'email',
            'faqs_heading',
            'promo_eyebrow',
            'promo_heading',
            'promo_description',
        ]));

        // ---- Banner image ----
        if ($request->hasFile('banner_image')) {
            if ($contactPage->banner_image) {
                Storage::disk('public')->delete($contactPage->banner_image);
            }
            $contactPage->banner_image = $request->file('banner_image')->store('contact-page', 'public');
        }

        // ---- Promo image ----
        if ($request->hasFile('promo_image')) {
            if ($contactPage->promo_image) {
                Storage::disk('public')->delete($contactPage->promo_image);
            }
            $contactPage->promo_image = $request->file('promo_image')->store('contact-page', 'public');
        }

        // ---- Opening hours repeater ----
        $contactPage->opening_hours = $this->syncPairs(
            $request->input('hours_ranges', []),
            $request->input('hours_texts', []),
            'range',
            'text'
        );

        // ---- Offices repeater ----
        $contactPage->offices = $this->syncOffices($request);

        // ---- FAQs repeater ----
        $contactPage->faqs = $this->syncPairs(
            $request->input('faq_questions', []),
            $request->input('faq_answers', []),
            'question',
            'answer'
        );

        $contactPage->save();

        return redirect()
            ->route('admin.contact-page.edit')
            ->with('success', 'Contact page updated successfully.');
    }

    /**
     * Offices repeater — heading, address, map link, and map embed per entry.
     * No image upload involved, so this is a straightforward rebuild each save.
     */
    private function syncOffices(Request $request): array
    {
        $headings = $request->input('office_headings', []);
        $addresses = $request->input('office_addresses', []);
        $mapUrls = $request->input('office_map_urls', []);
        $mapEmbeds = $request->input('office_map_embeds', []);
        $offices = [];

        foreach ($headings as $index => $heading) {
            $heading = trim($heading);
            $address = trim($addresses[$index] ?? '');

            if ($heading === '' && $address === '') {
                continue;
            }

            $offices[] = [
                'heading' => $heading,
                'address' => $address,
                'map_url' => trim($mapUrls[$index] ?? ''),
                'map_embed_url' => trim($mapEmbeds[$index] ?? ''),
            ];
        }

        return $offices;
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