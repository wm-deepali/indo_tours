{{-- resources/views/admin/blog-category/edit.blade.php --}}
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
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .form-actions { display: flex; gap: 10px; padding: 20px 24px; border-top: 1px solid var(--border); background: var(--surface); }
    .form-check-switch { display: flex; align-items: center; gap: 8px; }
    .img-preview { margin-top: 10px; border-radius: 8px; width: 140px; height: 100px; object-fit: cover; border: 1px solid var(--border); }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Edit Blog Category</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.blog-category.index') }}">Blog Categories</a>
                        <span>›</span>
                        Edit
                    </div>
                </div>
                <a href="{{ route('admin.blog-category.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.blog-category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div style="padding:24px;">

                        <div class="form-row">
                            <div class="form-field">
                                <label for="name">Category Name</label>
                                <input type="text" id="name" name="name"
                                    class="form-control-styled @error('name') is-invalid @enderror"
                                    value="{{ old('name', $category->name) }}" required>
                                @error('name')<div class="form-error">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-field">
                                <label for="slug">Slug</label>
                                <input type="text" id="slug" name="slug"
                                    class="form-control-styled @error('slug') is-invalid @enderror"
                                    value="{{ old('slug', $category->slug) }}">
                                @error('slug')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="subtitle">Subtitle</label>
                            <input type="text" id="subtitle" name="subtitle"
                                class="form-control-styled @error('subtitle') is-invalid @enderror"
                                value="{{ old('subtitle', $category->subtitle) }}">
                            @error('subtitle')<div class="form-error">{{ $message }}</div>@enderror
                            <div class="hint">Displayed under "Experience {{ old('name', $category->name) }}" on the blog page</div>
                        </div>

                        <div class="form-row">
                            <div class="form-field">
                                <label for="sort_order">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                    class="form-control-styled" value="{{ old('sort_order', $category->sort_order) }}">
                            </div>

                            <div class="form-field">
                                <label for="status">Status</label>
                                <div class="form-check-switch" style="height:40px;">
                                    <input type="checkbox" id="status" name="status" value="1"
                                        {{ old('status', $category->status) ? 'checked' : '' }}>
                                    <label for="status" style="margin:0;font-weight:500;font-size:13.5px;">Active</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" class="form-control-styled" accept="image/*" style="height:auto;padding:8px 12px;">
                            @error('image')<div class="form-error">{{ $message }}</div>@enderror
                            @if($category->image)
                                <img src="{{ $category->image_url }}" class="img-preview" alt="{{ $category->name }}">
                            @endif
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Update Category
                        </button>
                        <a href="{{ route('admin.blog-category.index') }}" class="btn-secondary-dash">Cancel</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@include('admin.footer')