<?php
// app/Http/Controllers/Admin/CategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    private const IMAGE_FIELDS = [
        'image' => 'categories',
        'cta_image' => 'categories/cta',
        'og_image' => 'categories/og',
        'twitter_card_image' => 'categories/twitter',
    ];

    // Returned by validate() but they are child-table data, never Category columns
    private const CHILD_KEYS = [
        'fact_ids',
        'fact_numbers',
        'fact_labels',
        'deleted_facts',
        'perk_ids',
        'perk_texts',
        'deleted_perks',
        'faq_ids',
        'faq_questions',
        'faq_answers',
        'deleted_faqs',
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
            : "Could not {$verb} the category. Nothing was saved. Please try again.";

        return $request->expectsJson()
            ? response()->json(['message' => $msg], 500)
            : back()->withInput()->with('error', $msg);
    }

    private function success(Request $request, string $message)
    {
        if ($request->expectsJson()) {
            session()->flash('success', $message);
            return response()->json(['redirect' => route('admin.categories.index')]);
        }

        return redirect()->route('admin.categories.index')->with('success', $message);
    }

    private function applySeoDefaults(array $v, string $slug): array
    {
        $name = $v['name'];
        $site = config('app.name');
        $body = trim(preg_replace('/\s+/', ' ', strip_tags(
            ($v['short_description'] ?? null) ?: ($v['listing_intro'] ?? null) ?: ($v['detail_content'] ?? '')
        )));

        $v['h1'] = ($v['h1'] ?? null) ?: $name;
        $v['meta_title'] = ($v['meta_title'] ?? null) ?: Str::limit($name . ($site ? ' | ' . $site : ''), 60, '');
        $v['meta_description'] = ($v['meta_description'] ?? null)
            ?: Str::limit($body ?: "Explore {$name} tour packages. Compare itineraries, hotels, inclusions and best prices, and book online.", 160, '');
        $v['og_title'] = ($v['og_title'] ?? null) ?: $v['meta_title'];
        $v['og_description'] = ($v['og_description'] ?? null) ?: $v['meta_description'];
        $v['twitter_title'] = ($v['twitter_title'] ?? null) ?: $v['og_title'];
        $v['twitter_description'] = ($v['twitter_description'] ?? null) ?: $v['og_description'];
        $v['canonical_url'] = ($v['canonical_url'] ?? null) ?: url('/category/' . $slug);
        $v['robots'] = ($v['robots'] ?? null) ?: 'index, follow';

        return $v;
    }

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
        $validated = $this->validatedData($request);

        try {
            DB::transaction(function () use ($request, $validated) {
                $validated['slug'] = $this->uniqueSlug($validated['name']);
                $validated['status'] = $request->status ?? 'draft';
                $validated['show_in_header'] = $request->boolean('show_in_header');
                $validated['header_sort_order'] = $validated['header_sort_order'] ?? 0;
                $validated = $this->applySeoDefaults($validated, $validated['slug']);

                foreach (self::IMAGE_FIELDS as $field => $dir) {
                    if ($request->hasFile($field)) {
                        $validated[$field] = $this->storeFile($request->file($field), $dir);
                    }
                }

                $category = Category::create($validated);
                $this->saveChildren($category, $request);
            });
        } catch (\Throwable $e) {
            $this->rollbackFiles();
            return $this->failure($request, $e, 'save');
        }

        $this->flushDeletes();

        return $this->success($request, 'Category added successfully.');
    }

    public function edit(Category $category)
    {
        $category->load(['facts', 'ctaPerks', 'faqs']);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $this->validatedData($request);

        try {
            DB::transaction(function () use ($request, $category, $validated) {
                $validated['status'] = $request->status ?? $category->status;
                $validated['show_in_header'] = $request->boolean('show_in_header');
                $validated['header_sort_order'] = $validated['header_sort_order'] ?? 0;
                $validated = $this->applySeoDefaults($validated, $category->slug);

                foreach (self::IMAGE_FIELDS as $field => $dir) {
                    if ($request->hasFile($field)) {
                        $this->queueDelete($category->{$field});
                        $validated[$field] = $this->storeFile($request->file($field), $dir);
                    }
                }

                $category->update($validated);
                $this->saveChildren($category, $request);
            });
        } catch (\Throwable $e) {
            $this->rollbackFiles();
            return $this->failure($request, $e, 'update');
        }

        $this->flushDeletes();

        return $this->success($request, 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        foreach (array_keys(self::IMAGE_FIELDS) as $field) {
            $this->queueDelete($category->{$field});
        }

        $category->delete();
        $this->flushDeletes();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate($this->rules(), [], $this->attributes());

        return Arr::except($validated, self::CHILD_KEYS);
    }

    private function saveChildren(Category $category, Request $request): void
    {
        $this->saveFacts($category, $request);
        $this->saveCtaPerks($category, $request);
        $this->saveFaqs($category, $request);
    }

    private function attributes(): array
    {
        return [
            'name' => 'category name',
            'header_sort_order' => 'header sort order',
            'fact_numbers.*' => 'fact number',
            'fact_labels.*' => 'fact label',
            'perk_texts.*' => 'perk text',
            'faq_questions.*' => 'FAQ question',
            'faq_answers.*' => 'FAQ answer',
        ];
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
            'show_in_header' => 'nullable|boolean',
            'header_sort_order' => 'nullable|integer|min:0',

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
            'robots' => [
                'nullable',
                'string',
                Rule::in([
                    'index, follow',
                    'noindex, follow',
                    'index, nofollow',
                    'noindex, nofollow',
                ]),
            ],
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string',
            'twitter_card_image' => 'nullable|image|max:2048',
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

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        while (
            Category::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }

    private function deleteMarked($relation, ?string $csv): void
    {
        if (!$csv) {
            return;
        }
        $ids = array_filter(explode(',', $csv));
        if (!empty($ids)) {
            $relation->whereIn('id', $ids)->delete();
        }
    }

    private function saveFacts(Category $category, Request $request): void
    {
        $this->deleteMarked($category->facts(), $request->deleted_facts);

        if (!$request->filled('fact_numbers')) {
            return;
        }

        foreach ($request->fact_numbers as $i => $number) {
            $label = $request->fact_labels[$i] ?? '';
            if (!$number && !$label) {
                continue;
            }

            $data = ['number' => $number, 'label' => $label, 'sort_order' => $i];
            $id = $request->fact_ids[$i] ?? null;

            $id
                ? $category->facts()->where('id', $id)->update($data)
                : $category->facts()->create($data);
        }
    }

    private function saveCtaPerks(Category $category, Request $request): void
    {
        $this->deleteMarked($category->ctaPerks(), $request->deleted_perks);

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
                ? $category->ctaPerks()->where('id', $id)->update($data)
                : $category->ctaPerks()->create($data);
        }
    }

    private function saveFaqs(Category $category, Request $request): void
    {
        $this->deleteMarked($category->faqs(), $request->deleted_faqs);

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
                ? $category->faqs()->where('id', $id)->update($data)
                : $category->faqs()->create($data);
        }
    }
}