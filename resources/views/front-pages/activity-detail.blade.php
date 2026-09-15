@extends('layouts.app')

@section('title', 'Activities Detail | Indo Tours & Adventures')
@section('meta_description', 'Indo Tours & Adventures is a leading travel company offering a wide range of tour packages, including domestic and international destinations. Explore the world with our expertly crafted itineraries and exceptional services.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/activities-detail/detail.css') }}" />
@endpush

@section('content')

    <main>

        <!-- DETAIL BANNER -->
        <section class="detail-banner">
            <div class="container">
                <nav class="breadcrumb breadcrumb-dark" aria-label="Breadcrumb">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><span class="breadcrumb-separator">/</span></li>
                        @if($activity->city)
                            <li><a href="/{{ $activity->city->slug }}/">{{ $activity->city->name }}</a></li>
                            <li><span class="breadcrumb-separator">/</span></li>
                        @endif
                        <li>
                            <a href="/{{ $activity->city->slug ?? '' }}/activities/" class="active">Activities</a>
                        </li>
                    </ul>
                </nav>

                <div class="grid">
                    <div class="item-img item-main">
                        <img loading="lazy"
                            src="{{ $activity->main_image ? asset('storage/' . $activity->main_image) : asset('assets/images/blog/dubai.jpg') }}"
                            alt="{{ $activity->name }}" />
                        <div class="image-overlay"></div>
                        <div class="image-content main-content">
                            @if($activity->banner_tag)
                                <span class="image-tag">{{ $activity->banner_tag }}</span>
                            @endif
                            <h1>{{ $activity->name }}</h1>
                            @if($activity->banner_description)
                                <p>{{ $activity->banner_description }}</p>
                            @endif
                        </div>

                        <div class="img-actions">
                            <a data-fancybox="gallery1"
                                href="{{ $activity->main_image ? asset('storage/' . $activity->main_image) : '#' }}"
                                type="button" class="action-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M16.375 4.5H4.625a.125.125 0 0 0-.125.125v8.254l2.859-1.54a.75.75 0 0 1 .68-.016l2.384 1.142l2.89-2.074a.75.75 0 0 1 .874 0l2.313 1.66V4.625a.125.125 0 0 0-.125-.125m.125 9.398l-2.75-1.975l-2.813 2.02a.75.75 0 0 1-.76.067l-2.444-1.17L4.5 14.583v1.792c0 .069.056.125.125.125h11.75a.125.125 0 0 0 .125-.125zM4.625 3C3.728 3 3 3.728 3 4.625v11.75C3 17.273 3.728 18 4.625 18h11.75c.898 0 1.625-.727 1.625-1.625V4.625C18 3.728 17.273 3 16.375 3zM20 8v11c0 .69-.31 1-.999 1H6v1.5h13.001c1.52 0 2.499-.982 2.499-2.5V8z"
                                        clip-rule="evenodd" />
                                </svg>
                                Gallery
                            </a>
                            @if($activity->banner_top_image)
                                <a data-fancybox="gallery1" href="{{ asset('storage/' . $activity->banner_top_image) }}"></a>
                            @endif
                            @if($activity->banner_left_image)
                                <a data-fancybox="gallery1" href="{{ asset('storage/' . $activity->banner_left_image) }}"></a>
                            @endif
                            @if($activity->banner_right_image)
                                <a data-fancybox="gallery1" href="{{ asset('storage/' . $activity->banner_right_image) }}"></a>
                            @endif

                            @if($activity->video_url)
                                <button data-video="{{ $activity->video_url }}" type="button" class="action-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M0 0h24v24H0z" fill="none" />
                                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2">
                                            <rect width="20" height="16" x="2" y="4" rx="4" />
                                            <path d="m15 12l-5-3v6z" />
                                        </g>
                                    </svg>
                                    Video
                                </button>
                            @endif
                        </div>
                    </div>

                    @if($activity->banner_top_image)
                        <div class="item-img item-top">
                            <img loading="lazy" src="{{ asset('storage/' . $activity->banner_top_image) }}"
                                alt="{{ $activity->banner_top_title }}" />
                            <div class="image-overlay"></div>
                            <div class="image-content">
                                @if($activity->banner_top_label)
                                    <span class="image-label">{{ $activity->banner_top_label }}</span>
                                @endif
                                @if($activity->banner_top_title)
                                    <h3>{{ $activity->banner_top_title }}</h3>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($activity->banner_left_image)
                        <div class="item-img item-bottom-left">
                            <img loading="lazy" src="{{ asset('storage/' . $activity->banner_left_image) }}"
                                alt="{{ $activity->banner_left_title }}" />
                            <div class="image-overlay"></div>
                            <div class="image-content">
                                @if($activity->banner_left_label)
                                    <span class="image-label">{{ $activity->banner_left_label }}</span>
                                @endif
                                @if($activity->banner_left_title)
                                    <h3>{{ $activity->banner_left_title }}</h3>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($activity->banner_right_image)
                        <div class="item-img item-bottom-right">
                            <img loading="lazy" src="{{ asset('storage/' . $activity->banner_right_image) }}"
                                alt="{{ $activity->banner_right_title }}" />
                            <div class="image-overlay"></div>
                            <div class="image-content">
                                @if($activity->banner_right_label)
                                    <span class="image-label">{{ $activity->banner_right_label }}</span>
                                @endif
                                @if($activity->banner_right_title)
                                    <h3>{{ $activity->banner_right_title }}</h3>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <div class="banner-swiper swiper">
                    <div class="swiper-wrapper">
                        @foreach([$activity->main_image, $activity->banner_top_image, $activity->banner_left_image, $activity->banner_right_image] as $img)
                            @if($img)
                                <div class="swiper-slide">
                                    <img loading="lazy" src="{{ asset('storage/' . $img) }}" alt="{{ $activity->name }}" />
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="image-overlay"></div>
                    <div class="image-content main-content">
                        @if($activity->banner_tag)
                            <span class="image-tag">{{ $activity->banner_tag }}</span>
                        @endif
                        <h1>{{ $activity->name }}</h1>
                        @if($activity->banner_description)
                            <p>{{ $activity->banner_description }}</p>
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

                <div class="banner-meta">
                    @if($activity->location_label)
                        <span class="location">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <circle cx="12" cy="10" r="3" />
                                    <path
                                        d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
                                </g>
                            </svg>
                            {{ $activity->location_label }}
                        </span>
                    @endif

                    <div class="meta-actions">
                        <button type="button" class="meta-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor" d="m21 12l-7-7v4C7 10 4 15 3 20c2.5-3.5 6-5.1 11-5.1V19z" />
                            </svg>
                            Share
                        </button>
                        <button type="button" class="meta-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M5.624 4.424C3.965 5.182 2.75 6.986 2.75 9.137c0 2.197.9 3.891 2.188 5.343c1.063 1.196 2.349 2.188 3.603 3.154q.448.345.885.688c.526.415.995.778 1.448 1.043s.816.385 1.126.385s.674-.12 1.126-.385c.453-.265.922-.628 1.448-1.043q.437-.344.885-.687c1.254-.968 2.54-1.959 3.603-3.155c1.289-1.452 2.188-3.146 2.188-5.343c0-2.15-1.215-3.955-2.874-4.713c-1.612-.737-3.778-.542-5.836 1.597a.75.75 0 0 1-1.08 0C9.402 3.882 7.236 3.687 5.624 4.424M12 4.46C9.688 2.39 7.099 2.1 5 3.059C2.786 4.074 1.25 6.426 1.25 9.138c0 2.665 1.11 4.699 2.567 6.339c1.166 1.313 2.593 2.412 3.854 3.382q.43.33.826.642c.513.404 1.063.834 1.62 1.16s1.193.59 1.883.59s1.326-.265 1.883-.59c.558-.326 1.107-.756 1.62-1.16q.396-.312.826-.642c1.26-.97 2.688-2.07 3.854-3.382c1.457-1.64 2.567-3.674 2.567-6.339c0-2.712-1.535-5.064-3.75-6.077c-2.099-.96-4.688-.67-7 1.399"
                                    clip-rule="evenodd" />
                            </svg>
                            Add To Wishlist
                        </button>
                    </div>
                </div>

                <div class="banner-quick-info">
                    <div class="quick-info-left">
                        @if($activity->rating)
                            <div class="qi-rating">
                                <span class="qi-score">{{ number_format($activity->rating, 1) }}</span>
                                <div class="qi-stars">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                    @endfor
                                </div>
                                <a href="#all-reviews" class="qi-count">{{ $activity->review_count }} Reviews</a>
                            </div>

                            <span class="qi-divider"></span>
                        @endif

                        @if($activity->duration_text)
                            <div class="qi-fact">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <path fill="currentColor"
                                        d="M12 20a8 8 0 1 1 0-16a8 8 0 0 1 0 16m0-18a10 10 0 1 0 0 20a10 10 0 0 0 0-20m.5 5H11v6l5.2 3.2l.8-1.3l-4.5-2.7z" />
                                </svg>
                                {{ $activity->duration_text }}
                            </div>
                        @endif

                        @if($activity->location_label)
                            <div class="qi-fact">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path fill="currentColor"
                                        d="M4.385 17.385v-6.29q0-.324.13-.629q.131-.304.349-.522L8.248 6.56q.242-.242.54-.353q.299-.112.597-.112t.596.112t.54.353l3.385 3.385q.217.217.348.522t.13.628v6.29q0 .672-.471 1.144q-.473.472-1.144.472H6q-.671 0-1.143-.472q-.473-.472-.473-1.144M6 18h2.615v-1.538q0-.31.22-.54t.55-.23q.31 0 .539.23t.23.54V18h2.615q.27 0 .443-.173t.173-.442v-6.31q0-.115-.039-.221q-.038-.106-.134-.202L9.827 7.267q-.173-.173-.442-.173q-.27 0-.443.173l-3.384 3.385q-.096.096-.135.202t-.039.221v6.31q0 .269.174.442Q5.73 18 6 18m10 .52v-8.518q0-.115-.039-.221t-.134-.202l-3.302-3.302q-.244-.244-.12-.549q.126-.305.474-.305q.104 0 .198.04t.162.106l3.282 3.283q.218.217.348.522t.131.628v8.517q0 .214-.143.357t-.357.143t-.357-.143t-.143-.357m2.615 0V8.91q0-.115-.038-.22t-.135-.203l-2.19-2.19q-.244-.244-.12-.559t.474-.314q.104 0 .198.04q.094.039.162.106l2.19 2.19q.217.218.338.523t.122.627v9.61q0 .214-.144.357q-.143.143-.356.143q-.214 0-.357-.143t-.144-.357M6 18h7.385h-8zm2.845-5.46q-.23-.23-.23-.54t.23-.54t.54-.23t.539.23t.23.54t-.23.54t-.54.23t-.539-.23" />
                                </svg>
                                {{ $activity->location_label }}
                            </div>
                        @endif

                        @if($activity->free_cancellation_text)
                            <div class="qi-fact">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path fill="currentColor"
                                        d="M12 2C6.486 2 2 6.486 2 12v4.143C2 17.167 2.897 18 4 18h1a1 1 0 0 0 1-1v-5.143a1 1 0 0 0-1-1h-.908C4.648 6.987 7.978 4 12 4s7.352 2.987 7.908 6.857H19a1 1 0 0 0-1 1V18c0 1.103-.897 2-2 2h-2v-1h-4v3h6c2.206 0 4-1.794 4-4c1.103 0 2-.833 2-1.857V12c0-5.514-4.486-10-10-10" />
                                </svg>
                                {{ $activity->free_cancellation_text }}
                            </div>
                        @endif
                    </div>

                    @if($activity->starting_price)
                        <div class="quick-info-right">
                            <div class="qi-price">
                                <span class="qi-label">Starting from</span>
                                <span class="qi-amount">₹ {{ number_format($activity->starting_price) }}
                                    <small>{{ $activity->price_unit }}</small></span>
                            </div>
                            <a href="#package-options" class="btn btn-primary qi-book-btn">Book Now</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- INFO SECTION -->
        <section class="activity-info-sec">
            <div class="container">
                <div class="info-grid">
                    <div class="info-main">
                        @if($activity->about_content)
                            <div class="tab-block">
                                <h6>{{ $activity->about_title ?: 'About ' . $activity->name }}</h6>
                                <p>{{ $activity->about_content }}</p>
                            </div>
                        @endif

                        @if(!empty($activity->highlights))
                            <div class="tab-block">
                                <h6>Highlights</h6>
                                <ul class="check-list">
                                    @foreach($activity->highlights as $highlight)
                                        <li>{{ $highlight }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($activity->what_to_expect_content)
                            <div class="tab-block">
                                <h6>What to Expect</h6>
                                <p>{{ $activity->what_to_expect_content }}</p>
                            </div>
                        @endif

                        @if(!empty($activity->know_before_you_go))
                            <div class="tab-block">
                                <h6>Know Before You Go</h6>
                                <ul class="check-list">
                                    @foreach($activity->know_before_you_go as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    @if($activity->starting_price)
                        <aside class="info-sidebar">
                            <div class="sidebar-card">
                                <span class="sidebar-label">Starting from</span>
                                <h3 class="sidebar-price">₹ {{ number_format($activity->starting_price) }} <small>per
                                        Adult</small></h3>

                                @if(!empty($activity->sidebar_points))
                                    <ul class="sidebar-points">
                                        @foreach($activity->sidebar_points as $point)
                                            <li>{{ $point }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <a href="#package-options" class="btn btn-primary sidebar-btn">Select Package</a>
                                <button class="btn btn-outline-primary sidebar-btn" type="button" data-model=".enquire-pop">
                                    Have a Question?
                                </button>
                            </div>
                        </aside>
                    @endif
                </div>
            </div>
        </section>

        <!-- PACKAGE OPTION SECTION -->
        <section class="package-tabs-sec" id="package-options">
            <div class="container">
                <!-- Heading -->
                <div class="heading">
                    <h3>Select <span>Package Options</span></h3>
                </div>

                <!-- Tab Navigation -->
                <ul class="tab-nav">
                    <li class="active" data-tab="package">Package Options</li>
                    <li data-tab="map">Map</li>
                    <li data-tab="policies">Policies</li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-nav-content">

                    <!-- PACKAGE OPTIONS TAB -->
                    <div class="tabs active" data-tab="package">
                        <div class="package-grid">
                            @foreach($activity->packages as $package)
                                <div class="package-card {{ $package->is_recommended ? 'recommended' : '' }}">
                                    @if($package->is_recommended)
                                        <span class="ribbon">Most Popular</span>
                                    @endif

                                    <div class="package-top">
                                        <h4>{{ $package->title }}</h4>
                                        @if($package->duration_label)
                                            <span class="package-duration">{{ $package->duration_label }}</span>
                                        @endif
                                    </div>

                                    @if($package->description)
                                        <p class="package-desc">{{ $package->description }}</p>
                                    @endif

                                    @if(!empty($package->includes))
                                        <ul class="package-includes">
                                            @foreach($package->includes as $include)
                                                <li>{{ $include }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if($package->new_price)
                                        <div class="package-price">
                                            @if($package->old_price)
                                                <span class="old-price">₹ {{ number_format($package->old_price) }}</span>
                                            @endif
                                            <span class="new-price">₹ {{ number_format($package->new_price) }}</span>
                                            @if($package->save_text)
                                                <span class="save-tag">{{ $package->save_text }}</span>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="package-actions">
                                        <a href="tel:+911234567890" class="btn btn-outline-primary">Call Us</a>
                                        <button type="button" data-model=".enquire-pop" class="btn btn-primary">Enquire
                                            Now</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- MAP TAB -->
                    <div class="tabs" data-tab="map">
                        <div class="map-block">
                            @if($activity->map_embed_url)
                                <div class="map-embed">
                                    <iframe src="{{ $activity->map_embed_url }}" width="100%" height="100%" style="border: 0"
                                        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                            @endif

                            <div class="map-address">
                                <h6>Activity Location</h6>

                                @if($activity->map_address)
                                    <p>{{ $activity->map_address }}</p>
                                @endif

                                @if(!empty($activity->map_points))
                                    <ul class="check-list">
                                        @foreach($activity->map_points as $point)
                                            <li>
                                                <span class="check-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                                                    </svg>
                                                </span>
                                                {{ $point }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if($activity->map_directions_url)
                                    <a href="{{ $activity->map_directions_url }}" target="_blank" rel="noopener"
                                        class="btn btn-outline-primary">
                                        Get Directions
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- POLICIES TAB -->
                    <div class="tabs" data-tab="policies">
                        @forelse($activity->policies as $block)
                            <div class="tab-block">
                                <h6>{{ $block->title }}</h6>

                                <ul class="check-list">
                                    @foreach($block->points as $point)
                                        <li>
                                            <span class="check-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                                                </svg>
                                            </span>
                                            {{ $point }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @empty
                            {{-- no policy blocks configured for this activity --}}
                        @endforelse
                    </div>

                </div>
            </div>
        </section>

        <!-- ATTRACTION SECTION -->
        @if($activity->attractions->isNotEmpty())
            <section class="dubai-attractions-sec">
                <div class="container">
                    <div class="heading">
                        <h3>{{ $activity->city->name ?? '' }} <span>Top Attractions</span></h3>
                    </div>

                    <div class="mini-grid">
                        @foreach($activity->attractions as $attraction)
                            <a href="{{ route('attraction.show', $attraction->slug) }}" class="mini-card">
                                <div class="mini-img">
                                    <img loading="lazy"
                                        src="{{ $attraction->image ? asset('storage/' . $attraction->image) : asset('assets/images/blog/dubai.jpg') }}"
                                        alt="{{ $attraction->name }}" />
                                </div>
                                <div class="mini-content">
                                    <h6>{{ $attraction->name }}</h6>
                                    <p>{{ $attraction->short_description }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- REVIEW SECTION -->
        <section class="detail-secF">
            <div class="heading">
                <h3>Traveler <span>Reviews</span></h3>
                <a href="javascript:void()" class="btn btn-secondary" data-model=".review_pop">Write a Review</a>
            </div>

            @php
                $reviewCount = $activity->reviews->count();
                $avgRating = $reviewCount ? round($activity->reviews->avg('rating'), 1) : 0;

                $ratingCounts = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
                foreach ($activity->reviews as $r) {
                    $star = (int) round($r->rating);
                    if (isset($ratingCounts[$star])) {
                        $ratingCounts[$star]++;
                    }
                }
            @endphp

            @if($reviewCount)
                <div class="grid">
                    <div class="rating-wrapper">
                        <h2>{{ $avgRating }}</h2>
                        <div class="stars">
                            @for($i = 0; $i < 5; $i++)
                                <svg viewBox="0 0 24 24" fill="currentColor"
                                    style="{{ $i < round($avgRating) ? '' : 'opacity:.3' }}">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z">
                                    </path>
                                </svg>
                            @endfor
                        </div>

                        <p class="total-reviews">{{ $reviewCount }} Reviews</p>

                        <div class="rating-bars">
                            @for($star = 5; $star >= 1; $star--)
                                @php
                                    $count = $ratingCounts[$star];
                                    $percent = $reviewCount ? round(($count / $reviewCount) * 100) : 0;
                                @endphp
                                <div class="bar-row">
                                    <span class="label">{{ $star }}</span>
                                    <div class="bar-track">
                                        <div class="bar-fill" style="width: {{ $percent }}%"></div>
                                    </div>
                                    <span class="count">{{ $count }}</span>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="swiper-wrap">
                        <div class="swiper reviewSlider">
                            <div class="swiper-wrapper">
                                @foreach($activity->reviews as $review)
                                    <div class="swiper-slide">
                                        <div class="card">
                                            <div class="header">
                                                @if($review->photo)
                                                    <img loading="lazy" src="{{ asset('storage/' . $review->photo) }}"
                                                        alt="{{ $review->full_name }}" />
                                                @else
                                                    <div class="avatar-initials">{{ $review->initials() }}</div>
                                                @endif

                                                <div class="name">
                                                    <h6>{{ $review->full_name }}</h6>
                                                    <p>{{ $review->designation ?: 'Traveller' }}</p>
                                                </div>

                                                <div class="quotes">
                                                    <svg width="34" height="26" viewBox="0 0 44 34" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5654 42.7691 19.7951 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                                                            fill="white" stroke="#D1D1D1" />
                                                    </svg>
                                                </div>
                                            </div>

                                            <p class="quote">"{{ $review->review }}"</p>

                                            <div class="stars">
                                                @for($i = 0; $i < 5; $i++)
                                                    <svg viewBox="0 0 24 24" fill="currentColor"
                                                        style="{{ $i < $review->rating ? '' : 'opacity:.3' }}">
                                                        <path
                                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="swiper-group">
                            <div class="progress-track">
                                <div class="swiper-pagination"></div>
                            </div>
                            <div class="btns">
                                <button type="button" class="review-prev" aria-label="Previous review">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                        <path fill="#ffff"
                                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                                    </svg>
                                </button>
                                <button type="button" class="review-next" aria-label="Next review">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                        <path fill="#ffff"
                                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p style="padding: 20px 0; color:#6d7175;">No reviews yet. Be the first to share your experience!</p>
            @endif
        </section>

        <!-- ALL REVIEW SECTION -->
        @if($activity->reviews->isNotEmpty())
            <section class="all-reviews-grid-sec" id="all-reviews">
                <div class="container">
                    <div class="heading">
                        <h3>All <span>Reviews</span></h3>
                    </div>

                    <div class="reviews-grid">
                        @foreach($activity->reviews as $review)
                            <div class="review-card">
                                <div class="review-top">
                                    <div class="reviewer">
                                        @if($review->photo)
                                            <img loading="lazy" src="{{ asset('storage/' . $review->photo) }}"
                                                alt="{{ $review->full_name }}" />
                                        @else
                                            <div class="avatar-initials">{{ $review->initials() }}</div>
                                        @endif

                                        <div class="reviewer-info">
                                            <h6>{{ $review->full_name }}</h6>
                                            <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>

                                    <div class="stars">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg viewBox="0 0 24 24" fill="currentColor"
                                                style="{{ $i < $review->rating ? '' : 'opacity:.3' }}">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="review-text">{{ $review->review }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- RELATED ACTIVITIES SECTION -->
        <section class="related-tour-package">
            <div class="container">
                <div class="heading">
                    <h3>{{ $activity->city->name ?? ($activity->country->name ?? '') }} <span>Activities</span></h3>
                    <p>
                        Discover {{ $activity->city->name ?? ($activity->country->name ?? 'more') }}'s most popular
                        experiences and book unforgettable activities.
                    </p>
                </div>

                @if($relatedActivities->isNotEmpty())
                    <div class="swiper-wrap">
                        <div class="swiper thirdSilder">
                            <div class="swiper-wrapper">
                                @foreach($relatedActivities as $related)
                                    <div class="swiper-slide">
                                        <div class="trip_card">
                                            <a href="/{{ $related->city->slug ?? '' }}/activities/{{ $related->slug }}/"
                                                class="img">
                                                <img loading="lazy"
                                                    src="{{ $related->main_image ? asset('storage/' . $related->main_image) : asset('assets/images/blog/dubai.jpg') }}"
                                                    alt="{{ $related->name }}" />
                                                @if($related->banner_tag)
                                                    <span class="save">{{ $related->banner_tag }}</span>
                                                @endif
                                            </a>

                                            <div class="content">
                                                <div class="rating">
                                                    @if($related->duration_text)
                                                        <span>{{ $related->duration_text }}</span>
                                                    @endif

                                                    @if($related->rating)
                                                        <div class="star">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                                <path
                                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                            </svg>
                                                            <span>{{ number_format($related->rating, 1) }}</span>
                                                            <em>({{ $related->review_count ?? 0 }})</em>
                                                        </div>
                                                    @endif
                                                </div>

                                                <h3>
                                                    <a href="/{{ $related->city->slug ?? '' }}/activities/{{ $related->slug }}/">
                                                        {{ $related->name }}
                                                    </a>
                                                </h3>

                                                @if($related->starting_price)
                                                    <p class="price">INR {{ number_format($related->starting_price) }}</p>
                                                @endif

                                                <div class="btns">
                                                    <a href="tel:+911234567890" class="btn btn-outline-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                                            <path
                                                                d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                                        </svg>
                                                    </a>

                                                    <button data-model=".enquire-pop" class="btn btn-primary">
                                                        Enquire Now
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="swiper-group">
                            <button type="button" class="thirdSilder-prev btn-prev" aria-label="Previous">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                    <path fill="#fff"
                                        d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                                </svg>
                            </button>

                            <button type="button" class="thirdSilder-next btn-next" aria-label="Next">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                    <path fill="#fff"
                                        d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <!-- FAQ SECTION -->
        <section class="attraction_accordion" id="faqSection">
            <div class="container">
                <div class="heading">
                    <h3>Frequently Asked <span>Questions</span></h3>
                </div>

                <div class="accordion-wrapper">
                    @foreach($activity->faqs as $faq)
                        <div class="accordion-item">
                            <div class="accordion-body">
                                <div class="accordion-header {{ $loop->first ? 'active' : '' }}">
                                    <h4>{{ $faq->question }}</h4>
                                    <span class="accordion-icon">{{ $loop->first ? '−' : '+' }}</span>
                                </div>
                                <div class="accordion-content">
                                    <p>{{ $faq->answer }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </main>

    <!-- REVIEW MODAL -->
    <div class="overlay"></div>
    <div class="model review_pop">
        <div class="model-body">
            <div class="dialog-wrapper">
                <button class="close" type="button" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z" />
                    </svg>
                </button>

                <div class="title">
                    <div class="heading">
                        <h3>Write a <span>Review</span></h3>
                    </div>
                    <p>Share your travel experience with other travellers.</p>
                </div>

                <form id="reviewForm" class="form form-grid" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                    <input type="hidden" name="reviewable_type" value="activity">
                    <input type="hidden" name="reviewable_id" value="{{ $activity->id }}">

                    <div class="star-rating">
                        <p class="rating-label">Your Rating</p>
                        <div class="stars">
                            <input type="radio" name="rating" value="5" id="star5" required />
                            <label for="star5" title="5 stars">★</label>
                            <input type="radio" name="rating" value="4" id="star4" />
                            <label for="star4" title="4 stars">★</label>
                            <input type="radio" name="rating" value="3" id="star3" />
                            <label for="star3" title="3 stars">★</label>
                            <input type="radio" name="rating" value="2" id="star2" />
                            <label for="star2" title="2 stars">★</label>
                            <input type="radio" name="rating" value="1" id="star1" />
                            <label for="star1" title="1 star">★</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" id="fullName" name="full_name" placeholder="" autocomplete="off" required />
                        <label for="fullName">Full Name*</label>
                    </div>

                    <div class="form-group">
                        <input type="text" id="designation" name="designation" placeholder="" autocomplete="off" />
                        <label for="designation">Designation (optional)</label>
                    </div>

                    <div class="form-group">
                        <textarea id="reviewMessage" name="review" class="form-control" placeholder="" required></textarea>
                        <label for="reviewMessage">Your Review*</label>
                    </div>

                    <div class="form-group">
                        <input type="file" id="reviewPhoto" name="photo" accept="image/*" />
                        <label for="reviewPhoto">Your Photo (optional)</label>
                    </div>

                    <div id="reviewFormAlert" class="form-alert" style="display:none;"></div>

                    <div class="sbmt-grp text-center">
                        <button type="submit" class="btn btn-primary">SUBMIT REVIEW</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        $(function () {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // ---- Review form (multipart, because of the optional photo upload) ----
            $('#reviewForm').on('submit', function (e) {
                e.preventDefault();
                var $form = $(this);
                var formData = new FormData(this);

                $.ajax({
                    url: '{{ route("review.store") }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    dataType: 'json',
                })
                    .done(function (res) {
                        var $alert = $('#reviewFormAlert');
                        $alert.text(res.message || 'Thanks for sharing your experience!')
                            .css('color', '#1a7f37').show();
                        $form[0].reset();
                        setTimeout(function () {
                            $alert.hide();
                            location.reload(); // refreshes the review list/stats with the new entry
                        }, 1200);
                    })
                    .fail(function (xhr) {
                        var message = 'Something went wrong. Please check the form and try again.';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            message = Object.values(xhr.responseJSON.errors).flat().join(' ');
                        }
                        $('#reviewFormAlert').text(message).css('color', '#b22222').show();
                    });
            });

        });

    </script>
@endpush