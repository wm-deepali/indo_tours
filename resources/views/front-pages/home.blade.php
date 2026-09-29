@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/home/home.css') }}" />
@endpush

@section('content')

    <main>

        <!-- BANNER SECTION -->
        <section class="home-banner">
            <div class="banner-bg">
                <div class="container">
                    <div class="banner-row">
                        <div class="banner-person">
                            <img loading="lazy"
                                src="{{ $content->hero_person_image ? asset('storage/' . $content->hero_person_image) : asset('assets/images/home/person-search.png') }}"
                                alt="" />
                        </div>

                        <div class="content content-white">
                            <h6>{{ $content->hero_eyebrow }}</h6>
                            <h1>{{ $content->hero_heading }}</h1>
                            <p>{{ $content->hero_description }}</p>
                        </div>

                        <div class="banner-illustration">
                            <img loading="lazy"
                                src="{{ $content->hero_illustration_image ? asset('storage/' . $content->hero_illustration_image) : asset('assets/images/home/phone-illustration.png') }}"
                                alt="" />
                        </div>
                    </div>

                    <!-- ============ DESKTOP TRIP FINDER (left static) ============ -->
                    <div class="trip-finder">
                        <div class="trip-finder-tabs">
                            <button type="button" class="tab-btn active">Domestic</button>
                            <button type="button" class="tab-btn">International</button>
                        </div>

                        <div class="trip-category-swiper">
                            <button type="button" class="cat-nav cat-prev tabingSlider-prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="1em" viewBox="0 0 12 24">
                                    <path d="M0 0h12v24H0z" fill="none" />
                                    <defs>
                                        <path id="SVG1pzpbdYY" fill="currentColor"
                                            d="m7.588 12.43l-1.061 1.06L.748 7.713a.996.996 0 0 1 0-1.413L6.527.52l1.06 1.06l-5.424 5.425z" />
                                    </defs>
                                    <use fill-rule="evenodd" href="#SVG1pzpbdYY" transform="rotate(-180 5.02 9.505)" />
                                </svg>
                            </button>

                            <div class="swiper tabingSlider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <button type="button" class="cat-item active" data-cat="all">
                                            <span class="cat-ico">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                    viewBox="0 0 24 24">
                                                    <path d="M0 0h24v24H0z" fill="none" />
                                                    <g fill="none" stroke="currentColor" stroke-linejoin="round">
                                                        <rect width="16" height="5" x="4" y="5" rx="1" />
                                                        <rect width="16" height="5" x="4" y="14" rx="1" />
                                                    </g>
                                                </svg>
                                            </span>
                                            All
                                        </button>
                                    </div>

                                    <div class="swiper-slide">
                                        <button type="button" class="cat-item" data-cat="adventure">
                                            <span class="cat-ico">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                    viewBox="0 0 24 24">
                                                    <path d="M0 0h24v24H0z" fill="none" />
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="m10 9.01l.01-.011M14 9.01l.01-.011M10 13.01l.01-.011m3.99.011l.01-.011M10 17.01l.01-.011m3.99.011l.01-.011M6 20.4V5.6a.6.6 0 0 1 .6-.6H12V3.6a.6.6 0 0 1 .6-.6h4.8a.6.6 0 0 1 .6.6v16.8a.6.6 0 0 1-.6.6H6.6a.6.6 0 0 1-.6-.6" />
                                                </svg>
                                            </span>
                                            Adventure
                                        </button>
                                    </div>

                                    <div class="swiper-slide">
                                        <button type="button" class="cat-item" data-cat="beach">
                                            <span class="cat-ico">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                    viewBox="0 0 24 24">
                                                    <path d="M0 0h24v24H0z" fill="none" />
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="m10 9.01l.01-.011M14 9.01l.01-.011M10 13.01l.01-.011m3.99.011l.01-.011M10 17.01l.01-.011m3.99.011l.01-.011M6 20.4V5.6a.6.6 0 0 1 .6-.6H12V3.6a.6.6 0 0 1 .6-.6h4.8a.6.6 0 0 1 .6.6v16.8a.6.6 0 0 1-.6.6H6.6a.6.6 0 0 1-.6-.6" />
                                                </svg>
                                            </span>
                                            Beach
                                        </button>
                                    </div>

                                    <div class="swiper-slide">
                                        <button type="button" class="cat-item" data-cat="mountain">
                                            <span class="cat-ico">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                    viewBox="0 0 24 24">
                                                    <path d="M0 0h24v24H0z" fill="none" />
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="m10 9.01l.01-.011M14 9.01l.01-.011M10 13.01l.01-.011m3.99.011l.01-.011M10 17.01l.01-.011m3.99.011l.01-.011M6 20.4V5.6a.6.6 0 0 1 .6-.6H12V3.6a.6.6 0 0 1 .6-.6h4.8a.6.6 0 0 1 .6.6v16.8a.6.6 0 0 1-.6.6H6.6a.6.6 0 0 1-.6-.6" />
                                                </svg>
                                            </span>
                                            Mountain
                                        </button>
                                    </div>

                                    <div class="swiper-slide">
                                        <button type="button" class="cat-item" data-cat="cultural">
                                            <span class="cat-ico">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                    viewBox="0 0 24 24">
                                                    <path d="M0 0h24v24H0z" fill="none" />
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="m10 9.01l.01-.011M14 9.01l.01-.011M10 13.01l.01-.011m3.99.011l.01-.011M10 17.01l.01-.011m3.99.011l.01-.011M6 20.4V5.6a.6.6 0 0 1 .6-.6H12V3.6a.6.6 0 0 1 .6-.6h4.8a.6.6 0 0 1 .6.6v16.8a.6.6 0 0 1-.6.6H6.6a.6.6 0 0 1-.6-.6" />
                                                </svg>
                                            </span>
                                            Cultural
                                        </button>
                                    </div>

                                    <div class="swiper-slide">
                                        <button type="button" class="cat-item" data-cat="wildlife">
                                            <span class="cat-ico">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                    viewBox="0 0 24 24">
                                                    <path d="M0 0h24v24H0z" fill="none" />
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="m10 9.01l.01-.011M14 9.01l.01-.011M10 13.01l.01-.011m3.99.011l.01-.011M10 17.01l.01-.011m3.99.011l.01-.011M6 20.4V5.6a.6.6 0 0 1 .6-.6H12V3.6a.6.6 0 0 1 .6-.6h4.8a.6.6 0 0 1 .6.6v16.8a.6.6 0 0 1-.6.6H6.6a.6.6 0 0 1-.6-.6" />
                                                </svg>
                                            </span>
                                            Wildlife
                                        </button>
                                    </div>

                                    <div class="swiper-slide">
                                        <button type="button" class="cat-item" data-cat="cruise">
                                            <span class="cat-ico">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                    viewBox="0 0 24 24">
                                                    <path d="M0 0h24v24H0z" fill="none" />
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="m10 9.01l.01-.011M14 9.01l.01-.011M10 13.01l.01-.011m3.99.011l.01-.011M10 17.01l.01-.011m3.99.011l.01-.011M6 20.4V5.6a.6.6 0 0 1 .6-.6H12V3.6a.6.6 0 0 1 .6-.6h4.8a.6.6 0 0 1 .6.6v16.8a.6.6 0 0 1-.6.6H6.6a.6.6 0 0 1-.6-.6" />
                                                </svg>
                                            </span>
                                            Cruise
                                        </button>
                                    </div>

                                    <div class="swiper-slide">
                                        <button type="button" class="cat-item" data-cat="city-tour">
                                            <span class="cat-ico">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                    viewBox="0 0 24 24">
                                                    <path d="M0 0h24v24H0z" fill="none" />
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="m10 9.01l.01-.011M14 9.01l.01-.011M10 13.01l.01-.011m3.99.011l.01-.011M10 17.01l.01-.011m3.99.011l.01-.011M6 20.4V5.6a.6.6 0 0 1 .6-.6H12V3.6a.6.6 0 0 1 .6-.6h4.8a.6.6 0 0 1 .6.6v16.8a.6.6 0 0 1-.6.6H6.6a.6.6 0 0 1-.6-.6" />
                                                </svg>
                                            </span>
                                            City Tour
                                        </button>
                                    </div>

                                    <div class="swiper-slide">
                                        <button type="button" class="cat-item" data-cat="trekking">
                                            <span class="cat-ico">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                    viewBox="0 0 24 24">
                                                    <path d="M0 0h24v24H0z" fill="none" />
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="m10 9.01l.01-.011M14 9.01l.01-.011M10 13.01l.01-.011m3.99.011l.01-.011M10 17.01l.01-.011m3.99.011l.01-.011M6 20.4V5.6a.6.6 0 0 1 .6-.6H12V3.6a.6.6 0 0 1 .6-.6h4.8a.6.6 0 0 1 .6.6v16.8a.6.6 0 0 1-.6.6H6.6a.6.6 0 0 1-.6-.6" />
                                                </svg>
                                            </span>
                                            Trekking
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="cat-nav cat-next tabingSlider-next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="1em" viewBox="0 0 12 24">
                                    <path d="M0 0h12v24H0z" fill="none" />
                                    <defs>
                                        <path id="SVG1pzpbdYY" fill="currentColor"
                                            d="m7.588 12.43l-1.061 1.06L.748 7.713a.996.996 0 0 1 0-1.413L6.527.52l1.06 1.06l-5.424 5.425z" />
                                    </defs>
                                    <use fill-rule="evenodd" href="#SVG1pzpbdYY" transform="rotate(-180 5.02 9.505)" />
                                </svg>
                            </button>
                        </div>

                        <div class="trip-finder-form">
                            <div class="finder-item select-field">
                                <span class="ico">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                        <path d="M0 0h24v24H0z" fill="none" />
                                        <path fill="currentColor" fill-rule="evenodd"
                                            d="m12.065 21.243l-.006-.005zm.182-.274a29 29 0 0 0 3.183-3.392c2.04-2.563 3.281-5.09 3.365-7.337a6.8 6.8 0 1 0-13.591 0c.085 2.247 1.327 4.774 3.366 7.337a29 29 0 0 0 3.183 3.392q.166.15.247.218zm-.985 1.165S4 16.018 4 10a8 8 0 1 1 16 0c0 6.018-7.262 12.134-7.262 12.134c-.404.372-1.069.368-1.476 0M12 12.8a2.8 2.8 0 1 0 0-5.6a2.8 2.8 0 0 0 0 5.6m0 1.2a4 4 0 1 1 0-8a4 4 0 0 1 0 8" />
                                    </svg>
                                </span>
                                <select name="location" class="js-nice-select" id="d_location">
                                    <option value="">Location</option>
                                    <option value="kashmir">Kashmir</option>
                                    <option value="goa">Goa</option>
                                    <option value="manali">Manali</option>
                                    <option value="rajasthan">Rajasthan</option>
                                    <option value="kerala">Kerala</option>
                                    <option value="dubai">Dubai</option>
                                </select>
                            </div>

                            <div class="finder-item select-field">
                                <select name="trip-type" class="js-nice-select" id="d_trip_type">
                                    <option value="">Trip Type</option>
                                    <option value="solo">Solo</option>
                                    <option value="couple">Couple</option>
                                    <option value="family">Family</option>
                                    <option value="group">Group</option>
                                    <option value="honeymoon">Honeymoon</option>
                                </select>
                            </div>

                            <div class="finder-item select-field">
                                <select name="duration" class="js-nice-select" id="d_duration">
                                    <option value="">Duration</option>
                                    <option value="1-3">1-3 Days</option>
                                    <option value="4-6">4-6 Days</option>
                                    <option value="7-9">7-9 Days</option>
                                    <option value="10plus">10+ Days</option>
                                </select>
                            </div>

                            <div class="finder-item select-field">
                                <select name="budget" class="js-nice-select" id="d_budget">
                                    <option value="">Budget</option>
                                    <option value="under20k">Under ₹20,000</option>
                                    <option value="20-40k">₹20,000 - ₹40,000</option>
                                    <option value="40-60k">₹40,000 - ₹60,000</option>
                                    <option value="60kplus">₹60,000+</option>
                                </select>
                            </div>

                            <div class="finder-search">
                                <input type="text" id="d_search" placeholder="Search by destination or trip name" />
                            </div>

                            <div class="finder-item finder-filters">
                                <span>All Filters</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="0.5em" height="1em" viewBox="0 0 12 24">
                                    <path d="M0 0h12v24H0z" fill="none" />
                                    <defs>
                                        <path id="SVG1pzpbdYY" fill="currentColor"
                                            d="m7.588 12.43l-1.061 1.06L.748 7.713a.996.996 0 0 1 0-1.413L6.527.52l1.06 1.06l-5.424 5.425z" />
                                    </defs>
                                    <use fill-rule="evenodd" href="#SVG1pzpbdYY" transform="rotate(-180 5.02 9.505)" />
                                </svg>
                            </div>

                            <button type="button" class="btn btn-primary finder-btn" id="d_search_btn">Search</button>
                        </div>
                    </div>

                    <!-- ============ MOBILE TRIGGER (left static) ============ -->
                    <div class="btn-group mobile-filter-trigger">
                        <button type="button" class="btn btn-white" data-model=".filter_trip">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <path d="M4 6h16M7 12h10M10 18h4" stroke-linecap="round" />
                                <path d="M4 6h16M7 12h10M10 18h4" stroke-linecap="round" />
                            </svg>
                            All Filters
                            <span class="filter-count" id="filterCount"></span>
                        </button>
                        <a href="javascript:void()" data-model=".enquire-pop" class="btn btn-outline-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path fill="currentColor"
                                    d="m21 15.46l-5.27-.61l-2.52 2.52a15.05 15.05 0 0 1-6.59-6.59l2.53-2.53L8.54 3H3.03C2.45 13.18 10.82 21.55 21 20.97z">
                                </path>
                            </svg>

                            Enquire Now
                        </a>
                    </div>
                </div>
            </div>
        </section>

        @include('front-pages.partials.tour-sections', ['sections' => $tourSections['after_banner'] ?? collect()])

        <!-- PROMO GRID -->
        <section class="home-secB">
            <div class="container">
                <div class="promo-grid">
                    <div class="promo-left">
                        <span class="promo-left__badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="9" />
                                <path d="M15 9l-2 5-5 2 2-5z" />
                            </svg>
                        </span>
                        <p class="promo-left__eyebrow">{{ $content->promo_eyebrow }}</p>
                        <h4 class="promo-left__heading">{{ $content->promo_heading }}</h4>
                        @if ($content->promo_cta_text)
                            <a href="{{ $content->promo_cta_url ?: 'javascript:void(0)' }}" class="btn btn-white">
                                {{ $content->promo_cta_text }}
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </a>
                        @endif
                    </div>

                    <div class="promo-right">
                        <img loading="lazy"
                            src="{{ $content->promo_image ? asset('storage/' . $content->promo_image) : asset('assets/images/home/bg.jpg') }}"
                            alt="Tropical beach aerial view" />
                        <div class="promo-right__overlay">
                            <h2 class="promo-right__script">{{ $content->promo_script_line_1 }}</h2>
                            <h2 class="promo-right__script promo-right__script--underline">
                                {{ $content->promo_script_line_2 }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('front-pages.partials.tour-sections', ['sections' => $tourSections['after_promo'] ?? collect()])

        <!-- GROUP OFFER BANNER -->
        <section class="group-offer-banner">
            <div class="container">
                <div class="group-offer-banner__inner">
                    <div class="group-offer-banner__content">
                        <span class="group-offer-banner__badge">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor"
                                    d="M12 2l1.6 4.8L18 5l-1.8 4.4L21 12l-4.8 1.6L18 19l-4.4-1.8L12 22l-1.6-4.8L6 19l1.8-4.4L3 12l4.8-1.6L6 5l4.4 1.8z" />
                            </svg>
                            {{ $content->group_offer_badge_text }}
                        </span>

                        <h3>{{ $content->group_offer_heading }}</h3>

                        <p>{{ $content->group_offer_description }}</p>

                        <ul class="group-offer-banner__perks">
                            @foreach ($content->group_offer_perks ?? [] as $perk)
                                <li>{{ $perk }}</li>
                            @endforeach
                        </ul>

                        <div class="group-offer-banner__actions">
                            @if ($content->group_offer_cta1_text)
                                <a href="{{ $content->group_offer_cta1_url ?: '#' }}" class="btn btn-white">
                                    {{ $content->group_offer_cta1_text }}
                                </a>
                            @endif
                            @if ($content->group_offer_cta2_text)
                                <a href="{{ $content->group_offer_cta2_url ?: 'javascript:void()' }}" data-model=".enquire-pop"
                                    class="btn btn-outline-white">
                                    {{ $content->group_offer_cta2_text }}
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="group-offer-banner__media">
                        <div class="group-offer-banner__img group-offer-banner__img--secondary">
                            <img loading="lazy"
                                src="{{ $content->group_offer_image ? asset('storage/' . $content->group_offer_image) : asset('assets/images/listing/banner1.jpg') }}"
                                alt="Travellers enjoying their trip" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- WHO WE ARE -->
        <section class="home-secD">
            <div class="container">
                <div class="grid">
                    <div class="img">
                        <div class="img__blob"></div>
                        <img loading="lazy"
                            src="{{ $content->who_we_are_image ? asset('storage/' . $content->who_we_are_image) : asset('assets/images/home/h1-about-thumb.png') }}"
                            alt="Traveler with backpack" />
                        <span class="img__doodle img__doodle--camera">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                                <rect x="3" y="7" width="18" height="13" rx="2" />
                                <circle cx="12" cy="13.5" r="3.5" />
                                <path d="M8 7l1.5-2h5L16 7" />
                            </svg>
                        </span>
                        <span class="img__doodle img__doodle--hat">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                                <path d="M2 15c4-3 16-3 20 0" />
                                <ellipse cx="12" cy="10" rx="5" ry="4" />
                            </svg>
                        </span>
                    </div>

                    <div class="item-content">
                        <div class="heading">
                            <span class="badge">{{ $content->who_we_are_badge }}</span>
                            <h3>
                                {{ $content->who_we_are_heading }}
                                <span>{{ $content->who_we_are_heading_highlight }}</span>
                            </h3>
                            <p>{{ $content->who_we_are_description }}</p>
                        </div>

                        <ul class="stats">
                            @foreach ($content->who_we_are_stats ?? [] as $stat)
                                <li>
                                    <span class="stats__icon">
                                        @if (!empty($stat['icon']))
                                            <img loading="lazy" src="{{ asset('storage/' . $stat['icon']) }}"
                                                alt="{{ $stat['label'] }}" />
                                        @else
                                            <img loading="lazy" src="{{ asset('assets/icon/icon1.png') }}" alt="" />
                                        @endif
                                    </span>
                                    <div class="content">
                                        <h4>{{ $stat['count'] }}</h4>
                                        <p>{{ $stat['label'] }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        @if ($content->who_we_are_cta_text)
                            <div class="footer-row">
                                <a href="{{ $content->who_we_are_cta_url ?: 'javascript:void(0)' }}" class="btn btn-primary">
                                    {{ $content->who_we_are_cta_text }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- HOME SLIDER -->
        <section class="home-secH">
            <div class="container">
                <div class="swiper homeSlider">
                    <div class="swiper-wrapper">
                        @forelse ($content->home_slider_images ?? [] as $slide)
                            <div class="swiper-slide">
                                <img loading="lazy"
                                    src="{{ !empty($slide['image']) ? asset('storage/' . $slide['image']) : asset('assets/images/home/swiper-banner.png') }}"
                                    alt="{{ $slide['alt'] ?? 'Travel destination banner' }}" />
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <img loading="lazy" src="{{ asset('assets/images/home/swiper-banner.png') }}"
                                    alt="Travel destination banner" />
                            </div>
                        @endforelse
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        @include('front-pages.partials.tour-sections', ['sections' => $tourSections['after_slider'] ?? collect()])

        <!-- TESTIMONIALS SECTION -->
        <section class="home-secI">
            <div class="container">
                <div class="heading">
                    <h3>{{ $content->testimonials_heading }}</h3>
                    <p>{{ $content->testimonials_description }}</p>
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
                                        <div class="quotes">
                                            <svg width="34" height="26" viewBox="0 0 44 34" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5654 42.7691 19.7951 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                                                    fill="white" stroke="#D1D1D1" />
                                            </svg>
                                        </div>
                                    </div>

                                    <p class="quote">"{{ $testimonial->quote }}"</p>

                                    <div class="stars">
                                        @for ($i = 1; $i <= $testimonial->rating; $i++)
                                            <svg viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
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

        <!-- 25% DISCOUNT STRIP -->
        <section class="home-secE">
            <div class="container">
                <div class="grid">
                    <div class="item-content">
                        <img loading="lazy"
                            src="{{ $content->discount_strip_bg_image ? asset('storage/' . $content->discount_strip_bg_image) : asset('assets/images/home/h1-banner-bg.jpg') }}"
                            alt="Couple traveling by the sea" />
                        <div class="content">
                            <span class="content__eyebrow">{{ $content->discount_strip_eyebrow }}</span>
                            <div class="dic">
                                <h3>{{ $content->discount_strip_percent }}</h3>
                                <h5>{{ $content->discount_strip_label }}</h5>
                            </div>
                            @if ($content->discount_strip_cta_text)
                                <a href="{{ $content->discount_strip_cta_url ?: 'javascript:void(0)' }}" class="btn btn-white">
                                    {{ $content->discount_strip_cta_text }}
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="item-img">
                        <img loading="lazy"
                            src="{{ $content->discount_strip_side_image ? asset('storage/' . $content->discount_strip_side_image) : asset('assets/images/home/banner.jpg') }}"
                            alt="Traveler hiking by the coast" />
                    </div>
                </div>
            </div>
        </section>

        <!-- "WE'RE THERE" SUPPORT SECTION -->
        <section class="home-secK">
            <div class="container">
                <div class="grid">
                    <div class="img">
                        <img loading="lazy"
                            src="{{ $content->support_image ? asset('storage/' . $content->support_image) : asset('assets/images/home/img.jpg') }}"
                            alt="Traveler receiving on-ground support during a trip" />
                    </div>
                    <div class="content">
                        <div class="heading">
                            <h3>
                                {{ $content->support_heading }} <span>{{ $content->support_heading_highlight }}</span>
                            </h3>
                            <p>{{ $content->support_description }}</p>
                        </div>
                        <ul class="lists">
                            @foreach ($content->support_items ?? [] as $item)
                                <li>
                                    <div class="icon">
                                        @if (!empty($item['icon']))
                                            <img src="{{ asset('storage/' . $item['icon']) }}" alt="{{ $item['title'] }}"
                                                style="width:24px;height:24px;">
                                        @else
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="text">
                                        <h6>{{ $item['title'] }}</h6>
                                        <p>{{ $item['description'] }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        @include('front-pages.partials.tour-sections', ['sections' => $tourSections['after_support'] ?? collect()])
        
        <!-- ============ AWARDS AND RECOGNITION (left static) ============ -->
        <!-- <section class="home-secF">
                <div class="container">
                    <div class="heading">
                        <h3>Awards and <span>Recognition</span></h3>
                    </div>

                    <div class="swiper logoSlider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img loading="lazy"
                                    src="{{ asset('assets/images/home/logos/logo1.png') }}" alt="" /></div>
                            <div class="swiper-slide"><img loading="lazy"
                                    src="{{ asset('assets/images/home/logos/logo2.png') }}" alt="" /></div>
                            <div class="swiper-slide"><img loading="lazy"
                                    src="{{ asset('assets/images/home/logos/logo3.png') }}" alt="" /></div>
                            <div class="swiper-slide"><img loading="lazy"
                                    src="{{ asset('assets/images/home/logos/logo4.png') }}" alt="" /></div>
                            <div class="swiper-slide"><img loading="lazy"
                                    src="{{ asset('assets/images/home/logos/logo1.png') }}" alt="" /></div>
                            <div class="swiper-slide"><img loading="lazy"
                                    src="{{ asset('assets/images/home/logos/logo2.png') }}" alt="" /></div>
                            <div class="swiper-slide"><img loading="lazy"
                                    src="{{ asset('assets/images/home/logos/logo3.png') }}" alt="" /></div>
                            <div class="swiper-slide"><img loading="lazy"
                                    src="{{ asset('assets/images/home/logos/logo4.png') }}" alt="" /></div>
                            <div class="swiper-slide"><img loading="lazy"
                                    src="{{ asset('assets/images/home/logos/logo3.png') }}" alt="" /></div>
                        </div>
                    </div>
                </div>
            </section> -->

    </main>

    <!-- APP DOWNLOAD / NEWSLETTER BANNER -->
    <section class="app-promo">
        <div class="container">
            <div class="app-promo-inner">
                <div class="app-promo-text">
                    <span class="eyebrow">{{ $content->newsletter_eyebrow }}</span>
                    <h3>{{ $content->newsletter_heading }}</h3>

                    <div class="form form-grid">
                        <div class="form-group">
                            <input name="txtJoinNowEmail" type="email" placeholder=" " class="form-control" required />
                            <label for="txtJoinNowEmail">Enter your email address</label>
                        </div>
                        <a href="javascript:void(0)" class="sbmt btn btn-white">
                            {{ $content->newsletter_cta_text }}
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M5 12h14m0 0-6-6m6 6-6 6" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="app-promo-visual">
                    <div class="phone phone--back">
                        <img loading="lazy"
                            src="{{ $content->newsletter_phone_image ? asset('storage/' . $content->newsletter_phone_image) : asset('assets/images/home/mobile.png') }}"
                            alt="App preview" />
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('scripts')
    <script>
        $(function () {
            if (
                window.location.pathname === "/" ||
                window.location.pathname.includes("index")
            ) {
                const hasShownPopup = sessionStorage.getItem("offerPopupShown");
                if (!hasShownPopup) {
                    setTimeout(function () {
                        $(".offer-pop.model").addClass("is-open");
                        $(".overlay").addClass("is-open");
                        sessionStorage.setItem("offerPopupShown", "true");
                    }, 3000);
                }
            }
        });
    </script>
@endpush