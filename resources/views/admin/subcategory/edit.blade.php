{{-- resources/views/admin/subcategory/edit.blade.php --}}
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

        .current-icon-preview {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            border: 1px solid var(--border);
            margin-bottom: 8px;
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
        .gallery-row .remove-highlight-row,
        .gallery-row .remove-perk-row,
        .gallery-row .remove-faq-row {
            margin-top: 10px;
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Edit Sub Category</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.subcategories.index') }}">Sub Categories</a>
                        <span>›</span>
                        Edit
                    </div>
                </div>
                <a href="{{ route('admin.subcategories.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.subcategories.update', $subCategory) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="cat-tabs" id="subcat-tabs">
                        <button type="button" class="cat-tab active" data-tab="general">General</button>
                        <button type="button" class="cat-tab" data-tab="banner">Banner</button>
                        <button type="button" class="cat-tab" data-tab="highlights">Highlights</button>
                        <button type="button" class="cat-tab" data-tab="cta">CTA Section</button>
                        <button type="button" class="cat-tab" data-tab="promo">Promo Banner</button>
                        <button type="button" class="cat-tab" data-tab="faqsection">FAQ Section</button>
                        <button type="button" class="cat-tab" data-tab="seo">SEO / Open Graph</button>
                    </div>

                    {{-- ============ GENERAL ============ --}}
                    <div class="cat-tab-panel active" data-panel="general">

                        <div class="form-field">
                            <label for="category_id">Parent Category</label>
                            <select id="category_id" name="category_id"
                                class="form-control-styled @error('category_id') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $subCategory->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="name">Sub Category Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control-styled @error('name') is-invalid @enderror"
                                value="{{ old('name', $subCategory->name) }}" required>
                            @error('name')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" name="slug_preview" class="form-control-styled" readonly
                                value="{{ $subCategory->slug }}">
                        </div>

                        <div class="form-field">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control-styled">
                                <option value="draft" {{ old('status', $subCategory->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $subCategory->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="unpublished" {{ old('status', $subCategory->status) == 'unpublished' ? 'selected' : '' }}>Unpublished</option>
                            </select>
                        </div>

                    </div>

                    {{-- ============ BANNER ============ --}}
                    <div class="cat-tab-panel" data-panel="banner">

                        <div class="form-field">
                            <label for="offer_tag_text">Offer Tag Text</label>
                            <input type="text" id="offer_tag_text" name="offer_tag_text" class="form-control-styled"
                                value="{{ old('offer_tag_text', $subCategory->offer_tag_text) }}">
                        </div>

                        <div class="form-field">
                            <label for="h1">H1 / Banner Title</label>
                            <input type="text" id="h1" name="h1" class="form-control-styled"
                                value="{{ old('h1', $subCategory->h1) }}">
                        </div>

                        <div class="form-field">
                            <label for="intro_text">Intro Text</label>
                            <textarea id="intro_text" name="intro_text" rows="2"
                                class="form-control-styled">{{ old('intro_text', $subCategory->intro_text) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="banner_image_one">Banner Image 1</label>
                                @if($subCategory->banner_image_one)
                                    <img src="{{ asset('storage/' . $subCategory->banner_image_one) }}"
                                        class="current-img-preview">
                                @endif
                                <input type="file" id="banner_image_one" name="banner_image_one"
                                    class="form-control-styled" accept="image/*">
                                <div class="hint">Leave blank to keep the current image</div>
                            </div>
                            <div class="form-field">
                                <label for="banner_image_two">Banner Image 2</label>
                                @if($subCategory->banner_image_two)
                                    <img src="{{ asset('storage/' . $subCategory->banner_image_two) }}"
                                        class="current-img-preview">
                                @endif
                                <input type="file" id="banner_image_two" name="banner_image_two"
                                    class="form-control-styled" accept="image/*">
                                <div class="hint">Leave blank to keep the current image</div>
                            </div>
                        </div>

                        <div class="hint" style="margin: -10px 0 18px;">
                            Note: "Starting at" price row is static for now and not editable from here.
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="button1_text">Primary Button Text</label>
                                <input type="text" id="button1_text" name="button1_text" class="form-control-styled"
                                    value="{{ old('button1_text', $subCategory->button1_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="button1_url">Primary Button URL</label>
                                <input type="text" id="button1_url" name="button1_url" class="form-control-styled"
                                    value="{{ old('button1_url', $subCategory->button1_url) }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="button2_text">Secondary Button Text</label>
                                <input type="text" id="button2_text" name="button2_text" class="form-control-styled"
                                    value="{{ old('button2_text', $subCategory->button2_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="button2_url">Secondary Button URL</label>
                                <input type="text" id="button2_url" name="button2_url" class="form-control-styled"
                                    value="{{ old('button2_url', $subCategory->button2_url) }}">
                            </div>
                        </div>

                    </div>

                    {{-- ============ HIGHLIGHTS ============ --}}
                    <div class="cat-tab-panel" data-panel="highlights">

                        <div class="form-field">
                            <label for="heading_text">Heading (Main Text)</label>
                            <input type="text" id="heading_text" name="heading_text" class="form-control-styled"
                                value="{{ old('heading_text', $subCategory->heading_text) }}">
                        </div>

                        <div class="form-field">
                            <label for="heading_highlight">Heading (Highlighted Part)</label>
                            <input type="text" id="heading_highlight" name="heading_highlight"
                                class="form-control-styled"
                                value="{{ old('heading_highlight', $subCategory->heading_highlight) }}">
                        </div>

                        <div class="form-field">
                            <label for="heading_intro">Intro Paragraph</label>
                            <textarea id="heading_intro" name="heading_intro" rows="2"
                                class="form-control-styled">{{ old('heading_intro', $subCategory->heading_intro) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Highlight Cards</label>

                            <input type="hidden" name="deleted_highlights" id="deleted_highlights" value="">

                            <div id="existing-highlight-rows">
                                @foreach($subCategory->highlights as $highlight)
                                    <div class="gallery-row existing-highlight-row" data-id="{{ $highlight->id }}">
                                        <input type="hidden" name="highlight_ids[{{ $loop->index }}]"
                                            value="{{ $highlight->id }}">
                                        <div class="form-row-3">
                                            <div class="form-field">
                                                <label>Icon Image</label>
                                                @if($highlight->icon_image)
                                                    <img src="{{ asset('storage/' . $highlight->icon_image) }}"
                                                        class="current-icon-preview">
                                                @endif
                                                <input type="file" name="highlight_images[{{ $loop->index }}]"
                                                    class="form-control-styled" accept="image/*">
                                            </div>
                                            <div class="form-field">
                                                <label>Title</label>
                                                <input type="text" name="highlight_titles[{{ $loop->index }}]"
                                                    class="form-control-styled" value="{{ $highlight->title }}">
                                            </div>
                                            <div class="form-field">
                                                <label>Value</label>
                                                <input type="text" name="highlight_values[{{ $loop->index }}]"
                                                    class="form-control-styled" value="{{ $highlight->value }}">
                                            </div>
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-highlight-row"
                                            data-id="{{ $highlight->id }}">
                                            <i class="fa fa-trash"></i> Remove
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <div id="new-highlight-rows"></div>

                            <button type="button" class="btn-secondary-dash" id="add-highlight-row">
                                <i class="fa fa-plus"></i> Add Highlight
                            </button>
                        </div>

                    </div>

                    {{-- ============ CTA SECTION ============ --}}
                    <div class="cat-tab-panel" data-panel="cta">

                        <div class="form-field">
                            <label for="cta_badge_text">Badge Text</label>
                            <input type="text" id="cta_badge_text" name="cta_badge_text" class="form-control-styled"
                                value="{{ old('cta_badge_text', $subCategory->cta_badge_text) }}">
                        </div>

                        <div class="form-field">
                            <label for="cta_title">CTA Title</label>
                            <input type="text" id="cta_title" name="cta_title" class="form-control-styled"
                                value="{{ old('cta_title', $subCategory->cta_title) }}">
                        </div>

                        <div class="form-field">
                            <label for="cta_description">CTA Description</label>
                            <textarea id="cta_description" name="cta_description" rows="3"
                                class="form-control-styled">{{ old('cta_description', $subCategory->cta_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Perks</label>

                            <input type="hidden" name="deleted_perks" id="deleted_perks" value="">

                            <div id="existing-perk-rows">
                                @foreach($subCategory->ctaPerks as $perk)
                                    <div class="gallery-row existing-perk-row" data-id="{{ $perk->id }}">
                                        <input type="hidden" name="perk_ids[{{ $loop->index }}]" value="{{ $perk->id }}">
                                        <div class="form-field">
                                            <label>Perk Text</label>
                                            <input type="text" name="perk_texts[{{ $loop->index }}]"
                                                class="form-control-styled" value="{{ $perk->text }}">
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-perk-row"
                                            data-id="{{ $perk->id }}">
                                            <i class="fa fa-trash"></i> Remove
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <div id="new-perk-rows"></div>

                            <button type="button" class="btn-secondary-dash" id="add-perk-row">
                                <i class="fa fa-plus"></i> Add Perk
                            </button>
                        </div>

                        <div class="form-field">
                            <label for="cta_image">CTA Image</label>
                            @if($subCategory->cta_image)
                                <img src="{{ asset('storage/' . $subCategory->cta_image) }}" class="current-img-preview">
                            @endif
                            <input type="file" id="cta_image" name="cta_image" class="form-control-styled"
                                accept="image/*">
                            <div class="hint">Leave blank to keep the current image</div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="cta_button_text">Primary Button Text</label>
                                <input type="text" id="cta_button_text" name="cta_button_text"
                                    class="form-control-styled"
                                    value="{{ old('cta_button_text', $subCategory->cta_button_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="cta_button_url">Primary Button URL</label>
                                <input type="text" id="cta_button_url" name="cta_button_url" class="form-control-styled"
                                    value="{{ old('cta_button_url', $subCategory->cta_button_url) }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="cta_button2_text">Secondary Button Text</label>
                                <input type="text" id="cta_button2_text" name="cta_button2_text"
                                    class="form-control-styled"
                                    value="{{ old('cta_button2_text', $subCategory->cta_button2_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="cta_button2_url">Secondary Button URL</label>
                                <input type="text" id="cta_button2_url" name="cta_button2_url"
                                    class="form-control-styled"
                                    value="{{ old('cta_button2_url', $subCategory->cta_button2_url) }}">
                            </div>
                        </div>

                    </div>

                    {{-- ============ PROMO BANNER ============ --}}
                    <div class="cat-tab-panel" data-panel="promo">

                        <div class="form-field">
                            <label for="promo_badge_text">Badge Text</label>
                            <input type="text" id="promo_badge_text" name="promo_badge_text" class="form-control-styled"
                                value="{{ old('promo_badge_text', $subCategory->promo_badge_text) }}">
                        </div>

                        <div class="form-field">
                            <label for="promo_title">Title</label>
                            <input type="text" id="promo_title" name="promo_title" class="form-control-styled"
                                value="{{ old('promo_title', $subCategory->promo_title) }}">
                        </div>

                        <div class="form-field">
                            <label for="promo_description">Description</label>
                            <textarea id="promo_description" name="promo_description" rows="3"
                                class="form-control-styled">{{ old('promo_description', $subCategory->promo_description) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="promo_button_text">Button Text</label>
                                <input type="text" id="promo_button_text" name="promo_button_text"
                                    class="form-control-styled"
                                    value="{{ old('promo_button_text', $subCategory->promo_button_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="promo_button_url">Button URL</label>
                                <input type="text" id="promo_button_url" name="promo_button_url"
                                    class="form-control-styled"
                                    value="{{ old('promo_button_url', $subCategory->promo_button_url) }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="promo_end_at">Offer Ends At</label>
                            <input type="datetime-local" id="promo_end_at" name="promo_end_at"
                                class="form-control-styled"
                                value="{{ old('promo_end_at', $subCategory->promo_end_at?->format('Y-m-d\TH:i')) }}">
                            <div class="hint">Countdown timer on the page runs until this date/time</div>
                        </div>

                    </div>

                    {{-- ============ FAQ SECTION ============ --}}
                    <div class="cat-tab-panel" data-panel="faqsection">

                        <div class="form-row">
                            <div class="form-field">
                                <label for="faq_heading">Heading (Main Text)</label>
                                <input type="text" id="faq_heading" name="faq_heading" class="form-control-styled"
                                    value="{{ old('faq_heading', $subCategory->faq_heading) }}">
                            </div>
                            <div class="form-field">
                                <label for="faq_heading_highlight">Heading (Highlighted Part)</label>
                                <input type="text" id="faq_heading_highlight" name="faq_heading_highlight"
                                    class="form-control-styled"
                                    value="{{ old('faq_heading_highlight', $subCategory->faq_heading_highlight) }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="faq_intro">Intro Paragraph</label>
                            <textarea id="faq_intro" name="faq_intro" rows="2"
                                class="form-control-styled">{{ old('faq_intro', $subCategory->faq_intro) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>FAQs / Accordion Items</label>

                            <input type="hidden" name="deleted_faqs" id="deleted_faqs" value="">

                            <div id="existing-faq-rows">
                                @foreach($subCategory->faqs as $faq)
                                    <div class="gallery-row existing-faq-row" data-id="{{ $faq->id }}">
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
                                        <button type="button" class="btn-secondary-dash remove-faq-row"
                                            data-id="{{ $faq->id }}">
                                            <i class="fa fa-trash"></i> Remove
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <div id="new-faq-rows"></div>

                            <button type="button" class="btn-secondary-dash" id="add-faq-row">
                                <i class="fa fa-plus"></i> Add FAQ
                            </button>
                        </div>

                    </div>

                    {{-- ============ SEO ============ --}}
                    <div class="cat-tab-panel" data-panel="seo">

                        <div class="form-field">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" class="form-control-styled"
                                value="{{ old('meta_title', $subCategory->meta_title) }}">
                        </div>

                        <div class="form-field">
                            <label for="meta_description">Meta Description</label>
                            <textarea id="meta_description" name="meta_description" rows="4"
                                class="form-control-styled">{{ old('meta_description', $subCategory->meta_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="og_title">OG Title</label>
                            <input type="text" id="og_title" name="og_title" class="form-control-styled"
                                value="{{ old('og_title', $subCategory->og_title) }}">
                        </div>

                        <div class="form-field">
                            <label for="og_description">OG Description</label>
                            <textarea id="og_description" name="og_description" rows="3"
                                class="form-control-styled">{{ old('og_description', $subCategory->og_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="og_image">OG Image</label>
                            @if($subCategory->og_image)
                                <img src="{{ asset('storage/' . $subCategory->og_image) }}" class="current-img-preview">
                            @endif
                            <input type="file" id="og_image" name="og_image" class="form-control-styled"
                                accept="image/*">
                            <div class="hint">Leave blank to keep the current image</div>
                        </div>

                        <div class="form-field">
                            <label for="canonical_url">Canonical URL</label>
                            <input type="text" id="canonical_url" name="canonical_url" class="form-control-styled"
                                value="{{ old('canonical_url', $subCategory->canonical_url) }}">
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Update Sub Category
                        </button>
                        <a href="{{ route('admin.subcategories.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.querySelectorAll('#subcat-tabs .cat-tab').forEach(function (tabBtn) {
        tabBtn.addEventListener('click', function () {
            document.querySelectorAll('#subcat-tabs .cat-tab').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            document.querySelector('.cat-tab-panel[data-panel="' + this.dataset.tab + '"]').classList.add('active');
        });
    });

    // ---- Remove existing highlight ----
    const deletedHighlights = [];
    document.querySelectorAll('.remove-highlight-row').forEach(function (btn) {
        btn.addEventListener('click', function () {
            deletedHighlights.push(this.dataset.id);
            document.getElementById('deleted_highlights').value = deletedHighlights.join(',');
            this.closest('.existing-highlight-row').remove();
        });
    });

    // ---- Add new highlight rows ----
    let highlightIndex = {{ $subCategory->highlights->count() }};
    document.getElementById('add-highlight-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-row-3">
                <div class="form-field">
                    <label>Icon Image</label>
                    <input type="file" name="highlight_images[${highlightIndex}]" class="form-control-styled" accept="image/*">
                </div>
                <div class="form-field">
                    <label>Title</label>
                    <input type="text" name="highlight_titles[${highlightIndex}]" class="form-control-styled" placeholder="e.g. Best Time to Visit">
                </div>
                <div class="form-field">
                    <label>Value</label>
                    <input type="text" name="highlight_values[${highlightIndex}]" class="form-control-styled" placeholder="e.g. May – September">
                </div>
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-highlight-rows').appendChild(row);
        highlightIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Remove existing perk ----
    const deletedPerks = [];
    document.querySelectorAll('.remove-perk-row').forEach(function (btn) {
        btn.addEventListener('click', function () {
            deletedPerks.push(this.dataset.id);
            document.getElementById('deleted_perks').value = deletedPerks.join(',');
            this.closest('.existing-perk-row').remove();
        });
    });

    // ---- Add new perk rows ----
    let perkIndex = {{ $subCategory->ctaPerks->count() }};
    document.getElementById('add-perk-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Perk Text</label>
            <input type="text" name="perk_texts[${perkIndex}]" class="form-control-styled" placeholder="e.g. Free Transfers on All Packages">
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('new-perk-rows').appendChild(row);
        perkIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

    // ---- Remove existing FAQ ----
    const deletedFaqs = [];
    document.querySelectorAll('.remove-faq-row').forEach(function (btn) {
        btn.addEventListener('click', function () {
            deletedFaqs.push(this.dataset.id);
            document.getElementById('deleted_faqs').value = deletedFaqs.join(',');
            this.closest('.existing-faq-row').remove();
        });
    });

    // ---- Add new FAQ rows ----
    let faqIndex = {{ $subCategory->faqs->count() }};
    document.getElementById('add-faq-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Question</label>
            <input type="text" name="faq_questions[${faqIndex}]" class="form-control-styled" placeholder="e.g. Best Selling Itineraries">
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

    
</script>

@include('admin.footer')