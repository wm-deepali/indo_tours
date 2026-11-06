{{-- resources/views/admin/hotel/create.blade.php --}}
@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Add Hotel</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.hotels.index') }}">Hotels</a>
                        <span>›</span>
                        Add
                    </div>
                </div>
                <a href="{{ route('admin.hotels.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            @include('admin.hotel._form', [
                'hotel' => null,
                'formAction' => route('admin.hotels.store'),
                'submitLabel' => 'Save Hotel',
            ])

        </div>
    </div>
</div>

@include('admin.footer')