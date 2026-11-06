{{-- resources/views/admin/hotel/_form.blade.php — shared by create.blade.php and edit.blade.php --}}
@php
    $isEdit = (bool) $hotel;

    $val = fn($f, $d = null) => old($f, optional($hotel)->{$f} ?? $d);

    $time = function ($f) use ($hotel) {
        $raw = old($f, optional($hotel)->{$f});
        return $raw ? \Carbon\Carbon::parse($raw)->format('H:i') : '';
    };

    $facilities = old('facilities', optional($hotel)->facilities ?? []);
    $mapPoints = old('map_points', optional($hotel)->map_points ?? []);

    if ($hotel) {
        $roomsData = $hotel->rooms->map(fn($r) => [
            'id' => $r->id,
            'name' => $r->name,
            'room_type' => $r->room_type,
            'description' => $r->description,
            'max_adults' => $r->max_adults,
            'max_children' => $r->max_children,
            'bed_type' => $r->bed_type,
            'room_size' => $r->room_size,
            'amenities' => $r->amenities ?? [],
            'old_price' => $r->old_price,
            'price' => $r->price,
            'price_unit' => $r->price_unit,
            'tax_note' => $r->tax_note,
            'is_active' => (bool) $r->is_active,
            'images' => $r->images->map(fn($i) => ['id' => $i->id, 'url' => asset('storage/' . $i->image)])->values(),
        ])->values();
    } else {
        // create page: only restores typed text after a failed validation (files can't be restored)
        $roomsData = collect(old('rooms', []))->map(fn($r) => [
            'id' => '',
            'name' => $r['name'] ?? '',
            'room_type' => $r['room_type'] ?? '',
            'description' => $r['description'] ?? '',
            'max_adults' => $r['max_adults'] ?? 2,
            'max_children' => $r['max_children'] ?? 0,
            'bed_type' => $r['bed_type'] ?? '',
            'room_size' => $r['room_size'] ?? '',
            'amenities' => $r['amenities'] ?? [],
            'old_price' => $r['old_price'] ?? '',
            'price' => $r['price'] ?? '',
            'price_unit' => $r['price_unit'] ?? 'per night',
            'tax_note' => $r['tax_note'] ?? '',
            'is_active' => isset($r['is_active']),
            'images' => [],
        ])->values();
    }

    $facilitySuggestions = [
        'Free WiFi',
        'Free Parking',
        'Restaurant',
        'Room Service',
        '24-Hour Front Desk',
        'Power Backup',
        'Swimming Pool',
        'Spa & Wellness',
        'Fitness Centre',
        'Airport Transfers',
        'Travel Desk',
        'Laundry Service',
        'Bonfire',
        'Garden / Lawn',
        'Conference Hall',
        'Elevator',
        'CCTV Security',
        'Pet Friendly',
    ];
@endphp

<style>
    :root {
        --bg: #f1f2f4;
        --surface: #ffffff;
        --border: #e3e5e8;
        --text-primary: #202223;
        --text-secondary: #6d7175;
        --text-hint: #8c9196;
        --accent: #303d89;
        --accent-light: #f0f1fc;
        --radius-sm: 8px;
        --radius-md: 12px;
        --shadow-card: 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 1px var(--border);
        --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .cat-page {
        background: var(--bg);
        padding: 24px 28px;
        min-height: 100vh;
        font-family: var(--font);
        color: var(--text-primary);
        box-sizing: border-box;
    }

    .cat-page * {
        box-sizing: border-box;
    }

    .cat-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
    }

    .cat-page-header h1 {
        font-size: 20px;
        font-weight: 650;
        margin: 0;
    }

    .cat-breadcrumb {
        font-size: 12.5px;
        color: var(--text-hint);
        margin-top: 3px;
    }

    .cat-breadcrumb a {
        color: var(--accent);
        text-decoration: none;
    }

    .cat-breadcrumb a:hover {
        text-decoration: underline;
    }

    .cat-breadcrumb span {
        margin: 0 5px;
    }

    .btn-primary-dash {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--accent);
        color: #fff !important;
        border: none;
        border-radius: var(--radius-sm);
        padding: 9px 18px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none !important;
        box-shadow: 0 1px 3px rgba(48, 61, 137, .25);
    }

    .btn-primary-dash:hover {
        background: #252f70;
    }

    .btn-secondary-dash {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--surface);
        color: var(--text-primary) !important;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 9px 18px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none !important;
    }

    .btn-secondary-dash:hover {
        background: var(--bg);
    }

    .cat-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-card);
        max-width: 100vw;
        overflow: hidden;
    }

    .form-field {
        margin-bottom: 18px;
    }

    .form-field label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        color: var(--text-secondary);
        margin-bottom: 6px;
        letter-spacing: .02em;
    }

    .form-field .hint {
        font-size: 11.5px;
        color: var(--text-hint);
        margin-top: 4px;
    }

    .form-control-styled {
        width: 100%;
        height: 40px;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 0 12px;
        font-size: 13.5px;
        font-family: var(--font);
        color: var(--text-primary);
        outline: none;
        transition: border-color .15s, box-shadow .15s;
        background: var(--surface);
    }

    textarea.form-control-styled {
        height: auto;
        padding: 10px 12px;
        resize: vertical;
    }

    select.form-control-styled {
        appearance: auto;
    }

    .form-control-styled:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(48, 61, 137, .12);
    }

    .form-control-styled[readonly] {
        background: var(--bg);
        color: var(--text-hint);
    }

    .form-error {
        color: #b22222;
        font-size: 12px;
        margin-top: 5px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 14px;
    }

    .form-row.cols-2 {
        grid-template-columns: 1fr 1fr;
    }

    .form-row.cols-4 {
        grid-template-columns: 1fr 1fr 1fr 1fr;
    }

    .toggle-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .switch {
        position: relative;
        width: 42px;
        height: 24px;
        flex-shrink: 0;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .switch-slider {
        position: absolute;
        inset: 0;
        background: var(--border);
        border-radius: 999px;
        cursor: pointer;
        transition: .15s;
    }

    .switch-slider::before {
        content: '';
        position: absolute;
        width: 18px;
        height: 18px;
        left: 3px;
        top: 3px;
        background: #fff;
        border-radius: 50%;
        transition: .15s;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
    }

    .switch input:checked+.switch-slider {
        background: var(--accent);
    }

    .switch input:checked+.switch-slider::before {
        transform: translateX(18px);
    }

    .form-actions {
        display: flex;
        gap: 10px;
        padding: 20px 24px;
        border-top: 1px solid var(--border);
        background: var(--surface);
    }

    .cat-tabs {
        display: flex;
        gap: 2px;
        padding: 0 24px;
        border-bottom: 1px solid var(--border);
        background: var(--surface);
        overflow-x: auto;
    }

    .cat-tab {
        appearance: none;
        background: none;
        border: none;
        border-bottom: 2px solid transparent;
        padding: 14px 16px;
        font-family: var(--font);
        font-size: 13px;
        font-weight: 600;
        color: var(--text-secondary);
        cursor: pointer;
        white-space: nowrap;
    }

    .cat-tab:hover {
        color: var(--text-primary);
    }

    .cat-tab.active {
        color: var(--accent);
        border-bottom-color: var(--accent);
    }

    .cat-tab-panel {
        display: none;
        padding: 24px;
    }

    .cat-tab-panel.active {
        display: block;
    }

    .form-alert {
        margin: 16px 24px 0;
        padding: 14px 16px;
        border: 1px solid #f1b5b5;
        background: #fff4f4;
        color: #8a1f1f;
        border-radius: var(--radius-sm);
        font-size: 13px;
    }

    .form-alert ul {
        margin: 6px 0 0;
        padding-left: 18px;
    }

    .sub-block-title {
        font-size: 14px;
        font-weight: 650;
        margin: 0 0 12px;
        padding-top: 4px;
    }

    .sub-block-title:not(:first-child) {
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
    }

    .gallery-row {
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 16px;
        margin-bottom: 14px;
        background: var(--bg);
    }

    .simple-list-row {
        display: flex;
        gap: 8px;
        margin-bottom: 8px;
    }

    .simple-list-row .form-control-styled {
        flex: 1;
    }

    .thumb-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
        gap: 12px;
        margin-bottom: 16px;
    }

    .thumb-item {
        position: relative;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        overflow: hidden;
        background: var(--bg);
    }

    .thumb-item img {
        width: 100%;
        height: 90px;
        object-fit: cover;
        display: block;
    }

    .thumb-remove {
        position: absolute;
        top: 6px;
        right: 6px;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 50%;
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #b22222;
        font-size: 12px;
        padding: 0;
    }

    .room-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .room-head strong {
        font-size: 13.5px;
    }

    .chip-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
    }

    .chip {
        border: 1px dashed var(--accent);
        background: var(--accent-light);
        color: var(--accent);
        border-radius: 999px;
        padding: 5px 12px;
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
        font-family: var(--font);
    }

    .chip:hover {
        background: #e4e6fa;
    }
</style>

<div class="cat-card">
    <form id="hotel-form" action="{{ $formAction }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @if($isEdit) @method('PUT') @endif

        @if($errors->any())
            <div class="form-alert" role="alert">
                <strong>Please fix the following:</strong>
                <ul>
                    @foreach($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="cat-tabs" id="hotel-tabs">
            <button type="button" class="cat-tab active" data-tab="general">General</button>
            <button type="button" class="cat-tab" data-tab="gallery">Gallery</button>
            <button type="button" class="cat-tab" data-tab="rooms">Rooms</button>
            <button type="button" class="cat-tab" data-tab="facilities">Facilities</button>
            <button type="button" class="cat-tab" data-tab="location">Location &amp; Map</button>
            <button type="button" class="cat-tab" data-tab="seo">SEO / Open Graph</button>
        </div>

        {{-- ============ GENERAL ============ --}}
        <div class="cat-tab-panel active" data-panel="general">

            <div class="form-field">
                <label for="name">Hotel Name</label>
                <input type="text" id="name" name="name" class="form-control-styled @error('name') is-invalid @enderror"
                    value="{{ $val('name') }}" placeholder="Enter hotel name" required>
                @error('name')
                <div class="form-error">{{ $message }}</div>@enderror
            </div>

            @if($isEdit)
                <div class="form-field">
                    <label for="slug">Slug</label>
                    <input type="text" id="slug" class="form-control-styled" readonly value="{{ $hotel->slug }}">
                    <div class="hint">Set when the hotel was created — the URL stays the same if you rename the hotel</div>
                </div>
            @endif

            <div class="form-row">
                <div class="form-field">
                    <label for="country_id">Country</label>
                    <select id="country_id" name="country_id" class="form-control-styled">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ $val('country_id') == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-field">
                    <label for="state_id">State</label>
                    <select id="state_id" name="state_id" class="form-control-styled" {{ $states->isEmpty() ? 'disabled' : '' }}>
                        <option value="">{{ $states->isEmpty() ? 'Select Country First' : 'Select State (optional)' }}
                        </option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}" {{ $val('state_id') == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-field">
                    <label for="city_id">City</label>
                    <select id="city_id" name="city_id" class="form-control-styled" {{ $cities->isEmpty() ? 'disabled' : '' }}>
                        <option value="">{{ $cities->isEmpty() ? 'Select State First' : 'Select City (optional)' }}
                        </option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ $val('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="star_rating">Star Rating</label>
                    <select id="star_rating" name="star_rating" class="form-control-styled">
                        <option value="">Not rated</option>
                        @for($s = 1; $s <= 5; $s++)
                            <option value="{{ $s }}" {{ $val('star_rating') == $s ? 'selected' : '' }}>{{ $s }}
                                Star{{ $s > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                    <div class="hint">Official hotel class (1–5 stars)</div>
                </div>
                <div class="form-field">
                    <label for="category">Hotel Category</label>
                    <input type="text" id="category" name="category" list="category-list" class="form-control-styled"
                        value="{{ $val('category') }}" placeholder="e.g. Luxury, Boutique, Resort">
                    <datalist id="category-list">
                        <option value="Budget">
                        <option value="Standard">
                        <option value="Premium">
                        <option value="Luxury">
                        <option value="Boutique">
                        <option value="Resort">
                        <option value="Heritage">
                        <option value="Homestay">
                    </datalist>
                    <div class="hint">Pick a suggestion or type your own</div>
                </div>
                <div class="form-field">
                    <label for="rating">Guest Rating</label>
                    <input type="number" id="rating" name="rating" step="0.1" min="0" max="5"
                        class="form-control-styled @error('rating') is-invalid @enderror" value="{{ $val('rating') }}"
                        placeholder="e.g. 4.5">
                    @error('rating')
                    <div class="form-error">{{ $message }}</div>@enderror
                    <div class="hint">Average guest score out of 5</div>
                </div>
            </div>

            <div class="form-row cols-2">
                <div class="form-field">
                    <label for="check_in_time">Check-In Time</label>
                    <input type="time" id="check_in_time" name="check_in_time" class="form-control-styled"
                        value="{{ $time('check_in_time') }}">
                </div>
                <div class="form-field">
                    <label for="check_out_time">Check-Out Time</label>
                    <input type="time" id="check_out_time" name="check_out_time" class="form-control-styled"
                        value="{{ $time('check_out_time') }}">
                </div>
            </div>

            <div class="form-field">
                <label for="location">Location Label</label>
                <input type="text" id="location" name="location" class="form-control-styled"
                    value="{{ $val('location') }}" placeholder="e.g. Near Dal Lake, Srinagar">
                <div class="hint">Short area / landmark line shown under the hotel name</div>
            </div>

            <div class="form-field">
                <label for="address">Full Address</label>
                <textarea id="address" name="address" rows="2" class="form-control-styled"
                    placeholder="Street, area, city, PIN">{{ $val('address') }}</textarea>
            </div>

            <div class="form-field">
                <label for="short_description">Short Description</label>
                <textarea id="short_description" name="short_description" rows="3" class="form-control-styled"
                    placeholder="One or two lines — shown on listing cards">{{ $val('short_description') }}</textarea>
            </div>

            <div class="form-field">
                <label for="description">About the Hotel</label>
                <textarea id="description" name="description" rows="8"
                    class="form-control-styled">{{ $val('description') }}</textarea>
                <div class="hint">Rich text — supports headings, lists, links and quotes</div>
            </div>

            <div class="form-field">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control-styled">
                    @foreach(['draft' => 'Draft', 'published' => 'Published', 'unpublished' => 'Unpublished'] as $k => $label)
                        <option value="{{ $k }}" {{ $val('status', 'draft') == $k ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- ============ GALLERY ============ --}}
        <div class="cat-tab-panel" data-panel="gallery">
            @if($isEdit && $hotel->galleries->count())
                <div class="thumb-grid" id="existing-gallery">
                    @foreach($hotel->galleries as $img)
                        <div class="thumb-item" data-id="{{ $img->id }}">
                            <img src="{{ asset($img->image) }}" alt="">
                            <button type="button" class="thumb-remove" data-id="{{ $img->id }}" title="Remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    @endforeach
                </div>
            @endif

            <input type="hidden" name="deleted_galleries" id="deleted_galleries" value="">

            <div class="form-field">
                <label for="gallery_input">{{ $isEdit ? 'Add Photos' : 'Hotel Photos' }}</label>
                <input type="file" id="gallery_input" name="gallery_images[]" class="form-control-styled"
                    accept="image/*" multiple>
                <div class="hint">Select several photos at once — the first image is used as the main picture and the
                    social-share fallback{{ $isEdit ? '. Click × on a current photo to remove it on save' : '' }}</div>
            </div>
            <div class="thumb-grid" id="gallery-preview"></div>
        </div>

        {{-- ============ ROOMS ============ --}}
        <div class="cat-tab-panel" data-panel="rooms">
            <div id="room-rows"></div>
            <button type="button" class="btn-secondary-dash" id="add-room-row"><i class="fa fa-plus"></i> Add Room
                Option</button>
            <div class="hint" style="margin-top:10px;">
                One block per room type (Standard, Deluxe, Super Deluxe, Suite…), each with its own photos, occupancy,
                amenities and price.
                Rooms are saved in the order shown. A room with no name is ignored, and a room removed here is deleted
                on save.
            </div>
            <datalist id="room-type-list">
                <option value="Standard">
                <option value="Deluxe">
                <option value="Super Deluxe">
                <option value="Suite">
                <option value="Executive">
                <option value="Family">
                <option value="Villa">
            </datalist>
        </div>

        {{-- ============ FACILITIES ============ --}}
        <div class="cat-tab-panel" data-panel="facilities">
            <h4 class="sub-block-title">Hotel Facilities &amp; Amenities</h4>
            <div class="hint" style="margin-bottom:10px;">Click a suggestion to add it, or add your own.</div>
            <div class="chip-list">
                @foreach($facilitySuggestions as $s)
                    <button type="button" class="chip" data-facility="{{ $s }}">+ {{ $s }}</button>
                @endforeach
            </div>
            <div id="facilities-list"></div>
            <button type="button" class="btn-secondary-dash add-simple-row" data-target="facilities-list"
                data-name="facilities[]" data-placeholder="e.g. Rooftop restaurant">
                <i class="fa fa-plus"></i> Add Facility
            </button>
        </div>

        {{-- ============ LOCATION & MAP ============ --}}
        <div class="cat-tab-panel" data-panel="location">
            <div class="form-field">
                <label for="map_embed_url">Google Maps Embed URL</label>
                <input type="text" id="map_embed_url" name="map_embed_url"
                    class="form-control-styled @error('map_embed_url') is-invalid @enderror"
                    value="{{ $val('map_embed_url') }}" placeholder="https://www.google.com/maps/embed?pb=...">
                <div class="hint">Google Maps → Share → Embed a map → paste either the whole &lt;iframe&gt; code or just
                    its src URL</div>
                @error('map_embed_url')
                <div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-field">
                <label for="map_directions_url">Directions Link</label>
                <input type="text" id="map_directions_url" name="map_directions_url"
                    class="form-control-styled @error('map_directions_url') is-invalid @enderror"
                    value="{{ $val('map_directions_url') }}" placeholder="https://maps.app.goo.gl/...">
                <div class="hint">Used by the "Get Directions" button</div>
                @error('map_directions_url')
                <div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-field">
                <label>Nearby / Location Points</label>
                <div id="map-points-list"></div>
                <button type="button" class="btn-secondary-dash add-simple-row" data-target="map-points-list"
                    data-name="map_points[]" data-placeholder="e.g. 5 min walk to Dal Lake">
                    <i class="fa fa-plus"></i> Add Point
                </button>
            </div>
        </div>

        {{-- ============ SEO ============ --}}
        <div class="cat-tab-panel" data-panel="seo">
            <div class="form-field">
                <label for="h1">H1 Tag</label>
                <input type="text" id="h1" name="h1" class="form-control-styled" value="{{ $val('h1') }}">
                <div class="hint">Auto-filled from Hotel Name. Edit to override</div>
            </div>

            <div class="form-field">
                <label for="meta_title">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title" class="form-control-styled"
                    value="{{ $val('meta_title') }}">
                <div class="hint">Auto-filled: Hotel Name | Site Name (ideal under 60 characters)</div>
            </div>

            <div class="form-field">
                <label for="meta_description">Meta Description</label>
                <textarea id="meta_description" name="meta_description" rows="3"
                    class="form-control-styled">{{ $val('meta_description') }}</textarea>
                <div class="hint">Auto-filled from Short Description / About (ideal under 160 characters)</div>
            </div>

            <div class="form-field">
                <label for="canonical_url">Canonical URL</label>
                <input type="text" id="canonical_url" name="canonical_url"
                    class="form-control-styled @error('canonical_url') is-invalid @enderror"
                    value="{{ $val('canonical_url') }}">
                <div class="hint">Auto-generated from the hotel name. Edit only if the page lives at a different URL
                </div>
                @error('canonical_url')
                <div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-field">
                <label for="robots">Robots</label>
                <select id="robots" name="robots" class="form-control-styled">
                    @foreach(['index, follow' => 'Index, Follow', 'noindex, follow' => 'No Index, Follow', 'noindex, nofollow' => 'No Index, No Follow'] as $k => $label)
                        <option value="{{ $k }}" {{ $val('robots', 'index, follow') == $k ? 'selected' : '' }}>{{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <h4 class="sub-block-title">Social Sharing (Open Graph / Twitter)</h4>

            <div class="form-field">
                <label for="og_title">OG Title</label>
                <input type="text" id="og_title" name="og_title" class="form-control-styled"
                    value="{{ $val('og_title') }}" placeholder="Auto-filled from Meta Title">
            </div>

            <div class="form-field">
                <label for="og_description">OG Description</label>
                <textarea id="og_description" name="og_description" rows="3" class="form-control-styled"
                    placeholder="Auto-filled from Meta Description">{{ $val('og_description') }}</textarea>
            </div>

            <div class="form-field">
                <label for="og_image">OG Image</label>
                @if($isEdit && $hotel->og_image)
                    <img src="{{ asset('storage/' . $hotel->og_image) }}" alt=""
                        style="width:72px;height:72px;object-fit:cover;border-radius:8px;border:1px solid var(--border);margin-bottom:10px;display:block;">
                @endif
                <input type="file" id="og_image" name="og_image" class="form-control-styled" accept="image/*">
                <div class="hint">{{ $isEdit ? 'Leave blank to keep the current image. ' : '' }}Blank = the first
                    gallery photo is used</div>
            </div>

            <div class="form-field">
                <label for="twitter_card_image">Twitter Card Image</label>
                @if($isEdit && $hotel->twitter_card_image)
                    <img src="{{ asset('storage/' . $hotel->twitter_card_image) }}" alt=""
                        style="width:72px;height:72px;object-fit:cover;border-radius:8px;border:1px solid var(--border);margin-bottom:10px;display:block;">
                @endif
                <input type="file" id="twitter_card_image" name="twitter_card_image" class="form-control-styled"
                    accept="image/*">
                <div class="hint">{{ $isEdit ? 'Leave blank to keep the current image. ' : '' }}Blank = OG Image / first
                    gallery photo is used</div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" id="save-btn" class="btn-primary-dash">
                <i class="fa fa-check"></i> {{ $submitLabel }}
            </button>
            <a href="{{ route('admin.hotels.index') }}" class="btn-secondary-dash">Cancel</a>
        </div>
    </form>
</div>

<script id="rooms-data" type="application/json">{!! json_encode($roomsData, JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
<script id="facilities-data"
    type="application/json">{!! json_encode(array_values((array) $facilities), JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
<script id="map-points-data"
    type="application/json">{!! json_encode(array_values((array) $mapPoints), JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    (function () {
        function esc(v) {
            if (v === null || v === undefined) return '';
            return String(v).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }
        function readJson(id) {
            try { return JSON.parse(document.getElementById(id).textContent) || []; } catch (e) { return []; }
        }

        // ---- Rich text ----
        let aboutEditor = null;
        if (window.CKEDITOR) {
            aboutEditor = CKEDITOR.replace('description', { height: 300 });
        }

        // ---- Tabs ----
        function showTab(name) {
            document.querySelectorAll('#hotel-tabs .cat-tab').forEach(b => b.classList.toggle('active', b.dataset.tab === name));
            document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.toggle('active', p.dataset.panel === name));
        }
        document.querySelectorAll('#hotel-tabs .cat-tab').forEach(function (btn) {
            btn.addEventListener('click', () => showTab(btn.dataset.tab));
        });
        (function focusFirstErrorTab() {
            const firstError = document.querySelector('.cat-tab-panel .form-error');
            if (!firstError) return;
            const panel = firstError.closest('.cat-tab-panel');
            if (panel) showTab(panel.dataset.panel);
        })();

        // ---- Cascading Country -> State -> City ----
        const countrySelect = document.getElementById('country_id');
        const stateSelect = document.getElementById('state_id');
        const citySelect = document.getElementById('city_id');

        countrySelect.addEventListener('change', function () {
            citySelect.innerHTML = '<option value="">Select State First</option>';
            citySelect.disabled = true;

            if (!this.value) {
                stateSelect.innerHTML = '<option value="">Select Country First</option>';
                stateSelect.disabled = true;
                return;
            }

            fetch(`{{ url('admin/location/states') }}/${this.value}`)
                .then(res => res.json())
                .then(states => {
                    stateSelect.innerHTML = '<option value="">Select State (optional)</option>';
                    states.forEach(s => { stateSelect.innerHTML += `<option value="${s.id}">${esc(s.name)}</option>`; });
                    stateSelect.disabled = false;
                });
        });

        stateSelect.addEventListener('change', function () {
            if (!this.value) {
                citySelect.innerHTML = '<option value="">Select State First</option>';
                citySelect.disabled = true;
                return;
            }

            fetch(`{{ url('admin/location/cities') }}/${this.value}`)
                .then(res => res.json())
                .then(cities => {
                    citySelect.innerHTML = '<option value="">Select City (optional)</option>';
                    cities.forEach(c => { citySelect.innerHTML += `<option value="${c.id}">${esc(c.name)}</option>`; });
                    citySelect.disabled = false;
                });
        });

        // ---- Gallery: remove existing + preview new ----
        const deletedGalleries = [];
        document.querySelectorAll('#existing-gallery .thumb-remove').forEach(function (btn) {
            btn.addEventListener('click', function () {
                deletedGalleries.push(this.dataset.id);
                document.getElementById('deleted_galleries').value = deletedGalleries.join(',');
                this.closest('.thumb-item').remove();
            });
        });

        document.getElementById('gallery_input').addEventListener('change', function () {
            const box = document.getElementById('gallery-preview');
            box.innerHTML = '';
            Array.from(this.files).forEach(function (file) {
                const item = document.createElement('div');
                item.className = 'thumb-item';
                item.innerHTML = '<img alt="">';
                item.querySelector('img').src = URL.createObjectURL(file);
                box.appendChild(item);
            });
        });

        // ---- Generic flat-list repeater (facilities / map points / room amenities) ----
        function addSimpleRow(container, inputName, placeholder, value) {
            const wrap = document.createElement('div');
            wrap.className = 'simple-list-row';
            wrap.innerHTML = `
                <input type="text" name="${inputName}" class="form-control-styled" placeholder="${esc(placeholder)}" value="${esc(value || '')}">
                <button type="button" class="btn-secondary-dash remove-simple-row"><i class="fa fa-times"></i></button>`;
            container.appendChild(wrap);
            wrap.querySelector('.remove-simple-row').addEventListener('click', () => wrap.remove());
            return wrap;
        }

        document.querySelectorAll('.add-simple-row').forEach(function (btn) {
            btn.addEventListener('click', function () {
                addSimpleRow(document.getElementById(this.dataset.target), this.dataset.name, this.dataset.placeholder);
            });
        });

        const facilitiesList = document.getElementById('facilities-list');
        readJson('facilities-data').forEach(v => addSimpleRow(facilitiesList, 'facilities[]', 'e.g. Rooftop restaurant', v));

        const mapPointsList = document.getElementById('map-points-list');
        const mapPoints = readJson('map-points-data');
        (mapPoints.length ? mapPoints : ['']).forEach(v => addSimpleRow(mapPointsList, 'map_points[]', 'e.g. 5 min walk to Dal Lake', v));

        // suggestion chips -> add facility once
        document.querySelectorAll('.chip[data-facility]').forEach(function (chip) {
            chip.addEventListener('click', function () {
                const name = this.dataset.facility;
                const exists = Array.from(facilitiesList.querySelectorAll('input')).some(i => i.value.trim().toLowerCase() === name.toLowerCase());
                if (!exists) addSimpleRow(facilitiesList, 'facilities[]', 'e.g. Rooftop restaurant', name);
            });
        });

        // ---- Rooms repeater ----
        let roomIdx = 0;

        function addRoomRow(d) {
            d = d || {};
            const i = roomIdx++;
            const row = document.createElement('div');
            row.className = 'gallery-row room-row';

            const thumbs = (d.images || []).map(im => `
                <div class="thumb-item">
                    <img src="${esc(im.url)}" alt="">
                    <input type="hidden" name="rooms[${i}][keep_images][]" value="${esc(im.id)}">
                    <button type="button" class="thumb-remove" title="Remove"><i class="fa fa-times"></i></button>
                </div>`).join('');

            row.innerHTML = `
                <input type="hidden" name="rooms[${i}][id]" value="${esc(d.id || '')}">

                <div class="room-head">
                    <strong>Room Option</strong>
                    <button type="button" class="btn-secondary-dash remove-room"><i class="fa fa-trash"></i> Remove Room</button>
                </div>

                <div class="form-row cols-2">
                    <div class="form-field">
                        <label>Room Name</label>
                        <input type="text" name="rooms[${i}][name]" class="form-control-styled" placeholder="e.g. Deluxe Room with Lake View" value="${esc(d.name)}">
                    </div>
                    <div class="form-field">
                        <label>Room Type</label>
                        <input type="text" name="rooms[${i}][room_type]" list="room-type-list" class="form-control-styled" placeholder="Standard / Deluxe / Super Deluxe / Suite" value="${esc(d.room_type)}">
                    </div>
                </div>

                <div class="form-field">
                    <label>Description</label>
                    <textarea name="rooms[${i}][description]" rows="3" class="form-control-styled">${esc(d.description)}</textarea>
                </div>

                <div class="form-row cols-4">
                    <div class="form-field">
                        <label>Max Adults</label>
                        <input type="number" min="1" name="rooms[${i}][max_adults]" class="form-control-styled" value="${esc(d.max_adults ?? 2)}">
                    </div>
                    <div class="form-field">
                        <label>Max Children</label>
                        <input type="number" min="0" name="rooms[${i}][max_children]" class="form-control-styled" value="${esc(d.max_children ?? 0)}">
                    </div>
                    <div class="form-field">
                        <label>Bed Type</label>
                        <input type="text" name="rooms[${i}][bed_type]" class="form-control-styled" placeholder="e.g. 1 King Bed" value="${esc(d.bed_type)}">
                    </div>
                    <div class="form-field">
                        <label>Room Size</label>
                        <input type="text" name="rooms[${i}][room_size]" class="form-control-styled" placeholder="e.g. 320 sq ft" value="${esc(d.room_size)}">
                    </div>
                </div>

                <div class="form-field">
                    <label>Room Amenities</label>
                    <div class="room-amenities"></div>
                    <button type="button" class="btn-secondary-dash add-room-amenity" style="margin-top:4px;"><i class="fa fa-plus"></i> Add Amenity</button>
                </div>

                <div class="form-row cols-4">
                    <div class="form-field">
                        <label>Old Price (optional)</label>
                        <input type="number" step="0.01" min="0" name="rooms[${i}][old_price]" class="form-control-styled" value="${esc(d.old_price)}">
                    </div>
                    <div class="form-field">
                        <label>Price</label>
                        <input type="number" step="0.01" min="0" name="rooms[${i}][price]" class="form-control-styled" value="${esc(d.price)}">
                    </div>
                    <div class="form-field">
                        <label>Price Unit</label>
                        <input type="text" name="rooms[${i}][price_unit]" class="form-control-styled" value="${esc(d.price_unit || 'per night')}">
                    </div>
                    <div class="form-field">
                        <label>Tax Note</label>
                        <input type="text" name="rooms[${i}][tax_note]" class="form-control-styled" placeholder="e.g. + taxes" value="${esc(d.tax_note)}">
                    </div>
                </div>

                <div class="form-field">
                    <label>Room Photos</label>
                    <div class="thumb-grid room-existing">${thumbs}</div>
                    <input type="file" name="rooms[${i}][images][]" class="form-control-styled" accept="image/*" multiple>
                    <div class="hint">Select several photos at once — the first one is the room's cover photo${(d.images || []).length ? '. Click × on a current photo to remove it on save' : ''}</div>
                </div>

                <div class="form-field toggle-row">
                    <label class="switch">
                        <input type="checkbox" name="rooms[${i}][is_active]" value="1" ${d.is_active === false ? '' : 'checked'}>
                        <span class="switch-slider"></span>
                    </label>
                    <label style="margin:0">Show this room on the website</label>
                </div>`;

            document.getElementById('room-rows').appendChild(row);

            const amenityBox = row.querySelector('.room-amenities');
            const amenities = (d.amenities && d.amenities.length) ? d.amenities : [''];
            amenities.forEach(a => addSimpleRow(amenityBox, `rooms[${i}][amenities][]`, 'e.g. Air conditioning', a));

            row.querySelector('.add-room-amenity').addEventListener('click', () => addSimpleRow(amenityBox, `rooms[${i}][amenities][]`, 'e.g. Air conditioning', ''));
            row.querySelector('.remove-room').addEventListener('click', () => row.remove());
            row.querySelectorAll('.room-existing .thumb-remove').forEach(btn => {
                btn.addEventListener('click', () => btn.closest('.thumb-item').remove());   // removing the hidden keep_images input = delete on save
            });
        }

        document.getElementById('add-room-row').addEventListener('click', () => addRoomRow());

        const existingRooms = readJson('rooms-data');
        if (existingRooms.length) {
            existingRooms.forEach(addRoomRow);
        } else {
            addRoomRow();
        }

        // ---- SEO auto-fill ----
        const SITE = @json(config('app.name'));
        const CANONICAL_BASE = @json(url('/hotel'));   // change to your hotel detail URL prefix
        const IS_EDIT = @json($isEdit);
        const SAVED_SLUG = @json($isEdit ? $hotel->slug : null);

        const SEO_AUTO_FIELDS = ['h1', 'meta_title', 'meta_description', 'canonical_url', 'og_title', 'og_description'];

        function seoPlain(html) {
            const tmp = document.createElement('div');
            tmp.innerHTML = html || '';
            return (tmp.textContent || '').replace(/\s+/g, ' ').trim();
        }
        function seoTrim(str, max) {
            if (str.length <= max) return str;
            return str.slice(0, max - 1).replace(/\s+\S*$/, '') + '…';
        }
        function seoVal(id) {
            const el = document.getElementById(id);
            return el ? el.value.trim() : '';
        }
        function seoSlug(s) {
            return s.toLowerCase().trim().replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
        }
        // Only fields still marked "auto" (empty, or filled by this script) get overwritten
        function seoSet(id, value) {
            const el = document.getElementById(id);
            if (!el || el.dataset.auto !== '1') return;
            el.value = value || '';
        }

        function seoAutoFill() {
            const name = seoVal('name');
            if (!name) return;

            const brand = SITE || 'Indo Tours & Adventures';
            const branded = `${name} | ${brand}`;
            const metaTitle = branded.length <= 60 ? branded : seoTrim(name, 60);

            const about = aboutEditor ? aboutEditor.getData() : seoVal('description');
            const source = seoPlain(seoVal('short_description') || about)
                || `Book ${name}${seoVal('location') ? ', ' + seoVal('location') : ''}. Check rooms, facilities, photos and best prices.`;
            const metaDesc = seoTrim(source, 160);

            const slug = IS_EDIT ? SAVED_SLUG : seoSlug(name);

            seoSet('h1', name);
            seoSet('meta_title', metaTitle);
            seoSet('meta_description', metaDesc);
            seoSet('canonical_url', slug ? CANONICAL_BASE.replace(/\/$/, '') + '/' + slug : '');
            seoSet('og_title', seoVal('meta_title') || metaTitle);
            seoSet('og_description', seoVal('meta_description') || metaDesc);
        }

        SEO_AUTO_FIELDS.forEach(function (id) {
            const el = document.getElementById(id);
            el.dataset.auto = el.value.trim() === '' ? '1' : '0';
            el.addEventListener('input', function () {
                el.dataset.auto = el.value.trim() === '' ? '1' : '0';
            });
        });

        let seoTimer;
        function seoAutoFillSoon() {
            clearTimeout(seoTimer);
            seoTimer = setTimeout(seoAutoFill, 300);
        }

        ['name', 'short_description', 'location', 'meta_title', 'meta_description'].forEach(function (id) {
            document.getElementById(id).addEventListener('input', seoAutoFillSoon);
        });
        if (aboutEditor) aboutEditor.on('change', seoAutoFillSoon);

        seoAutoFill(); // on load: fills any empty SEO field (also on old saved hotels)

        document.getElementById('hotel-form').addEventListener('submit', function () {
            if (window.CKEDITOR) {
                Object.keys(CKEDITOR.instances).forEach(k => CKEDITOR.instances[k].updateElement());
            }
            seoAutoFill();
        }, true);
    })();
</script>