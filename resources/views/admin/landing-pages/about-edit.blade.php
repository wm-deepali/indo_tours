{{-- resources/views/admin/landing-pages/about/edit.blade.php --}}
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
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>About Us Page</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Content Manage
                        <span>›</span>
                        Manage Landing Pages
                        <span>›</span>
                        About Page
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-info" style="margin-bottom:16px;">{{ session('success') }}</div>
            @endif

            <div class="cat-card">
                <form action="{{ route('admin.landing-pages.about.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="cat-tabs" id="lp-tabs">
                        <button type="button" class="cat-tab active" data-tab="banner">Banner</button>
                        <button type="button" class="cat-tab" data-tab="who-we-are">Who We Are</button>
                        <button type="button" class="cat-tab" data-tab="why-choose">Why Choose Us</button>
                        <button type="button" class="cat-tab" data-tab="mission">Our Mission</button>
                        <button type="button" class="cat-tab" data-tab="how-it-works">How It Works</button>
                        <button type="button" class="cat-tab" data-tab="philosophy">Our Philosophy</button>
                        <button type="button" class="cat-tab" data-tab="team">Meet The Team</button>
                        <button type="button" class="cat-tab" data-tab="testimonials">Testimonials</button>
                        <button type="button" class="cat-tab" data-tab="gallery">Gallery</button>
                        <button type="button" class="cat-tab" data-tab="faqs">FAQs</button>
                    </div>

                    {{-- ============ BANNER ============ --}}
                    <div class="cat-tab-panel active" data-panel="banner">
                        <div class="form-field">
                            <label for="banner_heading">Heading (H1)</label>
                            <input type="text" id="banner_heading" name="banner_heading"
                                class="form-control-styled @error('banner_heading') is-invalid @enderror"
                                value="{{ old('banner_heading', $content->banner_heading) }}">
                            @error('banner_heading')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="banner_description">Description</label>
                            <textarea id="banner_description" name="banner_description" rows="3"
                                class="form-control-styled">{{ old('banner_description', $content->banner_description) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="banner_cta_text">CTA Button Text</label>
                                <input type="text" id="banner_cta_text" name="banner_cta_text" class="form-control-styled"
                                    value="{{ old('banner_cta_text', $content->banner_cta_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="banner_cta_url">CTA Button Link</label>
                                <input type="text" id="banner_cta_url" name="banner_cta_url" class="form-control-styled"
                                    value="{{ old('banner_cta_url', $content->banner_cta_url) }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="banner_video">Background Video</label>
                                @if($content->banner_video)
                                    <div class="hint">Current: {{ basename($content->banner_video) }}</div>
                                @endif
                                <input type="file" id="banner_video" name="banner_video" class="form-control-styled" accept="video/*">
                                <div class="hint">Leave blank to keep the current video</div>
                            </div>
                            <div class="form-field">
                                <label for="banner_video_poster">Video Poster Image</label>
                                @if($content->banner_video_poster)
                                    <img src="{{ asset('storage/' . $content->banner_video_poster) }}" class="current-img-preview" alt="">
                                @endif
                                <input type="file" id="banner_video_poster" name="banner_video_poster" class="form-control-styled" accept="image/*">
                                <div class="hint">Leave blank to keep the current image</div>
                            </div>
                        </div>
                    </div>

                    {{-- ============ WHO WE ARE ============ --}}
                    <div class="cat-tab-panel" data-panel="who-we-are">
                        <div class="form-field">
                            <label for="who_we_are_heading">Heading</label>
                            <input type="text" id="who_we_are_heading" name="who_we_are_heading"
                                class="form-control-styled @error('who_we_are_heading') is-invalid @enderror"
                                value="{{ old('who_we_are_heading', $content->who_we_are_heading) }}">
                            @error('who_we_are_heading')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="who_we_are_description">Description</label>
                            <textarea id="who_we_are_description" name="who_we_are_description" rows="3"
                                class="form-control-styled">{{ old('who_we_are_description', $content->who_we_are_description) }}</textarea>
                        </div>

                        <h4 class="sub-block-title">Stat Cards</h4>
                        <div id="stats-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-stats-row">
                            <i class="fa fa-plus"></i> Add Stat
                        </button>

                        <h4 class="sub-block-title">Content Card</h4>
                        <div class="form-field">
                            <label for="content_card_title">Title</label>
                            <input type="text" id="content_card_title" name="content_card_title" class="form-control-styled"
                                value="{{ old('content_card_title', $content->content_card_title) }}">
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="content_card_description_1">Description Paragraph 1</label>
                                <textarea id="content_card_description_1" name="content_card_description_1" rows="3"
                                    class="form-control-styled">{{ old('content_card_description_1', $content->content_card_description_1) }}</textarea>
                            </div>
                            <div class="form-field">
                                <label for="content_card_description_2">Description Paragraph 2</label>
                                <textarea id="content_card_description_2" name="content_card_description_2" rows="3"
                                    class="form-control-styled">{{ old('content_card_description_2', $content->content_card_description_2) }}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="content_card_cta_text">CTA Button Text</label>
                                <input type="text" id="content_card_cta_text" name="content_card_cta_text" class="form-control-styled"
                                    value="{{ old('content_card_cta_text', $content->content_card_cta_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="content_card_cta_url">CTA Button Link</label>
                                <input type="text" id="content_card_cta_url" name="content_card_cta_url" class="form-control-styled"
                                    value="{{ old('content_card_cta_url', $content->content_card_cta_url) }}">
                            </div>
                        </div>
                        <div class="form-field">
                            <label for="content_card_image">Image</label>
                            @if($content->content_card_image)
                                <img src="{{ asset('storage/' . $content->content_card_image) }}" class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="content_card_image" name="content_card_image" class="form-control-styled" accept="image/*">
                            <div class="hint">Leave blank to keep the current image</div>
                        </div>
                    </div>

                    {{-- ============ WHY CHOOSE US ============ --}}
                    <div class="cat-tab-panel" data-panel="why-choose">
                        <div class="form-field">
                            <label for="why_choose_heading">Heading</label>
                            <input type="text" id="why_choose_heading" name="why_choose_heading"
                                class="form-control-styled @error('why_choose_heading') is-invalid @enderror"
                                value="{{ old('why_choose_heading', $content->why_choose_heading) }}">
                            @error('why_choose_heading')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-field">
                            <label for="why_choose_description">Description</label>
                            <textarea id="why_choose_description" name="why_choose_description" rows="3"
                                class="form-control-styled">{{ old('why_choose_description', $content->why_choose_description) }}</textarea>
                        </div>

                        <h4 class="sub-block-title">Items</h4>
                        <div id="why-choose-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-why-choose-row">
                            <i class="fa fa-plus"></i> Add Item
                        </button>
                    </div>

                    {{-- ============ OUR MISSION ============ --}}
                    <div class="cat-tab-panel" data-panel="mission">
                        <div class="form-field">
                            <label for="mission_heading">Heading</label>
                            <input type="text" id="mission_heading" name="mission_heading"
                                class="form-control-styled @error('mission_heading') is-invalid @enderror"
                                value="{{ old('mission_heading', $content->mission_heading) }}">
                            @error('mission_heading')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-field">
                            <label for="mission_description">Description</label>
                            <textarea id="mission_description" name="mission_description" rows="4"
                                class="form-control-styled">{{ old('mission_description', $content->mission_description) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="mission_image_one">Image One</label>
                                @if($content->mission_image_one)
                                    <img src="{{ asset('storage/' . $content->mission_image_one) }}" class="current-img-preview" alt="">
                                @endif
                                <input type="file" id="mission_image_one" name="mission_image_one" class="form-control-styled" accept="image/*">
                            </div>
                            <div class="form-field">
                                <label for="mission_image_two">Image Two</label>
                                @if($content->mission_image_two)
                                    <img src="{{ asset('storage/' . $content->mission_image_two) }}" class="current-img-preview" alt="">
                                @endif
                                <input type="file" id="mission_image_two" name="mission_image_two" class="form-control-styled" accept="image/*">
                            </div>
                        </div>

                        <h4 class="sub-block-title">Mission Features</h4>
                        <div id="mission-features-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-mission-features-row">
                            <i class="fa fa-plus"></i> Add Feature
                        </button>

                        <h4 class="sub-block-title">CTA</h4>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="mission_cta_text">CTA Button Text</label>
                                <input type="text" id="mission_cta_text" name="mission_cta_text" class="form-control-styled"
                                    value="{{ old('mission_cta_text', $content->mission_cta_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="mission_cta_url">CTA Button Link</label>
                                <input type="text" id="mission_cta_url" name="mission_cta_url" class="form-control-styled"
                                    value="{{ old('mission_cta_url', $content->mission_cta_url) }}">
                            </div>
                        </div>
                    </div>

                    {{-- ============ HOW IT WORKS ============ --}}
                    <div class="cat-tab-panel" data-panel="how-it-works">
                        <div class="form-field">
                            <label for="how_it_works_heading">Heading</label>
                            <input type="text" id="how_it_works_heading" name="how_it_works_heading"
                                class="form-control-styled @error('how_it_works_heading') is-invalid @enderror"
                                value="{{ old('how_it_works_heading', $content->how_it_works_heading) }}">
                            @error('how_it_works_heading')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-field">
                            <label for="how_it_works_description">Description</label>
                            <textarea id="how_it_works_description" name="how_it_works_description" rows="3"
                                class="form-control-styled">{{ old('how_it_works_description', $content->how_it_works_description) }}</textarea>
                        </div>

                        <h4 class="sub-block-title">Steps</h4>
                        <div id="how-it-works-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-how-it-works-row">
                            <i class="fa fa-plus"></i> Add Step
                        </button>
                        <div class="hint" style="margin-top:10px;">Step number (01, 02...) is generated automatically from the order of rows here.</div>
                    </div>

                    {{-- ============ OUR PHILOSOPHY ============ --}}
                    <div class="cat-tab-panel" data-panel="philosophy">
                        <div class="form-row">
                            <div class="form-field">
                                <label for="philosophy_eyebrow">Eyebrow</label>
                                <input type="text" id="philosophy_eyebrow" name="philosophy_eyebrow" class="form-control-styled"
                                    value="{{ old('philosophy_eyebrow', $content->philosophy_eyebrow) }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="philosophy_heading">Heading</label>
                                <input type="text" id="philosophy_heading" name="philosophy_heading"
                                    class="form-control-styled @error('philosophy_heading') is-invalid @enderror"
                                    value="{{ old('philosophy_heading', $content->philosophy_heading) }}">
                                @error('philosophy_heading')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-field">
                                <label for="philosophy_heading_highlight">Heading (Highlighted Part)</label>
                                <input type="text" id="philosophy_heading_highlight" name="philosophy_heading_highlight" class="form-control-styled"
                                    value="{{ old('philosophy_heading_highlight', $content->philosophy_heading_highlight) }}">
                            </div>
                        </div>
                        <div class="form-field">
                            <label for="philosophy_description">Description</label>
                            <textarea id="philosophy_description" name="philosophy_description" rows="3"
                                class="form-control-styled">{{ old('philosophy_description', $content->philosophy_description) }}</textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label for="philosophy_cta_text">CTA Button Text</label>
                                <input type="text" id="philosophy_cta_text" name="philosophy_cta_text" class="form-control-styled"
                                    value="{{ old('philosophy_cta_text', $content->philosophy_cta_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="philosophy_cta_url">CTA Button Link</label>
                                <input type="text" id="philosophy_cta_url" name="philosophy_cta_url" class="form-control-styled"
                                    value="{{ old('philosophy_cta_url', $content->philosophy_cta_url) }}">
                            </div>
                        </div>
                        <div class="form-field">
                            <label for="philosophy_image">Background Image</label>
                            @if($content->philosophy_image)
                                <img src="{{ asset('storage/' . $content->philosophy_image) }}" class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="philosophy_image" name="philosophy_image" class="form-control-styled" accept="image/*">
                        </div>
                    </div>

                    {{-- ============ MEET THE TEAM ============ --}}
                    <div class="cat-tab-panel" data-panel="team">
                        <div class="form-field">
                            <label for="team_heading">Heading</label>
                            <input type="text" id="team_heading" name="team_heading"
                                class="form-control-styled @error('team_heading') is-invalid @enderror"
                                value="{{ old('team_heading', $content->team_heading) }}">
                            @error('team_heading')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-field">
                            <label for="team_description">Description</label>
                            <textarea id="team_description" name="team_description" rows="3"
                                class="form-control-styled">{{ old('team_description', $content->team_description) }}</textarea>
                        </div>

                        <h4 class="sub-block-title">Team Members</h4>
                        <div id="team-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-team-row">
                            <i class="fa fa-plus"></i> Add Member
                        </button>
                    </div>

                    {{-- ============ TESTIMONIALS ============ --}}
                    <div class="cat-tab-panel" data-panel="testimonials">
                        <div class="form-field">
                            <label for="testimonials_heading">Heading</label>
                            <input type="text" id="testimonials_heading" name="testimonials_heading"
                                class="form-control-styled @error('testimonials_heading') is-invalid @enderror"
                                value="{{ old('testimonials_heading', $content->testimonials_heading) }}">
                            @error('testimonials_heading')<div class="form-error">{{ $message }}</div>@enderror
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

                    {{-- ============ GALLERY ============ --}}
                    <div class="cat-tab-panel" data-panel="gallery">
                        <div class="form-field">
                            <label for="gallery_heading">Heading</label>
                            <input type="text" id="gallery_heading" name="gallery_heading"
                                class="form-control-styled @error('gallery_heading') is-invalid @enderror"
                                value="{{ old('gallery_heading', $content->gallery_heading) }}">
                            @error('gallery_heading')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-field">
                            <label for="gallery_description">Description</label>
                            <textarea id="gallery_description" name="gallery_description" rows="3"
                                class="form-control-styled">{{ old('gallery_description', $content->gallery_description) }}</textarea>
                        </div>

                        <h4 class="sub-block-title">Gallery Items</h4>
                        <div id="gallery-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-gallery-row">
                            <i class="fa fa-plus"></i> Add Image
                        </button>
                    </div>

                    {{-- ============ FAQS ============ --}}
                    <div class="cat-tab-panel" data-panel="faqs">
                        <div class="form-field">
                            <label for="faq_heading">Heading</label>
                            <input type="text" id="faq_heading" name="faq_heading"
                                class="form-control-styled @error('faq_heading') is-invalid @enderror"
                                value="{{ old('faq_heading', $content->faq_heading) }}">
                            @error('faq_heading')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <h4 class="sub-block-title">Questions</h4>
                        <div id="faq-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-faq-row">
                            <i class="fa fa-plus"></i> Add Question
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
<script id="existing-stats-data" type="application/json">{!! json_encode($content->stats ?? []) !!}</script>
<script id="existing-why-choose-data" type="application/json">{!! json_encode($content->why_choose_items ?? []) !!}</script>
<script id="existing-mission-features-data" type="application/json">{!! json_encode($content->mission_features ?? []) !!}</script>
<script id="existing-how-it-works-data" type="application/json">{!! json_encode($content->how_it_works_steps ?? []) !!}</script>
<script id="existing-team-data" type="application/json">{!! json_encode($content->team_members ?? []) !!}</script>
<script id="existing-gallery-data" type="application/json">{!! json_encode($content->gallery_items ?? []) !!}</script>
<script id="existing-faqs-data" type="application/json">{!! json_encode($content->faqs ?? []) !!}</script>

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

    /**
     * Generic repeater factory.
     * name: e.g. "stats" -> produces inputs named stats_title[], stats_existing_icon[] etc.
     * fields: [{key, label, type: 'text'|'textarea'|'select', placeholder, options?}]
     * fileField: optional {key, label} for an image/icon upload
     */
    function makeRepeater({ name, containerId, addBtnId, fields, fileField = null, folderHint = '' }) {
        let index = 0;
        const container = document.getElementById(containerId);

        function fieldHtml(idx, field, value) {
            const inputName = `${name}_${field.key}[${idx}]`;
            if (field.type === 'textarea') {
                return `<div class="form-field"><label>${field.label}</label>
                    <textarea name="${inputName}" class="form-control-styled" rows="2" placeholder="${field.placeholder || ''}">${value || ''}</textarea></div>`;
            }
            if (field.type === 'select') {
                const opts = field.options.map(o => `<option value="${o}" ${value === o ? 'selected' : ''}>${o}</option>`).join('');
                return `<div class="form-field"><label>${field.label}</label>
                    <select name="${inputName}" class="form-control-styled">${opts}</select></div>`;
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
                        <div class="hint">Leave blank to keep the current ${folderHint || 'image'}</div>
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

        const existingData = JSON.parse(document.getElementById(`existing-${name.replace(/_/g, '-')}-data`).textContent);
        if (existingData.length) {
            existingData.forEach(d => addRow(d));
        } else {
            addRow();
        }
    }

    // ---- Stats (Who We Are) ----
    makeRepeater({
        name: 'stats',
        containerId: 'stats-rows',
        addBtnId: 'add-stats-row',
        fileField: { key: 'icon', label: 'Icon' },
        folderHint: 'icon',
        fields: [
            { key: 'count', label: 'Count (number)', placeholder: 'e.g. 45' },
            { key: 'suffix', label: 'Suffix', placeholder: 'e.g. K+' },
            { key: 'label', label: 'Label', placeholder: 'e.g. Happy campers' },
        ],
    });

    // ---- Why Choose Us items ----
    makeRepeater({
        name: 'why_choose_items',
        containerId: 'why-choose-rows',
        addBtnId: 'add-why-choose-row',
        fileField: { key: 'icon', label: 'Icon' },
        folderHint: 'icon',
        fields: [
            { key: 'title', label: 'Title', placeholder: 'e.g. Expertly Planned' },
            { key: 'description', label: 'Description', type: 'textarea', placeholder: 'e.g. Every itinerary is designed with attention to detail.' },
        ],
    });

    // ---- Mission features ----
    makeRepeater({
        name: 'mission_features',
        containerId: 'mission-features-rows',
        addBtnId: 'add-mission-features-row',
        fileField: { key: 'icon', label: 'Icon' },
        folderHint: 'icon',
        fields: [
            { key: 'title', label: 'Title', placeholder: 'e.g. Meaningful Experiences' },
            { key: 'description', label: 'Description', type: 'textarea' },
        ],
    });

    // ---- How It Works steps ----
    makeRepeater({
        name: 'how_it_works_steps',
        containerId: 'how-it-works-rows',
        addBtnId: 'add-how-it-works-row',
        fields: [
            { key: 'color', label: 'Color', type: 'select', options: ['yellow', 'gray', 'lavender', 'green', 'peach'] },
            { key: 'title', label: 'Title', placeholder: 'e.g. Tell Us Your Plan' },
            { key: 'description', label: 'Description', type: 'textarea' },
        ],
    });

    // ---- Team members ----
    makeRepeater({
        name: 'team_members',
        containerId: 'team-rows',
        addBtnId: 'add-team-row',
        fileField: { key: 'image', label: 'Photo' },
        folderHint: 'photo',
        fields: [
            { key: 'name', label: 'Name', placeholder: 'e.g. John Doe' },
            { key: 'role', label: 'Role', placeholder: 'e.g. Travel Specialist' },
            { key: 'instagram_url', label: 'Instagram URL' },
            { key: 'linkedin_url', label: 'LinkedIn URL' },
        ],
    });

    // ---- Gallery items ----
    makeRepeater({
        name: 'gallery_items',
        containerId: 'gallery-rows',
        addBtnId: 'add-gallery-row',
        fileField: { key: 'image', label: 'Image' },
        folderHint: 'image',
        fields: [
            { key: 'title', label: 'Title', placeholder: 'e.g. Mountain Sunset' },
            { key: 'location', label: 'Location', placeholder: 'e.g. Switzerland' },
        ],
    });

    // ---- FAQs ----
    makeRepeater({
        name: 'faqs',
        containerId: 'faq-rows',
        addBtnId: 'add-faq-row',
        fields: [
            { key: 'question', label: 'Question' },
            { key: 'answer', label: 'Answer', type: 'textarea' },
        ],
    });
</script>

@include('admin.footer')