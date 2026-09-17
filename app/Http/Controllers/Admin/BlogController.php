<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Attraction;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Destination;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::with('category')
            ->when($request->search, function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('slug', 'like', '%' . $request->search . '%');
            })
            ->when($request->blog_category_id, function ($q) use ($request) {
                $q->where('blog_category_id', $request->blog_category_id);
            })
            ->ordered()
            ->paginate(20)
            ->withQueryString();

        $categories = BlogCategory::active()->ordered()->get();

        return view('admin.blog.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        $blog = new Blog();

        return view('admin.blog.create', $this->formData($blog));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data = $this->handleUploads($request, $data);
        $data['author_id'] = auth('admin')->id();

        $blog = Blog::create($data);

        $this->syncRelations($request, $blog);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog added successfully.');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('admin.blog.edit', $this->formData($blog));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $data = $this->validateData($request, $blog->id);
        $data = $this->handleUploads($request, $data, $blog);

        $blog->update($data);

        $this->syncRelations($request, $blog);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        $this->deleteFile($blog->featured_image);
        $this->deleteFile($blog->og_image);
        $this->deleteFile($blog->twitter_card_image);

        $blog->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Blog deleted successfully.',
        ]);
    }

    public function toggleStatus(Request $request)
    {
        $blog = Blog::findOrFail($request->id);
        $blog->status = $blog->status === 'published' ? 'draft' : 'published';
        $blog->save();

        return response()->json([
            'status'     => true,
            'newStatus'  => $blog->status,
            'message'    => 'Status updated successfully.',
        ]);
    }

    /* ---------------- helpers ---------------- */

    private function formData(Blog $blog): array
    {
        return [
            'blog'         => $blog,
            'categories'   => BlogCategory::active()->ordered()->get(),
            'destinations' => Destination::orderBy('name')->get(),
            'attractions'  => Attraction::orderBy('name')->get(),
            'activities'   => Activity::orderBy('name')->get(),
            'tourPackages' => TourPackage::orderBy('name')->get(),
        ];
    }

    private function validateData(Request $request, $id = null): array
    {
        $rules = [
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title'             => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:blogs,slug' . ($id ? ',' . $id : ''),
            'tag'               => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:500',
            'content'           => 'nullable|string',
            'status'            => 'required|in:draft,published',
            'published_at'      => 'nullable|date',

            'destination_heading'     => 'nullable|string|max:255',
            'destination_description' => 'nullable|string|max:1000',
            'attraction_heading'      => 'nullable|string|max:255',
            'attraction_description'  => 'nullable|string|max:1000',
            'activity_heading'        => 'nullable|string|max:255',
            'activity_description'    => 'nullable|string|max:1000',
            'tour_package_heading'     => 'nullable|string|max:255',
            'tour_package_description' => 'nullable|string|max:1000',

            'featured_image'      => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
            'og_image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'twitter_card_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'h1'                => 'nullable|string|max:255',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
            'canonical_url'     => 'nullable|url|max:255|unique:blogs,canonical_url' . ($id ? ',' . $id : ''),
            'og_title'          => 'nullable|string|max:255',
            'og_description'    => 'nullable|string|max:500',
            'robots'            => 'nullable|string|max:50',
        ];

        $data = $request->validate($rules);

        $data['slug'] = $request->slug
            ? Str::slug($request->slug)
            : Blog::uniqueSlug($request->title, $id);

        $data['robots'] = $request->robots ?: 'index,follow';

        return $data;
    }

    private function handleUploads(Request $request, array $data, ?Blog $blog = null): array
    {
        $path = 'uploads/blog';

        foreach (['featured_image', 'og_image', 'twitter_card_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($blog) {
                    $this->deleteFile($blog->{$field});
                }
                $file = $request->file($field);
                $name = time() . '_' . $field . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($path), $name);
                $data[$field] = $path . '/' . $name;
            } else {
                unset($data[$field]);
            }
        }

        return $data;
    }

    private function syncRelations(Request $request, Blog $blog): void
    {
        $this->syncWithOrder($blog->destinations(), $request->input('destination_ids', []));
        $this->syncWithOrder($blog->attractions(), $request->input('attraction_ids', []));
        $this->syncWithOrder($blog->activities(), $request->input('activity_ids', []));
        $this->syncWithOrder($blog->tourPackages(), $request->input('tour_package_ids', []));
    }

    private function syncWithOrder($relation, array $ids): void
    {
        $sync = [];
        foreach (array_values($ids) as $index => $id) {
            $sync[$id] = ['sort_order' => $index];
        }
        $relation->sync($sync);
    }

    private function deleteFile(?string $file): void
    {
        if ($file && file_exists(public_path($file))) {
            @unlink(public_path($file));
        }
    }
}