{{-- resources/views/admin/hotel/edit.blade.php --}}
@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Edit Hotel</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.hotels.index') }}">Hotels</a>
                        <span>›</span>
                        Edit
                    </div>
                </div>
                <a href="{{ route('admin.hotels.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to List
                </a>
            </div>

            @include('admin.hotel._form', [
                'hotel' => $hotel,
                'formAction' => route('admin.hotels.update', $hotel),
                'submitLabel' => 'Update Hotel',
            ])

        </div>
    </div>
</div>

@include('admin.footer')