{{-- resources/views/admin/landing-pages/home/edit.blade.php --}}
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

        .check-inline { display: flex; align-items: center; gap: 8px; height: 40px; font-size: 13.5px; font-weight: 500; color: var(--text-primary); cursor: pointer; }
        .check-inline input { width: 16px; height: 16px; }
        .tour-row-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
        .tour-row-head strong { font-size: 13px; }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Home Page Content</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Content Manage
                        <span>›</span>
                        Manage Landing Pages
                        <span>›</span>
                        Home Page
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-info" style="margin-bottom:16px;">{{ session('success') }}</div>
            @endif

            <div class="cat-card">
                <form action="{{ route('admin.landing-pages.home.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="cat-tabs" id="lp-tabs">
                        <button type="button" class="cat-tab active" data-tab="hero">Hero Banner</button>
                        <button type="button" class="cat-tab" data-tab="tour-sections">Tour Sections</button>
                        <button type="button" class="cat-tab" data-tab="promo">Promo Grid</button>
                        <button type="button" class="cat-tab" data-tab="group-offer">Group Offer</button>
                        <button type="button" class="cat-tab" data-tab="who-we-are">Who We Are</button>
                        <button type="button" class="cat-tab" data-tab="slider">Home Slider</button>
                        <button type="button" class="cat-tab" data-tab="testimonials">Testimonials</button>
                        <button type="button" class="cat-tab" data-tab="discount-strip">Discount Strip</button>
                        <button type="button" class="cat-tab" data-tab="support">We're There</button>
                        <button type="button" class="cat-tab" data-tab="newsletter">Newsletter</button>
                    </div>

                    {{-- ============ HERO ============ --}}
                    <div class="cat-tab-panel active" data-panel="hero">
                        <div class="form-field">
                            <label for="hero_eyebrow">Eyebrow</label>
                            <input type="text" id="hero_eyebrow" name="hero_eyebrow" class="form-control-styled"
                                value="{{ old('hero_eyebrow', $content->hero_eyebrow) }}">
                        </div>
                        <div class="form-field">
                            <label for="hero_heading">Heading (H1)</label>
                            <input type="text" id="hero_heading" name="hero_heading"
                                class="form-control-styled @error('hero_heading') is-invalid @enderror"
                                value="{{ old('hero_heading', $content->hero_heading) }}">
                            @error('hero_heading')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-field">
                            <label for="hero_description">Description</label>
                            <textarea id="hero_description" name="hero_description" rows="3"
                                class="form-control-styled">{{ old('hero_description', $content->hero_description) }}</textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="hero_person_image">Person Image</label>
                                @if($content->hero_person_image)
                                    <img src="{{ asset('storage/' . $content->hero_person_image) }}" class="current-img-preview" alt="">
                                @endif
                                <input type="file" id="hero_person_image" name="hero_person_image" class="form-control-styled" accept="image/*">
                            </div>
                            <div class="form-field">
                                <label for="hero_illustration_image">Illustration Image</label>
                                @if($content->hero_illustration_image)
                                    <img src="{{ asset('storage/' . $content->hero_illustration_image) }}" class="current-img-preview" alt="">
                                @endif
                                <input type="file" id="hero_illustration_image" name="hero_illustration_image" class="form-control-styled" accept="image/*">
                            </div>
                        </div>
                    </div>

                    {{-- ============ TOUR SECTIONS ============ --}}
                    <div class="cat-tab-panel" data-panel="tour-sections">
                        @foreach($errors->get('tour_sections.*') as $messages)
                            @foreach($messages as $message)
                                <div class="form-error" style="margin-bottom:8px;">{{ $message }}</div>
                            @endforeach
                        @endforeach

                        <h4 class="sub-block-title">"Tours In …" Sections</h4>
                        <div class="hint" style="margin:-4px 0 14px;">
                            Each row is one "Tours In X" block on the home page. Packages are pulled automatically from the selected sub-category
                            (featured first, then latest). Rows show in the same order within each placement. A section with no packages stays hidden.
                        </div>

                        <div id="tour-sections-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-tour-section-row">
                            <i class="fa fa-plus"></i> Add Tour Section
                        </button>
                    </div>

                    {{-- ============ PROMO GRID ============ --}}
                    <div class="cat-tab-panel" data-panel="promo">
                        <div class="form-row">
                            <div class="form-field">
                                <label for="promo_eyebrow">Eyebrow</label>
                                <input type="text" id="promo_eyebrow" name="promo_eyebrow" class="form-control-styled"
                                    value="{{ old('promo_eyebrow', $content->promo_eyebrow) }}">
                            </div>
                            <div class="form-field">
                                <label for="promo_heading">Heading</label>
                                <input type="text" id="promo_heading" name="promo_heading" class="form-control-styled"
                                    value="{{ old('promo_heading', $content->promo_heading) }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="promo_cta_text">CTA Button Text</label>
                                <input type="text" id="promo_cta_text" name="promo_cta_text" class="form-control-styled"
                                    value="{{ old('promo_cta_text', $content->promo_cta_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="promo_cta_url">CTA Button Link</label>
                                <input type="text" id="promo_cta_url" name="promo_cta_url" class="form-control-styled"
                                    value="{{ old('promo_cta_url', $content->promo_cta_url) }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="promo_script_line_1">Overlay Line 1</label>
                                <input type="text" id="promo_script_line_1" name="promo_script_line_1" class="form-control-styled"
                                    value="{{ old('promo_script_line_1', $content->promo_script_line_1) }}">
                            </div>
                            <div class="form-field">
                                <label for="promo_script_line_2">Overlay Line 2</label>
                                <input type="text" id="promo_script_line_2" name="promo_script_line_2" class="form-control-styled"
                                    value="{{ old('promo_script_line_2', $content->promo_script_line_2) }}">
                            </div>
                        </div>
                        <div class="form-field">
                            <label for="promo_image">Background Image</label>
                            @if($content->promo_image)
                                <img src="{{ asset('storage/' . $content->promo_image) }}" class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="promo_image" name="promo_image" class="form-control-styled" accept="image/*">
                        </div>
                    </div>

                    {{-- ============ GROUP OFFER ============ --}}
                    <div class="cat-tab-panel" data-panel="group-offer">
                        <div class="form-field">
                            <label for="group_offer_badge_text">Badge Text</label>
                            <input type="text" id="group_offer_badge_text" name="group_offer_badge_text" class="form-control-styled"
                                value="{{ old('group_offer_badge_text', $content->group_offer_badge_text) }}">
                        </div>
                        <div class="form-field">
                            <label for="group_offer_heading">Heading</label>
                            <input type="text" id="group_offer_heading" name="group_offer_heading" class="form-control-styled"
                                value="{{ old('group_offer_heading', $content->group_offer_heading) }}">
                        </div>
                        <div class="form-field">
                            <label for="group_offer_description">Description</label>
                            <textarea id="group_offer_description" name="group_offer_description" rows="3"
                                class="form-control-styled">{{ old('group_offer_description', $content->group_offer_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Perks List</label>
                            <div id="group-offer-perks-list"></div>
                            <button type="button" class="btn-secondary-dash add-simple-row"
                                data-target="group-offer-perks-list" data-name="group_offer_perks[]"
                                data-placeholder="e.g. Free Transfers on All Packages">
                                <i class="fa fa-plus"></i> Add Perk
                            </button>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="group_offer_cta1_text">CTA 1 Text</label>
                                <input type="text" id="group_offer_cta1_text" name="group_offer_cta1_text" class="form-control-styled"
                                    value="{{ old('group_offer_cta1_text', $content->group_offer_cta1_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="group_offer_cta1_url">CTA 1 Link</label>
                                <input type="text" id="group_offer_cta1_url" name="group_offer_cta1_url" class="form-control-styled"
                                    value="{{ old('group_offer_cta1_url', $content->group_offer_cta1_url) }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="group_offer_cta2_text">CTA 2 Text</label>
                                <input type="text" id="group_offer_cta2_text" name="group_offer_cta2_text" class="form-control-styled"
                                    value="{{ old('group_offer_cta2_text', $content->group_offer_cta2_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="group_offer_cta2_url">CTA 2 Link</label>
                                <input type="text" id="group_offer_cta2_url" name="group_offer_cta2_url" class="form-control-styled"
                                    value="{{ old('group_offer_cta2_url', $content->group_offer_cta2_url) }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="group_offer_image">Banner Image</label>
                            @if($content->group_offer_image)
                                <img src="{{ asset('storage/' . $content->group_offer_image) }}" class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="group_offer_image" name="group_offer_image" class="form-control-styled" accept="image/*">
                        </div>
                    </div>

                    {{-- ============ WHO WE ARE ============ --}}
                    <div class="cat-tab-panel" data-panel="who-we-are">
                        <div class="form-row">
                            <div class="form-field">
                                <label for="who_we_are_badge">Badge</label>
                                <input type="text" id="who_we_are_badge" name="who_we_are_badge" class="form-control-styled"
                                    value="{{ old('who_we_are_badge', $content->who_we_are_badge) }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="who_we_are_heading">Heading</label>
                                <input type="text" id="who_we_are_heading" name="who_we_are_heading" class="form-control-styled"
                                    value="{{ old('who_we_are_heading', $content->who_we_are_heading) }}">
                            </div>
                            <div class="form-field">
                                <label for="who_we_are_heading_highlight">Heading (Highlighted Part)</label>
                                <input type="text" id="who_we_are_heading_highlight" name="who_we_are_heading_highlight" class="form-control-styled"
                                    value="{{ old('who_we_are_heading_highlight', $content->who_we_are_heading_highlight) }}">
                            </div>
                        </div>
                        <div class="form-field">
                            <label for="who_we_are_description">Description</label>
                            <textarea id="who_we_are_description" name="who_we_are_description" rows="3"
                                class="form-control-styled">{{ old('who_we_are_description', $content->who_we_are_description) }}</textarea>
                        </div>
                        <div class="form-field">
                            <label for="who_we_are_image">Image</label>
                            @if($content->who_we_are_image)
                                <img src="{{ asset('storage/' . $content->who_we_are_image) }}" class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="who_we_are_image" name="who_we_are_image" class="form-control-styled" accept="image/*">
                        </div>

                        <h4 class="sub-block-title">Stats</h4>
                        <div id="who-we-are-stats-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-who-we-are-stats-row">
                            <i class="fa fa-plus"></i> Add Stat
                        </button>

                        <h4 class="sub-block-title">CTA</h4>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="who_we_are_cta_text">CTA Button Text</label>
                                <input type="text" id="who_we_are_cta_text" name="who_we_are_cta_text" class="form-control-styled"
                                    value="{{ old('who_we_are_cta_text', $content->who_we_are_cta_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="who_we_are_cta_url">CTA Button Link</label>
                                <input type="text" id="who_we_are_cta_url" name="who_we_are_cta_url" class="form-control-styled"
                                    value="{{ old('who_we_are_cta_url', $content->who_we_are_cta_url) }}">
                            </div>
                        </div>
                    </div>

                    {{-- ============ HOME SLIDER ============ --}}
                    <div class="cat-tab-panel" data-panel="slider">
                        <h4 class="sub-block-title">Slider Images</h4>
                        <div id="home-slider-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-home-slider-row">
                            <i class="fa fa-plus"></i> Add Slide
                        </button>
                        <div class="hint" style="margin-top:10px;">Leave a slide's image blank to keep its current image.</div>
                    </div>

                    {{-- ============ TESTIMONIALS ============ --}}
                    <div class="cat-tab-panel" data-panel="testimonials">
                        <div class="form-field">
                            <label for="testimonials_heading">Heading</label>
                            <input type="text" id="testimonials_heading" name="testimonials_heading" class="form-control-styled"
                                value="{{ old('testimonials_heading', $content->testimonials_heading) }}">
                        </div>
                        <div class="form-field">
                            <label for="testimonials_description">Description</label>
                            <textarea id="testimonials_description" name="testimonials_description" rows="3"
                                class="form-control-styled">{{ old('testimonials_description', $content->testimonials_description) }}</textarea>
                        </div>
                        <div class="hint">
                            The testimonial cards shown here come from the <a href="{{ route('admin.testimonials.index') }}">Testimonials</a> module — manage them there.
                        </div>
                    </div>

                    {{-- ============ DISCOUNT STRIP ============ --}}
                    <div class="cat-tab-panel" data-panel="discount-strip">
                        <div class="form-row-3">
                            <div class="form-field">
                                <label for="discount_strip_eyebrow">Eyebrow</label>
                                <input type="text" id="discount_strip_eyebrow" name="discount_strip_eyebrow" class="form-control-styled"
                                    value="{{ old('discount_strip_eyebrow', $content->discount_strip_eyebrow) }}">
                            </div>
                            <div class="form-field">
                                <label for="discount_strip_percent">Percent</label>
                                <input type="text" id="discount_strip_percent" name="discount_strip_percent" class="form-control-styled"
                                    value="{{ old('discount_strip_percent', $content->discount_strip_percent) }}" placeholder="e.g. 25%">
                            </div>
                            <div class="form-field">
                                <label for="discount_strip_label">Label</label>
                                <input type="text" id="discount_strip_label" name="discount_strip_label" class="form-control-styled"
                                    value="{{ old('discount_strip_label', $content->discount_strip_label) }}" placeholder="e.g. Extra Discount">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="discount_strip_cta_text">CTA Button Text</label>
                                <input type="text" id="discount_strip_cta_text" name="discount_strip_cta_text" class="form-control-styled"
                                    value="{{ old('discount_strip_cta_text', $content->discount_strip_cta_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="discount_strip_cta_url">CTA Button Link</label>
                                <input type="text" id="discount_strip_cta_url" name="discount_strip_cta_url" class="form-control-styled"
                                    value="{{ old('discount_strip_cta_url', $content->discount_strip_cta_url) }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="discount_strip_bg_image">Background Image</label>
                                @if($content->discount_strip_bg_image)
                                    <img src="{{ asset('storage/' . $content->discount_strip_bg_image) }}" class="current-img-preview" alt="">
                                @endif
                                <input type="file" id="discount_strip_bg_image" name="discount_strip_bg_image" class="form-control-styled" accept="image/*">
                            </div>
                            <div class="form-field">
                                <label for="discount_strip_side_image">Side Image</label>
                                @if($content->discount_strip_side_image)
                                    <img src="{{ asset('storage/' . $content->discount_strip_side_image) }}" class="current-img-preview" alt="">
                                @endif
                                <input type="file" id="discount_strip_side_image" name="discount_strip_side_image" class="form-control-styled" accept="image/*">
                            </div>
                        </div>
                    </div>

                    {{-- ============ WE'RE THERE (SUPPORT) ============ --}}
                    <div class="cat-tab-panel" data-panel="support">
                        <div class="form-row">
                            <div class="form-field">
                                <label for="support_heading">Heading</label>
                                <input type="text" id="support_heading" name="support_heading" class="form-control-styled"
                                    value="{{ old('support_heading', $content->support_heading) }}">
                            </div>
                            <div class="form-field">
                                <label for="support_heading_highlight">Heading (Highlighted Part)</label>
                                <input type="text" id="support_heading_highlight" name="support_heading_highlight" class="form-control-styled"
                                    value="{{ old('support_heading_highlight', $content->support_heading_highlight) }}">
                            </div>
                        </div>
                        <div class="form-field">
                            <label for="support_description">Description</label>
                            <textarea id="support_description" name="support_description" rows="3"
                                class="form-control-styled">{{ old('support_description', $content->support_description) }}</textarea>
                        </div>
                        <div class="form-field">
                            <label for="support_image">Image</label>
                            @if($content->support_image)
                                <img src="{{ asset('storage/' . $content->support_image) }}" class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="support_image" name="support_image" class="form-control-styled" accept="image/*">
                        </div>

                        <h4 class="sub-block-title">List Items</h4>
                        <div id="support-items-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-support-items-row">
                            <i class="fa fa-plus"></i> Add Item
                        </button>
                    </div>

                    {{-- ============ NEWSLETTER ============ --}}
                    <div class="cat-tab-panel" data-panel="newsletter">
                        <div class="form-row">
                            <div class="form-field">
                                <label for="newsletter_eyebrow">Eyebrow</label>
                                <input type="text" id="newsletter_eyebrow" name="newsletter_eyebrow" class="form-control-styled"
                                    value="{{ old('newsletter_eyebrow', $content->newsletter_eyebrow) }}">
                            </div>
                            <div class="form-field">
                                <label for="newsletter_cta_text">CTA Button Text</label>
                                <input type="text" id="newsletter_cta_text" name="newsletter_cta_text" class="form-control-styled"
                                    value="{{ old('newsletter_cta_text', $content->newsletter_cta_text) }}">
                            </div>
                        </div>
                        <div class="form-field">
                            <label for="newsletter_heading">Heading</label>
                            <textarea id="newsletter_heading" name="newsletter_heading" rows="2"
                                class="form-control-styled">{{ old('newsletter_heading', $content->newsletter_heading) }}</textarea>
                        </div>
                        <div class="form-field">
                            <label for="newsletter_phone_image">Phone Image</label>
                            @if($content->newsletter_phone_image)
                                <img src="{{ asset('storage/' . $content->newsletter_phone_image) }}" class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="newsletter_phone_image" name="newsletter_phone_image" class="form-control-styled" accept="image/*">
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
<script id="existing-group-offer-perks-data" type="application/json">{!! json_encode(old('group_offer_perks', $content->group_offer_perks ?? [])) !!}</script>
<script id="existing-who-we-are-stats-data" type="application/json">{!! json_encode($content->who_we_are_stats ?? []) !!}</script>
<script id="existing-home-slider-data" type="application/json">{!! json_encode($content->home_slider_images ?? []) !!}</script>
<script id="existing-support-items-data" type="application/json">{!! json_encode($content->support_items ?? []) !!}</script>
<script id="existing-tour-sections-data" type="application/json">{!! json_encode(old('tour_sections', $tourSections->map->only(['id', 'title', 'highlight', 'description', 'sub_category_id', 'limit', 'view_all_url', 'placement', 'style_class', 'is_active'])->values())) !!}</script>
<script id="tour-sub-categories-data" type="application/json">{!! json_encode($subCategories) !!}</script>
<script id="tour-placements-data" type="application/json">{!! json_encode($tourPlacements) !!}</script>
<script id="tour-styles-data" type="application/json">{!! json_encode($tourStyles) !!}</script>

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
        addSimpleRow('group-offer-perks-list', 'group_offer_perks[]', 'e.g. Free Transfers on All Packages', v)
    );

    /**
     * Generic repeater factory (icon/image + text fields).
     */
    function makeRepeater({ name, dataKey, containerId, addBtnId, fields, fileField = null }) {
        let index = 0;
        const container = document.getElementById(containerId);

        function fieldHtml(idx, field, value) {
            const inputName = `${name}_${field.key}[${idx}]`;
            if (field.type === 'textarea') {
                return `<div class="form-field"><label>${field.label}</label>
                    <textarea name="${inputName}" class="form-control-styled" rows="2" placeholder="${field.placeholder || ''}">${value || ''}</textarea></div>`;
            }
            return `<div class="form-field"><label>${field.label}</label>
                <input type="text" name="${inputName}" class="form-control-styled" placeholder="${field.placeholder || ''}" value="${value || ''}"></div>`;
        }

        function addRow(data = null) {
            const idx = index;
            const row = document.createElement('div');
            row.className = 'gallery-row';

            let fileHtml = '';
            if (fileField) {
                const existing = data ? data[fileField.key] : '';
                fileHtml = `
                    <div class="form-field">
                        <label>${fileField.label}</label>
                        ${existing ? `<img src="${APP_URL}/storage/${existing}" class="current-img-preview" alt="">` : ''}
                        <input type="file" name="${name}_${fileField.key}[${idx}]" class="form-control-styled" accept="image/*">
                        <input type="hidden" name="${name}_existing_${fileField.key}[${idx}]" value="${existing || ''}">
                        <div class="hint">Leave blank to keep the current image</div>
                    </div>`;
            }

            const fieldsHtml = fields.map(f => fieldHtml(idx, f, data ? data[f.key] : '')).join('');

            row.innerHTML = `
                ${fileHtml}
                <div class="form-row">${fieldsHtml}</div>
                <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove</button>
            `;
            container.appendChild(row);
            row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
            index++;
        }

        document.getElementById(addBtnId).addEventListener('click', () => addRow());

        const existingData = JSON.parse(document.getElementById(`existing-${dataKey}-data`).textContent);
        if (existingData.length) {
            existingData.forEach(d => addRow(d));
        } else {
            addRow();
        }
    }

    // ---- Who We Are stats ----
    makeRepeater({
        name: 'who_we_are_stats',
        dataKey: 'who-we-are-stats',
        containerId: 'who-we-are-stats-rows',
        addBtnId: 'add-who-we-are-stats-row',
        fileField: { key: 'icon', label: 'Icon' },
        fields: [
            { key: 'count', label: 'Count', placeholder: 'e.g. 5,000+' },
            { key: 'label', label: 'Label', placeholder: 'e.g. Top Destination' },
        ],
    });

    // ---- Home slider ----
    makeRepeater({
        name: 'home_slider',
        dataKey: 'home-slider',
        containerId: 'home-slider-rows',
        addBtnId: 'add-home-slider-row',
        fileField: { key: 'image', label: 'Slide Image' },
        fields: [
            { key: 'alt', label: 'Alt Text', placeholder: 'e.g. Travel destination banner' },
        ],
    });

    // ---- Support items ----
    makeRepeater({
        name: 'support_items',
        dataKey: 'support-items',
        containerId: 'support-items-rows',
        addBtnId: 'add-support-items-row',
        fileField: { key: 'icon', label: 'Icon' },
        fields: [
            { key: 'title', label: 'Title', placeholder: 'e.g. Human Support, Not Ticket Numbers' },
            { key: 'description', label: 'Description', type: 'textarea' },
        ],
    });

    // ---- Tour sections (nested tour_sections[i][field] inputs) ----
    (function () {
        const container = document.getElementById('tour-sections-rows');
        const subCategories = JSON.parse(document.getElementById('tour-sub-categories-data').textContent);
        const placements = JSON.parse(document.getElementById('tour-placements-data').textContent);
        const styles = JSON.parse(document.getElementById('tour-styles-data').textContent);
        let index = 0;

        const esc = s => String(s ?? '').replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

        function options(map, selected) {
            return Object.entries(map)
                .map(([val, label]) => `<option value="${esc(val)}" ${String(selected) === String(val) ? 'selected' : ''}>${esc(label)}</option>`)
                .join('');
        }

        function subCategoryOptions(selected) {
            return `<option value="">All packages</option>` + subCategories
                .map(s => `<option value="${s.id}" ${String(selected) === String(s.id) ? 'selected' : ''}>${esc(s.name)}</option>`)
                .join('');
        }

        function addRow(data = null) {
            const i = index++;
            const d = data || { title: 'Tours In', limit: 8, placement: 'after_banner', style_class: 'home-secA', is_active: true };
            const isActive = d.is_active === true || d.is_active === 1 || d.is_active === '1' || d.is_active === 'true';

            const row = document.createElement('div');
            row.className = 'gallery-row';
            row.innerHTML = `
                <input type="hidden" name="tour_sections[${i}][id]" value="${esc(d.id || '')}">

                <div class="tour-row-head">
                    <strong>Tour Section</strong>
                    <button type="button" class="btn-secondary-dash remove-tour-row"><i class="fa fa-trash"></i> Remove</button>
                </div>

                <div class="form-row-3">
                    <div class="form-field">
                        <label>Title</label>
                        <input type="text" name="tour_sections[${i}][title]" class="form-control-styled" placeholder="e.g. Tours In" value="${esc(d.title)}">
                    </div>
                    <div class="form-field">
                        <label>Highlighted Part</label>
                        <input type="text" name="tour_sections[${i}][highlight]" class="form-control-styled" placeholder="e.g. Maldives" value="${esc(d.highlight)}">
                    </div>
                    <div class="form-field">
                        <label>Package Sub-Category</label>
                        <select name="tour_sections[${i}][sub_category_id]" class="form-control-styled">${subCategoryOptions(d.sub_category_id)}</select>
                    </div>
                </div>

                <div class="form-field">
                    <label>Description</label>
                    <textarea name="tour_sections[${i}][description]" class="form-control-styled" rows="2"
                        placeholder="Choose from our handpicked travel experiences...">${esc(d.description)}</textarea>
                </div>

                <div class="form-row-3">
                    <div class="form-field">
                        <label>Placement</label>
                        <select name="tour_sections[${i}][placement]" class="form-control-styled">${options(placements, d.placement)}</select>
                    </div>
                    <div class="form-field">
                        <label>Style</label>
                        <select name="tour_sections[${i}][style_class]" class="form-control-styled">${options(styles, d.style_class)}</select>
                    </div>
                    <div class="form-field">
                        <label>Max Packages</label>
                        <input type="number" min="1" max="20" name="tour_sections[${i}][limit]" class="form-control-styled" value="${esc(d.limit || 8)}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label>"View All" Link</label>
                        <input type="text" name="tour_sections[${i}][view_all_url]" class="form-control-styled" placeholder="e.g. /tour-packages?sub_category=maldives" value="${esc(d.view_all_url)}">
                    </div>
                    <div class="form-field">
                        <label>Visibility</label>
                        <label class="check-inline">
                            <input type="hidden" name="tour_sections[${i}][is_active]" value="0">
                            <input type="checkbox" name="tour_sections[${i}][is_active]" value="1" ${isActive ? 'checked' : ''}>
                            Show on home page
                        </label>
                    </div>
                </div>
            `;
            container.appendChild(row);
            row.querySelector('.remove-tour-row').addEventListener('click', () => row.remove());
        }

        document.getElementById('add-tour-section-row').addEventListener('click', () => addRow());

        const existing = JSON.parse(document.getElementById('existing-tour-sections-data').textContent);
        (Array.isArray(existing) ? existing : Object.values(existing)).forEach(d => addRow(d));
    })();
</script>

@include('admin.footer')