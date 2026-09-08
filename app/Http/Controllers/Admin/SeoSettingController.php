<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SeoSettingController extends Controller
{
    /**
     * List all pages with SEO settings.
     */
    public function index()
    {
        $seo_settings = SeoSetting::orderBy('page_label')->get();

        return view('admin.seo.index', compact('seo_settings'));
    }

    /**
     * Show the edit form for a single page's SEO settings.
     */
    public function edit(SeoSetting $seo_setting)
    {
        return view('admin.seo.edit', compact('seo_setting'));
    }

    /**
     * Update a single page's SEO settings.
     */
    public function update(Request $request, SeoSetting $seo_setting): RedirectResponse
    {
        $data = $request->validate([
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],

            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'image', 'max:2048'],

            'twitter_card_type' => ['required', 'in:summary,summary_large_image'],
            'twitter_title' => ['nullable', 'string', 'max:255'],
            'twitter_description' => ['nullable', 'string', 'max:500'],
            'twitter_image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('seo', 'public');
        } else {
            unset($data['og_image']);
        }

        if ($request->hasFile('twitter_image')) {
            $data['twitter_image'] = $request->file('twitter_image')->store('seo', 'public');
        } else {
            unset($data['twitter_image']);
        }

        $seo_setting->update($data);

        return redirect()
            ->route('admin.admin-setting.seo-setting.index')
            ->with('success', "SEO settings for \"{$seo_setting->page_label}\" saved successfully.");
    }
}