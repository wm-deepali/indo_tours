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

        .star-select {
            display: flex;
            gap: 6px;
        }

        .star-select label {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 8px 12px;
            cursor: pointer;
        }

        .star-select input {
            margin: 0;
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Edit Review</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.reviews.index') }}">Reviews</a>
                        <span>›</span>
                        Edit
                    </div>
                </div>
                <a href="{{ route('admin.reviews.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.reviews.update', $review) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div style="padding:24px;">

                        <div class="form-row">
                            <div class="form-field">
                                <label for="reviewable_type">Review For (Type)</label>
                                <select id="reviewable_type" name="reviewable_type"
                                    class="form-control-styled @error('reviewable_type') is-invalid @enderror" required>
                                    <option value="">Select Type</option>
                                    @foreach($types as $key => $class)
                                        <option value="{{ $key }}" {{ old('reviewable_type', $typeKey) == $key ? 'selected' : '' }}>
                                            {{ ucwords(str_replace('_', ' ', $key)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('reviewable_type')
                                <div class="form-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-field">
                                <label for="reviewable_id">Select Item</label>
                                <select id="reviewable_id" name="reviewable_id"
                                    class="form-control-styled @error('reviewable_id') is-invalid @enderror" required>
                                    @if($currentEntity)
                                        <option value="{{ $review->reviewable_id }}" selected>{{ $currentEntity->name }}
                                        </option>
                                    @else
                                        <option value="">Select Item</option>
                                    @endif
                                </select>
                                @error('reviewable_id')
                                <div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="full_name">Reviewer Name</label>
                                <input type="text" id="full_name" name="full_name"
                                    class="form-control-styled @error('full_name') is-invalid @enderror"
                                    value="{{ old('full_name', $review->full_name) }}" required>
                                @error('full_name')
                                <div class="form-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-field">
                                <label for="designation">Designation (optional)</label>
                                <input type="text" id="designation" name="designation" class="form-control-styled"
                                    value="{{ old('designation', $review->designation) }}">
                            </div>
                        </div>

                        <div class="form-field">
                            <label>Rating</label>
                            <div class="star-select">
                                @for($i = 1; $i <= 5; $i++)
                                    <label>
                                        <input type="radio" name="rating" value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'checked' : '' }} required>
                                        {{ $i }} ★
                                    </label>
                                @endfor
                            </div>
                            @error('rating')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="review">Review Text</label>
                            <textarea id="review" name="review" rows="4"
                                class="form-control-styled @error('review') is-invalid @enderror"
                                required>{{ old('review', $review->review) }}</textarea>
                            @error('review')
                            <div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="photo">Reviewer Photo</label>
                                @if($review->photo)
                                    <div style="margin-bottom:8px;">
                                        <img src="{{ asset('storage/' . $review->photo) }}"
                                            style="width:56px;height:56px;border-radius:50%;object-fit:cover;">
                                    </div>
                                @endif
                                <input type="file" id="photo" name="photo" class="form-control-styled" accept="image/*">
                                <div class="hint">Leave empty to keep the current photo</div>
                            </div>

                            <div class="form-field">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control-styled">
                                    <option value="draft" {{ old('status', $review->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $review->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="unpublished" {{ old('status', $review->status) == 'unpublished' ? 'selected' : '' }}>Unpublished</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Update Review
                        </button>
                        <a href="{{ route('admin.reviews.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    const typeSelect = document.getElementById('reviewable_type');
    const entitySelect = document.getElementById('reviewable_id');
    const currentEntityId = "{{ $review->reviewable_id }}";

    typeSelect.addEventListener('change', function () {
        entitySelect.innerHTML = '<option value="">Loading...</option>';

        if (!this.value) {
            entitySelect.innerHTML = '<option value="">Select Type First</option>';
            return;
        }

        fetch(`{{ url('admin/reviews/entities') }}/${this.value}`)
            .then(res => res.json())
            .then(items => {
                entitySelect.innerHTML = '<option value="">Select Item</option>';
                items.forEach(item => {
                    const selected = String(item.id) === currentEntityId ? 'selected' : '';
                    entitySelect.innerHTML += `<option value="${item.id}" ${selected}>${item.name}</option>`;
                });
            });
    });
</script>

@include('admin.footer')