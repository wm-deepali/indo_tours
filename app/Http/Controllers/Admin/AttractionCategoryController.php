<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttractionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttractionCategoryController extends Controller
{
    public function index()
    {
        $categories = AttractionCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.attraction-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.attraction-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'image' => 'nullable|image',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:published,draft',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $category = new AttractionCategory();
        $category->fill($validated);
        $category->slug = $this->uniqueSlug($validated['name']);
        $category->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $category->image = $request->file('image')->store('attraction-categories', 'public');
        }

        $category->save();

        return redirect()
            ->route('admin.attraction-categories.index')
            ->with('success', 'Attraction category created successfully.');
    }

    public function edit(AttractionCategory $attractionCategory)
    {
        return view('admin.attraction-categories.edit', ['category' => $attractionCategory]);
    }

    public function update(Request $request, AttractionCategory $attractionCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'image' => 'nullable|image',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:published,draft',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $attractionCategory->fill($validated);
        $attractionCategory->sort_order = $validated['sort_order'] ?? 0;

        if ($validated['name'] !== $attractionCategory->getOriginal('name')) {
            $attractionCategory->slug = $this->uniqueSlug($validated['name'], $attractionCategory->id);
        }

        if ($request->hasFile('image')) {
            if ($attractionCategory->image) {
                Storage::disk('public')->delete($attractionCategory->image);
            }
            $attractionCategory->image = $request->file('image')->store('attraction-categories', 'public');
        }

        $attractionCategory->save();

        return redirect()
            ->route('admin.attraction-categories.index')
            ->with('success', 'Attraction category updated successfully.');
    }

    public function destroy(AttractionCategory $attractionCategory)
    {
        if ($attractionCategory->image) {
            Storage::disk('public')->delete($attractionCategory->image);
        }

        $attractionCategory->delete();

        return redirect()
            ->route('admin.attraction-categories.index')
            ->with('success', 'Attraction category deleted.');
    }

   private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        while (
            AttractionCategory::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }
}