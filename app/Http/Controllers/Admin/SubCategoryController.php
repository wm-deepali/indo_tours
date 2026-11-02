<?php
// app/Http/Controllers/Admin/SubCategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    private const IMAGE_FIELDS = [
        'banner_image_one' => 'subcategories/banner',
        'banner_image_two' => 'subcategories/banner',
        'cta_image' => 'subcategories/cta',
        'og_image' => 'subcategories/og',
        'twitter_card_image' => 'subcategories/twitter',
    ];

    // Returned by validate() but they are child-table data, never SubCategory columns
    private const CHILD_KEYS = [
        'highlight_ids', 'highlight_titles', 'highlight_values', 'highlight_images', 'deleted_highlights',
        'perk_ids', 'perk_texts', 'deleted_perks',
        'faq_ids', 'faq_questions', 'faq_answers', 'deleted_faqs',
    ];

    private array $pendingDeletes = [];   // old files, removed only after a successful commit
    private array $uploaded = [];         // new files, removed if the save fails

    private function storeFile($file, string $dir): string
    {
        $path = $file->store($dir, 'public');
        $this->uploaded[] = $path;
        return $path;
    }

    private function queueDelete(?string $path): void
    {
        if ($path) {
            $this->pendingDeletes[] = $path;
        }
    }

    private function flushDeletes(): void
    {
        foreach (array_unique($this->pendingDeletes) as $path) {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        $this->pendingDeletes = [];
        $this->uploaded = [];
    }

    private function rollbackFiles(): void
    {
        foreach ($this->uploaded as $path) {
            Storage::disk('public')->delete($path);
        }
        $this->pendingDeletes = [];
        $this->uploaded = [];
    }

    private function failure(Request $request, \Throwable $e, string $verb)
    {
        report($e);
        $msg = config('app.debug')
            ? $e->getMessage()
            : "Could not {$verb} the sub category. Nothing was saved. Please try again.";

        return $request->expectsJson()
            ? response()->json(['message' => $msg], 500)
            : back()->withInput()->with('error', $msg);
    }

    private function success(Request $request, string $message)
    {
        if ($request->expectsJson()) {
            session()->flash('success', $message);
            return response()->json(['redirect' => route('admin.subcategories.index')]);
        }

        return redirect()->route('admin.subcategories.index')->with('success', $message);
    }

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
        $validated = $this->validatedData($request);

        try {
            DB::transaction(function () use ($request, $validated) {
                $validated['slug'] = $this->uniqueSlug($validated['name']);
                $validated['status'] = $request->status ?? 'draft';
                $validated['show_in_header'] = $request->boolean('show_in_header');
                $validated['header_sort_order'] = $validated['header_sort_order'] ?? 0;

                foreach (self::IMAGE_FIELDS as $field => $dir) {
                    if ($request->hasFile($field)) {
                        $validated[$field] = $this->storeFile($request->file($field), $dir);
                    }
                }

                $subCategory = SubCategory::create($validated);
                $this->saveChildren($subCategory, $request);
            });
        } catch (\Throwable $e) {
            $this->rollbackFiles();
            return $this->failure($request, $e, 'save');
        }

        $this->flushDeletes();

        return $this->success($request, 'Sub Category added successfully.');
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
        $validated = $this->validatedData($request);

        try {
            DB::transaction(function () use ($request, $subcategory, $validated) {
                $validated['status'] = $request->status ?? $subcategory->status;
                $validated['show_in_header'] = $request->boolean('show_in_header');
                $validated['header_sort_order'] = $validated['header_sort_order'] ?? 0;

                foreach (self::IMAGE_FIELDS as $field => $dir) {
                    if ($request->hasFile($field)) {
                        $this->queueDelete($subcategory->{$field});
                        $validated[$field] = $this->storeFile($request->file($field), $dir);
                    }
                }

                $subcategory->update($validated);
                $this->saveChildren($subcategory, $request);
            });
        } catch (\Throwable $e) {
            $this->rollbackFiles();
            return $this->failure($request, $e, 'update');
        }

        $this->flushDeletes();

        return $this->success($request, 'Sub Category updated successfully.');
    }

    public function destroy(SubCategory $subcategory)
    {
        $subcategory->load('highlights');

        foreach (array_keys(self::IMAGE_FIELDS) as $field) {
            $this->queueDelete($subcategory->{$field});
        }
        foreach ($subcategory->highlights as $highlight) {
            $this->queueDelete($highlight->icon_image);
        }

        $subcategory->delete();
        $this->flushDeletes();

        return redirect()->route('admin.subcategories.index')->with('success', 'Sub Category deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate($this->rules(), [], $this->attributes());

        return Arr::except($validated, self::CHILD_KEYS);
    }

    private function saveChildren(SubCategory $subCategory, Request $request): void
    {
        $this->saveHighlights($subCategory, $request);
        $this->saveCtaPerks($subCategory, $request);
        $this->saveFaqs($subCategory, $request);
    }

    private function attributes(): array
    {
        return [
            'category_id' => 'parent category',
            'name' => 'sub category name',
            'header_sort_order' => 'header sort order',
            'highlight_titles.*' => 'highlight title',
            'highlight_values.*' => 'highlight value',
            'highlight_images.*' => 'highlight icon',
            'perk_texts.*' => 'perk text',
            'faq_questions.*' => 'FAQ question',
            'faq_answers.*' => 'FAQ answer',
        ];
    }

    private function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'status' => 'nullable|in:draft,published,unpublished',
            'show_in_header' => 'nullable|boolean',
            'header_sort_order' => 'nullable|integer|min:0',

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

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        while (
            SubCategory::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }

    private function deleteMarked($relation, ?string $csv, ?string $imageColumn = null): void
    {
        if (!$csv) {
            return;
        }
        $ids = array_filter(explode(',', $csv));
        if (empty($ids)) {
            return;
        }

        if ($imageColumn) {
            $relation->whereIn('id', $ids)->get()->each(fn($row) => $this->queueDelete($row->{$imageColumn}));
        }

        $relation->whereIn('id', $ids)->delete();
    }

    private function saveHighlights(SubCategory $subCategory, Request $request): void
    {
        $this->deleteMarked($subCategory->highlights(), $request->deleted_highlights, 'icon_image');

        if (!$request->filled('highlight_titles') && !$request->filled('highlight_values')) {
            return;
        }

        $values = $request->highlight_values ?? [];

        foreach (($request->highlight_titles ?? []) as $i => $title) {
            $value = $values[$i] ?? '';
            if (!$title && !$value) {
                continue;
            }

            $data = ['title' => $title, 'value' => $value, 'sort_order' => $i];
            $id = $request->highlight_ids[$i] ?? null;

            if ($request->hasFile("highlight_images.$i")) {
                if ($id) {
                    $this->queueDelete($subCategory->highlights()->find($id)?->icon_image);
                }
                $data['icon_image'] = $this->storeFile($request->file("highlight_images.$i"), 'subcategories/highlights');
            }

            $id
                ? $subCategory->highlights()->where('id', $id)->update($data)
                : $subCategory->highlights()->create($data);
        }
    }

    private function saveCtaPerks(SubCategory $subCategory, Request $request): void
    {
        $this->deleteMarked($subCategory->ctaPerks(), $request->deleted_perks);

        if (!$request->filled('perk_texts')) {
            return;
        }

        foreach ($request->perk_texts as $i => $text) {
            if (!$text) {
                continue;
            }

            $data = ['text' => $text, 'sort_order' => $i];
            $id = $request->perk_ids[$i] ?? null;

            $id
                ? $subCategory->ctaPerks()->where('id', $id)->update($data)
                : $subCategory->ctaPerks()->create($data);
        }
    }

    private function saveFaqs(SubCategory $subCategory, Request $request): void
    {
        $this->deleteMarked($subCategory->faqs(), $request->deleted_faqs);

        if (!$request->filled('faq_questions')) {
            return;
        }

        foreach ($request->faq_questions as $i => $question) {
            $answer = $request->faq_answers[$i] ?? '';
            if (!$question && !$answer) {
                continue;
            }

            $data = ['question' => $question, 'answer' => $answer, 'sort_order' => $i];
            $id = $request->faq_ids[$i] ?? null;

            $id
                ? $subCategory->faqs()->where('id', $id)->update($data)
                : $subCategory->faqs()->create($data);
        }
    }
}