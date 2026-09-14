{{-- resources/views/admin/subcategory/create.blade.php --}}
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

        .gallery-row {
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 16px;
            margin-bottom: 14px;
            background: var(--bg);
        }

        .gallery-row .remove-new-row {
            margin-top: 10px;
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Add Sub Category</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.subcategories.index') }}">Sub Categories</a>
                        <span>›</span>
                        Add
                    </div>
                </div>
                <a href="{{ route('admin.subcategories.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="name">Sub Category Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control-styled @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="e.g. Ladakh" required>
                            @error('name')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" name="slug_preview" class="form-control-styled" readonly
                                placeholder="Auto-generated from name">
                            <div class="hint">Generated automatically on save — used for the URL and canonical tag</div>
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

                    {{-- ============ BANNER ============ --}}
                    <div class="cat-tab-panel" data-panel="banner">

                        <div class="form-field">
                            <label for="offer_tag_text">Offer Tag Text</label>
                            <input type="text" id="offer_tag_text" name="offer_tag_text" class="form-control-styled"
                                value="{{ old('offer_tag_text') }}" placeholder="* This Offer Valid Till 22 August">
                        </div>

                        <div class="form-field">
                            <label for="h1">H1 / Banner Title</label>
                            <input type="text" id="h1" name="h1" class="form-control-styled" value="{{ old('h1') }}"
                                placeholder="Explore Ladakh">
                        </div>

                        <div class="form-field">
                            <label for="intro_text">Intro Text</label>
                            <textarea id="intro_text" name="intro_text" rows="2" class="form-control-styled"
                                placeholder="Discover breathtaking landscapes, mountain adventures and unforgettable experiences.">{{ old('intro_text') }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="banner_image_one">Banner Image 1</label>
                                <input type="file" id="banner_image_one" name="banner_image_one"
                                    class="form-control-styled" accept="image/*">
                                <div class="hint">Slider image 1 — max 2MB</div>
                            </div>
                            <div class="form-field">
                                <label for="banner_image_two">Banner Image 2</label>
                                <input type="file" id="banner_image_two" name="banner_image_two"
                                    class="form-control-styled" accept="image/*">
                                <div class="hint">Slider image 2 — max 2MB</div>
                            </div>
                        </div>

                        <div class="hint" style="margin: -10px 0 18px;">
                            Note: "Starting at" price row (₹24,583 / ₹14,750) is static for now and not editable from
                            here.
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="button1_text">Primary Button Text</label>
                                <input type="text" id="button1_text" name="button1_text" class="form-control-styled"
                                    value="{{ old('button1_text') }}" placeholder="Connect With An Expert">
                            </div>
                            <div class="form-field">
                                <label for="button1_url">Primary Button URL</label>
                                <input type="text" id="button1_url" name="button1_url" class="form-control-styled"
                                    value="{{ old('button1_url') }}" placeholder="javascript:void(0)">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="button2_text">Secondary Button Text</label>
                                <input type="text" id="button2_text" name="button2_text" class="form-control-styled"
                                    value="{{ old('button2_text') }}">
                            </div>
                            <div class="form-field">
                                <label for="button2_url">Secondary Button URL</label>
                                <input type="text" id="button2_url" name="button2_url" class="form-control-styled"
                                    value="{{ old('button2_url') }}">
                            </div>
                        </div>

                    </div>

                    {{-- ============ HIGHLIGHTS ============ --}}
                    <div class="cat-tab-panel" data-panel="highlights">

                        <div class="form-field">
                            <label for="heading_text">Heading (Main Text)</label>
                            <input type="text" id="heading_text" name="heading_text" class="form-control-styled"
                                value="{{ old('heading_text') }}" placeholder="e.g. Plan Your">
                        </div>

                        <div class="form-field">
                            <label for="heading_highlight">Heading (Highlighted Part)</label>
                            <input type="text" id="heading_highlight" name="heading_highlight"
                                class="form-control-styled" value="{{ old('heading_highlight') }}"
                                placeholder="e.g. Ladakh Trip">
                        </div>

                        <div class="form-field">
                            <label for="heading_intro">Intro Paragraph</label>
                            <textarea id="heading_intro" name="heading_intro" rows="2" class="form-control-styled"
                                placeholder="Everything you need to know before exploring the breathtaking landscapes...">{{ old('heading_intro') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Highlight Cards</label>
                            <div id="new-highlight-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-highlight-row">
                                <i class="fa fa-plus"></i> Add Highlight
                            </button>
                            <div class="hint" style="margin-top:10px;">e.g. Icon: upload, Title: "Best Time to Visit",
                                Value: "May – September" — order here sets display order</div>
                        </div>

                    </div>

                    {{-- ============ CTA SECTION ============ --}}
                    <div class="cat-tab-panel" data-panel="cta">

                        <div class="form-field">
                            <label for="cta_badge_text">Badge Text</label>
                            <input type="text" id="cta_badge_text" name="cta_badge_text" class="form-control-styled"
                                value="{{ old('cta_badge_text') }}" placeholder="Limited-Time Offer">
                        </div>

                        <div class="form-field">
                            <label for="cta_title">CTA Title</label>
                            <input type="text" id="cta_title" name="cta_title" class="form-control-styled"
                                value="{{ old('cta_title') }}"
                                placeholder="Can't Decide? Get Up to 40% Off on Any Package You Choose">
                        </div>

                        <div class="form-field">
                            <label for="cta_description">CTA Description</label>
                            <textarea id="cta_description" name="cta_description" rows="3"
                                class="form-control-styled">{{ old('cta_description') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>Perks</label>
                            <div id="new-perk-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-perk-row">
                                <i class="fa fa-plus"></i> Add Perk
                            </button>
                            <div class="hint" style="margin-top:10px;">e.g. "Early Bird Discount up to 40% Off"</div>
                        </div>

                        <div class="form-field">
                            <label for="cta_image">CTA Image</label>
                            <input type="file" id="cta_image" name="cta_image" class="form-control-styled"
                                accept="image/*">
                            <div class="hint">Side image for the banner</div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="cta_button_text">Primary Button Text</label>
                                <input type="text" id="cta_button_text" name="cta_button_text"
                                    class="form-control-styled" value="{{ old('cta_button_text') }}"
                                    placeholder="View Offers">
                            </div>
                            <div class="form-field">
                                <label for="cta_button_url">Primary Button URL</label>
                                <input type="text" id="cta_button_url" name="cta_button_url" class="form-control-styled"
                                    value="{{ old('cta_button_url') }}" placeholder="#package-list">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="cta_button2_text">Secondary Button Text</label>
                                <input type="text" id="cta_button2_text" name="cta_button2_text"
                                    class="form-control-styled" value="{{ old('cta_button2_text') }}"
                                    placeholder="Get A Quote">
                            </div>
                            <div class="form-field">
                                <label for="cta_button2_url">Secondary Button URL</label>
                                <input type="text" id="cta_button2_url" name="cta_button2_url"
                                    class="form-control-styled" value="{{ old('cta_button2_url') }}">
                            </div>
                        </div>

                    </div>

                    {{-- ============ PROMO BANNER ============ --}}
                    <div class="cat-tab-panel" data-panel="promo">

                        <div class="form-field">
                            <label for="promo_badge_text">Badge Text</label>
                            <input type="text" id="promo_badge_text" name="promo_badge_text" class="form-control-styled"
                                value="{{ old('promo_badge_text') }}" placeholder="Monsoon Sale">
                        </div>

                        <div class="form-field">
                            <label for="promo_title">Title</label>
                            <input type="text" id="promo_title" name="promo_title" class="form-control-styled"
                                value="{{ old('promo_title') }}"
                                placeholder="Save up to INR 30,000 on selected Ladakh trips">
                        </div>

                        <div class="form-field">
                            <label for="promo_description">Description</label>
                            <textarea id="promo_description" name="promo_description" rows="3"
                                class="form-control-styled">{{ old('promo_description') }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="promo_button_text">Button Text</label>
                                <input type="text" id="promo_button_text" name="promo_button_text"
                                    class="form-control-styled" value="{{ old('promo_button_text') }}"
                                    placeholder="Know More About the Deal">
                            </div>
                            <div class="form-field">
                                <label for="promo_button_url">Button URL</label>
                                <input type="text" id="promo_button_url" name="promo_button_url"
                                    class="form-control-styled" value="{{ old('promo_button_url') }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="promo_end_at">Offer Ends At</label>
                            <input type="datetime-local" id="promo_end_at" name="promo_end_at"
                                class="form-control-styled" value="{{ old('promo_end_at') }}">
                            <div class="hint">Countdown timer on the page runs until this date/time</div>
                        </div>

                    </div>

                    {{-- ============ FAQ SECTION ============ --}}
                    <div class="cat-tab-panel" data-panel="faqsection">

                        <div class="form-row">
                            <div class="form-field">
                                <label for="faq_heading">Heading (Main Text)</label>
                                <input type="text" id="faq_heading" name="faq_heading" class="form-control-styled"
                                    value="{{ old('faq_heading') }}" placeholder="e.g. Explore More">
                            </div>
                            <div class="form-field">
                                <label for="faq_heading_highlight">Heading (Highlighted Part)</label>
                                <input type="text" id="faq_heading_highlight" name="faq_heading_highlight"
                                    class="form-control-styled" value="{{ old('faq_heading_highlight') }}"
                                    placeholder="e.g. About Ladakh">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="faq_intro">Intro Paragraph</label>
                            <textarea id="faq_intro" name="faq_intro" rows="2" class="form-control-styled"
                                placeholder="Discover useful information and travel insights to help you plan your perfect journey.">{{ old('faq_intro') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label>FAQs / Accordion Items</label>
                            <div id="new-faq-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-faq-row">
                                <i class="fa fa-plus"></i> Add FAQ
                            </button>
                            <div class="hint" style="margin-top:10px;">Order here sets display order — first item opens
                                expanded by default</div>
                        </div>

                    </div>

                    {{-- ============ SEO ============ --}}
                    <div class="cat-tab-panel" data-panel="seo">

                        <div class="form-field">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" class="form-control-styled"
                                value="{{ old('meta_title') }}">
                        </div>

                        <div class="form-field">
                            <label for="meta_description">Meta Description</label>
                            <textarea id="meta_description" name="meta_description" rows="4"
                                class="form-control-styled">{{ old('meta_description') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="og_title">OG Title</label>
                            <input type="text" id="og_title" name="og_title" class="form-control-styled"
                                value="{{ old('og_title') }}" placeholder="Auto-filled from Meta Title">
                            <div class="hint">Auto-fills from Meta Title — edit anytime to override</div>
                        </div>

                        <div class="form-field">
                            <label for="og_description">OG Description</label>
                            <textarea id="og_description" name="og_description" rows="3" class="form-control-styled"
                                placeholder="Auto-filled from Meta Description">{{ old('og_description') }}</textarea>
                            <div class="hint">Auto-fills from Meta Description — edit anytime to override</div>
                        </div>

                        <div class="form-field">
                            <label for="og_image">OG Image</label>
                            <input type="file" id="og_image" name="og_image" class="form-control-styled"
                                accept="image/*">
                        </div>

                        <div class="form-field">
                            <label for="canonical_url">Canonical URL</label>
                            <input type="text" id="canonical_url" name="canonical_url" class="form-control-styled"
                                value="{{ old('canonical_url') }}" placeholder="Auto-generated from slug">
                            <div class="hint">Auto-fills from the slug — edit anytime to override</div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Save Sub Category
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

    (function focusFirstErrorTab() {
        const firstError = document.querySelector('.form-error');
        if (!firstError) return;
        const panel = firstError.closest('.cat-tab-panel');
        if (!panel || panel.classList.contains('active')) return;

        document.querySelectorAll('#subcat-tabs .cat-tab').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.remove('active'));
        panel.classList.add('active');
        document.querySelector('#subcat-tabs .cat-tab[data-tab="' + panel.dataset.panel + '"]').classList.add('active');
    })();

    let ogTitleEdited = false, ogDescEdited = false, canonicalEdited = false;

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
            document.getElementById('canonical_url').value = '{{ url('/') }}/' + slug;
        }
    });

    document.getElementById('meta_title').addEventListener('keyup', function () {
        if (!ogTitleEdited) document.getElementById('og_title').value = this.value;
    });

    document.getElementById('meta_description').addEventListener('keyup', function () {
        if (!ogDescEdited) document.getElementById('og_description').value = this.value;
    });

    // ---- Highlight repeater ----
    let highlightIndex = 0;
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

    // ---- Perk repeater ----
    let perkIndex = 0;
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

    // ---- FAQ repeater ----
    let faqIndex = 0;
    document.getElementById('add-faq-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Question</label>
            <input type="text" name="faq_questions[${faqIndex}]" class="form-control-styled" placeholder="e.g. Ladakh Tour Packages From Popular Indian Cities">
        </div>
        <div class="form-field">
            <label>Answer</label>
            <textarea name="faq_answers[${faqIndex}]" class="form-control-styled" rows="3" placeholder="Answer shown in the accordion"></textarea>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('new-faq-rows').appendChild(row);
        faqIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });

   
</script>

@include('admin.footer')