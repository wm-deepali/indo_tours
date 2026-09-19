<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->paginate(15);

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validatePage($request);

        $validated['slug'] = $request->filled('slug')
            ? Page::generateUniqueSlug($request->input('slug'))
            : Page::generateUniqueSlug($request->input('title'));

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('pages/og', 'public');
        }

        if ($request->hasFile('twitter_card_image')) {
            $validated['twitter_card_image'] = $request->file('twitter_card_image')->store('pages/twitter', 'public');
        }

        Page::create($validated);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $this->validatePage($request, $page->id);

        if ($request->filled('slug') && $request->input('slug') !== $page->slug) {
            $validated['slug'] = Page::generateUniqueSlug($request->input('slug'), $page->id);
        } else {
            unset($validated['slug']);
        }

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('og_image')) {
            if ($page->og_image) {
                Storage::disk('public')->delete($page->og_image);
            }
            $validated['og_image'] = $request->file('og_image')->store('pages/og', 'public');
        }

        if ($request->hasFile('twitter_card_image')) {
            if ($page->twitter_card_image) {
                Storage::disk('public')->delete($page->twitter_card_image);
            }
            $validated['twitter_card_image'] = $request->file('twitter_card_image')->store('pages/twitter', 'public');
        }

        $page->update($validated);

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        if ($page->og_image) {
            Storage::disk('public')->delete($page->og_image);
        }

        if ($page->twitter_card_image) {
            Storage::disk('public')->delete($page->twitter_card_image);
        }

        $page->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }

    private function validatePage(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('pages', 'slug')->ignore($ignoreId),
            ],
            'content' => 'nullable|string',
            'is_active' => 'nullable|boolean',

            'h1' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'canonical_url' => 'nullable|url|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,avif|max:5120',
            'twitter_card_image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,avif|max:5120',
            'robots' => 'nullable|string|max:100',
        ]);
    }
}