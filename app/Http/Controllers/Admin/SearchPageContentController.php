<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SearchPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SearchPageContentController extends Controller
{
    public function edit()
    {
        $content = SearchPageContent::instance();

        return view('admin.search-page-content.edit', compact('content'));
    }

    public function update(Request $request)
    {
        $content = SearchPageContent::instance();

        $data = $request->validate([
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_description' => ['required', 'string'],
            'hero_image' => ['nullable', 'image', 'max:2048'],
            'usps' => ['required', 'array', 'min:1'],
            'usps.*.title' => ['required', 'string', 'max:255'],
            'usps.*.description' => ['required', 'string'],
            'usps.*.icon' => ['nullable', 'image', 'max:1024'],
            'usps.*.existing_icon' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('hero_image')) {
            if ($content->hero_image) {
                Storage::disk('public')->delete($content->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('search-page', 'public');
        } else {
            unset($data['hero_image']);
        }

        $usps = [];
        foreach ($request->input('usps') as $i => $usp) {
            $icon = $usp['existing_icon'] ?? null;

            if ($request->hasFile("usps.$i.icon")) {
                if ($icon) {
                    Storage::disk('public')->delete($icon);
                }
                $icon = $request->file("usps.$i.icon")->store('search-page/usps', 'public');
            }

            $usps[] = [
                'icon' => $icon,
                'title' => $usp['title'],
                'description' => $usp['description'],
            ];
        }
        $data['usps'] = $usps;

        $content->update($data);

        return redirect()
            ->route('admin.search-page-content.edit')
            ->with('success', 'Search page content updated successfully.');
    }
}