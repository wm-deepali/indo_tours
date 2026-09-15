{{-- resources/views/admin/activity/create.blade.php --}}
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

        .simple-list-row {
            display: flex;
            gap: 8px;
            margin-bottom: 8px;
        }

        .simple-list-row .form-control-styled {
            flex: 1;
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Add Activity</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.activities.index') }}">Activities</a>
                        <span>›</span>
                        Add
                    </div>
                </div>
                <a href="{{ route('admin.activities.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="cat-tabs" id="activity-tabs">
                        <button type="button" class="cat-tab active" data-tab="general">General</button>
                        <button type="button" class="cat-tab" data-tab="about">About</button>
                        <button type="button" class="cat-tab" data-tab="packages">Packages</button>
                        <button type="button" class="cat-tab" data-tab="map">Map</button>
                        <button type="button" class="cat-tab" data-tab="policies">Policies</button>
                        <button type="button" class="cat-tab" data-tab="attractions">Attractions</button>
                        <button type="button" class="cat-tab" data-tab="faqs">FAQs</button>
                    </div>

                    {{-- ============ GENERAL ============ --}}
                    <div class="cat-tab-panel active" data-panel="general">

                        <div class="form-field">
                            <label for="activity_category_id">Category</label>
                            <select id="activity_category_id" name="activity_category_id" class="form-control-styled">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('activity_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-field">
                            <label for="name">Activity Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control-styled @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="e.g. Burj Khalifa Sky Views" required>
                            @error('name')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" class="form-control-styled" readonly
                                placeholder="Auto-generated from activity name">
                            <div class="hint">Generated automatically on save</div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="country_id">Country</label>
                                <select id="country_id" name="country_id" class="form-control-styled">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-field">
                                <label for="state_id">State</label>
                                <select id="state_id" name="state_id" class="form-control-styled" disabled>
                                    <option value="">Select Country First</option>
                                </select>
                            </div>
                            <div class="form-field">
                                <label for="city_id">City</label>
                                <select id="city_id" name="city_id" class="form-control-styled" disabled>
                                    <option value="">Select State First</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="location_label">Location Label</label>
                            <input type="text" id="location_label" name="location_label" class="form-control-styled"
                                value="{{ old('location_label') }}" placeholder="e.g. Downtown Dubai, UAE">
                            <div class="hint">Shown next to the map-pin icon under the banner</div>
                        </div>

                        <div class="form-row" style="grid-template-columns: 1fr 2fr;">
                            <div class="form-field">
                                <label for="banner_tag">Banner Tag</label>
                                <input type="text" id="banner_tag" name="banner_tag" class="form-control-styled"
                                    value="{{ old('banner_tag') }}" placeholder="e.g. Explore Dubai">
                            </div>
                            <div class="form-field">
                                <label for="banner_description">Banner Description</label>
                                <input type="text" id="banner_description" name="banner_description"
                                    class="form-control-styled" value="{{ old('banner_description') }}"
                                    placeholder="Short line shown under the H1 in the banner">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="main_image">Main Banner Image</label>
                            <input type="file" id="main_image" name="main_image" class="form-control-styled"
                                accept="image/*">
                            <div class="hint">Large hero image on the left of the banner grid</div>
                        </div>

                        <div class="form-field">
                            <label for="video_url">Video URL</label>
                            <input type="text" id="video_url" name="video_url" class="form-control-styled"
                                value="{{ old('video_url') }}" placeholder="e.g. assets/video/activity.mp4">
                            <div class="hint">Leave blank to hide the "Video" button in the banner actions</div>
                        </div>

                        <h4 class="sub-block-title">Banner Side Images</h4>

                        <div class="form-row">
                            <div class="form-field">
                                <label>Top Image</label>
                                <input type="file" name="banner_top_image" class="form-control-styled" accept="image/*">
                            </div>
                            <div class="form-field">
                                <label>Top Label</label>
                                <input type="text" name="banner_top_label" class="form-control-styled"
                                    value="{{ old('banner_top_label') }}" placeholder="e.g. Observation Deck">
                            </div>
                            <div class="form-field">
                                <label>Top Title</label>
                                <input type="text" name="banner_top_title" class="form-control-styled"
                                    value="{{ old('banner_top_title') }}" placeholder="e.g. At The Top, 124 & 125">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label>Left Image</label>
                                <input type="file" name="banner_left_image" class="form-control-styled"
                                    accept="image/*">
                            </div>
                            <div class="form-field">
                                <label>Left Label</label>
                                <input type="text" name="banner_left_label" class="form-control-styled"
                                    value="{{ old('banner_left_label') }}" placeholder="e.g. Sky Lounge">
                            </div>
                            <div class="form-field">
                                <label>Left Title</label>
                                <input type="text" name="banner_left_title" class="form-control-styled"
                                    value="{{ old('banner_left_title') }}" placeholder="e.g. 148th Floor Experience">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label>Right Image</label>
                                <input type="file" name="banner_right_image" class="form-control-styled"
                                    accept="image/*">
                            </div>
                            <div class="form-field">
                                <label>Right Label</label>
                                <input type="text" name="banner_right_label" class="form-control-styled"
                                    value="{{ old('banner_right_label') }}" placeholder="e.g. Skyline View">
                            </div>
                            <div class="form-field">
                                <label>Right Title</label>
                                <input type="text" name="banner_right_title" class="form-control-styled"
                                    value="{{ old('banner_right_title') }}" placeholder="e.g. 360° Dubai Views">
                            </div>
                        </div>

                        <h4 class="sub-block-title">Quick Info</h4>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="duration_text">Duration</label>
                                <input type="text" id="duration_text" name="duration_text" class="form-control-styled"
                                    value="{{ old('duration_text') }}" placeholder="e.g. 2-3 hrs">
                            </div>
                            <div class="form-field">
                                <label for="free_cancellation_text">Free Cancellation Text</label>
                                <input type="text" id="free_cancellation_text" name="free_cancellation_text"
                                    class="form-control-styled" value="{{ old('free_cancellation_text') }}"
                                    placeholder="e.g. Free Cancellation">
                                <div class="hint">Leave blank to hide this badge</div>
                            </div>
                            <div class="form-field">
                                <label for="rating">Rating</label>
                                <input type="number" id="rating" name="rating" step="0.1" min="0" max="5"
                                    class="form-control-styled @error('rating') is-invalid @enderror"
                                    value="{{ old('rating') }}" placeholder="e.g. 4.7">
                                @error('rating')
                                <div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="review_count">Review Count</label>
                                <input type="number" id="review_count" name="review_count" min="0"
                                    class="form-control-styled" value="{{ old('review_count', 0) }}">
                            </div>
                            <div class="form-field">
                                <label for="starting_price">Starting Price</label>
                                <input type="number" id="starting_price" name="starting_price" min="0" step="0.01"
                                    class="form-control-styled" value="{{ old('starting_price') }}"
                                    placeholder="e.g. 4675">
                            </div>
                            <div class="form-field">
                                <label for="price_unit">Price Unit</label>
                                <input type="text" id="price_unit" name="price_unit" class="form-control-styled"
                                    value="{{ old('price_unit', '/ Adult') }}">
                            </div>
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

                    {{-- ============ ABOUT ============ --}}
                    <div class="cat-tab-panel" data-panel="about">

                        <div class="form-field">
                            <label for="about_title">About Section Title</label>
                            <input type="text" id="about_title" name="about_title" class="form-control-styled"
                                value="{{ old('about_title') }}" placeholder="Defaults to 'About [Activity Name]'">
                        </div>

                        <div class="form-field">
                            <label for="about_content">About Content</label>
                            <textarea id="about_content" name="about_content" rows="5"
                                class="form-control-styled">{{ old('about_content') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Highlights</label>
                            <div id="highlights-list"></div>
                            <button type="button" class="btn-secondary-dash add-simple-row"
                                data-target="highlights-list" data-name="highlights[]"
                                data-placeholder="e.g. Witness sunset from the world's highest deck">
                                <i class="fa fa-plus"></i> Add Highlight
                            </button>
                            <div class="hint">Shown as a bulleted "Highlights" list</div>
                        </div>

                        <div class="form-field">
                            <label for="what_to_expect_content">What to Expect</label>
                            <textarea id="what_to_expect_content" name="what_to_expect_content" rows="5"
                                class="form-control-styled">{{ old('what_to_expect_content') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Know Before You Go</label>
                            <div id="kbyg-list"></div>
                            <button type="button" class="btn-secondary-dash add-simple-row" data-target="kbyg-list"
                                data-name="know_before_you_go[]"
                                data-placeholder="e.g. Arrive 30 minutes before your slot">
                                <i class="fa fa-plus"></i> Add Item
                            </button>
                        </div>

                        <div class="form-field">
                            <label>Sidebar Points</label>
                            <div id="sidebar-points-list"></div>
                            <button type="button" class="btn-secondary-dash add-simple-row"
                                data-target="sidebar-points-list" data-name="sidebar_points[]"
                                data-placeholder="e.g. Instant confirmation">
                                <i class="fa fa-plus"></i> Add Point
                            </button>
                            <div class="hint">Shown as bullet points in the sticky price sidebar card</div>
                        </div>

                    </div>

                    {{-- ============ PACKAGES ============ --}}
                    <div class="cat-tab-panel" data-panel="packages">
                        <div id="package-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-package-row">
                            <i class="fa fa-plus"></i> Add Package
                        </button>
                        <div class="hint" style="margin-top:10px;">Shown as cards in "Select Package Options" — mark one
                            Recommended to show the "Most Popular" ribbon</div>
                    </div>

                    {{-- ============ MAP ============ --}}
                    <div class="cat-tab-panel" data-panel="map">

                        <div class="form-field">
                            <label for="map_embed_url">Google Maps Embed URL</label>
                            <input type="text" id="map_embed_url" name="map_embed_url" class="form-control-styled"
                                value="{{ old('map_embed_url') }}"
                                placeholder="e.g. https://www.google.com/maps?q=Burj+Khalifa+Dubai&output=embed">
                            <div class="hint">Paste the full embed URL (Google Maps → Share → Embed a map → copy the
                                src)</div>
                        </div>

                        <div class="form-field">
                            <label for="map_address">Address</label>
                            <textarea id="map_address" name="map_address" rows="2"
                                class="form-control-styled">{{ old('map_address') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Nearby / Location Points</label>
                            <div id="map-points-list"></div>
                            <button type="button" class="btn-secondary-dash add-simple-row"
                                data-target="map-points-list" data-name="map_points[]"
                                data-placeholder="e.g. Nearest Metro: Burj Khalifa/Dubai Mall Station (10 min walk)">
                                <i class="fa fa-plus"></i> Add Point
                            </button>
                        </div>

                        <div class="form-field">
                            <label for="map_directions_url">Directions Link</label>
                            <input type="text" id="map_directions_url" name="map_directions_url"
                                class="form-control-styled" value="{{ old('map_directions_url') }}"
                                placeholder="e.g. https://www.google.com/maps?q=Burj+Khalifa+Dubai">
                            <div class="hint">Used by the "Get Directions" button</div>
                        </div>

                    </div>

                    {{-- ============ POLICIES ============ --}}
                    <div class="cat-tab-panel" data-panel="policies">
                        <div id="policy-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-policy-row">
                            <i class="fa fa-plus"></i> Add Policy Block
                        </button>
                        <div class="hint" style="margin-top:10px;">
                            Each block becomes a titled section in the Policies tab (e.g. "Cancellation Policy",
                            "Booking Confirmation").
                            A block is skipped if it has no title or no points.
                        </div>
                    </div>

                    {{-- ============ ATTRACTIONS ============ --}}
                    <div class="cat-tab-panel" data-panel="attractions">
                        <div id="attraction-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-attraction-row">
                            <i class="fa fa-plus"></i> Add Attraction
                        </button>
                        <div class="hint" style="margin-top:10px;">
                            Pick existing Attractions to show in the "Top Attractions" section on this activity's page.
                            Row order sets
                            the display order.
                        </div>
                    </div>

                    {{-- ============ FAQS ============ --}}
                    <div class="cat-tab-panel" data-panel="faqs">
                        <div id="faq-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-faq-row">
                            <i class="fa fa-plus"></i> Add FAQ
                        </button>
                        <div class="hint" style="margin-top:10px;">A row is skipped if question or answer is left blank.
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Save Activity
                        </button>
                        <a href="{{ route('admin.activities.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script id="attractions-options-data" type="application/json">
    {!! json_encode($attractions->map(fn($a) => ['id' => $a->id, 'name' => $a->name])) !!}
</script>
<script>
    document.querySelectorAll('#activity-tabs .cat-tab').forEach(function (tabBtn) {
        tabBtn.addEventListener('click', function () {
            document.querySelectorAll('#activity-tabs .cat-tab').forEach(b => b.classList.remove('active'));
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

        document.querySelectorAll('#activity-tabs .cat-tab').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.remove('active'));
        panel.classList.add('active');
        document.querySelector('#activity-tabs .cat-tab[data-tab="' + panel.dataset.panel + '"]').classList.add('active');
    })();

    document.getElementById('name').addEventListener('keyup', function () {
        const slug = this.value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

        document.getElementById('slug').value = slug;
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

    // ---- Generic simple flat-list repeater (highlights / know_before_you_go / sidebar_points) ----
    function addSimpleRow(containerId, inputName, placeholder, value = '') {
        const container = document.getElementById(containerId);
        const wrap = document.createElement('div');
        wrap.className = 'simple-list-row';
        wrap.innerHTML = `
            <input type="text" name="${inputName}" class="form-control-styled" placeholder="${placeholder}" value="${value}">
            <button type="button" class="btn-secondary-dash remove-simple-row"><i class="fa fa-times"></i></button>
        `;
        container.appendChild(wrap);
        wrap.querySelector('.remove-simple-row').addEventListener('click', () => wrap.remove());
    }

    document.querySelectorAll('.add-simple-row').forEach(function (btn) {
        btn.addEventListener('click', function () {
            addSimpleRow(this.dataset.target, this.dataset.name, this.dataset.placeholder);
        });
    });

    // ---- Packages repeater ----
    let packageIndex = 0;

    function addPackageRow(data = null) {
        const idx = packageIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-row" style="grid-template-columns: 2fr 1fr;">
            <div class="form-field">
                <label>Package Title</label>
                <input type="text" name="package_titles[${idx}]" class="form-control-styled" placeholder="e.g. At The Top – 124th & 125th Floor" value="${data ? data.title : ''}">
            </div>
            <div class="form-field">
                <label>Duration Label</label>
                <input type="text" name="package_duration_labels[${idx}]" class="form-control-styled" placeholder="e.g. Prime Hours" value="${data ? data.duration_label : ''}">
            </div>
        </div>
        <div class="form-field">
            <label>Description</label>
            <textarea name="package_descriptions[${idx}]" class="form-control-styled" rows="2">${data ? data.description : ''}</textarea>
        </div>
        <div class="form-field">
            <label>Includes</label>
            <div class="package-includes" data-index="${idx}"></div>
            <button type="button" class="btn-secondary-dash add-include-btn" data-index="${idx}" style="margin-top:8px;">
                <i class="fa fa-plus"></i> Add Include
            </button>
        </div>
        <div class="form-row" style="grid-template-columns: 1fr 1fr 1fr;">
            <div class="form-field">
                <label>Old Price</label>
                <input type="number" step="0.01" min="0" name="package_old_prices[${idx}]" class="form-control-styled" value="${data ? data.old_price : ''}">
            </div>
            <div class="form-field">
                <label>New Price</label>
                <input type="number" step="0.01" min="0" name="package_new_prices[${idx}]" class="form-control-styled" value="${data ? data.new_price : ''}">
            </div>
            <div class="form-field">
                <label>Save Text</label>
                <input type="text" name="package_save_texts[${idx}]" class="form-control-styled" placeholder="e.g. Save 10%" value="${data ? data.save_text : ''}">
            </div>
        </div>
        <div class="form-field toggle-row">
            <label class="switch">
                <input type="checkbox" name="package_recommended[${idx}]" value="1" ${data && data.is_recommended ? 'checked' : ''}>
                <span class="switch-slider"></span>
            </label>
            <label style="margin:0">Recommended (Most Popular ribbon)</label>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove Package</button>
    `;
        document.getElementById('package-rows').appendChild(row);

        const includes = (data && data.includes && data.includes.length) ? data.includes : [''];
        includes.forEach(i => addIncludeInput(idx, i));

        row.querySelector('.add-include-btn').addEventListener('click', function () {
            addIncludeInput(idx, '');
        });

        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        packageIndex++;
    }

    function addIncludeInput(packageIdx, value) {
        const container = document.querySelector(`.package-includes[data-index="${packageIdx}"]`);
        const wrap = document.createElement('div');
        wrap.className = 'simple-list-row';
        wrap.innerHTML = `
        <input type="text" name="package_includes[${packageIdx}][]" class="form-control-styled" placeholder="e.g. Skip-the-line entry" value="${value}">
        <button type="button" class="btn-secondary-dash remove-simple-row"><i class="fa fa-times"></i></button>
    `;
        container.appendChild(wrap);
        wrap.querySelector('.remove-simple-row').addEventListener('click', () => wrap.remove());
    }

    document.getElementById('add-package-row').addEventListener('click', () => addPackageRow());


    let policyIndex = 0;

    function addPolicyRow(data = null) {
        const idx = policyIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Block Title</label>
            <input type="text" name="policy_titles[${idx}]" class="form-control-styled" placeholder="e.g. Cancellation Policy" value="${data ? data.title : ''}">
        </div>
        <div class="form-field">
            <label>Points</label>
            <div class="policy-points" data-index="${idx}"></div>
            <button type="button" class="btn-secondary-dash add-policy-point-btn" data-index="${idx}" style="margin-top:8px;">
                <i class="fa fa-plus"></i> Add Point
            </button>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove Block</button>
    `;
        document.getElementById('policy-rows').appendChild(row);

        const points = (data && data.points && data.points.length) ? data.points : [''];
        points.forEach(p => addPolicyPointInput(idx, p));

        row.querySelector('.add-policy-point-btn').addEventListener('click', function () {
            addPolicyPointInput(idx, '');
        });

        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        policyIndex++;
    }

    function addPolicyPointInput(policyIdx, value) {
        const container = document.querySelector(`.policy-points[data-index="${policyIdx}"]`);
        const wrap = document.createElement('div');
        wrap.className = 'simple-list-row';
        wrap.innerHTML = `
        <input type="text" name="policy_points[${policyIdx}][]" class="form-control-styled" placeholder="e.g. Free cancellation up to 24 hours before your scheduled slot." value="${value}">
        <button type="button" class="btn-secondary-dash remove-simple-row"><i class="fa fa-times"></i></button>
    `;
        container.appendChild(wrap);
        wrap.querySelector('.remove-simple-row').addEventListener('click', () => wrap.remove());
    }

    document.getElementById('add-policy-row').addEventListener('click', () => addPolicyRow());

    // ---- FAQs repeater (question + answer pair) ----
    let faqIndex = 0;

    function addFaqRow(data = null) {
        const idx = faqIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Question</label>
            <input type="text" name="faq_questions[${idx}]" class="form-control-styled" placeholder="e.g. What is the cancellation policy?" value="${data ? data.question : ''}">
        </div>
        <div class="form-field">
            <label>Answer</label>
            <textarea name="faq_answers[${idx}]" class="form-control-styled" rows="2">${data ? data.answer : ''}</textarea>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove FAQ</button>
    `;
        document.getElementById('faq-rows').appendChild(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        faqIndex++;
    }

    document.getElementById('add-faq-row').addEventListener('click', () => addFaqRow());

    // ---- Attractions repeater (picks existing Attraction records) ----
    const attractionOptions = JSON.parse(document.getElementById('attractions-options-data').textContent);
    let attractionRowIndex = 0;

    function addAttractionRow(selectedId = null) {
        const idx = attractionRowIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';

        const optionsHtml = attractionOptions.map(opt =>
            `<option value="${opt.id}" ${selectedId == opt.id ? 'selected' : ''}>${opt.name}</option>`
        ).join('');

        row.innerHTML = `
        <div class="form-field">
            <label>Attraction</label>
            <select name="attraction_ids[${idx}]" class="form-control-styled">
                <option value="">Select Attraction</option>
                ${optionsHtml}
            </select>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('attraction-rows').appendChild(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        attractionRowIndex++;
    }

    document.getElementById('add-attraction-row').addEventListener('click', () => addAttractionRow());
</script>

@include('admin.footer')