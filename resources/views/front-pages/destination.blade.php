@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/destination/destination.css') }}" />
@endpush

@section('content')

    @php
        $whyTravelIcons = [
            'star' => '<path d="M12 2l2.4 6.6L21 11l-6.6 2.4L12 20l-2.4-6.6L3 11l6.6-2.4z" />',
            'clock' => '<circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 3" />',
            'check-circle' => '<path d="M9 12l2 2 4-4" /><circle cx="12" cy="12" r="9" />',
            'shield' => '<path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9" /><path d="M13.73 21a2 2 0 0 1-3.46 0" />',
            'heart' => '<path d="M12 21s-7-4.35-9.5-8.5C1 9 2.5 5.5 6 5c2-.3 3.5.7 4.5 2.2C11.5 5.7 13 4.7 15 5c3.5.5 5 4 3.5 7.5C19 16.65 12 21 12 21z" />',
            'thumbs-up' => '<path d="M7 22V11m0 11h10.5a2 2 0 0 0 2-1.7l1.4-8A2 2 0 0 0 19 9h-5l1-4.5A1.5 1.5 0 0 0 13.5 3L7 11" />',
            'gift' => '<rect x="3" y="8" width="18" height="13" rx="1" /><path d="M12 8V21M3 12h18M7.5 8a2.5 2.5 0 1 1 0-5C10 3 12 8 12 8s2-5 4.5-5a2.5 2.5 0 1 1 0 5" />',
            'headset' => '<path d="M3 18v-6a9 9 0 0 1 18 0v6" /><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z" />',
        ];
    @endphp

    <main>

     <!-- INTRO SECTION -->
        <section class="banner destination-banner">
            <div class="bg">
                <nav class="breadcrumb left breadcrumb-light" aria-label="Breadcrumb">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>

                        <li>
                            <span class="breadcrumb-separator">/</span>
                        </li>

                        <li>
                            <a href="{{ route('destinations') }}" class="active">Destination</a>
                        </li>
                    </ul>
                </nav>

                <video autoplay="" muted="" loop="" playsinline="" class="bg-video"
                    src="{{ $landingPage->hero_video ? asset('storage/' . $landingPage->hero_video) : asset('assets/video/trip3.mp4') }}"
                    poster="{{ asset('assets/video/poster/trip3.png') }}">
                    <source
                        src="{{ $landingPage->hero_video ? asset('storage/' . $landingPage->hero_video) : asset('assets/video/home-banner.mp4') }}"
                        type="video/mp4" />
                </video>

                <div class="container">
                    <div class="banner-wrapper">
                        <div class="content">
                            <div class="destination-search">
                                <div class="search-wrapper">
                                    <div class="search-content">
                                        <h1>{{ $landingPage->hero_heading ?? 'Find Your Perfect Destination' }}</h1>

                                        @if($landingPage->hero_description ?? null)
                                            <p>{{ $landingPage->hero_description }}</p>
                                        @endif
                                    </div>

                                    <form class="destination-filter">
                                        <div class="search-field">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                viewBox="0 0 24 24">
                                                <path d="M0 0h24v24H0z" fill="none" />
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5"
                                                    d="M19 11.5a7.5 7.5 0 1 1-15 0a7.5 7.5 0 0 1 15 0m-2.107 5.42l3.08 3.08" />
                                            </svg>

                                            <input type="text" name="search" placeholder="Search destinations..." />
                                        </div>

                                        <div class="select-field">
                                            <select name="region" class="js-nice-select">
                                                <option value="">Select Region</option>
                                                <option value="india">India</option>
                                                <option value="international">International</option>
                                            </select>
                                        </div>

                                        <div class="select-field">
                                            <select name="travel-type" class="js-nice-select">
                                                <option value="">Select Travel Type</option>
                                                <option value="beach">Beach</option>
                                                <option value="mountains">Mountains</option>
                                                <option value="heritage">Heritage</option>
                                                <option value="adventure">Adventure</option>
                                                <option value="family">Family</option>
                                                <option value="honeymoon">Honeymoon</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                            Search
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DESTINATION SECTION -->
        <section class="destinations-secA">
            <div class="container">
                <div class="heading">
                    <h3>{{ $landingPage->destinations_heading ?? 'Popular Destinations' }}</h3>
                    @if($landingPage->destinations_description ?? null)
                        <p>{{ $landingPage->destinations_description }}</p>
                    @endif
                </div>

                <div class="destination-grid">
                    @forelse ($destinations as $destination)
                        <a href="{{ route('destination.show', $destination->slug) }}" target="_blank" class="destination_card">
                            <div class="img">
                                <img loading="lazy"
                                    src="{{ $destination->image ? asset('storage/' . $destination->image) : asset('assets/images/blog/default.jpg') }}"
                                    alt="{{ $destination->name }}" />
                            </div>

                            <div class="content">
                                <p class="tag">{{ $destination->name }}</p>

                                <h5>Explore {{ $destination->name }}</h5>

                                <p class="desc">
                                    {{ $destination->short_description }}
                                </p>

                                <button class="link-btn">
                                    Explore Packages
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>
                                </button>
                            </div>
                        </a>
                    @empty
                        <p>No destinations available yet.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- PACKAGES SECTION -->
        @if($featuredPackages->isNotEmpty())
            <section class="featured-packages-sec">
                <div class="container">
                    <div class="heading">
                        <h3>{{ $landingPage->packages_heading ?? 'Explore Our Tour Packages' }}</h3>
                        @if($landingPage->packages_description ?? null)
                            <p>{{ $landingPage->packages_description }}</p>
                        @endif
                    </div>

                    <div class="swiper-wrap">
                        <div class="swiper fourSilder">
                            <div class="swiper-wrapper">
                                @foreach($featuredPackages as $package)
                                    <div class="swiper-slide">
                                        @include('front-pages.partials.tour-package-card', ['package' => $package])
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="swiper-group">
                            <button type="button" class="fourSilder-prev btn-prev">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                    <path fill="#fff"
                                        d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                                </svg>
                            </button>
                            <button type="button" class="fourSilder-next btn-next">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                    <path fill="#fff"
                                        d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="center-btn">
                        <a href="javascript:void()" class="btn btn-outline-primary">View All Packages</a>
                    </div>
                </div>
            </section>
        @endif

        <!-- EXPERIENCE SECTION -->
        @if(!empty($landingPage->experience_items))
            <section class="experience-sec">
                <div class="container">
                    <div class="heading">
                        <h3>{{ $landingPage->experiences_heading ?? "Experiences You'll Love" }}</h3>
                        @if($landingPage->experiences_description ?? null)
                            <p>{{ $landingPage->experiences_description }}</p>
                        @endif
                    </div>

                    <div class="experience-grid">
                        @foreach($landingPage->experience_items as $item)
                            <a href="{{ $item['link_url'] ?: 'javascript:void()' }}" target="_blank" class="experience_card">
                                <img loading="lazy"
                                    src="{{ !empty($item['image']) ? asset('storage/' . $item['image']) : asset('assets/images/blog/default.jpg') }}"
                                    alt="{{ $item['title'] }}" />

                                <div class="content">
                                    <h5>{{ $item['title'] }}</h5>
                                    <p>{{ $item['description'] }}</p>

                                    <span class="arrow">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M5 12h14M13 6l6 6-6 6" />
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- TRAVEL SECTION -->
        @if(!empty($landingPage->why_travel_items))
            <section class="why-travel-sec">
                <div class="container">
                    <div class="heading">
                        <h3>{{ $landingPage->why_travel_heading ?? 'Travel Made Simple' }}</h3>
                        @if($landingPage->why_travel_description ?? null)
                            <p>{{ $landingPage->why_travel_description }}</p>
                        @endif
                    </div>

                    <div class="why-grid">
                        @foreach($landingPage->why_travel_items as $item)
                            <div class="why_card">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        {!! $whyTravelIcons[$item['icon'] ?? 'star'] ?? $whyTravelIcons['star'] !!}
                                    </svg>
                                </div>
                                <h5>{{ $item['title'] }}</h5>
                                <p>{{ $item['description'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- HIGHLIGHT SECTION -->
        @if($landingPage->highlight_heading || $landingPage->highlight_image)
            <section class="highlight-sec">
                <div class="container">
                    <div class="highlight-wrap">
                        <div class="highlight-img">
                            <img loading="lazy"
                                src="{{ $landingPage->highlight_image ? asset('storage/' . $landingPage->highlight_image) : asset('assets/images/blog/default.jpg') }}"
                                alt="{{ $landingPage->highlight_heading ?? 'Destination highlights' }}" loading="lazy" />
                        </div>

                        <div class="highlight-content">
                            @if($landingPage->highlight_tag)
                                <p class="tag">{{ $landingPage->highlight_tag }}</p>
                            @endif

                            <h3>{{ $landingPage->highlight_heading ?? '' }}</h3>

                            @if($landingPage->highlight_description)
                                <p class="desc">{{ $landingPage->highlight_description }}</p>
                            @endif

                            @if(!empty($landingPage->highlight_points))
                                <ul class="highlight-list">
                                    @foreach($landingPage->highlight_points as $point)
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M20 6L9 17l-5-5" />
                                            </svg>
                                            {{ $point }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            @if($landingPage->highlight_cta_text)
                                <a href="{{ $landingPage->highlight_cta_url ?: 'javascript:void()' }}" class="btn btn-primary">
                                    {{ $landingPage->highlight_cta_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- GUIDE SECTION -->
        @if(!empty($landingPage->guide_items))
            <section class="guides-sec">
                <div class="container">
                    <div class="heading">
                        <h3>{{ $landingPage->guides_heading ?? 'Travel Inspiration & Guides' }}</h3>
                        @if($landingPage->guides_description ?? null)
                            <p>{{ $landingPage->guides_description }}</p>
                        @endif
                    </div>

                    <div class="guides-grid">
                        @foreach($landingPage->guide_items as $item)
                            <a href="{{ $item['link_url'] ?: 'javascript:void()' }}" class="guide_card">
                                <div class="img">
                                    <img loading="lazy"
                                        src="{{ !empty($item['image']) ? asset('storage/' . $item['image']) : asset('assets/images/blog/default.jpg') }}"
                                        alt="{{ $item['title'] }}" loading="lazy" />
                                </div>
                                <div class="content">
                                    @if(!empty($item['category']))
                                        <p class="category">{{ $item['category'] }}</p>
                                    @endif
                                    <h5>{{ $item['title'] }}</h5>
                                    <p class="desc">{{ $item['description'] }}</p>
                                    <span class="btn btn-outline-primary">Read Guide</span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="center-btn">
                        <a href="javascript:void()" class="btn btn-outline-primary">View All Travel Guides</a>
                    </div>
                </div>
            </section>
        @endif

        <!-- FAQ SECTION -->
        @if(!empty($landingPage->faqs))
            <section class="faq-sec">
                <div class="container">
                    <div class="heading">
                        <h3>{{ $landingPage->faqs_heading ?? 'Frequently Asked Questions' }}</h3>
                    </div>

                    <div class="accordion-wrapper">
                        @foreach($landingPage->faqs as $index => $faq)
                            <div class="accordion-item @if($index === 0) active @endif">
                                <div class="accordion-header">
                                    <h4>{{ $faq['question'] }}</h4>
                                    <span class="accordion-icon">{{ $index === 0 ? '−' : '+' }}</span>
                                </div>
                                <div class="accordion-content">
                                    <p>{{ $faq['answer'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    </main>

@endsection