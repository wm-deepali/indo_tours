{{-- resources/views/admin/landing-pages/attractions-edit.blade.php --}}
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
        .form-control-styled:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48, 61, 137, .12); }
        .form-error { color: #b22222; font-size: 12px; margin-top: 5px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
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
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Attractions Landing Page</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Content Manage
                        <span>›</span>
                        Manage Landing Pages
                        <span>›</span>
                        Attractions Page
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-info" style="margin-bottom:16px;">{{ session('success') }}</div>
            @endif

            <div class="cat-card">
                <form action="{{ route('admin.landing-pages.attraction.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="cat-tabs" id="lp-tabs">
                        <button type="button" class="cat-tab active" data-tab="hero">Hero Banner</button>
                        <button type="button" class="cat-tab" data-tab="destinations">Destinations Grid</button>
                        <button type="button" class="cat-tab" data-tab="featured">Featured Attractions</button>
                        <button type="button" class="cat-tab" data-tab="must-visit">Must-Visit</button>
                        <button type="button" class="cat-tab" data-tab="promo">Promo Banner</button>
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
                                placeholder="e.g. Find Your Perfect Attraction">
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

                        <div class="hint">The Destination filter dropdown pulls live from the Destinations module. The Category filter is not yet backed by data.</div>

                    </div>

                    {{-- ============ DESTINATIONS GRID ============ --}}
                    <div class="cat-tab-panel" data-panel="destinations">

                        <div class="form-field">
                            <label for="destinations_heading">Heading</label>
                            <input type="text" id="destinations_heading" name="destinations_heading" class="form-control-styled"
                                value="{{ old('destinations_heading', $landingPage->destinations_heading) }}"
                                placeholder="e.g. Explore Attractions by Destination">
                        </div>

                        <div class="form-field">
                            <label for="destinations_description">Description</label>
                            <textarea id="destinations_description" name="destinations_description" rows="3"
                                class="form-control-styled">{{ old('destinations_description', $landingPage->destinations_description) }}</textarea>
                        </div>

                        <div class="hint">The destination cards themselves come from the Destinations module and can't be edited here.</div>

                    </div>

                    {{-- ============ FEATURED ATTRACTIONS ============ --}}
                    <div class="cat-tab-panel" data-panel="featured">

                        <div class="form-field">
                            <label for="featured_heading">Heading</label>
                            <input type="text" id="featured_heading" name="featured_heading" class="form-control-styled"
                                value="{{ old('featured_heading', $landingPage->featured_heading) }}"
                                placeholder="e.g. Featured Attractions">
                        </div>

                        <div class="form-field">
                            <label for="featured_description">Description</label>
                            <textarea id="featured_description" name="featured_description" rows="3"
                                class="form-control-styled">{{ old('featured_description', $landingPage->featured_description) }}</textarea>
                        </div>

                        <div class="hint">Cards are pulled from Attractions marked "Featured" — manage which ones appear from the Attractions module.</div>

                    </div>

                    {{-- ============ MUST-VISIT ============ --}}
                    <div class="cat-tab-panel" data-panel="must-visit">

                        <div class="form-field">
                            <label for="must_visit_heading">Heading</label>
                            <input type="text" id="must_visit_heading" name="must_visit_heading" class="form-control-styled"
                                value="{{ old('must_visit_heading', $landingPage->must_visit_heading) }}"
                                placeholder="e.g. Must-Visit Attractions">
                        </div>

                        <div class="form-field">
                            <label for="must_visit_description">Description</label>
                            <textarea id="must_visit_description" name="must_visit_description" rows="3"
                                class="form-control-styled">{{ old('must_visit_description', $landingPage->must_visit_description) }}</textarea>
                        </div>

                        <div class="hint">Cards are the 6 highest-rated published Attractions — manage ratings from the Attractions module.</div>

                    </div>

                    {{-- ============ PROMO BANNER ============ --}}
                    <div class="cat-tab-panel" data-panel="promo">

                        <div class="form-field">
                            <label for="promo_image">Image</label>
                            @if($landingPage->promo_image)
                            <img src="{{ asset('storage/' . $landingPage->promo_image) }}"
                                class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="promo_image" name="promo_image" class="form-control-styled" accept="image/*">
                            <div class="hint">Leave blank to keep the current image</div>
                        </div>

                        <div class="form-field">
                            <label for="promo_eyebrow">Eyebrow Text</label>
                            <input type="text" id="promo_eyebrow" name="promo_eyebrow" class="form-control-styled"
                                value="{{ old('promo_eyebrow', $landingPage->promo_eyebrow) }}"
                                placeholder="e.g. Plan Your Trip">
                        </div>

                        <div class="form-field">
                            <label for="promo_heading">Heading</label>
                            <input type="text" id="promo_heading" name="promo_heading" class="form-control-styled"
                                value="{{ old('promo_heading', $landingPage->promo_heading) }}"
                                placeholder="e.g. Can't Decide Where to Go?">
                        </div>

                        <div class="form-field">
                            <label for="promo_description">Description</label>
                            <textarea id="promo_description" name="promo_description" rows="3"
                                class="form-control-styled">{{ old('promo_description', $landingPage->promo_description) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="promo_primary_text">Primary Button Text</label>
                                <input type="text" id="promo_primary_text" name="promo_primary_text" class="form-control-styled"
                                    value="{{ old('promo_primary_text', $landingPage->promo_primary_text) }}"
                                    placeholder="e.g. Plan My Trip">
                            </div>
                            <div class="form-field">
                                <label for="promo_primary_url">Primary Button Link</label>
                                <input type="text" id="promo_primary_url" name="promo_primary_url" class="form-control-styled"
                                    value="{{ old('promo_primary_url', $landingPage->promo_primary_url) }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="promo_secondary_text">Secondary Button Text</label>
                                <input type="text" id="promo_secondary_text" name="promo_secondary_text" class="form-control-styled"
                                    value="{{ old('promo_secondary_text', $landingPage->promo_secondary_text) }}"
                                    placeholder="e.g. Explore Tour Packages">
                            </div>
                            <div class="form-field">
                                <label for="promo_secondary_url">Secondary Button Link</label>
                                <input type="text" id="promo_secondary_url" name="promo_secondary_url" class="form-control-styled"
                                    value="{{ old('promo_secondary_url', $landingPage->promo_secondary_url) }}">
                            </div>
                        </div>

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
<script id="existing-guide-items-data" type="application/json">
    {!! json_encode($landingPage->guide_items ?? []) !!}
</script>
<script id="existing-faqs-data" type="application/json">
    {!! json_encode($landingPage->faqs ?? []) !!}
</script>

<script>
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

    // ---- Travel Guides repeater (image + category + title + description + link) ----
    let guideIndex = 0;

    function addGuideItemRow(data = null) {
        const idx = guideIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Image</label>
            ${data && data.image ? `<img src="/storage/${data.image}" class="current-img-preview" alt="">` : ''}
            <input type="file" name="guide_images[${idx}]" class="form-control-styled" accept="image/*">
            <input type="hidden" name="guide_existing_images[${idx}]" value="${data && data.image ? data.image : ''}">
        </div>
        <div class="form-row">
            <div class="form-field">
                <label>Category / Tag</label>
                <input type="text" name="guide_categories[${idx}]" class="form-control-styled" placeholder="e.g. Kashmir" value="${data ? data.category : ''}">
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