{{-- resources/views/admin/settings/seo-index.blade.php --}}
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
    .cat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); padding: 0; overflow: hidden; }
    .dest-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
    .dest-table thead th { text-align: left; font-size: 11.5px; font-weight: 650; text-transform: uppercase; letter-spacing: .03em; color: var(--text-hint); padding: 12px 16px; border-bottom: 1px solid var(--border); background: var(--bg); }
    .dest-table tbody td { padding: 12px 16px; border-bottom: 1px solid var(--border); vertical-align: middle; }
    .dest-table tbody tr:last-child td { border-bottom: none; }
    .dest-name { font-weight: 600; }
    .dest-location { font-size: 12px; color: var(--text-secondary); }
    .badge-status { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 11.5px; font-weight: 600; }
    .badge-set { background: #e3f6e5; color: #1e7e34; }
    .badge-empty { background: #f8e3e3; color: #b22222; }
    .row-actions { display: flex; gap: 8px; }
    .row-actions a, .row-actions button { border: 1px solid var(--border); background: var(--surface); border-radius: var(--radius-sm); padding: 6px 10px; font-size: 12.5px; cursor: pointer; text-decoration: none; color: var(--text-primary); }
    .empty-state { padding: 60px 20px; text-align: center; color: var(--text-hint); }
    .info-banner { display: flex; gap: 10px; align-items: flex-start; background: var(--accent-light); border: 1px solid rgba(48,61,137,.15); border-radius: var(--radius-sm); padding: 12px 16px; font-size: 13px; color: var(--text-primary); margin-bottom: 20px; }
    .info-banner.green { background: #f0fff4; border-color: #b7ebc8; }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>SEO Settings</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        SEO Settings
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="info-banner green">
                    <i class="fa-solid fa-circle-check"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <div class="info-banner">
                <i class="fa-solid fa-circle-info"></i>
                <div>Set Meta, Open Graph, and Twitter Card values for each static page below.</div>
            </div>

            <div class="cat-card">
                <table class="dest-table">
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th>Meta Title</th>
                            <th>Status</th>
                            <th style="text-align:right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($seo_settings as $seo)
                            <tr>
                                <td>
                                    <div class="dest-name">{{ $seo->page_label }}</div>
                                    <div class="dest-location">{{ $seo->page_key }}</div>
                                </td>
                                <td>
                                    <div class="dest-location">{{ $seo->meta_title ?: '—' }}</div>
                                </td>
                                <td>
                                    @if($seo->meta_title)
                                        <span class="badge-status badge-set">Configured</span>
                                    @else
                                        <span class="badge-status badge-empty">Not Set</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="row-actions" style="justify-content:flex-end">
                                        <a href="{{ route('admin.seo-setting.edit', $seo) }}">
                                            <i class="fa fa-pen"></i> Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">No pages found. Run the SeoSettingSeeder to populate default pages.</div>
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