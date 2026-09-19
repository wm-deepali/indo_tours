{{-- resources/views/admin/amenity/edit.blade.php --}}
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
        .form-control-styled:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48, 61, 137, .12); }
        .form-error { color: #b22222; font-size: 12px; margin-top: 5px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .form-body { padding: 24px; }
        .form-actions { display: flex; gap: 10px; padding: 20px 24px; border-top: 1px solid var(--border); background: var(--surface); }
        .checkbox-row { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--text-primary); }
        .checkbox-row input { width: auto; height: auto; }
        .icon-preview { width: 48px; height: 48px; object-fit: contain; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 4px; background: var(--bg); margin-bottom: 8px; display: block; }

        .cat-toolbar { display: flex; gap: 10px; padding: 16px 20px; border-bottom: 1px solid var(--border); }
        .cat-toolbar .form-control-styled { max-width: 280px; }
        .cat-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
        .cat-table th { text-align: left; padding: 12px 20px; font-size: 12px; font-weight: 600; color: var(--text-secondary); background: var(--bg); text-transform: uppercase; letter-spacing: .04em; }
        .cat-table td { padding: 12px 20px; border-top: 1px solid var(--border); vertical-align: middle; }
        .cat-table img.thumb { width: 36px; height: 36px; object-fit: contain; }
        .badge-status { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
        .badge-on { background: #e3f5e8; color: #1e7a3c; }
        .badge-off { background: #f1f2f4; color: var(--text-secondary); }
        .btn-icon { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border: 1px solid var(--border); border-radius: var(--radius-sm); background: var(--surface); color: var(--text-secondary); cursor: pointer; text-decoration: none; }
        .btn-icon:hover { background: var(--bg); }
        .btn-icon.danger:hover { color: #b22222; border-color: #b22222; }
        .alert-ok { background: #e3f5e8; color: #1e7a3c; border: 1px solid #bfe5c9; border-radius: var(--radius-sm); padding: 10px 14px; font-size: 13px; margin-bottom: 16px; }
        .empty-row { text-align: center; color: var(--text-hint); padding: 32px 0 !important; }
        .cat-pagination { padding: 14px 20px; border-top: 1px solid var(--border); }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Edit Amenity</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.amenities.index') }}">Amenities</a>
                        <span>›</span>
                        Edit
                    </div>
                </div>
                <a href="{{ route('admin.amenities.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.amenities.update', $amenity) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-body">

                        <div class="form-field">
                            <label for="name">Amenity Name</label>
                            <input type="text" id="name" name="name"
                                class="form-control-styled @error('name') is-invalid @enderror"
                                value="{{ old('name', $amenity->name) }}" required>
                            @error('name')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label for="icon">Icon Image</label>
                            @if($amenity->icon)
                                <img src="{{ $amenity->icon_url }}" alt="{{ $amenity->name }}" class="icon-preview">
                            @endif
                            <input type="file" id="icon" name="icon" class="form-control-styled" accept="image/*">
                            <div class="hint">Leave blank to keep the current icon — PNG / JPG / WEBP, max 1MB</div>
                            @error('icon')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="sort_order">Sort Order</label>
                                <input type="number" min="0" id="sort_order" name="sort_order"
                                    class="form-control-styled" value="{{ old('sort_order', $amenity->sort_order) }}">
                                <div class="hint">Lower numbers appear first</div>
                                @error('sort_order')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-field">
                                <label>Status</label>
                                <input type="hidden" name="is_active" value="0">
                                <label class="checkbox-row" style="margin-top:10px;">
                                    <input type="checkbox" name="is_active" value="1"
                                        {{ old('is_active', $amenity->is_active) ? 'checked' : '' }}>
                                    Active (available to select in Tour Packages)
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Update Amenity
                        </button>
                        <a href="{{ route('admin.amenities.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@include('admin.footer')