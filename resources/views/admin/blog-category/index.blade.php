{{-- resources/views/admin/blog-category/index.blade.php --}}
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
    .btn-primary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff !important; border: none; border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; box-shadow: 0 1px 3px rgba(48,61,137,.25); }
    .btn-primary-dash:hover { background: #252f70; }
    .btn-secondary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none !important; }
    .btn-secondary-dash:hover { background: var(--bg); }
    .cat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); max-width: 100vw; overflow: hidden; }
    .cat-toolbar { display: flex; gap: 10px; padding: 16px 20px; border-bottom: 1px solid var(--border); }
    .cat-toolbar input { flex: 1; max-width: 280px; height: 38px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 12px; font-size: 13.5px; font-family: var(--font); outline: none; }
    .cat-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
    .cat-table th { text-align: left; padding: 12px 16px; background: var(--bg); color: var(--text-secondary); font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: .03em; border-bottom: 1px solid var(--border); }
    .cat-table td { padding: 12px 16px; border-bottom: 1px solid var(--border); vertical-align: middle; }
    .cat-table tr:last-child td { border-bottom: none; }
    .thumb-img { width: 52px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border); }
    .badge-status { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
    .badge-active { background: #d3f5df; color: #146a3c; }
    .badge-inactive { background: #f3d3d3; color: #8a1f1f; }
    .icon-btn { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; border: 1px solid var(--border); background: var(--surface); color: var(--text-secondary); text-decoration: none; cursor: pointer; margin-right: 4px; }
    .icon-btn:hover { background: var(--bg); }
    .icon-btn.danger:hover { background: #fde8e8; color: #b22222; border-color: #f3c6c6; }
    .switch-toggle { position: relative; display: inline-block; width: 38px; height: 22px; }
    .switch-toggle input { opacity: 0; width: 0; height: 0; }
    .switch-slider { position: absolute; cursor: pointer; inset: 0; background: #ccc; border-radius: 22px; transition: .15s; }
    .switch-slider:before { content: ""; position: absolute; width: 16px; height: 16px; left: 3px; bottom: 3px; background: #fff; border-radius: 50%; transition: .15s; }
    .switch-toggle input:checked + .switch-slider { background: var(--accent); }
    .switch-toggle input:checked + .switch-slider:before { transform: translateX(16px); }
    .empty-row td { text-align: center; padding: 40px; color: var(--text-hint); }
    .pagination-wrap { padding: 14px 20px; }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <h1>Blog Categories</h1>
                <a href="{{ route('admin.blog-category.create') }}" class="btn-primary-dash">
                    <i class="fa fa-plus"></i> Add Category
                </a>
            </div>

            @if(session('success'))
                <div class="hint" style="color:#146a3c;margin-bottom:12px;">{{ session('success') }}</div>
            @endif

            <div class="cat-card">

                <div class="cat-toolbar">
                    <form method="GET" action="{{ route('admin.blog-category.index') }}" style="display:flex;gap:10px;width:100%;">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or slug">
                        <button type="submit" class="btn-secondary-dash">Search</button>
                    </form>
                </div>

                <table class="cat-table">
                    <thead>
                        <tr>
                            <th width="60">Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Subtitle</th>
                            <th width="80">Order</th>
                            <th width="90">Status</th>
                            <th width="110">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr id="row-{{ $category->id }}">
                                <td><img src="{{ $category->image_url }}" class="thumb-img" alt="{{ $category->name }}"></td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->subtitle ?: '—' }}</td>
                                <td>{{ $category->sort_order }}</td>
                                <td>
                                    <label class="switch-toggle">
                                        <input type="checkbox" class="status-toggle" data-id="{{ $category->id }}" {{ $category->status ? 'checked' : '' }}>
                                        <span class="switch-slider"></span>
                                    </label>
                                </td>
                                <td>
                                    <a href="{{ route('admin.blog-category.edit', $category->id) }}" class="icon-btn"><i class="fa fa-edit"></i></a>
                                    <button type="button" class="icon-btn danger delete-category" data-id="{{ $category->id }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row"><td colspan="7">No blog categories found.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="pagination-wrap">
                    {{ $categories->links() }}
                </div>

            </div>

        </div>
    </div>
</div>

<script>
document.querySelectorAll('.status-toggle').forEach(function (el) {
    el.addEventListener('change', function () {
        const checkbox = this;
        fetch("{{ route('admin.blog-category.status') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: checkbox.dataset.id })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.status) checkbox.checked = !checkbox.checked;
        })
        .catch(() => { checkbox.checked = !checkbox.checked; });
    });
});

document.querySelectorAll('.delete-category').forEach(function (btn) {
    btn.addEventListener('click', function () {
        if (!confirm('Delete this blog category permanently?')) return;
        const id = this.dataset.id;

        fetch(`{{ url('admin/blog-category') }}/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ _method: 'DELETE' })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status) {
                document.getElementById('row-' + id).remove();
            } else {
                alert(data.message);
            }
        });
    });
});
</script>

@include('admin.footer')