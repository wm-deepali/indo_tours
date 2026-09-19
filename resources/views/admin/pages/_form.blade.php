{{-- resources/views/admin/pages/_form.blade.php --}}
@csrf
@if(isset($page))
    @method('PUT')
@endif

<div style="padding:24px;">

    {{-- ============ CORE FIELDS ============ --}}
    <div class="section-card">
        <h3>Page Details</h3>

        <div class="form-row">
            <div class="form-field">
                <label for="title">Title <span class="req">*</span></label>
                <input type="text" id="title" name="title"
                    class="form-control-styled @error('title') is-invalid @enderror"
                    value="{{ old('title', $page->title ?? '') }}"
                    placeholder="e.g. About Us">
                @error('title')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-field">
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug"
                    class="form-control-styled @error('slug') is-invalid @enderror"
                    value="{{ old('slug', $page->slug ?? '') }}"
                    placeholder="e.g. about-us">
                <div class="hint">Leave blank to auto-generate from the title.</div>
                @error('slug')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-field">
            <label for="content">Content</label>
            <textarea id="content" name="content" rows="10"
                class="form-control-styled @error('content') is-invalid @enderror"
                placeholder="Page body content (HTML allowed)">{{ old('content', $page->content ?? '') }}</textarea>
            @error('content')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-field">
            <label style="display:flex; align-items:center; gap:8px; margin-bottom:0;">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" id="is_active" name="is_active" value="1"
                    {{ old('is_active', $page->is_active ?? true) ? 'checked' : '' }}>
                Active (visible on the site)
            </label>
        </div>
    </div>

    {{-- ============ SEO / META ============ --}}
    <div class="section-card">
        <h3>SEO &amp; Meta</h3>

        <div class="form-row">
            <div class="form-field">
                <label for="h1">H1 Heading</label>
                <input type="text" id="h1" name="h1"
                    class="form-control-styled @error('h1') is-invalid @enderror"
                    value="{{ old('h1', $page->h1 ?? '') }}"
                    placeholder="e.g. About Our Company">
                @error('h1')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-field">
                <label for="robots">Robots</label>
                <input type="text" id="robots" name="robots"
                    class="form-control-styled @error('robots') is-invalid @enderror"
                    value="{{ old('robots', $page->robots ?? 'index, follow') }}"
                    placeholder="e.g. index, follow">
                @error('robots')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-field">
            <label for="meta_title">Meta Title</label>
            <input type="text" id="meta_title" name="meta_title"
                class="form-control-styled @error('meta_title') is-invalid @enderror"
                value="{{ old('meta_title', $page->meta_title ?? '') }}"
                placeholder="Shown in browser tab / search results">
            @error('meta_title')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-field">
            <label for="meta_description">Meta Description</label>
            <textarea id="meta_description" name="meta_description" rows="3"
                class="form-control-styled @error('meta_description') is-invalid @enderror"
                placeholder="Short summary shown in search results">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
            @error('meta_description')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-field">
            <label for="canonical_url">Canonical URL</label>
            <input type="text" id="canonical_url" name="canonical_url"
                class="form-control-styled @error('canonical_url') is-invalid @enderror"
                value="{{ old('canonical_url', $page->canonical_url ?? '') }}"
                placeholder="https://example.com/about-us">
            @error('canonical_url')<div class="form-error">{{ $message }}</div>@enderror
        </div>
    </div>

    {{-- ============ OPEN GRAPH / TWITTER ============ --}}
    <div class="section-card">
        <h3>Social Sharing (Open Graph &amp; Twitter)</h3>

        <div class="form-field">
            <label for="og_title">OG Title</label>
            <input type="text" id="og_title" name="og_title"
                class="form-control-styled @error('og_title') is-invalid @enderror"
                value="{{ old('og_title', $page->og_title ?? '') }}"
                placeholder="Falls back to Meta Title if left blank">
            @error('og_title')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-field">
            <label for="og_description">OG Description</label>
            <textarea id="og_description" name="og_description" rows="3"
                class="form-control-styled @error('og_description') is-invalid @enderror"
                placeholder="Falls back to Meta Description if left blank">{{ old('og_description', $page->og_description ?? '') }}</textarea>
            @error('og_description')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <div class="form-row">
            <div class="form-field">
                <label for="og_image">OG Image</label>
                @if(!empty($page->og_image))
                    <img src="{{ asset('storage/' . $page->og_image) }}" class="img-preview" alt="">
                @endif
                <input type="file" id="og_image" name="og_image"
                    class="form-control-styled @error('og_image') is-invalid @enderror" accept="image/*">
                <div class="hint">Recommended 1200×630px. Leave blank to keep the current image.</div>
                @error('og_image')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-field">
                <label for="twitter_card_image">Twitter Card Image</label>
                @if(!empty($page->twitter_card_image))
                    <img src="{{ asset('storage/' . $page->twitter_card_image) }}" class="img-preview" alt="">
                @endif
                <input type="file" id="twitter_card_image" name="twitter_card_image"
                    class="form-control-styled @error('twitter_card_image') is-invalid @enderror" accept="image/*">
                <div class="hint">Recommended 1200×675px. Leave blank to keep the current image.</div>
                @error('twitter_card_image')<div class="form-error">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

</div>

<div class="form-actions">
    <button type="submit" class="btn-primary-dash">
        <i class="fa fa-check"></i> {{ $submitText }}
    </button>
    <a href="{{ route('admin.pages.index') }}" class="btn-secondary-dash">Cancel</a>
</div>