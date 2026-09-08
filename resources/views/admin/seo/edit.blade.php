{{-- resources/views/admin/settings/seo-edit.blade.php --}}
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
    .cat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); padding: 20px 24px; }
    .info-banner { display: flex; gap: 10px; align-items: flex-start; background: var(--accent-light); border: 1px solid rgba(48,61,137,.15); border-radius: var(--radius-sm); padding: 12px 16px; font-size: 13px; color: var(--text-primary); margin-bottom: 20px; }
    .settings-section-title { font-size: 14px; font-weight: 650; display: flex; align-items: center; gap: 8px; margin-bottom: 4px; }
    .section-divider { border: none; border-top: 1px solid var(--border); margin: 24px 0; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 14px; }
    .field-group { display: flex; flex-direction: column; gap: 6px; }
    .field-group.col-full { grid-column: 1 / -1; }
    .field-label { font-size: 12.5px; font-weight: 600; color: var(--text-secondary); }
    .field-input, .field-select, .field-textarea { border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 9px 12px; font-size: 13.5px; font-family: var(--font); color: var(--text-primary); background: var(--surface); }
    .field-textarea { resize: vertical; }
    .field-hint { font-size: 11.5px; color: var(--text-hint); }
    .action-bar { display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px; }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Edit SEO — {{ $seo_setting->page_label }}</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.seo-setting.index') }}">SEO Settings</a>
                        <span>›</span>
                        {{ $seo_setting->page_label }}
                    </div>
                </div>
                <a href="{{ route('admin.seo-setting.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <form action="{{ route('admin.seo-setting.update', $seo_setting) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="cat-card">

                    <div class="info-banner">
                        <i class="fa-solid fa-circle-info"></i>
                        <div>These fields control search and social preview for the <strong>{{ $seo_setting->page_label }}</strong> page.</div>
                    </div>

                    <div class="settings-section-title"><i class="fa-solid fa-tag"></i> Meta Title &amp; Description</div>
                    <div class="form-grid">
                        <div class="field-group col-full">
                            <label class="field-label">Meta Title</label>
                            <input type="text" name="meta_title" class="field-input"
                                value="{{ old('meta_title', $seo_setting->meta_title) }}">
                        </div>
                        <div class="field-group col-full">
                            <label class="field-label">Meta Description</label>
                            <textarea name="meta_description" class="field-textarea" rows="3">{{ old('meta_description', $seo_setting->meta_description) }}</textarea>
                        </div>
                    </div>

                    <hr class="section-divider">

                    <div class="settings-section-title"><i class="fa-brands fa-facebook"></i> Open Graph</div>
                    <div class="form-grid">
                        <div class="field-group col-full">
                            <label class="field-label">OG Title</label>
                            <input type="text" name="og_title" class="field-input"
                                value="{{ old('og_title', $seo_setting->og_title) }}">
                        </div>
                        <div class="field-group col-full">
                            <label class="field-label">OG Description</label>
                            <textarea name="og_description" class="field-textarea" rows="3">{{ old('og_description', $seo_setting->og_description) }}</textarea>
                        </div>
                        <div class="field-group col-full">
                            <label class="field-label">OG Image</label>
                            <input type="file" name="og_image" class="field-input" accept="image/*">
                            @if($seo_setting->og_image)
                                <span class="field-hint">Current: {{ $seo_setting->og_image }}</span>
                            @endif
                        </div>
                    </div>

                    <hr class="section-divider">

                    <div class="settings-section-title"><i class="fa-brands fa-x-twitter"></i> Twitter Card</div>
                    <div class="form-grid">
                        <div class="field-group">
                            <label class="field-label">Card Type</label>
                            <select name="twitter_card_type" class="field-select">
                                <option value="summary_large_image" {{ old('twitter_card_type', $seo_setting->twitter_card_type) == 'summary_large_image' ? 'selected' : '' }}>Summary Large Image</option>
                                <option value="summary" {{ old('twitter_card_type', $seo_setting->twitter_card_type) == 'summary' ? 'selected' : '' }}>Summary</option>
                            </select>
                        </div>
                        <div class="field-group col-full">
                            <label class="field-label">Twitter Title</label>
                            <input type="text" name="twitter_title" class="field-input"
                                value="{{ old('twitter_title', $seo_setting->twitter_title) }}">
                        </div>
                        <div class="field-group col-full">
                            <label class="field-label">Twitter Description</label>
                            <textarea name="twitter_description" class="field-textarea" rows="3">{{ old('twitter_description', $seo_setting->twitter_description) }}</textarea>
                        </div>
                        <div class="field-group col-full">
                            <label class="field-label">Twitter Image</label>
                            <input type="file" name="twitter_image" class="field-input" accept="image/*">
                            @if($seo_setting->twitter_image)
                                <span class="field-hint">Current: {{ $seo_setting->twitter_image }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="action-bar">
                        <a href="{{ route('admin.seo-setting.index') }}" class="btn-secondary-dash">Cancel</a>
                        <button class="btn-primary-dash" type="submit">
                            <i class="fa fa-save"></i> Save
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

@include('admin.footer')