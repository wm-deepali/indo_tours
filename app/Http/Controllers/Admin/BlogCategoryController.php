<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = BlogCategory::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('slug', 'like', '%' . $request->search . '%');
            })
            ->ordered()
            ->paginate(20)
            ->withQueryString();

        return view('admin.blog-category.index', compact('categories'));
    }

    public function create()
    {
        $category = new BlogCategory();
        return view('admin.blog-category.create', compact('category'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data = $this->handleUpload($request, $data);

        BlogCategory::create($data);

        return redirect()->route('admin.blog-category.index')
            ->with('success', 'Blog category added successfully.');
    }

    public function edit($id)
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog-category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = BlogCategory::findOrFail($id);

        $data = $this->validateData($request, $category->id);
        $data = $this->handleUpload($request, $data, $category);

        $category->update($data);

        return redirect()->route('admin.blog-category.index')
            ->with('success', 'Blog category updated successfully.');
    }

    public function destroy($id)
    {
        $category = BlogCategory::findOrFail($id);

        if ($category->blogs()->exists()) {
            return response()->json([
                'status'  => false,
                'message' => 'This category has blogs attached. Move or delete those blogs first.',
            ]);
        }

        $this->deleteFile($category->image);
        $category->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Blog category deleted successfully.',
        ]);
    }

    public function toggleStatus(Request $request)
    {
        $category = BlogCategory::findOrFail($request->id);
        $category->status = ! $category->status;
        $category->save();

        return response()->json([
            'status'  => true,
            'checked' => $category->status,
            'message' => 'Status updated successfully.',
        ]);
    }

    private function validateData(Request $request, $id = null): array
    {
        $rules = [
            'name'       => 'required|string|max:255',
            'slug'       => 'nullable|string|max:255|unique:blog_categories,slug' . ($id ? ',' . $id : ''),
            'subtitle'   => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
        ];

        $data = $request->validate($rules);

        $data['slug']       = $request->slug ? Str::slug($request->slug) : BlogCategory::uniqueSlug($request->name, $id);
        $data['status']     = $request->boolean('status');
        $data['sort_order'] = $request->sort_order ?? 0;

        return $data;
    }

    private function handleUpload(Request $request, array $data, ?BlogCategory $category = null): array
    {
        if ($request->hasFile('image')) {
            if ($category) {
                $this->deleteFile($category->image);
            }
            $file = $request->file('image');
            $name = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blog-category'), $name);
            $data['image'] = 'uploads/blog-category/' . $name;
        } else {
            unset($data['image']);
        }

        return $data;
    }

    private function deleteFile(?string $file): void
    {
        if ($file && file_exists(public_path($file))) {
            @unlink(public_path($file));
        }
    }
}