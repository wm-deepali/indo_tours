{{-- resources/views/admin/tourpackage/create.blade.php --}}
@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    {{-- Select2 (searchable dropdowns). Remove this line if your admin layout already loads select2 CSS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

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

        .form-error {
            color: #b22222;
            font-size: 12px;
            margin-top: 5px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-row-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 14px;
        }

        .form-row-4 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 14px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            padding: 20px 24px;
            border-top: 1px solid var(--border);
            background: var(--surface);
            position: sticky;
            bottom: 0;
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

        .gallery-row {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 16px;
            margin-bottom: 14px;
            background: var(--bg);
        }

        .gallery-row .remove-new-row {
            margin-top: 10px;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--text-primary);
        }

        .checkbox-row input {
            width: auto;
            height: auto;
        }

        .amenity-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 10px;
        }

        .amenity-option {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            background: var(--surface);
            font-size: 13px;
            font-weight: 500;
            color: var(--text-primary);
            cursor: pointer;
        }

        .amenity-option input {
            width: auto;
            height: auto;
        }

        .amenity-option img {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }

        .amenity-option:has(input:checked) {
            border-color: var(--accent);
            background: var(--accent-light);
        }

        /* ---- Select2 (searchable dropdown) styling to match .form-control-styled ---- */
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            height: 40px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            background: var(--surface);
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px;
            padding-left: 12px;
            font-size: 13.5px;
            font-family: var(--font);
            color: var(--text-primary);
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px;
            right: 6px;
        }

        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--single {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(48, 61, 137, .12);
        }

        .select2-dropdown {
            border-color: var(--border);
            border-radius: var(--radius-sm);
            font-family: var(--font);
            font-size: 13.5px;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 6px 10px;
            outline: none;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected],
        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: var(--accent);
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

        .form-alert strong {
            display: block;
            margin-bottom: 6px;
        }

        .form-alert ul {
            margin: 0;
            padding-left: 18px;
        }

        .form-alert a {
            color: inherit;
            text-decoration: underline;
            cursor: pointer;
        }

        .form-control-styled.is-invalid {
            border-color: #b22222;
        }

        .select2-container.is-invalid .select2-selection--single {
            border-color: #b22222;
        }

        .btn-primary-dash[disabled] {
            opacity: .6;
            cursor: not-allowed;
        }

        .cat-tab .tab-badge {
            display: inline-block;
            margin-left: 6px;
            background: #b22222;
            color: #fff;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            padding: 1px 6px;
            vertical-align: middle;
        }

        .select2-container--default .select2-selection--multiple {
            min-height: 40px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            background: var(--surface);
            padding: 2px 6px;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple,
        .select2-container--default.select2-container--open .select2-selection--multiple {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(48, 61, 137, .12);
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: var(--accent-light);
            border: 1px solid var(--accent);
            color: var(--accent);
            border-radius: 6px;
            font-size: 12.5px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: var(--accent);
        }

        .select2-container.is-invalid .select2-selection--multiple {
            border-color: #b22222;
        }

        .bulk-box {
            margin-top: 16px;
            padding: 14px;
            border: 1px dashed var(--border);
            border-radius: var(--radius-sm);
            background: var(--surface);
        }

        .bulk-box textarea {
            margin-bottom: 10px;
        }

        .bulk-box .hint-inline {
            font-weight: 400;
            color: var(--text-hint);
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Add Tour Package</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.tourpackages.index') }}">Tour Packages</a>
                        <span>›</span>
                        Add
                    </div>
                </div>
                <a href="{{ route('admin.tourpackages.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form id="tp-form" action="{{ route('admin.tourpackages.store') }}" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf

                    <div id="form-alert" class="form-alert" style="display:none" role="alert"></div>

                    <div class="cat-tabs" id="tp-tabs">
                        <button type="button" class="cat-tab active" data-tab="general">General</button>
                        <button type="button" class="cat-tab" data-tab="banner">Banner</button>
                        <button type="button" class="cat-tab" data-tab="amenities">Amenities</button>
                        <button type="button" class="cat-tab" data-tab="duration">Duration Options</button>
                        <button type="button" class="cat-tab" data-tab="route">Route</button>
                        <button type="button" class="cat-tab" data-tab="overview">Overview</button>
                        <button type="button" class="cat-tab" data-tab="itinerary">Itinerary</button>
                        <button type="button" class="cat-tab" data-tab="hotels">Hotel Stays</button>
                        <button type="button" class="cat-tab" data-tab="incexc">Includes/Excludes</button>
                        <button type="button" class="cat-tab" data-tab="policies">Policies</button>
                        <button type="button" class="cat-tab" data-tab="faqsection">FAQs</button>
                        <button type="button" class="cat-tab" data-tab="map">Map</button>
                        <button type="button" class="cat-tab" data-tab="offers">Offers</button>
                        <button type="button" class="cat-tab" data-tab="destinations">Destinations</button>
                        <button type="button" class="cat-tab" data-tab="attractionslink">Attractions</button>
                        <button type="button" class="cat-tab" data-tab="activitieslink">Activities</button>
                        <button type="button" class="cat-tab" data-tab="seo">SEO / Open Graph</button>
                    </div>

                    {{-- ============ GENERAL ============ --}}
                    <div class="cat-tab-panel active" data-panel="general">

                        <div class="form-field">
                            <label for="sub_category_ids">Categories / Sub Categories</label>
                            <select id="sub_category_ids" name="sub_category_ids[]" multiple
                                data-placeholder="Select one or more sub categories"
                                style="height:auto;min-height:40px;"
                                class="form-control-styled searchable-select @error('sub_category_ids') is-invalid @enderror"
                                required>
                                @php $selectedSubs = old('sub_category_ids', []); @endphp
                                @foreach($subCategories as $categoryName => $subs)
                                    <optgroup label="{{ $categoryName }}">
                                        @foreach($subs as $sc)
                                            <option value="{{ $sc->id }}" {{ in_array($sc->id, $selectedSubs) ? 'selected' : '' }}>{{ $sc->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            <div class="hint">Pick every sub category this package belongs to. The first one in the list
                                is used as the primary.</div>
                            @error('sub_category_ids')
                                <div class="form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-field">
                            <label for="name">Package Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control-styled @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="e.g. Leh Ladakh Expedition" required>
                            @error('name')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" name="slug_preview" class="form-control-styled" readonly
                                placeholder="Auto-generated from name">
                            <div class="hint">Generated automatically on save</div>
                        </div>

                        <div class="form-field">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control-styled">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published
                                </option>
                                <option value="unpublished" {{ old('status') == 'unpublished' ? 'selected' : '' }}>
                                    Unpublished</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label class="checkbox-row">
                                <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                                Featured (show in "Explore Our Tour Packages" on the Destinations landing page)
                            </label>
                        </div>

                        <div class="form-field">
                            <label>Location</label>
                            <div class="form-row-3">
                                <div>
                                    <select id="country_id" name="country_id"
                                        class="form-control-styled searchable-select">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <select id="state_id" name="state_id" class="form-control-styled searchable-select">
                                        <option value="">Select State</option>
                                    </select>
                                </div>
                                <div>
                                    <select id="city_id" name="city_id" class="form-control-styled searchable-select">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hint">Displayed on the detail page as "City, State, Country"</div>
                        </div>

                        @include('admin.tourpackage._duration-fields', ['package' => null])

                        <div class="form-row">
                            <div class="form-field">
                                <label for="old_price">Old Price (₹)</label>
                                <input type="number" step="0.01" id="old_price" name="old_price"
                                    class="form-control-styled" value="{{ old('old_price') }}" placeholder="e.g. 29500">
                            </div>
                            <div class="form-field">
                                <label for="price">Current Price (₹)</label>
                                <input type="number" step="0.01" id="price" name="price" class="form-control-styled"
                                    value="{{ old('price') }}" placeholder="e.g. 22900">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="video_url">Video URL</label>
                            <input type="text" id="video_url" name="video_url" class="form-control-styled"
                                value="{{ old('video_url') }}" placeholder="e.g. assets/video/trip.mp4">
                        </div>

                    </div>

                    {{-- ============ BANNER ============ --}}
                    <div class="cat-tab-panel" data-panel="banner">

                        <div class="form-field">
                            <label for="banner_tag_text">Banner Tag Text</label>
                            <input type="text" id="banner_tag_text" name="banner_tag_text" class="form-control-styled"
                                value="{{ old('banner_tag_text') }}" placeholder="e.g. Explore Ladakh">
                        </div>

                        <div class="form-field">
                            <label for="banner_intro">Banner Intro</label>
                            <textarea id="banner_intro" name="banner_intro" rows="3" class="form-control-styled"
                                placeholder="Discover breathtaking mountains, peaceful monasteries...">{{ old('banner_intro') }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="main_image">Main Image</label>
                                <input type="file" id="main_image" name="main_image" class="form-control-styled"
                                    accept="image/*">
                                <div class="hint">Large hero image — max 3MB</div>
                            </div>
                            <div class="form-field">
                                <label for="top_image">Top Image</label>
                                <input type="file" id="top_image" name="top_image" class="form-control-styled"
                                    accept="image/*">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="bottom_left_image">Bottom Left Image</label>
                                <input type="file" id="bottom_left_image" name="bottom_left_image"
                                    class="form-control-styled" accept="image/*">
                            </div>
                            <div class="form-field">
                                <label for="bottom_right_image">Bottom Right Image</label>
                                <input type="file" id="bottom_right_image" name="bottom_right_image"
                                    class="form-control-styled" accept="image/*">
                            </div>
                        </div>

                    </div>

                    {{-- ============ AMENITIES ============ --}}
                    <div class="cat-tab-panel" data-panel="amenities">
                        <div class="form-field">
                            <label>Select Amenities</label>

                            @if($amenities->isEmpty())
                                <div class="hint">
                                    No amenities yet.
                                    <a href="{{ route('admin.amenities.create') }}" target="_blank">Add one</a>, then reload
                                    this page.
                                </div>
                            @else
                                <div class="amenity-grid">
                                    @foreach($amenities as $amenity)
                                        <label class="amenity-option">
                                            <input type="checkbox" name="amenity_ids[]" value="{{ $amenity->id }}" {{ in_array($amenity->id, old('amenity_ids', [])) ? 'checked' : '' }}>
                                            @if($amenity->icon)
                                                <img src="{{ $amenity->icon_url }}" alt="">
                                            @endif
                                            <span>{{ $amenity->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @endif

                            <div class="hint" style="margin-top:10px;">
                                Manage the list under <a href="{{ route('admin.amenities.index') }}"
                                    target="_blank">Amenities</a>
                            </div>
                        </div>
                    </div>

                    {{-- ============ DURATION OPTIONS ============ --}}
                    <div class="cat-tab-panel" data-panel="duration">
                        <div class="form-field">
                            <label>"Find Your Perfect Trip" Cards</label>
                            <div id="new-duropt-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-duropt-row">
                                <i class="fa fa-plus"></i> Add Duration Option
                            </button>
                            <div class="hint" style="margin-top:10px;">e.g. Image, Days Label: "4 days", Price: 14999
                            </div>
                        </div>
                    </div>

                    {{-- ============ ROUTE ============ --}}
                    <div class="cat-tab-panel" data-panel="route">
                        <div class="form-field">
                            <label>Destination Route Stops</label>
                            <div id="new-stop-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-stop-row">
                                <i class="fa fa-plus"></i> Add Stop
                            </button>
                            <div class="hint" style="margin-top:10px;">e.g. "Leh" → "Nubra Valley" → "Pangong Tso" →
                                "Leh" — order sets route sequence</div>
                        </div>
                    </div>

                    {{-- ============ OVERVIEW ============ --}}
                    <div class="cat-tab-panel" data-panel="overview">

                        <div class="form-field">
                            <label for="overview_title">Overview Title</label>
                            <input type="text" id="overview_title" name="overview_title" class="form-control-styled"
                                value="{{ old('overview_title') }}" placeholder="e.g. About This Tour">
                        </div>

                        <div class="form-field">
                            <label for="overview_content">Overview Content</label>
                            <textarea id="overview_content" name="overview_content" rows="6" class="form-control-styled"
                                placeholder="Full about-this-tour paragraph">{{ old('overview_content') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Trip Highlights (Check List)</label>
                            <div id="new-highlight-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-highlight-row">
                                <i class="fa fa-plus"></i> Add Highlight
                            </button>
                        </div>

                    </div>

                    {{-- ============ ITINERARY ============ --}}
                    <div class="cat-tab-panel" data-panel="itinerary">
                        <div class="form-field">
                            <label>Day-by-Day Itinerary</label>
                            <div id="new-itin-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-itin-row">
                                <i class="fa fa-plus"></i> Add Day
                            </button>
                            <div class="hint" style="margin-top:10px;">Order here sets display order — first day expands
                                by default</div>
                        </div>
                    </div>

                    {{-- ============ HOTEL STAYS ============ --}}
                    <div class="cat-tab-panel" data-panel="hotels">
                        <div class="form-field">
                            <label>Hotel Stays</label>
                            <div id="new-hotel-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-hotel-row">
                                <i class="fa fa-plus"></i> Add Hotel Stay
                            </button>
                            <div class="hint" style="margin-top:10px;">Star rating, images and location come from the
                                selected Hotel's own record</div>
                        </div>
                    </div>

                    {{-- ============ INCLUDES / EXCLUDES ============ --}}
                    <div class="cat-tab-panel" data-panel="incexc">

                        <div class="form-field">
                            <label>The Cost Includes</label>
                            <div id="new-include-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-include-row">
                                <i class="fa fa-plus"></i> Add Include
                            </button>

                            <div class="bulk-box">
                                <label for="bulk-include-input">Bulk add includes <span class="hint-inline">(one per
                                        line)</span></label>
                                <textarea id="bulk-include-input" class="form-control-styled" rows="5"
                                    placeholder="Professional Tour Guide&#10;Air-Conditioned Tour Vehicle&#10;Bottled Mineral Water"></textarea>
                                <button type="button" class="btn-secondary-dash" id="bulk-include-btn">
                                    <i class="fa fa-list"></i> Add All
                                </button>
                            </div>
                        </div>

                        <div class="form-field" style="margin-top:24px;">
                            <label>The Cost Excludes</label>
                            <div id="new-exclude-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-exclude-row">
                                <i class="fa fa-plus"></i> Add Exclude
                            </button>

                            <div class="bulk-box">
                                <label for="bulk-exclude-input">Bulk add excludes <span class="hint-inline">(one per
                                        line)</span></label>
                                <textarea id="bulk-exclude-input" class="form-control-styled" rows="5"
                                    placeholder="Personal Travel Insurance&#10;Lunch &amp; Additional Meals&#10;Gratuities / Tips"></textarea>
                                <button type="button" class="btn-secondary-dash" id="bulk-exclude-btn">
                                    <i class="fa fa-list"></i> Add All
                                </button>
                            </div>
                        </div>

                    </div>

                    {{-- ============ POLICIES ============ --}}
                    <div class="cat-tab-panel" data-panel="policies">
                        <div class="form-field">
                            <label>Policy Accordion Items</label>
                            <div id="new-policy-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-policy-row">
                                <i class="fa fa-plus"></i> Add Policy
                            </button>
                            <div class="hint" style="margin-top:10px;">e.g. "Confirmation Policy", "Refund Policy",
                                "Cancellation Policy"</div>
                        </div>
                    </div>

                    {{-- ============ FAQs ============ --}}
                    <div class="cat-tab-panel" data-panel="faqsection">
                        <div class="form-field">
                            <label>FAQs</label>
                            <div id="new-faq-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-faq-row">
                                <i class="fa fa-plus"></i> Add FAQ
                            </button>
                        </div>
                    </div>

                    {{-- ============ MAP ============ --}}
                    <div class="cat-tab-panel" data-panel="map">
                        <div class="form-field">
                            <label for="map_embed_url">Google Maps Embed URL</label>
                            <textarea id="map_embed_url" name="map_embed_url" rows="3" class="form-control-styled"
                                placeholder="https://www.google.com/maps/embed?pb=...">{{ old('map_embed_url') }}</textarea>
                            <div class="hint">Paste the full "src" URL from Google Maps' Embed option</div>
                        </div>
                    </div>

                    {{-- ============ OFFERS ============ --}}
                    <div class="cat-tab-panel" data-panel="offers">

                        <h4 style="margin-bottom:14px;">Group Offer Banner</h4>

                        <div class="form-field">
                            <label for="group_offer_badge_text">Badge Text</label>
                            <input type="text" id="group_offer_badge_text" name="group_offer_badge_text"
                                class="form-control-styled" value="{{ old('group_offer_badge_text') }}"
                                placeholder="e.g. Limited-Time Offer">
                        </div>

                        <div class="form-field">
                            <label for="group_offer_title">Title</label>
                            <input type="text" id="group_offer_title" name="group_offer_title"
                                class="form-control-styled" value="{{ old('group_offer_title') }}"
                                placeholder="e.g. Planning a Ladakh Trip? Save Up to 40% on Early Bookings">
                        </div>

                        <div class="form-field">
                            <label for="group_offer_description">Description</label>
                            <textarea id="group_offer_description" name="group_offer_description" rows="3"
                                class="form-control-styled">{{ old('group_offer_description') }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="group_offer_button1_text">Button Text</label>
                                <input type="text" id="group_offer_button1_text" name="group_offer_button1_text"
                                    class="form-control-styled" value="{{ old('group_offer_button1_text') }}"
                                    placeholder="e.g. Explore Packages">
                            </div>
                            <div class="form-field">
                                <label for="group_offer_button1_url">Button URL</label>
                                <input type="text" id="group_offer_button1_url" name="group_offer_button1_url"
                                    class="form-control-styled" value="{{ old('group_offer_button1_url') }}"
                                    placeholder="Leave blank to link to this subcategory">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="group_offer_image">Banner Image</label>
                            <input type="file" id="group_offer_image" name="group_offer_image"
                                class="form-control-styled" accept="image/*">
                        </div>

                        <hr style="margin:24px 0;">

                        <h4 style="margin-bottom:14px;">Monsoon / Countdown Sale</h4>

                        <div class="form-field">
                            <label for="promo_badge_text">Badge Text</label>
                            <input type="text" id="promo_badge_text" name="promo_badge_text" class="form-control-styled"
                                value="{{ old('promo_badge_text') }}" placeholder="e.g. Monsoon Sale">
                        </div>

                        <div class="form-field">
                            <label for="promo_title">Title</label>
                            <input type="text" id="promo_title" name="promo_title" class="form-control-styled"
                                value="{{ old('promo_title') }}"
                                placeholder="e.g. Save up to INR 30,000 on selected Ladakh trips">
                        </div>

                        <div class="form-field">
                            <label for="promo_description">Description</label>
                            <textarea id="promo_description" name="promo_description" rows="3"
                                class="form-control-styled">{{ old('promo_description') }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="promo_button_text">Button Text</label>
                                <input type="text" id="promo_button_text" name="promo_button_text"
                                    class="form-control-styled" value="{{ old('promo_button_text') }}"
                                    placeholder="e.g. Know More About the Deal">
                            </div>
                            <div class="form-field">
                                <label for="promo_button_url">Button URL</label>
                                <input type="text" id="promo_button_url" name="promo_button_url"
                                    class="form-control-styled" value="{{ old('promo_button_url') }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="promo_end_at">Sale Ends At</label>
                            <input type="datetime-local" id="promo_end_at" name="promo_end_at"
                                class="form-control-styled" value="{{ old('promo_end_at') }}">
                            <div class="hint">Countdown on the detail page counts down to this date/time — leave blank
                                to hide the countdown block.</div>
                        </div>

                    </div>

                    {{-- ============ DESTINATIONS ============ --}}
                    <div class="cat-tab-panel" data-panel="destinations">
                        <div class="form-field">
                            <label>Linked Destinations</label>
                            <div id="new-destination-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-destination-row">
                                <i class="fa fa-plus"></i> Add Destination
                            </button>
                            <div class="hint" style="margin-top:10px;">Order here sets the display order on the package
                                page</div>
                        </div>
                    </div>

                    {{-- ============ ATTRACTIONS ============ --}}
                    <div class="cat-tab-panel" data-panel="attractionslink">
                        <div class="form-field">
                            <label>Linked Attractions</label>
                            <div id="new-attraction-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-attraction-row">
                                <i class="fa fa-plus"></i> Add Attraction
                            </button>
                        </div>
                    </div>

                    {{-- ============ ACTIVITIES ============ --}}
                    <div class="cat-tab-panel" data-panel="activitieslink">
                        <div class="form-field">
                            <label>Linked Activities</label>
                            <div id="new-activity-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-activity-row">
                                <i class="fa fa-plus"></i> Add Activity
                            </button>
                        </div>
                    </div>

                    {{-- ============ SEO ============ --}}
                    <div class="cat-tab-panel" data-panel="seo">

                        <div class="form-field">
                            <label for="h1">H1 Tag</label>
                            <input type="text" id="h1" name="h1" class="form-control-styled" value="{{ old('h1') }}">
                            <div class="hint">Auto-filled from Package Name — edit to override</div>
                        </div>

                        <div class="form-field">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" class="form-control-styled"
                                value="{{ old('meta_title') }}">
                            <div class="hint">Auto-filled: Package Name | Site Name (ideal under 60 characters)</div>
                        </div>

                        <div class="form-field">
                            <label for="meta_description">Meta Description</label>
                            <textarea id="meta_description" name="meta_description" rows="4"
                                class="form-control-styled">{{ old('meta_description') }}</textarea>
                            <div class="hint">Auto-filled from Banner Intro / Overview (ideal under 160 characters)
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="og_title">OG Title</label>
                            <input type="text" id="og_title" name="og_title" class="form-control-styled"
                                value="{{ old('og_title') }}">
                            <div class="hint">Follows Meta Title — edit to override</div>
                        </div>

                        <div class="form-field">
                            <label for="og_description">OG Description</label>
                            <textarea id="og_description" name="og_description" rows="3"
                                class="form-control-styled">{{ old('og_description') }}</textarea>
                            <div class="hint">Follows Meta Description — edit to override</div>
                        </div>

                        <div class="form-field">
                            <label for="og_image">OG Image</label>
                            <input type="file" id="og_image" name="og_image" class="form-control-styled"
                                accept="image/*">
                            <div class="hint">Leave blank to automatically use the Main Image</div>
                        </div>

                        <div class="form-field">
                            <label for="twitter_card_image">Twitter Card Image</label>
                            <input type="file" id="twitter_card_image" name="twitter_card_image"
                                class="form-control-styled" accept="image/*">
                            <div class="hint">Leave blank to automatically use the OG Image / Main Image</div>
                        </div>

                        <div class="form-field">
                            <label for="canonical_url">Canonical URL</label>
                            <input type="text" id="canonical_url" name="canonical_url" class="form-control-styled"
                                value="{{ old('canonical_url') }}">
                            <div class="hint">Auto-generated from slug — edit only if the page lives at a different URL
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="robots">Robots</label>
                            <select id="robots" name="robots" class="form-control-styled">
                                <option value="index, follow" {{ old('robots', 'index, follow') == 'index, follow' ? 'selected' : '' }}>Index, Follow</option>
                                <option value="noindex, follow" {{ old('robots') == 'noindex, follow' ? 'selected' : '' }}>No Index, Follow</option>
                                <option value="noindex, nofollow" {{ old('robots') == 'noindex, nofollow' ? 'selected' : '' }}>No Index, No Follow</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" id="save-btn" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Save Tour Package
                        </button>
                        <a href="{{ route('admin.tourpackages.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    // ---- Searchable dropdowns (Select2) ----
    // Any <select class="searchable-select"> gets a search box. Call initSearchable(row) after adding dynamic rows.
    function initSearchable(scope) {
        if (typeof window.jQuery === 'undefined' || !jQuery.fn.select2) return;
        jQuery(scope || document).find('select.searchable-select').each(function () {
            if (jQuery(this).hasClass('select2-hidden-accessible')) return;
            jQuery(this).select2({
                width: '100%',
                placeholder: jQuery(this).data('placeholder') || undefined,
                allowClear: !jQuery(this).prop('multiple') ? false : true
            });
        });
    }

    document.querySelectorAll('#tp-tabs .cat-tab').forEach(function (tabBtn) {
        tabBtn.addEventListener('click', function () {
            document.querySelectorAll('#tp-tabs .cat-tab').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            document.querySelector('.cat-tab-panel[data-panel="' + this.dataset.tab + '"]').classList.add('active');
        });
    });

    (function focusFirstErrorTab() {
        const firstError = document.querySelector('.form-error');
        if (!firstError) return;
        const panel = firstError.closest('.cat-tab-panel');
        if (!panel || panel.classList.contains('active')) return;
        document.querySelectorAll('#tp-tabs .cat-tab').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.remove('active'));
        panel.classList.add('active');
        document.querySelector('#tp-tabs .cat-tab[data-tab="' + panel.dataset.panel + '"]').classList.add('active');
    })();

    // ---- Location cascading dropdowns ----
    // Uses jQuery events because Select2 fires jQuery "change" (native addEventListener would not catch it).
    // Bound on window load so it works even if jQuery/Select2 are loaded in the footer.
    window.addEventListener('load', function () {
        initSearchable();

        const $ = window.jQuery;
        if (!$) return;

        $('#country_id').on('change', function () {
            const $state = $('#state_id');
            const $city = $('#city_id');
            $state.html('<option value="">Select State</option>').trigger('change.select2');
            $city.html('<option value="">Select City</option>').trigger('change.select2');
            if (!this.value) return;
            fetch(`/admin/location/states/${this.value}`).then(r => r.json()).then(states => {
                states.forEach(s => $state.append(new Option(s.name, s.id)));
                $state.trigger('change.select2');
            });
        });

        $('#state_id').on('change', function () {
            const $city = $('#city_id');
            $city.html('<option value="">Select City</option>').trigger('change.select2');
            if (!this.value) return;
            fetch(`/admin/location/cities/${this.value}`).then(r => r.json()).then(cities => {
                cities.forEach(c => $city.append(new Option(c.name, c.id)));
                $city.trigger('change.select2');
            });
        });
    });


    // ---- Duration options repeater ----
    let duroptIndex = 0;
    document.getElementById('add-duropt-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-row-3">
                <div class="form-field">
                    <label>Image</label>
                    <input type="file" name="duropt_images[${duroptIndex}]" class="form-control-styled" accept="image/*">
                </div>
                <div class="form-field">
                    <label>Days Label</label>
                    <input type="text" name="duropt_labels[${duroptIndex}]" class="form-control-styled" placeholder="e.g. 4 days">
                </div>
                <div class="form-field">
                    <label>Price (₹)</label>
                    <input type="number" step="0.01" name="duropt_prices[${duroptIndex}]" class="form-control-styled" placeholder="e.g. 14999">
                </div>
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-duropt-rows').appendChild(row);
        duroptIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Route stops repeater ----
    let stopIndex = 0;
    document.getElementById('add-stop-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field">
                <label>Stop Name</label>
                <input type="text" name="stop_names[${stopIndex}]" class="form-control-styled" placeholder="e.g. Nubra Valley">
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-stop-rows').appendChild(row);
        stopIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Highlights repeater ----
    let highlightIndex = 0;
    document.getElementById('add-highlight-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field">
                <label>Highlight Text</label>
                <input type="text" name="highlight_texts[${highlightIndex}]" class="form-control-styled" placeholder="e.g. Explore the stunning contrast between old and new">
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-highlight-rows').appendChild(row);
        highlightIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Itinerary repeater ----
    let itinIndex = 0;
    document.getElementById('add-itin-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-row">
                <div class="form-field">
                    <label>Day Number</label>
                    <input type="number" min="1" name="itin_day_numbers[${itinIndex}]" class="form-control-styled" value="${itinIndex + 1}">
                </div>
                <div class="form-field">
                    <label>Title</label>
                    <input type="text" name="itin_titles[${itinIndex}]" class="form-control-styled" placeholder="e.g. Day 01: Arrival and Evening of Modern Marvels">
                </div>
            </div>
            <div class="form-field">
                <label>Content</label>
                <textarea name="itin_contents[${itinIndex}]" class="form-control-styled" rows="3" placeholder="Full description of the day's activities"></textarea>
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-itin-rows').appendChild(row);
        itinIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Hotel stays repeater ----
    const hotelOptions = @json($hotels->map(fn($h) => ['id' => $h->id, 'name' => $h->name]));
    function hotelOptionsHtml(selectedId = '') {
        return '<option value="">Select Hotel</option>' + hotelOptions.map(h =>
            `<option value="${h.id}" ${h.id == selectedId ? 'selected' : ''}>${h.name}</option>`
        ).join('');
    }

    let hotelIndex = 0;
    document.getElementById('add-hotel-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-row">
                <div class="form-field">
                    <label>Hotel</label>
                    <select name="hotel_ids[${hotelIndex}]" class="form-control-styled searchable-select">
                        ${hotelOptionsHtml()}
                    </select>
                    <div class="hint">Star rating, images and location pulled from the Hotel's own record</div>
                </div>
                <div class="form-field">
                    <label>Day Label</label>
                    <input type="text" name="hotel_day_labels[${hotelIndex}]" class="form-control-styled" placeholder="e.g. Day 1">
                </div>
            </div>
            <div class="form-field">
                <label>Title</label>
                <input type="text" name="hotel_titles[${hotelIndex}]" class="form-control-styled" placeholder="e.g. Arrival in Reykjavik | Day at Leisure">
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label>Check In</label>
                    <input type="text" name="hotel_check_ins[${hotelIndex}]" class="form-control-styled" placeholder="e.g. 2:00 PM">
                </div>
                <div class="form-field">
                    <label>Check Out</label>
                    <input type="text" name="hotel_check_outs[${hotelIndex}]" class="form-control-styled" placeholder="e.g. 11:00 AM">
                </div>
            </div>
            <div class="form-row-3">
                <label class="checkbox-row"><input type="checkbox" name="hotel_breakfast[${hotelIndex}]" value="1"> Breakfast Included</label>
                <label class="checkbox-row"><input type="checkbox" name="hotel_lunch[${hotelIndex}]" value="1"> Lunch Included</label>
                <label class="checkbox-row"><input type="checkbox" name="hotel_dinner[${hotelIndex}]" value="1"> Dinner Included</label>
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-hotel-rows').appendChild(row);
        initSearchable(row);
        hotelIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Includes / Excludes repeaters (single add + bulk add) ----
    function setupTextList(cfg) {
        let index = cfg.start;
        const container = document.getElementById(cfg.container);

        function addRow(value) {
            const i = index++;
            const row = document.createElement('div');
            row.className = 'gallery-row';
            row.innerHTML = `
            <div class="form-field">
                <label>${cfg.label}</label>
                <input type="text" name="${cfg.field}[${i}]" class="form-control-styled" placeholder="${cfg.placeholder}">
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
            if (typeof value === 'string') row.querySelector('input').value = value; // set via DOM, not HTML
            container.appendChild(row);
            row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        }

        document.getElementById(cfg.addBtn).addEventListener('click', () => addRow());

        document.getElementById(cfg.bulkBtn).addEventListener('click', function () {
            const ta = document.getElementById(cfg.bulkInput);
            const lines = ta.value
                .split(/\r?\n/)
                .map(s => s.replace(/^\s*(?:[-*•●▪]|\d+[.)])\s*/, '').trim())
                .filter(Boolean)
                .map(s => s.substring(0, 255)); // matches the max:255 validation rule
            lines.forEach(addRow);
            ta.value = '';
        });
    }

    setupTextList({
        start: 0, container: 'new-include-rows', field: 'include_texts',
        label: 'Include Text', placeholder: 'e.g. Professional Tour Guide',
        addBtn: 'add-include-row', bulkBtn: 'bulk-include-btn', bulkInput: 'bulk-include-input'
    });
    setupTextList({
        start: 0, container: 'new-exclude-rows', field: 'exclude_texts',
        label: 'Exclude Text', placeholder: 'e.g. Personal Travel Insurance',
        addBtn: 'add-exclude-row', bulkBtn: 'bulk-exclude-btn', bulkInput: 'bulk-exclude-input'
    });

    // ---- Policies repeater ----
    let policyIndex = 0;
    document.getElementById('add-policy-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field">
                <label>Title</label>
                <input type="text" name="policy_titles[${policyIndex}]" class="form-control-styled" placeholder="e.g. Cancellation Policy">
            </div>
            <div class="form-field">
                <label>Content</label>
                <textarea name="policy_contents[${policyIndex}]" class="form-control-styled" rows="4" placeholder="Policy details — one line per point works well"></textarea>
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-policy-rows').appendChild(row);
        policyIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- FAQ repeater ----
    let faqIndex = 0;
    document.getElementById('add-faq-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field">
                <label>Question</label>
                <input type="text" name="faq_questions[${faqIndex}]" class="form-control-styled" placeholder="e.g. What's included in the trip cost?">
            </div>
            <div class="form-field">
                <label>Answer</label>
                <textarea name="faq_answers[${faqIndex}]" class="form-control-styled" rows="3"></textarea>
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-faq-rows').appendChild(row);
        faqIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Destinations repeater ----
    const destinationOptions = @json($destinations->map(fn($d) => ['id' => $d->id, 'name' => $d->name]));
    function destinationOptionsHtml(selectedId = '') {
        return '<option value="">Select Destination</option>' + destinationOptions.map(d =>
            `<option value="${d.id}" ${d.id == selectedId ? 'selected' : ''}>${d.name}</option>`
        ).join('');
    }
    document.getElementById('add-destination-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Destination</label>
            <select name="destination_ids[]" class="form-control-styled searchable-select">${destinationOptionsHtml()}</select>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('new-destination-rows').appendChild(row);
        initSearchable(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Attractions repeater ----
    const attractionOptions = @json($attractions->map(fn($a) => ['id' => $a->id, 'name' => $a->name]));
    function attractionOptionsHtml(selectedId = '') {
        return '<option value="">Select Attraction</option>' + attractionOptions.map(a =>
            `<option value="${a.id}" ${a.id == selectedId ? 'selected' : ''}>${a.name}</option>`
        ).join('');
    }
    document.getElementById('add-attraction-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Attraction</label>
            <select name="attraction_ids[]" class="form-control-styled searchable-select">${attractionOptionsHtml()}</select>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('new-attraction-rows').appendChild(row);
        initSearchable(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Activities repeater ----
    const activityOptions = @json($activities->map(fn($act) => ['id' => $act->id, 'name' => $act->name]));
    function activityOptionsHtml(selectedId = '') {
        return '<option value="">Select Activity</option>' + activityOptions.map(act =>
            `<option value="${act.id}" ${act.id == selectedId ? 'selected' : ''}>${act.name}</option>`
        ).join('');
    }
    document.getElementById('add-activity-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Activity</label>
            <select name="activity_ids[]" class="form-control-styled searchable-select">${activityOptionsHtml()}</select>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('new-activity-rows').appendChild(row);
        initSearchable(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });
</script>

@include('admin.tourpackage._seo-autofill', ['isEdit' => false])
@include('admin.partials._ajax-form', ['formId' => 'tp-form', 'tabsId' => 'tp-tabs'])
@include('admin.footer')

{{-- Select2 JS — loaded after the footer so jQuery is already available. Remove if your layout already loads select2
--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>