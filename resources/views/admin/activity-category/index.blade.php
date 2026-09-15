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
        .btn-primary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff !important; border: none; border-radius: var(--radius-sm); padding: 9px 18px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; box-shadow: 0 1px 3px rgba(48,61,137,.25); }
        .btn-primary-dash:hover { background: #252f70; }
        .btn-secondary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 7px 14px; font-size: 12.5px; font-weight: 500; cursor: pointer; text-decoration: none !important; }
        .btn-secondary-dash:hover { background: var(--bg); }
        .cat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; }
        table.cat-table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
        table.cat-table th { text-align: left; padding: 12px 16px; background: var(--bg); color: var(--text-secondary); font-size: 12px; font-weight: 650; letter-spacing: .02em; border-bottom: 1px solid var(--border); }
        table.cat-table td { padding: 12px 16px; border-bottom: 1px solid var(--border); vertical-align: middle; }
        table.cat-table tr:last-child td { border-bottom: none; }
        .thumb { width: 46px; height: 46px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--border); }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 11.5px; font-weight: 650; }
        .badge-active { background: #e3f7e9; color: #1c7a3d; }
        .badge-inactive { background: #f1f2f4; color: #6d7175; }
        .row-actions { display: flex; gap: 8px; }
        .empty-state { padding: 60px 24px; text-align: center; color: var(--text-hint); }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Activity Categories</h1>
                </div>
                <a href="{{ route('admin.activity-categories.create') }}" class="btn-primary-dash">
                    <i class="fa fa-plus"></i> Add Category
                </a>
            </div>

            <div class="cat-card">
                @if($categories->isEmpty())
                    <div class="empty-state">No activity categories added yet.</div>
                @else
                    <table class="cat-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Activities</th>
                                <th>Sort Order</th>
                                <th>Status</th>
                                <th style="width:140px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        @if($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" class="thumb">
                                        @endif
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->activities()->count() }}</td>
                                    <td>{{ $category->sort_order }}</td>
                                    <td><span class="badge badge-{{ $category->status }}">{{ ucfirst($category->status) }}</span></td>
                                    <td class="row-actions">
                                        <a href="{{ route('admin.activity-categories.edit', $category) }}" class="btn-secondary-dash"><i class="fa fa-pen"></i></a>
                                        <form action="{{ route('admin.activity-categories.destroy', $category) }}" method="POST" class="delete-form">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-secondary-dash"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div style="margin-top:16px;">{{ $categories->links() }}</div>

        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.delete-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Delete this category?',
                text: 'This cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: '#b22222'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });
</script>

@include('admin.footer')