{{-- resources/views/admin/contact-submissions/show.blade.php --}}
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
        .btn-secondary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none !important; }
        .btn-secondary-dash:hover { background: var(--bg); }
        .cat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; padding: 24px; }
        .detail-row { display: grid; grid-template-columns: 160px 1fr; gap: 12px; padding: 14px 0; border-bottom: 1px solid var(--border); }
        .detail-row:last-child { border-bottom: none; }
        .detail-row .label { font-size: 12.5px; font-weight: 600; color: var(--text-secondary); }
        .detail-row .value { font-size: 13.5px; color: var(--text-primary); white-space: pre-wrap; }
        .badge-newsletter { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: #e3f5e6; color: #1c7c34; }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Submission Details</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.contact-submissions.index') }}">Contact Submissions</a>
                        <span>›</span>
                        View
                    </div>
                </div>
                <a href="{{ route('admin.contact-submissions.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="cat-card">

                <div class="detail-row">
                    <div class="label">Full Name</div>
                    <div class="value">{{ $contactSubmission->first_name }} {{ $contactSubmission->last_name }}</div>
                </div>

                <div class="detail-row">
                    <div class="label">Email</div>
                    <div class="value"><a href="mailto:{{ $contactSubmission->email }}">{{ $contactSubmission->email }}</a></div>
                </div>

                <div class="detail-row">
                    <div class="label">Phone</div>
                    <div class="value"><a href="tel:{{ $contactSubmission->phone }}">{{ $contactSubmission->phone }}</a></div>
                </div>

                <div class="detail-row">
                    <div class="label">Message</div>
                    <div class="value">{{ $contactSubmission->message }}</div>
                </div>

                <div class="detail-row">
                    <div class="label">Newsletter Opt-in</div>
                    <div class="value">
                        @if($contactSubmission->newsletter)
                            <span class="badge-newsletter">Subscribed</span>
                        @else
                            Not subscribed
                        @endif
                    </div>
                </div>

                <div class="detail-row">
                    <div class="label">Received On</div>
                    <div class="value">{{ $contactSubmission->created_at->format('d M Y, h:i A') }}</div>
                </div>

            </div>

        </div>
    </div>
</div>

@include('admin.footer')