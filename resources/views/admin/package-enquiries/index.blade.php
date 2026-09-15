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

        .cat-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); box-sizing: border-box; }
        .cat-page * { box-sizing: border-box; }
        .cat-page-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .cat-page-header h1 { font-size: 20px; font-weight: 650; margin: 0; }
        .cat-breadcrumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
        .cat-breadcrumb a { color: var(--accent); text-decoration: none; }
        .cat-breadcrumb span { margin: 0 5px; }

        .cat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; }

        .filters-bar { display: flex; gap: 10px; padding: 16px 24px; border-bottom: 1px solid var(--border); flex-wrap: wrap; }
        .filters-bar .form-control-styled { height: 38px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 12px; font-size: 13.5px; font-family: var(--font); }
        .filters-bar select.form-control-styled { min-width: 160px; }
        .filters-bar input[type="text"] { min-width: 220px; }

        .btn-primary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff !important; border: none; border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; }
        .btn-secondary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 7px 14px; font-size: 12.5px; font-weight: 500; cursor: pointer; text-decoration: none !important; }

        table.enquiry-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
        table.enquiry-table th { text-align: left; padding: 12px 24px; background: var(--bg); color: var(--text-secondary); font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: .03em; }
        table.enquiry-table td { padding: 14px 24px; border-top: 1px solid var(--border); vertical-align: middle; }
        table.enquiry-table tr:hover td { background: #fafbfc; }

        .status-badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 11.5px; font-weight: 600; text-transform: capitalize; }
        .status-new { background: #e5edff; color: #303d89; }
        .status-contacted { background: #fff4e0; color: #9a6700; }
        .status-converted { background: #e3f9e5; color: #1a7f37; }
        .status-closed { background: #f1f2f4; color: #6d7175; }

        .row-actions { display: flex; gap: 8px; }
        .row-actions form { display: inline; }

        .empty-state { padding: 60px 24px; text-align: center; color: var(--text-hint); }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Package Enquiries</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Reports & Inquiries
                        <span>›</span>
                        Package Enquiries
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-info" style="margin-bottom:16px;">{{ session('success') }}</div>
            @endif

            <div class="cat-card">
                <form method="GET" class="filters-bar">
                    <input type="text" name="search" class="form-control-styled" placeholder="Search name, email, phone"
                        value="{{ request('search') }}">

                    <select name="status" class="form-control-styled">
                        <option value="">All Statuses</option>
                        @foreach(['new', 'contacted', 'converted', 'closed'] as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn-secondary-dash">Filter</button>
                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('admin.package-enquiries.index') }}" class="btn-secondary-dash">Reset</a>
                    @endif
                </form>

                @if($enquiries->isEmpty())
                    <div class="empty-state">No package enquiries found.</div>
                @else
                    <table class="enquiry-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Package</th>
                                <th>Contact</th>
                                <th>Travel Date</th>
                                <th>Travellers</th>
                                <th>Status</th>
                                <th>Received</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enquiries as $enquiry)
                                <tr>
                                    <td>{{ $enquiry->full_name }}</td>
                                    <td>{{ $enquiry->tourPackage->title ?? '—' }}</td>
                                    <td>
                                        {{ $enquiry->email }}<br>
                                        <span style="color:var(--text-hint)">{{ $enquiry->phone }}</span>
                                    </td>
                                    <td>{{ $enquiry->travel_date ? \Carbon\Carbon::parse($enquiry->travel_date)->format('d M Y') : '—' }}</td>
                                    <td>{{ $enquiry->traveller_count ?? '—' }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $enquiry->status }}">{{ $enquiry->status }}</span>
                                    </td>
                                    <td>{{ $enquiry->created_at->format('d M Y, h:i A') }}</td>
                                    <td>
                                        <div class="row-actions">
                                            <a href="{{ route('admin.package-enquiries.show', $enquiry) }}" class="btn-secondary-dash">View</a>
                                            <form action="{{ route('admin.package-enquiries.destroy', $enquiry) }}" method="POST"
                                                onsubmit="return confirm('Delete this enquiry?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-secondary-dash">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div style="padding: 16px 24px;">
                        {{ $enquiries->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

@include('admin.footer')