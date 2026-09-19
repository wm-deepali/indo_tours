{{-- resources/views/admin/amenity/index.blade.php --}}
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

        .cat-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); box-sizing: border-box; }
        .cat-page * { box-sizing: border-box; }
        .cat-page-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .cat-page-header h1 { font-size: 20px; font-weight: 650; margin: 0; }
        .cat-breadcrumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
        .cat-breadcrumb a { color: var(--accent); text-decoration: none; }
        .cat-breadcrumb a:hover { text-decoration: underline; }
        .cat-breadcrumb span { margin: 0 5px; }

        .btn-primary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff !important; border: none; border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; box-shadow: 0 1px 3px rgba(48, 61, 137, .25); }
        .btn-primary-dash:hover { background: #252f70; }
        .btn-secondary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none !important; }
        .btn-secondary-dash:hover { background: var(--bg); }

        .cat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); max-width: 100vw; overflow: hidden; }

        .form-field { margin-bottom: 18px; }
        .form-field label { display: block; font-size: 12.5px; font-weight: 600; color: var(--text-secondary); margin-bottom: 6px; letter-spacing: .02em; }
        .form-field .hint { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }
        .form-control-styled { width: 100%; height: 40px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 12px; font-size: 13.5px; font-family: var(--font); color: var(--text-primary); outline: none; transition: border-color .15s, box-shadow .15s; background: var(--surface); }
        .form-control-styled:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48, 61, 137, .12); }
        .form-error { color: #b22222; font-size: 12px; margin-top: 5px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .form-body { padding: 24px; }
        .form-actions { display: flex; gap: 10px; padding: 20px 24px; border-top: 1px solid var(--border); background: var(--surface); }
        .checkbox-row { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--text-primary); }
        .checkbox-row input { width: auto; height: auto; }
        .icon-preview { width: 48px; height: 48px; object-fit: contain; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 4px; background: var(--bg); margin-bottom: 8px; display: block; }

        .cat-toolbar { display: flex; gap: 10px; padding: 16px 20px; border-bottom: 1px solid var(--border); }
        .cat-toolbar .form-control-styled { max-width: 280px; }
        .cat-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
        .cat-table th { text-align: left; padding: 12px 20px; font-size: 12px; font-weight: 600; color: var(--text-secondary); background: var(--bg); text-transform: uppercase; letter-spacing: .04em; }
        .cat-table td { padding: 12px 20px; border-top: 1px solid var(--border); vertical-align: middle; }
        .cat-table img.thumb { width: 36px; height: 36px; object-fit: contain; }
        .badge-status { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
        .badge-on { background: #e3f5e8; color: #1e7a3c; }
        .badge-off { background: #f1f2f4; color: var(--text-secondary); }
        .btn-icon { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border: 1px solid var(--border); border-radius: var(--radius-sm); background: var(--surface); color: var(--text-secondary); cursor: pointer; text-decoration: none; }
        .btn-icon:hover { background: var(--bg); }
        .btn-icon.danger:hover { color: #b22222; border-color: #b22222; }
        .alert-ok { background: #e3f5e8; color: #1e7a3c; border: 1px solid #bfe5c9; border-radius: var(--radius-sm); padding: 10px 14px; font-size: 13px; margin-bottom: 16px; }
        .empty-row { text-align: center; color: var(--text-hint); padding: 32px 0 !important; }
        .cat-pagination { padding: 14px 20px; border-top: 1px solid var(--border); }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Amenities</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Amenities
                    </div>
                </div>
                <a href="{{ route('admin.amenities.create') }}" class="btn-primary-dash">
                    <i class="fa fa-plus"></i> Add Amenity
                </a>
            </div>

            @if(session('success'))
                <div class="alert-ok">{{ session('success') }}</div>
            @endif

            <div class="cat-card">
                <form method="GET" action="{{ route('admin.amenities.index') }}" class="cat-toolbar">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control-styled"
                        placeholder="Search amenities...">
                    <button type="submit" class="btn-secondary-dash"><i class="fa fa-search"></i> Search</button>
                    @if(request('search'))
                        <a href="{{ route('admin.amenities.index') }}" class="btn-secondary-dash">Reset</a>
                    @endif
                </form>

                <div style="overflow-x:auto;">
                    <table class="cat-table">
                        <thead>
                            <tr>
                                <th style="width:60px;">#</th>
                                <th style="width:80px;">Icon</th>
                                <th>Name</th>
                                <th style="width:90px;">Order</th>
                                <th style="width:110px;">Status</th>
                                <th style="width:110px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($amenities as $amenity)
                                <tr>
                                    <td>{{ $amenities->firstItem() + $loop->index }}</td>
                                    <td>
                                        @if($amenity->icon)
                                            <img src="{{ $amenity->icon_url }}" alt="{{ $amenity->name }}" class="thumb">
                                        @else
                                            <span style="color:var(--text-hint);">—</span>
                                        @endif
                                    </td>
                                    <td><strong>{{ $amenity->name }}</strong></td>
                                    <td>{{ $amenity->sort_order }}</td>
                                    <td>
                                        <span class="badge-status {{ $amenity->is_active ? 'badge-on' : 'badge-off' }}">
                                            {{ $amenity->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="display:flex; gap:6px;">
                                            <a href="{{ route('admin.amenities.edit', $amenity) }}" class="btn-icon" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.amenities.destroy', $amenity) }}" method="POST"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-icon danger" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="empty-row">No amenities found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($amenities->hasPages())
                    <div class="cat-pagination">{{ $amenities->links() }}</div>
                @endif
            </div>

        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.delete-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            if (typeof Swal === 'undefined') {
                if (confirm('Delete this amenity? It will be removed from all tour packages.')) form.submit();
                return;
            }
            Swal.fire({
                title: 'Delete this amenity?',
                text: 'It will be removed from all tour packages.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#303d89',
                confirmButtonText: 'Yes, delete'
            }).then(function (result) {
                if (result.isConfirmed) form.submit();
            });
        });
    });
</script>

@include('admin.footer')