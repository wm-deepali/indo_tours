{{-- resources/views/admin/review/index.blade.php --}}
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
    .btn-danger-dash { display: inline-flex; align-items: center; gap: 6px; background: #fff5f5; color: #b22222 !important; border: 1px solid #f3c6c6; border-radius: var(--radius-sm); padding: 7px 12px; font-size: 12.5px; font-weight: 500; cursor: pointer; text-decoration: none !important; }
    .btn-danger-dash:hover { background: #ffe9e9; }
    .cat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); max-width: 100vw; overflow: hidden; }
    .filter-bar { display: flex; gap: 12px; flex-wrap: wrap; padding: 16px 20px; border-bottom: 1px solid var(--border); background: var(--bg); }
    .filter-bar select { height: 36px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 10px; font-size: 13px; font-family: var(--font); background: var(--surface); }
    table.admin-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
    table.admin-table th { text-align: left; padding: 12px 16px; background: var(--bg); color: var(--text-secondary); font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: .03em; border-bottom: 1px solid var(--border); }
    table.admin-table td { padding: 12px 16px; border-bottom: 1px solid var(--border); vertical-align: middle; }
    table.admin-table tr:last-child td { border-bottom: none; }
    .rv-avatar { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; background: var(--accent-light); display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; color: var(--accent); }
    .rv-stars { color: #f5a623; font-size: 12px; }
    .badge-type { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background: var(--accent-light); color: var(--accent); }
    .badge-status { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
    .badge-status.published { background: #e3f7e8; color: #1a7f37; }
    .badge-status.draft { background: #fff4e0; color: #a86400; }
    .badge-status.unpublished { background: #f3f4f6; color: #6d7175; }
    .row-actions { display: flex; gap: 8px; }
    .empty-state { padding: 60px 20px; text-align: center; color: var(--text-hint); }
    .quote-preview { max-width: 320px; color: var(--text-secondary); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Reviews</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Reviews
                    </div>
                </div>
                <a href="{{ route('admin.reviews.create') }}" class="btn-primary-dash">
                    <i class="fa fa-plus"></i> Add Review
                </a>
            </div>

            <div class="cat-card">

                <form method="GET" class="filter-bar">
                    <select name="type" onchange="this.form.submit()">
                        <option value="">All Types</option>
                        @foreach($types as $key => $class)
                            <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>
                                {{ ucwords(str_replace('_', ' ', $key)) }}
                            </option>
                        @endforeach
                    </select>

                    <select name="status" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="unpublished" {{ request('status') == 'unpublished' ? 'selected' : '' }}>Unpublished</option>
                    </select>

                    @if(request('type') || request('status'))
                        <a href="{{ route('admin.reviews.index') }}" class="btn-secondary-dash">Clear</a>
                    @endif
                </form>

                @if($reviews->isEmpty())
                    <div class="empty-state">
                        <p>No reviews found.</p>
                    </div>
                @else
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Reviewer</th>
                                <th>Review For</th>
                                <th>Rating</th>
                                <th>Review</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th style="width:140px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:10px;">
                                            @if($review->photo)
                                                <img src="{{ asset('storage/' . $review->photo) }}" class="rv-avatar" alt="{{ $review->full_name }}">
                                            @else
                                                <span class="rv-avatar">{{ $review->initials() }}</span>
                                            @endif
                                            <div>
                                                <div style="font-weight:600;">{{ $review->full_name }}</div>
                                                @if($review->designation)
                                                    <div style="font-size:12px;color:var(--text-hint);">{{ $review->designation }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-type">{{ class_basename($review->reviewable_type) }}</span>
                                        <div style="font-size:12.5px;margin-top:4px;">
                                            {{ $review->reviewable->name ?? '— deleted —' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="rv-stars">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                                    </td>
                                    <td>
                                        <div class="quote-preview" title="{{ $review->review }}">{{ $review->review }}</div>
                                    </td>
                                    <td>
                                        <span class="badge-status {{ $review->status }}">{{ ucfirst($review->status) }}</span>
                                    </td>
                                    <td>{{ $review->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="row-actions">
                                            <a href="{{ route('admin.reviews.edit', $review) }}" class="btn-secondary-dash" style="padding:6px 10px;">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Delete this review?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-danger-dash">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div style="padding:16px 20px;">
                        {{ $reviews->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@include('admin.footer')