{{-- resources/views/admin/pages/index.blade.php --}}
@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
    :root {
        --bg: #f1f2f4; --surface: #ffffff; --border: #e3e5e8;
        --text-primary: #202223; --text-secondary:#6d7175; --text-hint:#8c9196;
        --accent: #303d89;
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
    .cat-breadcrumb span { margin: 0 5px; }
    .btn-primary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff !important; border: none; border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; }
    .btn-primary-dash:hover { background: #252f70; }
    .btn-secondary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none !important; }
    .btn-secondary-dash:hover { background: var(--bg); }
    .btn-danger-dash { display: inline-flex; align-items: center; gap: 6px; background: #fff; color: #b22222 !important; border: 1px solid #f3caca; border-radius: var(--radius-sm); padding: 7px 12px; font-size: 12.5px; font-weight: 500; cursor: pointer; }
    .btn-danger-dash:hover { background: #fdf2f2; }
    .cat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; }
    table.cat-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
    table.cat-table th { text-align: left; padding: 12px 20px; font-size: 12px; font-weight: 650; color: var(--text-secondary); text-transform: uppercase; letter-spacing: .03em; border-bottom: 1px solid var(--border); background: var(--bg); }
    table.cat-table td { padding: 14px 20px; border-bottom: 1px solid var(--border); vertical-align: middle; }
    table.cat-table tr:last-child td { border-bottom: none; }
    .page-title-cell { font-weight: 600; }
    .page-slug-cell { color: var(--text-hint); font-size: 12.5px; }
    .status-pill { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
    .status-pill.active { background: #e3f5e6; color: #1c7c34; }
    .status-pill.inactive { background: #f1f2f4; color: var(--text-hint); }
    .row-actions { display: flex; gap: 8px; align-items: center; }
    .empty-state { padding: 60px 20px; text-align: center; color: var(--text-hint); }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Dynamic Pages</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Pages
                    </div>
                </div>
                <a href="{{ route('admin.pages.create') }}" class="btn-primary-dash">
                    <i class="fa fa-plus"></i> Add Page
                </a>
            </div>

            @if(session('success'))
            <div class="alert alert-info" style="margin-bottom:16px;">{{ session('success') }}</div>
            @endif

            <div class="cat-card">
                @if($pages->count())
                <table class="cat-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                        <tr>
                            <td>
                                <div class="page-title-cell">{{ $page->title }}</div>
                                <div class="page-slug-cell">/{{ $page->slug }}</div>
                            </td>
                            <td>
                                @if($page->is_active)
                                    <span class="status-pill active">Active</span>
                                @else
                                    <span class="status-pill inactive">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $page->updated_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn-secondary-dash">
                                        <i class="fa fa-pen"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST"
                                        onsubmit="return confirm('Delete this page? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger-dash">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="padding: 16px 20px;">
                    {{ $pages->links() }}
                </div>
                @else
                <div class="empty-state">
                    No pages yet. <a href="{{ route('admin.pages.create') }}">Create your first page</a>.
                </div>
                @endif
            </div>

        </div>
    </div>
</div>

@include('admin.footer')