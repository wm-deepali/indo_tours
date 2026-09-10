@extends('layouts.app')

@section('title', 'Destination | Indo Tours & Adventures')
@section('meta_description', 'Discover amazing destinations and plan your next adventure with Indo Tours & Adventures.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/destination/destination.css') }}" />
@endpush

@section('content')

    <main>
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
                    src="{{ asset('assets/video/trip3.mp4') }}" poster="{{ asset('assets/video/poster/trip3.png') }}">
                    <source src="{{ asset('assets/video/home-banner.mp4') }}" type="video/mp4" />
                </video>

                <div class="container">
                    <div class="banner-wrapper">
                        <div class="content">
                            <div class="destination-search">
                                <div class="search-wrapper">
                                    <div class="search-content">
                                        <h1>Find Your Perfect Destination</h1>

                                        <p>
                                            Explore amazing destinations and discover tour packages
                                            designed around your travel style, interests, and
                                            budget.
                                        </p>
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

        <section class="destinations-secA">
            <div class="container">
                <div class="heading">
                    <h3>Popular <span>Destinations</span></h3>
                    <p>
                        Explore some of the most loved destinations and start planning
                        your next adventure.
                    </p>
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

        <section class="featured-packages-sec">
            <div class="container">
                <div class="heading">
                    <h3>Explore Our <span>Tour Packages</span></h3>
                    <p>
                        Discover carefully planned tour packages designed to make your
                        journey comfortable, memorable and hassle-free.
                    </p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper fourSilder">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="package_card">
                                    <a href="destination-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="{{ asset('assets/images/blog/kashmir.jpg') }}"
                                            alt="Kashmir Escape" loading="lazy" />
                                        <span class="badge">Popular</span>
                                        <span class="duration-badge">5D / 4N</span>
                                    </a>
                                    <div class="content">
                                        <p class="dest-tag">Kashmir</p>
                                        <div class="rating">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                            4.8 <span>(120 reviews)</span>
                                        </div>
                                        <h5> <a href="destination-detail.html" target="_blank">Kashmir Escape</a></h5>
                                        <p class="desc">
                                            Srinagar, Gulmarg &amp; Pahalgam sightseeing with
                                            houseboat stay.
                                        </p>
                                        <div class="foot">
                                            <p class="price"><small>From</small>₹24,999</p>
                                            <button data-model=".enquire-pop" class="btn btn-outline-primary">
                                                Enquire Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="package_card">
                                    <a href="destination-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="{{ asset('assets/images/blog/goa.jpg') }}"
                                            alt="Goa Beach Holiday" loading="lazy" />
                                        <span class="duration-badge">4D / 3N</span>
                                    </a>
                                    <div class="content">
                                        <p class="dest-tag">Goa</p>
                                        <div class="rating">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                            4.6 <span>(94 reviews)</span>
                                        </div>
                                        <h5> <a href="destination-detail.html" target="_blank">Goa Beach Holiday</a></h5>
                                        <p class="desc">
                                            Sun-soaked beaches, water sports and vibrant coastal
                                            nightlife.
                                        </p>
                                        <div class="foot">
                                            <p class="price"><small>From</small>₹18,999</p>
                                            <button data-model=".enquire-pop" class="btn btn-outline-primary">
                                                Enquire Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="package_card">
                                    <a href="destination-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="{{ asset('assets/images/blog/manali.jpg') }}"
                                            alt="Manali Mountain Escape" loading="lazy" />
                                        <span class="duration-badge">5D / 4N</span>
                                    </a>
                                    <div class="content">
                                        <p class="dest-tag">Manali</p>
                                        <div class="rating">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                            4.7 <span>(110 reviews)</span>
                                        </div>
                                        <h5> <a href="destination-detail.html" target="_blank">Manali Mountain Escape</a>
                                        </h5>

                                        <p class="desc">
                                            Snow-capped peaks, river valleys and cozy mountain
                                            stays.
                                        </p>
                                        <div class="foot">
                                            <p class="price"><small>From</small>₹21,999</p>
                                            <button data-model=".enquire-pop" class="btn btn-outline-primary">
                                                Enquire Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="package_card">
                                    <a href="destination-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="{{ asset('assets/images/blog/hawamahal.jpg') }}"
                                            alt="Rajasthan Heritage Tour" loading="lazy" />
                                        <span class="badge">Recommended</span>
                                        <span class="duration-badge">6D / 5N</span>
                                    </a>
                                    <div class="content">
                                        <p class="dest-tag">Rajasthan</p>
                                        <div class="rating">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                            4.9 <span>(140 reviews)</span>
                                        </div>
                                        <h5> <a href="destination-detail.html" target="_blank">Rajasthan Heritage Tour</a>
                                        </h5>

                                        <p class="desc">
                                            Royal palaces, historic forts and vibrant local culture.
                                        </p>
                                        <div class="foot">
                                            <p class="price"><small>From</small>₹28,999</p>
                                            <button data-model=".enquire-pop" class="btn btn-outline-primary">
                                                Enquire Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        <section class="experience-sec">
            <div class="container">
                <div class="heading">
                    <h3>Experiences You'll <span>Love</span></h3>
                    <p>
                        From breathtaking landscapes to unforgettable adventures, discover
                        experiences that make every destination special.
                    </p>
                </div>

                <div class="experience-grid">
                    <!-- Adventure -->
                    <a href="destination-detail.html" target="_blank" class="experience_card">
                        <img loading="lazy" src="{{ asset('assets/images/blog/travel.avif') }}" alt="Adventure"
                            loading="lazy" />

                        <div class="content">
                            <h5>Adventure</h5>
                            <p>Trekking, rafting and thrilling outdoor activities.</p>

                            <span class="arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </span>
                        </div>
                    </a>

                    <!-- Beaches -->
                    <a href="destination-detail.html" target="_blank" class="experience_card">
                        <img loading="lazy" src="{{ asset('assets/images/blog/beach.jpg') }}" alt="Beaches"
                            loading="lazy" />

                        <div class="content">
                            <h5>Beaches</h5>
                            <p>Coastlines, water sports and relaxing shores.</p>

                            <span class="arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </span>
                        </div>
                    </a>

                    <!-- Mountains -->
                    <a href="destination-detail.html" target="_blank" class="experience_card">
                        <img loading="lazy" src="{{ asset('assets/images/blog/mount.jpg') }}" alt="Mountains"
                            loading="lazy" />

                        <div class="content">
                            <h5>Mountains</h5>
                            <p>Scenic valleys and peaceful Himalayan escapes.</p>

                            <span class="arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </span>
                        </div>
                    </a>

                    <!-- Heritage & Culture -->
                    <a href="destination-detail.html" target="_blank" class="experience_card">
                        <img loading="lazy" src="{{ asset('assets/images/blog/hawamahal.jpg') }}" alt="Heritage and Culture"
                            loading="lazy" />

                        <div class="content">
                            <h5>Heritage &amp; Culture</h5>
                            <p>Iconic monuments, forts and local traditions.</p>

                            <span class="arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </span>
                        </div>
                    </a>

                    <!-- Wildlife -->
                    <a href="destination-detail.html" target="_blank" class="experience_card">
                        <img loading="lazy" src="{{ asset('assets/images/blog/wild.avif') }}" alt="Wildlife"
                            loading="lazy" />

                        <div class="content">
                            <h5>Wildlife</h5>
                            <p>National parks, safaris and nature reserves.</p>

                            <span class="arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </span>
                        </div>
                    </a>

                    <!-- Family Experiences -->
                    <a href="destination-detail.html" target="_blank" class="experience_card">
                        <img loading="lazy" src="{{ asset('assets/images/blog/culture.avif') }}" alt="Family Experiences"
                            loading="lazy" />

                        <div class="content">
                            <h5>Family Experiences</h5>
                            <p>Comfortable stays and activities for everyone.</p>

                            <span class="arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <section class="why-travel-sec">
            <div class="container">
                <div class="heading">
                    <h3>Travel Made <span>Simple</span></h3>
                    <p>
                        We take care of the details so you can focus on enjoying your
                        journey.
                    </p>
                </div>

                <div class="why-grid">
                    <div class="why_card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20l9-16-9 4-9-4 9 16z" />
                            </svg>
                        </div>
                        <h5>Personalized Itineraries</h5>
                        <p>
                            Trips planned around your interests, travel style and schedule.
                        </p>
                    </div>

                    <div class="why_card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2l2.4 6.9H21l-5.6 4.3L17.4 20 12 15.8 6.6 20l2-6.8L3 8.9h6.6z" />
                            </svg>
                        </div>
                        <h5>Carefully Selected Packages</h5>
                        <p>
                            Thoughtfully designed packages with great destinations and
                            experiences.
                        </p>
                    </div>

                    <div class="why_card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M12 2a5 5 0 0 1 5 5v3a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2V7a5 5 0 0 1 5-5z" />
                            </svg>
                        </div>
                        <h5>Trusted Travel Support</h5>
                        <p>Reliable assistance before and throughout your journey.</p>
                    </div>

                    <div class="why_card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 6v6l4 2" />
                            </svg>
                        </div>
                        <h5>Hassle-Free Planning</h5>
                        <p>
                            From planning to experiences, we make your travel simple and
                            stress-free.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="highlight-sec">
            <div class="container">
                <div class="highlight-wrap">
                    <div class="highlight-img">
                        <img loading="lazy" src="{{ asset('assets/images/blog/kashmir.jpg') }}" alt="Destination highlights"
                            loading="lazy" />
                    </div>

                    <div class="highlight-content">
                        <p class="tag">Destination Highlights</p>
                        <h3>Discover More, Experience More</h3>
                        <p class="desc">
                            Every destination has its own story. Explore local attractions,
                            hidden gems, cultural experiences and unforgettable places worth
                            adding to your itinerary.
                        </p>

                        <ul class="highlight-list">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                                Must-visit attractions
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                                Local experiences
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                                Best places to explore
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M20 6L9 17l-5-5" />
                                </svg>
                                Things to do
                            </li>
                        </ul>

                        <a href="javascript:void()" class="btn btn-primary">Explore Attractions</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="guides-sec">
            <div class="container">
                <div class="heading">
                    <h3>Travel Inspiration & <span>Guides</span></h3>
                    <p>
                        Get useful travel tips, destination guides and inspiration to help
                        you plan your next adventure.
                    </p>
                </div>

                <div class="guides-grid">
                    <a href="javascript:void()" class="guide_card">
                        <div class="img">
                            <img loading="lazy" src="{{ asset('assets/images/blog/kashmir.jpg') }}"
                                alt="Best Places to Visit in Kashmir" loading="lazy" />
                        </div>
                        <div class="content">
                            <p class="category">Destination Guide</p>
                            <h5>Best Places to Visit in Kashmir</h5>
                            <p class="desc">
                                Discover the most beautiful destinations and experiences to
                                add to your Kashmir itinerary.
                            </p>
                            <span class="btn btn-outline-primary">Read Guide</span>
                        </div>
                    </a>

                    <a href="javascript:void()" class="guide_card">
                        <div class="img">
                            <img loading="lazy" src="{{ asset('assets/images/blog/goa.jpg') }}"
                                alt="Top Things to Do in Goa" loading="lazy" />
                        </div>
                        <div class="content">
                            <p class="category">Travel Tips</p>
                            <h5>Top Things to Do in Goa</h5>
                            <p class="desc">
                                From beaches and water activities to local experiences,
                                discover what makes Goa special.
                            </p>
                            <span class="btn btn-outline-primary">Read Guide</span>
                        </div>
                    </a>

                    <a href="javascript:void()" class="guide_card">
                        <div class="img">
                            <img loading="lazy" src="{{ asset('assets/images/blog/hawamahal.jpg') }}"
                                alt="Complete Rajasthan Travel Guide" loading="lazy" />
                        </div>
                        <div class="content">
                            <p class="category">Destination Guide</p>
                            <h5>Complete Rajasthan Travel Guide</h5>
                            <p class="desc">
                                Explore royal cities, historic forts, cultural experiences and
                                unforgettable destinations.
                            </p>
                            <span class="btn btn-outline-primary">Read Guide</span>
                        </div>
                    </a>
                </div>

                <div class="center-btn">
                    <a href="javascript:void()" class="btn btn-outline-primary">View All Travel Guides</a>
                </div>
            </div>
        </section>

        <section class="faq-sec">
            <div class="container">
                <div class="heading">
                    <h3>Frequently Asked <span>Questions</span></h3>
                </div>

                <div class="accordion-wrapper">
                    <div class="accordion-item active">
                        <div class="accordion-header">
                            <h4>What types of tour packages do you offer?</h4>
                            <span class="accordion-icon">−</span>
                        </div>
                        <div class="accordion-content">
                            <p>
                                We offer a variety of travel packages including family
                                holidays, honeymoon trips, adventure tours, weekend getaways
                                and customized vacations.
                            </p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-header">
                            <h4>Can I customize a tour package?</h4>
                            <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content">
                            <p>
                                Yes. Our team can help create a customized itinerary based on
                                your destination, travel dates, interests and requirements.
                            </p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-header">
                            <h4>Can I choose specific attractions for my trip?</h4>
                            <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content">
                            <p>
                                Yes. You can discuss your preferred attractions and
                                experiences with our travel team while planning your
                                itinerary.
                            </p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-header">
                            <h4>What is included in a tour package?</h4>
                            <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content">
                            <p>
                                Package inclusions vary by trip and may include accommodation,
                                transportation, sightseeing, activities and other travel
                                services. Check the individual package details for complete
                                information.
                            </p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-header">
                            <h4>How can I book a package?</h4>
                            <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content">
                            <p>
                                You can explore the available packages and contact our travel
                                team to discuss availability, requirements and booking
                                options.
                            </p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-header">
                            <h4>Do you provide support during the trip?</h4>
                            <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content">
                            <p>
                                Yes. Our team is available to assist you with travel-related
                                questions and support throughout your journey.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection