{{-- resources/views/admin/category/edit.blade.php --}}
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

        .gallery-row .remove-new-row,
        .gallery-row .remove-fact-row {
            margin-top: 10px;
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Edit Category</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.categories.index') }}">Categories</a>
                        <span>›</span>
                        Edit
                    </div>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="cat-tabs" id="category-tabs">
                        <button type="button" class="cat-tab active" data-tab="general">General</button>
                        <button type="button" class="cat-tab" data-tab="listingsection">Listing Section</button>
                        <button type="button" class="cat-tab" data-tab="cta">CTA Section</button>
                        <button type="button" class="cat-tab" data-tab="promo">Promo Banner</button>
                        <button type="button" class="cat-tab" data-tab="plansection">Plan Section</button>
                        <button type="button" class="cat-tab" data-tab="seo">SEO / Open Graph</button>
                    </div>

                    {{-- ============ GENERAL ============ --}}
                    <div class="cat-tab-panel active" data-panel="general">

                        <div class="form-field">
                            <label for="name">Category Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control-styled @error('name') is-invalid @enderror"
                                value="{{ old('name', $category->name) }}" required>
                            @error('name')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" name="slug_preview" class="form-control-styled" readonly
                                value="{{ $category->slug }}">
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="menu_name">Menu Name</label>
                                <input type="text" id="menu_name" name="menu_name" class="form-control-styled"
                                    value="{{ old('menu_name', $category->menu_name) }}">
                            </div>
                            <div class="form-field">
                                <label for="sub_title">Sub Title</label>
                                <input type="text" id="sub_title" name="sub_title" class="form-control-styled"
                                    value="{{ old('sub_title', $category->sub_title) }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="heading">Heading (For Listing Page)</label>
                            <input type="text" id="heading" name="heading" class="form-control-styled"
                                value="{{ old('heading', $category->heading) }}">
                        </div>

                        <div class="form-field">
                            <label for="image">Image</label>
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" class="current-img-preview">
                            @endif
                            <input type="file" id="image" name="image" class="form-control-styled" accept="image/*">
                            <div class="hint">Leave blank to keep the current image</div>
                        </div>

                        <div class="form-field">
                            <label for="short_description">Short Description</label>
                            <textarea id="short_description" name="short_description" rows="2"
                                class="form-control-styled">{{ old('short_description', $category->short_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="detail_content">Detail Content</label>
                            <textarea id="detail_content" name="detail_content" rows="8"
                                class="ckeditor form-control-styled">{{ old('detail_content', $category->detail_content) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control-styled">
                                <option value="draft" {{ old('status', $category->status) == 'draft' ? 'selected' : '' }}>
                                    Draft</option>
                                <option value="published" {{ old('status', $category->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="unpublished" {{ old('status', $category->status) == 'unpublished' ? 'selected' : '' }}>Unpublished</option>
                            </select>
                        </div>

                    </div>

                    {{-- ============ LISTING SECTION ============ --}}
                    <div class="cat-tab-panel" data-panel="listingsection">

                        <div class="form-field">
                            <label for="listing_eyebrow">Eyebrow Text</label>
                            <input type="text" id="listing_eyebrow" name="listing_eyebrow" class="form-control-styled"
                                value="{{ old('listing_eyebrow', $category->listing_eyebrow) }}"
                                placeholder="e.g. Europe Honeymoon">
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="listing_heading">Heading (Main Text)</label>
                                <input type="text" id="listing_heading" name="listing_heading"
                                    class="form-control-styled"
                                    value="{{ old('listing_heading', $category->listing_heading) }}"
                                    placeholder="e.g. A Honeymoon Written Across">
                            </div>
                            <div class="form-field">
                                <label for="listing_heading_highlight">Heading (Highlighted Part)</label>
                                <input type="text" id="listing_heading_highlight" name="listing_heading_highlight"
                                    class="form-control-styled"
                                    value="{{ old('listing_heading_highlight', $category->listing_heading_highlight) }}"
                                    placeholder="e.g. Europe's Most Romantic Corners">
                            </div>
                        </div>
                        <div class="hint" style="margin-top:-10px; margin-bottom:18px;">Shown together as one heading —
                            the highlighted part is styled differently on the page</div>

                        <div class="form-field">
                            <label for="listing_intro">Intro Paragraph</label>
                            <textarea id="listing_intro" name="listing_intro" rows="3"
                                class="form-control-styled">{{ old('listing_intro', $category->listing_intro) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Fact Strip</label>

                            <input type="hidden" name="deleted_facts" id="deleted_facts" value="">

                            <div id="existing-fact-rows">
                                @foreach($category->facts as $fact)
                                    <div class="gallery-row existing-fact-row" data-id="{{ $fact->id }}">
                                        <input type="hidden" name="fact_ids[{{ $loop->index }}]" value="{{ $fact->id }}">
                                        <div class="form-row" style="grid-template-columns: 1fr 1fr;">
                                            <div class="form-field">
                                                <label>Number</label>
                                                <input type="text" name="fact_numbers[{{ $loop->index }}]"
                                                    class="form-control-styled" value="{{ $fact->number }}">
                                            </div>
                                            <div class="form-field">
                                                <label>Label</label>
                                                <input type="text" name="fact_labels[{{ $loop->index }}]"
                                                    class="form-control-styled" value="{{ $fact->label }}">
                                            </div>
                                        </div>
                                        <button type="button" class="btn-secondary-dash remove-fact-row"
                                            data-id="{{ $fact->id }}">
                                            <i class="fa fa-trash"></i> Remove
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <div id="new-fact-rows"></div>

                            <button type="button" class="btn-secondary-dash" id="add-fact-row">
                                <i class="fa fa-plus"></i> Add Fact
                            </button>
                            <div class="hint" style="margin-top:10px;">e.g. Number: "7-10", Label: "Days Ideal" — order
                                here sets display order</div>
                        </div>

                        <div class="form-row" style="margin-top:20px;">
                            <div class="form-field">
                                <label for="listing_button_text">Primary Button Text</label>
                                <input type="text" id="listing_button_text" name="listing_button_text"
                                    class="form-control-styled"
                                    value="{{ old('listing_button_text', $category->listing_button_text) }}"
                                    placeholder="Explore Packages">
                            </div>
                            <div class="form-field">
                                <label for="listing_button_url">Primary Button URL</label>
                                <input type="text" id="listing_button_url" name="listing_button_url"
                                    class="form-control-styled"
                                    value="{{ old('listing_button_url', $category->listing_button_url) }}"
                                    placeholder="/listing">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="listing_button2_text">Secondary Button Text</label>
                                <input type="text" id="listing_button2_text" name="listing_button2_text"
                                    class="form-control-styled"
                                    value="{{ old('listing_button2_text', $category->listing_button2_text) }}"
                                    placeholder="Talk To An Expert">
                            </div>
                            <div class="form-field">
                                <label for="listing_button2_url">Secondary Button URL</label>
                                <input type="text" id="listing_button2_url" name="listing_button2_url"
                                    class="form-control-styled"
                                    value="{{ old('listing_button2_url', $category->listing_button2_url) }}"
                                    placeholder="/contact">
                            </div>
                        </div>

                    </div>

                    {{-- ============ CTA SECTION ============ --}}
                    <div class="cat-tab-panel" data-panel="cta">

                        <div class="form-field">
                            <label for="cta_badge_text">Badge Text</label>
                            <input type="text" id="cta_badge_text" name="cta_badge_text" class="form-control-styled"
                                value="{{ old('cta_badge_text', $category->cta_badge_text) }}">
                        </div>

                        <div class="form-field">
                            <label for="cta_title">CTA Title</label>
                            <input type="text" id="cta_title" name="cta_title" class="form-control-styled"
                                value="{{ old('cta_title', $category->cta_title) }}">
                        </div>

                        <div class="form-field">
                            <label for="cta_description">CTA Description</label>
                            <textarea id="cta_description" name="cta_description" rows="3"
                                class="form-control-styled">{{ old('cta_description', $category->cta_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Perks</label>

                            <input type="hidden" name="deleted_perks" id="deleted_perks" value="">

                            <div id="existing-perk-rows">
                                @foreach($category->ctaPerks as $perk)
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
                            @if($category->cta_image)
                                <img src="{{ asset('storage/' . $category->cta_image) }}" class="current-img-preview">
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
                                    value="{{ old('cta_button_text', $category->cta_button_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="cta_button_url">Primary Button URL</label>
                                <input type="text" id="cta_button_url" name="cta_button_url" class="form-control-styled"
                                    value="{{ old('cta_button_url', $category->cta_button_url) }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="cta_button2_text">Secondary Button Text</label>
                                <input type="text" id="cta_button2_text" name="cta_button2_text"
                                    class="form-control-styled"
                                    value="{{ old('cta_button2_text', $category->cta_button2_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="cta_button2_url">Secondary Button URL</label>
                                <input type="text" id="cta_button2_url" name="cta_button2_url"
                                    class="form-control-styled"
                                    value="{{ old('cta_button2_url', $category->cta_button2_url) }}">
                            </div>
                        </div>

                    </div>

                    {{-- ============ PROMO BANNER ============ --}}
                    <div class="cat-tab-panel" data-panel="promo">

                        <div class="form-field">
                            <label for="promo_badge_text">Badge Text</label>
                            <input type="text" id="promo_badge_text" name="promo_badge_text" class="form-control-styled"
                                value="{{ old('promo_badge_text', $category->promo_badge_text) }}">
                        </div>

                        <div class="form-field">
                            <label for="promo_title">Title</label>
                            <input type="text" id="promo_title" name="promo_title" class="form-control-styled"
                                value="{{ old('promo_title', $category->promo_title) }}">
                        </div>

                        <div class="form-field">
                            <label for="promo_description">Description</label>
                            <textarea id="promo_description" name="promo_description" rows="3"
                                class="form-control-styled">{{ old('promo_description', $category->promo_description) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="promo_button_text">Button Text</label>
                                <input type="text" id="promo_button_text" name="promo_button_text"
                                    class="form-control-styled"
                                    value="{{ old('promo_button_text', $category->promo_button_text) }}">
                            </div>
                            <div class="form-field">
                                <label for="promo_button_url">Button URL</label>
                                <input type="text" id="promo_button_url" name="promo_button_url"
                                    class="form-control-styled"
                                    value="{{ old('promo_button_url', $category->promo_button_url) }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="promo_end_at">Offer Ends At</label>
                            <input type="datetime-local" id="promo_end_at" name="promo_end_at"
                                class="form-control-styled"
                                value="{{ old('promo_end_at', $category->promo_end_at?->format('Y-m-d\TH:i')) }}">
                            <div class="hint">Countdown timer on the page runs until this date/time</div>
                        </div>

                    </div>

                    {{-- ============ PLAN SECTION ============ --}}
                    <div class="cat-tab-panel" data-panel="plansection">

                        <div class="form-row">
                            <div class="form-field">
                                <label for="plan_heading">Heading (Main Text)</label>
                                <input type="text" id="plan_heading" name="plan_heading" class="form-control-styled"
                                    value="{{ old('plan_heading', $category->plan_heading) }}">
                            </div>
                            <div class="form-field">
                                <label for="plan_heading_highlight">Heading (Highlighted Part)</label>
                                <input type="text" id="plan_heading_highlight" name="plan_heading_highlight"
                                    class="form-control-styled"
                                    value="{{ old('plan_heading_highlight', $category->plan_heading_highlight) }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="plan_intro">Intro Paragraph</label>
                            <textarea id="plan_intro" name="plan_intro" rows="3"
                                class="form-control-styled">{{ old('plan_intro', $category->plan_intro) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>FAQs / Accordion Items</label>

                            <input type="hidden" name="deleted_faqs" id="deleted_faqs" value="">

                            <div id="existing-faq-rows">
                                @foreach($category->faqs as $faq)
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
                            <label for="h1">H1 Tag</label>
                            <input type="text" id="h1" name="h1" class="form-control-styled"
                                value="{{ old('h1', $category->h1) }}">
                        </div>

                        <div class="form-field">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" class="form-control-styled"
                                value="{{ old('meta_title', $category->meta_title) }}">
                        </div>

                        <div class="form-field">
                            <label for="meta_description">Meta Description</label>
                            <textarea id="meta_description" name="meta_description" rows="4"
                                class="form-control-styled">{{ old('meta_description', $category->meta_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="robots">Robots</label>
                            <select id="robots" name="robots" class="form-control-styled">
                                @php $currentRobots = old('robots', $category->robots ?? 'index, follow'); @endphp
                                <option value="index, follow" {{ $currentRobots == 'index, follow' ? 'selected' : '' }}>index, follow (default)</option>
                                <option value="noindex, follow" {{ $currentRobots == 'noindex, follow' ? 'selected' : '' }}>noindex, follow</option>
                                <option value="index, nofollow" {{ $currentRobots == 'index, nofollow' ? 'selected' : '' }}>index, nofollow</option>
                                <option value="noindex, nofollow" {{ $currentRobots == 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow</option>
                            </select>
                            <div class="hint">Controls whether search engines index this page and follow its links</div>
                        </div>

                        <div class="form-field">
                            <label for="og_title">OG Title</label>
                            <input type="text" id="og_title" name="og_title" class="form-control-styled"
                                value="{{ old('og_title', $category->og_title) }}">
                        </div>

                        <div class="form-field">
                            <label for="og_description">OG Description</label>
                            <textarea id="og_description" name="og_description" rows="3"
                                class="form-control-styled">{{ old('og_description', $category->og_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="og_image">OG Image</label>
                            @if($category->og_image)
                                <img src="{{ asset('storage/' . $category->og_image) }}" class="current-img-preview">
                            @endif
                            <input type="file" id="og_image" name="og_image" class="form-control-styled"
                                accept="image/*">
                            <div class="hint">Leave blank to keep the current image</div>
                        </div>

                        <div class="form-field">
                            <label for="twitter_title">Twitter Title</label>
                            <input type="text" id="twitter_title" name="twitter_title" class="form-control-styled"
                                value="{{ old('twitter_title', $category->twitter_title) }}">
                        </div>

                        <div class="form-field">
                            <label for="twitter_description">Twitter Description</label>
                            <textarea id="twitter_description" name="twitter_description" rows="3"
                                class="form-control-styled">{{ old('twitter_description', $category->twitter_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="twitter_card_image">Twitter Card Image</label>
                            @if($category->twitter_card_image)
                                <img src="{{ asset('storage/' . $category->twitter_card_image) }}"
                                    class="current-img-preview">
                            @endif
                            <input type="file" id="twitter_card_image" name="twitter_card_image"
                                class="form-control-styled" accept="image/*">
                            <div class="hint">Leave blank to keep the current image</div>
                        </div>

                        <div class="form-field">
                            <label for="canonical_url">Canonical URL</label>
                            <input type="text" id="canonical_url" name="canonical_url" class="form-control-styled"
                                value="{{ old('canonical_url', $category->canonical_url) }}">
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Update Category
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    if (window.CKEDITOR) {
        CKEDITOR.replace('detail_content');
    }

    document.querySelectorAll('#category-tabs .cat-tab').forEach(function (tabBtn) {
        tabBtn.addEventListener('click', function () {
            document.querySelectorAll('#category-tabs .cat-tab').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            document.querySelector('.cat-tab-panel[data-panel="' + this.dataset.tab + '"]').classList.add('active');

            if (this.dataset.tab === 'general' && window.CKEDITOR && CKEDITOR.instances.detail_content) {
                CKEDITOR.instances.detail_content.resize('100%', 300);
            }
        });
    });

    // ---- Remove existing fact ----
    const deletedFacts = [];
    document.querySelectorAll('.remove-fact-row').forEach(function (btn) {
        btn.addEventListener('click', function () {
            deletedFacts.push(this.dataset.id);
            document.getElementById('deleted_facts').value = deletedFacts.join(',');
            this.closest('.existing-fact-row').remove();
        });
    });

    // ---- Add new fact rows (index continues after existing facts) ----
    let factIndex = {{ $category->facts->count() }};
    document.getElementById('add-fact-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-row" style="grid-template-columns: 1fr 1fr;">
                <div class="form-field">
                    <label>Number</label>
                    <input type="text" name="fact_numbers[${factIndex}]" class="form-control-styled" placeholder="e.g. 7-10">
                </div>
                <div class="form-field">
                    <label>Label</label>
                    <input type="text" name="fact_labels[${factIndex}]" class="form-control-styled" placeholder="e.g. Days Ideal">
                </div>
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-fact-rows').appendChild(row);
        factIndex++;
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
    let perkIndex = {{ $category->ctaPerks->count() }};
    document.getElementById('add-perk-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Perk Text</label>
            <input type="text" name="perk_texts[${perkIndex}]" class="form-control-styled" placeholder="e.g. Flexible Dates & Custom Itineraries">
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
    let faqIndex = {{ $category->faqs->count() }};
    document.getElementById('add-faq-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Question</label>
            <input type="text" name="faq_questions[${faqIndex}]" class="form-control-styled" placeholder="e.g. Best Europe Honeymoon Destinations">
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