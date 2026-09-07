{{-- resources/views/admin/destination/edit.blade.php --}}
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

        .current-img-preview {
            width: 72px;
            height: 72px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            border: 1px solid var(--border);
            margin-bottom: 10px;
            display: block;
        }

        .seo-section-title {
            font-size: 13px;
            font-weight: 650;
            margin-bottom: 14px;
        }

        .gallery-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            gap: 10px;
            align-items: end;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px dashed var(--border);
        }

        .gallery-existing-thumb {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            border: 1px solid var(--border);
            margin-bottom: 6px;
        }

        .gallery-remove {
            border: 1px solid var(--border);
            background: var(--surface);
            border-radius: var(--radius-sm);
            height: 40px;
            width: 40px;
            cursor: pointer;
            color: #b22222;
        }

        .add-gallery-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent-light);
            color: var(--accent);
            border: 1px dashed var(--accent);
            border-radius: var(--radius-sm);
            padding: 8px 14px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        /* ---- Tabs ---- */
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
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Edit Destination</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.destinations.index') }}">Destinations</a>
                        <span>›</span>
                        Edit
                    </div>
                </div>
                <a href="{{ route('admin.destinations.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.destinations.update', $destination) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="cat-tabs" id="destination-tabs">
                        <button type="button" class="cat-tab active" data-tab="general">General</button>
                        <button type="button" class="cat-tab" data-tab="location">Location</button>
                        <button type="button" class="cat-tab" data-tab="gallery">Gallery</button>
                        <button type="button" class="cat-tab" data-tab="matches">Trip Matches</button>
                        <button type="button" class="cat-tab" data-tab="areas">Stay Areas</button>
                        <button type="button" class="cat-tab" data-tab="highlights">Highlights</button>
                        <button type="button" class="cat-tab" data-tab="places">Places</button>
                        <button type="button" class="cat-tab" data-tab="banner">Offer Banner</button>
                        <button type="button" class="cat-tab" data-tab="activities">Activities</button>
                        <button type="button" class="cat-tab" data-tab="routes">Routes</button>
                        <button type="button" class="cat-tab" data-tab="journey">Sample Itinerary</button>
                        <button type="button" class="cat-tab" data-tab="season">Season</button>
                        <button type="button" class="cat-tab" data-tab="budget">Budget</button>
                        <button type="button" class="cat-tab" data-tab="more-about">More About</button>
                        <button type="button" class="cat-tab" data-tab="faqs">FAQs</button>
                        <button type="button" class="cat-tab" data-tab="seo">SEO / Open Graph</button>
                    </div>

                    {{-- ============ GENERAL ============ --}}
                    <div class="cat-tab-panel active" data-panel="general">

                        <div class="form-field">
                            <label for="name">Destination Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control-styled @error('name') is-invalid @enderror"
                                value="{{ old('name', $destination->name) }}" required>
                            @error('name')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" class="form-control-styled" readonly
                                value="{{ $destination->slug }}">
                            <div class="hint">Regenerates automatically if you change the name</div>
                        </div>

                        <div class="form-field">
                            <label for="image">Image</label>
                            @if($destination->image)
                                <img src="{{ asset('storage/' . $destination->image) }}" class="current-img-preview"
                                    alt="{{ $destination->name }}">
                            @endif
                            <input type="file" id="image" name="image"
                                class="form-control-styled @error('image') is-invalid @enderror" accept="image/*">
                            <div class="hint">Leave blank to keep the current image</div>
                            @error('image')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="short_description">Short Description</label>
                            <textarea id="short_description" name="short_description" rows="2"
                                class="form-control-styled @error('short_description') is-invalid @enderror">{{ old('short_description', $destination->short_description) }}</textarea>
                            @error('short_description')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="description">Long Description</label>
                            <textarea id="description" name="description" rows="5"
                                class="form-control-styled @error('description') is-invalid @enderror">{{ old('description', $destination->description) }}</textarea>
                            @error('description')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="duration_text">Duration</label>
                                <input type="text" id="duration_text" name="duration_text" class="form-control-styled"
                                    value="{{ old('duration_text', $destination->duration_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="best_time_text">Best Time</label>
                                <input type="text" id="best_time_text" name="best_time_text" class="form-control-styled"
                                    value="{{ old('best_time_text', $destination->best_time_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="budget_text">Budget</label>
                                <input type="text" id="budget_text" name="budget_text" class="form-control-styled"
                                    value="{{ old('budget_text', $destination->budget_text) }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="best_for_tags">Best For (tags)</label>
                            <input type="text" id="best_for_tags" name="best_for_tags" class="form-control-styled"
                                value="{{ old('best_for_tags', implode(', ', $destination->best_for_tags ?? [])) }}">
                            <div class="hint">Comma-separated — shown as individual tags on the detail page</div>
                        </div>

                        <div class="form-field toggle-row">
                            <label class="switch">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $destination->is_featured) ? 'checked' : '' }}>
                                <span class="switch-slider"></span>
                            </label>
                            <label style="margin:0">Featured Destination</label>
                        </div>

                        <div class="form-field">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control-styled">
                                <option value="draft" {{ old('status', $destination->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $destination->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="unpublished" {{ old('status', $destination->status) == 'unpublished' ? 'selected' : '' }}>Unpublished</option>
                            </select>
                        </div>

                    </div>

                    {{-- ============ LOCATION ============ --}}
                    <div class="cat-tab-panel" data-panel="location">

                        <div class="form-row">
                            <div class="form-field">
                                <label for="country_id">Country</label>
                                <select id="country_id" name="country_id"
                                    class="form-control-styled @error('country_id') is-invalid @enderror" required>
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id', $destination->country_id) == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-field">
                                <label for="state_id">State</label>
                                <select id="state_id" name="state_id" class="form-control-styled">
                                    <option value="">Select State (optional)</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ old('state_id', $destination->state_id) == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-field">
                                <label for="city_id">City</label>
                                <select id="city_id" name="city_id" class="form-control-styled">
                                    <option value="">Select City (optional)</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ old('city_id', $destination->city_id) == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    {{-- ============ GALLERY ============ --}}
                    <div class="cat-tab-panel" data-panel="gallery">

                        <div class="seo-section-title">Gallery Images</div>

                        @foreach($destination->galleries as $galleryItem)
                            <div class="gallery-row">
                                <div class="form-field" style="margin:0">
                                    <label>Image</label>
                                    @if($galleryItem->image)
                                        <img src="{{ asset('storage/' . $galleryItem->image) }}" class="gallery-existing-thumb"
                                            alt="">
                                    @endif
                                    <input type="hidden" name="existing_gallery[{{ $galleryItem->id }}][id]"
                                        value="{{ $galleryItem->id }}">
                                    <input type="file" name="existing_gallery[{{ $galleryItem->id }}][image]"
                                        class="form-control-styled" accept="image/*">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Title</label>
                                    <input type="text" name="existing_gallery[{{ $galleryItem->id }}][title]"
                                        class="form-control-styled" value="{{ $galleryItem->title }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Subtitle</label>
                                    <input type="text" name="existing_gallery[{{ $galleryItem->id }}][subtitle]"
                                        class="form-control-styled" value="{{ $galleryItem->subtitle }}">
                                </div>
                                <label class="gallery-remove"
                                    style="display:flex;align-items:center;justify-content:center;">
                                    <input type="checkbox" name="remove_gallery_ids[]" value="{{ $galleryItem->id }}"
                                        style="margin:0">
                                </label>
                            </div>
                        @endforeach

                        <div class="hint" style="margin-bottom:14px;">Tick the checkbox next to an image to remove it on
                            save.</div>

                        <div id="gallery-wrapper"></div>

                        <button type="button" class="add-gallery-btn" onclick="addGalleryRow()">
                            <i class="fa fa-plus"></i> Add New Gallery Image
                        </button>

                    </div>

                    {{-- ============ TRIP MATCHES ============ --}}
                    <div class="cat-tab-panel" data-panel="matches">

                        <div class="seo-section-title">Trip Match List</div>
                        <div class="hint" style="margin-bottom:14px;">These render as "Is this destination right for
                            you?" comparison rows on the detail page.</div>

                        <div class="form-field">
                            <label for="verdict_title">Verdict Title</label>
                            <input type="text" id="verdict_title" name="verdict_title" class="form-control-styled"
                                value="{{ old('verdict_title', $destination->verdict_title) }}"
                                placeholder="e.g. Is Kashmir right for you?">
                        </div>

                        <div class="form-field">
                            <label for="recommended_for">Recommended For</label>
                            <input type="text" id="recommended_for" name="recommended_for" class="form-control-styled"
                                value="{{ old('recommended_for', $destination->recommended_for) }}"
                                placeholder="e.g. First-time visitors, couples, families and nature lovers.">
                        </div>

                        @foreach($destination->matches as $matchItem)
                            <div class="gallery-row">
                                <div class="form-field" style="margin:0">
                                    <label>Icon</label>
                                    @if($matchItem->icon)
                                        <img src="{{ asset('storage/' . $matchItem->icon) }}" class="gallery-existing-thumb"
                                            alt="">
                                    @endif
                                    <input type="hidden" name="existing_match[{{ $matchItem->id }}][id]"
                                        value="{{ $matchItem->id }}">
                                    <input type="file" name="existing_match[{{ $matchItem->id }}][icon]"
                                        class="form-control-styled" accept="image/*">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Want</label>
                                    <input type="text" name="existing_match[{{ $matchItem->id }}][want]"
                                        class="form-control-styled" value="{{ $matchItem->want }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Offer Text</label>
                                    <input type="text" name="existing_match[{{ $matchItem->id }}][offer_text]"
                                        class="form-control-styled" value="{{ $matchItem->offer_text }}">
                                </div>
                                <label class="gallery-remove"
                                    style="display:flex;align-items:center;justify-content:center;">
                                    <input type="checkbox" name="remove_match_ids[]" value="{{ $matchItem->id }}"
                                        style="margin:0">
                                </label>
                            </div>
                        @endforeach

                        <div class="hint" style="margin-bottom:14px;">Tick the checkbox next to a row to remove it on
                            save.</div>

                        <div id="match-wrapper"></div>

                        <button type="button" class="add-gallery-btn" onclick="addMatchRow()">
                            <i class="fa fa-plus"></i> Add New Match Row
                        </button>

                    </div>

                    {{-- ============ STAY AREAS ============ --}}
                    <div class="cat-tab-panel" data-panel="areas">

                        <div class="seo-section-title">Where to Stay</div>
                        <div class="hint" style="margin-bottom:14px;">Tick the checkbox next to a row to remove it on
                            save.</div>

                        @foreach($destination->areas as $areaItem)
                            <div class="gallery-row" style="grid-template-columns: 1fr 1fr 1fr 1fr 1fr auto;">
                                <div class="form-field" style="margin:0">
                                    <label>Image</label>
                                    @if($areaItem->image)
                                        <img src="{{ asset('storage/' . $areaItem->image) }}" class="gallery-existing-thumb"
                                            alt="">
                                    @endif
                                    <input type="hidden" name="existing_area[{{ $areaItem->id }}][id]"
                                        value="{{ $areaItem->id }}">
                                    <input type="file" name="existing_area[{{ $areaItem->id }}][image]"
                                        class="form-control-styled" accept="image/*">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Name</label>
                                    <input type="text" name="existing_area[{{ $areaItem->id }}][name]"
                                        class="form-control-styled" value="{{ $areaItem->name }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Tag</label>
                                    <input type="text" name="existing_area[{{ $areaItem->id }}][tag]"
                                        class="form-control-styled" value="{{ $areaItem->tag }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Stay Duration</label>
                                    <input type="text" name="existing_area[{{ $areaItem->id }}][stay_duration]"
                                        class="form-control-styled" value="{{ $areaItem->stay_duration }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Nearby</label>
                                    <input type="text" name="existing_area[{{ $areaItem->id }}][nearby_text]"
                                        class="form-control-styled" value="{{ $areaItem->nearby_text }}">
                                </div>
                                <label class="gallery-remove"
                                    style="display:flex;align-items:center;justify-content:center;">
                                    <input type="checkbox" name="remove_area_ids[]" value="{{ $areaItem->id }}"
                                        style="margin:0">
                                </label>
                            </div>
                            <div class="form-field">
                                <label>Why (description)</label>
                                <textarea name="existing_area[{{ $areaItem->id }}][why_text]" rows="2"
                                    class="form-control-styled">{{ $areaItem->why_text }}</textarea>
                            </div>
                        @endforeach

                        <div id="area-wrapper"></div>

                        <button type="button" class="add-gallery-btn" onclick="addAreaRow()">
                            <i class="fa fa-plus"></i> Add New Stay Area
                        </button>

                    </div>

                    {{-- ============ HIGHLIGHTS ============ --}}
                    <div class="cat-tab-panel" data-panel="highlights">

                        <div class="seo-section-title">Why Visit — Media</div>

                        <div class="form-field">
                            <label for="why_visit_image">Section Image</label>
                            @if($destination->why_visit_image)
                                <img src="{{ asset('storage/' . $destination->why_visit_image) }}"
                                    class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="why_visit_image" name="why_visit_image"
                                class="form-control-styled @error('why_visit_image') is-invalid @enderror"
                                accept="image/*">
                            <div class="hint">Leave blank to keep the current image</div>
                            @error('why_visit_image')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="why_visit_media_tag">Media Tag</label>
                            <input type="text" id="why_visit_media_tag" name="why_visit_media_tag"
                                class="form-control-styled"
                                value="{{ old('why_visit_media_tag', $destination->why_visit_media_tag) }}"
                                placeholder="e.g. Dal Lake, Srinagar">
                        </div>

                        <div class="seo-section-title" style="margin-top:24px;">Highlight List</div>
                        <div class="hint" style="margin-bottom:14px;">Tick the checkbox next to a row to remove it on
                            save.</div>

                        @foreach($destination->highlights as $highlightItem)
                            <div class="gallery-row">
                                <div class="form-field" style="margin:0">
                                    <label>Icon</label>
                                    @if($highlightItem->icon)
                                        <img src="{{ asset('storage/' . $highlightItem->icon) }}" class="gallery-existing-thumb"
                                            alt="">
                                    @endif
                                    <input type="hidden" name="existing_highlight[{{ $highlightItem->id }}][id]"
                                        value="{{ $highlightItem->id }}">
                                    <input type="file" name="existing_highlight[{{ $highlightItem->id }}][icon]"
                                        class="form-control-styled" accept="image/*">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Title</label>
                                    <input type="text" name="existing_highlight[{{ $highlightItem->id }}][title]"
                                        class="form-control-styled" value="{{ $highlightItem->title }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Description</label>
                                    <input type="text" name="existing_highlight[{{ $highlightItem->id }}][description]"
                                        class="form-control-styled" value="{{ $highlightItem->description }}">
                                </div>
                                <label class="gallery-remove"
                                    style="display:flex;align-items:center;justify-content:center;">
                                    <input type="checkbox" name="remove_highlight_ids[]" value="{{ $highlightItem->id }}"
                                        style="margin:0">
                                </label>
                            </div>
                        @endforeach

                        <div id="highlight-wrapper"></div>

                        <button type="button" class="add-gallery-btn" onclick="addHighlightRow()">
                            <i class="fa fa-plus"></i> Add New Highlight
                        </button>

                    </div>

                    {{-- ============ PLACES TO VISIT ============ --}}
                    <div class="cat-tab-panel" data-panel="places">

                        <div class="seo-section-title">Places to Visit</div>
                        <div class="hint" style="margin-bottom:14px;">Mark one place "Featured" to show it as the large
                            card. Tick the checkbox to remove a row on save.</div>

                        @foreach($destination->places as $placeItem)
                            <div class="gallery-row" style="grid-template-columns: 1fr 1fr 1fr auto auto;">
                                <div class="form-field" style="margin:0">
                                    <label>Image</label>
                                    @if($placeItem->image)
                                        <img src="{{ asset('storage/' . $placeItem->image) }}" class="gallery-existing-thumb"
                                            alt="">
                                    @endif
                                    <input type="hidden" name="existing_place[{{ $placeItem->id }}][id]"
                                        value="{{ $placeItem->id }}">
                                    <input type="file" name="existing_place[{{ $placeItem->id }}][image]"
                                        class="form-control-styled" accept="image/*">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Name</label>
                                    <input type="text" name="existing_place[{{ $placeItem->id }}][name]"
                                        class="form-control-styled" value="{{ $placeItem->name }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Description</label>
                                    <input type="text" name="existing_place[{{ $placeItem->id }}][description]"
                                        class="form-control-styled" value="{{ $placeItem->description }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Featured</label>
                                    <label class="switch">
                                        <input type="checkbox" name="existing_place[{{ $placeItem->id }}][is_featured]"
                                            value="1" {{ $placeItem->is_featured ? 'checked' : '' }}>
                                        <span class="switch-slider"></span>
                                    </label>
                                </div>
                                <label class="gallery-remove"
                                    style="display:flex;align-items:center;justify-content:center;">
                                    <input type="checkbox" name="remove_place_ids[]" value="{{ $placeItem->id }}"
                                        style="margin:0">
                                </label>
                            </div>
                        @endforeach

                        <div id="place-wrapper"></div>

                        <button type="button" class="add-gallery-btn" onclick="addPlaceRow()">
                            <i class="fa fa-plus"></i> Add New Place
                        </button>

                    </div>

                    {{-- ============ OFFER BANNER ============ --}}
                    <div class="cat-tab-panel" data-panel="banner">
                        @php $banner = $destination->banner; @endphp

                        <div class="seo-section-title">Group Offer Banner</div>
                        <div class="hint" style="margin-bottom:14px;">Always shows on the page — leave fields blank to
                            use the default copy.</div>

                        <input type="hidden" name="banner[id]" value="{{ $banner->id ?? '' }}">

                        <div class="form-field">
                            <label for="banner_badge_text">Badge Text</label>
                            <input type="text" id="banner_badge_text" name="banner[badge_text]"
                                class="form-control-styled"
                                value="{{ old('banner.badge_text', $banner->badge_text ?? '') }}"
                                placeholder="e.g. Limited-Time Offer">
                        </div>

                        <div class="form-field">
                            <label for="banner_heading">Heading</label>
                            <input type="text" id="banner_heading" name="banner[heading]" class="form-control-styled"
                                value="{{ old('banner.heading', $banner->heading ?? '') }}"
                                placeholder="e.g. Book Your Kashmir Trip Early — Save Up to 40%">
                        </div>

                        <div class="form-field">
                            <label for="banner_description">Description</label>
                            <textarea id="banner_description" name="banner[description]" rows="2"
                                class="form-control-styled">{{ old('banner.description', $banner->description ?? '') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="banner_perks">Perks</label>
                            <input type="text" id="banner_perks" name="banner[perks]" class="form-control-styled"
                                value="{{ old('banner.perks', $banner && $banner->perks ? implode(', ', $banner->perks) : '') }}"
                                placeholder="Early Bird Discount up to 40% Off, Free Airport Transfers, Flexible Rescheduling">
                            <div class="hint">Comma-separated — each becomes a perk line</div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="banner_cta_primary_text">Primary Button Text</label>
                                <input type="text" id="banner_cta_primary_text" name="banner[cta_primary_text]"
                                    class="form-control-styled"
                                    value="{{ old('banner.cta_primary_text', $banner->cta_primary_text ?? '') }}"
                                    placeholder="Explore Packages">
                            </div>
                            <div class="form-field">
                                <label for="banner_cta_primary_link">Primary Button Link</label>
                                <input type="text" id="banner_cta_primary_link" name="banner[cta_primary_link]"
                                    class="form-control-styled"
                                    value="{{ old('banner.cta_primary_link', $banner->cta_primary_link ?? '') }}"
                                    placeholder="/packages">
                            </div>
                            <div class="form-field">
                                <label for="banner_cta_secondary_text">Secondary Button Text</label>
                                <input type="text" id="banner_cta_secondary_text" name="banner[cta_secondary_text]"
                                    class="form-control-styled"
                                    value="{{ old('banner.cta_secondary_text', $banner->cta_secondary_text ?? '') }}"
                                    placeholder="Get A Quote">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="banner_image">Banner Image</label>
                            @if($banner && $banner->image)
                                <img src="{{ asset('storage/' . $banner->image) }}" class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="banner_image" name="banner_image" class="form-control-styled"
                                accept="image/*">
                            <div class="hint">Leave blank to keep the current image (or the default if none is set)
                            </div>
                        </div>
                    </div>

                    {{-- ============ ACTIVITIES ============ --}}
                    <div class="cat-tab-panel" data-panel="activities">
                        <div class="seo-section-title">Experiences You Shouldn't Miss</div>
                        <div class="hint" style="margin-bottom:14px;">Mark one activity "Featured" to show it as the
                            large card. Tick the checkbox to remove a row on save.</div>

                        @foreach($destination->activities as $activityItem)
                            <div class="gallery-row" style="grid-template-columns: 1fr 1fr 1fr 1fr auto auto;">
                                <div class="form-field" style="margin:0">
                                    <label>Image</label>
                                    @if($activityItem->image)
                                        <img src="{{ asset('storage/' . $activityItem->image) }}" class="gallery-existing-thumb"
                                            alt="">
                                    @endif
                                    <input type="hidden" name="existing_activity[{{ $activityItem->id }}][id]"
                                        value="{{ $activityItem->id }}">
                                    <input type="file" name="existing_activity[{{ $activityItem->id }}][image]"
                                        class="form-control-styled" accept="image/*">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Tag</label>
                                    <input type="text" name="existing_activity[{{ $activityItem->id }}][tag]"
                                        class="form-control-styled" value="{{ $activityItem->tag }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Title</label>
                                    <input type="text" name="existing_activity[{{ $activityItem->id }}][title]"
                                        class="form-control-styled" value="{{ $activityItem->title }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Description</label>
                                    <input type="text" name="existing_activity[{{ $activityItem->id }}][description]"
                                        class="form-control-styled" value="{{ $activityItem->description }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Featured</label>
                                    <label class="switch">
                                        <input type="checkbox"
                                            name="existing_activity[{{ $activityItem->id }}][is_featured]" value="1" {{ $activityItem->is_featured ? 'checked' : '' }}>
                                        <span class="switch-slider"></span>
                                    </label>
                                </div>
                                <label class="gallery-remove"
                                    style="display:flex;align-items:center;justify-content:center;">
                                    <input type="checkbox" name="remove_activity_ids[]" value="{{ $activityItem->id }}"
                                        style="margin:0">
                                </label>
                            </div>
                        @endforeach

                        <div id="activity-wrapper"></div>

                        <button type="button" class="add-gallery-btn" onclick="addActivityRow()">
                            <i class="fa fa-plus"></i> Add New Activity
                        </button>
                    </div>

                    {{-- ============ ROUTES ============ --}}
                    <div class="cat-tab-panel" data-panel="routes">
                        <div class="seo-section-title">Route Options</div>
                        <div class="hint" style="margin-bottom:14px;">Tick the checkbox to remove a row on save.</div>

                        @foreach($destination->routes as $routeItem)
                            <div class="gallery-row" style="grid-template-columns: 80px 1fr 1fr 1fr auto;">
                                <input type="hidden" name="existing_route[{{ $routeItem->id }}][id]"
                                    value="{{ $routeItem->id }}">
                                <div class="form-field" style="margin:0">
                                    <label>Days</label>
                                    <input type="number" name="existing_route[{{ $routeItem->id }}][days]"
                                        class="form-control-styled" value="{{ $routeItem->days }}" min="1">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Label</label>
                                    <input type="text" name="existing_route[{{ $routeItem->id }}][label]"
                                        class="form-control-styled" value="{{ $routeItem->label }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Subtitle</label>
                                    <input type="text" name="existing_route[{{ $routeItem->id }}][subtitle]"
                                        class="form-control-styled" value="{{ $routeItem->subtitle }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Path (comma-separated)</label>
                                    <input type="text" name="existing_route[{{ $routeItem->id }}][path]"
                                        class="form-control-styled"
                                        value="{{ $routeItem->path ? implode(', ', $routeItem->path) : '' }}">
                                </div>
                                <label class="gallery-remove"
                                    style="display:flex;align-items:center;justify-content:center;">
                                    <input type="checkbox" name="remove_route_ids[]" value="{{ $routeItem->id }}"
                                        style="margin:0">
                                </label>
                            </div>
                            <div class="form-field">
                                <label>Note</label>
                                <textarea name="existing_route[{{ $routeItem->id }}][note]" rows="2"
                                    class="form-control-styled">{{ $routeItem->note }}</textarea>
                            </div>
                        @endforeach

                        <div id="route-wrapper"></div>

                        <button type="button" class="add-gallery-btn" onclick="addRouteRow()">
                            <i class="fa fa-plus"></i> Add New Route
                        </button>
                    </div>

                    {{-- ============ SAMPLE ITINERARY ============ --}}
                    <div class="cat-tab-panel" data-panel="journey">
                        <div class="seo-section-title">Day-by-Day Itinerary</div>
                        <div class="hint" style="margin-bottom:14px;">Tick the checkbox to remove a row on save.</div>

                        @foreach($destination->journeyDays as $dayItem)
                            <div class="gallery-row" style="grid-template-columns: 90px 1fr 1fr auto;">
                                <input type="hidden" name="existing_journey[{{ $dayItem->id }}][id]"
                                    value="{{ $dayItem->id }}">
                                <div class="form-field" style="margin:0">
                                    <label>Day #</label>
                                    <input type="number" name="existing_journey[{{ $dayItem->id }}][day_number]"
                                        class="form-control-styled" value="{{ $dayItem->day_number }}" min="1">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Title</label>
                                    <input type="text" name="existing_journey[{{ $dayItem->id }}][title]"
                                        class="form-control-styled" value="{{ $dayItem->title }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Image</label>
                                    @if($dayItem->image)
                                        <img src="{{ asset('storage/' . $dayItem->image) }}" class="gallery-existing-thumb"
                                            alt="">
                                    @endif
                                    <input type="file" name="existing_journey[{{ $dayItem->id }}][image]"
                                        class="form-control-styled" accept="image/*">
                                </div>
                                <label class="gallery-remove"
                                    style="display:flex;align-items:center;justify-content:center;">
                                    <input type="checkbox" name="remove_journey_ids[]" value="{{ $dayItem->id }}"
                                        style="margin:0">
                                </label>
                            </div>
                            <div class="form-field">
                                <label>Flow</label>
                                <input type="text" name="existing_journey[{{ $dayItem->id }}][flow_text]"
                                    class="form-control-styled" value="{{ $dayItem->flow_text }}">
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label>Stay</label>
                                    <input type="text" name="existing_journey[{{ $dayItem->id }}][stay_text]"
                                        class="form-control-styled" value="{{ $dayItem->stay_text }}">
                                </div>
                                <div class="form-field">
                                    <label>Taste</label>
                                    <input type="text" name="existing_journey[{{ $dayItem->id }}][food_text]"
                                        class="form-control-styled" value="{{ $dayItem->food_text }}">
                                </div>
                                <div class="form-field toggle-row" style="align-self:end; margin-bottom:18px;">
                                    <label class="switch">
                                        <input type="checkbox" name="existing_journey[{{ $dayItem->id }}][is_departure]"
                                            value="1" {{ $dayItem->is_departure ? 'checked' : '' }}>
                                        <span class="switch-slider"></span>
                                    </label>
                                    <label style="margin:0">Departure day</label>
                                </div>
                            </div>
                        @endforeach

                        <div id="journey-wrapper"></div>

                        <button type="button" class="add-gallery-btn" onclick="addJourneyRow()">
                            <i class="fa fa-plus"></i> Add New Day
                        </button>
                    </div>

                    {{-- ============ SEASON ============ --}}
                    <div class="cat-tab-panel" data-panel="season">
                        <div class="seo-section-title">Seasons</div>

                        <div id="season-wrapper">
                            @foreach($destination->seasons as $i => $seasonItem)
                                <div class="gallery-row" style="grid-template-columns: 1fr 1fr 2fr auto;">
                                    <div class="form-field" style="margin:0">
                                        <label>Range</label>
                                        <input type="text" name="season[{{ $i }}][range_text]" class="form-control-styled"
                                            value="{{ $seasonItem->range_text }}">
                                    </div>
                                    <div class="form-field" style="margin:0">
                                        <label>Name</label>
                                        <input type="text" name="season[{{ $i }}][name]" class="form-control-styled"
                                            value="{{ $seasonItem->name }}">
                                    </div>
                                    <div class="form-field" style="margin:0">
                                        <label>Description</label>
                                        <input type="text" name="season[{{ $i }}][description]" class="form-control-styled"
                                            value="{{ $seasonItem->description }}">
                                    </div>
                                    <button type="button" class="gallery-remove"
                                        onclick="this.closest('.gallery-row').remove()">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="add-gallery-btn" onclick="addSeasonRow()">
                            <i class="fa fa-plus"></i> Add Season
                        </button>

                        <div class="seo-section-title" style="margin-top:24px;">Summary Highlights</div>

                        <div id="season-highlight-wrapper">
                            @foreach(($destination->season_highlights ?? []) as $i => $highlight)
                                <div class="gallery-row" style="grid-template-columns: 1fr 1fr auto;">
                                    <div class="form-field" style="margin:0">
                                        <label>Label</label>
                                        <input type="text" name="season_highlight[{{ $i }}][label]"
                                            class="form-control-styled" value="{{ $highlight['label'] ?? '' }}">
                                    </div>
                                    <div class="form-field" style="margin:0">
                                        <label>Value</label>
                                        <input type="text" name="season_highlight[{{ $i }}][value]"
                                            class="form-control-styled" value="{{ $highlight['value'] ?? '' }}">
                                    </div>
                                    <button type="button" class="gallery-remove"
                                        onclick="this.closest('.gallery-row').remove()">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="add-gallery-btn" onclick="addSeasonHighlightRow()">
                            <i class="fa fa-plus"></i> Add Highlight
                        </button>
                    </div>

                    {{-- ============ BUDGET ============ --}}
                    <div class="cat-tab-panel" data-panel="budget">
                        <div class="seo-section-title">Budget Tiers</div>

                        <div id="budget-tier-wrapper">
                            @foreach($destination->budgetTiers as $i => $tierItem)
                                <div class="gallery-row" style="grid-template-columns: 1fr 1fr 1fr 1fr auto;">
                                    <div class="form-field" style="margin:0">
                                        <label>Name</label>
                                        <input type="text" name="budget_tier[{{ $i }}][name]" class="form-control-styled"
                                            value="{{ $tierItem->name }}">
                                    </div>
                                    <div class="form-field" style="margin:0">
                                        <label>Price From</label>
                                        <input type="text" name="budget_tier[{{ $i }}][price_from]"
                                            class="form-control-styled" value="{{ $tierItem->price_from }}">
                                    </div>
                                    <div class="form-field" style="margin:0">
                                        <label>Price To</label>
                                        <input type="text" name="budget_tier[{{ $i }}][price_to]"
                                            class="form-control-styled" value="{{ $tierItem->price_to }}">
                                    </div>
                                    <div class="form-field" style="margin:0">
                                        <label>Suffix</label>
                                        <input type="text" name="budget_tier[{{ $i }}][price_suffix]"
                                            class="form-control-styled" value="{{ $tierItem->price_suffix }}">
                                    </div>
                                    <button type="button" class="gallery-remove"
                                        onclick="this.closest('div').parentElement.remove()">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                                <div class="form-row">
                                    <div class="form-field">
                                        <label>Description</label>
                                        <input type="text" name="budget_tier[{{ $i }}][description]"
                                            class="form-control-styled" value="{{ $tierItem->description }}">
                                    </div>
                                    <div class="form-field">
                                        <label>Badge Text</label>
                                        <input type="text" name="budget_tier[{{ $i }}][badge_text]"
                                            class="form-control-styled" value="{{ $tierItem->badge_text }}">
                                    </div>
                                    <div class="form-field toggle-row" style="align-self:end; margin-bottom:18px;">
                                        <label class="switch">
                                            <input type="checkbox" name="budget_tier[{{ $i }}][is_featured]" value="1" {{ $tierItem->is_featured ? 'checked' : '' }}>
                                            <span class="switch-slider"></span>
                                        </label>
                                        <label style="margin:0">Featured</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="add-gallery-btn" onclick="addBudgetTierRow()">
                            <i class="fa fa-plus"></i> Add Tier
                        </button>

                        <div class="seo-section-title" style="margin-top:24px;">Budget Breakdown</div>

                        <div id="budget-breakdown-wrapper">
                            @foreach($destination->budgetBreakdown as $i => $rowItem)
                                <div class="gallery-row" style="grid-template-columns: 1fr 1fr auto;">
                                    <div class="form-field" style="margin:0">
                                        <label>Label</label>
                                        <input type="text" name="budget_breakdown[{{ $i }}][label]"
                                            class="form-control-styled" value="{{ $rowItem->label }}">
                                    </div>
                                    <div class="form-field" style="margin:0">
                                        <label>Percent</label>
                                        <input type="number" name="budget_breakdown[{{ $i }}][percent]"
                                            class="form-control-styled" value="{{ $rowItem->percent }}" min="0" max="100">
                                    </div>
                                    <button type="button" class="gallery-remove"
                                        onclick="this.closest('.gallery-row').remove()">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="add-gallery-btn" onclick="addBudgetBreakdownRow()">
                            <i class="fa fa-plus"></i> Add Breakdown Row
                        </button>

                        <div class="seo-section-title" style="margin-top:24px;">Section Text</div>

                        <div class="form-field">
                            <label for="budget_intro_text">Subheading</label>
                            <input type="text" id="budget_intro_text" name="budget_intro_text"
                                class="form-control-styled"
                                value="{{ old('budget_intro_text', $destination->budget_intro_text) }}">
                        </div>

                        <div class="form-field">
                            <label for="budget_note">Note</label>
                            <textarea id="budget_note" name="budget_note" rows="2"
                                class="form-control-styled">{{ old('budget_note', $destination->budget_note) }}</textarea>
                        </div>
                    </div>

                    {{-- ============ MORE ABOUT ============ --}}
                    <div class="cat-tab-panel" data-panel="more-about">
                        <div class="seo-section-title">More About Section</div>
                        <div class="hint" style="margin-bottom:14px;">Long-form SEO content shown near the bottom of the
                            page.</div>

                        <div class="form-field">
                            <label for="more_about_intro">Subtitle</label>
                            <input type="text" id="more_about_intro" name="more_about_intro" class="form-control-styled"
                                value="{{ old('more_about_intro', $destination->more_about_intro) }}">
                        </div>

                        <div class="form-field">
                            <label for="more_about_content">Content</label>
                            <textarea id="more_about_content" name="more_about_content"
                                class="form-control-styled @error('more_about_content') is-invalid @enderror">{{ old('more_about_content', $destination->more_about_content) }}</textarea>
                            @error('more_about_content')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- ============ FAQS ============ --}}
                    <div class="cat-tab-panel" data-panel="faqs">
                        <div class="seo-section-title">Frequently Asked Questions</div>
                        <div class="hint" style="margin-bottom:14px;">Tick the checkbox to remove a row on save.</div>

                        @foreach($destination->faqs as $faqItem)
                            <div class="gallery-row" style="grid-template-columns: 1fr 1fr auto;">
                                <input type="hidden" name="existing_faq[{{ $faqItem->id }}][id]" value="{{ $faqItem->id }}">
                                <div class="form-field" style="margin:0">
                                    <label>Question</label>
                                    <input type="text" name="existing_faq[{{ $faqItem->id }}][question]"
                                        class="form-control-styled" value="{{ $faqItem->question }}">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Answer</label>
                                    <textarea name="existing_faq[{{ $faqItem->id }}][answer]" rows="2"
                                        class="form-control-styled">{{ $faqItem->answer }}</textarea>
                                </div>
                                <label class="gallery-remove"
                                    style="display:flex;align-items:center;justify-content:center;">
                                    <input type="checkbox" name="remove_faq_ids[]" value="{{ $faqItem->id }}"
                                        style="margin:0">
                                </label>
                            </div>
                        @endforeach

                        <div id="faq-wrapper"></div>

                        <button type="button" class="add-gallery-btn" onclick="addFaqRow()">
                            <i class="fa fa-plus"></i> Add New FAQ
                        </button>
                    </div>

                    {{-- ============ SEO ============ --}}
                    <div class="cat-tab-panel" data-panel="seo">

                        <div class="form-field">
                            <label for="h1">H1 Tag</label>
                            <input type="text" id="h1" name="h1"
                                class="form-control-styled @error('h1') is-invalid @enderror"
                                value="{{ old('h1', $destination->h1) }}">
                            @error('h1')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" class="form-control-styled"
                                value="{{ old('meta_title', $destination->meta_title) }}">
                        </div>

                        <div class="form-field">
                            <label for="meta_description">Meta Description</label>
                            <textarea id="meta_description" name="meta_description" rows="4"
                                class="form-control-styled">{{ old('meta_description', $destination->meta_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="og_title">OG Title</label>
                            <input type="text" id="og_title" name="og_title"
                                class="form-control-styled @error('og_title') is-invalid @enderror"
                                value="{{ old('og_title', $destination->og_title) }}">
                            @error('og_title')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="og_description">OG Description</label>
                            <textarea id="og_description" name="og_description" rows="3"
                                class="form-control-styled @error('og_description') is-invalid @enderror">{{ old('og_description', $destination->og_description) }}</textarea>
                            @error('og_description')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="og_image">OG Image</label>
                            @if($destination->og_image)
                                <img src="{{ asset('storage/' . $destination->og_image) }}" class="current-img-preview"
                                    alt="">
                            @endif
                            <input type="file" id="og_image" name="og_image"
                                class="form-control-styled @error('og_image') is-invalid @enderror" accept="image/*">
                            <div class="hint">Leave blank to keep the current OG image</div>
                            @error('og_image')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="canonical_url">Canonical URL</label>
                            <input type="text" id="canonical_url" name="canonical_url"
                                class="form-control-styled @error('canonical_url') is-invalid @enderror"
                                value="{{ old('canonical_url', $destination->canonical_url) }}">
                            @error('canonical_url')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Update Destination
                        </button>
                        <a href="{{ route('admin.destinations.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#more_about_content'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'link', '|',
                'bulletedList', 'numberedList', '|',
                'blockQuote', 'undo', 'redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    // ---- Tabs ----
    document.querySelectorAll('#destination-tabs .cat-tab').forEach(function (tabBtn) {
        tabBtn.addEventListener('click', function () {
            document.querySelectorAll('#destination-tabs .cat-tab').forEach(b => b.classList.remove('active'));
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

        document.querySelectorAll('#destination-tabs .cat-tab').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.remove('active'));
        panel.classList.add('active');
        document.querySelector('#destination-tabs .cat-tab[data-tab="' + panel.dataset.panel + '"]').classList.add('active');
    })();

    let galleryIndex = 0;
    let matchIndex = 0;
    let areaIndex = 0;
    let highlightIndex = 0;
    let placeIndex = 0;
    let activityIndex = 0;
    let routeIndex = 0;
    let journeyIndex = 0;
    let seasonIndex = {{ $destination->seasons->count() }};
    let seasonHighlightIndex = {{ count($destination->season_highlights ?? []) }};
    let budgetTierIndex = {{ $destination->budgetTiers->count() }};
    let budgetBreakdownIndex = {{ $destination->budgetBreakdown->count() }};
    let faqIndex = 0;

    // ---- Cascading Country -> State -> City (re-fetch only if user changes country) ----
    const countrySelect = document.getElementById('country_id');
    const stateSelect = document.getElementById('state_id');
    const citySelect = document.getElementById('city_id');

    countrySelect.addEventListener('change', function () {
        stateSelect.innerHTML = '<option value="">Select State (optional)</option>';
        citySelect.innerHTML = '<option value="">Select City (optional)</option>';

        if (!this.value) return;

        fetch(`{{ url('admin/destinations/states') }}/${this.value}`)
            .then(res => res.json())
            .then(states => {
                states.forEach(state => {
                    stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                });
            });
    });

    stateSelect.addEventListener('change', function () {
        citySelect.innerHTML = '<option value="">Select City (optional)</option>';

        if (!this.value) return;

        fetch(`{{ url('admin/destinations/cities') }}/${this.value}`)
            .then(res => res.json())
            .then(cities => {
                cities.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                });
            });
    });

    // ---- Gallery repeater (new rows only — existing ones render above) ----
    function addGalleryRow() {
        const wrapper = document.getElementById('gallery-wrapper');
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field" style="margin:0">
                <label>Image</label>
                <input type="file" name="gallery[${galleryIndex}][image]" class="form-control-styled" accept="image/*">
            </div>
            <div class="form-field" style="margin:0">
                <label>Title</label>
                <input type="text" name="gallery[${galleryIndex}][title]" class="form-control-styled" placeholder="e.g. Dal Lake">
            </div>
            <div class="form-field" style="margin:0">
                <label>Subtitle</label>
                <input type="text" name="gallery[${galleryIndex}][subtitle]" class="form-control-styled" placeholder="e.g. Srinagar, Kashmir">
            </div>
            <button type="button" class="gallery-remove" onclick="this.closest('.gallery-row').remove()">
                <i class="fa fa-times"></i>
            </button>
        `;
        wrapper.appendChild(row);
        galleryIndex++;
    }

    // ---- Trip match repeater (new rows only — existing ones render above) ----
    function addMatchRow() {
        const wrapper = document.getElementById('match-wrapper');
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field" style="margin:0">
                <label>Icon</label>
                <input type="file" name="match[${matchIndex}][icon]" class="form-control-styled" accept="image/*">
            </div>
            <div class="form-field" style="margin:0">
                <label>Want</label>
                <input type="text" name="match[${matchIndex}][want]" class="form-control-styled" placeholder="e.g. Mountains">
            </div>
            <div class="form-field" style="margin:0">
                <label>Offer Text</label>
                <input type="text" name="match[${matchIndex}][offer_text]" class="form-control-styled" placeholder="e.g. Himalayan valleys and panoramic viewpoints.">
            </div>
            <button type="button" class="gallery-remove" onclick="this.closest('.gallery-row').remove()">
                <i class="fa fa-times"></i>
            </button>
        `;
        wrapper.appendChild(row);
        matchIndex++;
    }

    // ---- Stay area repeater ----
    function addAreaRow() {
        const wrapper = document.getElementById('area-wrapper');
        const row = document.createElement('div');
        row.innerHTML = `
        <div class="gallery-row" style="grid-template-columns: 1fr 1fr 1fr 1fr 1fr auto;">
            <div class="form-field" style="margin:0">
                <label>Image</label>
                <input type="file" name="area[${areaIndex}][image]" class="form-control-styled" accept="image/*">
            </div>
            <div class="form-field" style="margin:0">
                <label>Name</label>
                <input type="text" name="area[${areaIndex}][name]" class="form-control-styled" placeholder="e.g. Gulmarg">
            </div>
            <div class="form-field" style="margin:0">
                <label>Tag</label>
                <input type="text" name="area[${areaIndex}][tag]" class="form-control-styled" placeholder="e.g. Best for snow & adventure">
            </div>
            <div class="form-field" style="margin:0">
                <label>Stay Duration</label>
                <input type="text" name="area[${areaIndex}][stay_duration]" class="form-control-styled" placeholder="e.g. 1–2 Nights">
            </div>
            <div class="form-field" style="margin:0">
                <label>Nearby</label>
                <input type="text" name="area[${areaIndex}][nearby_text]" class="form-control-styled" placeholder="e.g. Gulmarg Gondola · Ski Slopes">
            </div>
            <button type="button" class="gallery-remove" onclick="this.closest('div').parentElement.remove()">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="form-field">
            <label>Why (description)</label>
            <textarea name="area[${areaIndex}][why_text]" rows="2" class="form-control-styled"></textarea>
        </div>
    `;
        wrapper.appendChild(row);
        areaIndex++;
    }

    // ---- Highlight repeater ----
    function addHighlightRow() {
        const wrapper = document.getElementById('highlight-wrapper');
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field" style="margin:0">
            <label>Icon</label>
            <input type="file" name="highlight[${highlightIndex}][icon]" class="form-control-styled" accept="image/*">
        </div>
        <div class="form-field" style="margin:0">
            <label>Title</label>
            <input type="text" name="highlight[${highlightIndex}][title]" class="form-control-styled" placeholder="e.g. Snow & Winter Activities">
        </div>
        <div class="form-field" style="margin:0">
            <label>Description</label>
            <input type="text" name="highlight[${highlightIndex}][description]" class="form-control-styled" placeholder="e.g. Skiing and snow play in Gulmarg's slopes.">
        </div>
        <button type="button" class="gallery-remove" onclick="this.closest('.gallery-row').remove()">
            <i class="fa fa-times"></i>
        </button>
    `;
        wrapper.appendChild(row);
        highlightIndex++;
    }

    // ---- Place repeater ----
    function addPlaceRow() {
        const wrapper = document.getElementById('place-wrapper');
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.style.gridTemplateColumns = '1fr 1fr 1fr auto auto';
        row.innerHTML = `
        <div class="form-field" style="margin:0">
            <label>Image</label>
            <input type="file" name="place[${placeIndex}][image]" class="form-control-styled" accept="image/*">
        </div>
        <div class="form-field" style="margin:0">
            <label>Name</label>
            <input type="text" name="place[${placeIndex}][name]" class="form-control-styled" placeholder="e.g. Gulmarg">
        </div>
        <div class="form-field" style="margin:0">
            <label>Description</label>
            <input type="text" name="place[${placeIndex}][description]" class="form-control-styled" placeholder="e.g. Gondola, meadows, mountains and snow.">
        </div>
        <div class="form-field" style="margin:0">
            <label>Featured</label>
            <label class="switch">
                <input type="checkbox" name="place[${placeIndex}][is_featured]" value="1">
                <span class="switch-slider"></span>
            </label>
        </div>
        <button type="button" class="gallery-remove" onclick="this.closest('.gallery-row').remove()">
            <i class="fa fa-times"></i>
        </button>
    `;
        wrapper.appendChild(row);
        placeIndex++;
    }

    function addActivityRow() {
        const wrapper = document.getElementById('activity-wrapper');
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.style.gridTemplateColumns = '1fr 1fr 1fr 1fr auto auto';
        row.innerHTML = `
        <div class="form-field" style="margin:0">
            <label>Image</label>
            <input type="file" name="activity[${activityIndex}][image]" class="form-control-styled" accept="image/*">
        </div>
        <div class="form-field" style="margin:0">
            <label>Tag</label>
            <input type="text" name="activity[${activityIndex}][tag]" class="form-control-styled" placeholder="e.g. Most Loved">
        </div>
        <div class="form-field" style="margin:0">
            <label>Title</label>
            <input type="text" name="activity[${activityIndex}][title]" class="form-control-styled" placeholder="e.g. Gondola Ride">
        </div>
        <div class="form-field" style="margin:0">
            <label>Description</label>
            <input type="text" name="activity[${activityIndex}][description]" class="form-control-styled" placeholder="e.g. Spectacular mountain views from Gulmarg.">
        </div>
        <div class="form-field" style="margin:0">
            <label>Featured</label>
            <label class="switch">
                <input type="checkbox" name="activity[${activityIndex}][is_featured]" value="1">
                <span class="switch-slider"></span>
            </label>
        </div>
        <button type="button" class="gallery-remove" onclick="this.closest('.gallery-row').remove()">
            <i class="fa fa-times"></i>
        </button>
    `;
        wrapper.appendChild(row);
        activityIndex++;
    }

    function addRouteRow() {
        const wrapper = document.getElementById('route-wrapper');
        const row = document.createElement('div');
        row.innerHTML = `
        <div class="gallery-row" style="grid-template-columns: 80px 1fr 1fr 1fr auto;">
            <div class="form-field" style="margin:0">
                <label>Days</label>
                <input type="number" name="route[${routeIndex}][days]" class="form-control-styled" min="1">
            </div>
            <div class="form-field" style="margin:0">
                <label>Label</label>
                <input type="text" name="route[${routeIndex}][label]" class="form-control-styled" placeholder="e.g. Classic Kashmir">
            </div>
            <div class="form-field" style="margin:0">
                <label>Subtitle</label>
                <input type="text" name="route[${routeIndex}][subtitle]" class="form-control-styled" placeholder="e.g. Most picked">
            </div>
            <div class="form-field" style="margin:0">
                <label>Path (comma-separated)</label>
                <input type="text" name="route[${routeIndex}][path]" class="form-control-styled" placeholder="Srinagar, Gulmarg, Pahalgam, Srinagar">
            </div>
            <button type="button" class="gallery-remove" onclick="this.closest('div').parentElement.remove()">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="form-field">
            <label>Note (used instead of Path)</label>
            <textarea name="route[${routeIndex}][note]" rows="2" class="form-control-styled"></textarea>
        </div>
    `;
        wrapper.appendChild(row);
        routeIndex++;
    }

    function addJourneyRow() {
        const wrapper = document.getElementById('journey-wrapper');
        const row = document.createElement('div');
        row.innerHTML = `
        <div class="gallery-row" style="grid-template-columns: 90px 1fr 1fr auto;">
            <div class="form-field" style="margin:0">
                <label>Day #</label>
                <input type="number" name="journey[${journeyIndex}][day_number]" class="form-control-styled" min="1">
            </div>
            <div class="form-field" style="margin:0">
                <label>Title</label>
                <input type="text" name="journey[${journeyIndex}][title]" class="form-control-styled" placeholder="e.g. Gulmarg">
            </div>
            <div class="form-field" style="margin:0">
                <label>Image</label>
                <input type="file" name="journey[${journeyIndex}][image]" class="form-control-styled" accept="image/*">
            </div>
            <button type="button" class="gallery-remove" onclick="this.closest('div').parentElement.remove()">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="form-field">
            <label>Flow</label>
            <input type="text" name="journey[${journeyIndex}][flow_text]" class="form-control-styled">
        </div>
        <div class="form-row">
            <div class="form-field">
                <label>Stay</label>
                <input type="text" name="journey[${journeyIndex}][stay_text]" class="form-control-styled">
            </div>
            <div class="form-field">
                <label>Taste</label>
                <input type="text" name="journey[${journeyIndex}][food_text]" class="form-control-styled">
            </div>
            <div class="form-field toggle-row" style="align-self:end; margin-bottom:18px;">
                <label class="switch">
                    <input type="checkbox" name="journey[${journeyIndex}][is_departure]" value="1">
                    <span class="switch-slider"></span>
                </label>
                <label style="margin:0">Departure day</label>
            </div>
        </div>
    `;
        wrapper.appendChild(row);
        journeyIndex++;
    }

    function addSeasonRow() {
        const wrapper = document.getElementById('season-wrapper');
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.style.gridTemplateColumns = '1fr 1fr 2fr auto';
        row.innerHTML = `
        <div class="form-field" style="margin:0">
            <label>Range</label>
            <input type="text" name="season[${seasonIndex}][range_text]" class="form-control-styled" placeholder="e.g. May – June">
        </div>
        <div class="form-field" style="margin:0">
            <label>Name</label>
            <input type="text" name="season[${seasonIndex}][name]" class="form-control-styled" placeholder="e.g. Summer">
        </div>
        <div class="form-field" style="margin:0">
            <label>Description</label>
            <input type="text" name="season[${seasonIndex}][description]" class="form-control-styled">
        </div>
        <button type="button" class="gallery-remove" onclick="this.closest('.gallery-row').remove()">
            <i class="fa fa-times"></i>
        </button>
    `;
        wrapper.appendChild(row);
        seasonIndex++;
    }

    function addSeasonHighlightRow() {
        const wrapper = document.getElementById('season-highlight-wrapper');
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.style.gridTemplateColumns = '1fr 1fr auto';
        row.innerHTML = `
        <div class="form-field" style="margin:0">
            <label>Label</label>
            <input type="text" name="season_highlight[${seasonHighlightIndex}][label]" class="form-control-styled" placeholder="e.g. Best for snow">
        </div>
        <div class="form-field" style="margin:0">
            <label>Value</label>
            <input type="text" name="season_highlight[${seasonHighlightIndex}][value]" class="form-control-styled" placeholder="e.g. December – February">
        </div>
        <button type="button" class="gallery-remove" onclick="this.closest('.gallery-row').remove()">
            <i class="fa fa-times"></i>
        </button>
    `;
        wrapper.appendChild(row);
        seasonHighlightIndex++;
    }

    function addBudgetTierRow() {
        const wrapper = document.getElementById('budget-tier-wrapper');
        const row = document.createElement('div');
        row.innerHTML = `
        <div class="gallery-row" style="grid-template-columns: 1fr 1fr 1fr 1fr auto;">
            <div class="form-field" style="margin:0">
                <label>Name</label>
                <input type="text" name="budget_tier[${budgetTierIndex}][name]" class="form-control-styled" placeholder="e.g. Premium">
            </div>
            <div class="form-field" style="margin:0">
                <label>Price From</label>
                <input type="text" name="budget_tier[${budgetTierIndex}][price_from]" class="form-control-styled">
            </div>
            <div class="form-field" style="margin:0">
                <label>Price To</label>
                <input type="text" name="budget_tier[${budgetTierIndex}][price_to]" class="form-control-styled">
            </div>
            <div class="form-field" style="margin:0">
                <label>Suffix</label>
                <input type="text" name="budget_tier[${budgetTierIndex}][price_suffix]" class="form-control-styled" placeholder="e.g. +">
            </div>
            <button type="button" class="gallery-remove" onclick="this.closest('div').parentElement.remove()">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="form-row">
            <div class="form-field">
                <label>Description</label>
                <input type="text" name="budget_tier[${budgetTierIndex}][description]" class="form-control-styled">
            </div>
            <div class="form-field">
                <label>Badge Text</label>
                <input type="text" name="budget_tier[${budgetTierIndex}][badge_text]" class="form-control-styled">
            </div>
            <div class="form-field toggle-row" style="align-self:end; margin-bottom:18px;">
                <label class="switch">
                    <input type="checkbox" name="budget_tier[${budgetTierIndex}][is_featured]" value="1">
                    <span class="switch-slider"></span>
                </label>
                <label style="margin:0">Featured</label>
            </div>
        </div>
    `;
        wrapper.appendChild(row);
        budgetTierIndex++;
    }

    function addBudgetBreakdownRow() {
        const wrapper = document.getElementById('budget-breakdown-wrapper');
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.style.gridTemplateColumns = '1fr 1fr auto';
        row.innerHTML = `
        <div class="form-field" style="margin:0">
            <label>Label</label>
            <input type="text" name="budget_breakdown[${budgetBreakdownIndex}][label]" class="form-control-styled" placeholder="e.g. Activities">
        </div>
        <div class="form-field" style="margin:0">
            <label>Percent</label>
            <input type="number" name="budget_breakdown[${budgetBreakdownIndex}][percent]" class="form-control-styled" min="0" max="100">
        </div>
        <button type="button" class="gallery-remove" onclick="this.closest('.gallery-row').remove()">
            <i class="fa fa-times"></i>
        </button>
    `;
        wrapper.appendChild(row);
        budgetBreakdownIndex++;
    }

    function addFaqRow() {
    const wrapper = document.getElementById('faq-wrapper');
    const row = document.createElement('div');
    row.className = 'gallery-row';
    row.style.gridTemplateColumns = '1fr 1fr auto';
    row.innerHTML = `
        <div class="form-field" style="margin:0">
            <label>Question</label>
            <input type="text" name="faq[${faqIndex}][question]" class="form-control-styled" placeholder="e.g. Where should I stay?">
        </div>
        <div class="form-field" style="margin:0">
            <label>Answer</label>
            <textarea name="faq[${faqIndex}][answer]" rows="2" class="form-control-styled"></textarea>
        </div>
        <button type="button" class="gallery-remove" onclick="this.closest('.gallery-row').remove()">
            <i class="fa fa-times"></i>
        </button>
    `;
    wrapper.appendChild(row);
    faqIndex++;
}

</script>

@include('admin.footer')