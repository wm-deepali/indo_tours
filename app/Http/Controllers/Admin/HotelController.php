<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelGallery;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with(['state', 'city'])->latest()->paginate(20);
        return view('admin.hotel.index', compact('hotels'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();
        return view('admin.hotel.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'country_id'         => 'nullable|exists:countries,id',
            'state_id'           => 'nullable|exists:states,id',
            'city_id'            => 'nullable|exists:cities,id',
            'rating'             => 'nullable|numeric|min:0|max:5',
            'check_in_time'      => 'nullable',
            'check_out_time'     => 'nullable',
            'short_description'  => 'nullable|string',
            'location'           => 'nullable|string|max:255',
            'status'             => 'nullable|in:draft,published,unpublished',
            'gallery_images'     => 'nullable|array',
            'gallery_images.*'   => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($request->name) . '-' . Str::random(5);
        $validated['status'] = $request->status ?? 'draft';

        $hotel = Hotel::create($validated);

        $this->saveGalleryImages($hotel, $request);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel added successfully.');
    }

    public function edit(Hotel $hotel)
    {
        $countries = Country::orderBy('name')->get();
        $hotel->load('galleries', 'state', 'city');
        return view('admin.hotel.edit', compact('hotel', 'countries'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:255',
            'country_id'         => 'nullable|exists:countries,id',
            'state_id'           => 'nullable|exists:states,id',
            'city_id'            => 'nullable|exists:cities,id',
            'rating'             => 'nullable|numeric|min:0|max:5',
            'check_in_time'      => 'nullable',
            'check_out_time'     => 'nullable',
            'short_description'  => 'nullable|string',
            'location'           => 'nullable|string|max:255',
            'status'             => 'nullable|in:draft,published,unpublished',
            'gallery_images'     => 'nullable|array',
            'gallery_images.*'   => 'nullable|image|max:2048',
        ]);

        $validated['status'] = $request->status ?? $hotel->status;

        $hotel->update($validated);

        // remove selected existing gallery images
        if ($request->filled('deleted_galleries')) {
            $ids = array_filter(explode(',', $request->deleted_galleries));
            foreach (HotelGallery::whereIn('id', $ids)->get() as $img) {
                if (file_exists(public_path($img->image))) {
                    unlink(public_path($img->image));
                }
                $img->delete();
            }
        }

        $this->saveGalleryImages($hotel, $request);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully.');
    }

    public function destroy(Hotel $hotel)
    {
        foreach ($hotel->galleries as $img) {
            if (file_exists(public_path($img->image))) {
                unlink(public_path($img->image));
            }
        }
        $hotel->delete();

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted successfully.');
    }

    private function saveGalleryImages(Hotel $hotel, Request $request): void
    {
        if (!$request->hasFile('gallery_images')) {
            return;
        }

        $maxOrder = $hotel->galleries()->max('sort_order') ?? 0;

        foreach ($request->file('gallery_images') as $i => $file) {
            if (!$file) continue;

            $path = $file->store('hotels/gallery', 'public'); // adjust disk as per your setup
            $hotel->galleries()->create([
                'image'      => 'storage/' . $path, // adjust based on your existing image path convention
                'sort_order' => $maxOrder + $i + 1,
            ]);
        }
    }
}