{{-- resources/views/admin/tourpackage/edit.blade.php --}}
@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

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

        .current-img-preview {
            width: 72px;
            height: 72px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            border: 1px solid var(--border);
            margin-bottom: 10px;
            display: block;
        }

        .gallery-row {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 16px;
            margin-bottom: 14px;
            background: var(--bg);
        }

        .gallery-row .remove-new-row,
        .gallery-row [class^="remove-"] {
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
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Edit Tour Package</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.tourpackages.index') }}">Tour Packages</a>
                        <span>›</span>
                        Edit
                    </div>
                </div>
                <a href="{{ route('admin.tourpackages.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.tourpackages.update', $tourPackage) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="cat-tabs" id="tp-tabs">
                        <button type="button" class="cat-tab active" data-tab="general">General</button>
                        <button type="button" class="cat-tab" data-tab="banner">Banner</button>
                        <button type="button" class="cat-tab" data-tab="features">Features</button>
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
                            <label for="sub_category_id">Parent Sub Category</label>
                            <select id="sub_category_id" name="sub_category_id"
                                class="form-control-styled @error('sub_category_id') is-invalid @enderror" required>
                                <option value="">Select Sub Category</option>
                                @foreach($subCategories as $sc)
                                    <option value="{{ $sc->id }}" {{ old('sub_category_id', $tourPackage->sub_category_id) == $sc->id ? 'selected' : '' }}>{{ $sc->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sub_category_id')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="name">Package Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control-styled @error('name') is-invalid @enderror"
                                value="{{ old('name', $tourPackage->name) }}" required>
                            @error('name')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" name="slug_preview" class="form-control-styled" readonly
                                value="{{ $tourPackage->slug }}">
                        </div>

                        <div class="form-field">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control-styled">
                                <option value="draft" {{ old('status', $tourPackage->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $tourPackage->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="unpublished" {{ old('status', $tourPackage->status) == 'unpublished' ? 'selected' : '' }}>Unpublished</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label class="checkbox-row">
                                <input type="checkbox" name="featured" value="1" {{ old('featured', $tourPackage->featured) ? 'checked' : '' }}>
                                Featured (show in "Explore Our Tour Packages" on the Destinations landing page)
                            </label>
                        </div>

                        <div class="form-field">
                            <label>Location</label>
                            <div class="form-row-3">
                                <div>
                                    <select id="country_id" name="country_id" class="form-control-styled">
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id', $tourPackage->country_id) == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <select id="state_id" name="state_id" class="form-control-styled">
                                        <option value="">Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" {{ old('state_id', $tourPackage->state_id) == $state->id ? 'selected' : '' }}>{{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <select id="city_id" name="city_id" class="form-control-styled">
                                        <option value="">Select City</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" {{ old('city_id', $tourPackage->city_id) == $city->id ? 'selected' : '' }}>{{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="duration_text">Duration Text</label>
                                <input type="text" id="duration_text" name="duration_text" class="form-control-styled"
                                    value="{{ old('duration_text', $tourPackage->duration_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="price_unit_text">Price Unit Text</label>
                                <input type="text" id="price_unit_text" name="price_unit_text"
                                    class="form-control-styled"
                                    value="{{ old('price_unit_text', $tourPackage->price_unit_text) }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="old_price">Old Price (₹)</label>
                                <input type="number" step="0.01" id="old_price" name="old_price"
                                    class="form-control-styled" value="{{ old('old_price', $tourPackage->old_price) }}">
                            </div>
                            <div class="form-field">
                                <label for="price">Current Price (₹)</label>
                                <input type="number" step="0.01" id="price" name="price" class="form-control-styled"
                                    value="{{ old('price', $tourPackage->price) }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="video_url">Video URL</label>
                            <input type="text" id="video_url" name="video_url" class="form-control-styled"
                                value="{{ old('video_url', $tourPackage->video_url) }}">
                        </div>

                    </div>

                    {{-- ============ BANNER ============ --}}
                    <div class="cat-tab-panel" data-panel="banner">

                        <div class="form-field">
                            <label for="banner_tag_text">Banner Tag Text</label>
                            <input type="text" id="banner_tag_text" name="banner_tag_text" class="form-control-styled"
                                value="{{ old('banner_tag_text', $tourPackage->banner_tag_text) }}">
                        </div>

                        <div class="form-field">
                            <label for="banner_intro">Banner Intro</label>
                            <textarea id="banner_intro" name="banner_intro" rows="3"
                                class="form-control-styled">{{ old('banner_intro', $tourPackage->banner_intro) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="main_image">Main Image</label>
                                @if($tourPackage->main_image)<img
                                    src="{{ asset('storage/' . $tourPackage->main_image) }}"
                                class="current-img-preview">@endif
                                <input type="file" id="main_image" name="main_image" class="form-control-styled"
                                    accept="image/*">
                                <div class="hint">Leave blank to keep current</div>
                            </div>
                            <div class="form-field">
                                <label for="top_image">Top Image</label>
                                @if($tourPackage->top_image)<img src="{{ asset('storage/' . $tourPackage->top_image) }}"
                                class="current-img-preview">@endif
                                <input type="file" id="top_image" name="top_image" class="form-control-styled"
                                    accept="image/*">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="bottom_left_image">Bottom Left Image</label>
                                @if($tourPackage->bottom_left_image)<img
                                    src="{{ asset('storage/' . $tourPackage->bottom_left_image) }}"
                                class="current-img-preview">@endif
                                <input type="file" id="bottom_left_image" name="bottom_left_image"
                                    class="form-control-styled" accept="image/*">
                            </div>
                            <div class="form-field">
                                <label for="bottom_right_image">Bottom Right Image</label>
                                @if($tourPackage->bottom_right_image)<img
                                    src="{{ asset('storage/' . $tourPackage->bottom_right_image) }}"
                                class="current-img-preview">@endif
                                <input type="file" id="bottom_right_image" name="bottom_right_image"
                                    class="form-control-styled" accept="image/*">
                            </div>
                        </div>

                    </div>

                    {{-- ============ FEATURES ============ --}}
                    <div class="cat-tab-panel" data-panel="features">
                        <div class="form-field">
                            <label>Feature Pills</label>
                            <input type="hidden" name="deleted_features" id="deleted_features" value="">
                            <div id="existing-feature-rows">
                                @foreach($tourPackage->features as $feature)
                                    <div class="gallery-row existing-row" data-id="{{ $feature->id }}">
                                        <input type="hidden" name="feature_ids[{{ $loop->index }}]"
                                            value="{{ $feature->id }}">
                                        <div class="form-row">
                                            <div class="form-field">
                                                <label>Icon Image</label>
                                                @if($feature->icon_image)<img
                                                    src="{{ asset('storage/' . $feature->icon_image) }}"
                                                class="current-img-preview" style="width:40px;height:40px;">@endif
                                                <input type="file" name="feature_images[{{ $loop->index }}]"
                                                    class="form-control-styled" accept="image/*">
                                            </div>
                                            <div class="form-field">
                                                <label>Text</label>
                                                <input type="text" name="feature_texts[{{ $loop->index }}]"
                                                    class="form-control-styled" value="{{ $feature->text }}">
                                            </div>
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-existing"
                                            data-target="deleted_features"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <div id="new-feature-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-feature-row"><i
                                    class="fa fa-plus"></i> Add Feature</button>
                        </div>
                    </div>

                    {{-- ============ DURATION OPTIONS ============ --}}
                    <div class="cat-tab-panel" data-panel="duration">
                        <div class="form-field">
                            <label>"Find Your Perfect Trip" Cards</label>
                            <input type="hidden" name="deleted_duration_options" id="deleted_duration_options" value="">
                            <div id="existing-duropt-rows">
                                @foreach($tourPackage->durationOptions as $opt)
                                    <div class="gallery-row existing-row" data-id="{{ $opt->id }}">
                                        <input type="hidden" name="duropt_ids[{{ $loop->index }}]" value="{{ $opt->id }}">
                                        <div class="form-row-3">
                                            <div class="form-field">
                                                <label>Image</label>
                                                @if($opt->image)<img src="{{ asset('storage/' . $opt->image) }}"
                                                class="current-img-preview" style="width:40px;height:40px;">@endif
                                                <input type="file" name="duropt_images[{{ $loop->index }}]"
                                                    class="form-control-styled" accept="image/*">
                                            </div>
                                            <div class="form-field">
                                                <label>Days Label</label>
                                                <input type="text" name="duropt_labels[{{ $loop->index }}]"
                                                    class="form-control-styled" value="{{ $opt->days_label }}">
                                            </div>
                                            <div class="form-field">
                                                <label>Price (₹)</label>
                                                <input type="number" step="0.01" name="duropt_prices[{{ $loop->index }}]"
                                                    class="form-control-styled" value="{{ $opt->price }}">
                                            </div>
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-existing"
                                            data-target="deleted_duration_options"><i class="fa fa-trash"></i>
                                            Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <div id="new-duropt-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-duropt-row"><i
                                    class="fa fa-plus"></i> Add Duration Option</button>
                        </div>
                    </div>

                    {{-- ============ ROUTE ============ --}}
                    <div class="cat-tab-panel" data-panel="route">
                        <div class="form-field">
                            <label>Destination Route Stops</label>
                            <input type="hidden" name="deleted_stops" id="deleted_stops" value="">
                            <div id="existing-stop-rows">
                                @foreach($tourPackage->routeStops as $stop)
                                    <div class="gallery-row existing-row" data-id="{{ $stop->id }}">
                                        <input type="hidden" name="stop_ids[{{ $loop->index }}]" value="{{ $stop->id }}">
                                        <div class="form-field">
                                            <label>Stop Name</label>
                                            <input type="text" name="stop_names[{{ $loop->index }}]"
                                                class="form-control-styled" value="{{ $stop->name }}">
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-existing"
                                            data-target="deleted_stops"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <div id="new-stop-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-stop-row"><i
                                    class="fa fa-plus"></i> Add Stop</button>
                        </div>
                    </div>

                    {{-- ============ OVERVIEW ============ --}}
                    <div class="cat-tab-panel" data-panel="overview">

                        <div class="form-field">
                            <label for="overview_title">Overview Title</label>
                            <input type="text" id="overview_title" name="overview_title" class="form-control-styled"
                                value="{{ old('overview_title', $tourPackage->overview_title) }}">
                        </div>

                        <div class="form-field">
                            <label for="overview_content">Overview Content</label>
                            <textarea id="overview_content" name="overview_content" rows="6"
                                class="form-control-styled">{{ old('overview_content', $tourPackage->overview_content) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Trip Highlights (Check List)</label>
                            <input type="hidden" name="deleted_highlights" id="deleted_highlights" value="">
                            <div id="existing-highlight-rows">
                                @foreach($tourPackage->highlights as $highlight)
                                    <div class="gallery-row existing-row" data-id="{{ $highlight->id }}">
                                        <input type="hidden" name="highlight_ids[{{ $loop->index }}]"
                                            value="{{ $highlight->id }}">
                                        <div class="form-field">
                                            <label>Highlight Text</label>
                                            <input type="text" name="highlight_texts[{{ $loop->index }}]"
                                                class="form-control-styled" value="{{ $highlight->text }}">
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-existing"
                                            data-target="deleted_highlights"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <div id="new-highlight-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-highlight-row"><i
                                    class="fa fa-plus"></i> Add Highlight</button>
                        </div>

                    </div>

                    {{-- ============ ITINERARY ============ --}}
                    <div class="cat-tab-panel" data-panel="itinerary">
                        <div class="form-field">
                            <label>Day-by-Day Itinerary</label>
                            <input type="hidden" name="deleted_itinerary" id="deleted_itinerary" value="">
                            <div id="existing-itin-rows">
                                @foreach($tourPackage->itineraryDays as $day)
                                    <div class="gallery-row existing-row" data-id="{{ $day->id }}">
                                        <input type="hidden" name="itin_ids[{{ $loop->index }}]" value="{{ $day->id }}">
                                        <div class="form-row">
                                            <div class="form-field">
                                                <label>Day Number</label>
                                                <input type="number" min="1" name="itin_day_numbers[{{ $loop->index }}]"
                                                    class="form-control-styled" value="{{ $day->day_number }}">
                                            </div>
                                            <div class="form-field">
                                                <label>Title</label>
                                                <input type="text" name="itin_titles[{{ $loop->index }}]"
                                                    class="form-control-styled" value="{{ $day->title }}">
                                            </div>
                                        </div>
                                        <div class="form-field">
                                            <label>Content</label>
                                            <textarea name="itin_contents[{{ $loop->index }}]" class="form-control-styled"
                                                rows="3">{{ $day->content }}</textarea>
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-existing"
                                            data-target="deleted_itinerary"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <div id="new-itin-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-itin-row"><i
                                    class="fa fa-plus"></i> Add Day</button>
                        </div>
                    </div>

                    {{-- ============ HOTEL STAYS ============ --}}
                    <div class="cat-tab-panel" data-panel="hotels">
                        <div class="form-field">
                            <label>Hotel Stays</label>
                            <input type="hidden" name="deleted_hotels" id="deleted_hotels" value="">
                            <div id="existing-hotel-rows">
                                @foreach($tourPackage->hotelStays as $stay)
                                    <div class="gallery-row existing-row" data-id="{{ $stay->id }}">
                                        <input type="hidden" name="hotel_stay_ids[{{ $loop->index }}]"
                                            value="{{ $stay->id }}">
                                        <div class="form-row">
                                            <div class="form-field">
                                                <label>Hotel</label>
                                                <select name="hotel_ids[{{ $loop->index }}]" class="form-control-styled">
                                                    <option value="">Select Hotel</option>
                                                    @foreach($hotels as $h)
                                                        <option value="{{ $h->id }}" {{ $stay->hotel_id == $h->id ? 'selected' : '' }}>{{ $h->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-field">
                                                <label>Day Label</label>
                                                <input type="text" name="hotel_day_labels[{{ $loop->index }}]"
                                                    class="form-control-styled" value="{{ $stay->day_label }}">
                                            </div>
                                        </div>
                                        <div class="form-field">
                                            <label>Title</label>
                                            <input type="text" name="hotel_titles[{{ $loop->index }}]"
                                                class="form-control-styled" value="{{ $stay->title }}">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-field">
                                                <label>Check In</label>
                                                <input type="text" name="hotel_check_ins[{{ $loop->index }}]"
                                                    class="form-control-styled" value="{{ $stay->check_in }}">
                                            </div>
                                            <div class="form-field">
                                                <label>Check Out</label>
                                                <input type="text" name="hotel_check_outs[{{ $loop->index }}]"
                                                    class="form-control-styled" value="{{ $stay->check_out }}">
                                            </div>
                                        </div>
                                        <div class="form-row-3">
                                            <label class="checkbox-row"><input type="checkbox"
                                                    name="hotel_breakfast[{{ $loop->index }}]" value="1" {{ $stay->breakfast_included ? 'checked' : '' }}> Breakfast
                                                Included</label>
                                            <label class="checkbox-row"><input type="checkbox"
                                                    name="hotel_lunch[{{ $loop->index }}]" value="1" {{ $stay->lunch_included ? 'checked' : '' }}> Lunch Included</label>
                                            <label class="checkbox-row"><input type="checkbox"
                                                    name="hotel_dinner[{{ $loop->index }}]" value="1" {{ $stay->dinner_included ? 'checked' : '' }}> Dinner Included</label>
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-existing"
                                            data-target="deleted_hotels"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <div id="new-hotel-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-hotel-row"><i
                                    class="fa fa-plus"></i> Add Hotel Stay</button>
                        </div>
                    </div>

                    {{-- ============ INCLUDES / EXCLUDES ============ --}}
                    <div class="cat-tab-panel" data-panel="incexc">

                        <div class="form-field">
                            <label>The Cost Includes</label>
                            <input type="hidden" name="deleted_includes" id="deleted_includes" value="">
                            <div id="existing-include-rows">
                                @foreach($tourPackage->includes as $item)
                                    <div class="gallery-row existing-row" data-id="{{ $item->id }}">
                                        <input type="hidden" name="include_ids[{{ $loop->index }}]" value="{{ $item->id }}">
                                        <div class="form-field">
                                            <label>Text</label>
                                            <input type="text" name="include_texts[{{ $loop->index }}]"
                                                class="form-control-styled" value="{{ $item->text }}">
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-existing"
                                            data-target="deleted_includes"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <div id="new-include-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-include-row"><i
                                    class="fa fa-plus"></i> Add Include</button>
                        </div>

                        <div class="form-field" style="margin-top:24px;">
                            <label>The Cost Excludes</label>
                            <input type="hidden" name="deleted_excludes" id="deleted_excludes" value="">
                            <div id="existing-exclude-rows">
                                @foreach($tourPackage->excludes as $item)
                                    <div class="gallery-row existing-row" data-id="{{ $item->id }}">
                                        <input type="hidden" name="exclude_ids[{{ $loop->index }}]" value="{{ $item->id }}">
                                        <div class="form-field">
                                            <label>Text</label>
                                            <input type="text" name="exclude_texts[{{ $loop->index }}]"
                                                class="form-control-styled" value="{{ $item->text }}">
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-existing"
                                            data-target="deleted_excludes"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <div id="new-exclude-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-exclude-row"><i
                                    class="fa fa-plus"></i> Add Exclude</button>
                        </div>

                    </div>

                    {{-- ============ POLICIES ============ --}}
                    <div class="cat-tab-panel" data-panel="policies">
                        <div class="form-field">
                            <label>Policy Accordion Items</label>
                            <input type="hidden" name="deleted_policies" id="deleted_policies" value="">
                            <div id="existing-policy-rows">
                                @foreach($tourPackage->policies as $policy)
                                    <div class="gallery-row existing-row" data-id="{{ $policy->id }}">
                                        <input type="hidden" name="policy_ids[{{ $loop->index }}]"
                                            value="{{ $policy->id }}">
                                        <div class="form-field">
                                            <label>Title</label>
                                            <input type="text" name="policy_titles[{{ $loop->index }}]"
                                                class="form-control-styled" value="{{ $policy->title }}">
                                        </div>
                                        <div class="form-field">
                                            <label>Content</label>
                                            <textarea name="policy_contents[{{ $loop->index }}]" class="form-control-styled"
                                                rows="4">{{ $policy->content }}</textarea>
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-existing"
                                            data-target="deleted_policies"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <div id="new-policy-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-policy-row"><i
                                    class="fa fa-plus"></i> Add Policy</button>
                        </div>
                    </div>

                    {{-- ============ FAQs ============ --}}
                    <div class="cat-tab-panel" data-panel="faqsection">
                        <div class="form-field">
                            <label>FAQs</label>
                            <input type="hidden" name="deleted_faqs" id="deleted_faqs" value="">
                            <div id="existing-faq-rows">
                                @foreach($tourPackage->faqs as $faq)
                                    <div class="gallery-row existing-row" data-id="{{ $faq->id }}">
                                        <input type="hidden" name="faq_ids[{{ $loop->index }}]" value="{{ $faq->id }}">
                                        <div class="form-field">
                                            <label>Question</label>
                                            <input type="text" name="faq_questions[{{ $loop->index }}]"
                                                class="form-control-styled" value="{{ $faq->question }}">
                                        </div>
                                        <div class="form-field">
                                            <label>Answer</label>
                                            <textarea name="faq_answers[{{ $loop->index }}]" class="form-control-styled"
                                                rows="3">{{ $faq->answer }}</textarea>
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-existing"
                                            data-target="deleted_faqs"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <div id="new-faq-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-faq-row"><i class="fa fa-plus"></i>
                                Add FAQ</button>
                        </div>
                    </div>

                    {{-- ============ MAP ============ --}}
                    <div class="cat-tab-panel" data-panel="map">
                        <div class="form-field">
                            <label for="map_embed_url">Google Maps Embed URL</label>
                            <textarea id="map_embed_url" name="map_embed_url" rows="3"
                                class="form-control-styled">{{ old('map_embed_url', $tourPackage->map_embed_url) }}</textarea>
                        </div>
                    </div>

                    {{-- ============ OFFERS ============ --}}
                    <div class="cat-tab-panel" data-panel="offers">

                        <h4 style="margin-bottom:14px;">Group Offer Banner</h4>

                        <div class="form-field">
                            <label for="group_offer_badge_text">Badge Text</label>
                            <input type="text" id="group_offer_badge_text" name="group_offer_badge_text"
                                class="form-control-styled"
                                value="{{ old('group_offer_badge_text', $tourPackage->group_offer_badge_text) }}"
                                placeholder="e.g. Limited-Time Offer">
                        </div>

                        <div class="form-field">
                            <label for="group_offer_title">Title</label>
                            <input type="text" id="group_offer_title" name="group_offer_title"
                                class="form-control-styled"
                                value="{{ old('group_offer_title', $tourPackage->group_offer_title) }}"
                                placeholder="e.g. Planning a Ladakh Trip? Save Up to 40% on Early Bookings">
                        </div>

                        <div class="form-field">
                            <label for="group_offer_description">Description</label>
                            <textarea id="group_offer_description" name="group_offer_description" rows="3"
                                class="form-control-styled">{{ old('group_offer_description', $tourPackage->group_offer_description) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="group_offer_button1_text">Button Text</label>
                                <input type="text" id="group_offer_button1_text" name="group_offer_button1_text"
                                    class="form-control-styled"
                                    value="{{ old('group_offer_button1_text', $tourPackage->group_offer_button1_text) }}"
                                    placeholder="e.g. Explore Packages">
                            </div>
                            <div class="form-field">
                                <label for="group_offer_button1_url">Button URL</label>
                                <input type="text" id="group_offer_button1_url" name="group_offer_button1_url"
                                    class="form-control-styled"
                                    value="{{ old('group_offer_button1_url', $tourPackage->group_offer_button1_url) }}"
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
                                value="{{ old('promo_badge_text', $tourPackage->promo_badge_text) }}"
                                placeholder="e.g. Monsoon Sale">
                        </div>

                        <div class="form-field">
                            <label for="promo_title">Title</label>
                            <input type="text" id="promo_title" name="promo_title" class="form-control-styled"
                                value="{{ old('promo_title', $tourPackage->promo_title) }}"
                                placeholder="e.g. Save up to INR 30,000 on selected Ladakh trips">
                        </div>

                        <div class="form-field">
                            <label for="promo_description">Description</label>
                            <textarea id="promo_description" name="promo_description" rows="3"
                                class="form-control-styled">{{ old('promo_description', $tourPackage->promo_description) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="promo_button_text">Button Text</label>
                                <input type="text" id="promo_button_text" name="promo_button_text"
                                    class="form-control-styled"
                                    value="{{ old('promo_button_text', $tourPackage->promo_button_text) }}"
                                    placeholder="e.g. Know More About the Deal">
                            </div>
                            <div class="form-field">
                                <label for="promo_button_url">Button URL</label>
                                <input type="text" id="promo_button_url" name="promo_button_url"
                                    class="form-control-styled"
                                    value="{{ old('promo_button_url', $tourPackage->promo_button_url) }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="promo_end_at">Sale Ends At</label>
                            <input type="datetime-local" id="promo_end_at" name="promo_end_at"
                                class="form-control-styled"
                                value="{{ old('promo_end_at', $tourPackage->promo_end_at) }}">
                            <div class="hint">Countdown on the detail page counts down to this date/time — leave blank
                                to hide the countdown block.</div>
                        </div>

                    </div>

                    {{-- ============ DESTINATIONS ============ --}}
                    <div class="cat-tab-panel" data-panel="destinations">
                        <div class="form-field">
                            <label>Linked Destinations</label>
                            <div id="existing-destination-rows">
                                @foreach($tourPackage->destinations as $destination)
                                    <div class="gallery-row existing-row">
                                        <div class="form-field">
                                            <label>Destination</label>
                                            <select name="destination_ids[]" class="form-control-styled">
                                                <option value="">Select Destination</option>
                                                @foreach($destinations as $d)
                                                    <option value="{{ $d->id }}" {{ $destination->id == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-new-row"><i
                                                class="fa fa-trash"></i> Remove</button>
                                    </div>
                                @endforeach
                            </div>
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
                            <div id="existing-attraction-rows">
                                @foreach($tourPackage->attractions as $attraction)
                                    <div class="gallery-row existing-row">
                                        <div class="form-field">
                                            <label>Attraction</label>
                                            <select name="attraction_ids[]" class="form-control-styled">
                                                <option value="">Select Attraction</option>
                                                @foreach($attractions as $a)
                                                    <option value="{{ $a->id }}" {{ $attraction->id == $a->id ? 'selected' : '' }}>{{ $a->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-new-row"><i
                                                class="fa fa-trash"></i> Remove</button>
                                    </div>
                                @endforeach
                            </div>
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
                            <div id="existing-activity-rows">
                                @foreach($tourPackage->activities as $activity)
                                    <div class="gallery-row existing-row">
                                        <div class="form-field">
                                            <label>Activity</label>
                                            <select name="activity_ids[]" class="form-control-styled">
                                                <option value="">Select Activity</option>
                                                @foreach($activities as $act)
                                                    <option value="{{ $act->id }}" {{ $activity->id == $act->id ? 'selected' : '' }}>{{ $act->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-new-row"><i
                                                class="fa fa-trash"></i> Remove</button>
                                    </div>
                                @endforeach
                            </div>
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
                            <input type="text" id="h1" name="h1" class="form-control-styled"
                                value="{{ old('h1', $tourPackage->h1) }}">
                        </div>

                        <div class="form-field">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" class="form-control-styled"
                                value="{{ old('meta_title', $tourPackage->meta_title) }}">
                        </div>

                        <div class="form-field">
                            <label for="meta_description">Meta Description</label>
                            <textarea id="meta_description" name="meta_description" rows="4"
                                class="form-control-styled">{{ old('meta_description', $tourPackage->meta_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="og_title">OG Title</label>
                            <input type="text" id="og_title" name="og_title" class="form-control-styled"
                                value="{{ old('og_title', $tourPackage->og_title) }}">
                        </div>

                        <div class="form-field">
                            <label for="og_description">OG Description</label>
                            <textarea id="og_description" name="og_description" rows="3"
                                class="form-control-styled">{{ old('og_description', $tourPackage->og_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="og_image">OG Image</label>
                            @if($tourPackage->og_image)<img src="{{ asset('storage/' . $tourPackage->og_image) }}"
                            class="current-img-preview">@endif
                            <input type="file" id="og_image" name="og_image" class="form-control-styled"
                                accept="image/*">
                            <div class="hint">Leave blank to keep current</div>
                        </div>

                        <div class="form-field">
                            <label for="twitter_card_image">Twitter Card Image</label>
                            @if($tourPackage->twitter_card_image)<img
                                src="{{ asset('storage/' . $tourPackage->twitter_card_image) }}"
                            class="current-img-preview">@endif
                            <input type="file" id="twitter_card_image" name="twitter_card_image"
                                class="form-control-styled" accept="image/*">
                            <div class="hint">Leave blank to keep current</div>
                        </div>

                        <div class="form-field">
                            <label for="canonical_url">Canonical URL</label>
                            <input type="text" id="canonical_url" name="canonical_url" class="form-control-styled"
                                value="{{ old('canonical_url', $tourPackage->canonical_url) }}">
                        </div>

                        <div class="form-field">
                            <label for="robots">Robots</label>
                            <select id="robots" name="robots" class="form-control-styled">
                                <option value="index, follow" {{ old('robots', $tourPackage->robots ?: 'index, follow') == 'index, follow' ? 'selected' : '' }}>Index, Follow</option>
                                <option value="noindex, follow" {{ old('robots', $tourPackage->robots) == 'noindex, follow' ? 'selected' : '' }}>No Index, Follow</option>
                                <option value="noindex, nofollow" {{ old('robots', $tourPackage->robots) == 'noindex, nofollow' ? 'selected' : '' }}>No Index, No Follow</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Update Tour Package
                        </button>
                        <a href="{{ route('admin.tourpackages.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.querySelectorAll('#tp-tabs .cat-tab').forEach(function (tabBtn) {
        tabBtn.addEventListener('click', function () {
            document.querySelectorAll('#tp-tabs .cat-tab').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            document.querySelector('.cat-tab-panel[data-panel="' + this.dataset.tab + '"]').classList.add('active');
        });
    });

    // ---- Generic "remove existing row" handler: pushes id into the right hidden field ----
    const deletedTrackers = {};
    document.querySelectorAll('.remove-existing').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const target = this.dataset.target;
            const row = this.closest('.existing-row');
            deletedTrackers[target] = deletedTrackers[target] || [];
            deletedTrackers[target].push(row.dataset.id);
            document.getElementById(target).value = deletedTrackers[target].join(',');
            row.remove();
        });
    });

    // ---- Location cascading dropdowns ----
    document.getElementById('country_id').addEventListener('change', function () {
        const stateSelect = document.getElementById('state_id');
        const citySelect = document.getElementById('city_id');
        stateSelect.innerHTML = '<option value="">Select State</option>';
        citySelect.innerHTML = '<option value="">Select City</option>';
        if (!this.value) return;
        fetch(`/admin/location/states/${this.value}`).then(r => r.json()).then(states => {
            states.forEach(s => stateSelect.insertAdjacentHTML('beforeend', `<option value="${s.id}">${s.name}</option>`));
        });
    });

    document.getElementById('state_id').addEventListener('change', function () {
        const citySelect = document.getElementById('city_id');
        citySelect.innerHTML = '<option value="">Select City</option>';
        if (!this.value) return;
        fetch(`/admin/location/cities/${this.value}`).then(r => r.json()).then(cities => {
            cities.forEach(c => citySelect.insertAdjacentHTML('beforeend', `<option value="${c.id}">${c.name}</option>`));
        });
    });

    // ---- Features repeater ----
    let featureIndex = {{ $tourPackage->features->count() }};
    document.getElementById('add-feature-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-row">
                <div class="form-field">
                    <label>Icon Image</label>
                    <input type="file" name="feature_images[${featureIndex}]" class="form-control-styled" accept="image/*">
                </div>
                <div class="form-field">
                    <label>Text</label>
                    <input type="text" name="feature_texts[${featureIndex}]" class="form-control-styled">
                </div>
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-feature-rows').appendChild(row);
        featureIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Duration options repeater ----
    let duroptIndex = {{ $tourPackage->durationOptions->count() }};
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
                    <input type="text" name="duropt_labels[${duroptIndex}]" class="form-control-styled">
                </div>
                <div class="form-field">
                    <label>Price (₹)</label>
                    <input type="number" step="0.01" name="duropt_prices[${duroptIndex}]" class="form-control-styled">
                </div>
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-duropt-rows').appendChild(row);
        duroptIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Route stops repeater ----
    let stopIndex = {{ $tourPackage->routeStops->count() }};
    document.getElementById('add-stop-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field">
                <label>Stop Name</label>
                <input type="text" name="stop_names[${stopIndex}]" class="form-control-styled">
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-stop-rows').appendChild(row);
        stopIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Highlights repeater ----
    let highlightIndex = {{ $tourPackage->highlights->count() }};
    document.getElementById('add-highlight-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field">
                <label>Highlight Text</label>
                <input type="text" name="highlight_texts[${highlightIndex}]" class="form-control-styled">
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-highlight-rows').appendChild(row);
        highlightIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Itinerary repeater ----
    let itinIndex = {{ $tourPackage->itineraryDays->count() }};
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
                    <input type="text" name="itin_titles[${itinIndex}]" class="form-control-styled">
                </div>
            </div>
            <div class="form-field">
                <label>Content</label>
                <textarea name="itin_contents[${itinIndex}]" class="form-control-styled" rows="3"></textarea>
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

    let hotelIndex = {{ $tourPackage->hotelStays->count() }};
    document.getElementById('add-hotel-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-row">
                <div class="form-field">
                    <label>Hotel</label>
                    <select name="hotel_ids[${hotelIndex}]" class="form-control-styled">
                        ${hotelOptionsHtml()}
                    </select>
                </div>
                <div class="form-field">
                    <label>Day Label</label>
                    <input type="text" name="hotel_day_labels[${hotelIndex}]" class="form-control-styled">
                </div>
            </div>
            <div class="form-field">
                <label>Title</label>
                <input type="text" name="hotel_titles[${hotelIndex}]" class="form-control-styled">
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label>Check In</label>
                    <input type="text" name="hotel_check_ins[${hotelIndex}]" class="form-control-styled">
                </div>
                <div class="form-field">
                    <label>Check Out</label>
                    <input type="text" name="hotel_check_outs[${hotelIndex}]" class="form-control-styled">
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
        hotelIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Includes repeater ----
    let includeIndex = {{ $tourPackage->includes->count() }};
    document.getElementById('add-include-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field">
                <label>Text</label>
                <input type="text" name="include_texts[${includeIndex}]" class="form-control-styled">
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-include-rows').appendChild(row);
        includeIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Excludes repeater ----
    let excludeIndex = {{ $tourPackage->excludes->count() }};
    document.getElementById('add-exclude-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field">
                <label>Text</label>
                <input type="text" name="exclude_texts[${excludeIndex}]" class="form-control-styled">
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-exclude-rows').appendChild(row);
        excludeIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Policies repeater ----
    let policyIndex = {{ $tourPackage->policies->count() }};
    document.getElementById('add-policy-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field">
                <label>Title</label>
                <input type="text" name="policy_titles[${policyIndex}]" class="form-control-styled">
            </div>
            <div class="form-field">
                <label>Content</label>
                <textarea name="policy_contents[${policyIndex}]" class="form-control-styled" rows="4"></textarea>
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-policy-rows').appendChild(row);
        policyIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- FAQ repeater ----
    let faqIndex = {{ $tourPackage->faqs->count() }};
    document.getElementById('add-faq-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field">
                <label>Question</label>
                <input type="text" name="faq_questions[${faqIndex}]" class="form-control-styled">
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
            <select name="destination_ids[]" class="form-control-styled">${destinationOptionsHtml()}</select>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('new-destination-rows').appendChild(row);
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
            <select name="attraction_ids[]" class="form-control-styled">${attractionOptionsHtml()}</select>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('new-attraction-rows').appendChild(row);
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
            <select name="activity_ids[]" class="form-control-styled">${activityOptionsHtml()}</select>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('new-activity-rows').appendChild(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

</script>

@include('admin.footer')