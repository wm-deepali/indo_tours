@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    @include('admin.attraction-categories._form-styles')

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div>
                    <h1>Add Attraction Category</h1>
                    <div class="cat-breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.attraction-categories.index') }}">Attraction Categories</a>
                        <span>›</span>
                        Add New
                    </div>
                </div>
            </div>

            <div class="cat-card">
                <form action="{{ route('admin.attraction-categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.attraction-categories._form', ['category' => null])
                </form>
            </div>

        </div>
    </div>
</div>

@include('admin.footer')