{{-- resources/views/admin/landing-pages/destinations/edit.blade.php --}}
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

        .cat-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); box-sizing: border-box; }
        .cat-page * { box-sizing: border-box; }
        .cat-page-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .cat-page-header h1 { font-size: 20px; font-weight: 650; margin: 0; }
        .cat-breadcrumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
        .cat-breadcrumb a { color: var(--accent); text-decoration: none; }
        .cat-breadcrumb span { margin: 0 5px; }
        .btn-primary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff !important; border: none; border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; box-shadow: 0 1px 3px rgba(48, 61, 137, .25); }
        .btn-primary-dash:hover { background: #252f70; }
        .btn-secondary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none !important; }
        .btn-secondary-dash:hover { background: var(--bg); }
        .cat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); max-width: 100vw; overflow: hidden; }
        .form-field { margin-bottom: 18px; }
        .form-field label { display: block; font-size: 12.5px; font-weight: 600; color: var(--text-secondary); margin-bottom: 6px; letter-spacing: .02em; }
        .form-field .hint { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }
        .form-control-styled { width: 100%; height: 40px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 12px; font-size: 13.5px; font-family: var(--font); color: var(--text-primary); outline: none; transition: border-color .15s, box-shadow .15s; background: var(--surface); }
        textarea.form-control-styled { height: auto; padding: 10px 12px; resize: vertical; }
        select.form-control-styled { appearance: auto; }
        .form-control-styled:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48, 61, 137, .12); }
        .form-error { color: #b22222; font-size: 12px; margin-top: 5px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .form-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; }
        .form-actions { display: flex; gap: 10px; padding: 20px 24px; border-top: 1px solid var(--border); background: var(--surface); }
        .cat-tabs { display: flex; gap: 2px; padding: 0 24px; border-bottom: 1px solid var(--border); background: var(--surface); overflow-x: auto; }
        .cat-tab { appearance: none; background: none; border: none; border-bottom: 2px solid transparent; padding: 14px 16px; font-family: var(--font); font-size: 13px; font-weight: 600; color: var(--text-secondary); cursor: pointer; white-space: nowrap; }
        .cat-tab:hover { color: var(--text-primary); }
        .cat-tab.active { color: var(--accent); border-bottom-color: var(--accent); }
        .cat-tab-panel { display: none; padding: 24px; }
        .cat-tab-panel.active { display: block; }
        .current-img-preview { width: 96px; height: 64px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--border); margin-bottom: 10px; display: block; }
        .gallery-row { border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 16px; margin-bottom: 14px; background: var(--bg); }
        .sub-block-title { font-size: 14px; font-weight: 650; margin: 0 0 12px; padding-top: 4px; }
        .sub-block-title:not(:first-child) { margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--border); }
        .simple-list-row { display: flex; gap: 8px; margin-bottom: 8px; }
        .simple-list-row .form-control-styled { flex: 1; }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Destinations Landing Page</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Content Manage
                        <span>›</span>
                        Manage Landing Pages
                        <span>›</span>
                        Destinations Page
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-info" style="margin-bottom:16px;">{{ session('success') }}</div>
            @endif

            <div class="cat-card">
                <form action="{{ route('admin.landing-pages.destination.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="cat-tabs" id="lp-tabs">
                        <button type="button" class="cat-tab active" data-tab="hero">Hero Banner</button>
                        <button type="button" class="cat-tab" data-tab="destinations">Destinations Grid</button>
                        <button type="button" class="cat-tab" data-tab="packages">Featured Packages</button>
                        <button type="button" class="cat-tab" data-tab="why-travel">Why Travel Simple</button>
                        <button type="button" class="cat-tab" data-tab="highlight">Highlight</button>
                        <button type="button" class="cat-tab" data-tab="experiences">Experiences</button>
                        <button type="button" class="cat-tab" data-tab="guides">Travel Guides</button>
                        <button type="button" class="cat-tab" data-tab="faqs">FAQs</button>
                    </div>

                    {{-- ============ HERO BANNER ============ --}}
                    <div class="cat-tab-panel active" data-panel="hero">

                        <div class="form-field">
                            <label for="hero_heading">Heading (H1)</label>
                            <input type="text" id="hero_heading" name="hero_heading"
                                class="form-control-styled @error('hero_heading') is-invalid @enderror"
                                value="{{ old('hero_heading', $landingPage->hero_heading) }}"
                                placeholder="e.g. Find Your Perfect Destination">
                            @error('hero_heading')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="hero_description">Description</label>
                            <textarea id="hero_description" name="hero_description" rows="3"
                                class="form-control-styled">{{ old('hero_description', $landingPage->hero_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="hero_video">Background Video</label>
                            @if($landingPage->hero_video)
                                <div class="hint" style="margin-bottom:8px;">Current: {{ basename($landingPage->hero_video) }}</div>
                            @endif
                            <input type="file" id="hero_video" name="hero_video" class="form-control-styled" accept="video/*">
                            <div class="hint">Leave blank to keep the current video (mp4/mov/webm, max 50MB)</div>
                        </div>

                    </div>

                    {{-- ============ DESTINATIONS GRID ============ --}}
                    <div class="cat-tab-panel" data-panel="destinations">

                        <div class="form-field">
                            <label for="destinations_heading">Heading</label>
                            <input type="text" id="destinations_heading" name="destinations_heading" class="form-control-styled"
                                value="{{ old('destinations_heading', $landingPage->destinations_heading) }}"
                                placeholder="e.g. Popular Destinations">
                        </div>

                        <div class="form-field">
                            <label for="destinations_description">Description</label>
                            <textarea id="destinations_description" name="destinations_description" rows="3"
                                class="form-control-styled">{{ old('destinations_description', $landingPage->destinations_description) }}</textarea>
                        </div>

                        <div class="hint">The destination cards themselves come from the Destinations module and can't be edited here.</div>

                    </div>

                    {{-- ============ FEATURED PACKAGES ============ --}}
                    <div class="cat-tab-panel" data-panel="packages">

                        <div class="form-field">
                            <label for="packages_heading">Heading</label>
                            <input type="text" id="packages_heading" name="packages_heading" class="form-control-styled"
                                value="{{ old('packages_heading', $landingPage->packages_heading) }}"
                                placeholder="e.g. Explore Our Tour Packages">
                        </div>

                        <div class="form-field">
                            <label for="packages_description">Description</label>
                            <textarea id="packages_description" name="packages_description" rows="3"
                                class="form-control-styled">{{ old('packages_description', $landingPage->packages_description) }}</textarea>
                        </div>

                        <div class="hint">
                            The package cards shown here are pulled automatically from Tour Packages marked
                            "Featured" — manage which packages appear from the Tour Packages module.
                        </div>

                    </div>

                    {{-- ============ WHY TRAVEL SIMPLE ============ --}}
                    <div class="cat-tab-panel" data-panel="why-travel">

                        <div class="form-field">
                            <label for="why_travel_heading">Heading</label>
                            <input type="text" id="why_travel_heading" name="why_travel_heading" class="form-control-styled"
                                value="{{ old('why_travel_heading', $landingPage->why_travel_heading) }}"
                                placeholder="e.g. Travel Made Simple">
                        </div>

                        <div class="form-field">
                            <label for="why_travel_description">Description</label>
                            <textarea id="why_travel_description" name="why_travel_description" rows="3"
                                class="form-control-styled">{{ old('why_travel_description', $landingPage->why_travel_description) }}</textarea>
                        </div>

                        <h4 class="sub-block-title">Items</h4>
                        <div id="why-travel-item-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-why-travel-item-row">
                            <i class="fa fa-plus"></i> Add Item
                        </button>

                    </div>

                    {{-- ============ HIGHLIGHT ============ --}}
                    <div class="cat-tab-panel" data-panel="highlight">

                        <div class="form-field">
                            <label for="highlight_image">Image</label>
                            @if($landingPage->highlight_image)
                            <img src="{{ asset('storage/' . $landingPage->highlight_image) }}"
                                class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="highlight_image" name="highlight_image" class="form-control-styled" accept="image/*">
                            <div class="hint">Leave blank to keep the current image</div>
                        </div>

                        <div class="form-field">
                            <label for="highlight_tag">Tag Text</label>
                            <input type="text" id="highlight_tag" name="highlight_tag" class="form-control-styled"
                                value="{{ old('highlight_tag', $landingPage->highlight_tag) }}"
                                placeholder="e.g. Destination Highlights">
                        </div>

                        <div class="form-field">
                            <label for="highlight_heading">Heading</label>
                            <input type="text" id="highlight_heading" name="highlight_heading" class="form-control-styled"
                                value="{{ old('highlight_heading', $landingPage->highlight_heading) }}"
                                placeholder="e.g. Discover More, Experience More">
                        </div>

                        <div class="form-field">
                            <label for="highlight_description">Description</label>
                            <textarea id="highlight_description" name="highlight_description" rows="3"
                                class="form-control-styled">{{ old('highlight_description', $landingPage->highlight_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Bullet Points</label>
                            <div id="highlight-points-list"></div>
                            <button type="button" class="btn-secondary-dash add-simple-row"
                                data-target="highlight-points-list" data-name="highlight_points[]"
                                data-placeholder="e.g. Must-visit attractions">
                                <i class="fa fa-plus"></i> Add Point
                            </button>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="highlight_cta_text">CTA Button Text</label>
                                <input type="text" id="highlight_cta_text" name="highlight_cta_text" class="form-control-styled"
                                    value="{{ old('highlight_cta_text', $landingPage->highlight_cta_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="highlight_cta_url">CTA Button Link</label>
                                <input type="text" id="highlight_cta_url" name="highlight_cta_url" class="form-control-styled"
                                    value="{{ old('highlight_cta_url', $landingPage->highlight_cta_url) }}">
                            </div>
                        </div>

                    </div>

                    {{-- ============ EXPERIENCES ============ --}}
                    <div class="cat-tab-panel" data-panel="experiences">

                        <div class="form-field">
                            <label for="experiences_heading">Heading</label>
                            <input type="text" id="experiences_heading" name="experiences_heading" class="form-control-styled"
                                value="{{ old('experiences_heading', $landingPage->experiences_heading) }}"
                                placeholder="e.g. Experiences You'll Love">
                        </div>

                        <div class="form-field">
                            <label for="experiences_description">Description</label>
                            <textarea id="experiences_description" name="experiences_description" rows="3"
                                class="form-control-styled">{{ old('experiences_description', $landingPage->experiences_description) }}</textarea>
                        </div>

                        <h4 class="sub-block-title">Experience Cards</h4>
                        <div id="experience-item-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-experience-item-row">
                            <i class="fa fa-plus"></i> Add Experience
                        </button>
                        <div class="hint" style="margin-top:10px;">Leave a card's image blank to keep its current image.</div>

                    </div>

                    {{-- ============ TRAVEL GUIDES ============ --}}
                    <div class="cat-tab-panel" data-panel="guides">

                        <div class="form-field">
                            <label for="guides_heading">Heading</label>
                            <input type="text" id="guides_heading" name="guides_heading" class="form-control-styled"
                                value="{{ old('guides_heading', $landingPage->guides_heading) }}"
                                placeholder="e.g. Travel Inspiration & Guides">
                        </div>

                        <div class="form-field">
                            <label for="guides_description">Description</label>
                            <textarea id="guides_description" name="guides_description" rows="3"
                                class="form-control-styled">{{ old('guides_description', $landingPage->guides_description) }}</textarea>
                        </div>

                        <h4 class="sub-block-title">Guide Cards</h4>
                        <div id="guide-item-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-guide-item-row">
                            <i class="fa fa-plus"></i> Add Guide
                        </button>
                        <div class="hint" style="margin-top:10px;">Leave a card's image blank to keep its current image.</div>

                    </div>

                    {{-- ============ FAQS ============ --}}
                    <div class="cat-tab-panel" data-panel="faqs">

                        <div class="form-field">
                            <label for="faqs_heading">Heading</label>
                            <input type="text" id="faqs_heading" name="faqs_heading" class="form-control-styled"
                                value="{{ old('faqs_heading', $landingPage->faqs_heading) }}"
                                placeholder="e.g. Frequently Asked Questions">
                        </div>

                        <div id="faq-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-faq-row">
                            <i class="fa fa-plus"></i> Add FAQ
                        </button>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Save Changes
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

{{-- Existing data handed to JS for pre-population --}}
<script id="existing-why-travel-items-data" type="application/json">
    {!! json_encode($landingPage->why_travel_items ?? []) !!}
</script>
<script id="existing-highlight-points-data" type="application/json">
    {!! json_encode(old('highlight_points', $landingPage->highlight_points ?? [])) !!}
</script>
<script id="existing-experience-items-data" type="application/json">
    {!! json_encode($landingPage->experience_items ?? []) !!}
</script>
<script id="existing-guide-items-data" type="application/json">
    {!! json_encode($landingPage->guide_items ?? []) !!}
</script>
<script id="existing-faqs-data" type="application/json">
    {!! json_encode($landingPage->faqs ?? []) !!}
</script>

<script>
    const APP_URL = "{{ rtrim(config('app.asset_url'), '/') }}";

    document.querySelectorAll('#lp-tabs .cat-tab').forEach(function (tabBtn) {
        tabBtn.addEventListener('click', function () {
            document.querySelectorAll('#lp-tabs .cat-tab').forEach(b => b.classList.remove('active'));
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

        document.querySelectorAll('#lp-tabs .cat-tab').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.remove('active'));
        panel.classList.add('active');
        document.querySelector('#lp-tabs .cat-tab[data-tab="' + panel.dataset.panel + '"]').classList.add('active');
    })();

    // ---- Generic simple flat-list repeater (bullet points) ----
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

    const highlightPointsData = JSON.parse(document.getElementById('existing-highlight-points-data').textContent);
    (highlightPointsData.length ? highlightPointsData : ['']).forEach(v =>
        addSimpleRow('highlight-points-list', 'highlight_points[]', 'e.g. Must-visit attractions', v)
    );

    // ---- Why Travel Simple repeater (icon + title + description) ----
    const BENEFIT_ICONS = ['star', 'clock', 'check-circle', 'shield', 'heart', 'thumbs-up', 'gift', 'headset'];
    let whyTravelIndex = 0;

    function addWhyTravelItemRow(data = null) {
        const idx = whyTravelIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';

        const iconOptionsHtml = BENEFIT_ICONS.map(icon =>
            `<option value="${icon}" ${data && data.icon === icon ? 'selected' : ''}>${icon}</option>`
        ).join('');

        row.innerHTML = `
        <div class="form-row-3">
            <div class="form-field">
                <label>Icon</label>
                <select name="why_icons[${idx}]" class="form-control-styled">
                    ${iconOptionsHtml}
                </select>
            </div>
            <div class="form-field" style="grid-column: span 2;">
                <label>Title</label>
                <input type="text" name="why_titles[${idx}]" class="form-control-styled" placeholder="e.g. Personalized Itineraries" value="${data ? data.title : ''}">
            </div>
        </div>
        <div class="form-field">
            <label>Description</label>
            <input type="text" name="why_descriptions[${idx}]" class="form-control-styled" placeholder="e.g. Trips planned around your interests." value="${data ? data.description : ''}">
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('why-travel-item-rows').appendChild(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        whyTravelIndex++;
    }

    document.getElementById('add-why-travel-item-row').addEventListener('click', () => addWhyTravelItemRow());

    const existingWhyTravelData = JSON.parse(document.getElementById('existing-why-travel-items-data').textContent);
    if (existingWhyTravelData.length) {
        existingWhyTravelData.forEach(data => addWhyTravelItemRow(data));
    } else {
        addWhyTravelItemRow();
    }

    // ---- Experiences repeater (image + title + description + link) ----
    let experienceIndex = 0;

    function addExperienceItemRow(data = null) {
        const idx = experienceIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Image</label>
            ${data && data.image ? `<img src="${APP_URL}/storage/${data.image}" class="current-img-preview" alt="">` : ''}
            <input type="file" name="experience_images[${idx}]" class="form-control-styled" accept="image/*">
            <input type="hidden" name="experience_existing_images[${idx}]" value="${data && data.image ? data.image : ''}">
        </div>
        <div class="form-field">
            <label>Title</label>
            <input type="text" name="experience_titles[${idx}]" class="form-control-styled" placeholder="e.g. Adventure" value="${data ? data.title : ''}">
        </div>
        <div class="form-field">
            <label>Description</label>
            <input type="text" name="experience_descriptions[${idx}]" class="form-control-styled" placeholder="e.g. Trekking, rafting and thrilling outdoor activities." value="${data ? data.description : ''}">
        </div>
        <div class="form-field">
            <label>Link URL</label>
            <input type="text" name="experience_link_urls[${idx}]" class="form-control-styled" value="${data ? data.link_url : ''}">
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('experience-item-rows').appendChild(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        experienceIndex++;
    }

    document.getElementById('add-experience-item-row').addEventListener('click', () => addExperienceItemRow());

    const existingExperienceData = JSON.parse(document.getElementById('existing-experience-items-data').textContent);
    if (existingExperienceData.length) {
        existingExperienceData.forEach(data => addExperienceItemRow(data));
    } else {
        addExperienceItemRow();
    }

    // ---- Travel Guides repeater (image + category + title + description + link) ----
    let guideIndex = 0;

    function addGuideItemRow(data = null) {
        const idx = guideIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Image</label>
            ${data && data.image ? `<img src="${APP_URL}/storage/${data.image}" class="current-img-preview" alt="">` : ''}
            <input type="file" name="guide_images[${idx}]" class="form-control-styled" accept="image/*">
            <input type="hidden" name="guide_existing_images[${idx}]" value="${data && data.image ? data.image : ''}">
        </div>
        <div class="form-row">
            <div class="form-field">
                <label>Category</label>
                <input type="text" name="guide_categories[${idx}]" class="form-control-styled" placeholder="e.g. Destination Guide" value="${data ? data.category : ''}">
            </div>
            <div class="form-field">
                <label>Title</label>
                <input type="text" name="guide_titles[${idx}]" class="form-control-styled" placeholder="e.g. Best Places to Visit in Kashmir" value="${data ? data.title : ''}">
            </div>
        </div>
        <div class="form-field">
            <label>Description</label>
            <input type="text" name="guide_descriptions[${idx}]" class="form-control-styled" value="${data ? data.description : ''}">
        </div>
        <div class="form-field">
            <label>Link URL</label>
            <input type="text" name="guide_link_urls[${idx}]" class="form-control-styled" value="${data ? data.link_url : ''}">
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('guide-item-rows').appendChild(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        guideIndex++;
    }

    document.getElementById('add-guide-item-row').addEventListener('click', () => addGuideItemRow());

    const existingGuideData = JSON.parse(document.getElementById('existing-guide-items-data').textContent);
    if (existingGuideData.length) {
        existingGuideData.forEach(data => addGuideItemRow(data));
    } else {
        addGuideItemRow();
    }

    // ---- FAQs repeater (question + answer pair) ----
    let faqIndex = 0;

    function addFaqRow(data = null) {
        const idx = faqIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Question</label>
            <input type="text" name="faq_questions[${idx}]" class="form-control-styled" value="${data ? data.question : ''}">
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

    const existingFaqsData = JSON.parse(document.getElementById('existing-faqs-data').textContent);
    if (existingFaqsData.length) {
        existingFaqsData.forEach(data => addFaqRow(data));
    } else {
        addFaqRow();
    }
</script>

@include('admin.footer')