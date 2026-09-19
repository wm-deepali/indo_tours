<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AmenityController extends Controller
{
    public function index(Request $request)
    {
        $amenities = Amenity::query()
            ->when($request->filled('search'), fn($q) => $q->where('name', 'like', '%' . $request->search . '%'))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.amenity.index', compact('amenities'));
    }

    public function create()
    {
        return view('admin.amenity.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255|unique:amenities,name',
            'icon'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:1024',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('amenities', 'public');
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active']  = $request->boolean('is_active');

        Amenity::create($data);

        return redirect()->route('admin.amenities.index')->with('success', 'Amenity added successfully.');
    }

    public function edit(Amenity $amenity)
    {
        return view('admin.amenity.edit', compact('amenity'));
    }

    public function update(Request $request, Amenity $amenity)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255', Rule::unique('amenities', 'name')->ignore($amenity->id)],
            'icon'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:1024',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('icon')) {
            if ($amenity->icon) {
                Storage::disk('public')->delete($amenity->icon);
            }
            $data['icon'] = $request->file('icon')->store('amenities', 'public');
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active']  = $request->boolean('is_active');

        $amenity->update($data);

        return redirect()->route('admin.amenities.index')->with('success', 'Amenity updated successfully.');
    }

    public function destroy(Amenity $amenity)
    {
        if ($amenity->icon) {
            Storage::disk('public')->delete($amenity->icon);
        }

        // pivot rows are removed automatically (cascadeOnDelete)
        $amenity->delete();

        return redirect()->route('admin.amenities.index')->with('success', 'Amenity deleted.');
    }
}