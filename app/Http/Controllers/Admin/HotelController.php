<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class HotelController extends Controller
{

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name) ?: 'hotel';
        $original = $slug;
        $i = 1;

        while (
            Hotel::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }

    private function applySeoDefaults(array $d, string $slug): array
    {
        $name = $d['name'];
        $site = config('app.name');
        $body = trim(preg_replace('/\s+/', ' ', strip_tags($d['short_description'] ?? $d['description'] ?? '')));

        $d['h1'] = ($d['h1'] ?? null) ?: $name;
        $d['meta_title'] = ($d['meta_title'] ?? null) ?: Str::limit($name . ($site ? ' | ' . $site : ''), 60, '');
        $d['meta_description'] = ($d['meta_description'] ?? null)
            ?: Str::limit($body ?: "Book {$name}. Check rooms, facilities, photos and best prices.", 160, '');
        $d['canonical_url'] = ($d['canonical_url'] ?? null) ?: url('/hotel/' . $slug);
        $d['og_title'] = ($d['og_title'] ?? null) ?: $d['meta_title'];
        $d['og_description'] = ($d['og_description'] ?? null) ?: $d['meta_description'];

        return $d;
    }

    public function index()
    {
        $hotels = Hotel::with(['state', 'city', 'galleries'])->latest()->paginate(20);
        return view('admin.hotel.index', compact('hotels'));
    }

    public function create()
    {
        $countries = Country::orderBy('name')->get();
        [$states, $cities] = $this->locationLists(old('country_id'), old('state_id'));

        return view('admin.hotel.create', compact('countries', 'states', 'cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $data = $this->hotelData($request, $validated);
        $data['slug'] = $this->uniqueSlug($request->name);
        $data['status'] = $request->input('status', 'draft');
        $data = $this->applySeoDefaults($data, $data['slug']);

        DB::transaction(function () use ($data, $request) {
            $hotel = Hotel::create($data);
            $this->saveGalleryImages($hotel, $request);
            $this->syncRooms($hotel, $request);
        });

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel added successfully.');
    }

    public function edit(Hotel $hotel)
    {
        $hotel->load(['galleries', 'rooms.images', 'state', 'city']);

        $countries = Country::orderBy('name')->get();
        [$states, $cities] = $this->locationLists(
            old('country_id', $hotel->country_id),
            old('state_id', $hotel->state_id)
        );

        return view('admin.hotel.edit', compact('hotel', 'countries', 'states', 'cities'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate($this->rules());

        $data = $this->hotelData($request, $validated, $hotel);
        $data['status'] = $request->input('status', $hotel->status);
        $data = $this->applySeoDefaults($data, $hotel->slug);

        DB::transaction(function () use ($hotel, $data, $request) {
            $hotel->update($data);

            // remove selected gallery images (only ones that belong to this hotel)
            if ($request->filled('deleted_galleries')) {
                $ids = array_filter(explode(',', $request->deleted_galleries));
                foreach ($hotel->galleries()->whereIn('id', $ids)->get() as $img) {
                    $this->deleteFile($img->image);
                    $img->delete();
                }
            }

            $this->saveGalleryImages($hotel, $request);
            $this->syncRooms($hotel, $request);
        });

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully.');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->load(['galleries', 'rooms.images']);

        foreach ($hotel->galleries as $img) {
            $this->deleteFile($img->image);
        }
        foreach ($hotel->rooms as $room) {
            foreach ($room->images as $img) {
                $this->deleteFile($img->image);
            }
        }
        $this->deleteFile($hotel->og_image);
        $this->deleteFile($hotel->twitter_card_image);

        $hotel->rooms()->delete();      // room image rows go with them (FK cascade)
        $hotel->galleries()->delete();
        $hotel->delete();

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted successfully.');
    }

    /* ------------------------------------------------------------------ */

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'country_id' => 'nullable|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',

            'rating' => 'nullable|numeric|min:0|max:5',
            'star_rating' => 'nullable|integer|min:1|max:5',
            'category' => 'nullable|string|max:100',
            'check_in_time' => 'nullable',
            'check_out_time' => 'nullable',

            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'status' => 'nullable|in:draft,published,unpublished',

            'facilities' => 'nullable|array',
            'facilities.*' => 'nullable|string|max:255',

            'map_embed_url' => 'nullable|string',
            'map_directions_url' => 'nullable|url|max:2048',
            'map_points' => 'nullable|array',
            'map_points.*' => 'nullable|string|max:255',

            'h1' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:2048',
            'robots' => ['nullable', Rule::in(['index, follow', 'noindex, follow', 'noindex, nofollow'])],
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',
            'twitter_card_image' => 'nullable|image|max:2048',

            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|max:4096',

            'rooms' => 'nullable|array',
            'rooms.*.id' => 'nullable|integer',
            'rooms.*.name' => 'nullable|string|max:255',
            'rooms.*.room_type' => 'nullable|string|max:100',
            'rooms.*.description' => 'nullable|string',
            'rooms.*.max_adults' => 'nullable|integer|min:1|max:50',
            'rooms.*.max_children' => 'nullable|integer|min:0|max:50',
            'rooms.*.bed_type' => 'nullable|string|max:100',
            'rooms.*.room_size' => 'nullable|string|max:100',
            'rooms.*.amenities' => 'nullable|array',
            'rooms.*.amenities.*' => 'nullable|string|max:255',
            'rooms.*.old_price' => 'nullable|numeric|min:0',
            'rooms.*.price' => 'nullable|numeric|min:0',
            'rooms.*.price_unit' => 'nullable|string|max:50',
            'rooms.*.tax_note' => 'nullable|string|max:255',
            'rooms.*.keep_images' => 'nullable|array',
            'rooms.*.keep_images.*' => 'nullable|integer',
            'rooms.*.images' => 'nullable|array',
            'rooms.*.images.*' => 'nullable|image|max:4096',
        ];
    }

    private function locationLists($countryId, $stateId): array
    {
        $states = $countryId ? State::where('country_id', $countryId)->orderBy('name')->get() : collect();
        $cities = $stateId ? City::where('state_id', $stateId)->orderBy('name')->get() : collect();

        return [$states, $cities];
    }

    /** Everything that lives directly on the hotels row. */
    private function hotelData(Request $request, array $validated, ?Hotel $hotel = null): array
    {
        $data = Arr::except($validated, [
            'gallery_images',
            'rooms',
            'og_image',
            'twitter_card_image',
            'facilities',
            'map_points',
        ]);

        $data['facilities'] = $this->cleanList($request->input('facilities', []));
        $data['map_points'] = $this->cleanList($request->input('map_points', []));
        $data['map_embed_url'] = $this->extractEmbedUrl($validated['map_embed_url'] ?? null);
        $data['robots'] = $validated['robots'] ?? 'index, follow';

        foreach (['og_image', 'twitter_card_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($hotel) {
                    $this->deleteFile($hotel->{$field});
                }
                $data[$field] = $request->file($field)->store('hotels/seo', 'public');
            }
        }

        return $data;
    }

    /** Accepts a plain URL or a pasted <iframe ...> snippet; returns just a safe http(s) URL. */
    private function extractEmbedUrl(?string $value): ?string
    {
        if (!$value) {
            return null;
        }

        if (preg_match('/src=["\']([^"\']+)["\']/i', $value, $m)) {
            $value = html_entity_decode($m[1]);
        }

        $value = trim($value);

        return Str::startsWith($value, ['http://', 'https://']) ? $value : null;
    }

    private function cleanList($list): array
    {
        return array_values(array_filter(
            array_map(fn($v) => is_string($v) ? trim($v) : '', (array) $list),
            fn($v) => $v !== ''
        ));
    }

    private function saveGalleryImages(Hotel $hotel, Request $request): void
    {
        $files = (array) $request->file('gallery_images', []);
        if (!$files) {
            return;
        }

        $maxOrder = $hotel->galleries()->max('sort_order') ?? 0;

        foreach (array_values($files) as $i => $file) {
            if (!$file) {
                continue;
            }

            $path = $file->store('hotels/gallery', 'public');
            $hotel->galleries()->create([
                'image' => 'storage/' . $path,   // gallery keeps the existing "storage/..." convention
                'sort_order' => $maxOrder + $i + 1,
            ]);
        }
    }

    /**
     * Rooms are submitted as rooms[<n>][...]. A row with an id updates that room, a row without an id
     * creates one, and any existing room that is no longer submitted is deleted (with its images).
     * Rows with a blank name are ignored.
     */
    private function syncRooms(Hotel $hotel, Request $request): void
    {
        $keepRoomIds = [];
        $order = 0;

        foreach ((array) $request->input('rooms', []) as $key => $row) {
            $name = trim((string) ($row['name'] ?? ''));
            if ($name === '') {
                continue;
            }

            $payload = [
                'name' => $name,
                'room_type' => $row['room_type'] ?? null,
                'description' => $row['description'] ?? null,
                'max_adults' => max(1, (int) ($row['max_adults'] ?? 2)),
                'max_children' => max(0, (int) ($row['max_children'] ?? 0)),
                'bed_type' => $row['bed_type'] ?? null,
                'room_size' => $row['room_size'] ?? null,
                'amenities' => $this->cleanList($row['amenities'] ?? []),
                'old_price' => filled($row['old_price'] ?? null) ? $row['old_price'] : null,
                'price' => filled($row['price'] ?? null) ? $row['price'] : null,
                'price_unit' => ($row['price_unit'] ?? null) ?: 'per night',
                'tax_note' => $row['tax_note'] ?? null,
                'is_active' => isset($row['is_active']),
                'sort_order' => $order++,
            ];

            $room = !empty($row['id']) ? $hotel->rooms()->whereKey((int) $row['id'])->first() : null;

            if ($room) {
                $room->update($payload);
            } else {
                $room = $hotel->rooms()->create($payload);
            }

            $keepRoomIds[] = $room->id;

            // images the admin removed in the form
            $keepImageIds = array_map('intval', (array) ($row['keep_images'] ?? []));
            foreach ($room->images()->whereNotIn('id', $keepImageIds)->get() as $img) {
                $this->deleteFile($img->image);
                $img->delete();
            }

            // newly uploaded images
            $next = $room->images()->max('sort_order') ?? 0;
            foreach ((array) $request->file("rooms.$key.images", []) as $file) {
                if (!$file) {
                    continue;
                }
                $room->images()->create([
                    'image' => $file->store('hotels/rooms', 'public'),
                    'sort_order' => ++$next,
                ]);
            }
        }

        // rooms removed from the form
        foreach ($hotel->rooms()->whereNotIn('id', $keepRoomIds)->with('images')->get() as $room) {
            foreach ($room->images as $img) {
                $this->deleteFile($img->image);
            }
            $room->delete();
        }
    }

    /** Works for both "storage/hotels/x.jpg" (gallery) and "hotels/x.jpg" (rooms, SEO) paths. */
    private function deleteFile(?string $imagePath): void
    {
        if (!$imagePath) {
            return;
        }

        $relativePath = Str::startsWith($imagePath, 'storage/')
            ? Str::after($imagePath, 'storage/')
            : $imagePath;

        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }
}