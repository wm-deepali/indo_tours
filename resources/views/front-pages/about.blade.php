@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/about/about.css') }}" />
@endpush

@section('content')
    <main>
        <section class="banner">
            <div class="bg">
                <video autoplay="" muted="" loop="" playsinline="" class="bg-video" src="assets/video/trip.mp4"
                    poster="assets/video/poster/trip.png">
                    <source src="assets/video/home-banner.mp4" type="video/mp4" />
                </video>
                <nav class="breadcrumb left breadcrumb-light" aria-label="Breadcrumb">
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>

                        <li>
                            <span class="breadcrumb-separator">/</span>
                        </li>

                        <li>
                            <a href="about.html" class="active">About Us</a>
                        </li>
                    </ul>
                </nav>
                <div class="container">

                    <div class="banner-wrapper">
                        <div class="content">
                            <h1>Our Story</h1>
                            <p>
                                We create thoughtfully planned trips and unforgettable travel
                                experiences, helping you discover new destinations with
                                comfort, confidence, and ease.
                            </p>
                            <a href="javascript:void(0)" class="btn btn-primary">Explore Our Story</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-secA">
            <div class="container">
                <div class="heading">
                    <h3>Who <span>We Are</span></h3>
                    <p>
                        We create personalized trips and unforgettable experiences, making
                        every journey simple, seamless, and memorable.
                    </p>
                </div>
                <div class="stats-layout">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <span class="stat-card__icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="12" cy="13" r="7" />
                                    <path d="M9.5 13.5c.7.8 1.5 1.2 2.5 1.2s1.8-.4 2.5-1.2" stroke-linecap="round" />
                                    <circle cx="9.5" cy="12" r=".6" fill="currentColor" />
                                    <circle cx="14.5" cy="12" r=".6" fill="currentColor" />
                                    <path d="M6 5l1 1.5M18 5l-1 1.5M12 3v2" stroke-linecap="round" />
                                </svg>
                            </span>
                            <h3 class="stat-card__number" data-count="45" data-suffix="K+">
                                0
                            </h3>
                            <p class="stat-card__label">Happy campers</p>
                        </div>

                        <div class="stat-card">
                            <span class="stat-card__icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M7 8V6a3 3 0 0 1 6 0v2" stroke-linecap="round" />
                                    <rect x="4" y="8" width="12" height="10" rx="1.5" />
                                    <text x="6.4" y="14.5" font-size="4.5" fill="currentColor" stroke="none"
                                        font-family="sans-serif">
                                        SOLD
                                    </text>
                                </svg>
                            </span>
                            <h3 class="stat-card__number" data-count="1500" data-suffix="+">
                                0+
                            </h3>
                            <p class="stat-card__label">Trips sold</p>
                        </div>

                        <div class="stat-card">
                            <span class="stat-card__icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 3C8.7 3 6 5.7 6 9c0 4.5 6 12 6 12s6-7.5 6-12c0-3.3-2.7-6-6-6z" />
                                    <circle cx="12" cy="9" r="2" />
                                    <path d="M15 15l3 3" stroke-linecap="round" />
                                </svg>
                            </span>
                            <h3 class="stat-card__number" data-count="60" data-suffix="K">
                                0K
                            </h3>
                            <p class="stat-card__label">Destinations</p>
                        </div>

                        <div class="stat-card">
                            <span class="stat-card__icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="9" cy="8" r="2.3" />
                                    <circle cx="15" cy="8" r="2.3" />
                                    <path
                                        d="M4.5 18c.5-2.8 2.3-4.3 4.5-4.3s4 1.5 4.5 4.3M10.5 18c.5-2.8 2.3-4.3 4.5-4.3s4 1.5 4.5 4.3"
                                        stroke-linecap="round" />
                                </svg>
                            </span>
                            <h3 class="stat-card__number" data-count="150" data-suffix="+">
                                0
                            </h3>
                            <p class="stat-card__label">Travel buddies</p>
                        </div>
                    </div>

                    <!-- Right: content card -->
                    <div class="content-card">
                        <div class="content-card__text">
                            <h5>We Make Every Journey Worth Remembering</h5>

                            <p>
                                We are passionate travel planners dedicated to creating
                                memorable journeys that are simple, exciting, and hassle-free.
                            </p>

                            <p>
                                From handpicked destinations to thoughtfully planned
                                itineraries, we help you discover new places and create
                                experiences you’ll cherish.
                            </p>

                            <a href="#" class="btn btn-primary">Discover Our Story</a>
                        </div>

                        <div class="content-card__image">
                            <img loading="lazy" src="assets/images/about/about-img.png"
                                alt="Travelers enjoying a memorable journey" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-secB">
            <div class="container">
                <div class="heading">
                    <h3>Why <span>Choose Us</span></h3>
                    <p>
                        We make every journey simple, memorable, and tailored to you—from
                        thoughtful planning to unforgettable experiences.
                    </p>
                </div>

                <div class="grid">
                    <div class="item">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <circle cx="12" cy="12" r="9" />
                                <path d="M15 9l-2 6-6 2 2-6 6-2z" />
                            </svg>
                        </div>
                        <h4>Expertly Planned</h4>
                        <p>Every itinerary is designed with attention to detail.</p>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <path
                                    d="M12 21s-6.5-5.6-6.5-11A6.5 6.5 0 0 1 12 3.5A6.5 6.5 0 0 1 18.5 10C18.5 15.4 12 21 12 21z" />
                                <circle cx="12" cy="10" r="2.2" />
                            </svg>
                        </div>
                        <h4>Local Experiences</h4>
                        <p>Experience destinations beyond the usual tourist spots.</p>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <path d="M20 12.5l-7.5 7.5a1.5 1.5 0 0 1-2.1 0L4 13.6V4h9.6l6.4 6.4a1.5 1.5 0 0 1 0 2.1z" />
                                <circle cx="8.5" cy="8.5" r="1.3" fill="currentColor" stroke="none" />
                            </svg>
                        </div>
                        <h4>Best Value</h4>
                        <p>Great experiences at prices designed for real travelers.</p>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <path d="M4 13a8 8 0 0 1 16 0" stroke-linecap="round" />
                                <rect x="3" y="13" width="4" height="6" rx="1.2" />
                                <rect x="17" y="13" width="4" height="6" rx="1.2" />
                                <path d="M20 19a4 4 0 0 1-4 4h-3" stroke-linecap="round" />
                            </svg>
                        </div>
                        <h4>24/7 Support</h4>
                        <p>We're there whenever you need us during your journey.</p>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <path d="M3 9l9-5 9 5-9 5-9-5z" />
                                <path d="M3 9v6l9 5 9-5V9" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 14v5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <h4>Flexible Packages</h4>
                        <p>Choose packages that fit your travel style and budget.</p>
                    </div>

                    <div class="item">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.5">
                                <path d="M8 12l2.5 2.5L16 9" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="12" cy="12" r="9" />
                            </svg>
                        </div>
                        <h4>Trusted Partners</h4>
                        <p>
                            We work with reliable hotels, transport providers and local
                            experts.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-secC">
            <div class="container">
                <div class="grid">
                    <!-- Left: Mission Images -->
                    <div class="img">
                        <div class="img__item img__item--one">
                            <img loading="lazy" src="assets/images/about/misson.webp"
                                alt="Travelers exploring a beautiful destination" />
                        </div>

                        <div class="img__item img__item--two">
                            <img loading="lazy" src="assets/images/about/misson.webp"
                                alt="Travelers enjoying an unforgettable journey" />
                        </div>
                    </div>

                    <!-- Right: Mission Content -->
                    <div class="content">
                        <div class="heading">
                            <h3>
                                Our Mission:
                                <span>Meaningful Travel.</span>
                            </h3>

                            <p>
                                We believe travel is more than visiting new places. It is
                                about discovering new experiences, creating lasting memories,
                                and connecting with the people and places around us. Our
                                mission is to make every journey easier to plan, richer to
                                experience, and memorable long after you return home.
                            </p>
                        </div>

                        <!-- Mission Features -->
                        <div class="features">
                            <!-- Meaningful Experiences -->
                            <div class="feature">
                                <span class="feature__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path d="M12 21s7-4.4 7-10.2A7 7 0 0 0 5 10.8C5 16.6 12 21 12 21Z"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9 10.5l2 2 4-4" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>

                                <div class="feature__text">
                                    <h4>Meaningful Experiences</h4>

                                    <p>
                                        We focus on experiences that help you discover the true
                                        character of every destination.
                                    </p>
                                </div>
                            </div>

                            <!-- Personalized Journeys -->
                            <div class="feature">
                                <span class="feature__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="8" r="3" />

                                        <path d="M5 20c.8-3.2 3.1-5 7-5s6.2 1.8 7 5" stroke-linecap="round" />
                                    </svg>
                                </span>

                                <div class="feature__text">
                                    <h4>Personalized Journeys</h4>

                                    <p>
                                        Every traveler is different, so we create trips around
                                        your interests, pace, and preferences.
                                    </p>
                                </div>
                            </div>

                            <!-- Thoughtful Planning -->
                            <div class="feature">
                                <span class="feature__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
                                        <rect x="4" y="5" width="16" height="15" rx="2" />

                                        <path d="M8 3v4M16 3v4M4 10h16" stroke-linecap="round" />

                                        <path d="M8 14h3M8 17h5" stroke-linecap="round" />
                                    </svg>
                                </span>

                                <div class="feature__text">
                                    <h4>Thoughtful Planning</h4>

                                    <p>
                                        From stays and activities to transportation, we take care
                                        of the details that make a trip run smoothly.
                                    </p>
                                </div>
                            </div>

                            <!-- Travel With Confidence -->
                            <div class="feature">
                                <span class="feature__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path d="M4 13a8 8 0 0 1 16 0" stroke-linecap="round" />

                                        <path
                                            d="M4 13v4a2 2 0 0 0 2 2h2v-6H6a2 2 0 0 0-2 2ZM20 13v4a2 2 0 0 1-2 2h-2v-6h2a2 2 0 0 1 2 2Z" />

                                        <path d="M16 19c-.7 1-1.8 2-4 2" stroke-linecap="round" />
                                    </svg>
                                </span>

                                <div class="feature__text">
                                    <h4>Travel With Confidence</h4>

                                    <p>
                                        Our team is here to support you throughout your journey,
                                        whenever you need us.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- CTA -->
                        <a href="#" class="btn btn-primary"> Plan Your Journey </a>
                    </div>
                </div>

                <!-- Decorative Plane -->
                <div class="plane">
                    <img loading="lazy" src="assets/images/about/plane-2.svg" alt="" aria-hidden="true" />
                </div>
            </div>
        </section>

        <section class="about-secE">
            <div class="container">
                <div class="heading">
                    <h3>How <span>It Works</span></h3>
                    <p>
                        We make every journey simple, memorable, and tailored to you—from
                        thoughtful planning to unforgettable experiences.
                    </p>
                </div>

                <div class="steps">
                    <div class="step step--yellow">
                        <span class="step__number">01</span>
                        <h4>Tell Us Your Plan</h4>
                        <p>
                            Share your destination, dates, budget and travel preferences.
                        </p>
                    </div>

                    <div class="step step--gray">
                        <span class="step__number">02</span>
                        <h4>We Plan Your Trip</h4>
                        <p>Our travel experts create a personalized itinerary for you.</p>
                    </div>

                    <div class="step step--lavender">
                        <span class="step__number">03</span>
                        <h4>Customize</h4>
                        <p>Modify hotels, activities, transportation and experiences.</p>
                    </div>

                    <div class="step step--green">
                        <span class="step__number">04</span>
                        <h4>Confirm Your Trip</h4>
                        <p>Finalize your itinerary and booking.</p>
                    </div>

                    <div class="step step--peach">
                        <span class="step__number">05</span>
                        <h4>Start Exploring</h4>
                        <p>Pack your bags and enjoy your journey.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-secD">
            <div class="bg">
                <img loading="lazy" src="assets/images/about/philosophy.jpg" alt="Travelers watching the sunset" />
            </div>

            <div class="overlay"></div>

            <div class="container">
                <div class="content">
                    <span class="eyebrow">Our Philosophy</span>
                    <div class="heading">
                        <h3>
                            We Don't Just Plan Trips.<br /><span>We Create Experiences.</span>
                        </h3>
                        <p>
                            We believe that travel should be an experience that enriches
                            your life and creates lasting memories. That's why we're
                            committed to providing exceptional service and creating
                            unforgettable journeys for every traveler.
                        </p>
                    </div>
                    <a href="#" class="btn btn-primary">Plan Your Journey</a>
                </div>
            </div>
        </section>

        <section class="about-secF">
            <div class="container">
                <div class="heading">
                    <h3>Meet The People <span>Behind Your Journey</span></h3>
                    <p>
                        Our travel experts bring passion and experience together to create
                        seamless, memorable journeys.
                    </p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper fourSilder">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="team_card">
                                    <div class="img">
                                        <img loading="lazy" src="assets/images/about/team1.jpg" alt="John Doe" />
                                    </div>
                                    <div class="socials">
                                        <a href="#" aria-label="Instagram">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                                <rect x="3" y="3" width="18" height="18" rx="5" />
                                                <circle cx="12" cy="12" r="4" />
                                                <circle cx="17.2" cy="6.8" r="1" />
                                            </svg>
                                        </a>
                                        <a href="#" aria-label="LinkedIn">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                                <rect x="3" y="3" width="18" height="18" rx="3" />
                                                <path d="M8 10v7M8 7v.01M12 17v-4.5a2 2 0 0 1 4 0V17" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h4>John Doe</h4>
                                        <p>Travel Specialist</p>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="team_card">
                                    <div class="img">
                                        <img loading="lazy" src="assets/images/about/team1.jpg" alt="Sarah Lee" />
                                    </div>
                                    <div class="socials">
                                        <a href="#" aria-label="Instagram">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                                <rect x="3" y="3" width="18" height="18" rx="5" />
                                                <circle cx="12" cy="12" r="4" />
                                                <circle cx="17.2" cy="6.8" r="1" />
                                            </svg>
                                        </a>
                                        <a href="#" aria-label="LinkedIn">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                                <rect x="3" y="3" width="18" height="18" rx="3" />
                                                <path d="M8 10v7M8 7v.01M12 17v-4.5a2 2 0 0 1 4 0V17" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h4>Sarah Lee</h4>
                                        <p>Itinerary Planner</p>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="team_card">
                                    <div class="img">
                                        <img loading="lazy" src="assets/images/about/team1.jpg" alt="Marcus Reed" />
                                    </div>
                                    <div class="socials">
                                        <a href="#" aria-label="Instagram">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                                <rect x="3" y="3" width="18" height="18" rx="5" />
                                                <circle cx="12" cy="12" r="4" />
                                                <circle cx="17.2" cy="6.8" r="1" />
                                            </svg>
                                        </a>
                                        <a href="#" aria-label="LinkedIn">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                                <rect x="3" y="3" width="18" height="18" rx="3" />
                                                <path d="M8 10v7M8 7v.01M12 17v-4.5a2 2 0 0 1 4 0V17" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h4>Marcus Reed</h4>
                                        <p>Local Guide Coordinator</p>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="team_card">
                                    <div class="img">
                                        <img loading="lazy" src="assets/images/about/team1.jpg" alt="Priya Nair" />
                                    </div>
                                    <div class="socials">
                                        <a href="#" aria-label="Instagram">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                                <rect x="3" y="3" width="18" height="18" rx="5" />
                                                <circle cx="12" cy="12" r="4" />
                                                <circle cx="17.2" cy="6.8" r="1" />
                                            </svg>
                                        </a>
                                        <a href="#" aria-label="LinkedIn">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                                <rect x="3" y="3" width="18" height="18" rx="3" />
                                                <path d="M8 10v7M8 7v.01M12 17v-4.5a2 2 0 0 1 4 0V17" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h4>Priya Nair</h4>
                                        <p>Customer Experience Lead</p>
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
            </div>
        </section>

        <section class="about-secI">
            <div class="container">
                <div class="heading">
                    <h3>Clients Feedback <span>About Us</span></h3>
                    <p>
                        Are you tired of the typical tourist destinations and looking to
                        step out of your comfort zone travel
                    </p>
                </div>

                <div class="swiper TestimonialSlider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="card">
                                <div class="header">
                                    <img loading="lazy" src="assets/images/home/client1.png" alt="Floyd Miles" />
                                    <div class="name">
                                        <h6>Floyd Miles</h6>
                                        <p>CEO, Traveller</p>
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
                                    “ Morem ipsum dolor siter amet areaeey consec taetur adipisc
                                    service ollwing ipsum dolor consectetur.”
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
                                    <img loading="lazy" src="assets/images/home/client2.png" alt="Floyd Miles" />
                                    <div class="name">
                                        <h6>Floyd Miles</h6>
                                        <p>CEO, Traveller</p>
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
                                    “ Morem ipsum dolor siter amet areaeey consec taetur adipisc
                                    service ollwing ipsum dolor consectetur.”
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
                                    <img loading="lazy" src="assets/images/home/client3.png" alt="Floyd Miles" />
                                    <div class="name">
                                        <h6>Floyd Miles</h6>
                                        <p>CEO, Traveller</p>
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
                                    “ Morem ipsum dolor siter amet areaeey consec taetur adipisc
                                    service ollwing ipsum dolor consectetur.”
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
                                    <img loading="lazy" src="assets/images/home/client2.png" alt="Floyd Miles" />
                                    <div class="name">
                                        <h6>Floyd Miles</h6>
                                        <p>CEO, Traveller</p>
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
                                    “ Morem ipsum dolor siter amet areaeey consec taetur adipisc
                                    service ollwing ipsum dolor consectetur.”
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
            </div>
        </section>

        <section class="about-secG">
            <div class="container">
                <div class="heading">
                    <h3>Moments From <span>The Journey</span></h3>
                    <p>
                        A glimpse into the places, faces and adventures our travelers have
                        captured along the way.
                    </p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper thirdSilder">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="gallery_img">
                                    <img loading="lazy" src="assets/images/home/card4.jpg"
                                        alt="Sunset over the mountains" />
                                    <div class="content">
                                        <h6>Mountain Sunset</h6>
                                        <span>Switzerland</span>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="gallery_img">
                                    <img loading="lazy" src="assets/images/home/banner2.jpg" alt="Beach camp at dusk" />
                                    <div class="content">
                                        <h6>Coastal Camp</h6>
                                        <span>Bali, Indonesia</span>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="gallery_img">
                                    <img loading="lazy" src="assets/images/home/card3.jpg" alt="Desert dunes at sunrise" />
                                    <div class="content">
                                        <h6>Desert Trails</h6>
                                        <span>Morocco</span>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="gallery_img">
                                    <img loading="lazy" src="assets/images/home/banner1.jpg" alt="Forest waterfall" />
                                    <div class="content">
                                        <h6>Hidden Falls</h6>
                                        <span>Iceland</span>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="gallery_img">
                                    <img loading="lazy" src="assets/images/home/card4.jpg" alt="City skyline at night" />
                                    <div class="content">
                                        <h6>City Lights</h6>
                                        <span>Tokyo, Japan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-group">
                        <button type="button" class="thirdSilder-prev btn-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                <path fill="#fff"
                                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                            </svg>
                        </button>
                        <button type="button" class="thirdSilder-next btn-next">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                <path fill="#fff"
                                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-secH">
            <div class="container">
                <div class="heading">
                    <h3>Awards and <span>Recognition</span></h3>
                </div>

                <div class="swiper logoSlider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img loading="lazy" src="assets/images/home/logos/logo1.png" alt="" />
                        </div>

                        <div class="swiper-slide">
                            <img loading="lazy" src="assets/images/home/logos/logo2.png" alt="" />
                        </div>

                        <div class="swiper-slide">
                            <img loading="lazy" src="assets/images/home/logos/logo3.png" alt="" />
                        </div>

                        <div class="swiper-slide">
                            <img loading="lazy" src="assets/images/home/logos/logo4.png" alt="" />
                        </div>

                        <!-- Duplicate Slides -->
                        <div class="swiper-slide">
                            <img loading="lazy" src="assets/images/home/logos/logo1.png" alt="" />
                        </div>

                        <div class="swiper-slide">
                            <img loading="lazy" src="assets/images/home/logos/logo2.png" alt="" />
                        </div>

                        <div class="swiper-slide">
                            <img loading="lazy" src="assets/images/home/logos/logo3.png" alt="" />
                        </div>

                        <div class="swiper-slide">
                            <img loading="lazy" src="assets/images/home/logos/logo4.png" alt="" />
                        </div>
                        <div class="swiper-slide">
                            <img loading="lazy" src="assets/images/home/logos/logo3.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-secJ">
            <div class="container">
                <div class="heading">
                    <h3>Get to Know <span>Our Journey.</span></h3>
                </div>

                <div class="accordion-wrapper">
                    <div class="accordion-item">
                        <div class="accordion-body">
                            <div class="accordion-header active">
                                <h4>What does your travel company do?</h4>
                                <span class="accordion-icon">−</span>
                            </div>

                            <div class="accordion-content">
                                <p>
                                    We plan and create memorable travel experiences, from
                                    carefully planned itineraries and stays to activities and
                                    local experiences, making every journey simple and
                                    enjoyable.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-body">
                            <div class="accordion-header">
                                <h4>Can you create a trip based on my preferences?</h4>
                                <span class="accordion-icon">+</span>
                            </div>

                            <div class="accordion-content">
                                <p>
                                    Absolutely. We create flexible travel plans based on your
                                    destination, interests, travel style, budget, and preferred
                                    experiences.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-body">
                            <div class="accordion-header">
                                <h4>What kind of trips do you plan?</h4>
                                <span class="accordion-icon">+</span>
                            </div>

                            <div class="accordion-content">
                                <p>
                                    We plan a wide range of journeys, including family holidays,
                                    romantic getaways, group trips, weekend escapes, adventure
                                    experiences, and customized vacations.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-body">
                            <div class="accordion-header">
                                <h4>What makes your travel experiences different?</h4>
                                <span class="accordion-icon">+</span>
                            </div>

                            <div class="accordion-content">
                                <p>
                                    We focus on thoughtful planning, personalized experiences,
                                    and reliable travel support so you can spend less time
                                    worrying about the details and more time enjoying your
                                    journey.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <div class="accordion-body">
                            <div class="accordion-header">
                                <h4>Will you support us during our journey?</h4>
                                <span class="accordion-icon">+</span>
                            </div>

                            <div class="accordion-content">
                                <p>
                                    Yes. Our team is available to assist you throughout your
                                    trip, helping with questions, changes, and unexpected
                                    situations so you can travel with confidence.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll(".stat-card__number");

            const animateCount = (el) => {
                const target = parseInt(el.dataset.count, 10);
                const suffix = el.dataset.suffix || "";
                const duration = 1400;
                const start = performance.now();

                const step = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 3); // ease-out
                    const value = Math.floor(eased * target);
                    el.textContent = value.toLocaleString() + suffix;
                    if (progress < 1) requestAnimationFrame(step);
                };
                requestAnimationFrame(step);
            };

            const observer = new IntersectionObserver(
                (entries, obs) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            animateCount(entry.target);
                            obs.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.4 },
            );

            counters.forEach((el) => observer.observe(el));
        });
    </script>

@endpush