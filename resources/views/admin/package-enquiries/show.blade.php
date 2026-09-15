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

        .cat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); padding: 24px; max-width: 720px; }

        .detail-row { display: flex; padding: 12px 0; border-bottom: 1px solid var(--border); }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { width: 180px; flex-shrink: 0; color: var(--text-secondary); font-size: 12.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .02em; }
        .detail-value { font-size: 14px; color: var(--text-primary); }

        .status-form { display: flex; gap: 10px; align-items: center; margin-top: 20px; }
        .form-control-styled { height: 38px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 12px; font-size: 13.5px; font-family: var(--font); }

        .btn-primary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff !important; border: none; border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; }
        .btn-secondary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none !important; }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Enquiry Details</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.inquiries.package-enquiries.index') }}">Package Enquiries</a>
                        <span>›</span>
                        #{{ $enquiry->id }}
                    </div>
                </div>
                <a href="{{ route('admin.inquiries.package-enquiries.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-info" style="margin-bottom:16px;">{{ session('success') }}</div>
            @endif

            <div class="cat-card">

                <div class="detail-row">
                    <div class="detail-label">Full Name</div>
                    <div class="detail-value">{{ $enquiry->full_name }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">{{ $enquiry->email }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Phone</div>
                    <div class="detail-value">{{ $enquiry->phone }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Tour Package</div>
                    <div class="detail-value">{{ $enquiry->tourPackage->title ?? '—' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Travel Date</div>
                    <div class="detail-value">
                        {{ $enquiry->travel_date ? \Carbon\Carbon::parse($enquiry->travel_date)->format('d M Y') : '—' }}
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Travellers</div>
                    <div class="detail-value">{{ $enquiry->traveller_count ?? '—' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Message</div>
                    <div class="detail-value">{{ $enquiry->message ?: '—' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Received</div>
                    <div class="detail-value">{{ $enquiry->created_at->format('d M Y, h:i A') }}</div>
                </div>

                <form action="{{ route('admin.inquiries.package-enquiries.status', $enquiry) }}" method="POST" class="status-form">
                    @csrf
                    @method('PATCH')
                    <label for="status" style="font-size:13px; font-weight:600; color:var(--text-secondary);">Status</label>
                    <select name="status" id="status" class="form-control-styled">
                        @foreach(['new', 'contacted', 'converted', 'closed'] as $status)
                            <option value="{{ $status }}" {{ $enquiry->status == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-primary-dash">Update Status</button>
                </form>

            </div>

        </div>
    </div>
</div>

@include('admin.footer')