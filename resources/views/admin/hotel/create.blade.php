{{-- resources/views/admin/hotel/create.blade.php --}}
@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
    :root {
        --bg: #f1f2f4; --surface: #ffffff; --border: #e3e5e8;
        --text-primary: #202223; --text-secondary:#6d7175; --text-hint:#8c9196;
        --accent: #303d89; --accent-light: #f0f1fc;
        --radius-sm: 8px; --radius-md: 12px;
        --shadow-card: 0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
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
    .btn-primary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff !important; border: none; border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; box-shadow: 0 1px 3px rgba(48,61,137,.25); }
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
    .form-control-styled:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }
    .form-error { color: #b22222; font-size: 12px; margin-top: 5px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; }
    .form-actions { display: flex; gap: 10px; padding: 20px 24px; border-top: 1px solid var(--border); background: var(--surface); }
    .gallery-row { border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 16px; margin-bottom: 14px; background: var(--bg); }
    .gallery-row .remove-new-row { margin-top: 10px; }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Add Hotel</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.hotels.index') }}">Hotels</a>
                        <span>›</span>
                        Add
                    </div>
                </div>
                <a href="{{ route('admin.hotels.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div style="padding:24px;">

                        <div class="form-field">
                            <label for="name">Hotel Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control-styled @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Enter hotel name" required>
                            @error('name')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="country_id">Country</label>
                                <select id="country_id" name="country_id" class="form-control-styled" required>
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-field">
                                <label for="state_id">State</label>
                                <select id="state_id" name="state_id" class="form-control-styled" disabled>
                                    <option value="">Select Country First</option>
                                </select>
                            </div>

                            <div class="form-field">
                                <label for="city_id">City</label>
                                <select id="city_id" name="city_id" class="form-control-styled" disabled>
                                    <option value="">Select State First</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="rating">Ratings</label>
                                <input type="number" id="rating" name="rating" step="0.1" min="0" max="5"
                                    class="form-control-styled @error('rating') is-invalid @enderror"
                                    value="{{ old('rating') }}" placeholder="e.g. 4.5">
                                @error('rating')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-field">
                                <label for="check_in_time">Check-In Time</label>
                                <input type="time" id="check_in_time" name="check_in_time"
                                    class="form-control-styled" value="{{ old('check_in_time') }}">
                            </div>
                            <div class="form-field">
                                <label for="check_out_time">Check-Out Time</label>
                                <input type="time" id="check_out_time" name="check_out_time"
                                    class="form-control-styled" value="{{ old('check_out_time') }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="short_description">Short Description</label>
                            <textarea id="short_description" name="short_description" rows="3"
                                class="form-control-styled" placeholder="Brief description of the hotel">{{ old('short_description') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="location">Location</label>
                            <input type="text" id="location" name="location" class="form-control-styled"
                                value="{{ old('location') }}" placeholder="e.g. Downtown Reykjavik, near Hallgrímskirkja">
                            <div class="hint">Free text — enter the area/landmark description as you'd like it displayed</div>
                        </div>

                        <div class="form-field">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control-styled">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="unpublished" {{ old('status') == 'unpublished' ? 'selected' : '' }}>Unpublished</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label>Photo Gallery</label>
                            <div id="new-gallery-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-gallery-row">
                                <i class="fa fa-plus"></i> Add Photo
                            </button>
                            <div class="hint" style="margin-top:10px;">Add multiple hotel photos — first image is used as the primary thumbnail</div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Save Hotel
                        </button>
                        <a href="{{ route('admin.hotels.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
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

        fetch(`{{ url('admin/location/states') }}/${this.value}`)
            .then(res => res.json())
            .then(states => {
                stateSelect.innerHTML = '<option value="">Select State</option>';
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

        fetch(`{{ url('admin/location/cities') }}/${this.value}`)
            .then(res => res.json())
            .then(cities => {
                citySelect.innerHTML = '<option value="">Select City</option>';
                cities.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                });
                citySelect.disabled = false;
            });
    });

    let galleryIndex = 0;
    document.getElementById('add-gallery-row').addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'gallery-row';
        row.innerHTML = `
            <div class="form-field">
                <label>Photo</label>
                <input type="file" name="gallery_images[${galleryIndex}]" class="form-control-styled" accept="image/*">
            </div>
            <button type="button" class="btn-secondary-dash remove-new-row"><i class="fa fa-trash"></i> Remove</button>
        `;
        document.getElementById('new-gallery-rows').appendChild(row);
        galleryIndex++;
        row.querySelector('.remove-new-row').addEventListener('click', () => row.remove());
    });
</script>

@include('admin.footer')