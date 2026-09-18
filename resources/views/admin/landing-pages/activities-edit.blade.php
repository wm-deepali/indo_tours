{{-- resources/views/admin/landing-pages/activities/edit.blade.php --}}
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
            width: 96px;
            height: 64px;
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
                    <h1>Activities Landing Page</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Content Manage
                        <span>›</span>
                        Manage Landing Pages
                        <span>›</span>
                        Activities Page
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-info" style="margin-bottom:16px;">{{ session('success') }}</div>
            @endif

            <div class="cat-card">
                <form action="{{ route('admin.landing-pages.activities.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="cat-tabs" id="lp-tabs">
                        <button type="button" class="cat-tab active" data-tab="hero">Hero Banner</button>
                        <button type="button" class="cat-tab" data-tab="intro">Intro</button>
                        <button type="button" class="cat-tab" data-tab="offer">Offer Promo</button>
                        <button type="button" class="cat-tab" data-tab="group-offer">Group Offer</button>
                        <button type="button" class="cat-tab" data-tab="planning">Planning Guide</button>
                        <button type="button" class="cat-tab" data-tab="benefits">Why Book With Us</button>
                        <button type="button" class="cat-tab" data-tab="final-cta">Final CTA</button>
                        <button type="button" class="cat-tab" data-tab="related-destinations">Related
                            Destinations</button>
                        <button type="button" class="cat-tab" data-tab="seo-links">SEO Links</button>
                    </div>

                    {{-- ============ HERO BANNER ============ --}}
                    <div class="cat-tab-panel active" data-panel="hero">

                        <div class="form-field">
                            <label for="hero_badge_text">Badge Text</label>
                            <input type="text" id="hero_badge_text" name="hero_badge_text" class="form-control-styled"
                                value="{{ old('hero_badge_text', $landingPage->hero_badge_text) }}"
                                placeholder="e.g. Exclusive Activity Deals">
                        </div>

                        <div class="form-field">
                            <label for="hero_heading">Heading (H1)</label>
                            <input type="text" id="hero_heading" name="hero_heading"
                                class="form-control-styled @error('hero_heading') is-invalid @enderror"
                                value="{{ old('hero_heading', $landingPage->hero_heading) }}"
                                placeholder="e.g. Best Activities For Your Trip">
                            @error('hero_heading')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="hero_description">Description</label>
                            <textarea id="hero_description" name="hero_description" rows="3"
                                class="form-control-styled">{{ old('hero_description', $landingPage->hero_description) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="hero_cta_text">CTA Button Text</label>
                                <input type="text" id="hero_cta_text" name="hero_cta_text" class="form-control-styled"
                                    value="{{ old('hero_cta_text', $landingPage->hero_cta_text) }}"
                                    placeholder="e.g. Explore Activities">
                            </div>
                            <div class="form-field">
                                <label for="hero_cta_url">CTA Button Link</label>
                                <input type="text" id="hero_cta_url" name="hero_cta_url" class="form-control-styled"
                                    value="{{ old('hero_cta_url', $landingPage->hero_cta_url) }}"
                                    placeholder="e.g. #activities-grid">
                            </div>
                        </div>

                        <h4 class="sub-block-title">Hero Slider Images</h4>
                        <div id="hero-slide-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-hero-slide-row">
                            <i class="fa fa-plus"></i> Add Slide
                        </button>
                        <div class="hint" style="margin-top:10px;">Leave a slide's image blank to keep its current
                            image.</div>

                    </div>

                    {{-- ============ INTRO ============ --}}
                    <div class="cat-tab-panel" data-panel="intro">

                        <div class="form-field">
                            <label for="intro_heading">Heading</label>
                            <input type="text" id="intro_heading" name="intro_heading" class="form-control-styled"
                                value="{{ old('intro_heading', $landingPage->intro_heading) }}"
                                placeholder="e.g. Things To Do">
                        </div>

                        <div class="form-field">
                            <label for="intro_description">Sub-heading / Description</label>
                            <textarea id="intro_description" name="intro_description" rows="3"
                                class="form-control-styled">{{ old('intro_description', $landingPage->intro_description) }}</textarea>
                        </div>

                    </div>

                    {{-- ============ OFFER PROMO ============ --}}
                    <div class="cat-tab-panel" data-panel="offer">

                        <div class="form-field">
                            <label for="offer_badge_text">Badge Text</label>
                            <input type="text" id="offer_badge_text" name="offer_badge_text" class="form-control-styled"
                                value="{{ old('offer_badge_text', $landingPage->offer_badge_text) }}"
                                placeholder="e.g. Special Offer">
                        </div>

                        <div class="form-field">
                            <label for="offer_heading">Heading</label>
                            <input type="text" id="offer_heading" name="offer_heading" class="form-control-styled"
                                value="{{ old('offer_heading', $landingPage->offer_heading) }}"
                                placeholder="e.g. Save Big On Selected Activities">
                        </div>

                        <div class="form-field">
                            <label for="offer_description">Description</label>
                            <textarea id="offer_description" name="offer_description" rows="3"
                                class="form-control-styled">{{ old('offer_description', $landingPage->offer_description) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="offer_cta_text">CTA Button Text</label>
                                <input type="text" id="offer_cta_text" name="offer_cta_text" class="form-control-styled"
                                    value="{{ old('offer_cta_text', $landingPage->offer_cta_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="offer_cta_url">CTA Button Link</label>
                                <input type="text" id="offer_cta_url" name="offer_cta_url" class="form-control-styled"
                                    value="{{ old('offer_cta_url', $landingPage->offer_cta_url) }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="offer_countdown_end">Sale Countdown Ends At</label>
                            <input type="datetime-local" id="offer_countdown_end" name="offer_countdown_end"
                                class="form-control-styled"
                                value="{{ old('offer_countdown_end', $landingPage->offer_countdown_end?->format('Y-m-d\TH:i')) }}">
                            <div class="hint">Leave blank to hide the countdown timer on this section.</div>
                        </div>

                    </div>

                    {{-- ============ GROUP OFFER BANNER ============ --}}
                    <div class="cat-tab-panel" data-panel="group-offer">

                        <div class="form-field">
                            <label for="group_offer_badge_text">Badge Text</label>
                            <input type="text" id="group_offer_badge_text" name="group_offer_badge_text"
                                class="form-control-styled"
                                value="{{ old('group_offer_badge_text', $landingPage->group_offer_badge_text) }}">
                        </div>

                        <div class="form-field">
                            <label for="group_offer_heading">Heading</label>
                            <input type="text" id="group_offer_heading" name="group_offer_heading"
                                class="form-control-styled"
                                value="{{ old('group_offer_heading', $landingPage->group_offer_heading) }}">
                        </div>

                        <div class="form-field">
                            <label for="group_offer_description">Description</label>
                            <textarea id="group_offer_description" name="group_offer_description" rows="3"
                                class="form-control-styled">{{ old('group_offer_description', $landingPage->group_offer_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Perks List</label>
                            <div id="group-offer-perks-list"></div>
                            <button type="button" class="btn-secondary-dash add-simple-row"
                                data-target="group-offer-perks-list" data-name="group_offer_perks[]"
                                data-placeholder="e.g. Easy Booking & Flexible Travel Options">
                                <i class="fa fa-plus"></i> Add Perk
                            </button>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="group_offer_cta1_text">CTA 1 Text</label>
                                <input type="text" id="group_offer_cta1_text" name="group_offer_cta1_text"
                                    class="form-control-styled"
                                    value="{{ old('group_offer_cta1_text', $landingPage->group_offer_cta1_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="group_offer_cta1_url">CTA 1 Link</label>
                                <input type="text" id="group_offer_cta1_url" name="group_offer_cta1_url"
                                    class="form-control-styled"
                                    value="{{ old('group_offer_cta1_url', $landingPage->group_offer_cta1_url) }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="group_offer_cta2_text">CTA 2 Text</label>
                                <input type="text" id="group_offer_cta2_text" name="group_offer_cta2_text"
                                    class="form-control-styled"
                                    value="{{ old('group_offer_cta2_text', $landingPage->group_offer_cta2_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="group_offer_cta2_url">CTA 2 Link</label>
                                <input type="text" id="group_offer_cta2_url" name="group_offer_cta2_url"
                                    class="form-control-styled"
                                    value="{{ old('group_offer_cta2_url', $landingPage->group_offer_cta2_url) }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="group_offer_image">Banner Image</label>
                            @if($landingPage->group_offer_image)
                            <img src="{{ asset('storage/' . $landingPage->group_offer_image) }}"
                                class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="group_offer_image" name="group_offer_image"
                                class="form-control-styled" accept="image/*">
                            <div class="hint">Leave blank to keep the current image</div>
                        </div>

                    </div>

                    {{-- ============ PLANNING GUIDE ============ --}}
                    <div class="cat-tab-panel" data-panel="planning">

                        <div class="form-row">
                            <div class="form-field">
                                <label for="planning_eyebrow">Eyebrow</label>
                                <input type="text" id="planning_eyebrow" name="planning_eyebrow"
                                    class="form-control-styled"
                                    value="{{ old('planning_eyebrow', $landingPage->planning_eyebrow) }}"
                                    placeholder="e.g. Plan Ahead">
                            </div>
                            <div class="form-field">
                                <label for="planning_heading">Heading</label>
                                <input type="text" id="planning_heading" name="planning_heading"
                                    class="form-control-styled"
                                    value="{{ old('planning_heading', $landingPage->planning_heading) }}"
                                    placeholder="e.g. Plan Your Activities">
                            </div>
                        </div>

                        <h4 class="sub-block-title">Guide Blocks</h4>
                        <div id="planning-block-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-planning-block-row">
                            <i class="fa fa-plus"></i> Add Block
                        </button>
                        <div class="hint" style="margin-top:10px;">
                            Each block becomes a titled paragraph (e.g. "Best Time", "Best For Families"). A block with
                            no title and no content is skipped.
                        </div>

                    </div>

                    {{-- ============ WHY BOOK WITH US ============ --}}
                    <div class="cat-tab-panel" data-panel="benefits">

                        <div class="form-field">
                            <label for="benefits_heading">Heading</label>
                            <input type="text" id="benefits_heading" name="benefits_heading" class="form-control-styled"
                                value="{{ old('benefits_heading', $landingPage->benefits_heading) }}"
                                placeholder="e.g. Why Book With Us?">
                        </div>

                        <div class="form-field">
                            <label for="benefits_description">Sub-heading / Description</label>
                            <textarea id="benefits_description" name="benefits_description" rows="3"
                                class="form-control-styled">{{ old('benefits_description', $landingPage->benefits_description) }}</textarea>
                        </div>

                        <h4 class="sub-block-title">Benefit Items</h4>
                        <div id="benefit-item-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-benefit-item-row">
                            <i class="fa fa-plus"></i> Add Benefit
                        </button>

                    </div>

                    {{-- ============ FINAL CTA ============ --}}
                    <div class="cat-tab-panel" data-panel="final-cta">

                        <div class="form-field">
                            <label for="final_cta_heading">Heading</label>
                            <input type="text" id="final_cta_heading" name="final_cta_heading"
                                class="form-control-styled"
                                value="{{ old('final_cta_heading', $landingPage->final_cta_heading) }}"
                                placeholder="e.g. Ready To Get Started?">
                        </div>

                        <div class="form-field">
                            <label for="final_cta_description">Description</label>
                            <textarea id="final_cta_description" name="final_cta_description" rows="3"
                                class="form-control-styled">{{ old('final_cta_description', $landingPage->final_cta_description) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="final_cta1_text">CTA 1 Text</label>
                                <input type="text" id="final_cta1_text" name="final_cta1_text"
                                    class="form-control-styled"
                                    value="{{ old('final_cta1_text', $landingPage->final_cta1_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="final_cta1_url">CTA 1 Link</label>
                                <input type="text" id="final_cta1_url" name="final_cta1_url" class="form-control-styled"
                                    value="{{ old('final_cta1_url', $landingPage->final_cta1_url) }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="final_cta2_text">CTA 2 Text</label>
                                <input type="text" id="final_cta2_text" name="final_cta2_text"
                                    class="form-control-styled"
                                    value="{{ old('final_cta2_text', $landingPage->final_cta2_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="final_cta2_url">CTA 2 Link</label>
                                <input type="text" id="final_cta2_url" name="final_cta2_url" class="form-control-styled"
                                    value="{{ old('final_cta2_url', $landingPage->final_cta2_url) }}">
                            </div>
                        </div>

                    </div>


                    {{-- ============ RELATED DESTINATIONS ============ --}}
                    <div class="cat-tab-panel" data-panel="related-destinations">

                        <div class="form-field">
                            <label for="related_destinations_heading">Heading</label>
                            <input type="text" id="related_destinations_heading" name="related_destinations_heading"
                                class="form-control-styled"
                                value="{{ old('related_destinations_heading', $landingPage->related_destinations_heading) }}"
                                placeholder="e.g. Popular Related Destinations">
                        </div>

                        <div class="form-field">
                            <label for="related_destinations_description">Description</label>
                            <textarea id="related_destinations_description" name="related_destinations_description"
                                rows="3"
                                class="form-control-styled">{{ old('related_destinations_description', $landingPage->related_destinations_description) }}</textarea>
                        </div>

                        <h4 class="sub-block-title">Destinations to Show</h4>
                        <div id="related-destination-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-related-destination-row">
                            <i class="fa fa-plus"></i> Add Destination
                        </button>
                        <div class="hint" style="margin-top:10px;">
                            Pick existing Destination records to feature here. Row order sets the display order.
                        </div>

                    </div>

                    {{-- ============ SEO LINKS ============ --}}
                    <div class="cat-tab-panel" data-panel="seo-links">

                        <div class="form-field">
                            <label for="seo_links_heading">Heading</label>
                            <input type="text" id="seo_links_heading" name="seo_links_heading"
                                class="form-control-styled"
                                value="{{ old('seo_links_heading', $landingPage->seo_links_heading) }}"
                                placeholder="e.g. Explore More Activities">
                        </div>

                        <div class="form-field">
                            <label for="seo_links_description">Description</label>
                            <textarea id="seo_links_description" name="seo_links_description" rows="3"
                                class="form-control-styled">{{ old('seo_links_description', $landingPage->seo_links_description) }}</textarea>
                        </div>

                        <h4 class="sub-block-title">Link Blocks</h4>
                        <div id="seo-block-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-seo-block-row">
                            <i class="fa fa-plus"></i> Add Link Block
                        </button>
                        <div class="hint" style="margin-top:10px;">
                            Each block becomes one column (e.g. "Popular Tours", "Things to Do"). A block needs a
                            heading and at least
                            one link with both text and URL filled in, or it's skipped.
                        </div>

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
<script id="existing-hero-slides-data" type="application/json">
    {!! json_encode($landingPage->hero_slider_images ?? []) !!}
</script>
<script id="existing-group-offer-perks-data" type="application/json">
    {!! json_encode(old('group_offer_perks', $landingPage->group_offer_perks ?? [])) !!}
</script>
<script id="existing-planning-blocks-data" type="application/json">
    {!! json_encode($landingPage->planning_blocks ?? []) !!}
</script>
<script id="existing-benefit-items-data" type="application/json">
    {!! json_encode($landingPage->benefits_items ?? []) !!}
</script>
<script id="attractions-picker-data" type="application/json">
    {!! json_encode($attractions->map(fn($a) => ['id' => $a->id, 'name' => $a->name])) !!}
</script>
<script id="existing-related-destination-ids-data" type="application/json">
    {!! json_encode($landingPage->related_destination_ids ?? []) !!}
</script>
<script id="existing-seo-link-blocks-data" type="application/json">
    {!! json_encode($landingPage->seo_link_blocks ?? []) !!}
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

    // ---- Generic simple flat-list repeater (perks) ----
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

    const groupOfferPerksData = JSON.parse(document.getElementById('existing-group-offer-perks-data').textContent);
    (groupOfferPerksData.length ? groupOfferPerksData : ['']).forEach(v =>
        addSimpleRow('group-offer-perks-list', 'group_offer_perks[]', 'e.g. Easy Booking & Flexible Travel Options', v)
    );

    // ---- Hero slider repeater (image + alt, carries forward existing image) ----
    let heroSlideIndex = 0;

    function addHeroSlideRow(data = null) {
        const idx = heroSlideIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-row">
            <div class="form-field">
                <label>Slide Image</label>
                ${data && data.image ? `<img src="${APP_URL}/storage/${data.image}" class="current-img-preview" alt="">` : ''}
                <input type="file" name="hero_slide_images[${idx}]" class="form-control-styled" accept="image/*">
                <input type="hidden" name="hero_slide_existing_images[${idx}]" value="${data && data.image ? data.image : ''}">
                <div class="hint">Leave blank to keep the current image</div>
            </div>
            <div class="form-field">
                <label>Alt Text</label>
                <input type="text" name="hero_slide_alts[${idx}]" class="form-control-styled" placeholder="e.g. Guests enjoying a guided tour" value="${data ? data.alt : ''}">
            </div>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove Slide</button>
    `;
        document.getElementById('hero-slide-rows').appendChild(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        heroSlideIndex++;
    }

    document.getElementById('add-hero-slide-row').addEventListener('click', () => addHeroSlideRow());

    const existingHeroSlidesData = JSON.parse(document.getElementById('existing-hero-slides-data').textContent);
    if (existingHeroSlidesData.length) {
        existingHeroSlidesData.forEach(data => addHeroSlideRow(data));
    } else {
        addHeroSlideRow();
    }

    // ---- Planning Guide blocks repeater (title + content pairs) ----
    let planningBlockIndex = 0;

    function addPlanningBlockRow(data = null) {
        const idx = planningBlockIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Block Title</label>
            <input type="text" name="planning_block_titles[${idx}]" class="form-control-styled" placeholder="e.g. Best Time to Visit" value="${data ? data.title : ''}">
        </div>
        <div class="form-field">
            <label>Content</label>
            <textarea name="planning_block_contents[${idx}]" class="form-control-styled" rows="3">${data ? data.content : ''}</textarea>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove Block</button>
    `;
        document.getElementById('planning-block-rows').appendChild(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        planningBlockIndex++;
    }

    document.getElementById('add-planning-block-row').addEventListener('click', () => addPlanningBlockRow());

    const existingPlanningBlocksData = JSON.parse(document.getElementById('existing-planning-blocks-data').textContent);
    if (existingPlanningBlocksData.length) {
        existingPlanningBlocksData.forEach(data => addPlanningBlockRow(data));
    } else {
        addPlanningBlockRow();
    }

    // ---- Benefit items repeater (icon keyword + title + description) ----
    const BENEFIT_ICONS = ['star', 'clock', 'check-circle', 'shield', 'heart', 'thumbs-up', 'gift', 'headset'];
    let benefitItemIndex = 0;

    function addBenefitItemRow(data = null) {
        const idx = benefitItemIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';

        const iconOptionsHtml = BENEFIT_ICONS.map(icon =>
            `<option value="${icon}" ${data && data.icon === icon ? 'selected' : ''}>${icon}</option>`
        ).join('');

        row.innerHTML = `
        <div class="form-row-3">
            <div class="form-field">
                <label>Icon</label>
                <select name="benefit_icons[${idx}]" class="form-control-styled">
                    ${iconOptionsHtml}
                </select>
            </div>
            <div class="form-field" style="grid-column: span 2;">
                <label>Title</label>
                <input type="text" name="benefit_titles[${idx}]" class="form-control-styled" placeholder="e.g. Handpicked Experiences" value="${data ? data.title : ''}">
            </div>
        </div>
        <div class="form-field">
            <label>Description</label>
            <input type="text" name="benefit_descriptions[${idx}]" class="form-control-styled" placeholder="e.g. Carefully selected experiences from trusted providers." value="${data ? data.description : ''}">
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove Benefit</button>
    `;
        document.getElementById('benefit-item-rows').appendChild(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        benefitItemIndex++;
    }

    document.getElementById('add-benefit-item-row').addEventListener('click', () => addBenefitItemRow());

    const existingBenefitItemsData = JSON.parse(document.getElementById('existing-benefit-items-data').textContent);
    if (existingBenefitItemsData.length) {
        existingBenefitItemsData.forEach(data => addBenefitItemRow(data));
    } else {
        addBenefitItemRow();
    }

    // ---- Related Destinations repeater (picks existing Attraction records) ----
    const attractionPickerOptions = JSON.parse(document.getElementById('attractions-picker-data').textContent);
    let relatedDestinationIndex = 0;

    function addRelatedDestinationRow(selectedId = null) {
        const idx = relatedDestinationIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';

        const optionsHtml = attractionPickerOptions.map(opt =>
            `<option value="${opt.id}" ${selectedId == opt.id ? 'selected' : ''}>${opt.name}</option>`
        ).join('');

        row.innerHTML = `
        <div class="form-field">
            <label>Destination</label>
            <select name="related_destination_ids[${idx}]" class="form-control-styled">
                <option value="">Select Destination</option>
                ${optionsHtml}
            </select>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('related-destination-rows').appendChild(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        relatedDestinationIndex++;
    }

    document.getElementById('add-related-destination-row').addEventListener('click', () => addRelatedDestinationRow());

    const existingRelatedDestinationIds = JSON.parse(document.getElementById('existing-related-destination-ids-data').textContent);
    if (existingRelatedDestinationIds.length) {
        existingRelatedDestinationIds.forEach(id => addRelatedDestinationRow(id));
    } else {
        addRelatedDestinationRow();
    }

    // ---- SEO Links repeater (nested: blocks, each with its own link rows) ----
    let seoBlockIndex = 0;

    function addSeoBlockRow(data = null) {
        const blockIdx = seoBlockIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Block Heading</label>
            <input type="text" name="seo_block_headings[${blockIdx}]" class="form-control-styled" placeholder="e.g. Popular Activities" value="${data ? data.heading : ''}">
        </div>
        <div class="form-field">
            <label>Links</label>
            <div class="seo-link-rows" data-block-index="${blockIdx}"></div>
            <button type="button" class="btn-secondary-dash add-seo-link-btn" data-block-index="${blockIdx}" style="margin-top:8px;">
                <i class="fa fa-plus"></i> Add Link
            </button>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove Block</button>
    `;
        document.getElementById('seo-block-rows').appendChild(row);

        const links = (data && data.links && data.links.length) ? data.links : [{ text: '', url: '' }];
        links.forEach(link => addSeoLinkRow(blockIdx, link));

        row.querySelector('.add-seo-link-btn').addEventListener('click', function () {
            addSeoLinkRow(blockIdx, { text: '', url: '' });
        });

        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        seoBlockIndex++;
    }

    function addSeoLinkRow(blockIdx, link) {
        const container = document.querySelector(`.seo-link-rows[data-block-index="${blockIdx}"]`);
        const wrap = document.createElement('div');
        wrap.className = 'form-row';
        wrap.style.marginBottom = '8px';
        wrap.innerHTML = `
        <input type="text" name="seo_link_texts[${blockIdx}][]" class="form-control-styled" placeholder="Link text" value="${link.text || ''}">
        <input type="text" name="seo_link_urls[${blockIdx}][]" class="form-control-styled" placeholder="/path/or/url" value="${link.url || ''}">
    `;
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn-secondary-dash';
        removeBtn.innerHTML = '<i class="fa fa-times"></i>';
        removeBtn.style.marginBottom = '8px';
        removeBtn.addEventListener('click', () => {
            wrap.remove();
            removeBtn.remove();
        });

        container.appendChild(wrap);
        container.appendChild(removeBtn);
    }

    document.getElementById('add-seo-block-row').addEventListener('click', () => addSeoBlockRow());

    const existingSeoLinkBlocksData = JSON.parse(document.getElementById('existing-seo-link-blocks-data').textContent);
    if (existingSeoLinkBlocksData.length) {
        existingSeoLinkBlocksData.forEach(data => addSeoBlockRow(data));
    } else {
        addSeoBlockRow();
    }

</script>

@include('admin.footer')