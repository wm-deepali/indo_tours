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

    {{-- Journey Stories (blog listing page top slider) --}}
    <div class="section-card">
        <h3>Journey Stories</h3>

        <div class="form-row">
            <div class="form-field">
                <label for="card_title">Card Title (short)</label>
                <input type="text" id="card_title" name="card_title" class="form-control-styled"
                    value="{{ old('card_title', $blog->card_title) }}" placeholder="e.g. Manali (blank = blog title)">
                @error('card_title')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-field">
                <label for="journey_sort_order">Journey Order</label>
                <input type="number" id="journey_sort_order" name="journey_sort_order" min="0" class="form-control-styled"
                    value="{{ old('journey_sort_order', $blog->journey_sort_order ?? 0) }}">
                @error('journey_sort_order')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-field">
            <label class="checkbox-item">
                <input type="hidden" name="is_journey_story" value="0">
                <input type="checkbox" name="is_journey_story" value="1"
                    {{ old('is_journey_story', $blog->is_journey_story ?? false) ? 'checked' : '' }}>
                Show in Journey Stories slider
            </label>
            <div class="hint">The card's second line uses the blog's Tag field above.</div>
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
                <label for="h1">H1</label>
                <input type="text" id="h1" name="h1" class="form-control-styled" value="{{ old('h1', $blog->h1) }}">
                <div class="hint">Auto-filled from Title. Edit to override</div>
            </div>
            <div class="form-field">
                <label for="meta_title">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title" class="form-control-styled" value="{{ old('meta_title', $blog->meta_title) }}">
                <div class="hint">Auto-filled: Title | Site Name (ideal under 60 characters)</div>
            </div>
        </div>

        <div class="form-field">
            <label for="meta_description">Meta Description</label>
            <textarea id="meta_description" name="meta_description" rows="2" class="form-control-styled">{{ old('meta_description', $blog->meta_description) }}</textarea>
            <div class="hint">Auto-filled from Short Description / Content (ideal under 160 characters)</div>
        </div>

        <div class="form-field">
            <label for="canonical_url">Canonical URL</label>
            <input type="text" id="canonical_url" name="canonical_url" class="form-control-styled"
                value="{{ old('canonical_url', $blog->canonical_url) }}">
            <div class="hint">Auto-generated from slug. Edit only if the page lives at a different URL</div>
            @error('canonical_url')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-row">
            <div class="form-field">
                <label for="og_title">OG Title</label>
                <input type="text" id="og_title" name="og_title" class="form-control-styled" value="{{ old('og_title', $blog->og_title) }}">
                <div class="hint">Follows Meta Title. Edit to override</div>
            </div>
            <div class="form-field">
                <label for="robots">Robots</label>
                <input type="text" id="robots" name="robots" class="form-control-styled" value="{{ old('robots', $blog->robots ?: 'index,follow') }}">
            </div>
        </div>

        <div class="form-field">
            <label for="og_description">OG Description</label>
            <textarea id="og_description" name="og_description" rows="2" class="form-control-styled">{{ old('og_description', $blog->og_description) }}</textarea>
            <div class="hint">Follows Meta Description. Edit to override</div>
        </div>

        <div class="form-row">
            <div class="form-field">
                <label>OG Image</label>
                <input type="file" name="og_image" class="form-control-styled" accept="image/*" style="height:auto;padding:8px 12px;">
                <div class="hint">Leave blank to use the Featured Image{{ $blog->og_image ? ' (current image kept)' : '' }}</div>
                @if($blog->og_image)
                    <img src="{{ asset($blog->og_image) }}" class="img-preview" alt="OG image">
                @endif
            </div>
            <div class="form-field">
                <label>Twitter Card Image</label>
                <input type="file" name="twitter_card_image" class="form-control-styled" accept="image/*" style="height:auto;padding:8px 12px;">
                <div class="hint">Leave blank to use the OG Image / Featured Image{{ $blog->twitter_card_image ? ' (current image kept)' : '' }}</div>
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
(function () {
    const SITE = @json(config('app.name'));
    const BASE = @json(url('/blog'));   // change if your blog URL prefix differs

    let editor = null;
    if (typeof CKEDITOR !== 'undefined' && document.getElementById('content')) {
        editor = CKEDITOR.replace('content');
    }

    const g   = id => document.getElementById(id);
    const val = id => ((g(id) && g(id).value) || '').trim();
    const plain = html => {
        const t = document.createElement('div');
        t.innerHTML = html || '';
        return (t.textContent || '').replace(/\s+/g, ' ').trim();
    };
    const clip = (s, n) => s.length <= n ? s : s.slice(0, n - 1).replace(/\s+\S*$/, '') + '…';
    const slugify = s => s.toLowerCase().trim()
        .replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');

    const rules = {
        h1: () => val('title'),
        meta_title: () => {
            const t = val('title');
            return t ? clip(SITE ? t + ' | ' + SITE : t, 60) : '';
        },
        meta_description: () => {
            const t = val('title');
            const body = val('short_description') || plain(editor ? editor.getData() : val('content'));
            return clip(body || (t ? 'Read ' + t + ' on our travel blog.' : ''), 160);
        },
        canonical_url: () => {
            const s = val('slug') || slugify(val('title'));
            return s ? BASE.replace(/\/$/, '') + '/' + s + '/' : '';
        },
        og_title: () => val('meta_title'),
        og_description: () => val('meta_description'),
    };
    const order  = Object.keys(rules);
    const manual = {};

    function refresh() {
        order.forEach(id => {
            if (manual[id]) return;
            const el = g(id);
            if (el) el.value = rules[id]();
        });
    }

    // Init: empty -> fill. Non-empty and different from auto -> user's own value, keep it.
    order.forEach(id => {
        const el = g(id);
        if (!el) return;
        const auto = rules[id]();
        if (!el.value.trim()) { el.value = auto; manual[id] = false; }
        else { manual[id] = el.value.trim() !== auto; }

        el.addEventListener('input', () => {
            manual[id] = el.value.trim() !== '';   // cleared -> back to auto
            refresh();
        });
    });

    ['title', 'slug', 'short_description'].forEach(id => {
        if (g(id)) g(id).addEventListener('input', refresh);
    });
    if (editor) editor.on('change', refresh);

    g('title').closest('form').addEventListener('submit', function () {
        if (typeof CKEDITOR !== 'undefined') Object.keys(CKEDITOR.instances).forEach(k => CKEDITOR.instances[k].updateElement());
        refresh();
    }, true);
})();
</script>
@endpush