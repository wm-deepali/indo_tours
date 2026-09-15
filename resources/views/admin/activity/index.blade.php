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

        .btn-icon-dash {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--text-secondary) !important;
            text-decoration: none !important;
            cursor: pointer;
        }

        .btn-icon-dash:hover {
            background: var(--bg);
        }

        .btn-icon-dash.danger:hover {
            background: #fdecec;
            color: #b22222 !important;
            border-color: #f3c6c6;
        }

        .cat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        table.list-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }

        table.list-table th {
            text-align: left;
            font-size: 11.5px;
            font-weight: 650;
            text-transform: uppercase;
            letter-spacing: .03em;
            color: var(--text-hint);
            padding: 12px 20px;
            border-bottom: 1px solid var(--border);
            background: var(--bg);
        }

        table.list-table td {
            padding: 12px 20px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        table.list-table tr:last-child td {
            border-bottom: none;
        }

        .thumb {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            object-fit: cover;
            border: 1px solid var(--border);
        }

        .thumb-placeholder {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            background: var(--bg);
            border: 1px solid var(--border);
        }

        .name-cell strong {
            display: block;
            font-weight: 600;
        }

        .name-cell span {
            font-size: 12px;
            color: var(--text-hint);
        }

        .badge {
            display: inline-block;
            font-size: 11.5px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 999px;
        }

        .badge-published {
            background: #e6f4ea;
            color: #1e7e34;
        }

        .badge-draft {
            background: #fff4e0;
            color: #a06400;
        }

        .badge-unpublished {
            background: #f1f2f4;
            color: #6d7175;
        }

        .badge-category {
            background: #eef0fb;
            color: var(--accent);
        }

        .text-muted-cell {
            color: var(--text-hint);
        }

        .row-actions {
            display: flex;
            gap: 8px;
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: var(--text-hint);
        }

        .pagination-wrap {
            padding: 16px 20px;
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <h1>Activities</h1>
                <a href="{{ route('admin.activities.create') }}" class="btn-primary-dash">
                    <i class="fa fa-plus"></i> Add Activity
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success" style="margin-bottom:16px;">{{ session('success') }}</div>
            @endif

            <div class="cat-card">
                @if($activities->isEmpty())
                    <div class="empty-state">No activities yet — click "Add Activity" to create one.</div>
                @else
                    <table class="list-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Starting Price</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activities as $activity)
                                <tr>
                                    <td>
                                        @if($activity->main_image)
                                            <img src="{{ asset('storage/' . $activity->main_image) }}" class="thumb" alt="">
                                        @else
                                            <div class="thumb-placeholder"></div>
                                        @endif
                                    </td>
                                    <td class="name-cell">
                                        <strong>{{ $activity->name }}</strong>
                                        <span>{{ $activity->slug }}</span>
                                    </td>
                                    <td>
                                        @if($activity->category)
                                            <span class="badge badge-category">{{ $activity->category->name }}</span>
                                        @else
                                            <span class="text-muted-cell">—</span>
                                        @endif
                                    </td>
                                    <td>{{ $activity->city->name ?? $activity->state->name ?? $activity->country->name ?? '—' }}</td>
                                    <td>
                                        @if($activity->starting_price)
                                            ₹ {{ number_format($activity->starting_price) }}
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>{{ $activity->rating ?? '—' }} @if($activity->review_count) <span style="color:var(--text-hint)">({{ $activity->review_count }})</span>@endif</td>
                                    <td>
                                        <span class="badge badge-{{ $activity->status }}">{{ ucfirst($activity->status) }}</span>
                                    </td>
                                    <td>
                                        <div class="row-actions">
                                            <a href="{{ route('admin.activities.edit', $activity) }}" class="btn-icon-dash" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST"
                                                onsubmit="return confirm('Delete this activity? This cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-icon-dash danger" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="pagination-wrap">
                        {{ $activities->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

@include('admin.footer')