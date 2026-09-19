<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActivityCategoryController extends Controller
{
    public function index()
    {
        $categories = ActivityCategory::orderBy('sort_order')->orderBy('name')->paginate(15);

        return view('admin.activity-category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.activity-category.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateCategory($request);

        $data['slug'] = $this->uniqueSlug($data['name']);
        $data['show_in_header'] = $request->boolean('show_in_header');
        $data['header_sort_order'] = $data['header_sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('activity-categories', 'public');
        }

        ActivityCategory::create($data);

        return redirect()->route('admin.activity-categories.index')
            ->with('success', 'Activity category created successfully.');
    }

    public function edit(ActivityCategory $activityCategory)
    {
        return view('admin.activity-category.edit', ['category' => $activityCategory]);
    }

    public function update(Request $request, ActivityCategory $activityCategory)
    {
        $data = $this->validateCategory($request, $activityCategory->id);

        $data['show_in_header'] = $request->boolean('show_in_header');
        $data['header_sort_order'] = $data['header_sort_order'] ?? 0;

        if ($data['name'] !== $activityCategory->name) {
            $data['slug'] = $this->uniqueSlug($data['name'], $activityCategory->id);
        }

        if ($request->hasFile('image')) {
            if ($activityCategory->image) {
                Storage::disk('public')->delete($activityCategory->image);
            }
            $data['image'] = $request->file('image')->store('activity-categories', 'public');
        }

        $activityCategory->update($data);

        return redirect()->route('admin.activity-categories.index')
            ->with('success', 'Activity category updated successfully.');
    }

    public function destroy(ActivityCategory $activityCategory)
    {
        if ($activityCategory->image) {
            Storage::disk('public')->delete($activityCategory->image);
        }

        $activityCategory->delete();

        return redirect()->route('admin.activity-categories.index')
            ->with('success', 'Activity category deleted successfully.');
    }

    private function validateCategory(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'show_in_header' => 'nullable|boolean',
            'header_sort_order' => 'nullable|integer|min:0',
        ]);
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 1;

        while (
            ActivityCategory::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}