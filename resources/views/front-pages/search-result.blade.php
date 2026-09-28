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
                <img loading="lazy"
                    src="{{ $searchPageContent->hero_image ? asset('storage/' . $searchPageContent->hero_image) : asset('assets/images/blog/dubai.jpg') }}"
                    alt="Search results" />
                <div class="sec-hero-overlay"></div>
            </div>

            <div class="container">
                <div class="sec-hero-head">
                    <h1>{{ $searchPageContent->hero_title }}</h1>
                    <p>{{ $searchPageContent->hero_description }}</p>
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
                                                    <label class="filter-check"> <input type="checkbox" name="category[]"
                                                            value="{{ $cat->id }}" {{ in_array((string) $cat->id, $selected['category'], true) ? 'checked' : '' }} />
                                                        <span class="box"></span>
                                                        {{ $cat->name }}
                                                    </label>

                                                    @if($cat->subCategories->isNotEmpty())
                                                        <div class="filter-subgroup">
                                                            @foreach($cat->subCategories as $sub)
                                                                <label class="filter-check filter-check--sub"><input type="checkbox"
                                                                        name="sub_category[]" value="{{ $sub->id }}" {{ in_array((string) $sub->id, $selected['subCategory'], true) ? 'checked' : '' }} />
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
                                                    <label class="filter-check"><input type="checkbox" name="activity_category[]"
                                                            value="{{ $cat->id }}" {{ in_array((string) $cat->id, $selected['activityCategory'], true) ? 'checked' : '' }} />
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
                            @foreach ($featuredDestinations as $destination)
                                <div class="swiper-slide">
                                    <a href="{{ route('destination.show', $destination) }}" class="dest-card">
                                        <div class="dest-card-img">
                                            <img loading="lazy"
                                                src="{{ $destination->image ? asset('storage/' . $destination->image) : asset('assets/images/blog/beach.jpg') }}"
                                                alt="{{ $destination->name }}" />
                                        </div>
                                        <div class="dest-card-content">
                                            <span class="pkg-count">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M20 6 9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                {{ $destination->tour_packages_count }} Packages
                                            </span>
                                            <div class="place">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="10" r="3" />
                                                    <path
                                                        d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
                                                </svg>
                                                {{ $destination->country?->name }}
                                            </div>
                                            <h5>{{ $destination->name }}</h5>
                                            <div class="foot">
                                                <p class="price">
                                                    <small>Starting from</small>
                                                    @if ($destination->tourPackages->min('price'))
                                                        ₹{{ number_format($destination->tourPackages->min('price')) }}
                                                    @else
                                                        —
                                                    @endif
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
                            @endforeach
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
                    <a href="{{ route('destinations') }}" class="btn btn-outline-primary">View All Destinations</a>
                </div>
            </div>
        </section>

        <!-- ============ WHY BOOK WITH US ============ -->
        <section class="sec-f">
            <div class="container">
                <div class="heading">
                    <h3>Why Book <span>With Us</span></h3>
                    <p>Trusted by thousands of travellers for seamless, well-planned trips.</p>
                </div>

                <div class="usp-grid">
                    @foreach ($searchPageContent->usps as $usp)
                        <div class="usp-item">
                            <div class="usp-icon">
                                @if (!empty($usp['icon']))
                                    <img src="{{ asset('storage/' . $usp['icon']) }}" alt="{{ $usp['title'] }}"
                                        style="width:28px;height:28px;">
                                @else
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="9" />
                                    </svg>
                                @endif
                            </div>
                            <h5>{{ $usp['title'] }}</h5>
                            <p>{{ $usp['description'] }}</p>
                        </div>
                    @endforeach
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
                        @forelse ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="card">
                                    <div class="header">
                                        <img loading="lazy"
                                            src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('assets/images/home/client1.png') }}"
                                            alt="{{ $testimonial->name }}" />
                                        <div class="name">
                                            <h6>{{ $testimonial->name }}</h6>
                                            <p>{{ $testimonial->designation }}</p>
                                        </div>
                                        <div class="quotes"></div>
                                    </div>
                                    <p class="quote">"{{ $testimonial->quote }}"</p>
                                    <div class="stars" data-rating="{{ $testimonial->rating }}">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa {{ $i <= $testimonial->rating ? 'fa-star' : 'fa-star-o' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @empty
                            {{-- no testimonials yet; section renders empty rather than breaking the slider --}}
                        @endforelse
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