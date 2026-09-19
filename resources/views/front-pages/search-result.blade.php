@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/result/result.css') }}" />
@endpush

@section('content')
    @php
        $inr = function ($n) {
            $s = (string) (int) round($n);
            if (strlen($s) <= 3) {
                return '₹' . $s;
            }
            $rest = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', substr($s, 0, -3));
            return '₹' . $rest . ',' . substr($s, -3);
        };

        $isTour = $type === 'tour';
        $noun = $isTour ? 'Packages' : 'Activities';
        $total = $results->total();
        $keep = request()->only(['q', 'min_price', 'max_price', 'sort']);
    @endphp

    <main class="search-result-page">
        <nav class="breadcrumb left breadcrumb-light" aria-label="Breadcrumb">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><span class="breadcrumb-separator">/</span></li>
                <li><a href="{{ url('/search') }}" class="active">Search Results</a></li>
            </ul>
        </nav>

        <section class="sec-hero">
            <div class="sec-hero-bg">
                <img loading="lazy" src="{{ asset('assets/images/blog/dubai.jpg') }}" alt="Search results" />
                <div class="sec-hero-overlay"></div>
            </div>

            <div class="container">
                <div class="sec-hero-head">
                    <h1>Explore Trips That Match Your Search</h1>
                    <p>
                        Discover handpicked tours and holiday packages based on your
                        destination, travel style and preferences.
                    </p>
                </div>

                <form class="sec-hero-form" action="{{ url('/search') }}" method="GET">
                    <div class="search-field">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                            stroke-width="1.6">
                            <circle cx="11" cy="11" r="7" />
                            <path d="m21 21-4.3-4.3" stroke-linecap="round" />
                        </svg>
                        <input type="text" name="q" value="{{ $q }}" placeholder="Search activies or tour..." />
                    </div>

                    <div class="select-field">
                        <select name="type" class="js-nice-select">
                            @foreach(config('search.product_types') as $key => $label)
                                <option value="{{ $key }}" {{ $type === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="select-field">
                        <select name="duration" class="js-nice-select">
                            <option value="">Duration</option>
                            @foreach($durations as $key => $d)
                                <option value="{{ $key }}" {{ in_array((string) $key, $selected['duration'], true) ? 'selected' : '' }}>
                                    {{ $d['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary sec-hero-search">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="m21 21-4.3-4.3" stroke-linecap="round" />
                        </svg>
                        Search
                    </button>
                </form>
            </div>
        </section>

        <!-- ============ RESULT HEADER ============ -->
        <section class="sec-a">
            <div class="container">
                <div class="sec-a-top">
                    <div class="sec-a-heading">
                        <h2>{{ $q ? 'Results for "' . $q . '"' : ($isTour ? 'All Tour Packages' : 'All Activities') }}</h2>
                        <p>
                            Explore carefully planned {{ $isTour ? 'packages' : 'activities' }} and find the right
                            {{ $isTour ? 'trip' : 'experience' }} for your travel style and budget.
                        </p>
                    </div>

                    <button type="button" data-model=".modify-search-pop"
                        class="btn btn-outline sec-a-modify js-modify-search">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 6h16M4 12h10M4 18h6" stroke-linecap="round" />
                        </svg>
                        Modify Search
                    </button>
                </div>

                <div class="sec-a-summary">
                    <span class="result-count js-result-count">{{ $total }} {{ $noun }} Found</span>
                    <ul class="search-tags">
                        @foreach(config('search.product_types') as $key => $label)
                            <li>
                                <a href="{{ url('/search') . '?' . http_build_query(array_merge($keep, ['type' => $key])) }}"
                                    class="{{ $type === $key ? 'active' : '' }}"
                                    style="{{ $type === $key ? 'font-weight:700;' : '' }}">
                                    {{ $label }} ({{ $counts[$key] }})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        <!-- ============ ACTIVE FILTER CHIPS ============ -->
        @if(count($chips))
            <section class="sec-b js-chips-section">
                <div class="container">
                    <div class="sec-b-row">
                        <ul class="chip-list js-chip-list">
                            @foreach($chips as $chip)
                                <li class="chip">
                                    <a href="{{ $chip['url'] }}"
                                        style="color:inherit;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                                        {{ $chip['label'] }}
                                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor"
                                            stroke-width="2.4">
                                            <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round" />
                                        </svg>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ $resetUrl }}" class="clear-all-btn">Clear All</a>
                    </div>
                </div>
            </section>
        @endif

        <!-- ============ MAIN LAYOUT ============ -->
        <section class="sec-c">
            <div class="container">
                <div class="sec-c-layout">
                    <div class="sidebar-overlay js-sidebar-overlay"></div>

                    <!-- ---- FILTER SIDEBAR ---- -->
                    <aside class="sec-c-sidebar">
                        <form action="{{ url('/search') }}" method="GET" id="filterForm">
                            <input type="hidden" name="type" value="{{ $type }}">
                            <input type="hidden" name="q" value="{{ $q }}">
                            <input type="hidden" name="sort" id="filterSort" value="{{ $sort }}">

                            <div class="filter-panel">
                                <div class="filter-panel-head">
                                    <h4>Filter By</h4>
                                    <a href="{{ $resetUrl }}" class="reset-link">Reset Filters</a>
                                    <button type="button" class="filter-panel-close js-close-filter-drawer"
                                        aria-label="Close filters">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>

                                {{-- Destination (tours only) --}}
                                @if($isTour && $destinations->isNotEmpty())
                                    <div class="filter-group" data-group="destination">
                                        <h5 class="js-accordion-toggle">Destination</h5>
                                        <div class="filter-group-body">
                                            @foreach($destinations as $dest)
                                                <label class="filter-check"><input type="checkbox" name="destination[]"
                                                        value="{{ $dest->id }}" {{ in_array((string) $dest->id, $selected['destination'], true) ? 'checked' : '' }} />
                                                    <span class="box"></span>
                                                    {{ $dest->name }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                {{-- Duration --}}
                                <div class="filter-group" data-group="duration">
                                    <h5 class="js-accordion-toggle">Duration</h5>
                                    <div class="filter-group-body">
                                        @foreach($durations as $key => $d)
                                            <label class="filter-check">
                                                <input type="checkbox" name="duration[]" value="{{ $key }}" {{ in_array((string) $key, $selected['duration'], true) ? 'checked' : '' }} />
                                                <span class="box"></span>
                                                {{ $d['label'] }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Price --}}
                                <div class="filter-group" data-group="budget">
                                    <h5 class="js-accordion-toggle">Price Range</h5>
                                    <div class="filter-group-body">
                                        <div class="price-range js-price-range" data-min="{{ $priceMin }}"
                                            data-max="{{ $priceMax }}" data-cur-min="{{ $currentMin }}"
                                            data-cur-max="{{ $currentMax }}">
                                            <div class="range-track"></div>
                                            <div class="range-fill js-range-fill"></div>
                                            <button type="button" class="range-handle js-range-handle" data-handle="min"
                                                aria-label="Minimum budget"></button>
                                            <button type="button" class="range-handle js-range-handle" data-handle="max"
                                                aria-label="Maximum budget"></button>
                                        </div>
                                        <div class="price-values">
                                            <span class="js-price-min-label">{{ $inr($currentMin) }}</span>
                                            <span class="js-price-max-label">{{ $inr($currentMax) }}</span>
                                        </div>
                                        <input type="hidden" name="min_price" id="filterMinPrice" value="{{ $currentMin }}"
                                            data-default="{{ $priceMin }}">
                                        <input type="hidden" name="max_price" id="filterMaxPrice" value="{{ $currentMax }}"
                                            data-default="{{ $priceMax }}">
                                    </div>
                                </div>

                                @if($isTour)
                                    {{-- Category / Sub-category --}}
                                    @if($categories->isNotEmpty())
                                        <div class="filter-group" data-group="category">
                                            <h5 class="js-accordion-toggle">Category</h5>
                                            <div class="filter-group-body">
                                                @foreach($categories as $cat)
                                                    <label class="filter-check">
                                                        <input type="checkbox" name="category[]" value="{{ $cat->id }}" {{ in_array((string) $cat->id, $selected['category'], true) ? 'checked' : '' }} />
                                                        <span class="box"></span>
                                                        {{ $cat->name }}
                                                    </label>

                                                    @if($cat->subCategories->isNotEmpty())
                                                        <div class="filter-subgroup">
                                                            @foreach($cat->subCategories as $sub)
                                                                <label class="filter-check filter-check--sub">
                                                                    <input type="checkbox" name="sub_category[]" value="{{ $sub->id }}" {{ in_array((string) $sub->id, $selected['subCategory'], true) ? 'checked' : '' }} />
                                                                    <span class="box"></span>
                                                                    {{ $sub->name }}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Hotel category --}}
                                    <div class="filter-group" data-group="hotelCategory">
                                        <h5 class="js-accordion-toggle">Hotel Category</h5>
                                        <div class="filter-group-body">
                                            @foreach(['3', '4', '5'] as $star)
                                                <label class="filter-check">
                                                    <input type="checkbox" name="stars[]" value="{{ $star }}" {{ in_array($star, $selected['stars'], true) ? 'checked' : '' }} />
                                                    <span class="box"></span>
                                                    {{ $star }} Star
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- Meals --}}
                                    <div class="filter-group" data-group="meals">
                                        <h5 class="js-accordion-toggle">Meals</h5>
                                        <div class="filter-group-body">
                                            @foreach($meals as $key => $meal)
                                                <label class="filter-check">
                                                    <input type="radio" name="meals" value="{{ $key }}" {{ $selected['meals'] === $key ? 'checked' : '' }} />
                                                    <span class="box radio"></span>
                                                    {{ $meal['label'] }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                     {{-- Rating (now applies to tours too) --}}
                                    <div class="filter-group" data-group="rating">
                                        <h5 class="js-accordion-toggle">Rating</h5>
                                        <div class="filter-group-body">
                                            <label class="filter-check">
                                                <input type="radio" name="rating" value="4plus" {{ $selected['rating'] === '4plus' ? 'checked' : '' }} />
                                                <span class="box radio"></span>
                                                4★ &amp; above
                                            </label>
                                            <label class="filter-check">
                                                <input type="radio" name="rating" value="3plus" {{ $selected['rating'] === '3plus' ? 'checked' : '' }} />
                                                <span class="box radio"></span>
                                                3★ &amp; above
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    {{-- Activity Category --}}
                                    @if($activityCategories->isNotEmpty())
                                        <div class="filter-group" data-group="activityCategory">
                                            <h5 class="js-accordion-toggle">Category</h5>
                                            <div class="filter-group-body">
                                                @foreach($activityCategories as $cat)
                                                    <label class="filter-check">
                                                        <input type="checkbox" name="activity_category[]" value="{{ $cat->id }}" {{ in_array((string) $cat->id, $selected['activityCategory'], true) ? 'checked' : '' }} />
                                                        <span class="box"></span>
                                                        {{ $cat->name }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Rating (activities only) --}}
                                    <div class="filter-group" data-group="rating">
                                        <h5 class="js-accordion-toggle">Rating</h5>
                                        <div class="filter-group-body">
                                            <label class="filter-check">
                                                <input type="radio" name="rating" value="4plus" {{ $selected['rating'] === '4plus' ? 'checked' : '' }} />
                                                <span class="box radio"></span>
                                                4★ &amp; above
                                            </label>
                                            <label class="filter-check">
                                                <input type="radio" name="rating" value="3plus" {{ $selected['rating'] === '3plus' ? 'checked' : '' }} />
                                                <span class="box radio"></span>
                                                3★ &amp; above
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="filter-panel-apply">
                                <button type="submit" class="btn btn-primary js-apply-filters">Apply Filters</button>
                            </div>
                        </form>
                    </aside>

                    <!-- ---- RESULTS ---- -->
                    <div class="sec-c-results">
                        <div class="mobile-toolbar">
                            <button type="button" class="mobile-toolbar-btn js-open-filter-drawer">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M4 6h16M7 12h10M10 18h4" stroke-linecap="round" />
                                </svg>
                                Filter
                            </button>

                            <div class="sort-field mobile-sort-field">
                                <div class="select-field">
                                    <select id="sortByMobile" class="js-nice-select js-sort-select">
                                        <option value="recommended" {{ $sort === 'recommended' ? 'selected' : '' }}>
                                            Recommended</option>
                                        <option value="price-low" {{ $sort === 'price-low' ? 'selected' : '' }}>Price: Low to
                                            High</option>
                                        <option value="price-high" {{ $sort === 'price-high' ? 'selected' : '' }}>Price: High
                                            to Low</option>
                                        <option value="duration" {{ $sort === 'duration' ? 'selected' : '' }}>Duration
                                        </option>
                                        <option value="rating" {{ $sort === 'rating' ? 'selected' : '' }}>Top Rated</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="results-head">
                            <span class="results-count js-result-count">{{ $total }} {{ $noun }} Found</span>

                            <div class="sort-field">
                                <label for="sortBy">Sort By</label>
                                <select id="sortBy" class="js-nice-select js-sort-select">
                                    <option value="recommended" {{ $sort === 'recommended' ? 'selected' : '' }}>Recommended
                                    </option>
                                    <option value="price-low" {{ $sort === 'price-low' ? 'selected' : '' }}>Price: Low to High
                                    </option>
                                    <option value="price-high" {{ $sort === 'price-high' ? 'selected' : '' }}>Price: High to
                                        Low</option>
                                    <option value="duration" {{ $sort === 'duration' ? 'selected' : '' }}>Duration</option>
                                    @unless($isTour)
                                        <option value="rating" {{ $sort === 'rating' ? 'selected' : '' }}>Top Rated</option>
                                    @endunless
                                </select>
                            </div>
                        </div>

                        @if($results->isEmpty())
                            <div class="no-results js-no-results">
                                <svg viewBox="0 0 24 24" width="52" height="52" fill="none" stroke="currentColor"
                                    stroke-width="1.5">
                                    <circle cx="11" cy="11" r="7" />
                                    <path d="m21 21-4.3-4.3M9 11h4" stroke-linecap="round" />
                                </svg>
                                <h4>No {{ $noun }} Found</h4>
                                <p>
                                    We couldn't find {{ strtolower($noun) }} matching your selected filters. Try
                                    changing your search, budget or preferences.
                                </p>
                                <div class="no-results-actions">
                                    <button type="button" class="btn btn-outline js-open-modify-drawer">Modify Search</button>
                                    <a href="{{ $resetUrl }}" class="btn btn-primary">Clear Filters</a>
                                </div>
                            </div>
                        @else
                            <div class="package-list js-package-grid">
                                @foreach($results as $item)
                                    @include('front-pages.partials.search-card', ['item' => $item, 'type' => $type, 'inr' => $inr])
                                @endforeach
                            </div>

                            <div class="load-more-wrap" style="flex-direction:column;gap:12px;">
                                <span class="load-more-status js-load-more-status">
                                    Showing {{ $results->firstItem() }}–{{ $results->lastItem() }} of {{ $total }}
                                    {{ strtolower($noun) }}
                                </span>
                                @if($results->hasPages())
                                    {{ $results->links() }}
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ EXPLORE MORE DESTINATIONS ============ -->
        <section class="sec-e">
            <div class="container">
                <div class="heading">
                    <h3>Explore More <span>Destinations</span></h3>
                    <p>
                        Handpicked destinations loved by our travellers — find your next
                        getaway.
                    </p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper destSlider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="listing-detail.html" class="dest-card">
                                    <div class="dest-card-img">
                                        <img loading="lazy" src="assets/images/blog/beach.jpg" alt="Bali" />
                                    </div>
                                    <div class="dest-card-content">
                                        <span class="pkg-count">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M20 6 9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            18 Packages
                                        </span>
                                        <div class="place">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="10" r="3" />
                                                <path
                                                    d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
                                            </svg>
                                            Indonesia
                                        </div>
                                        <h5>Bali</h5>
                                        <div class="foot">
                                            <p class="price"><small>Starting from</small>₹45,000</p>
                                            <span class="arrow-btn">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="listing-detail.html" class="dest-card">
                                    <div class="dest-card-img">
                                        <img loading="lazy" src="assets/images/blog/mount.jpg" alt="Maldives" />
                                    </div>
                                    <div class="dest-card-content">
                                        <span class="pkg-count">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M20 6 9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            12 Packages
                                        </span>
                                        <div class="place">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="10" r="3" />
                                                <path
                                                    d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
                                            </svg>
                                            South Asia
                                        </div>
                                        <h5>Maldives</h5>
                                        <div class="foot">
                                            <p class="price"><small>Starting from</small>₹95,000</p>
                                            <span class="arrow-btn">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="listing-detail.html" class="dest-card">
                                    <div class="dest-card-img">
                                        <img loading="lazy" src="assets/images/blog/kashmir.jpg" alt="Switzerland" />
                                    </div>
                                    <div class="dest-card-content">
                                        <span class="pkg-count">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M20 6 9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            9 Packages
                                        </span>
                                        <div class="place">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="10" r="3" />
                                                <path
                                                    d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
                                            </svg>
                                            Europe
                                        </div>
                                        <h5>Switzerland</h5>
                                        <div class="foot">
                                            <p class="price">
                                                <small>Starting from</small>₹1,65,000
                                            </p>
                                            <span class="arrow-btn">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="listing-detail.html" class="dest-card">
                                    <div class="dest-card-img">
                                        <img loading="lazy" src="assets/images/blog/mount.jpg" alt="Thailand" />
                                    </div>
                                    <div class="dest-card-content">
                                        <span class="pkg-count">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M20 6 9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            22 Packages
                                        </span>
                                        <div class="place">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="10" r="3" />
                                                <path
                                                    d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
                                            </svg>
                                            Southeast Asia
                                        </div>
                                        <h5>Thailand</h5>
                                        <div class="foot">
                                            <p class="price"><small>Starting from</small>₹38,000</p>
                                            <span class="arrow-btn">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="listing-detail.html" class="dest-card">
                                    <div class="dest-card-img">
                                        <img loading="lazy" src="assets/images/blog/culture.avif" alt="Singapore" />
                                    </div>
                                    <div class="dest-card-content">
                                        <span class="pkg-count">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M20 6 9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            15 Packages
                                        </span>
                                        <div class="place">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="10" r="3" />
                                                <path
                                                    d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
                                            </svg>
                                            Southeast Asia
                                        </div>
                                        <h5>Singapore</h5>
                                        <div class="foot">
                                            <p class="price"><small>Starting from</small>₹58,000</p>
                                            <span class="arrow-btn">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="listing-detail.html" class="dest-card">
                                    <div class="dest-card-img">
                                        <img loading="lazy" src="assets/images/blog/kashmir.jpg" alt="Kashmir" />
                                    </div>
                                    <div class="dest-card-content">
                                        <span class="pkg-count">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M20 6 9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            27 Packages
                                        </span>
                                        <div class="place">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="10" r="3" />
                                                <path
                                                    d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
                                            </svg>
                                            India
                                        </div>
                                        <h5>Kashmir</h5>
                                        <div class="foot">
                                            <p class="price"><small>Starting from</small>₹22,000</p>
                                            <span class="arrow-btn">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-group">
                        <button type="button" class="destSlider-prev btn-prev">
                            <svg viewBox="0 0 1024 1024">
                                <path fill="#ffff"
                                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                            </svg>
                        </button>
                        <button type="button" class="destSlider-next btn-next">
                            <svg viewBox="0 0 1024 1024">
                                <path fill="#ffff"
                                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="center-btn">
                    <a href="destinations.html" class="btn btn-outline-primary">View All Destinations</a>
                </div>
            </div>
        </section>

        <!-- ============ WHY BOOK WITH US ============ -->
        <section class="sec-f">
            <div class="container">
                <div class="heading">
                    <h3>Why Book <span>With Us</span></h3>
                    <p>
                        Trusted by thousands of travellers for seamless, well-planned
                        trips.
                    </p>
                </div>

                <div class="usp-grid">
                    <div class="usp-item">
                        <div class="usp-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2 2 7l10 5 10-5-10-5Z" />
                                <path d="M2 17l10 5 10-5" />
                                <path d="M2 12l10 5 10-5" />
                            </svg>
                        </div>
                        <h5>Expertly Planned Trips</h5>
                        <p>
                            Itineraries curated by travel specialists with on-ground
                            destination knowledge.
                        </p>
                    </div>

                    <div class="usp-item">
                        <div class="usp-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                                stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9" />
                                <path d="M12 7v5l3 3" />
                            </svg>
                        </div>
                        <h5>Best Price Assistance</h5>
                        <p>
                            Transparent pricing with no hidden costs, plus help finding the
                            best available deal.
                        </p>
                    </div>

                    <div class="usp-item">
                        <div class="usp-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                            </svg>
                        </div>
                        <h5>Dedicated Travel Support</h5>
                        <p>
                            A real person to call before, during and after your trip — not a
                            chatbot queue.
                        </p>
                    </div>

                    <div class="usp-item">
                        <div class="usp-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 6h16M4 12h10M4 18h6" />
                            </svg>
                        </div>
                        <h5>Flexible Customization</h5>
                        <p>
                            Tailor hotels, activities and duration to match exactly what
                            you're looking for.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ TESTIMONIALS ============ -->
        <section class="about-secI">
            <div class="container">
                <div class="heading">
                    <h3>What Travelers <span>Say</span></h3>
                    <p>
                        See what our travelers say about their trip planning experience
                        and holiday packages.
                    </p>
                </div>

                <div class="swiper TestimonialSlider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="card">
                                <div class="header">
                                    <img loading="lazy" src="assets/images/home/client1.png" alt="Rahul Sharma" />
                                    <div class="name">
                                        <h6>Rahul Sharma</h6>
                                        <p>Dubai Traveller</p>
                                    </div>
                                    <div class="quotes"></div>
                                </div>
                                <p class="quote">
                                    "The package options made it very easy to compare
                                    destinations, duration and pricing. We found exactly what we
                                    were looking for."
                                </p>
                                <div class="stars"></div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="card">
                                <div class="header">
                                    <img loading="lazy" src="assets/images/home/client2.png" alt="Priya Mehta" />
                                    <div class="name">
                                        <h6>Priya Mehta</h6>
                                        <p>Family Traveller</p>
                                    </div>
                                    <div class="quotes"></div>
                                </div>
                                <p class="quote">
                                    "We were able to find a family-friendly package within our
                                    budget. The entire search and enquiry process was smooth."
                                </p>
                                <div class="stars"></div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="card">
                                <div class="header">
                                    <img loading="lazy" src="assets/images/home/client3.png" alt="Amit Verma" />
                                    <div class="name">
                                        <h6>Amit Verma</h6>
                                        <p>Holiday Traveller</p>
                                    </div>
                                    <div class="quotes"></div>
                                </div>
                                <p class="quote">
                                    "The search filters helped us narrow down the right holiday
                                    package quickly. The package details were clear and useful."
                                </p>
                                <div class="stars"></div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="card">
                                <div class="header">
                                    <img loading="lazy" src="assets/images/home/client2.png" alt="Neha Kapoor" />
                                    <div class="name">
                                        <h6>Neha Kapoor</h6>
                                        <p>Couple Traveller</p>
                                    </div>
                                    <div class="quotes"></div>
                                </div>
                                <p class="quote">
                                    "There were plenty of options to choose from, and updating
                                    the search made it simple to explore different packages."
                                </p>
                                <div class="stars"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ APP PROMO / CTA ============ -->
        <section class="app-promo">
            <div class="container">
                <div class="app-promo-inner">
                    <div class="app-promo-text">
                        <span class="eyebrow">Need Help Planning?</span>
                        <h3>Can't Find Your Perfect Trip?</h3>
                        <p>
                            Tell us what you're looking for and our travel experts will help
                            create a package that fits your plans and budget.
                        </p>
                        <div class="cta-btns">
                            <a href="javascript:void(0)" class="sbmt btn btn-white js-open-enquiry">Plan My Trip</a>
                            <a href="javascript:void(0)" class="btn btn-outline-white js-open-enquiry">Enquire Now</a>
                        </div>
                    </div>
                    <div class="app-promo-visual">
                        <div class="phone phone--back">
                            <img loading="lazy" src="assets/icon/h3-destination-shape.png" alt="Plan your trip" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <div class="overlay"></div>

    <div class="model modify-search-pop">
        <button type="button" class="close" aria-label="Close">
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.5 0.5L25.5 25.5M0.5 25.5L25.5 0.5" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>

        <div class="model-body">
            <div class="title">
                <h4>Modify Your Search</h4>
                <p>Update your travel details to refine your results.</p>
            </div>

            <form class="form" data-modify-search-form>
                <div class="field-group">
                    <label for="msDestination">Destination</label>
                    <select id="msDestination" class="js-nice-select">
                        <option value="dubai" selected>Dubai</option>
                        <option value="abudhabi">Abu Dhabi</option>
                        <option value="sharjah">Sharjah</option>
                    </select>
                </div>

                <!-- Date Field -->
                <div class="field-group">
                    <div class="form-group">
                        <input type="text" name="dates" />
                        <label for="txtModifyEventDate" class="label">Travel Date*</label>
                        <img loading="lazy" src="assets/icon/date.svg" alt="" class="date-icon" />
                    </div>
                </div>

                <div class="field-group field-row">
                    <div>
                        <label for="msAdults">Adults</label>
                        <div class="stepper">
                            <button type="button" data-step="minus" data-target="msAdults" aria-label="Decrease adults">
                                −
                            </button>
                            <input type="number" id="msAdults" value="2" min="1" readonly />
                            <button type="button" data-step="plus" data-target="msAdults" aria-label="Increase adults">
                                +
                            </button>
                        </div>
                    </div>
                    <div>
                        <label for="msChildren">Children</label>
                        <div class="stepper">
                            <button type="button" data-step="minus" data-target="msChildren" aria-label="Decrease children">
                                −
                            </button>
                            <input type="number" id="msChildren" value="0" min="0" readonly />
                            <button type="button" data-step="plus" data-target="msChildren" aria-label="Increase children">
                                +
                            </button>
                        </div>
                    </div>
                </div>

                <div class="field-group">
                    <label for="msTravelType">Travel Type</label>
                    <select id="msTravelType" class="js-nice-select">
                        <option value="family" selected>Family</option>
                        <option value="honeymoon">Honeymoon</option>
                        <option value="adventure">Adventure</option>
                        <option value="luxury">Luxury</option>
                        <option value="group">Group</option>
                    </select>
                </div>

                <div class="field-group">
                    <label for="msBudget">Budget</label>
                    <select id="msBudget" class="js-nice-select">
                        <option value="under50k">Under ₹50,000</option>
                        <option value="50-100k" selected>₹50,000 – ₹1,00,000</option>
                        <option value="100-200k">₹1,00,000 – ₹2,00,000</option>
                        <option value="200kplus">₹2,00,000+</option>
                    </select>
                </div>

                <div class="submit-group">
                    <button type="submit" class="btn btn-primary drawer-submit">
                        Search Packages
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function () {

            /* ---------- Drawers (enquiry etc.) ---------- */
            $("[data-drawer-open]").on("click", function (e) {
                e.preventDefault();
                var name = $(this).data("drawer-open") || "enquiry";
                var $drawer = $('[data-drawer="' + name + '"]');
                if ($drawer.length) {
                    $drawer.addClass("is-open");
                    $("body").addClass("drawer-open");
                }
            });

            $("[data-enquiry-open]").on("click", function (e) {
                e.preventDefault();
                var $drawer = $('[data-drawer="enquiry"]');
                if ($drawer.length) {
                    $drawer.addClass("is-open");
                    $("body").addClass("drawer-open");
                }
            });

            function closeDrawer($drawer) {
                if (!$drawer || !$drawer.length) $drawer = $(".drawer.is-open");
                $drawer.removeClass("is-open");
                if (!$(".drawer.is-open").length) $("body").removeClass("drawer-open");
            }

            $(document).on("click", "[data-drawer-close]", function (e) {
                e.preventDefault();
                closeDrawer($(this).closest(".drawer"));
            });

            $(document).on("keydown", function (e) {
                if (e.key === "Escape") closeDrawer();
            });

            /* ---------- Stepper (modify-search modal) ---------- */
            $(document).on("click", ".stepper button", function (e) {
                e.preventDefault();
                var $button = $(this);
                var $input = $("#" + $button.data("target"));
                if (!$input.length) return;

                var value = parseInt($input.val(), 10) || 0;
                var min = parseInt($input.attr("min"), 10) || 0;
                var max = parseInt($input.attr("max"), 10);

                if ($button.data("step") === "plus") {
                    value = isNaN(max) ? value + 1 : Math.min(value + 1, max);
                } else if (value > min) {
                    value--;
                }
                $input.val(value);
            });

            /* ---------- Accordion filter groups ---------- */
            $(".filter-group-body").css("display", "flex");

            $(document).on("click", ".js-accordion-toggle", function () {
                var $group = $(this).closest(".filter-group");
                var $body = $group.find(".filter-group-body");

                if ($group.hasClass("is-collapsed")) {
                    $body.stop(true, true).slideDown(250, function () { $(this).css("display", "flex"); });
                    $group.removeClass("is-collapsed");
                } else {
                    $body.stop(true, true).slideUp(250);
                    $group.addClass("is-collapsed");
                }
            });

            /* ---------- Mobile filter drawer ---------- */
            var $sidebar = $(".sec-c-sidebar");
            var $overlay = $(".js-sidebar-overlay");

            function openFilterDrawer() {
                $sidebar.addClass("is-open");
                $overlay.addClass("is-open");
                document.body.style.overflow = "hidden";
            }
            function closeFilterDrawer() {
                $sidebar.removeClass("is-open");
                $overlay.removeClass("is-open");
                document.body.style.overflow = "";
            }

            $(".js-open-filter-drawer").on("click", openFilterDrawer);
            $(document).on("click", ".js-close-filter-drawer", closeFilterDrawer);
            $overlay.on("click", closeFilterDrawer);

            /* ---------- Filter form ---------- */
            var $form = $("#filterForm");
            var isDesktop = function () { return window.innerWidth >= 992; };

            function autoSubmit() {
                if (isDesktop() && $form.length) $form[0].requestSubmit();
            }

            // desktop: apply as soon as a checkbox / radio changes
            $form.on("change", "input[type=checkbox], input[type=radio]", autoSubmit);

            // keep the URL clean: drop empty / default values
            $form.on("submit", function () {
                $form.find("input[name]").each(function () {
                    var $i = $(this);
                    var def = $i.attr("data-default");
                    var isDefaultPrice = def !== undefined && $i.val() === def;
                    var isEmpty = $i.attr("type") !== "checkbox" && $i.attr("type") !== "radio" && $i.val() === "";
                    var isDefaultSort = $i.attr("name") === "sort" && $i.val() === "recommended";

                    if (isDefaultPrice || isEmpty || isDefaultSort) $i.prop("disabled", true);
                });
            });

            // browser Back button: re-enable whatever we disabled
            $(window).on("pageshow", function () {
                $form.find("input:disabled").prop("disabled", false);
            });

            /* ---------- Sort (desktop + mobile selects) ---------- */
            $(document).on("change", ".js-sort-select", function () {
                $("#filterSort").val($(this).val());
                $form[0].requestSubmit();
            });

            /* ---------- Price range slider ---------- */
            var $slider = $(".js-price-range");

            if ($slider.length) {
                var MIN = +$slider.data("min");
                var MAX = +$slider.data("max");
                var STEP = 5000;
                var cur = { min: +$slider.data("cur-min"), max: +$slider.data("cur-max") };

                var $fill = $slider.find(".js-range-fill");
                var $minH = $slider.find('[data-handle="min"]');
                var $maxH = $slider.find('[data-handle="max"]');
                var $minL = $(".js-price-min-label");
                var $maxL = $(".js-price-max-label");
                var $minI = $("#filterMinPrice");
                var $maxI = $("#filterMaxPrice");

                function pct(v) { return ((v - MIN) / (MAX - MIN)) * 100; }
                function fmt(v) { return "₹" + v.toLocaleString("en-IN"); }

                function render() {
                    var a = pct(cur.min), b = pct(cur.max);
                    $minH.css("left", a + "%");
                    $maxH.css("left", b + "%");
                    $fill.css({ left: a + "%", width: (b - a) + "%" });
                    $minL.text(fmt(cur.min));
                    $maxL.text(fmt(cur.max) + (cur.max >= MAX ? "+" : ""));
                    $minI.val(cur.min);
                    $maxI.val(cur.max);
                }

                $slider.find(".js-range-handle").css("touch-action", "none").on("pointerdown", function (e) {
                    e.preventDefault();
                    var which = $(this).data("handle");
                    var rect = $slider[0].getBoundingClientRect();

                    $(document).on("pointermove.rs", function (ev) {
                        var p = Math.min(1, Math.max(0, (ev.clientX - rect.left) / rect.width));
                        var v = Math.round((MIN + p * (MAX - MIN)) / STEP) * STEP;

                        if (which === "min") cur.min = Math.max(MIN, Math.min(v, cur.max - STEP));
                        else cur.max = Math.min(MAX, Math.max(v, cur.min + STEP));

                        render();
                    });

                    $(document).on("pointerup.rs pointercancel.rs", function () {
                        $(document).off(".rs");
                        autoSubmit();
                    });
                });

                render();
            }
        });
    </script>
@endpush