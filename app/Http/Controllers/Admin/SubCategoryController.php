<?php
// app/Http/Controllers/Admin/SubCategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Attraction;


class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::with('category')->latest()->paginate(20);
        return view('admin.subcategory.index', compact('subCategories'));
    }


    public function create()
    {
        $categories = Category::orderBy('name')->get(['id', 'name']);
        return view('admin.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $validated['slug'] = Str::slug($request->name);
        $validated['status'] = $request->status ?? 'draft';

        if ($request->hasFile('banner_image_one')) {
            $validated['banner_image_one'] = $request->file('banner_image_one')->store('subcategories/banner', 'public');
        }
        if ($request->hasFile('banner_image_two')) {
            $validated['banner_image_two'] = $request->file('banner_image_two')->store('subcategories/banner', 'public');
        }
        if ($request->hasFile('cta_image')) {
            $validated['cta_image'] = $request->file('cta_image')->store('subcategories/cta', 'public');
        }
        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('subcategories/og', 'public');
        }
        if ($request->hasFile('twitter_card_image')) {
            $validated['twitter_card_image'] = $request->file('twitter_card_image')->store('subcategories/twitter', 'public');
        }

        $subCategory = SubCategory::create($validated);
        $this->saveHighlights($subCategory, $request);
        $this->saveCtaPerks($subCategory, $request);
        $this->saveFaqs($subCategory, $request);

        return redirect()->route('admin.subcategories.index')->with('success', 'Sub Category added successfully.');
    }

    public function edit(SubCategory $subcategory)
    {
        $subcategory->load(['highlights', 'ctaPerks', 'faqs']);
        $categories = Category::orderBy('name')->get(['id', 'name']);
        return view('admin.subcategory.edit', [
            'subCategory' => $subcategory,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, SubCategory $subcategory)
    {
        $validated = $request->validate($this->rules());

        $validated['status'] = $request->status ?? $subcategory->status;

        if ($request->hasFile('banner_image_one')) {
            $this->deleteOldImage($subcategory->banner_image_one);
            $validated['banner_image_one'] = $request->file('banner_image_one')->store('subcategories/banner', 'public');
        }
        if ($request->hasFile('banner_image_two')) {
            $this->deleteOldImage($subcategory->banner_image_two);
            $validated['banner_image_two'] = $request->file('banner_image_two')->store('subcategories/banner', 'public');
        }
        if ($request->hasFile('cta_image')) {
            $this->deleteOldImage($subcategory->cta_image);
            $validated['cta_image'] = $request->file('cta_image')->store('subcategories/cta', 'public');
        }
        if ($request->hasFile('og_image')) {
            $this->deleteOldImage($subcategory->og_image);
            $validated['og_image'] = $request->file('og_image')->store('subcategories/og', 'public');
        }
        if ($request->hasFile('twitter_card_image')) {
            $this->deleteOldImage($subcategory->twitter_card_image);
            $validated['twitter_card_image'] = $request->file('twitter_card_image')->store('subcategories/twitter', 'public');
        }

        $subcategory->update($validated);
        $this->saveHighlights($subcategory, $request);
        $this->saveCtaPerks($subcategory, $request);
        $this->saveFaqs($subcategory, $request);

        return redirect()->route('admin.subcategories.index')->with('success', 'Sub Category updated successfully.');
    }

    public function destroy(SubCategory $subcategory)
    {
        $this->deleteOldImage($subcategory->banner_image_one);
        $this->deleteOldImage($subcategory->banner_image_two);
        $this->deleteOldImage($subcategory->cta_image);
        $this->deleteOldImage($subcategory->og_image);
        $this->deleteOldImage($subcategory->twitter_card_image);

        $subcategory->delete();
        return redirect()->route('admin.subcategories.index')->with('success', 'Sub Category deleted successfully.');
    }

    private function deleteOldImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'status' => 'nullable|in:draft,published,unpublished',

            'offer_tag_text' => 'nullable|string|max:255',
            'h1' => 'nullable|string|max:255',
            'intro_text' => 'nullable|string',
            'banner_image_one' => 'nullable|image|max:2048',
            'banner_image_two' => 'nullable|image|max:2048',
            'button1_text' => 'nullable|string|max:100',
            'button1_url' => 'nullable|string|max:255',
            'button2_text' => 'nullable|string|max:100',
            'button2_url' => 'nullable|string|max:255',

            'heading_text' => 'nullable|string|max:255',
            'heading_highlight' => 'nullable|string|max:255',
            'heading_intro' => 'nullable|string',

            'cta_badge_text' => 'nullable|string|max:100',
            'cta_title' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string',
            'cta_image' => 'nullable|image|max:2048',
            'cta_button_text' => 'nullable|string|max:100',
            'cta_button_url' => 'nullable|string|max:255',
            'cta_button2_text' => 'nullable|string|max:100',
            'cta_button2_url' => 'nullable|string|max:255',

            'promo_badge_text' => 'nullable|string|max:100',
            'promo_title' => 'nullable|string|max:255',
            'promo_description' => 'nullable|string',
            'promo_button_text' => 'nullable|string|max:100',
            'promo_button_url' => 'nullable|string|max:255',
            'promo_end_at' => 'nullable|date',

            'faq_heading' => 'nullable|string|max:255',
            'faq_heading_highlight' => 'nullable|string|max:255',
            'faq_intro' => 'nullable|string',

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',
            'canonical_url' => 'nullable|string|max:255',
            'robots' => 'nullable|string|max:255',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string',
            'twitter_card_image' => 'nullable|image|max:2048',

            'highlight_ids' => 'nullable|array',
            'highlight_ids.*' => 'nullable|integer',
            'highlight_titles' => 'nullable|array',
            'highlight_titles.*' => 'nullable|string|max:100',
            'highlight_values' => 'nullable|array',
            'highlight_values.*' => 'nullable|string|max:100',
            'highlight_images' => 'nullable|array',
            'highlight_images.*' => 'nullable|image|max:1024',
            'deleted_highlights' => 'nullable|string',

            'perk_ids' => 'nullable|array',
            'perk_ids.*' => 'nullable|integer',
            'perk_texts' => 'nullable|array',
            'perk_texts.*' => 'nullable|string|max:255',
            'deleted_perks' => 'nullable|string',

            'faq_ids' => 'nullable|array',
            'faq_ids.*' => 'nullable|integer',
            'faq_questions' => 'nullable|array',
            'faq_questions.*' => 'nullable|string|max:255',
            'faq_answers' => 'nullable|array',
            'faq_answers.*' => 'nullable|string',
            'deleted_faqs' => 'nullable|string',
        ];
    }

    private function saveHighlights(SubCategory $subCategory, Request $request): void
    {
        if ($request->filled('deleted_highlights')) {
            $ids = array_filter(explode(',', $request->deleted_highlights));
            if (!empty($ids)) {
                $toDelete = $subCategory->highlights()->whereIn('id', $ids)->get();
                foreach ($toDelete as $h) {
                    $this->deleteOldImage($h->icon_image);
                }
                $subCategory->highlights()->whereIn('id', $ids)->delete();
            }
        }

        if (!$request->filled('highlight_titles') && !$request->filled('highlight_values'))
            return;

        $titles = $request->highlight_titles ?? [];
        $values = $request->highlight_values ?? [];

        foreach ($titles as $i => $title) {
            $value = $values[$i] ?? '';
            if (!$title && !$value)
                continue;

            $data = [
                'title' => $title,
                'value' => $value,
                'sort_order' => $i,
            ];

            $highlightId = $request->highlight_ids[$i] ?? null;

            if ($request->hasFile("highlight_images.$i")) {
                if ($highlightId) {
                    $existing = $subCategory->highlights()->find($highlightId);
                    if ($existing) {
                        $this->deleteOldImage($existing->icon_image);
                    }
                }
                $data['icon_image'] = $request->file("highlight_images.$i")->store('subcategories/highlights', 'public');
            }

            if ($highlightId) {
                $subCategory->highlights()->where('id', $highlightId)->update($data);
            } else {
                $subCategory->highlights()->create($data);
            }
        }
    }

    private function saveCtaPerks(SubCategory $subCategory, Request $request): void
    {
        if ($request->filled('deleted_perks')) {
            $ids = array_filter(explode(',', $request->deleted_perks));
            if (!empty($ids))
                $subCategory->ctaPerks()->whereIn('id', $ids)->delete();
        }

        if (!$request->filled('perk_texts'))
            return;

        foreach ($request->perk_texts as $i => $text) {
            if (!$text)
                continue;

            $perkId = $request->perk_ids[$i] ?? null;

            if ($perkId) {
                $subCategory->ctaPerks()->where('id', $perkId)->update([
                    'text' => $text,
                    'sort_order' => $i,
                ]);
            } else {
                $subCategory->ctaPerks()->create([
                    'text' => $text,
                    'sort_order' => $i,
                ]);
            }
        }
    }

    private function saveFaqs(SubCategory $subCategory, Request $request): void
    {
        if ($request->filled('deleted_faqs')) {
            $ids = array_filter(explode(',', $request->deleted_faqs));
            if (!empty($ids))
                $subCategory->faqs()->whereIn('id', $ids)->delete();
        }

        if (!$request->filled('faq_questions'))
            return;

        foreach ($request->faq_questions as $i => $question) {
            $answer = $request->faq_answers[$i] ?? '';
            if (!$question && !$answer)
                continue;

            $faqId = $request->faq_ids[$i] ?? null;

            if ($faqId) {
                $subCategory->faqs()->where('id', $faqId)->update([
                    'question' => $question,
                    'answer' => $answer,
                    'sort_order' => $i,
                ]);
            } else {
                $subCategory->faqs()->create([
                    'question' => $question,
                    'answer' => $answer,
                    'sort_order' => $i,
                ]);
            }
        }
    }

}