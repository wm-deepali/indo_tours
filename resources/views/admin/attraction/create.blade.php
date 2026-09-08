{{-- resources/views/admin/attraction/create.blade.php --}}
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

        .cat-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); box-sizing: border-box; }
        .cat-page * { box-sizing: border-box; }
        .cat-page-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .cat-page-header h1 { font-size: 20px; font-weight: 650; margin: 0; }
        .cat-breadcrumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
        .cat-breadcrumb a { color: var(--accent); text-decoration: none; }
        .cat-breadcrumb a:hover { text-decoration: underline; }
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
        .form-control-styled[readonly] { background: var(--bg); color: var(--text-hint); }

        .form-error { color: #b22222; font-size: 12px; margin-top: 5px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; }

        .toggle-row { display: flex; align-items: center; gap: 10px; }
        .switch { position: relative; width: 42px; height: 24px; flex-shrink: 0; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .switch-slider { position: absolute; inset: 0; background: var(--border); border-radius: 999px; cursor: pointer; transition: .15s; }
        .switch-slider::before { content: ''; position: absolute; width: 18px; height: 18px; left: 3px; top: 3px; background: #fff; border-radius: 50%; transition: .15s; box-shadow: 0 1px 2px rgba(0, 0, 0, .2); }
        .switch input:checked+.switch-slider { background: var(--accent); }
        .switch input:checked+.switch-slider::before { transform: translateX(18px); }

        .form-actions { display: flex; gap: 10px; padding: 20px 24px; border-top: 1px solid var(--border); background: var(--surface); }

        .cat-tabs { display: flex; gap: 2px; padding: 0 24px; border-bottom: 1px solid var(--border); background: var(--surface); overflow-x: auto; }
        .cat-tab { appearance: none; background: none; border: none; border-bottom: 2px solid transparent; padding: 14px 16px; font-family: var(--font); font-size: 13px; font-weight: 600; color: var(--text-secondary); cursor: pointer; white-space: nowrap; }
        .cat-tab:hover { color: var(--text-primary); }
        .cat-tab.active { color: var(--accent); border-bottom-color: var(--accent); }
        .cat-tab-panel { display: none; padding: 24px; }
        .cat-tab-panel.active { display: block; }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Add Attraction</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.attractions.index') }}">Attractions</a>
                        <span>›</span>
                        Add
                    </div>
                </div>
                <a href="{{ route('admin.attractions.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.attractions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="cat-tabs" id="attraction-tabs">
                        <button type="button" class="cat-tab active" data-tab="general">General</button>
                        <button type="button" class="cat-tab" data-tab="location">Location</button>
                        <button type="button" class="cat-tab" data-tab="seo">SEO / Open Graph</button>
                    </div>

                    {{-- ============ GENERAL ============ --}}
                    <div class="cat-tab-panel active" data-panel="general">

                        <div class="form-field">
                            <label for="name">Attraction Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control-styled @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Enter attraction name" required>
                            @error('name')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="slug">Slug</label>
                            <input type="text" id="slug" name="slug_preview" class="form-control-styled" readonly
                                placeholder="Auto-generated from attraction name">
                            <div class="hint">Generated automatically on save — used for the URL and canonical tag</div>
                        </div>

                        <div class="form-field">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image"
                                class="form-control-styled @error('image') is-invalid @enderror" accept="image/*">
                            <div class="hint">Used on the listing card and as banner fallback — max 2MB</div>
                            @error('image')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="short_description">Short Description</label>
                            <textarea id="short_description" name="short_description" rows="2"
                                class="form-control-styled @error('short_description') is-invalid @enderror"
                                placeholder="Shown on the attractions listing card">{{ old('short_description') }}</textarea>
                            @error('short_description')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="description">Long Description</label>
                            <textarea id="description" name="description" rows="5"
                                class="form-control-styled @error('description') is-invalid @enderror"
                                placeholder="Shown as the About section on the attraction detail page">{{ old('description') }}</textarea>
                            @error('description')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="duration_text">Recommended Duration</label>
                                <input type="text" id="duration_text" name="duration_text" class="form-control-styled"
                                    value="{{ old('duration_text') }}" placeholder="e.g. 4-7 Days">
                            </div>
                            <div class="form-field">
                                <label for="best_time_text">Best Time</label>
                                <input type="text" id="best_time_text" name="best_time_text" class="form-control-styled"
                                    value="{{ old('best_time_text') }}" placeholder="e.g. March - October">
                            </div>
                            <div class="form-field">
                                <label for="best_for_tags">Best For (tags)</label>
                                <input type="text" id="best_for_tags" name="best_for_tags" class="form-control-styled"
                                    value="{{ old('best_for_tags') }}" placeholder="Families, Couples, Adventure">
                            </div>
                        </div>
                        <div class="hint" style="margin-top:-10px; margin-bottom:18px;">"Best For" is comma-separated — shown as the "Ideal For" tags on the detail page</div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="rating">Rating</label>
                                <input type="number" id="rating" name="rating" step="0.1" min="0" max="5"
                                    class="form-control-styled @error('rating') is-invalid @enderror"
                                    value="{{ old('rating') }}" placeholder="e.g. 4.8">
                                @error('rating')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-field">
                                <label for="review_count">Review Count</label>
                                <input type="number" id="review_count" name="review_count" min="0"
                                    class="form-control-styled @error('review_count') is-invalid @enderror"
                                    value="{{ old('review_count', 0) }}" placeholder="e.g. 124">
                                @error('review_count')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-field toggle-row">
                            <label class="switch">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <span class="switch-slider"></span>
                            </label>
                            <label style="margin:0">Featured Attraction</label>
                        </div>

                        <div class="form-field">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control-styled">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="unpublished" {{ old('status') == 'unpublished' ? 'selected' : '' }}>Unpublished</option>
                            </select>
                        </div>

                    </div>

                    {{-- ============ LOCATION ============ --}}
                    <div class="cat-tab-panel" data-panel="location">

                        <div class="form-row">
                            <div class="form-field">
                                <label for="country_id">Country</label>
                                <select id="country_id" name="country_id"
                                    class="form-control-styled @error('country_id') is-invalid @enderror" required>
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('country_id')<div class="form-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-field">
                                <label for="state_id">State</label>
                                <select id="state_id" name="state_id" class="form-control-styled" disabled>
                                    <option value="">Select Country First</option>
                                </select>
                                <div class="hint">Optional — leave blank for a country-level attraction</div>
                            </div>

                            <div class="form-field">
                                <label for="city_id">City</label>
                                <select id="city_id" name="city_id" class="form-control-styled" disabled>
                                    <option value="">Select State First</option>
                                </select>
                                <div class="hint">Optional — leave blank for a state-level attraction</div>
                            </div>
                        </div>

                    </div>

                    {{-- ============ SEO ============ --}}
                    <div class="cat-tab-panel" data-panel="seo">

                        <div class="form-field">
                            <label for="h1">H1 Tag</label>
                            <input type="text" id="h1" name="h1"
                                class="form-control-styled @error('h1') is-invalid @enderror" value="{{ old('h1') }}"
                                placeholder="Auto-filled from Attraction Name">
                            <div class="hint">Auto-fills from Attraction Name — edit anytime to override</div>
                            @error('h1')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" id="meta_title" name="meta_title" class="form-control-styled"
                                value="{{ old('meta_title') }}" placeholder="Enter meta title">
                        </div>

                        <div class="form-field">
                            <label for="meta_description">Meta Description</label>
                            <textarea id="meta_description" name="meta_description" rows="4"
                                class="form-control-styled">{{ old('meta_description') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="og_title">OG Title</label>
                            <input type="text" id="og_title" name="og_title"
                                class="form-control-styled @error('og_title') is-invalid @enderror"
                                value="{{ old('og_title') }}" placeholder="Auto-filled from Meta Title">
                            <div class="hint">Auto-fills from Meta Title — edit anytime to override</div>
                            @error('og_title')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="og_description">OG Description</label>
                            <textarea id="og_description" name="og_description" rows="3"
                                class="form-control-styled @error('og_description') is-invalid @enderror"
                                placeholder="Auto-filled from Meta Description">{{ old('og_description') }}</textarea>
                            <div class="hint">Auto-fills from Meta Description — edit anytime to override</div>
                            @error('og_description')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="og_image">OG Image</label>
                            <input type="file" id="og_image" name="og_image"
                                class="form-control-styled @error('og_image') is-invalid @enderror" accept="image/*">
                            <div class="hint">Leave blank to automatically use the Attraction Image as OG Image</div>
                            @error('og_image')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="canonical_url">Canonical URL</label>
                            <input type="text" id="canonical_url" name="canonical_url"
                                class="form-control-styled @error('canonical_url') is-invalid @enderror"
                                value="{{ old('canonical_url') }}" placeholder="Auto-generated from slug">
                            <div class="hint">Auto-fills from the slug — edit anytime to override</div>
                            @error('canonical_url')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Save Attraction
                        </button>
                        <a href="{{ route('admin.attractions.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.querySelectorAll('#attraction-tabs .cat-tab').forEach(function (tabBtn) {
        tabBtn.addEventListener('click', function () {
            document.querySelectorAll('#attraction-tabs .cat-tab').forEach(b => b.classList.remove('active'));
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

        document.querySelectorAll('#attraction-tabs .cat-tab').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.cat-tab-panel').forEach(p => p.classList.remove('active'));
        panel.classList.add('active');
        document.querySelector('#attraction-tabs .cat-tab[data-tab="' + panel.dataset.panel + '"]').classList.add('active');
    })();

    let h1Edited = false, ogTitleEdited = false, ogDescEdited = false, canonicalEdited = false;

    document.getElementById('h1').addEventListener('input', () => h1Edited = true);
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
            document.getElementById('canonical_url').value = '{{ url('/attractions') }}/' + slug;
        }
        if (!h1Edited) {
            document.getElementById('h1').value = this.value;
        }
    });

    document.getElementById('meta_title').addEventListener('keyup', function () {
        if (!ogTitleEdited) document.getElementById('og_title').value = this.value;
    });

    document.getElementById('meta_description').addEventListener('keyup', function () {
        if (!ogDescEdited) document.getElementById('og_description').value = this.value;
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
</script>

@include('admin.footer')