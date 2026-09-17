@csrf

@php
    $selectedDestinations = old('destination_ids', $blog->destinations->pluck('id')->toArray());
    $selectedAttractions  = old('attraction_ids', $blog->attractions->pluck('id')->toArray());
    $selectedActivities   = old('activity_ids', $blog->activities->pluck('id')->toArray());
    $selectedPackages     = old('tour_package_ids', $blog->tourPackages->pluck('id')->toArray());
@endphp

<div style="padding:24px;">

    {{-- General --}}
    <div class="section-card">
        <h3>General</h3>

        <div class="form-row">
            <div class="form-field">
                <label for="blog_category_id">Category <span class="req">*</span></label>
                <select id="blog_category_id" name="blog_category_id" class="form-control-styled" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('blog_category_id', $blog->blog_category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('blog_category_id')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-field">
                <label for="tag">Tag</label>
                <input type="text" id="tag" name="tag" class="form-control-styled"
                    value="{{ old('tag', $blog->tag) }}" placeholder="e.g. Travel Guide, Adventure">
            </div>
        </div>

        <div class="form-row">
            <div class="form-field">
                <label for="title">Title <span class="req">*</span></label>
                <input type="text" id="title" name="title" class="form-control-styled @error('title') is-invalid @enderror"
                    value="{{ old('title', $blog->title) }}" required>
                @error('title')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-field">
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" class="form-control-styled @error('slug') is-invalid @enderror"
                    value="{{ old('slug', $blog->slug) }}" placeholder="auto-generated from title">
                @error('slug')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-field">
            <label for="short_description">Short Description</label>
            <textarea id="short_description" name="short_description" rows="2" class="form-control-styled"
                placeholder="Shown on listing cards">{{ old('short_description', $blog->short_description) }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-field">
                <label for="published_at">Published Date</label>
                <input type="date" id="published_at" name="published_at" class="form-control-styled"
                    value="{{ old('published_at', $blog->published_at?->format('Y-m-d')) }}">
            </div>

            <div class="form-field">
                <label for="status">Status <span class="req">*</span></label>
                <select id="status" name="status" class="form-control-styled" required>
                    <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Featured Image --}}
    <div class="section-card">
        <h3>Featured Image</h3>
        <div class="form-field">
            <input type="file" name="featured_image" class="form-control-styled" accept="image/*" style="height:auto;padding:8px 12px;">
            @error('featured_image')<div class="form-error">{{ $message }}</div>@enderror
            @if($blog->featured_image)
                <img src="{{ $blog->featured_image_url }}" class="img-preview" alt="{{ $blog->title }}">
            @endif
        </div>
    </div>

    {{-- Content --}}
    <div class="section-card">
        <h3>Content</h3>
        <div class="form-field">
            <textarea id="content" name="content" rows="10" class="form-control-styled ckeditor">{{ old('content', $blog->content) }}</textarea>
        </div>
    </div>

    {{-- Related: Destinations --}}
    <div class="section-card">
        <h3>Related Destinations</h3>
        <div class="form-row">
            <div class="form-field">
                <label>Heading</label>
                <input type="text" name="destination_heading" class="form-control-styled"
                    value="{{ old('destination_heading', $blog->destination_heading) }}" placeholder="e.g. Explore Popular Destinations">
            </div>
            <div class="form-field">
                <label>Description</label>
                <input type="text" name="destination_description" class="form-control-styled"
                    value="{{ old('destination_description', $blog->destination_description) }}">
            </div>
        </div>
        <div class="checkbox-list">
            @forelse($destinations as $destination)
                <label class="checkbox-item">
                    <input type="checkbox" name="destination_ids[]" value="{{ $destination->id }}"
                        {{ in_array($destination->id, $selectedDestinations) ? 'checked' : '' }}>
                    {{ $destination->name }}
                </label>
            @empty
                <p class="hint">No destinations found.</p>
            @endforelse
        </div>
    </div>

    {{-- Related: Attractions --}}
    <div class="section-card">
        <h3>Related Attractions</h3>
        <div class="form-row">
            <div class="form-field">
                <label>Heading</label>
                <input type="text" name="attraction_heading" class="form-control-styled"
                    value="{{ old('attraction_heading', $blog->attraction_heading) }}">
            </div>
            <div class="form-field">
                <label>Description</label>
                <input type="text" name="attraction_description" class="form-control-styled"
                    value="{{ old('attraction_description', $blog->attraction_description) }}">
            </div>
        </div>
        <div class="checkbox-list">
            @forelse($attractions as $attraction)
                <label class="checkbox-item">
                    <input type="checkbox" name="attraction_ids[]" value="{{ $attraction->id }}"
                        {{ in_array($attraction->id, $selectedAttractions) ? 'checked' : '' }}>
                    {{ $attraction->name }}
                </label>
            @empty
                <p class="hint">No attractions found.</p>
            @endforelse
        </div>
    </div>

    {{-- Related: Activities --}}
    <div class="section-card">
        <h3>Related Activities</h3>
        <div class="form-row">
            <div class="form-field">
                <label>Heading</label>
                <input type="text" name="activity_heading" class="form-control-styled"
                    value="{{ old('activity_heading', $blog->activity_heading) }}">
            </div>
            <div class="form-field">
                <label>Description</label>
                <input type="text" name="activity_description" class="form-control-styled"
                    value="{{ old('activity_description', $blog->activity_description) }}">
            </div>
        </div>
        <div class="checkbox-list">
            @forelse($activities as $activity)
                <label class="checkbox-item">
                    <input type="checkbox" name="activity_ids[]" value="{{ $activity->id }}"
                        {{ in_array($activity->id, $selectedActivities) ? 'checked' : '' }}>
                    {{ $activity->name }}
                </label>
            @empty
                <p class="hint">No activities found.</p>
            @endforelse
        </div>
    </div>

    {{-- Related: Tour Packages --}}
    <div class="section-card">
        <h3>Related Tour Packages</h3>
        <div class="form-row">
            <div class="form-field">
                <label>Heading</label>
                <input type="text" name="tour_package_heading" class="form-control-styled"
                    value="{{ old('tour_package_heading', $blog->tour_package_heading) }}">
            </div>
            <div class="form-field">
                <label>Description</label>
                <input type="text" name="tour_package_description" class="form-control-styled"
                    value="{{ old('tour_package_description', $blog->tour_package_description) }}">
            </div>
        </div>
        <div class="checkbox-list">
            @forelse($tourPackages as $package)
                <label class="checkbox-item">
                    <input type="checkbox" name="tour_package_ids[]" value="{{ $package->id }}"
                        {{ in_array($package->id, $selectedPackages) ? 'checked' : '' }}>
                    {{ $package->name }}
                </label>
            @empty
                <p class="hint">No tour packages found.</p>
            @endforelse
        </div>
    </div>

    {{-- SEO --}}
    <div class="section-card">
        <h3>SEO</h3>

        <div class="form-row">
            <div class="form-field">
                <label>H1</label>
                <input type="text" name="h1" class="form-control-styled" value="{{ old('h1', $blog->h1) }}">
            </div>
            <div class="form-field">
                <label>Meta Title</label>
                <input type="text" name="meta_title" class="form-control-styled" value="{{ old('meta_title', $blog->meta_title) }}">
            </div>
        </div>

        <div class="form-field">
            <label>Meta Description</label>
            <textarea name="meta_description" rows="2" class="form-control-styled">{{ old('meta_description', $blog->meta_description) }}</textarea>
        </div>

        <div class="form-field">
            <label>Canonical URL</label>
            <input type="text" name="canonical_url" class="form-control-styled"
                value="{{ old('canonical_url', $blog->canonical_url) }}" placeholder="{{ url('/blog/' . ($blog->slug ?: '{slug}') . '/') }}">
            @error('canonical_url')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-row">
            <div class="form-field">
                <label>OG Title</label>
                <input type="text" name="og_title" class="form-control-styled" value="{{ old('og_title', $blog->og_title) }}">
            </div>
            <div class="form-field">
                <label>Robots</label>
                <input type="text" name="robots" class="form-control-styled" value="{{ old('robots', $blog->robots ?: 'index,follow') }}">
            </div>
        </div>

        <div class="form-field">
            <label>OG Description</label>
            <textarea name="og_description" rows="2" class="form-control-styled">{{ old('og_description', $blog->og_description) }}</textarea>
        </div>

        <div class="form-row">
            <div class="form-field">
                <label>OG Image</label>
                <input type="file" name="og_image" class="form-control-styled" accept="image/*" style="height:auto;padding:8px 12px;">
                @if($blog->og_image)
                    <img src="{{ asset($blog->og_image) }}" class="img-preview" alt="OG image">
                @endif
            </div>
            <div class="form-field">
                <label>Twitter Card Image</label>
                <input type="file" name="twitter_card_image" class="form-control-styled" accept="image/*" style="height:auto;padding:8px 12px;">
                @if($blog->twitter_card_image)
                    <img src="{{ asset($blog->twitter_card_image) }}" class="img-preview" alt="Twitter card image">
                @endif
            </div>
        </div>
    </div>

</div>

<div class="form-actions">
    <button type="submit" class="btn-primary-dash">
        <i class="fa fa-check"></i> {{ $submitText ?? 'Save' }}
    </button>
    <a href="{{ route('admin.blog.index') }}" class="btn-secondary-dash">Cancel</a>
</div>

@push('scripts')
<script>
    if (typeof CKEDITOR !== 'undefined' && document.getElementById('content')) {
        CKEDITOR.replace('content');
    }
</script>
@endpush