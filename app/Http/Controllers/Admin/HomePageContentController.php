<?php
// app/Http/Controllers/Admin/HomePageContentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageContent;
use App\Models\HomeTourSection;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class HomePageContentController extends Controller
{
    /** Allowed CSS classes for tour sections (keeps the old per-section styling). */
    private const TOUR_STYLES = [
        'home-secA'        => 'Style A (home-secA)',
        'home-secC'        => 'Style C (home-secC)',
        'home-secG'        => 'Style G (home-secG)',
        'home-secG home-secJ' => 'Style G + J (home-secG home-secJ)',
    ];

    public function edit()
    {
        $content = HomePageContent::instance();
        $tourSections = HomeTourSection::orderBy('sort_order')->get();
        $subCategories = SubCategory::orderBy('name')->get(['id', 'name']);
        $tourPlacements = HomeTourSection::PLACEMENTS;
        $tourStyles = self::TOUR_STYLES;

        return view('admin.landing-pages.home-edit', compact(
            'content', 'tourSections', 'subCategories', 'tourPlacements', 'tourStyles'
        ));
    }

    public function update(Request $request)
    {
        $content = HomePageContent::instance();

        $request->validate([
            'hero_heading' => ['required', 'string', 'max:255'],

            'tour_sections'                   => ['nullable', 'array'],
            'tour_sections.*.id'              => ['nullable', 'integer'],
            'tour_sections.*.title'           => ['nullable', 'string', 'max:255'],
            'tour_sections.*.highlight'       => ['nullable', 'string', 'max:255'],
            'tour_sections.*.description'     => ['nullable', 'string'],
            'tour_sections.*.sub_category_id' => ['nullable', 'integer', 'exists:sub_categories,id'],
            'tour_sections.*.limit'           => ['nullable', 'integer', 'min:1', 'max:20'],
            'tour_sections.*.view_all_url'    => ['nullable', 'string', 'max:255'],
            'tour_sections.*.placement'       => ['nullable', Rule::in(array_keys(HomeTourSection::PLACEMENTS))],
            'tour_sections.*.style_class'     => ['nullable', Rule::in(array_keys(self::TOUR_STYLES))],
            'tour_sections.*.is_active'       => ['nullable', 'boolean'],
        ]);

        $data = $request->only([
            'hero_eyebrow', 'hero_heading', 'hero_description',

            'promo_eyebrow', 'promo_heading', 'promo_cta_text', 'promo_cta_url',
            'promo_script_line_1', 'promo_script_line_2',

            'group_offer_badge_text', 'group_offer_heading', 'group_offer_description',
            'group_offer_cta1_text', 'group_offer_cta1_url', 'group_offer_cta2_text', 'group_offer_cta2_url',

            'who_we_are_badge', 'who_we_are_heading', 'who_we_are_heading_highlight', 'who_we_are_description',
            'who_we_are_cta_text', 'who_we_are_cta_url',

            'testimonials_heading', 'testimonials_description',

            'discount_strip_eyebrow', 'discount_strip_percent', 'discount_strip_label',
            'discount_strip_cta_text', 'discount_strip_cta_url',

            'support_heading', 'support_heading_highlight', 'support_description',

            'newsletter_eyebrow', 'newsletter_heading', 'newsletter_cta_text',
        ]);

        // ---- Single file uploads ----
        $this->handleSingleFile($request, $content, $data, 'hero_person_image', 'home/hero');
        $this->handleSingleFile($request, $content, $data, 'hero_illustration_image', 'home/hero');
        $this->handleSingleFile($request, $content, $data, 'promo_image', 'home/promo');
        $this->handleSingleFile($request, $content, $data, 'group_offer_image', 'home/group-offer');
        $this->handleSingleFile($request, $content, $data, 'who_we_are_image', 'home/who-we-are');
        $this->handleSingleFile($request, $content, $data, 'discount_strip_bg_image', 'home/discount-strip');
        $this->handleSingleFile($request, $content, $data, 'discount_strip_side_image', 'home/discount-strip');
        $this->handleSingleFile($request, $content, $data, 'support_image', 'home/support');
        $this->handleSingleFile($request, $content, $data, 'newsletter_phone_image', 'home/newsletter');

        // ---- Repeaters ----
        $data['group_offer_perks'] = array_values(array_filter($request->input('group_offer_perks', []), fn ($v) => !blank($v)));
        $data['who_we_are_stats'] = $this->buildRepeater($request, 'who_we_are_stats', ['count', 'label'], 'icon', 'home/who-we-are-stats');
        $data['home_slider_images'] = $this->buildRepeater($request, 'home_slider', ['alt'], 'image', 'home/slider');
        $data['support_items'] = $this->buildRepeater($request, 'support_items', ['title', 'description'], 'icon', 'home/support-items');

        $content->update($data);

        // ---- Tour sections (separate table) ----
        $this->syncTourSections($request);

        return redirect()
            ->route('admin.landing-pages.home.edit')
            ->with('success', 'Home page content updated successfully.');
    }

    /**
     * Syncs the submitted tour_sections[] rows with home_tour_sections:
     * rows with an id are updated, rows without are created, rows missing from the form are deleted.
     * Row order in the form = sort_order.
     */
    private function syncTourSections(Request $request): void
    {
        $rows = collect($request->input('tour_sections', []))
            ->filter(fn ($r) => !blank($r['title'] ?? null) || !blank($r['highlight'] ?? null))
            ->values();

        $keepIds = [];

        foreach ($rows as $i => $row) {
            $attrs = [
                'title'           => $row['title'] ?? 'Tours In',
                'highlight'       => $row['highlight'] ?? null,
                'description'     => $row['description'] ?? null,
                'sub_category_id' => !blank($row['sub_category_id'] ?? null) ? (int) $row['sub_category_id'] : null,
                'limit'           => (int) ($row['limit'] ?? 8) ?: 8,
                'view_all_url'    => $row['view_all_url'] ?? null,
                'placement'       => $row['placement'] ?? 'after_banner',
                'style_class'     => $row['style_class'] ?? 'home-secA',
                'is_active'       => (bool) ($row['is_active'] ?? false),
                'sort_order'      => $i,
            ];

            $section = !blank($row['id'] ?? null) ? HomeTourSection::find($row['id']) : null;

            if ($section) {
                $section->update($attrs);
            } else {
                $section = HomeTourSection::create($attrs);
            }

            $keepIds[] = $section->id;
        }

        HomeTourSection::whereNotIn('id', $keepIds)->delete();
    }

    /** Handles one plain (non-repeater) file field, carrying the old value forward if no new file was uploaded. */
    private function handleSingleFile(Request $request, HomePageContent $content, array &$data, string $field, string $folder): void
    {
        if ($request->hasFile($field)) {
            if ($content->$field) {
                Storage::disk('public')->delete($content->$field);
            }
            $data[$field] = $request->file($field)->store($folder, 'public');
        }
    }

    /**
     * Rebuilds a JSON repeater from parallel indexed inputs, e.g.
     * name_title[], name_description[], name_icon[] (file), name_existing_icon[].
     */
    private function buildRepeater(Request $request, string $prefix, array $fields, ?string $fileField = null, string $folder = ''): array
    {
        $count = 0;
        foreach ($fields as $field) {
            $count = max($count, count($request->input("{$prefix}_{$field}", [])));
        }
        if ($fileField) {
            $count = max($count, count($request->input("{$prefix}_existing_{$fileField}", [])));
        }

        $rows = [];
        for ($i = 0; $i < $count; $i++) {
            $row = [];
            foreach ($fields as $field) {
                $row[$field] = $request->input("{$prefix}_{$field}.$i");
            }

            if ($fileField) {
                $existing = $request->input("{$prefix}_existing_{$fileField}.$i");
                if ($request->hasFile("{$prefix}_{$fileField}.$i")) {
                    if ($existing) {
                        Storage::disk('public')->delete($existing);
                    }
                    $existing = $request->file("{$prefix}_{$fileField}.$i")->store($folder, 'public');
                }
                $row[$fileField] = $existing;
            }

            $hasContent = collect($row)->filter(fn ($v) => !blank($v))->isNotEmpty();
            if ($hasContent) {
                $rows[] = $row;
            }
        }

        return $rows;
    }
}