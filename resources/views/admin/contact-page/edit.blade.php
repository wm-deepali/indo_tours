{{-- resources/views/admin/contact-page/edit.blade.php --}}
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
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Contact Us Page</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Content Manage
                        <span>›</span>
                        Contact Page
                    </div>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-info" style="margin-bottom:16px;">{{ session('success') }}</div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger" style="margin-bottom:16px;">
                <ul style="margin:0;padding-left:18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="cat-card">
                <form action="{{ route('admin.contact-page.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="cat-tabs" id="cp-tabs">
                        <button type="button" class="cat-tab active" data-tab="banner">Banner</button>
                        <button type="button" class="cat-tab" data-tab="touch">Get In Touch</button>
                        <button type="button" class="cat-tab" data-tab="hours">Opening Hours</button>
                        <button type="button" class="cat-tab" data-tab="offices">Offices</button>
                        <button type="button" class="cat-tab" data-tab="faqs">FAQs</button>
                        <button type="button" class="cat-tab" data-tab="promo">Promo Banner</button>
                    </div>

                    {{-- ============ BANNER ============ --}}
                    <div class="cat-tab-panel active" data-panel="banner">

                        <div class="form-field">
                            <label for="banner_image">Banner Image</label>
                            @if($contactPage->banner_image)
                            <img src="{{ asset('storage/' . $contactPage->banner_image) }}"
                                class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="banner_image" name="banner_image" class="form-control-styled" accept="image/*">
                            <div class="hint">Leave blank to keep the current image</div>
                        </div>

                        <div class="form-field">
                            <label for="banner_heading">Heading (H1)</label>
                            <input type="text" id="banner_heading" name="banner_heading"
                                class="form-control-styled @error('banner_heading') is-invalid @enderror"
                                value="{{ old('banner_heading', $contactPage->banner_heading) }}"
                                placeholder="e.g. Travel With Us">
                            @error('banner_heading')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="banner_description">Description</label>
                            <textarea id="banner_description" name="banner_description" rows="3"
                                class="form-control-styled">{{ old('banner_description', $contactPage->banner_description) }}</textarea>
                        </div>

                    </div>

                    {{-- ============ GET IN TOUCH ============ --}}
                    <div class="cat-tab-panel" data-panel="touch">

                        <div class="form-field">
                            <label for="touch_heading">Heading</label>
                            <input type="text" id="touch_heading" name="touch_heading" class="form-control-styled"
                                value="{{ old('touch_heading', $contactPage->touch_heading) }}"
                                placeholder="e.g. Get in touch">
                        </div>

                        <div class="form-field">
                            <label for="touch_description">Description</label>
                            <textarea id="touch_description" name="touch_description" rows="3"
                                class="form-control-styled">{{ old('touch_description', $contactPage->touch_description) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" class="form-control-styled"
                                    value="{{ old('phone', $contactPage->phone) }}" placeholder="e.g. 613-306-8859">
                                @error('phone')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-field">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control-styled"
                                    value="{{ old('email', $contactPage->email) }}" placeholder="e.g. hello@yoursite.com">
                                @error('email')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                    </div>

                    {{-- ============ OPENING HOURS ============ --}}
                    <div class="cat-tab-panel" data-panel="hours">

                        <div id="hours-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-hours-row">
                            <i class="fa fa-plus"></i> Add Hours Block
                        </button>
                        <div class="hint" style="margin-top:10px;">e.g. Range: "October – March", Text: "Monday through Friday: 7 AM – 5 PM, PST"</div>

                    </div>

                    {{-- ============ OFFICES ============ --}}
                    <div class="cat-tab-panel" data-panel="offices">

                        <div id="office-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-office-row">
                            <i class="fa fa-plus"></i> Add Office
                        </button>

                    </div>

                    {{-- ============ FAQS ============ --}}
                    <div class="cat-tab-panel" data-panel="faqs">

                        <div class="form-field">
                            <label for="faqs_heading">Section Heading</label>
                            <input type="text" id="faqs_heading" name="faqs_heading" class="form-control-styled"
                                value="{{ old('faqs_heading', $contactPage->faqs_heading) }}"
                                placeholder="e.g. Have Questions? We're Here to Help.">
                        </div>

                        <div id="faq-rows"></div>
                        <button type="button" class="btn-secondary-dash" id="add-faq-row">
                            <i class="fa fa-plus"></i> Add FAQ
                        </button>

                    </div>

                    {{-- ============ PROMO BANNER ============ --}}
                    <div class="cat-tab-panel" data-panel="promo">

                        <div class="form-field">
                            <label for="promo_image">Promo Image</label>
                            @if($contactPage->promo_image)
                            <img src="{{ asset('storage/' . $contactPage->promo_image) }}"
                                class="current-img-preview" alt="">
                            @endif
                            <input type="file" id="promo_image" name="promo_image" class="form-control-styled" accept="image/*">
                            <div class="hint">Leave blank to keep the current image</div>
                        </div>

                        <div class="form-field">
                            <label for="promo_eyebrow">Eyebrow Text</label>
                            <input type="text" id="promo_eyebrow" name="promo_eyebrow" class="form-control-styled"
                                value="{{ old('promo_eyebrow', $contactPage->promo_eyebrow) }}"
                                placeholder="e.g. Stay Updated">
                        </div>

                        <div class="form-field">
                            <label for="promo_heading">Heading</label>
                            <input type="text" id="promo_heading" name="promo_heading" class="form-control-styled"
                                value="{{ old('promo_heading', $contactPage->promo_heading) }}"
                                placeholder="e.g. Ready to Start Your Journey?">
                        </div>

                        <div class="form-field">
                            <label for="promo_description">Description</label>
                            <textarea id="promo_description" name="promo_description" rows="3"
                                class="form-control-styled">{{ old('promo_description', $contactPage->promo_description) }}</textarea>
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
<script id="existing-hours-data" type="application/json">
    {!! json_encode(old('hours_ranges') ? collect(old('hours_ranges'))->map(fn($r, $i) => ['range' => $r, 'text' => old('hours_texts')[$i] ?? ''])->values() : ($contactPage->opening_hours ?? [])) !!}
</script>
<script id="existing-offices-data" type="application/json">
    {!! json_encode($contactPage->offices ?? []) !!}
</script>
<script id="existing-faqs-data" type="application/json">
    {!! json_encode($contactPage->faqs ?? []) !!}
</script>

<script>
    document.querySelectorAll('#cp-tabs .cat-tab').forEach(function (tabBtn) {
        tabBtn.addEventListener('click', function () {
            document.querySelectorAll('#cp-tabs .cat-tab').forEach(b => b.classList.remove('active'));
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

        document.querySelectorAll('#cp-tabs .cat-tab').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.remove('active'));
        panel.classList.add('active');
        document.querySelector('#cp-tabs .cat-tab[data-tab="' + panel.dataset.panel + '"]').classList.add('active');
    })();

    // ---- Opening Hours repeater (range + text) ----
    let hoursIndex = 0;

    function addHoursRow(data = null) {
        const idx = hoursIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Range</label>
            <input type="text" name="hours_ranges[${idx}]" class="form-control-styled" placeholder="e.g. October – March" value="${data ? data.range : ''}">
        </div>
        <div class="form-field">
            <label>Hours Text</label>
            <textarea name="hours_texts[${idx}]" class="form-control-styled" rows="2" placeholder="e.g. Monday through Friday: 7 AM – 5 PM, PST">${data ? data.text : ''}</textarea>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove</button>
    `;
        document.getElementById('hours-rows').appendChild(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        hoursIndex++;
    }

    document.getElementById('add-hours-row').addEventListener('click', () => addHoursRow());

    const existingHoursData = JSON.parse(document.getElementById('existing-hours-data').textContent);
    if (existingHoursData.length) {
        existingHoursData.forEach(data => addHoursRow(data));
    } else {
        addHoursRow();
    }

    // ---- Offices repeater (heading + address + map url + map embed) ----
    let officeIndex = 0;

    function addOfficeRow(data = null) {
        const idx = officeIndex;
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
        <div class="form-field">
            <label>Heading</label>
            <input type="text" name="office_headings[${idx}]" class="form-control-styled" placeholder="e.g. Head Office" value="${data ? data.heading : ''}">
        </div>
        <div class="form-field">
            <label>Address</label>
            <textarea name="office_addresses[${idx}]" class="form-control-styled" rows="2" placeholder="Full office address">${data ? data.address : ''}</textarea>
        </div>
        <div class="form-field">
            <label>"View on Google Maps" Link</label>
            <input type="text" name="office_map_urls[${idx}]" class="form-control-styled" placeholder="https://maps.google.com/..." value="${data ? data.map_url : ''}">
        </div>
        <div class="form-field">
            <label>Map Embed URL</label>
            <input type="text" name="office_map_embeds[${idx}]" class="form-control-styled" placeholder="https://www.google.com/maps/embed?pb=..." value="${data ? data.map_embed_url : ''}">
            <div class="hint">The full "src" URL from Google Maps' Embed option.</div>
        </div>
        <button type="button" class="btn-secondary-dash remove-new-row" style="margin-top:10px;"><i class="fa fa-trash"></i> Remove Office</button>
    `;
        document.getElementById('office-rows').appendChild(row);
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
        officeIndex++;
    }

    document.getElementById('add-office-row').addEventListener('click', () => addOfficeRow());

    const existingOfficesData = JSON.parse(document.getElementById('existing-offices-data').textContent);
    if (existingOfficesData.length) {
        existingOfficesData.forEach(data => addOfficeRow(data));
    } else {
        addOfficeRow();
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