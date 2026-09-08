@extends('layouts.app')

@section('title', 'Home | Indo Tours & Adventures')
@section('meta_description', 'Indo Tours & Adventures is a leading travel company offering a wide range of tour packages, including domestic and international destinations. Explore the world with our expertly crafted itineraries and exceptional services.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/home/home.css') }}" />
@endpush

@section('content')

<main>
<section class="home-banner">
    <div class="banner-bg">
        <div class="container">
            <div class="banner-row">
                <div class="banner-person">
                    <img loading="lazy" src="{{ asset('assets/images/home/person-search.png') }}" alt="" />
                </div>

                <div class="content content-white">
                    <h6>Plan Smarter. Travel Better.</h6>
                    <h1>Your Perfect Trip, <br />Planned in Minutes</h1>
                    <p>
                        Create personalized travel itineraries, discover the best
                        destinations, manage your schedule, and enjoy a seamless
                        journey from start to finish.
                    </p>
                </div>

                <div class="banner-illustration">
                    <img loading="lazy" src="{{ asset('assets/images/home/phone-illustration.png') }}" alt="" />
                </div>
            </div>

            <!-- ============ DESKTOP TRIP FINDER (hidden below 768px) ============ -->
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

            <!-- ============ MOBILE TRIGGER (visible below 768px) ============ -->
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



<section class="home-secA">
    <div class="container">
        <div class="heading">
            <h3>Tours In <span>Maldives</span></h3>
            <p>
                Choose from our handpicked travel experiences, designed to make
                every journey unforgettable.
            </p>
        </div>
        <div class="swiper-wrap">
            <div class="swiper thirdSilder">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card1.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card2.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card3.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>
                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card4.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card1.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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
                </div>
            </div>
            <div class="swiper-group">
                <button type="button" class="thirdSilder-prev btn-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                        <path fill="#ffff"
                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0">
                        </path>
                    </svg>
                </button>

                <button type="button" class="thirdSilder-next btn-next">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                        <path fill="#ffff"
                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="center-btn">
            <a href="javascript:void()" class="btn btn-outline-primary">View All</a>
        </div>
    </div>
</section>

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
                <p class="promo-left__eyebrow">Enjoy Summer Deals</p>
                <h4 class="promo-left__heading">Up to 40% Discount!</h4>
                <button class="btn btn-white">
                    See Details
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </button>
            </div>

            <div class="promo-right">
                <img loading="lazy" src="{{ asset('assets/images/home/bg.jpg') }}" alt="Tropical beach aerial view" />
                <div class="promo-right__overlay">
                    <h2 class="promo-right__script">Let's Discover</h2>
                    <h2 class="promo-right__script promo-right__script--underline">
                        The Whole World!
                    </h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-secC">
    <div class="container">
        <div class="heading">
            <h3>Tours In <span>Japan</span></h3>
            <p>
                Choose from our handpicked travel experiences, designed to make
                every journey unforgettable.
            </p>
        </div>
        <div class="swiper-wrap">
            <div class="swiper thirdSilder">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card1.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card2.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card3.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>
                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card4.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card1.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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
                </div>
            </div>
            <div class="swiper-group">
                <button type="button" class="thirdSilder-prev btn-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                        <path fill="#ffff"
                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0">
                        </path>
                    </svg>
                </button>

                <button type="button" class="thirdSilder-next btn-next">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                        <path fill="#ffff"
                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="center-btn">
            <a href="javascript:void()" class="btn btn-outline-primary">View All</a>
        </div>
    </div>
</section>

<!-- ================= GROUP OFFER BANNER ================= -->
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
                    Limited-Time Offer
                </span>

                <h3>Can't Decide? Get Up to 40% Off on Any Package You Choose</h3>

                <p>
                    Every package on this page qualifies for early-booking
                    discounts, free transfers and flexible date changes — offer ends
                    soon.
                </p>

                <ul class="group-offer-banner__perks">
                    <li>Early Bird Discount up to 40% Off</li>
                    <li>Free Transfers on All Packages</li>
                    <li>Free Cancellation Up to 15 Days Before Travel</li>
                </ul>

                <div class="group-offer-banner__actions">
                    <a href="#package-list" class="btn btn-white"> View Offers </a>
                    <a href="javascript:void()" data-model=".enquire-pop" class="btn btn-outline-white">
                        Get A Quote
                    </a>
                </div>
            </div>

            <div class="group-offer-banner__media">
                <div class="group-offer-banner__img group-offer-banner__img--secondary">
                    <img loading="lazy" src="{{ asset('assets/images/listing/banner1.jpg') }}" alt="Travellers enjoying their trip" />
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-secD">
    <div class="container">
        <div class="grid">
            <div class="img">
                <div class="img__blob"></div>
                <img loading="lazy" src="{{ asset('assets/images/home/h1-about-thumb.png') }}" alt="Traveler with backpack" />
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
                    <span class="badge">Who we are</span>
                    <h3>
                        Here Is Great Opportunity For
                        <span>Adventure &amp; Travels</span>
                    </h3>
                    <p>
                        Dorem ipsum dolor sit amet consectetur adipiscing elit. Mauris
                        nullam the Lorem ipsum dolor sit amet consectetur adipiscing
                        elit. Consectetur adipiscing elit. Mauris nullam the Lorem
                        ipsum dolor
                    </p>
                </div>

                <ul class="stats">
                    <li>
                        <span class="stats__icon">
                            <img loading="lazy" src="{{ asset('assets/icon/icon1.png') }}" alt="" />
                        </span>
                        <div class="content">
                            <h4>5,000+</h4>
                            <p>Top Destination</p>
                        </div>
                    </li>
                    <li>
                        <span class="stats__icon">
                            <img loading="lazy" src="{{ asset('assets/icon/icon2.png') }}" alt="" />
                        </span>
                        <div class="content">
                            <h4>3,000+</h4>
                            <p>Booking Completed</p>
                        </div>
                    </li>
                    <li>
                        <span class="stats__icon">
                            <img loading="lazy" src="{{ asset('assets/icon/icon3.png') }}" alt="" />
                        </span>
                        <div class="content">
                            <h4>11,000+</h4>
                            <p>Satisfied Clients</p>
                        </div>
                    </li>
                </ul>

                <div class="footer-row">
                    <a href="javascript:void(0)" class="btn btn-primary">More About Us</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-secH">
    <div class="container">
        <div class="swiper homeSlider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img loading="lazy" src="{{ asset('assets/images/home/swiper-banner.png') }}" alt="Travel destination banner" />
                </div>
                <div class="swiper-slide">
                    <img loading="lazy" src="{{ asset('assets/images/home/swiper-banner.png') }}" alt="Travel destination banner" />
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<section class="home-secA">
    <div class="container">
        <div class="heading">
            <h3>Tours In <span>Dubai</span></h3>
            <p>
                Choose from our handpicked travel experiences, designed to make
                every journey unforgettable.
            </p>
        </div>
        <div class="swiper-wrap">
            <div class="swiper thirdSilder">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card1.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card2.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card3.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>
                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card4.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card1.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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
                </div>
            </div>
            <div class="swiper-group">
                <button type="button" class="thirdSilder-prev btn-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                        <path fill="#ffff"
                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0">
                        </path>
                    </svg>
                </button>

                <button type="button" class="thirdSilder-next btn-next">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                        <path fill="#ffff"
                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="center-btn">
            <a href="javascript:void()" class="btn btn-outline-primary">View All</a>
        </div>
    </div>
</section>

<section class="home-secG">
    <div class="container">
        <div class="heading">
            <h3>Tours In <span>Thailand</span></h3>
            <p>
                Choose from our handpicked travel experiences, designed to make
                every journey unforgettable.
            </p>
        </div>
        <div class="swiper-wrap">
            <div class="swiper thirdSilder">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card1.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card2.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card3.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>
                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card4.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card1.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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
                </div>
            </div>
            <div class="swiper-group">
                <button type="button" class="thirdSilder-prev btn-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                        <path fill="#ffff"
                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0">
                        </path>
                    </svg>
                </button>

                <button type="button" class="thirdSilder-next btn-next">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                        <path fill="#ffff"
                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="center-btn">
            <a href="javascript:void()" class="btn btn-outline-primary">View All</a>
        </div>
    </div>
</section>

<section class="home-secI">
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
                            <img loading="lazy" src="{{ asset('assets/images/home/client1.png') }}" alt="Floyd Miles" />
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
                            <img loading="lazy" src="{{ asset('assets/images/home/client2.png') }}" alt="Floyd Miles" />
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
                            <img loading="lazy" src="{{ asset('assets/images/home/client3.png') }}" alt="Floyd Miles" />
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
                            <img loading="lazy" src="{{ asset('assets/images/home/client2.png') }}" alt="Floyd Miles" />
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

<section class="home-secE">
    <div class="container">
        <div class="grid">
            <div class="item-content">
                <img loading="lazy" src="{{ asset('assets/images/home/h1-banner-bg.jpg') }}" alt="Couple traveling by the sea" />
                <div class="content">
                    <span class="content__eyebrow">Travel Feni</span>
                    <div class="dic">
                        <h3>25%</h3>
                        <h5>Extra Discount</h5>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-white">Book Now</a>
                </div>
            </div>

            <div class="item-img">
                <img loading="lazy" src="{{ asset('assets/images/home/banner.jpg') }}" alt="Traveler hiking by the coast" />
            </div>
        </div>
    </div>
</section>

<section class="home-secK">
    <div class="container">
        <div class="grid">
            <div class="img">
                <img loading="lazy" src="{{ asset('assets/images/home/img.jpg') }}"
                    alt="Traveler receiving on-ground support during a trip" />
            </div>
            <div class="content">
                <div class="heading">
                    <h3>
                        When Something Unexpected Happens, <span>We're There</span>
                    </h3>
                    <p>
                        On-ground teams and real humans supporting you, before,
                        during, and after your trip. Help when it truly matters.
                    </p>
                </div>
                <ul class="lists">
                    <li>
                        <div class="icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4Z"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M20 21c0-3.31-3.58-6-8-6s-8 2.69-8 6" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="text">
                            <h6>Human Support, Not Ticket Numbers</h6>
                            <p>
                                You're assisted by real people who understand your booking
                                — not automated replies or disconnected vendors.
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2 3 6v6c0 5 3.8 9.4 9 10 5.2-.6 9-5 9-10V6l-9-4Z" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="text">
                            <h6>On-Ground Teams in Every City</h6>
                            <p>
                                Local coordinators are on standby at your destination,
                                ready to step in the moment plans change.
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 8v4l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8" />
                            </svg>
                        </div>
                        <div class="text">
                            <h6>Always-On Response Time</h6>
                            <p>
                                Flight delays, missed connections, sudden changes — our
                                team is reachable around the clock, every day of your
                                trip.
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 21s-7-4.5-9.5-9C1 8.5 2.5 5 6 5c2 0 3.5 1.2 4.2 2.4C10.9 6.2 12.4 5 14.4 5c3.5 0 5 3.5 3.5 7-2.5 4.5-9.5 9-9.5 9Z"
                                    stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="text">
                            <h6>Trip Continuity, Not Just Refunds</h6>
                            <p>
                                We focus on getting your trip back on track — rebooking,
                                rerouting and fixing the plan, not just processing a
                                refund.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="home-secA">
    <div class="container">
        <div class="heading">
            <h3>Tours In <span>Bhutan</span></h3>
            <p>
                Choose from our handpicked travel experiences, designed to make
                every journey unforgettable.
            </p>
        </div>
        <div class="swiper-wrap">
            <div class="swiper thirdSilder">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card1.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card2.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card3.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>
                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card4.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card1.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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
                </div>
            </div>
            <div class="swiper-group">
                <button type="button" class="thirdSilder-prev btn-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                        <path fill="#ffff"
                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0">
                        </path>
                    </svg>
                </button>

                <button type="button" class="thirdSilder-next btn-next">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                        <path fill="#ffff"
                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="center-btn">
            <a href="javascript:void()" class="btn btn-outline-primary">View All</a>
        </div>
    </div>
</section>

<section class="home-secG home-secJ">
    <div class="container">
        <div class="heading">
            <h3>Tours In <span>Spiti Valley</span></h3>
            <p>
                Choose from our handpicked travel experiences, designed to make
                every journey unforgettable.
            </p>
        </div>
        <div class="swiper-wrap">
            <div class="swiper thirdSilder">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card1.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card2.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card3.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>
                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card4.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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

                    <div class="swiper-slide">
                        <div class="trip_card">
                            <a href="listing-detail.html" target="_blank" class="img">
                                <img loading="lazy" src="{{ asset('assets/images/home/card1.jpg') }}" alt="" />
                                <span class="save">Save INR 75,900</span>
                            </a>

                            <div class="content">
                                <div class="rating">
                                    <span>7 days & 6 nights</span>
                                    <div class="star">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        <span>4.6</span>
                                        <em>(9)</em>
                                    </div>
                                </div>

                                <h3>
                                    <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond Circle</a>
                                </h3>

                                <div class="innerSave">
                                    <s>INR 3,06,151</s>
                                    <span class="saveChip">Save INR 75,900</span>
                                </div>
                                <p class="price">INR 2,30,251</p>

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
                </div>
            </div>
            <div class="swiper-group">
                <button type="button" class="thirdSilder-prev btn-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                        <path fill="#ffff"
                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0">
                        </path>
                    </svg>
                </button>

                <button type="button" class="thirdSilder-next btn-next">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                        <path fill="#ffff"
                            d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="center-btn">
            <a href="javascript:void()" class="btn btn-outline-primary">View All</a>
        </div>
    </div>
</section>

<section class="home-secF">
    <div class="container">
        <div class="heading">
            <h3>Awards and <span>Recognition</span></h3>
        </div>

        <div class="swiper logoSlider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img loading="lazy" src="{{ asset('assets/images/home/logos/logo1.png') }}" alt="" />
                </div>

                <div class="swiper-slide">
                    <img loading="lazy" src="{{ asset('assets/images/home/logos/logo2.png') }}" alt="" />
                </div>

                <div class="swiper-slide">
                    <img loading="lazy" src="{{ asset('assets/images/home/logos/logo3.png') }}" alt="" />
                </div>

                <div class="swiper-slide">
                    <img loading="lazy" src="{{ asset('assets/images/home/logos/logo4.png') }}" alt="" />
                </div>

                <!-- Duplicate Slides -->
                <div class="swiper-slide">
                    <img loading="lazy" src="{{ asset('assets/images/home/logos/logo1.png') }}" alt="" />
                </div>

                <div class="swiper-slide">
                    <img loading="lazy" src="{{ asset('assets/images/home/logos/logo2.png') }}" alt="" />
                </div>

                <div class="swiper-slide">
                    <img loading="lazy" src="{{ asset('assets/images/home/logos/logo3.png') }}" alt="" />
                </div>

                <div class="swiper-slide">
                    <img loading="lazy" src="{{ asset('assets/images/home/logos/logo4.png') }}" alt="" />
                </div>
                <div class="swiper-slide">
                    <img loading="lazy" src="{{ asset('assets/images/home/logos/logo3.png') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
</section>
</main>

<!-- APP DOWNLOAD / NEWSLETTER BANNER -->
<section class="app-promo">
    <div class="container">
        <div class="app-promo-inner">
            <div class="app-promo-text">
                <span class="eyebrow">Stay Updated</span>
                <h3>
                    Get Trip Deals &amp; Travel Tips <br />
                    Straight To Your Inbox!
                </h3>

                <div class="form form-grid">
                    <div class="form-group">
                        <input name="txtJoinNowEmail" type="email" placeholder=" " class="form-control" required />
                        <label for="txtJoinNowEmail">Enter your email address</label>
                    </div>
                    <a href="javascript:void(0)" class="sbmt btn btn-white">
                        Join Now
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M5 12h14m0 0-6-6m6 6-6 6" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="app-promo-visual">
                <div class="phone phone--back">
                    <img loading="lazy" src="{{ asset('assets/images/home/mobile.png') }}" alt="App preview" />
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ================= MODAL ================= -->
<div class="model filter_trip">
    <div class="filter_trip__panel">
        <div class="filter_trip__head">
            <h4>Filter Your Trip</h4>
            <button type="button" class="close" aria-label="Close filters">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M5 5L19 19M5 19L19 5" stroke-linecap="round" />
                </svg>
            </button>
        </div>

        <div class="filter_trip__body">
            <!-- Trip Type Tabs (Domestic / International) -->
            <div class="filter_trip__group">
                <label>Trip Region</label>
                <div class="filter_trip__tabs">
                    <button type="button" class="m-tab-btn active" data-region="domestic">Domestic</button>
                    <button type="button" class="m-tab-btn" data-region="international">International</button>
                </div>
            </div>

            <div class="filter_trip__group">
                <label>Search</label>
                <div class="finder-search">
                    <input type="text" id="m_search" placeholder="Search by destination or trip name" />
                </div>
            </div>

            <!-- Category chips -->
            <div class="filter_trip__group">
                <label>Trip Category</label>
                <div class="filter_trip__chips" id="m_categories">
                    <button type="button" class="m-chip active" data-cat="all">All</button>
                    <button type="button" class="m-chip" data-cat="adventure">Adventure</button>
                    <button type="button" class="m-chip" data-cat="beach">Beach</button>
                    <button type="button" class="m-chip" data-cat="mountain">Mountain</button>
                    <button type="button" class="m-chip" data-cat="cultural">Cultural</button>
                    <button type="button" class="m-chip" data-cat="wildlife">Wildlife</button>
                    <button type="button" class="m-chip" data-cat="cruise">Cruise</button>
                    <button type="button" class="m-chip" data-cat="city-tour">City Tour</button>
                    <button type="button" class="m-chip" data-cat="trekking">Trekking</button>
                </div>
            </div>

            <div class="filter_trip__group">
                <label>Location</label>
                <div class="finder-item select-field">
                    <select name="location" class="js-nice-select" id="m_location">
                        <option value="">Location</option>
                        <option value="kashmir">Kashmir</option>
                        <option value="goa">Goa</option>
                        <option value="manali">Manali</option>
                        <option value="rajasthan">Rajasthan</option>
                        <option value="kerala">Kerala</option>
                        <option value="dubai">Dubai</option>
                    </select>
                </div>
            </div>

            <div class="filter_trip__group">
                <label>Trip Type</label>
                <div class="finder-item select-field">
                    <select name="trip-type" class="js-nice-select" id="m_trip_type">
                        <option value="">Trip Type</option>
                        <option value="solo">Solo</option>
                        <option value="couple">Couple</option>
                        <option value="family">Family</option>
                        <option value="group">Group</option>
                        <option value="honeymoon">Honeymoon</option>
                    </select>
                </div>
            </div>

            <div class="filter_trip__group">
                <label>Duration</label>
                <div class="finder-item select-field">
                    <select name="duration" class="js-nice-select" id="m_duration">
                        <option value="">Duration</option>
                        <option value="1-3">1-3 Days</option>
                        <option value="4-6">4-6 Days</option>
                        <option value="7-9">7-9 Days</option>
                        <option value="10plus">10+ Days</option>
                    </select>
                </div>
            </div>

            <div class="filter_trip__group">
                <label>Budget</label>
                <div class="finder-item select-field">
                    <select name="budget" class="js-nice-select" id="m_budget">
                        <option value="">Budget</option>
                        <option value="under20k">Under ₹20,000</option>
                        <option value="20-40k">₹20,000 - ₹40,000</option>
                        <option value="40-60k">₹40,000 - ₹60,000</option>
                        <option value="60kplus">₹60,000+</option>
                    </select>
                </div>
            </div>


        </div>

        <div class="filter_trip__foot">
            <button type="button" class="btn-reset" id="filterReset">Reset</button>
            <button type="button" class="btn btn-primary btn-apply" id="filterApply">Search</button>
        </div>
    </div>
</div>

<div class="offer-pop model">
    <button type="button" class="close" aria-label="Close offer form">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M5 5L19 19M5 19L19 5" stroke-linecap="round" />
        </svg>
    </button>

    <div class="offer-pop-left">
        <div class="offer-pop-form-wrap">
            <div class="sale-banner">
                <span class="sale-banner-title">Monsoon Sale is LIVE</span>
                <span class="sale-banner-timer">Ends in <strong>4d : 14h : 44m</strong></span>
            </div>

            <div class="offer-pop-heading">
                <h1>Get This Exclusive Offer</h1>
                <p>
                    Fill in your details and our travel expert will get in touch with
                    you shortly.
                </p>
            </div>

            <div class="product-strip">
                <div class="product-strip-img">
                    <img loading="lazy" src="{{ asset('assets/images/home/card2.jpg') }}"
                        alt="Journey Through Iceland Hidden Treasures" />
                </div>
                <div class="product-strip-info">
                    <p class="product-strip-title">
                        Journey Through Iceland Hidden Treasures | Group Tour…
                    </p>
                    <div class="product-strip-price">
                        <span class="price">INR 3,38,325</span>
                        <span class="price-strike">INR 4,49,865</span>
                        <span class="price-save">SAVE INR 1,11,540</span>
                    </div>
                </div>
            </div>

            <form id="offerEnquiryForm" class="enquiry-form">
                <div class="field">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6">
                        <circle cx="12" cy="8" r="3.2" />
                        <path d="M5 20c1-4 4-6 7-6s6 2 7 6" stroke-linecap="round" />
                    </svg>
                    <input type="text" name="FullName" placeholder=" " class="field-input has-icon" required />
                    <label class="field-label">Full Name<span>*</span></label>
                </div>

                <div class="field">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6">
                        <rect x="3" y="5" width="18" height="14" rx="2" />
                        <path d="M4 6.5l8 6 8-6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input type="email" name="EmailID" placeholder=" " class="field-input has-icon" required />
                    <label class="field-label">Email<span>*</span></label>
                </div>

                <div class="field-row field-row-phone">
                    <div class="code-select">
                        <select name="CountryCode">
                            <option value="+91" selected>+91</option>
                            <option value="+1">+1</option>
                            <option value="+44">+44</option>
                            <option value="+971">+971</option>
                        </select>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="field" style="margin-bottom: 0">
                        <input type="tel" name="PhoneNo" placeholder=" " class="field-input" maxlength="14"
                            inputmode="numeric" required />
                        <label class="field-label">Your Phone<span>*</span></label>
                    </div>
                </div>

                <div class="field-row">
                    <div class="field">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6">
                            <rect x="3" y="5" width="18" height="16" rx="2" />
                            <path d="M3 9h18M8 3v4M16 3v4" stroke-linecap="round" />
                        </svg>
                        <input type="text" name="dates" id="txtOfferDate" placeholder=" " class="field-input has-icon"
                            autocomplete="off" required />
                        <label class="field-label">Travel Date<span>*</span></label>
                    </div>

                    <div class="field">
                        <input type="number" name="TravellerCount" placeholder=" " class="field-input" min="1"
                            required />
                        <label class="field-label">Traveller Count<span>*</span></label>
                    </div>
                </div>

                <div class="field field-textarea">
                    <textarea name="Message" placeholder=" " class="field-input" rows="3"></textarea>
                    <label class="field-label">Message...</label>
                </div>

                <div class="captcha"></div>

                <input type="hidden" name="EnquiryType" value="Quick Enquiry" />
                <input type="hidden" name="EnquiryFor" value="Quick Enquiry" />
                <input type="hidden" name="BrochureFile" value="" />

                <button type="submit" class="btn btn-primary smt">
                    Connect with an Expert
                </button>
            </form>

            <p class="offer-pop-note">
                By submitting, you agree to our
                <a href="/terms-and-conditions" target="_blank">Terms &amp; Conditions</a>
                and <a href="/privacy-policy" target="_blank">Privacy Policy</a>.
            </p>
        </div>
    </div>

    <div class="offer-pop-right">
        <img loading="lazy" src="{{ asset('assets/images/about/misson.webp') }}" alt="Iceland tour offer" />
        <div class="offer-pop-right-overlay">
            <span class="offer-pop-badge">Limited Time Offer</span>
            <h2>Iceland Awaits You</h2>
            <p>
                Explore glaciers, waterfalls and the northern lights on a specially
                curated journey.
            </p>
        </div>
    </div>
</div>


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