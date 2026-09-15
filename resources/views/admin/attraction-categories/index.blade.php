@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        :root {
            --bg: #f1f2f4; --surface: #ffffff; --border: #e3e5e8;
            --text-primary: #202223; --text-secondary: #6d7175; --text-hint: #8c9196;
            --accent: #303d89; --radius-sm: 8px; --radius-md: 12px;
            --shadow-card: 0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
            --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        .cat-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); box-sizing: border-box; }
        .cat-page * { box-sizing: border-box; }
        .cat-page-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .cat-page-header h1 { font-size: 20px; font-weight: 650; margin: 0; }
        .cat-breadcrumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
        .cat-breadcrumb a { color: var(--accent); text-decoration: none; }
        .cat-breadcrumb span { margin: 0 5px; }
        .btn-primary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff !important; border: none; border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; box-shadow: 0 1px 3px rgba(48,61,137,.25); }
        .btn-primary-dash:hover { background: #252f70; }
        .btn-secondary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 7px 14px; font-size: 12.5px; font-weight: 500; cursor: pointer; text-decoration: none !important; }
        .btn-secondary-dash:hover { background: var(--bg); }
        .cat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; }
        table.cat-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
        table.cat-table th { text-align: left; padding: 12px 20px; font-size: 11.5px; text-transform: uppercase; letter-spacing: .04em; color: var(--text-hint); border-bottom: 1px solid var(--border); background: var(--bg); }
        table.cat-table td { padding: 12px 20px; border-bottom: 1px solid var(--border); vertical-align: middle; }
        table.cat-table tr:last-child td { border-bottom: none; }
        .thumb { width: 48px; height: 34px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border); }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
        .badge-published { background: #e3f6e8; color: #1e7e34; }
        .badge-draft { background: #f1f2f4; color: var(--text-secondary); }
        .row-actions { display: flex; gap: 8px; }
        .row-actions form { display: inline; }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Attraction Categories</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Content Manage
                        <span>›</span>
                        Attraction Categories
                    </div>
                </div>
                <a href="{{ route('admin.attraction-categories.create') }}" class="btn-primary-dash">
                    <i class="fa fa-plus"></i> Add Category
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-info" style="margin-bottom:16px;">{{ session('success') }}</div>
            @endif

            <div class="cat-card">
                <table class="cat-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Sort Order</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" class="thumb" alt="{{ $category->name }}">
                                    @else
                                        <span style="color:var(--text-hint);">—</span>
                                    @endif
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <span class="badge {{ $category->status === 'published' ? 'badge-published' : 'badge-draft' }}">
                                        {{ ucfirst($category->status) }}
                                    </span>
                                </td>
                                <td>{{ $category->sort_order }}</td>
                                <td>
                                    <div class="row-actions" style="justify-content:flex-end;">
                                        <a href="{{ route('admin.attraction-categories.edit', $category) }}" class="btn-secondary-dash">
                                            <i class="fa fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.attraction-categories.destroy', $category) }}" method="POST"
                                            onsubmit="return confirm('Delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-secondary-dash">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center; color:var(--text-hint); padding:32px;">
                                    No attraction categories yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@include('admin.footer')