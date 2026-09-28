{{-- resources/views/admin/testimonial/edit.blade.php --}}
@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        /* ...identical <style> block as create.blade.php above... */
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Edit Testimonial</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.testimonials.index') }}">Testimonials</a>
                        <span>›</span>
                        Edit
                    </div>
                </div>
                <a href="{{ route('admin.testimonials.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-body">

                        <div class="form-row">
                            <div class="form-field">
                                <label for="name">Traveller Name</label>
                                <input type="text" id="name" name="name"
                                    class="form-control-styled @error('name') is-invalid @enderror"
                                    value="{{ old('name', $testimonial->name) }}" required>
                                @error('name')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-field">
                                <label for="designation">Designation / Traveller Type</label>
                                <input type="text" id="designation" name="designation"
                                    class="form-control-styled @error('designation') is-invalid @enderror"
                                    value="{{ old('designation', $testimonial->designation) }}">
                                @error('designation')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="image">Photo</label>
                            @if ($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="icon-preview">
                            @endif
                            <input type="file" id="image" name="image" class="form-control-styled" accept="image/*">
                            <div class="hint">Leave blank to keep the current photo</div>
                            @error('image')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="quote">Quote</label>
                            <textarea id="quote" name="quote" rows="4"
                                class="form-control-styled @error('quote') is-invalid @enderror">{{ old('quote', $testimonial->quote) }}</textarea>
                            @error('quote')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-row-3">
                            <div class="form-field">
                                <label for="rating">Rating</label>
                                <select id="rating" name="rating" class="form-control-styled @error('rating') is-invalid @enderror">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Star</option>
                                    @endfor
                                </select>
                                @error('rating')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-field">
                                <label for="sort_order">Sort Order</label>
                                <input type="number" min="0" id="sort_order" name="sort_order"
                                    class="form-control-styled" value="{{ old('sort_order', $testimonial->sort_order) }}">
                                @error('sort_order')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-field">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control-styled @error('status') is-invalid @enderror">
                                    <option value="published" {{ old('status', $testimonial->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ old('status', $testimonial->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                </select>
                                @error('status')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Update Testimonial
                        </button>
                        <a href="{{ route('admin.testimonials.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@include('admin.footer')