{{-- resources/views/admin/testimonial/index.blade.php --}}
@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        /* ...identical <style> block as create.blade.php above... */
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Testimonials</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Testimonials
                    </div>
                </div>
                <a href="{{ route('admin.testimonials.create') }}" class="btn-primary-dash">
                    <i class="fa fa-plus"></i> Add Testimonial
                </a>
            </div>

            @if (session('success'))
                <div class="alert-ok">{{ session('success') }}</div>
            @endif

            <div class="cat-card">

                <form action="{{ route('admin.testimonials.bulk-delete') }}" method="POST" id="bulk-delete-form">
                    @csrf
                    @method('DELETE')

                    <div class="cat-toolbar" style="justify-content: space-between;">
                        <form action="{{ route('admin.testimonials.index') }}" method="GET" style="display:flex; gap:10px;">
                            <select name="status" class="form-control-styled" onchange="this.form.submit()">
                                <option value="">All Status</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </form>
                        <button type="submit" class="btn-secondary-dash"
                            onclick="return confirm('Delete selected testimonials?')">
                            <i class="fa fa-trash"></i> Delete Selected
                        </button>
                    </div>

                    <table class="cat-table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Sort</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($testimonials as $testimonial)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{ $testimonial->id }}"></td>
                                    <td>
                                        @if ($testimonial->image)
                                            <img src="{{ asset('storage/' . $testimonial->image) }}" class="thumb" alt="{{ $testimonial->name }}">
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>{{ $testimonial->name }}</td>
                                    <td>{{ $testimonial->designation }}</td>
                                    <td><span class="star-rate">{{ str_repeat('★', $testimonial->rating) }}{{ str_repeat('☆', 5 - $testimonial->rating) }}</span></td>
                                    <td>
                                        <span class="badge-status {{ $testimonial->status === 'published' ? 'badge-on' : 'badge-off' }}">
                                            {{ ucfirst($testimonial->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $testimonial->sort_order }}</td>
                                    <td>
                                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn-icon" title="Edit">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <button type="button" class="btn-icon danger" title="Delete"
                                            onclick="if (confirm('Delete this testimonial?')) { document.getElementById('delete-form-{{ $testimonial->id }}').submit(); }">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="empty-row">No testimonials added yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </form>

                @foreach ($testimonials as $testimonial)
                    <form id="delete-form-{{ $testimonial->id }}" action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach

                <div class="cat-pagination">
                    {{ $testimonials->links() }}
                </div>

            </div>

        </div>
    </div>
</div>

<script>
document.getElementById('select-all')?.addEventListener('change', function () {
    document.querySelectorAll('input[name="ids[]"]').forEach(cb => cb.checked = this.checked);
});
</script>

@include('admin.footer')