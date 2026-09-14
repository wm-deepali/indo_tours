<!-- fixed-top-->

<div class="row d-none">
    <div class="col-10">

        @if(session('success'))
            <div class="alert alert-info alert-dismissible fade in">
                <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade in">
                <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong> {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</div>

<!-- fixed-top-->

<div id='cssmenu'>
    <ul class="pt-0">

        {{-- DASHBOARD — always visible, no permission gate --}}
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>
        </li>

        {{-- MASTER — Categories, Sub Categories, Hotels, Tour Packages, Destinations, Attractions --}}
        <li class="{{ request()->routeIs([
            'admin.categories.*',
            'admin.subcategories.*',
            'admin.hotels.*',
            'admin.tourpackages.*',
            'admin.destinations.*',
            'admin.attractions.*',
        ]) ? 'active' : '' }}">
            <a href="#"><i class="fa-solid fa-layer-group"></i> Master</a>
            <ul>
                <li class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="fa-solid fa-tags"></i> Categories
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.subcategories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.subcategories.index') }}">
                        <i class="fa-solid fa-tag"></i> Sub Categories
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.hotels.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.hotels.index') }}">
                        <i class="fa-solid fa-hotel"></i> Hotels
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.tourpackages.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tourpackages.index') }}">
                        <i class="fa-solid fa-suitcase-rolling"></i> Tour Packages
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.destinations.index') }}">
                        <i class="fa-solid fa-map-location-dot"></i> Destinations
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.attractions.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.attractions.index') }}">
                        <i class="fa-solid fa-landmark"></i> Attractions
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.activities.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.activities.index') }}">
                        <i class="fa-solid fa-landmark"></i> Activities
                    </a>
                </li>
            </ul>
        </li>

        <li class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <a href="#"><i class="fa-solid fa-gear"></i> Settings</a>
            <ul>
                <li><a href="{{ route('admin.settings.index', ['tab' => 'general']) }}">General Setting</a></li>
                <li><a href="{{ route('admin.settings.index', ['tab' => 'smtp']) }}">SMTP</a></li>
                <li><a href="{{ route('admin.settings.index', ['tab' => 'sms']) }}">SMS</a></li>
                <li><a href="{{ route('admin.settings.index', ['tab' => 'tracking']) }}"> Google Tracking & Pixels</a>
                </li>
                <li><a href="{{ route('admin.seo-setting.index') }}"> SEO Settings</a></li>
            </ul>
        </li>

    </ul>
</div>