{{-- resources/views/admin/category/index.blade.php --}}
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

        .cat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            padding: 0;
            overflow: hidden;
        }

        .dest-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        .dest-table thead th {
            text-align: left;
            font-size: 11.5px;
            font-weight: 650;
            text-transform: uppercase;
            letter-spacing: .03em;
            color: var(--text-hint);
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            background: var(--bg);
        }

        .dest-table tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .dest-table tbody tr:last-child td {
            border-bottom: none;
        }

        .dest-thumb {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            border: 1px solid var(--border);
        }

        .dest-name {
            font-weight: 600;
        }

        .dest-location {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .badge-status {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 600;
        }

        .badge-published {
            background: #e3f6e5;
            color: #1e7e34;
        }

        .badge-draft {
            background: #f0f1fc;
            color: var(--accent);
        }

        .badge-unpublished {
            background: #f8e3e3;
            color: #b22222;
        }

        .row-actions {
            display: flex;
            gap: 8px;
        }

        .row-actions a,
        .row-actions button {
            border: 1px solid var(--border);
            background: var(--surface);
            border-radius: var(--radius-sm);
            padding: 6px 10px;
            font-size: 12.5px;
            cursor: pointer;
            text-decoration: none;
            color: var(--text-primary);
        }

        .row-actions .delete-btn {
            color: #b22222;
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: var(--text-hint);
        }

        .pagination-wrap {
            padding: 16px;
            border-top: 1px solid var(--border);
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Categories</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Categories
                    </div>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="btn-primary-dash">
                    <i class="fa fa-plus"></i> Add Category
                </a>
            </div>

            <div class="cat-card">
                <table class="dest-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Menu Name</th>
                            <th>Heading</th>
                            <th>Status</th>
                            <th style="text-align:right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" class="dest-thumb"
                                            alt="{{ $category->name }}">
                                    @else
                                        <div class="dest-thumb"
                                            style="display:flex;align-items:center;justify-content:center;background:var(--bg);color:var(--text-hint);font-size:10px;">
                                            N/A</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="dest-name">{{ $category->name }}</div>
                                    <div class="dest-location">{{ Str::limit($category->short_description, 50) }}</div>
                                </td>
                                <td>{{ $category->menu_name ?? '—' }}</td>
                                <td>{{ $category->heading ?? '—' }}</td>
                                <td>
                                    <span class="badge-status badge-{{ $category->status }}">
                                        {{ ucfirst($category->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="row-actions" style="justify-content:flex-end">
                                        <a href="{{ route('admin.categories.edit', $category) }}">
                                            <i class="fa fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                            onsubmit="return confirm('Delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">No categories added yet.</div>
                                </td>
                            </tr>
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

@include('admin.footer')