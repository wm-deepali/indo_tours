{{-- resources/views/admin/attraction/create.blade.php --}}
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

        .gallery-row .form-row {
            grid-template-columns: 1fr 1fr;
            margin-top: 12px;
        }

        .gallery-row .remove-gallery-row,
        .gallery-row .remove-new-row {
            margin-top: 10px;
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

        .tag-chip-input-row {
            display: flex;
            gap: 8px;
            margin-bottom: 8px;
        }

        .tag-chip-input-row .form-control-styled {
            flex: 1;
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Add Attraction</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.attractions.index') }}">Attractions</a>
                        <span>›</span>
                        Add
                    </div>
                </div>
                <a href="{{ route('admin.attractions.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.attractions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="cat-tabs" id="attraction-tabs">
                        <button type="button" class="cat-tab active" data-tab="general">General</button>
                        <button type="button" class="cat-tab" data-tab="location">Location</button>
                        <button type="button" class="cat-tab" data-tab="gallery">Gallery</button>
                        <button type="button" class="cat-tab" data-tab="highlights">Why Visit</button>
                        <button type="button" class="cat-tab" data-tab="experiences">Experiences</button>
                        <button type="button" class="cat-tab" data-tab="places">Places</button>
                        <button type="button" class="cat-tab" data-tab="itineraries">How Many Days</button>
                        <button type="button" class="cat-tab" data-tab="travelinfo">Travel Info</button>
                        <button type="button" class="cat-tab" data-tab="offer">Offer Banner</button>
                        <button type="button" class="cat-tab" data-tab="moreabout">More About</button>
                        <button type="button" class="cat-tab" data-tab="faqs">FAQs</button>
                        <button type="button" class="cat-tab" data-tab="promo">App Promo</button>
                        <button type="button" class="cat-tab" data-tab="seo">SEO / Open Graph</button>
                    </div>

                    {{-- ============ GENERAL ============ --}}
                    <div class="cat-tab-panel active" data-panel="general">

                        <div class="form-field">
                            <label for="name">Attraction Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control-styled @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Enter attraction name" required>
                            @error('name')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" name="slug_preview" class="form-control-styled" readonly
                                placeholder="Auto-generated from attraction name">
                            <div class="hint">Generated automatically on save — used for the URL and canonical tag</div>
                        </div>

                        <div class="form-field">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image"
                                class="form-control-styled @error('image') is-invalid @enderror" accept="image/*">
                            <div class="hint">Used on the listing card and as banner fallback — max 2MB</div>
                            @error('image')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="short_description">Short Description</label>
                            <textarea id="short_description" name="short_description" rows="2"
                                class="form-control-styled @error('short_description') is-invalid @enderror"
                                placeholder="Shown on the attractions listing card">{{ old('short_description') }}</textarea>
                            @error('short_description')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="description">Long Description</label>
                            <textarea id="description" name="description" rows="5"
                                class="form-control-styled @error('description') is-invalid @enderror"
                                placeholder="Shown as the intro paragraph under the page title">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="about_image">About Section Image</label>
                            <input type="file" id="about_image" name="about_image"
                                class="form-control-styled @error('about_image') is-invalid @enderror" accept="image/*">
                            <div class="hint">Shown in the "About [Attraction]" section — falls back to the Image above
                                if left blank</div>
                            @error('about_image')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="about_content">About Content</label>
                            <textarea id="about_content" name="about_content" rows="8"
                                class="ckeditor form-control-styled @error('about_content') is-invalid @enderror"
                                placeholder="Detailed content shown in the About section">{{ old('about_content') }}</textarea>
                            <div class="hint">Rich text — supports multiple paragraphs</div>
                            @error('about_content')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="duration_text">Recommended Duration</label>
                                <input type="text" id="duration_text" name="duration_text" class="form-control-styled"
                                    value="{{ old('duration_text') }}" placeholder="e.g. 4-7 Days">
                            </div>
                            <div class="form-field">
                                <label for="best_time_text">Best Time</label>
                                <input type="text" id="best_time_text" name="best_time_text" class="form-control-styled"
                                    value="{{ old('best_time_text') }}" placeholder="e.g. March - October">
                            </div>
                            <div class="form-field">
                                <label for="best_for_tags">Best For (tags)</label>
                                <input type="text" id="best_for_tags" name="best_for_tags" class="form-control-styled"
                                    value="{{ old('best_for_tags') }}" placeholder="Families, Couples, Adventure">
                            </div>
                        </div>
                        <div class="hint" style="margin-top:-10px; margin-bottom:18px;">"Best For" is comma-separated —
                            shown as the "Ideal For" tags on the detail page</div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="rating">Rating</label>
                                <input type="number" id="rating" name="rating" step="0.1" min="0" max="5"
                                    class="form-control-styled @error('rating') is-invalid @enderror"
                                    value="{{ old('rating') }}" placeholder="e.g. 4.8">
                                @error('rating')
                                <div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-field">
                                <label for="review_count">Review Count</label>
                                <input type="number" id="review_count" name="review_count" min="0"
                                    class="form-control-styled @error('review_count') is-invalid @enderror"
                                    value="{{ old('review_count', 0) }}" placeholder="e.g. 124">
                                @error('review_count')
                                <div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-field toggle-row">
                            <label class="switch">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <span class="switch-slider"></span>
                            </label>
                            <label style="margin:0">Featured Attraction</label>
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
                                <div class="form-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-field">
                                <label for="state_id">State</label>
                                <select id="state_id" name="state_id" class="form-control-styled" disabled>
                                    <option value="">Select Country First</option>
                                </select>
                                <div class="hint">Optional — leave blank for a country-level attraction</div>
                            </div>

                            <div class="form-field">
                                <label for="city_id">City</label>
                                <select id="city_id" name="city_id" class="form-control-styled" disabled>
                                    <option value="">Select State First</option>
                                </select>
                                <div class="hint">Optional — leave blank for a state-level attraction</div>
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="map_location">Map Location</label>
                            <input type="text" id="map_location" name="map_location"
                                class="form-control-styled @error('map_location') is-invalid @enderror"
                                value="{{ old('map_location') }}" placeholder="e.g. Kashmir, Jammu and Kashmir, India">
                            <div class="hint">Used to build the "Where is..." Google Maps embed, directions link, and
                                the label shown under the map</div>
                            @error('map_location')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                    </div>

                    {{-- ============ GALLERY ============ --}}
                    <div class="cat-tab-panel" data-panel="gallery">

                        <div id="new-gallery-rows"></div>

                        <input type="hidden" name="deleted_galleries" id="deleted_galleries" value="">

                        <button type="button" class="btn-secondary-dash" id="add-gallery-row">
                            <i class="fa fa-plus"></i> Add Gallery Image
                        </button>
                        <div class="hint" style="margin-top:10px;">First 4 images show as individual banner tiles on the
                            detail page; anything past 4 groups into a "+N More" lightbox</div>

                    </div>

                    {{-- ============ HIGHLIGHTS / WHY VISIT ============ --}}
                    <div class="cat-tab-panel" data-panel="highlights">
                        <div id="new-highlight-rows"></div>
                        <input type="hidden" name="deleted_highlights" id="deleted_highlights" value="">
                        <button type="button" class="btn-secondary-dash" id="add-highlight-row">
                            <i class="fa fa-plus"></i> Add Highlight
                        </button>
                        <div class="hint" style="margin-top:10px;">Shown as icon cards in the "Why Visit" section</div>
                    </div>

                    {{-- ============ EXPERIENCES ============ --}}
                    <div class="cat-tab-panel" data-panel="experiences">
                        <div id="new-experience-rows"></div>
                        <input type="hidden" name="deleted_experiences" id="deleted_experiences" value="">
                        <button type="button" class="btn-secondary-dash" id="add-experience-row">
                            <i class="fa fa-plus"></i> Add Experience
                        </button>
                        <div class="hint" style="margin-top:10px;">Shown as numbered cards in "Experiences to Explore" —
                            order here sets display order</div>
                    </div>

                    {{-- ============ PLACES ============ --}}
                    <div class="cat-tab-panel" data-panel="places">
                        <div id="new-place-rows"></div>
                        <input type="hidden" name="deleted_places" id="deleted_places" value="">
                        <button type="button" class="btn-secondary-dash" id="add-place-row">
                            <i class="fa fa-plus"></i> Add Place
                        </button>
                        <div class="hint" style="margin-top:10px;">Shown in the "Places to Visit" slider</div>
                    </div>

                    {{-- ============ ITINERARIES / HOW MANY DAYS ============ --}}
                    <div class="cat-tab-panel" data-panel="itineraries">
                        <div id="itinerary-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-itinerary-row">
                            <i class="fa fa-plus"></i> Add Plan
                        </button>
                        <div class="hint" style="margin-top:10px;">Shown as day-count cards in "How Many Days Do You
                            Need?" — mark one as Popular to highlight it</div>
                    </div>

                    {{-- ============ TRAVEL INFO ============ --}}
                    <div class="cat-tab-panel" data-panel="travelinfo">

                        {{-- ---- Seasons (Best Time to Visit) ---- --}}
                        <h4 class="sub-block-title">Best Time to Visit — Seasons</h4>
                        <div id="season-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-season-row">
                            <i class="fa fa-plus"></i> Add Season
                        </button>
                        <div class="hint" style="margin-top:10px;">Shown as season cards (Spring/Summer/etc.) — mark one
                            Active to highlight it as the current season</div>

                        {{-- ---- Transports (How to Reach) ---- --}}
                        <h4 class="sub-block-title">How to Reach — Transport Options</h4>
                        <div id="transport-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-transport-row">
                            <i class="fa fa-plus"></i> Add Transport Option
                        </button>
                        <div class="hint" style="margin-top:10px;">Shown as ticket-style cards (By Air / By Road / By
                            Train)</div>

                        {{-- ---- Budget Tiers ---- --}}
                        <h4 class="sub-block-title">Estimated Budget — Tiers</h4>
                        <div id="budget-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-budget-row">
                            <i class="fa fa-plus"></i> Add Budget Tier
                        </button>
                        <div class="hint" style="margin-top:10px;">Shown as pricing cards (Budget / Mid-range /
                            Premium) — mark one Recommended to highlight it</div>

                        {{-- ---- Carry Groups (What to Carry) ---- --}}
                        <h4 class="sub-block-title">What to Carry — Groups</h4>
                        <div id="carry-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-carry-row">
                            <i class="fa fa-plus"></i> Add Carry Group
                        </button>
                        <div class="hint" style="margin-top:10px;">Shown as columns (e.g. "Clothing & Footwear",
                            "Essentials") with a bullet list of items</div>

                    </div>

                    {{-- ============ OFFER BANNER ============ --}}
                    <div class="cat-tab-panel" data-panel="offer">

                        <div class="form-field">
                            <label for="offer_badge_text">Badge Text</label>
                            <input type="text" id="offer_badge_text" name="offer_badge_text" class="form-control-styled"
                                value="{{ old('offer_badge_text', '') }}" placeholder="Limited-Time Offer">
                        </div>

                        <div class="form-field">
                            <label for="offer_title">Title</label>
                            <input type="text" id="offer_title" name="offer_title" class="form-control-styled"
                                value="{{ old('offer_title', '') }}"
                                placeholder="e.g. Book Your Kashmir & Ladakh Trip Early — Save Up to 40%">
                        </div>

                        <div class="form-field">
                            <label for="offer_description">Description</label>
                            <textarea id="offer_description" name="offer_description" rows="3"
                                class="form-control-styled">{{ old('offer_description', '') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Perks</label>
                            <div id="offer-perks-list">
                            </div>
                            <button type="button" class="btn-secondary-dash" id="add-offer-perk">
                                <i class="fa fa-plus"></i> Add Perk
                            </button>
                        </div>

                        <div class="form-field">
                            <label for="offer_image">Banner Image</label>
                            <input type="file" id="offer_image" name="offer_image" class="form-control-styled"
                                accept="image/*">
                            <div class="hint">Falls back to the main Image if left blank</div>
                        </div>

                        <div class="form-row" style="grid-template-columns: 1fr 1fr;">
                            <div class="form-field">
                                <label for="offer_button_text">Button Text</label>
                                <input type="text" id="offer_button_text" name="offer_button_text"
                                    class="form-control-styled" value="{{ old('offer_button_text', '') }}"
                                    placeholder="Explore Packages">
                            </div>
                            <div class="form-field">
                                <label for="offer_button_url">Button URL</label>
                                <input type="text" id="offer_button_url" name="offer_button_url"
                                    class="form-control-styled" value="{{ old('offer_button_url', '') }}"
                                    placeholder="/listing">
                            </div>
                        </div>

                    </div>

                    {{-- ============ MORE ABOUT ============ --}}
                    <div class="cat-tab-panel" data-panel="moreabout">

                        <div class="form-field">
                            <label for="about_more_title">Section Title</label>
                            <input type="text" id="about_more_title" name="about_more_title" class="form-control-styled"
                                value="{{ old('about_more_title') }}" placeholder="Defaults to the Attraction Name">
                            <div class="hint">Shown as "More About [Title]" — leave blank to use the Attraction Name
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="about_more_content">Content</label>
                            <textarea id="about_more_content" name="about_more_content" rows="10"
                                class="ckeditor form-control-styled">{{ old('about_more_content') }}</textarea>
                            <div class="hint">Rich text — supports headings, lists, links and quotes</div>
                        </div>

                    </div>

                    {{-- ============ FAQS ============ --}}
                    <div class="cat-tab-panel" data-panel="faqs">
                        <div id="faq-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-faq-row">
                            <i class="fa fa-plus"></i> Add FAQ
                        </button>
                        <div class="hint" style="margin-top:10px;">Shown in the Frequently Asked Questions accordion —
                            order here sets
                            display order, first FAQ opens expanded by default</div>
                    </div>

                    {{-- ============ APP PROMO ============ --}}
                    <div class="cat-tab-panel" data-panel="promo">

                        <div class="form-field">
                            <label for="promo_eyebrow">Eyebrow Text</label>
                            <input type="text" id="promo_eyebrow" name="promo_eyebrow" class="form-control-styled"
                                value="{{ old('promo_eyebrow', 'Plan Your Trip') }}">
                        </div>

                        <div class="form-field">
                            <label for="promo_title">Title</label>
                            <input type="text" id="promo_title" name="promo_title" class="form-control-styled"
                                value="{{ old('promo_title') }}" placeholder="Auto-filled: Ready to Explore [Name]?">
                        </div>

                        <div class="form-field">
                            <label for="promo_description">Description</label>
                            <textarea id="promo_description" name="promo_description" rows="3"
                                class="form-control-styled">{{ old('promo_description') }}</textarea>
                        </div>

                        <div class="form-row" style="grid-template-columns: 1fr 1fr;">
                            <div class="form-field">
                                <label for="promo_button_text">Button Text</label>
                                <input type="text" id="promo_button_text" name="promo_button_text"
                                    class="form-control-styled" value="{{ old('promo_button_text') }}"
                                    placeholder="Auto-filled: Plan My [Name] Trip">
                            </div>
                            <div class="form-field">
                                <label for="promo_button_url">Button URL</label>
                                <input type="text" id="promo_button_url" name="promo_button_url"
                                    class="form-control-styled" value="{{ old('promo_button_url') }}"
                                    placeholder="/listing">
                            </div>
                        </div>

                    </div>

                    {{-- ============ SEO ============ --}}
                    <div class="cat-tab-panel" data-panel="seo">

                        <div class="form-field">
                            <label for="h1">H1 Tag</label>
                            <input type="text" id="h1" name="h1"
                                class="form-control-styled @error('h1') is-invalid @enderror" value="{{ old('h1') }}"
                                placeholder="Auto-filled from Attraction Name">
                            <div class="hint">Auto-fills from Attraction Name — edit anytime to override</div>
                            @error('h1')
                            <div class="form-error">{{ $message }}</div>@enderror
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
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="og_description">OG Description</label>
                            <textarea id="og_description" name="og_description" rows="3"
                                class="form-control-styled @error('og_description') is-invalid @enderror"
                                placeholder="Auto-filled from Meta Description">{{ old('og_description') }}</textarea>
                            <div class="hint">Auto-fills from Meta Description — edit anytime to override</div>
                            @error('og_description')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="og_image">OG Image</label>
                            <input type="file" id="og_image" name="og_image"
                                class="form-control-styled @error('og_image') is-invalid @enderror" accept="image/*">
                            <div class="hint">Leave blank to automatically use the Attraction Image as OG Image</div>
                            @error('og_image')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="canonical_url">Canonical URL</label>
                            <input type="text" id="canonical_url" name="canonical_url"
                                class="form-control-styled @error('canonical_url') is-invalid @enderror"
                                value="{{ old('canonical_url') }}" placeholder="Auto-generated from slug">
                            <div class="hint">Auto-fills from the slug — edit anytime to override</div>
                            @error('canonical_url')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Save Attraction
                        </button>
                        <a href="{{ route('admin.attractions.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    if (window.CKEDITOR) {
        CKEDITOR.replace('about_content');
        CKEDITOR.replace('about_more_content');
    }

    document.querySelectorAll('#attraction-tabs .cat-tab').forEach(function (tabBtn) {
        tabBtn.addEventListener('click', function () {
            document.querySelectorAll('#attraction-tabs .cat-tab').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            document.querySelector('.cat-tab-panel[data-panel="' + this.dataset.tab + '"]').classList.add('active');

            // CKEditor doesn't render heights correctly inside a display:none panel until shown
            if (this.dataset.tab === 'general' && window.CKEDITOR && CKEDITOR.instances.about_content) {
                CKEDITOR.instances.about_content.resize('100%', 300);
            }
        });
    });

    (function focusFirstErrorTab() {
        const firstError = document.querySelector('.form-error');
        if (!firstError) return;
        const panel = firstError.closest('.cat-tab-panel');
        if (!panel || panel.classList.contains('active')) return;

        document.querySelectorAll('#attraction-tabs .cat-tab').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.remove('active'));
        panel.classList.add('active');
        document.querySelector('#attraction-tabs .cat-tab[data-tab="' + panel.dataset.panel + '"]').classList.add('active');
    })();

    let h1Edited = false, ogTitleEdited = false, ogDescEdited = false, canonicalEdited = false;

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
            document.getElementById('canonical_url').value = '{{ url('/attractions') }}/' + slug;
        }
        if (!h1Edited) {
            document.getElementById('h1').value = this.value;
        }
    });

    document.getElementById('meta_title').addEventListener('keyup', function () {
        if (!ogTitleEdited) document.getElementById('og_title').value = this.value;
    });

    document.getElementById('meta_description').addEventListener('keyup', function () {
        if (!ogDescEdited) document.getElementById('og_description').value = this.value;
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

        fetch(`{{ url('admin/attractions/states') }}/${this.value}`)
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

        fetch(`{{ url('admin/attractions/cities') }}/${this.value}`)
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
    let galleryIndex = 0;

    document.getElementById('add-gallery-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field">
                <label>Image</label>
                <input type="file" name="gallery_images[${galleryIndex}]" class="form-control-styled" accept="image/*">
            </div>
            <div class="form-row">
                <div class="form-field">
                    <label>Title</label>
                    <input type="text" name="gallery_titles[${galleryIndex}]" class="form-control-styled" placeholder="e.g. Dal Lake">
                </div>
                <div class="form-field">
                    <label>Subtitle</label>
                    <input type="text" name="gallery_subtitles[${galleryIndex}]" class="form-control-styled" placeholder="e.g. Srinagar, Kashmir">
                </div>
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-gallery-rows').appendChild(row);
        galleryIndex++;

        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Why Visit highlights repeater ----
    let highlightIndex = 0;
    const deletedHighlights = [];

    document.getElementById('add-highlight-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Icon</label>
            <input type="file" name="highlight_icons[${highlightIndex}]" class="form-control-styled" accept="image/*">
        </div>
        <div class="form-field">
            <label>Title</label>
            <input type="text" name="highlight_titles[${highlightIndex}]" class="form-control-styled" placeholder="e.g. Himalayan Landscapes">
        </div>
        <div class="form-field">
            <label>Description</label>
            <textarea name="highlight_descriptions[${highlightIndex}]" class="form-control-styled" rows="2" placeholder="Short description"></textarea>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('new-highlight-rows').appendChild(row);
        highlightIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    document.querySelectorAll('.remove-highlight-row').forEach(function (btn) {
        btn.addEventListener('click', function () {
            deletedHighlights.push(this.dataset.id);
            document.getElementById('deleted_highlights').value = deletedHighlights.join(',');
            this.closest('.existing-highlight-row').remove();
        });
    });

    // ---- Experiences repeater ----
    let experienceIndex = 0;
    const deletedExperiences = [];

    document.getElementById('add-experience-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Image</label>
            <input type="file" name="experience_images[${experienceIndex}]" class="form-control-styled" accept="image/*">
        </div>
        <div class="form-row" style="grid-template-columns: 1fr 1fr;">
            <div class="form-field">
                <label>Title</label>
                <input type="text" name="experience_titles[${experienceIndex}]" class="form-control-styled" placeholder="e.g. Shikara Ride on Dal Lake">
            </div>
            <div class="form-field">
                <label>Duration</label>
                <input type="text" name="experience_durations[${experienceIndex}]" class="form-control-styled" placeholder="e.g. 1-2 Hours">
            </div>
        </div>
        <div class="form-field">
            <label>Description</label>
            <textarea name="experience_descriptions[${experienceIndex}]" class="form-control-styled" rows="2" placeholder="Short description"></textarea>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('new-experience-rows').appendChild(row);
        experienceIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    document.querySelectorAll('.remove-experience-row').forEach(function (btn) {
        btn.addEventListener('click', function () {
            deletedExperiences.push(this.dataset.id);
            document.getElementById('deleted_experiences').value = deletedExperiences.join(',');
            this.closest('.existing-experience-row').remove();
        });
    });

    // ---- Places repeater ----
    let placeIndex = 0;
    const deletedPlaces = [];

    document.getElementById('add-place-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Image</label>
            <input type="file" name="place_images[${placeIndex}]" class="form-control-styled" accept="image/*">
        </div>
        <div class="form-row" style="grid-template-columns: 1fr 1fr;">
            <div class="form-field">
                <label>Title</label>
                <input type="text" name="place_titles[${placeIndex}]" class="form-control-styled" placeholder="e.g. Srinagar">
            </div>
            <div class="form-field">
                <label>Tag</label>
                <input type="text" name="place_tags[${placeIndex}]" class="form-control-styled" placeholder="e.g. Kashmir">
            </div>
        </div>
        <div class="form-field">
            <label>Description</label>
            <textarea name="place_descriptions[${placeIndex}]" class="form-control-styled" rows="2"></textarea>
        </div>
        <div class="form-field">
            <label>Button Text</label>
            <input type="text" name="place_button_texts[${placeIndex}]" class="form-control-styled" placeholder="e.g. Explore Srinagar">
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('new-place-rows').appendChild(row);
        placeIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    document.querySelectorAll('.remove-place-row').forEach(function (btn) {
        btn.addEventListener('click', function () {
            deletedPlaces.push(this.dataset.id);
            document.getElementById('deleted_places').value = deletedPlaces.join(',');
            this.closest('.existing-place-row').remove();
        });
    });

    // ---- Itinerary (How Many Days) repeater ----
    let itineraryIndex = 0;

    function addItineraryRow(data = null) {
        const idx = itineraryIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row itinerary-row';
        row.innerHTML = `
        <div class="form-row" style="grid-template-columns: 1fr 2fr 1fr;">
            <div class="form-field">
                <label>Days</label>
                <input type="number" name="itinerary_days[${idx}]" class="form-control-styled" min="1" value="${data ? data.days : ''}">
            </div>
            <div class="form-field">
                <label>Plan Title</label>
                <input type="text" name="itinerary_titles[${idx}]" class="form-control-styled" placeholder="e.g. Kashmir Essentials" value="${data ? data.title : ''}">
            </div>
            <div class="form-field toggle-row" style="margin-top: 22px;">
                <label class="switch">
                    <input type="checkbox" name="itinerary_popular[${idx}]" value="1" ${data && data.is_popular ? 'checked' : ''}>
                    <span class="switch-slider"></span>
                </label>
                <label style="margin:0">Popular</label>
            </div>
        </div>

        <div class="form-field">
            <label>Route (stops in order)</label>
            <div class="itinerary-stops" data-index="${idx}"></div>
            <button type="button" class="btn-secondary-dash add-stop-btn" data-index="${idx}" style="margin-top:8px;">
                <i class="fa fa-plus"></i> Add Stop
            </button>
        </div>

        <button type="button" class="btn-secondary-dash remove-itinerary-row" style="margin-top:10px;">
            <i class="fa fa-trash"></i> Remove Plan
        </button>
    `;
        document.getElementById('itinerary-rows').appendChild(row);

        const stops = (data && data.stops && data.stops.length) ? data.stops : [''];
        stops.forEach(stopName => addStopInput(idx, stopName));

        row.querySelector('.add-stop-btn').addEventListener('click', function () {
            addStopInput(idx, '');
        });

        row.querySelector('.remove-itinerary-row').addEventListener('click', () => row.remove());

        itineraryIndex++;
    }

    function addStopInput(itineraryIdx, value) {
        const container = document.querySelector(`.itinerary-stops[data-index="${itineraryIdx}"]`);
        const wrap = document.createElement('div');
        wrap.style.display = 'flex';
        wrap.style.gap = '8px';
        wrap.style.marginBottom = '8px';
        wrap.innerHTML = `
        <input type="text" name="itinerary_stops[${itineraryIdx}][]" class="form-control-styled" placeholder="e.g. Dal Lake" value="${value}">
        <button type="button" class="btn-secondary-dash remove-stop-btn"><i class="fa fa-times"></i></button>
    `;
        container.appendChild(wrap);
        wrap.querySelector('.remove-stop-btn').addEventListener('click', () => wrap.remove());
    }

    document.getElementById('add-itinerary-row').addEventListener('click', () => addItineraryRow());

    document.getElementById('add-offer-perk').addEventListener('click', function () {
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'offer_perks[]';
        input.className = 'form-control-styled';
        input.style.marginBottom = '8px';
        input.placeholder = 'e.g. Free Airport Transfers Included';
        document.getElementById('offer-perks-list').appendChild(input);
    });

    // ================= TRAVEL INFO REPEATERS =================

    // ---- Seasons ----
    let seasonIndex = 0;

    function addSeasonRow(data = null) {
        const idx = seasonIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr;">
            <div class="form-field">
                <label>Months</label>
                <input type="text" name="season_months[${idx}]" class="form-control-styled" placeholder="e.g. Mar – May" value="${data ? data.months : ''}">
            </div>
            <div class="form-field">
                <label>Season Title</label>
                <input type="text" name="season_titles[${idx}]" class="form-control-styled" placeholder="e.g. Spring" value="${data ? data.title : ''}">
            </div>
            <div class="form-field toggle-row" style="margin-top: 22px;">
                <label class="switch">
                    <input type="checkbox" name="season_active[${idx}]" value="1" ${data && data.is_active ? 'checked' : ''}>
                    <span class="switch-slider"></span>
                </label>
                <label style="margin:0">Active (current season)</label>
            </div>
        </div>
        <div class="form-field">
            <label>Description</label>
            <textarea name="season_descriptions[${idx}]" class="form-control-styled" rows="2">${data ? data.description : ''}</textarea>
        </div>
        <div class="form-field">
            <label>Tags (comma-separated)</label>
            <input type="text" name="season_tags[${idx}]" class="form-control-styled" placeholder="e.g. Gardens, Fewer crowds" value="${data ? data.tags : ''}">
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('season-rows').appendChild(row);
        seasonIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    }

    document.getElementById('add-season-row').addEventListener('click', () => addSeasonRow());

    // ---- Transports ----
    let transportIndex = 0;

    function addTransportRow(data = null) {
        const idx = transportIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr;">
            <div class="form-field">
                <label>Mode</label>
                <select name="transport_types[${idx}]" class="form-control-styled">
                    <option value="air" ${data && data.mode_type === 'air' ? 'selected' : ''}>Air</option>
                    <option value="road" ${data && data.mode_type === 'road' ? 'selected' : ''}>Road</option>
                    <option value="train" ${data && data.mode_type === 'train' ? 'selected' : ''}>Train</option>
                    <option value="other" ${data && data.mode_type === 'other' ? 'selected' : ''}>Other</option>
                </select>
            </div>
            <div class="form-field">
                <label>Label</label>
                <input type="text" name="transport_names[${idx}]" class="form-control-styled" placeholder="e.g. By Air" value="${data ? data.mode_name : ''}">
            </div>
            <div class="form-field">
                <label>Sub-label</label>
                <input type="text" name="transport_subs[${idx}]" class="form-control-styled" placeholder="e.g. Srinagar Airport (SXR)" value="${data ? data.mode_sub : ''}">
            </div>
        </div>
        <div class="form-field">
            <label>Description</label>
            <textarea name="transport_descriptions[${idx}]" class="form-control-styled" rows="2">${data ? data.description : ''}</textarea>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('transport-rows').appendChild(row);
        transportIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    }

    document.getElementById('add-transport-row').addEventListener('click', () => addTransportRow());

    // ---- Budget Tiers ----
    let budgetIndex = 0;

    function addBudgetRow(data = null) {
        const idx = budgetIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr;">
            <div class="form-field">
                <label>Tier Name</label>
                <input type="text" name="budget_tier_names[${idx}]" class="form-control-styled" placeholder="e.g. Budget" value="${data ? data.tier_name : ''}">
            </div>
            <div class="form-field">
                <label>Price Range</label>
                <input type="text" name="budget_price_ranges[${idx}]" class="form-control-styled" placeholder="e.g. ₹2,000 – ₹4,000" value="${data ? data.price_range : ''}">
            </div>
            <div class="form-field">
                <label>Price Unit</label>
                <input type="text" name="budget_price_units[${idx}]" class="form-control-styled" placeholder="/ day" value="${data ? data.price_unit : '/ day'}">
            </div>
        </div>
        <div class="form-field">
            <label>Note</label>
            <input type="text" name="budget_notes[${idx}]" class="form-control-styled" placeholder="e.g. Good for solo travellers and backpackers" value="${data ? data.note : ''}">
        </div>
        <div class="form-field toggle-row">
            <label class="switch">
                <input type="checkbox" name="budget_recommended[${idx}]" value="1" ${data && data.is_recommended ? 'checked' : ''}>
                <span class="switch-slider"></span>
            </label>
            <label style="margin:0">Recommended</label>
        </div>
        <div class="form-field">
            <label>Features</label>
            <div class="budget-features" data-index="${idx}"></div>
            <button type="button" class="btn-secondary-dash add-budget-feature-btn" data-index="${idx}" style="margin-top:8px;">
                <i class="fa fa-plus"></i> Add Feature
            </button>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove Tier</button>
    `;
        document.getElementById('budget-rows').appendChild(row);

        const features = (data && data.features && data.features.length) ? data.features : [''];
        features.forEach(f => addBudgetFeatureInput(idx, f));

        row.querySelector('.add-budget-feature-btn').addEventListener('click', function () {
            addBudgetFeatureInput(idx, '');
        });

        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        budgetIndex++;
    }

    function addBudgetFeatureInput(tierIdx, value) {
        const container = document.querySelector(`.budget-features[data-index="${tierIdx}"]`);
        const wrap = document.createElement('div');
        wrap.style.display = 'flex';
        wrap.style.gap = '8px';
        wrap.style.marginBottom = '8px';
        wrap.innerHTML = `
        <input type="text" name="budget_features[${tierIdx}][]" class="form-control-styled" placeholder="e.g. Guesthouses and homestays" value="${value}">
        <button type="button" class="btn-secondary-dash remove-stop-btn"><i class="fa fa-times"></i></button>
    `;
        container.appendChild(wrap);
        wrap.querySelector('.remove-stop-btn').addEventListener('click', () => wrap.remove());
    }

    document.getElementById('add-budget-row').addEventListener('click', () => addBudgetRow());

    // ---- Carry Groups ----
    let carryIndex = 0;

    function addCarryRow(data = null) {
        const idx = carryIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Group Title</label>
            <input type="text" name="carry_titles[${idx}]" class="form-control-styled" placeholder="e.g. Clothing & Footwear" value="${data ? data.title : ''}">
        </div>
        <div class="form-field">
            <label>Items</label>
            <div class="carry-items" data-index="${idx}"></div>
            <button type="button" class="btn-secondary-dash add-carry-item-btn" data-index="${idx}" style="margin-top:8px;">
                <i class="fa fa-plus"></i> Add Item
            </button>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove Group</button>
    `;
        document.getElementById('carry-rows').appendChild(row);

        const items = (data && data.items && data.items.length) ? data.items : [''];
        items.forEach(i => addCarryItemInput(idx, i));

        row.querySelector('.add-carry-item-btn').addEventListener('click', function () {
            addCarryItemInput(idx, '');
        });

        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        carryIndex++;
    }

    function addCarryItemInput(groupIdx, value) {
        const container = document.querySelector(`.carry-items[data-index="${groupIdx}"]`);
        const wrap = document.createElement('div');
        wrap.style.display = 'flex';
        wrap.style.gap = '8px';
        wrap.style.marginBottom = '8px';
        wrap.innerHTML = `
        <input type="text" name="carry_items[${groupIdx}][]" class="form-control-styled" placeholder="e.g. Comfortable walking shoes" value="${value}">
        <button type="button" class="btn-secondary-dash remove-stop-btn"><i class="fa fa-times"></i></button>
    `;
        container.appendChild(wrap);
        wrap.querySelector('.remove-stop-btn').addEventListener('click', () => wrap.remove());
    }

    document.getElementById('add-carry-row').addEventListener('click', () => addCarryRow());

    // ---- FAQ repeater ----
    let faqIndex = 0;

    function addFaqRow(data = null) {
        const idx = faqIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Question</label>
            <input type="text" name="faq_questions[${idx}]" class="form-control-styled" placeholder="e.g. What is the best time to visit Kashmir?" value="${data ? data.question : ''}">
        </div>
        <div class="form-field">
            <label>Answer</label>
            <textarea name="faq_answers[${idx}]" class="form-control-styled" rows="3" placeholder="Answer shown in the accordion">${data ? data.answer : ''}</textarea>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('faq-rows').appendChild(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        faqIndex++;
    }

    document.getElementById('add-faq-row').addEventListener('click', () => addFaqRow());
</script>

@include('admin.footer')