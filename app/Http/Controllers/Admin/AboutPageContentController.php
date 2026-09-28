<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutPageContentController extends Controller
{
    public function edit()
    {
        $content = AboutPageContent::instance();

        return view('admin.landing-pages.about-edit', compact('content'));
    }

    public function update(Request $request)
    {
        $content = AboutPageContent::instance();

        $request->validate([
            'banner_heading' => ['required', 'string', 'max:255'],
            'who_we_are_heading' => ['required', 'string', 'max:255'],
            'why_choose_heading' => ['required', 'string', 'max:255'],
            'mission_heading' => ['required', 'string', 'max:255'],
            'how_it_works_heading' => ['required', 'string', 'max:255'],
            'philosophy_heading' => ['required', 'string', 'max:255'],
            'team_heading' => ['required', 'string', 'max:255'],
            'testimonials_heading' => ['required', 'string', 'max:255'],
            'gallery_heading' => ['required', 'string', 'max:255'],
            'faq_heading' => ['required', 'string', 'max:255'],
        ]);

        $data = $request->only([
            'banner_heading', 'banner_description', 'banner_cta_text', 'banner_cta_url',
            'who_we_are_heading', 'who_we_are_description',
            'content_card_title', 'content_card_description_1', 'content_card_description_2',
            'content_card_cta_text', 'content_card_cta_url',
            'why_choose_heading', 'why_choose_description',
            'mission_heading', 'mission_description', 'mission_cta_text', 'mission_cta_url',
            'how_it_works_heading', 'how_it_works_description',
            'philosophy_eyebrow', 'philosophy_heading', 'philosophy_heading_highlight',
            'philosophy_description', 'philosophy_cta_text', 'philosophy_cta_url',
            'team_heading', 'team_description',
            'testimonials_heading', 'testimonials_description',
            'gallery_heading', 'gallery_description',
            'faq_heading',
        ]);

        // ---- Single file uploads ----
        $this->handleSingleFile($request, $content, $data, 'banner_video', 'about/banner');
        $this->handleSingleFile($request, $content, $data, 'banner_video_poster', 'about/banner');
        $this->handleSingleFile($request, $content, $data, 'content_card_image', 'about/content-card');
        $this->handleSingleFile($request, $content, $data, 'mission_image_one', 'about/mission');
        $this->handleSingleFile($request, $content, $data, 'mission_image_two', 'about/mission');
        $this->handleSingleFile($request, $content, $data, 'philosophy_image', 'about/philosophy');

        // ---- Repeaters ----
        $data['stats'] = $this->buildRepeater($request, 'stats', ['count', 'suffix', 'label'], 'icon', 'about/stats');
        $data['why_choose_items'] = $this->buildRepeater($request, 'why_choose_items', ['title', 'description'], 'icon', 'about/why-choose');
        $data['mission_features'] = $this->buildRepeater($request, 'mission_features', ['title', 'description'], 'icon', 'about/mission-features');
        $data['how_it_works_steps'] = $this->buildRepeater($request, 'how_it_works_steps', ['color', 'title', 'description']);
        $data['team_members'] = $this->buildRepeater($request, 'team_members', ['name', 'role', 'instagram_url', 'linkedin_url'], 'image', 'about/team');
        $data['gallery_items'] = $this->buildRepeater($request, 'gallery_items', ['title', 'location'], 'image', 'about/gallery');
        $data['faqs'] = $this->buildRepeater($request, 'faqs', ['question', 'answer']);

        $content->update($data);

        return redirect()
            ->route('admin.landing-pages.about.edit')
            ->with('success', 'About page content updated successfully.');
    }

    /** Handles one plain (non-repeater) file field, carrying the old value forward if no new file was uploaded. */
    private function handleSingleFile(Request $request, AboutPageContent $content, array &$data, string $field, string $folder): void
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
     * usps[title][], usps[description][], usps[icon][] (file), usps[existing_icon][].
     * $fields = plain text fields; $fileField = optional file field name; $folder = upload path.
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

            // Skip fully empty rows (no text filled, no file attached)
            $hasContent = collect($row)->filter(fn ($v) => !blank($v))->isNotEmpty();
            if ($hasContent) {
                $rows[] = $row;
            }
        }

        return $rows;
    }
}