@extends('layouts.app')

@section('title', 'Activities Detail | Indo Tours & Adventures')
@section('meta_description', 'Indo Tours & Adventures is a leading travel company offering a wide range of tour packages, including domestic and international destinations. Explore the world with our expertly crafted itineraries and exceptional services.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/activities-detail/detail.css') }}" />
@endpush

@section('content')

    <main>
        <!-- ========================================================= -->
        <!-- 1. ACTIVITY DETAIL BANNER -->
        <!-- ========================================================= -->
        <section class="detail-banner">
            <div class="container">
                <nav class="breadcrumb breadcrumb-dark" aria-label="Breadcrumb">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><span class="breadcrumb-separator">/</span></li>
                        <li><a href="/dubai/">Dubai</a></li>
                        <li><span class="breadcrumb-separator">/</span></li>
                        <li>
                            <a href="/dubai/activities/" class="active">Activities</a>
                        </li>
                    </ul>
                </nav>

                <div class="grid">
                    <div class="item-img item-main">
                        <img loading="lazy" src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=1200"
                            alt="Burj Khalifa Sky Views" />
                        <div class="image-overlay"></div>
                        <div class="image-content main-content">
                            <span class="image-tag">Explore Dubai</span>
                            <h1>Burj Khalifa Sky Views – 124th, 125th & 148th Floor</h1>
                            <p>
                                Step onto the world's highest observation deck and witness
                                Dubai's skyline unfold from 555 metres above the ground.
                            </p>
                        </div>

                        <div class="img-actions">
                            <a data-fancybox="gallery1"
                                href="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=1200" type="button"
                                class="action-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M16.375 4.5H4.625a.125.125 0 0 0-.125.125v8.254l2.859-1.54a.75.75 0 0 1 .68-.016l2.384 1.142l2.89-2.074a.75.75 0 0 1 .874 0l2.313 1.66V4.625a.125.125 0 0 0-.125-.125m.125 9.398l-2.75-1.975l-2.813 2.02a.75.75 0 0 1-.76.067l-2.444-1.17L4.5 14.583v1.792c0 .069.056.125.125.125h11.75a.125.125 0 0 0 .125-.125zM4.625 3C3.728 3 3 3.728 3 4.625v11.75C3 17.273 3.728 18 4.625 18h11.75c.898 0 1.625-.727 1.625-1.625V4.625C18 3.728 17.273 3 16.375 3zM20 8v11c0 .69-.31 1-.999 1H6v1.5h13.001c1.52 0 2.499-.982 2.499-2.5V8z"
                                        clip-rule="evenodd" />
                                </svg>
                                Gallery
                            </a>
                            <a data-fancybox="gallery1"
                                href="https://images.unsplash.com/photo-1518684079-3c830dcef090?w=1200"></a>
                            <a data-fancybox="gallery1"
                                href="https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?w=1200"></a>
                            <a data-fancybox="gallery1"
                                href="https://images.unsplash.com/photo-1466442929976-97f336a657be?w=1200"></a>

                            <button data-video="assets/video/burj-khalifa.mp4" type="button" class="action-btn">
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
                        </div>
                    </div>

                    <div class="item-img item-top">
                        <img loading="lazy" src="https://images.unsplash.com/photo-1518684079-3c830dcef090?w=800"
                            alt="At The Top Observation Deck" />
                        <div class="image-overlay"></div>
                        <div class="image-content">
                            <span class="image-label">Observation Deck</span>
                            <h3>At The Top, 124 & 125</h3>
                        </div>
                    </div>

                    <div class="item-img item-bottom-left">
                        <img loading="lazy" src="https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?w=800"
                            alt="148th Floor Lounge" />
                        <div class="image-overlay"></div>
                        <div class="image-content">
                            <span class="image-label">Sky Lounge</span>
                            <h3>148th Floor Experience</h3>
                        </div>
                    </div>

                    <div class="item-img item-bottom-right">
                        <img loading="lazy" src="https://images.unsplash.com/photo-1466442929976-97f336a657be?w=800"
                            alt="Dubai skyline view" />
                        <div class="image-overlay"></div>
                        <div class="image-content">
                            <span class="image-label">Skyline View</span>
                            <h3>360° Dubai Views</h3>
                        </div>
                    </div>
                </div>

                <div class="banner-swiper swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img loading="lazy" src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=800"
                                alt="Burj Khalifa Sky Views" />
                        </div>
                        <div class="swiper-slide">
                            <img loading="lazy" src="https://images.unsplash.com/photo-1518684079-3c830dcef090?w=800"
                                alt="Observation Deck" />
                        </div>
                        <div class="swiper-slide">
                            <img loading="lazy" src="https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?w=800"
                                alt="148th Floor" />
                        </div>
                        <div class="swiper-slide">
                            <img loading="lazy" src="https://images.unsplash.com/photo-1466442929976-97f336a657be?w=800"
                                alt="Skyline View" />
                        </div>
                    </div>
                    <div class="image-overlay"></div>
                    <div class="image-content main-content">
                        <span class="image-tag">Explore Dubai</span>
                        <h1>Burj Khalifa Sky Views – 124th, 125th & 148th Floor</h1>
                        <p>
                            Step onto the world's highest observation deck and witness
                            Dubai's skyline unfold from 555 metres above the ground.
                        </p>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

                <div class="banner-meta">
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
                        Downtown Dubai, UAE
                    </span>

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
                        <div class="qi-rating">
                            <span class="qi-score">4.7</span>
                            <div class="qi-stars">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                            </div>
                            <a href="#all-reviews" class="qi-count">350 Reviews</a>
                        </div>

                        <span class="qi-divider"></span>

                        <div class="qi-fact">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path fill="currentColor"
                                    d="M12 20a8 8 0 1 1 0-16a8 8 0 0 1 0 16m0-18a10 10 0 1 0 0 20a10 10 0 0 0 0-20m.5 5H11v6l5.2 3.2l.8-1.3l-4.5-2.7z" />
                            </svg>
                            2–3 hrs
                        </div>

                        <div class="qi-fact">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor"
                                    d="M4.385 17.385v-6.29q0-.324.13-.629q.131-.304.349-.522L8.248 6.56q.242-.242.54-.353q.299-.112.597-.112t.596.112t.54.353l3.385 3.385q.217.217.348.522t.13.628v6.29q0 .672-.471 1.144q-.473.472-1.144.472H6q-.671 0-1.143-.472q-.473-.472-.473-1.144M6 18h2.615v-1.538q0-.31.22-.54t.55-.23q.31 0 .539.23t.23.54V18h2.615q.27 0 .443-.173t.173-.442v-6.31q0-.115-.039-.221q-.038-.106-.134-.202L9.827 7.267q-.173-.173-.442-.173q-.27 0-.443.173l-3.384 3.385q-.096.096-.135.202t-.039.221v6.31q0 .269.174.442Q5.73 18 6 18m10 .52v-8.518q0-.115-.039-.221t-.134-.202l-3.302-3.302q-.244-.244-.12-.549q.126-.305.474-.305q.104 0 .198.04t.162.106l3.282 3.283q.218.217.348.522t.131.628v8.517q0 .214-.143.357t-.357.143t-.357-.143t-.143-.357m2.615 0V8.91q0-.115-.038-.22t-.135-.203l-2.19-2.19q-.244-.244-.12-.559t.474-.314q.104 0 .198.04q.094.039.162.106l2.19 2.19q.217.218.338.523t.122.627v9.61q0 .214-.144.357q-.143.143-.356.143q-.214 0-.357-.143t-.144-.357M6 18h7.385h-8zm2.845-5.46q-.23-.23-.23-.54t.23-.54t.54-.23t.539.23t.23.54t-.23.54t-.54.23t-.539-.23" />
                            </svg>

                            Downtown Dubai
                        </div>

                        <div class="qi-fact">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor"
                                    d="M12 2C6.486 2 2 6.486 2 12v4.143C2 17.167 2.897 18 4 18h1a1 1 0 0 0 1-1v-5.143a1 1 0 0 0-1-1h-.908C4.648 6.987 7.978 4 12 4s7.352 2.987 7.908 6.857H19a1 1 0 0 0-1 1V18c0 1.103-.897 2-2 2h-2v-1h-4v3h6c2.206 0 4-1.794 4-4c1.103 0 2-.833 2-1.857V12c0-5.514-4.486-10-10-10" />
                            </svg>

                            Free Cancellation
                        </div>
                    </div>

                    <div class="quick-info-right">
                        <div class="qi-price">
                            <span class="qi-label">Starting from</span>
                            <span class="qi-amount">₹ 4,675 <small>/ Adult</small></span>
                        </div>
                        <a href="#package-options" class="btn btn-primary qi-book-btn">Book Now</a>
                    </div>
                </div>
            </div>
        </section>


        <section class="activity-info-sec">
            <div class="container">
                <div class="info-grid">
                    <div class="info-main">
                        <div class="tab-block">
                            <h6>About Burj Khalifa Sky Views</h6>
                            <p>
                                Standing at 828 metres, Burj Khalifa is the tallest structure
                                on Earth and the crown jewel of Dubai's skyline. The Sky Views
                                experience takes you across three levels — the 124th, 125th
                                and 148th floors — for uninterrupted views of the city, the
                                desert and the Arabian Gulf stretching to the horizon.
                            </p>
                        </div>

                        <div class="tab-block">
                            <h6>Highlights</h6>
                            <ul class="check-list">
                                <li>

                                    Witness sunset and city lights from the world's highest
                                    observation deck.
                                </li>
                                <li>
                                    Marvel at the intricately designed Marina skyline from the
                                    124th floor.
                                </li>
                                <li>
                                    Catch a breathtaking sunset from the highest lifestyle
                                    lounge in the world.
                                </li>
                                <li>
                                    Enjoy stunning waterfront views at the exclusive Sky Lounge
                                    on the 148th floor.
                                </li>
                            </ul>
                        </div>

                        <div class="tab-block">
                            <h6>What to Expect</h6>
                            <p>
                                Your visit begins with a short, immersive multimedia gallery
                                narrating the story of Burj Khalifa's construction. A
                                high-speed lift then whisks you up to the 124th and 125th
                                floor observation decks in under a minute. Select packages
                                continue to the 148th floor's exclusive lounge, where
                                refreshments and a personal host await.
                            </p>
                        </div>

                        <div class="tab-block">
                            <h6>Know Before You Go</h6>
                            <ul class="check-list">
                                <li>
                                    Bring the ticket voucher with your passport copy or
                                    Emirates ID.
                                </li>
                                <li>
                                    Arrive at least 30 minutes before your scheduled time slot.
                                </li>
                                <li>
                                    Wheelchair access and accessible restrooms are available.
                                </li>
                            </ul>
                        </div>
                    </div>

                    <aside class="info-sidebar">
                        <div class="sidebar-card">
                            <span class="sidebar-label">Starting from</span>
                            <h3 class="sidebar-price">₹ 4,675 <small>per Adult</small></h3>
                            <ul class="sidebar-points">
                                <li>Instant confirmation</li>
                                <li>Mobile voucher accepted</li>
                                <li>Free cancellation up to 24 hrs</li>
                            </ul>
                            <a href="#package-options" class="btn btn-primary sidebar-btn">Select Package</a>
                            <button class="btn btn-outline-primary sidebar-btn" type="button" data-model=".enquire-pop">
                                Have a Question?
                            </button>
                        </div>
                    </aside>
                </div>
            </div>
        </section>


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
                    <!-- ===================================================== -->
                    <!-- PACKAGE OPTIONS TAB -->
                    <!-- ===================================================== -->

                    <div class="tabs active" data-tab="package">
                        <div class="package-grid">
                            <!-- Package 1 -->
                            <div class="package-card">
                                <div class="package-top">
                                    <h4>At The Top – 124th & 125th Floor</h4>
                                    <span class="package-duration">Non-Prime Hours</span>
                                </div>

                                <p class="package-desc">
                                    Access to the world-famous observation decks on the 124th
                                    and 125th floors with panoramic city views.
                                </p>

                                <ul class="package-includes">
                                    <li>Skip-the-line entry</li>
                                    <li>Multimedia presentation</li>
                                    <li>High-speed lift access</li>
                                </ul>

                                <div class="package-price">
                                    <span class="old-price">₹ 5,200</span>
                                    <span class="new-price">₹ 4,675</span>
                                    <span class="save-tag">Save 10%</span>
                                </div>

                                <div class="package-actions">
                                    <a href="tel:+911234567890" class="btn btn-outline-primary">
                                        Call Us
                                    </a>

                                    <button type="button" data-model=".enquire-pop" class="btn btn-primary">
                                        Enquire Now
                                    </button>
                                </div>
                            </div>

                            <!-- Package 2 -->
                            <div class="package-card recommended">
                                <span class="ribbon">Most Popular</span>

                                <div class="package-top">
                                    <h4>At The Top – 124th & 125th Floor</h4>
                                    <span class="package-duration">Prime Hours</span>
                                </div>

                                <p class="package-desc">
                                    Guaranteed sunset and evening slots with faster access
                                    during peak demand hours.
                                </p>

                                <ul class="package-includes">
                                    <li>Skip-the-line entry</li>
                                    <li>Multimedia presentation</li>
                                    <li>Priority prime-time slot</li>
                                </ul>

                                <div class="package-price">
                                    <span class="old-price">₹ 6,100</span>
                                    <span class="new-price">₹ 5,519</span>
                                    <span class="save-tag">Save 9%</span>
                                </div>

                                <div class="package-actions">
                                    <a href="tel:+911234567890" class="btn btn-outline-primary">
                                        Call Us
                                    </a>

                                    <button type="button" data-model=".enquire-pop" class="btn btn-primary">
                                        Enquire Now
                                    </button>
                                </div>
                            </div>

                            <!-- Package 3 -->
                            <div class="package-card">
                                <div class="package-top">
                                    <h4>At The Top Sky – Level 124, 125 & 148</h4>
                                    <span class="package-duration">Non-Prime Hours</span>
                                </div>

                                <p class="package-desc">
                                    The complete Sky experience with exclusive access to the
                                    148th floor lounge, the highest of its kind in the world.
                                </p>

                                <ul class="package-includes">
                                    <li>All 124/125 floor benefits</li>
                                    <li>148th floor lounge access</li>
                                    <li>Refreshments included</li>
                                </ul>

                                <div class="package-price">
                                    <span class="old-price">₹ 12,400</span>
                                    <span class="new-price">₹ 10,936.91</span>
                                    <span class="save-tag">Save 12%</span>
                                </div>

                                <div class="package-actions">
                                    <a href="tel:+911234567890" class="btn btn-outline-primary">
                                        Call Us
                                    </a>

                                    <button type="button" data-model=".enquire-pop" class="btn btn-primary">
                                        Enquire Now
                                    </button>
                                </div>
                            </div>

                            <!-- Package 4 -->
                            <div class="package-card">
                                <div class="package-top">
                                    <h4>At The Top Sky – Level 124, 125 & 148</h4>
                                    <span class="package-duration">Prime Hours</span>
                                </div>

                                <p class="package-desc">
                                    Sky-level access with a guaranteed prime-time slot for the
                                    best lighting and photography conditions.
                                </p>

                                <ul class="package-includes">
                                    <li>All 124/125 floor benefits</li>
                                    <li>148th floor lounge access</li>
                                    <li>Priority prime-time slot</li>
                                </ul>

                                <div class="package-price">
                                    <span class="old-price">₹ 15,000</span>
                                    <span class="new-price">₹ 13,474.90</span>
                                    <span class="save-tag">Save 10%</span>
                                </div>

                                <div class="package-actions">
                                    <a href="tel:+911234567890" class="btn btn-outline-primary">
                                        Call Us
                                    </a>

                                    <button type="button" data-model=".enquire-pop" class="btn btn-primary">
                                        Enquire Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ===================================================== -->
                    <!-- MAP TAB -->
                    <!-- ===================================================== -->

                    <div class="tabs" data-tab="map">
                        <div class="map-block">
                            <div class="map-embed">
                                <iframe src="https://www.google.com/maps?q=Burj%20Khalifa%20Dubai&output=embed" width="100%"
                                    height="100%" style="border: 0" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>

                            <div class="map-address">
                                <h6>Activity Location</h6>

                                <p>
                                    Burj Khalifa, 1 Sheikh Mohammed bin Rashid Blvd, Downtown
                                    Dubai, Dubai, UAE
                                </p>

                                <ul class="check-list">
                                    <li>
                                        <span class="check-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                                            </svg>
                                        </span>

                                        Nearest Metro: Burj Khalifa/Dubai Mall Station (10 min
                                        walk)
                                    </li>

                                    <li>
                                        <span class="check-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                                            </svg>
                                        </span>

                                        Located inside The Dubai Mall complex, Level Concourse
                                    </li>
                                </ul>

                                <a href="https://www.google.com/maps?q=Burj+Khalifa+Dubai" target="_blank" rel="noopener"
                                    class="btn btn-outline-primary">
                                    Get Directions
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ===================================================== -->
                    <!-- POLICIES TAB -->
                    <!-- ===================================================== -->

                    <div class="tabs" data-tab="policies">
                        <!-- Cancellation Policy -->
                        <div class="tab-block">
                            <h6>Cancellation Policy</h6>

                            <ul class="check-list">
                                <li>
                                    <span class="check-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                                        </svg>
                                    </span>

                                    Free cancellation up to 24 hours before your scheduled slot.
                                </li>

                                <li>
                                    <span class="check-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                                        </svg>
                                    </span>

                                    No refund for cancellations made within 24 hours of the
                                    visit.
                                </li>
                            </ul>
                        </div>

                        <!-- Booking Confirmation -->
                        <div class="tab-block">
                            <h6>Booking Confirmation</h6>

                            <ul class="check-list">
                                <li>
                                    <span class="check-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                                        </svg>
                                    </span>

                                    Instant confirmation via email and SMS on successful
                                    booking.
                                </li>

                                <li>
                                    <span class="check-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                                        </svg>
                                    </span>

                                    Mobile voucher accepted — no printout required.
                                </li>
                            </ul>
                        </div>

                        <!-- Entry & Reporting -->
                        <div class="tab-block">
                            <h6>Entry & Reporting Time</h6>

                            <ul class="check-list">
                                <li>
                                    <span class="check-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                                        </svg>
                                    </span>

                                    Report at least 30 minutes prior to your selected time slot.
                                </li>

                                <li>
                                    <span class="check-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                                        </svg>
                                    </span>

                                    A valid passport copy or Emirates ID is mandatory for entry.
                                </li>

                                <li>
                                    <span class="check-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                                        </svg>
                                    </span>

                                    Tickets are valid only for the date and time slot selected.
                                </li>
                            </ul>
                        </div>

                        <!-- Child & Family -->
                        <div class="tab-block">
                            <h6>Child & Family Information</h6>

                            <ul class="check-list">
                                <li>
                                    <span class="check-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                                        </svg>
                                    </span>

                                    Suitable for all ages; children below 4 years enter free.
                                </li>

                                <li>
                                    <span class="check-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M9 16.17L4.83 12l-1.42 1.41L9 19L21 7l-1.41-1.41z" />
                                        </svg>
                                    </span>

                                    Wheelchair-accessible lifts and restrooms available on all
                                    floors.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================= -->
        <!-- 4. DUBAI TOP ATTRACTIONS -->
        <!-- ========================================================= -->
        <section class="dubai-attractions-sec">
            <div class="container">
                <div class="heading">
                    <h3>Dubai <span>Top Attractions</span></h3>
                </div>

                <div class="mini-grid">
                    <a href="/dubai/burj-khalifa/" class="mini-card">
                        <div class="mini-img">
                            <img loading="lazy" src="assets/images/blog/dubai.jpg" alt="Burj Khalifa" />
                        </div>
                        <div class="mini-content">
                            <h6>Burj Khalifa</h6>
                            <p>World's tallest building & observation decks</p>
                        </div>
                    </a>
                    <a href="/dubai/dubai-marina/" class="mini-card">
                        <div class="mini-img">
                            <img loading="lazy" src="assets/images/blog/dubai.jpg" alt="Dubai Marina" />
                        </div>
                        <div class="mini-content">
                            <h6>Dubai Marina</h6>
                            <p>Waterfront promenade, cruises & dining</p>
                        </div>
                    </a>
                    <a href="/dubai/palm-jumeirah/" class="mini-card">
                        <div class="mini-img">
                            <img loading="lazy" src="assets/images/blog/dubai.jpg" alt="Palm Jumeirah" />
                        </div>
                        <div class="mini-content">
                            <h6>Palm Jumeirah</h6>
                            <p>Iconic man-made island & luxury resorts</p>
                        </div>
                    </a>
                    <a href="/dubai/dubai-frame/" class="mini-card">
                        <div class="mini-img">
                            <img loading="lazy" src="assets/images/blog/dubai.jpg" alt="Dubai Frame" />
                        </div>
                        <div class="mini-content">
                            <h6>Dubai Frame</h6>
                            <p>Old & new Dubai framed in one view</p>
                        </div>
                    </a>
                    <a href="/dubai/dubai-aquarium/" class="mini-card">
                        <div class="mini-img">
                            <img loading="lazy" src="assets/images/blog/dubai.jpg" alt="Dubai Aquarium" />
                        </div>
                        <div class="mini-content">
                            <h6>Dubai Aquarium & Zoo</h6>
                            <p>Underwater tunnel & marine life encounters</p>
                        </div>
                    </a>
                    <a href="/dubai/museum-of-the-future/" class="mini-card">
                        <div class="mini-img">
                            <img loading="lazy" src="assets/images/blog/dubai.jpg" alt="Museum of the Future" />
                        </div>
                        <div class="mini-content">
                            <h6>Museum of the Future</h6>
                            <p>Immersive tech & innovation experiences</p>
                        </div>
                    </a>
                    <a href="/dubai/ain-dubai/" class="mini-card">
                        <div class="mini-img">
                            <img loading="lazy" src="assets/images/blog/dubai.jpg" alt="Ain Dubai" />
                        </div>
                        <div class="mini-content">
                            <h6>Ain Dubai</h6>
                            <p>World's largest observation wheel</p>
                        </div>
                    </a>
                    <a href="/dubai/miracle-garden/" class="mini-card">
                        <div class="mini-img">
                            <img loading="lazy" src="assets/images/blog/dubai.jpg" alt="Dubai Miracle Garden" />
                        </div>
                        <div class="mini-content">
                            <h6>Dubai Miracle Garden</h6>
                            <p>World's largest natural flower garden</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <section class="detail-secF">
            <div class="heading">
                <h3>Traveler <span>Reviews</span></h3>
                <a href="javascript:void()" class="btn btn-secondary" data-model=".review_pop">Write a Review</a>
            </div>

            <div class="grid">
                <div class="rating-wrapper">
                    <h2>4.7</h2>
                    <div class="stars">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z">
                            </path>
                        </svg>
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z">
                            </path>
                        </svg>
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z">
                            </path>
                        </svg>
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z">
                            </path>
                        </svg>
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z">
                            </path>
                        </svg>
                    </div>

                    <p class="total-reviews">350 Reviews</p>

                    <div class="rating-bars">
                        <div class="bar-row">
                            <span class="label">5</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="width: 78%"></div>
                            </div>
                            <span class="count">273</span>
                        </div>
                        <div class="bar-row">
                            <span class="label">4</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="width: 16%"></div>
                            </div>
                            <span class="count">56</span>
                        </div>
                        <div class="bar-row">
                            <span class="label">3</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="width: 4%"></div>
                            </div>
                            <span class="count">14</span>
                        </div>
                        <div class="bar-row">
                            <span class="label">2</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="width: 1%"></div>
                            </div>
                            <span class="count">4</span>
                        </div>
                        <div class="bar-row">
                            <span class="label">1</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="width: 1%"></div>
                            </div>
                            <span class="count">3</span>
                        </div>
                    </div>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper reviewSlider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="card">
                                    <div class="header">
                                        <img loading="lazy" src="https://randomuser.me/api/portraits/women/65.jpg"
                                            alt="Agnese Rudzinska" />
                                        <div class="name">
                                            <h6>Agnese Rudzinska</h6>
                                            <p>Traveller, Delhi</p>
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
                                    <p class="quote">
                                        "Everything was great, no waiting. Beautiful sunrise and
                                        perfect views. Coffee and snack after. Great experience,
                                        thank you!"
                                    </p>
                                    <div class="stars">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="card">
                                    <div class="header">
                                        <img loading="lazy" src="https://randomuser.me/api/portraits/men/32.jpg"
                                            alt="Mahesh Krishnan" />
                                        <div class="name">
                                            <h6>Mahesh Krishnan</h6>
                                            <p>Traveller, Mumbai</p>
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
                                    <p class="quote">
                                        "The most attractive part of the experience was the ease
                                        of booking. Customer service and mobile assistance were
                                        worth mentioning."
                                    </p>
                                    <div class="stars">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="card">
                                    <div class="header">
                                        <img loading="lazy" src="https://randomuser.me/api/portraits/men/45.jpg"
                                            alt="Ashwin Hulawale" />
                                        <div class="name">
                                            <h6>Ashwin Hulawale</h6>
                                            <p>Traveller, Pune</p>
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
                                    <p class="quote">
                                        "Had an amazing experience! Booking was easy and we could
                                        see and pick our slot online. Truly special visit."
                                    </p>
                                    <div class="stars">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="card">
                                    <div class="header">
                                        <img loading="lazy" src="https://randomuser.me/api/portraits/women/22.jpg"
                                            alt="C Kumar" />
                                        <div class="name">
                                            <h6>C Kumar</h6>
                                            <p>Traveller, Bengaluru</p>
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
                                    <p class="quote">
                                        "Ticket booking experience was excellent, even the price
                                        was economical compared to other sites. Overall a great
                                        experience."
                                    </p>
                                    <div class="stars">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
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
        </section>

        <section class="all-reviews-grid-sec" id="all-reviews">
            <div class="container">
                <div class="heading">
                    <h3>All <span>Reviews</span></h3>
                </div>

                <div class="reviews-grid">
                    <div class="review-card">
                        <div class="review-top">
                            <div class="reviewer">
                                <img loading="lazy" src="https://randomuser.me/api/portraits/women/65.jpg"
                                    alt="Agnese Rudzinska" />
                                <div class="reviewer-info">
                                    <h6>Agnese Rudzinska</h6>
                                    <span class="review-date">Excellent · 2 weeks ago</span>
                                </div>
                            </div>
                            <div class="stars">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                            </div>
                        </div>
                        <p class="review-text">
                            Everything was great, no waiting. Beautiful sunrise and perfect
                            views. Coffee and snack after. Great experience, thank you!
                        </p>
                    </div>

                    <div class="review-card">
                        <div class="review-top">
                            <div class="reviewer">
                                <img loading="lazy" src="https://randomuser.me/api/portraits/men/32.jpg"
                                    alt="Mahesh Krishnan" />
                                <div class="reviewer-info">
                                    <h6>Mahesh Krishnan</h6>
                                    <span class="review-date">Excellent · 1 month ago</span>
                                </div>
                            </div>
                            <div class="stars">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                            </div>
                        </div>
                        <p class="review-text">
                            The most attractive part of the experience was the ease of
                            booking. Customer service and mobile assistance were worth
                            mentioning. Booked for my friends and family, and they were
                            happy throughout.
                        </p>
                    </div>

                    <div class="review-card">
                        <div class="review-top">
                            <div class="reviewer">
                                <img loading="lazy" src="https://randomuser.me/api/portraits/men/45.jpg"
                                    alt="Ashwin Hulawale" />
                                <div class="reviewer-info">
                                    <h6>Ashwin Hulawale</h6>
                                    <span class="review-date">Excellent · 3 weeks ago</span>
                                </div>
                            </div>
                            <div class="stars">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                            </div>
                        </div>
                        <p class="review-text">
                            Had an amazing experience! Booking was easy — could see and pick
                            the slot online, and we were made to feel truly special
                            throughout the visit.
                        </p>
                    </div>

                    <div class="review-card">
                        <div class="review-top">
                            <div class="reviewer">
                                <img loading="lazy" src="https://randomuser.me/api/portraits/women/22.jpg" alt="C Kumar" />
                                <div class="reviewer-info">
                                    <h6>C Kumar</h6>
                                    <span class="review-date">Excellent · 1 week ago</span>
                                </div>
                            </div>
                            <div class="stars">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                            </div>
                        </div>
                        <p class="review-text">
                            Ticket booking experience was excellent, and even the price was
                            economical compared to other sites. Overall a great experience
                            booking through the official listing.
                        </p>
                    </div>

                    <div class="review-card">
                        <div class="review-top">
                            <div class="reviewer">
                                <img loading="lazy" src="https://randomuser.me/api/portraits/women/48.jpg"
                                    alt="Priya Sharma" />
                                <div class="reviewer-info">
                                    <h6>Priya Sharma</h6>
                                    <span class="review-date">Excellent · 4 days ago</span>
                                </div>
                            </div>
                            <div class="stars">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                            </div>
                        </div>
                        <p class="review-text">
                            Booked the Sky level package for our anniversary — the sunset
                            view from the 148th floor lounge was worth every rupee. Staff
                            made it feel really special.
                        </p>
                    </div>

                    <div class="review-card">
                        <div class="review-top">
                            <div class="reviewer">
                                <img loading="lazy" src="https://randomuser.me/api/portraits/men/51.jpg"
                                    alt="Rohan Verma" />
                                <div class="reviewer-info">
                                    <h6>Rohan Verma</h6>
                                    <span class="review-date">Very Good · 5 days ago</span>
                                </div>
                            </div>
                            <div class="stars">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                                <svg viewBox="0 0 24 24" fill="currentColor" style="opacity: 0.3">
                                    <path
                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                </svg>
                            </div>
                        </div>
                        <p class="review-text">
                            Good experience overall, lift access was quick. Would have liked
                            a bit more time at the top before being moved along by staff.
                        </p>
                    </div>
                </div>

                <div class="reviews-more">
                    <button type="button" class="btn btn-outline-primary btn-show-more">
                        Load More Reviews
                    </button>
                </div>
            </div>
        </section>

        <!-- ================= RELATED DUBAI ACTIVITIES SWIPER ================= -->
        <section class="related-tour-package">
            <div class="container">
                <div class="heading">
                    <h3>Dubai <span>Activities</span></h3>
                    <p>
                        Discover Dubai's most popular experiences and book unforgettable
                        activities.
                    </p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper thirdSilder">
                        <div class="swiper-wrapper">
                            <!-- Card 1 -->
                            <div class="swiper-slide">
                                <div class="trip_card">
                                    <a href="activities-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="assets/images/blog/dubai.jpg" alt="Dubai Desert Safari" />
                                        <span class="save">Bestseller</span>
                                    </a>

                                    <div class="content">
                                        <div class="rating">
                                            <span>6 Hours</span>
                                            <div class="star">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                </svg>
                                                <span>4.7</span>
                                                <em>(320)</em>
                                            </div>
                                        </div>

                                        <h3>
                                            <a href="activities-detail.html" target="_blank">
                                                Desert Safari
                                            </a>
                                        </h3>

                                        <div class="innerSave">
                                            <s>INR 4,500</s>
                                            <span class="saveChip">Save INR 800</span>
                                        </div>

                                        <p class="price">INR 3,700</p>

                                        <div class="btns">
                                            <a href="tel:+91 000 000 000" class="btn btn-outline-primary">
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

                            <!-- Card 2 -->
                            <div class="swiper-slide">
                                <div class="trip_card">
                                    <a href="activities-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="assets/images/blog/dubai.jpg"
                                            alt="Dubai Marina Dinner Cruise" />
                                        <span class="save">Popular</span>
                                    </a>

                                    <div class="content">
                                        <div class="rating">
                                            <span>2 Hours</span>
                                            <div class="star">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                </svg>
                                                <span>4.6</span>
                                                <em>(210)</em>
                                            </div>
                                        </div>

                                        <h3>
                                            <a href="activities-detail.html" target="_blank">
                                                Marina Dinner Cruise
                                            </a>
                                        </h3>

                                        <div class="innerSave">
                                            <s>INR 3,300</s>
                                            <span class="saveChip">Save INR 600</span>
                                        </div>

                                        <p class="price">INR 2,700</p>

                                        <div class="btns">
                                            <a href="tel:+91 000 000 000" class="btn btn-outline-primary">
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

                            <!-- Card 3 -->
                            <div class="swiper-slide">
                                <div class="trip_card">
                                    <a href="activities-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="assets/images/blog/dubai.jpg" alt="Burj Khalifa Dubai" />
                                        <span class="save">Iconic</span>
                                    </a>

                                    <div class="content">
                                        <div class="rating">
                                            <span>1.5 Hours</span>
                                            <div class="star">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                </svg>
                                                <span>4.8</span>
                                                <em>(540)</em>
                                            </div>
                                        </div>

                                        <h3>
                                            <a href="activities-detail.html" target="_blank">
                                                Burj Khalifa At The Top
                                            </a>
                                        </h3>

                                        <div class="innerSave">
                                            <s>INR 5,200</s>
                                            <span class="saveChip">Save INR 700</span>
                                        </div>

                                        <p class="price">INR 4,500</p>

                                        <div class="btns">
                                            <a href="tel:+91 000 000 000" class="btn btn-outline-primary">
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

                            <!-- Card 4 -->
                            <div class="swiper-slide">
                                <div class="trip_card">
                                    <a href="activities-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="assets/images/blog/dubai.jpg"
                                            alt="Dubai Luxury Yacht Cruise" />
                                        <span class="save">Luxury</span>
                                    </a>

                                    <div class="content">
                                        <div class="rating">
                                            <span>3 Hours</span>
                                            <div class="star">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                </svg>
                                                <span>4.7</span>
                                                <em>(260)</em>
                                            </div>
                                        </div>

                                        <h3>
                                            <a href="activities-detail.html" target="_blank">
                                                Luxury Yacht Cruise
                                            </a>
                                        </h3>

                                        <div class="innerSave">
                                            <s>INR 8,500</s>
                                            <span class="saveChip">Save INR 1,200</span>
                                        </div>

                                        <p class="price">INR 7,300</p>

                                        <div class="btns">
                                            <a href="tel:+91 000 000 000" class="btn btn-outline-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                                    <path
                                                        d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 1 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                                </svg>
                                            </a>

                                            <button data-model=".enquire-pop" class="btn btn-primary">
                                                Enquire Now
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            </div>
        </section>

        <section class="attraction_accordion" id="faqSection">
            <div class="container">
                <div class="heading">
                    <h3>Frequently Asked <span>Questions</span></h3>
                </div>

                <div class="accordion-wrapper">
                    <div class="accordion-item">
                        <div class="accordion-body">
                            <div class="accordion-header active">
                                <h4>
                                    What is included in the Burj Khalifa Sky Views ticket?
                                </h4>
                                <span class="accordion-icon">−</span>
                            </div>
                            <div class="accordion-content">
                                <p>
                                    Entry to the observation deck(s) as per your selected
                                    package, a multimedia gallery presentation, high-speed lift
                                    access, and skip-the-line entry.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-body">
                            <div class="accordion-header">
                                <h4>How long is the experience?</h4>
                                <span class="accordion-icon">+</span>
                            </div>
                            <div class="accordion-content">
                                <p>
                                    Most visitors spend around 2 to 3 hours exploring the
                                    observation decks and, if selected, the 148th floor lounge.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-body">
                            <div class="accordion-header">
                                <h4>Where is the activity located?</h4>
                                <span class="accordion-icon">+</span>
                            </div>
                            <div class="accordion-content">
                                <p>
                                    Burj Khalifa is located in Downtown Dubai, connected to The
                                    Dubai Mall, a short walk from Burj Khalifa/Dubai Mall Metro
                                    Station.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-body">
                            <div class="accordion-header">
                                <h4>Can I change my booking date or time?</h4>
                                <span class="accordion-icon">+</span>
                            </div>
                            <div class="accordion-content">
                                <p>
                                    Yes, date and time changes are allowed up to 24 hours before
                                    your scheduled slot, subject to availability.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-body">
                            <div class="accordion-header">
                                <h4>What is the cancellation policy?</h4>
                                <span class="accordion-icon">+</span>
                            </div>
                            <div class="accordion-content">
                                <p>
                                    Free cancellation is available up to 24 hours before your
                                    scheduled visit. No refunds apply within 24 hours of the
                                    slot.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-body">
                            <div class="accordion-header">
                                <h4>Is it suitable for children?</h4>
                                <span class="accordion-icon">+</span>
                            </div>
                            <div class="accordion-content">
                                <p>
                                    Yes, the experience is suitable for all age groups. Children
                                    below 4 years are permitted free entry.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-body">
                            <div class="accordion-header">
                                <h4>What should I bring on the day of my visit?</h4>
                                <span class="accordion-icon">+</span>
                            </div>
                            <div class="accordion-content">
                                <p>
                                    Carry your mobile or printed voucher along with a valid
                                    passport copy or Emirates ID for verification at entry.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-body">
                            <div class="accordion-header">
                                <h4>How early should I arrive before my time slot?</h4>
                                <span class="accordion-icon">+</span>
                            </div>
                            <div class="accordion-content">
                                <p>
                                    We recommend arriving at least 30 minutes before your
                                    scheduled time slot to allow for security checks and
                                    queueing.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="overlay"></div>

    <!-- Video Pop -->
    <div class="model video-pop">
        <div class="model-body">
            <button type="button" class="close close-video">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.75 0.75L23.25 23.25M0.75 23.25L23.25 0.75" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
            <iframe id="iframe1" allow="autoplay; fullscreen" src=""></iframe>
        </div>
    </div>

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

                <div class="form form-grid">
                    <div class="star-rating">
                        <p class="rating-label">Your Rating</p>

                        <div class="stars">
                            <input type="radio" name="rating" value="5" id="star5" />
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
                        <input type="text" id="fullName" name="fullName" placeholder="" autocomplete="off" />
                        <label for="fullName">Full Name*</label>
                    </div>

                    <div class="form-group">
                        <input type="text" id="destination" name="destination" placeholder="" autocomplete="off" />
                        <label for="destination">Destination*</label>
                    </div>

                    <div class="form-group">
                        <textarea id="reviewMessage" name="reviewMessage" class="form-control" placeholder=""></textarea>
                        <label for="reviewMessage">Your Review*</label>
                    </div>

                    <div class="sbmt-grp text-center">
                        <button type="submit" class="btn btn-primary">
                            SUBMIT REVIEW
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection