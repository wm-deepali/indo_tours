{{-- resources/views/admin/hotel/edit.blade.php --}}
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
    .gallery-row .remove-new-row, .gallery-row .remove-gallery-row { margin-top: 10px; }
    .existing-gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(110px, 1fr)); gap: 12px; margin-bottom: 16px; }
    .existing-gallery-item { position: relative; border: 1px solid var(--border); border-radius: var(--radius-sm); overflow: hidden; background: var(--bg); }
    .existing-gallery-item img { width: 100%; height: 90px; object-fit: cover; display: block; }
    .existing-gallery-item .remove-gallery-row {
        position: absolute; top: 6px; right: 6px; background: #fff; border: 1px solid var(--border);
        border-radius: 50%; width: 26px; height: 26px; display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: #b22222; font-size: 12px; padding: 0;
    }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Edit Hotel</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.hotels.index') }}">Hotels</a>
                        <span>›</span>
                        Edit
                    </div>
                </div>
                <a href="{{ route('admin.hotels.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.hotels.update', $hotel) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div style="padding:24px;">

                        <div class="form-field">
                            <label for="name">Hotel Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control-styled @error('name') is-invalid @enderror"
                                value="{{ old('name', $hotel->name) }}" placeholder="Enter hotel name" required>
                            @error('name')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="country_id">Country</label>
                                <select id="country_id" name="country_id" class="form-control-styled" required>
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id', $hotel->country_id) == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-field">
                                <label for="state_id">State</label>
                                <select id="state_id" name="state_id" class="form-control-styled">
                                    @if($hotel->state)
                                        <option value="{{ $hotel->state->id }}" selected>{{ $hotel->state->name }}</option>
                                    @else
                                        <option value="">Select Country First</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-field">
                                <label for="city_id">City</label>
                                <select id="city_id" name="city_id" class="form-control-styled">
                                    @if($hotel->city)
                                        <option value="{{ $hotel->city->id }}" selected>{{ $hotel->city->name }}</option>
                                    @else
                                        <option value="">Select State First</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="rating">Ratings</label>
                                <input type="number" id="rating" name="rating" step="0.1" min="0" max="5"
                                    class="form-control-styled @error('rating') is-invalid @enderror"
                                    value="{{ old('rating', $hotel->rating) }}" placeholder="e.g. 4.5">
                                @error('rating')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-field">
                                <label for="check_in_time">Check-In Time</label>
                                <input type="time" id="check_in_time" name="check_in_time"
                                    class="form-control-styled"
                                    value="{{ old('check_in_time', $hotel->check_in_time ? \Carbon\Carbon::parse($hotel->check_in_time)->format('H:i') : '') }}">
                            </div>
                            <div class="form-field">
                                <label for="check_out_time">Check-Out Time</label>
                                <input type="time" id="check_out_time" name="check_out_time"
                                    class="form-control-styled"
                                    value="{{ old('check_out_time', $hotel->check_out_time ? \Carbon\Carbon::parse($hotel->check_out_time)->format('H:i') : '') }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="short_description">Short Description</label>
                            <textarea id="short_description" name="short_description" rows="3"
                                class="form-control-styled" placeholder="Brief description of the hotel">{{ old('short_description', $hotel->short_description) }}</textarea>
                        </div>

                        <div class="form-field">
                            <label for="location">Location</label>
                            <input type="text" id="location" name="location" class="form-control-styled"
                                value="{{ old('location', $hotel->location) }}" placeholder="e.g. Downtown Reykjavik, near Hallgrímskirkja">
                            <div class="hint">Free text — enter the area/landmark description as you'd like it displayed</div>
                        </div>

                        <div class="form-field">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control-styled">
                                <option value="draft" {{ old('status', $hotel->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $hotel->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="unpublished" {{ old('status', $hotel->status) == 'unpublished' ? 'selected' : '' }}>Unpublished</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label>Photo Gallery</label>

                            @if($hotel->galleries->count())
                                <div class="existing-gallery-grid">
                                    @foreach($hotel->galleries as $img)
                                        <div class="existing-gallery-item" data-id="{{ $img->id }}">
                                            <img src="{{ asset($img->image) }}" alt="">
                                            <button type="button" class="remove-gallery-row" data-id="{{ $img->id }}" title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <input type="hidden" name="deleted_galleries" id="deleted_galleries" value="">

                            <div id="new-gallery-rows"></div>
                            <button type="button" class="btn-secondary-dash" id="add-gallery-row">
                                <i class="fa fa-plus"></i> Add Photo
                            </button>
                            <div class="hint" style="margin-top:10px;">Click × on an existing photo to remove it — new photos are added below</div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Update Hotel
                        </button>
                        <a href="{{ route('admin.hotels.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    // ---- Cascading Country -> State -> City ----
    const countrySelect = document.getElementById('country_id');
    const stateSelect = document.getElementById('state_id');
    const citySelect = document.getElementById('city_id');

    countrySelect.addEventListener('change', function () {
        citySelect.innerHTML = '<option value="">Select State First</option>';

        if (!this.value) {
            stateSelect.innerHTML = '<option value="">Select Country First</option>';
            return;
        }

        fetch(`{{ url('admin/location/states') }}/${this.value}`)
            .then(res => res.json())
            .then(states => {
                stateSelect.innerHTML = '<option value="">Select State</option>';
                states.forEach(state => {
                    stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                });
            });
    });

    stateSelect.addEventListener('change', function () {
        if (!this.value) {
            citySelect.innerHTML = '<option value="">Select State First</option>';
            return;
        }

        fetch(`{{ url('admin/location/cities') }}/${this.value}`)
            .then(res => res.json())
            .then(cities => {
                citySelect.innerHTML = '<option value="">Select City</option>';
                cities.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                });
            });
    });

    // ---- Remove existing gallery image ----
    const deletedGalleries = [];
    document.querySelectorAll('.remove-gallery-row').forEach(function (btn) {
        btn.addEventListener('click', function () {
            deletedGalleries.push(this.dataset.id);
            document.getElementById('deleted_galleries').value = deletedGalleries.join(',');
            this.closest('.existing-gallery-item').remove();
        });
    });

    // ---- Add new gallery images ----
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