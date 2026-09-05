{{-- resources/views/admin/destination/create.blade.php --}}
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
                    <h1>Add Destination</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.destinations.index') }}">Destinations</a>
                        <span>›</span>
                        Add
                    </div>
                </div>
                <a href="{{ route('admin.destinations.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                        <button type="button" class="cat-tab" data-tab="seo">SEO / Open Graph</button>
                    </div>

                    {{-- ============ GENERAL ============ --}}
                    <div class="cat-tab-panel active" data-panel="general">

                        <div class="form-field">
                            <label for="name">Destination Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control-styled @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Enter destination name" required>
                            @error('name')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" name="slug_preview" class="form-control-styled" readonly
                                placeholder="Auto-generated from destination name">
                            <div class="hint">Generated automatically on save — used for the URL and canonical tag</div>
                        </div>

                        <div class="form-field">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image"
                                class="form-control-styled @error('image') is-invalid @enderror" accept="image/*">
                            <div class="hint">Used on the listing card and as banner fallback — max 2MB</div>
                            @error('image')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="short_description">Short Description</label>
                            <textarea id="short_description" name="short_description" rows="2"
                                class="form-control-styled @error('short_description') is-invalid @enderror"
                                placeholder="Shown on the destinations listing card">{{ old('short_description') }}</textarea>
                            @error('short_description')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="description">Long Description</label>
                            <textarea id="description" name="description" rows="5"
                                class="form-control-styled @error('description') is-invalid @enderror"
                                placeholder="Shown on the destination detail page">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="duration_text">Duration</label>
                                <input type="text" id="duration_text" name="duration_text" class="form-control-styled"
                                    value="{{ old('duration_text') }}" placeholder="e.g. 5-7 Days">
                            </div>
                            <div class="form-field">
                                <label for="best_time_text">Best Time</label>
                                <input type="text" id="best_time_text" name="best_time_text" class="form-control-styled"
                                    value="{{ old('best_time_text') }}" placeholder="e.g. March - October">
                            </div>
                            <div class="form-field">
                                <label for="budget_text">Budget</label>
                                <input type="text" id="budget_text" name="budget_text" class="form-control-styled"
                                    value="{{ old('budget_text') }}" placeholder="e.g. ₹25K - ₹60K+">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="best_for_tags">Best For (tags)</label>
                            <input type="text" id="best_for_tags" name="best_for_tags" class="form-control-styled"
                                value="{{ old('best_for_tags') }}" placeholder="Couples, Families, Nature, Adventure">
                            <div class="hint">Comma-separated — shown as individual tags on the detail page</div>
                        </div>

                        <div class="form-field toggle-row">
                            <label class="switch">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <span class="switch-slider"></span>
                            </label>
                            <label style="margin:0">Featured Destination</label>
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
                                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                <div class="form-error">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-field">
                                <label for="state_id">State</label>
                                <select id="state_id" name="state_id" class="form-control-styled" disabled>
                                    <option value="">Select Country First</option>
                                </select>
                                <div class="hint">Optional — leave blank for a country-level destination</div>
                            </div>

                            <div class="form-field">
                                <label for="city_id">City</label>
                                <select id="city_id" name="city_id" class="form-control-styled" disabled>
                                    <option value="">Select State First</option>
                                </select>
                                <div class="hint">Optional — leave blank for a state-level destination</div>
                            </div>
                        </div>

                    </div>

                    {{-- ============ GALLERY ============ --}}
                    <div class="cat-tab-panel" data-panel="gallery">

                        <div class="seo-section-title">Gallery Images</div>

                        <div id="gallery-wrapper">
                            <div class="gallery-row">
                                <div class="form-field" style="margin:0">
                                    <label>Image</label>
                                    <input type="file" name="gallery[0][image]" class="form-control-styled"
                                        accept="image/*">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Title</label>
                                    <input type="text" name="gallery[0][title]" class="form-control-styled"
                                        placeholder="e.g. Dal Lake">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Subtitle</label>
                                    <input type="text" name="gallery[0][subtitle]" class="form-control-styled"
                                        placeholder="e.g. Srinagar, Kashmir">
                                </div>
                                <button type="button" class="gallery-remove"
                                    onclick="this.closest('.gallery-row').remove()">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <button type="button" class="add-gallery-btn" onclick="addGalleryRow()">
                            <i class="fa fa-plus"></i> Add Gallery Image
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
                                value="{{ old('verdict_title') }}" placeholder="e.g. Is Kashmir right for you?">
                        </div>

                        <div class="form-field">
                            <label for="recommended_for">Recommended For</label>
                            <input type="text" id="recommended_for" name="recommended_for" class="form-control-styled"
                                value="{{ old('recommended_for') }}"
                                placeholder="e.g. First-time visitors, couples, families and nature lovers.">
                        </div>

                        <div id="match-wrapper">
                            <div class="gallery-row">
                                <div class="form-field" style="margin:0">
                                    <label>Icon</label>
                                    <input type="file" name="match[0][icon]" class="form-control-styled"
                                        accept="image/*">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Want</label>
                                    <input type="text" name="match[0][want]" class="form-control-styled"
                                        placeholder="e.g. Mountains">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Offer Text</label>
                                    <input type="text" name="match[0][offer_text]" class="form-control-styled"
                                        placeholder="e.g. Himalayan valleys and panoramic viewpoints.">
                                </div>
                                <button type="button" class="gallery-remove"
                                    onclick="this.closest('.gallery-row').remove()">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <button type="button" class="add-gallery-btn" onclick="addMatchRow()">
                            <i class="fa fa-plus"></i> Add Match Row
                        </button>

                    </div>

                    {{-- ============ STAY AREAS ============ --}}
                    <div class="cat-tab-panel" data-panel="areas">

                        <div class="seo-section-title">Where to Stay</div>
                        <div class="hint" style="margin-bottom:14px;">Each row is one area card (e.g. Srinagar, Gulmarg)
                            in the "Where should you stay" section.</div>

                        <div id="area-wrapper">
                            <div class="gallery-row" style="grid-template-columns: 1fr 1fr 1fr 1fr 1fr auto;">
                                <div class="form-field" style="margin:0">
                                    <label>Image</label>
                                    <input type="file" name="area[0][image]" class="form-control-styled"
                                        accept="image/*">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Name</label>
                                    <input type="text" name="area[0][name]" class="form-control-styled"
                                        placeholder="e.g. Srinagar">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Tag</label>
                                    <input type="text" name="area[0][tag]" class="form-control-styled"
                                        placeholder="e.g. Best for first-time visitors">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Stay Duration</label>
                                    <input type="text" name="area[0][stay_duration]" class="form-control-styled"
                                        placeholder="e.g. 2–3 Nights">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Nearby</label>
                                    <input type="text" name="area[0][nearby_text]" class="form-control-styled"
                                        placeholder="e.g. Dal Lake · Nishat Bagh">
                                </div>
                                <button type="button" class="gallery-remove"
                                    onclick="this.closest('.gallery-row').remove()">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <div class="form-field">
                                <label>Why (description)</label>
                                <textarea name="area[0][why_text]" rows="2" class="form-control-styled"
                                    placeholder="Best base for Dal Lake, Mughal Gardens, markets..."></textarea>
                            </div>
                        </div>

                        <button type="button" class="add-gallery-btn" onclick="addAreaRow()">
                            <i class="fa fa-plus"></i> Add Stay Area
                        </button>

                    </div>

                    {{-- ============ HIGHLIGHTS ============ --}}
                    <div class="cat-tab-panel" data-panel="highlights">

                        <div class="seo-section-title">Why Visit — Media</div>

                        <div class="form-field">
                            <label for="why_visit_image">Section Image</label>
                            <input type="file" id="why_visit_image" name="why_visit_image"
                                class="form-control-styled @error('why_visit_image') is-invalid @enderror"
                                accept="image/*">
                            @error('why_visit_image')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="why_visit_media_tag">Media Tag</label>
                            <input type="text" id="why_visit_media_tag" name="why_visit_media_tag"
                                class="form-control-styled" value="{{ old('why_visit_media_tag') }}"
                                placeholder="e.g. Dal Lake, Srinagar">
                        </div>

                        <div class="seo-section-title" style="margin-top:24px;">Highlight List</div>
                        <div class="hint" style="margin-bottom:14px;">Each row is one "Why visit" reason with an icon.
                        </div>

                        <div id="highlight-wrapper">
                            <div class="gallery-row">
                                <div class="form-field" style="margin:0">
                                    <label>Icon</label>
                                    <input type="file" name="highlight[0][icon]" class="form-control-styled"
                                        accept="image/*">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Title</label>
                                    <input type="text" name="highlight[0][title]" class="form-control-styled"
                                        placeholder="e.g. Spectacular Himalayan Landscapes">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Description</label>
                                    <input type="text" name="highlight[0][description]" class="form-control-styled"
                                        placeholder="e.g. Towering peaks and open valleys at every turn.">
                                </div>
                                <button type="button" class="gallery-remove"
                                    onclick="this.closest('.gallery-row').remove()">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <button type="button" class="add-gallery-btn" onclick="addHighlightRow()">
                            <i class="fa fa-plus"></i> Add Highlight
                        </button>

                    </div>

                    {{-- ============ PLACES TO VISIT ============ --}}
                    <div class="cat-tab-panel" data-panel="places">

                        <div class="seo-section-title">Places to Visit</div>
                        <div class="hint" style="margin-bottom:14px;">Mark one place "Featured" to show it as the large
                            card in the grid.</div>

                        <div id="place-wrapper">
                            <div class="gallery-row" style="grid-template-columns: 1fr 1fr 1fr auto auto;">
                                <div class="form-field" style="margin:0">
                                    <label>Image</label>
                                    <input type="file" name="place[0][image]" class="form-control-styled"
                                        accept="image/*">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Name</label>
                                    <input type="text" name="place[0][name]" class="form-control-styled"
                                        placeholder="e.g. Srinagar">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Description</label>
                                    <input type="text" name="place[0][description]" class="form-control-styled"
                                        placeholder="e.g. Dal Lake, Mughal Gardens and local markets.">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Featured</label>
                                    <label class="switch">
                                        <input type="checkbox" name="place[0][is_featured]" value="1">
                                        <span class="switch-slider"></span>
                                    </label>
                                </div>
                                <button type="button" class="gallery-remove"
                                    onclick="this.closest('.gallery-row').remove()">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <button type="button" class="add-gallery-btn" onclick="addPlaceRow()">
                            <i class="fa fa-plus"></i> Add Place
                        </button>

                    </div>

                    {{-- ============ OFFER BANNER ============ --}}
                    <div class="cat-tab-panel" data-panel="banner">
                        <div class="seo-section-title">Group Offer Banner</div>
                        <div class="hint" style="margin-bottom:14px;">Always shows on the page — leave fields blank to
                            use the default copy.</div>

                        <div class="form-field">
                            <label for="banner_badge_text">Badge Text</label>
                            <input type="text" id="banner_badge_text" name="banner[badge_text]"
                                class="form-control-styled" value="{{ old('banner.badge_text') }}"
                                placeholder="e.g. Limited-Time Offer">
                        </div>

                        <div class="form-field">
                            <label for="banner_heading">Heading</label>
                            <input type="text" id="banner_heading" name="banner[heading]" class="form-control-styled"
                                value="{{ old('banner.heading') }}"
                                placeholder="e.g. Book Your Kashmir Trip Early — Save Up to 40%">
                        </div>

                        <div class="form-field">
                            <label for="banner_description">Description</label>
                            <textarea id="banner_description" name="banner[description]" rows="2"
                                class="form-control-styled">{{ old('banner.description') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="banner_perks">Perks</label>
                            <input type="text" id="banner_perks" name="banner[perks]" class="form-control-styled"
                                value="{{ old('banner.perks') }}"
                                placeholder="Early Bird Discount up to 40% Off, Free Airport Transfers, Flexible Rescheduling">
                            <div class="hint">Comma-separated — each becomes a perk line</div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="banner_cta_primary_text">Primary Button Text</label>
                                <input type="text" id="banner_cta_primary_text" name="banner[cta_primary_text]"
                                    class="form-control-styled" value="{{ old('banner.cta_primary_text') }}"
                                    placeholder="Explore Packages">
                            </div>
                            <div class="form-field">
                                <label for="banner_cta_primary_link">Primary Button Link</label>
                                <input type="text" id="banner_cta_primary_link" name="banner[cta_primary_link]"
                                    class="form-control-styled" value="{{ old('banner.cta_primary_link') }}"
                                    placeholder="/packages">
                            </div>
                            <div class="form-field">
                                <label for="banner_cta_secondary_text">Secondary Button Text</label>
                                <input type="text" id="banner_cta_secondary_text" name="banner[cta_secondary_text]"
                                    class="form-control-styled" value="{{ old('banner.cta_secondary_text') }}"
                                    placeholder="Get A Quote">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="banner_image">Banner Image</label>
                            <input type="file" id="banner_image" name="banner_image" class="form-control-styled"
                                accept="image/*">
                            <div class="hint">Falls back to the default travellers photo if left blank</div>
                        </div>
                    </div>

                    {{-- ============ ACTIVITIES ============ --}}
                    <div class="cat-tab-panel" data-panel="activities">
                        <div class="seo-section-title">Experiences You Shouldn't Miss</div>
                        <div class="hint" style="margin-bottom:14px;">Mark one activity "Featured" to show it as the
                            large card.</div>

                        <div id="activity-wrapper">
                            <div class="gallery-row" style="grid-template-columns: 1fr 1fr 1fr 1fr auto;">
                                <div class="form-field" style="margin:0">
                                    <label>Image</label>
                                    <input type="file" name="activity[0][image]" class="form-control-styled"
                                        accept="image/*">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Tag</label>
                                    <input type="text" name="activity[0][tag]" class="form-control-styled"
                                        placeholder="e.g. Most Loved">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Title</label>
                                    <input type="text" name="activity[0][title]" class="form-control-styled"
                                        placeholder="e.g. Shikara Ride">
                                </div>
                                <div class="form-field" style="margin:0">
                                    <label>Description</label>
                                    <input type="text" name="activity[0][description]" class="form-control-styled"
                                        placeholder="e.g. Experience Dal Lake from a traditional Shikara.">
                                </div>
                                <button type="button" class="gallery-remove"
                                    onclick="this.closest('.gallery-row').remove()">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <div class="form-field toggle-row">
                                <label class="switch">
                                    <input type="checkbox" name="activity[0][is_featured]" value="1">
                                    <span class="switch-slider"></span>
                                </label>
                                <label style="margin:0">Featured (large card)</label>
                            </div>
                        </div>

                        <button type="button" class="add-gallery-btn" onclick="addActivityRow()">
                            <i class="fa fa-plus"></i> Add Activity
                        </button>
                    </div>

                    {{-- ============ SEO ============ --}}
                    <div class="cat-tab-panel" data-panel="seo">

                        <div class="form-field">
                            <label for="h1">H1 Tag</label>
                            <input type="text" id="h1" name="h1"
                                class="form-control-styled @error('h1') is-invalid @enderror" value="{{ old('h1') }}"
                                placeholder="Auto-filled from Destination Name">
                            <div class="hint">Auto-fills from Destination Name — edit anytime to override</div>
                            @error('h1')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" class="form-control-styled"
                                value="{{ old('meta_title') }}" placeholder="Enter meta title">
                        </div>

                        <div class="form-field">
                            <label for="meta_description">Meta Description</label>
                            <textarea id="meta_description" name="meta_description" rows="4"
                                class="form-control-styled">{{ old('meta_description') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="og_title">OG Title</label>
                            <input type="text" id="og_title" name="og_title"
                                class="form-control-styled @error('og_title') is-invalid @enderror"
                                value="{{ old('og_title') }}" placeholder="Auto-filled from Meta Title">
                            <div class="hint">Auto-fills from Meta Title — edit anytime to override</div>
                            @error('og_title')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="og_description">OG Description</label>
                            <textarea id="og_description" name="og_description" rows="3"
                                class="form-control-styled @error('og_description') is-invalid @enderror"
                                placeholder="Auto-filled from Meta Description">{{ old('og_description') }}</textarea>
                            <div class="hint">Auto-fills from Meta Description — edit anytime to override</div>
                            @error('og_description')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="og_image">OG Image</label>
                            <input type="file" id="og_image" name="og_image"
                                class="form-control-styled @error('og_image') is-invalid @enderror" accept="image/*">
                            <div class="hint">Leave blank to automatically use the Destination Image as OG Image</div>
                            @error('og_image')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field">
                            <label for="canonical_url">Canonical URL</label>
                            <input type="text" id="canonical_url" name="canonical_url"
                                class="form-control-styled @error('canonical_url') is-invalid @enderror"
                                value="{{ old('canonical_url') }}" placeholder="Auto-generated from slug">
                            <div class="hint">Auto-fills from the slug — edit anytime to override</div>
                            @error('canonical_url')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Save Destination
                        </button>
                        <a href="{{ route('admin.destinations.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

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

    // If validation failed and errors exist outside the General tab, jump to the first tab with an error
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

    let h1Edited = false, ogTitleEdited = false, ogDescEdited = false, canonicalEdited = false;
    let galleryIndex = 1;
    let matchIndex = 1;
    let areaIndex = 1;
    let highlightIndex = 1;
    let placeIndex = 1;
    let activityIndex = 1;

    document.getElementById('h1').addEventListener('input', () => h1Edited = true);
    document.getElementById('og_title').addEventListener('input', () => ogTitleEdited = true);
    document.getElementById('og_description').addEventListener('input', () => ogDescEdited = true);
    document.getElementById('canonical_url').addEventListener('input', () => canonicalEdited = true);

    document.getElementById('name').addEventListener('keyup', function () {
        const slug = this.value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

        document.getElementById('slug').value = slug;

        if (!canonicalEdited) {
            document.getElementById('canonical_url').value = '{{ url('/destinations') }}/' + slug;
        }

        if (!h1Edited) {
            document.getElementById('h1').value = this.value;
        }
    });

    document.getElementById('meta_title').addEventListener('keyup', function () {
        if (!ogTitleEdited) {
            document.getElementById('og_title').value = this.value;
        }
    });

    document.getElementById('meta_description').addEventListener('keyup', function () {
        if (!ogDescEdited) {
            document.getElementById('og_description').value = this.value;
        }
    });

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

        fetch(`{{ url('admin/destinations/states') }}/${this.value}`)
            .then(res => res.json())
            .then(states => {
                stateSelect.innerHTML = '<option value="">Select State (optional)</option>';
                states.forEach(state => {
                    stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                });
                stateSelect.disabled = false;
            });
    });

    stateSelect.addEventListener('change', function () {
        if (!this.value) {
            citySelect.innerHTML = '<option value="">Select State First</option>';
            citySelect.disabled = true;
            return;
        }

        fetch(`{{ url('admin/destinations/cities') }}/${this.value}`)
            .then(res => res.json())
            .then(cities => {
                citySelect.innerHTML = '<option value="">Select City (optional)</option>';
                cities.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                });
                citySelect.disabled = false;
            });
    });

    // ---- Gallery repeater ----
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

    // ---- Trip match repeater ----
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
    row.innerHTML = `
        <div class="gallery-row" style="grid-template-columns: 1fr 1fr 1fr 1fr auto;">
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
            <button type="button" class="gallery-remove" onclick="this.closest('div').parentElement.remove()">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="form-field toggle-row">
            <label class="switch">
                <input type="checkbox" name="activity[${activityIndex}][is_featured]" value="1">
                <span class="switch-slider"></span>
            </label>
            <label style="margin:0">Featured (large card)</label>
        </div>
    `;
    wrapper.appendChild(row);
    activityIndex++;
}

</script>

@include('admin.footer')