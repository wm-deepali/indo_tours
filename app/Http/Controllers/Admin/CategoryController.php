<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Attraction;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(20);
        return view('admin.category.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $validated['slug'] = Str::slug($request->name);
        $validated['status'] = $request->status ?? 'draft';

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }
        if ($request->hasFile('cta_image')) {
            $validated['cta_image'] = $request->file('cta_image')->store('categories/cta', 'public');
        }
        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('categories/og', 'public');
        }

        $category = Category::create($validated);
        $this->saveFacts($category, $request);
        $this->saveCtaPerks($category, $request);
        $this->saveFaqs($category, $request);

        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully.');
    }

    public function edit(Category $category)
    {
        $category->load(['facts', 'ctaPerks', 'faqs']);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate($this->rules());

        $validated['status'] = $request->status ?? $category->status;

        if ($request->hasFile('image')) {
            if ($category->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }
        if ($request->hasFile('cta_image')) {
            if ($category->cta_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($category->cta_image);
            }
            $validated['cta_image'] = $request->file('cta_image')->store('categories/cta', 'public');
        }
        if ($request->hasFile('og_image')) {
            if ($category->og_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($category->og_image);
            }
            $validated['og_image'] = $request->file('og_image')->store('categories/og', 'public');
        }

        $category->update($validated);
        $this->saveFacts($category, $request);
        $this->saveCtaPerks($category, $request);
        $this->saveFaqs($category, $request);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'menu_name' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'heading' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'detail_content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'nullable|in:draft,published,unpublished',

            'cta_title' => 'nullable|string|max:255',
            'cta_badge_text' => 'nullable|string|max:100',
            'cta_description' => 'nullable|string',
            'cta_button_text' => 'nullable|string|max:100',
            'cta_button_url' => 'nullable|string|max:255',
            'cta_button2_text' => 'nullable|string|max:100',
            'cta_button2_url' => 'nullable|string|max:255',
            'cta_image' => 'nullable|image|max:2048',

            'h1' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',
            'canonical_url' => 'nullable|string|max:255',

            'listing_eyebrow' => 'nullable|string|max:255',
            'listing_heading' => 'nullable|string|max:255',
            'listing_heading_highlight' => 'nullable|string|max:255',
            'listing_intro' => 'nullable|string',
            'listing_button_text' => 'nullable|string|max:100',
            'listing_button_url' => 'nullable|string|max:255',
            'listing_button2_text' => 'nullable|string|max:100',
            'listing_button2_url' => 'nullable|string|max:255',

            'promo_badge_text' => 'nullable|string|max:100',
            'promo_title' => 'nullable|string|max:255',
            'promo_description' => 'nullable|string',
            'promo_button_text' => 'nullable|string|max:100',
            'promo_button_url' => 'nullable|string|max:255',
            'promo_end_at' => 'nullable|date',

            'plan_heading' => 'nullable|string|max:255',
            'plan_heading_highlight' => 'nullable|string|max:255',
            'plan_intro' => 'nullable|string',

            'fact_ids' => 'nullable|array',
            'fact_ids.*' => 'nullable|integer',
            'fact_numbers' => 'nullable|array',
            'fact_numbers.*' => 'nullable|string|max:50',
            'fact_labels' => 'nullable|array',
            'fact_labels.*' => 'nullable|string|max:100',
            'deleted_facts' => 'nullable|string',

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

    private function saveFacts(Category $category, Request $request): void
    {
        if ($request->filled('deleted_facts')) {
            $ids = array_filter(explode(',', $request->deleted_facts));
            if (!empty($ids))
                $category->facts()->whereIn('id', $ids)->delete();
        }

        if (!$request->filled('fact_numbers'))
            return;

        foreach ($request->fact_numbers as $i => $number) {
            $label = $request->fact_labels[$i] ?? '';
            if (!$number && !$label)
                continue;

            $factId = $request->fact_ids[$i] ?? null;

            if ($factId) {
                $category->facts()->where('id', $factId)->update([
                    'number' => $number,
                    'label' => $label,
                    'sort_order' => $i,
                ]);
            } else {
                $category->facts()->create([
                    'number' => $number,
                    'label' => $label,
                    'sort_order' => $i,
                ]);
            }
        }
    }

    private function saveCtaPerks(Category $category, Request $request): void
    {
        if ($request->filled('deleted_perks')) {
            $ids = array_filter(explode(',', $request->deleted_perks));
            if (!empty($ids))
                $category->ctaPerks()->whereIn('id', $ids)->delete();
        }

        if (!$request->filled('perk_texts'))
            return;

        foreach ($request->perk_texts as $i => $text) {
            if (!$text)
                continue;

            $perkId = $request->perk_ids[$i] ?? null;

            if ($perkId) {
                $category->ctaPerks()->where('id', $perkId)->update([
                    'text' => $text,
                    'sort_order' => $i,
                ]);
            } else {
                $category->ctaPerks()->create([
                    'text' => $text,
                    'sort_order' => $i,
                ]);
            }
        }
    }

    private function saveFaqs(Category $category, Request $request): void
    {
        if ($request->filled('deleted_faqs')) {
            $ids = array_filter(explode(',', $request->deleted_faqs));
            if (!empty($ids))
                $category->faqs()->whereIn('id', $ids)->delete();
        }

        if (!$request->filled('faq_questions'))
            return;

        foreach ($request->faq_questions as $i => $question) {
            $answer = $request->faq_answers[$i] ?? '';
            if (!$question && !$answer)
                continue;

            $faqId = $request->faq_ids[$i] ?? null;

            if ($faqId) {
                $category->faqs()->where('id', $faqId)->update([
                    'question' => $question,
                    'answer' => $answer,
                    'sort_order' => $i,
                ]);
            } else {
                $category->faqs()->create([
                    'question' => $question,
                    'answer' => $answer,
                    'sort_order' => $i,
                ]);
            }
        }
    }

}