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

        {{-- DASHBOARD --}}
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>
        </li>

        {{-- MASTER --}}
        <li class="{{ request()->routeIs([
            'admin.categories.*',
            'admin.subcategories.*',
            'admin.hotels.*',
            'admin.tourpackages.*',
            'admin.destinations.*',
            'admin.attraction-categories.*',
            'admin.attractions.*',
            'admin.activity-categories.*',
            'admin.activities.*',
        ]) ? 'active' : '' }}">
            <a href="#"><i class="fa-solid fa-layer-group"></i> Master</a>
            <ul>
                <li class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="fa-solid fa-tags"></i> Tour Categories
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.subcategories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.subcategories.index') }}">
                        <i class="fa-solid fa-tag"></i> Tour Sub Categories
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
                <li class="{{ request()->routeIs('admin.attraction-categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.attraction-categories.index') }}">
                        <i class="fa-solid fa-rectangle-list"></i> Attraction Categories
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.attractions.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.attractions.index') }}">
                        <i class="fa-solid fa-landmark"></i> Attractions
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.activity-categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.activity-categories.index') }}">
                        <i class="fa-solid fa-clipboard-list"></i> Activity Categories
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.activities.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.activities.index') }}">
                        <i class="fa-solid fa-person-hiking"></i> Activities
                    </a>
                </li>
            </ul>
        </li>

        {{-- REVIEWS --}}
        <li class="{{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
            <a href="{{ route('admin.reviews.index') }}">
                <i class="fa-solid fa-star"></i> Reviews
            </a>
        </li>

        {{-- CONTENT MANAGE --}}
        <li class="{{ request()->routeIs('admin.landing-pages.*') ? 'active' : '' }}">
            <a href="#"><i class="fa-solid fa-file-lines"></i> Content Manage</a>
            <ul>
                <li class="{{ request()->routeIs('admin.landing-pages.*') ? 'active' : '' }}">
                    <a href="#" class="submenu-toggle">
                        <i class="fa-solid fa-window-restore"></i> Manage Landing Pages
                    </a>
                    <ul>
                        <li class="{{ request()->routeIs('admin.landing-pages.destination.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.landing-pages.destination.edit') }}">
                                <i class="fa-solid fa-map-location-dot"></i> Destination Page
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.landing-pages.activities.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.landing-pages.activities.edit') }}">
                                <i class="fa-solid fa-person-hiking"></i> Activities Page
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.landing-pages.attraction.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.landing-pages.attraction.edit') }}">
                                <i class="fa-solid fa-landmark"></i> Attraction Page
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        {{-- SETTINGS --}}
        <li class="{{ request()->routeIs(['admin.settings.*', 'admin.seo-setting.*']) ? 'active' : '' }}">
            <a href="#"><i class="fa-solid fa-gear"></i> Settings</a>
            <ul>
                <li class="{{ request()->routeIs('admin.settings.*') && request()->query('tab', 'general') === 'general' ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index', ['tab' => 'general']) }}">
                        <i class="fa-solid fa-sliders"></i> General Setting
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.settings.*') && request()->query('tab') === 'smtp' ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index', ['tab' => 'smtp']) }}">
                        <i class="fa-solid fa-envelope"></i> SMTP
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.settings.*') && request()->query('tab') === 'sms' ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index', ['tab' => 'sms']) }}">
                        <i class="fa-solid fa-comment-sms"></i> SMS
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.settings.*') && request()->query('tab') === 'tracking' ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index', ['tab' => 'tracking']) }}">
                        <i class="fa-brands fa-google"></i> Google Tracking &amp; Pixels
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.seo-setting.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.seo-setting.index') }}">
                        <i class="fa-solid fa-magnifying-glass-chart"></i> SEO Settings
                    </a>
                </li>
            </ul>
        </li>

        {{-- REPORTS & INQUIRIES --}}
        <li class="{{ request()->routeIs(['admin.inquiries.*', 'admin.package-enquiries.*']) ? 'active' : '' }}">
            <a href="#"><i class="fa-solid fa-inbox"></i> Reports &amp; Inquiries</a>
            <ul>
                <li class="{{ request()->routeIs('admin.package-enquiries.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.package-enquiries.index') }}">
                        <i class="fa-solid fa-suitcase-rolling"></i> Package Enquiries
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</div>