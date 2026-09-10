@extends('layouts.app')

@section('title', 'Listing | Indo Tours & Adventures')
@section('meta_description', 'Indo Tours & Adventures is a leading travel company offering a wide range of tour packages, including domestic and international destinations. Explore the world with our expertly crafted itineraries and exceptional services.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/listing/listing.css') }}" />
@endpush

@section('content')

    <main>
        <section class="listing-banner">
            <div class="bg">
                <div class="swiper listSlider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img loading="lazy" src="{{ asset('assets/images/listing/banner1.jpg') }}" alt="Ladakh Landscape" />
                        </div>

                        <div class="swiper-slide">
                            <img loading="lazy" src="{{ asset('assets/images/listing/banner2.jpg') }}" alt="Ladakh Mountains" />
                        </div>
                    </div>
                </div>

                <div class="container">
                    <!-- Breadcrumb -->
                    <nav class="breadcrumb breadcrumb-light" aria-label="Breadcrumb">
                        <ul>
                            <li>
                                <a href="/">Home</a>
                            </li>

                            <li>
                                <span class="breadcrumb-separator">/</span>
                            </li>

                            <li>
                                <a href="/ladakh/" class="active">Ladakh</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="bg-wrapper">
                        <div class="content">
                            <span class="offer-tag">
                                * This Offer Valid Till 22 August
                            </span>

                            <h1>Explore Ladakh</h1>

                            <span class="divider"></span>

                            <p>
                                Discover breathtaking landscapes, mountain adventures<br />
                                and unforgettable experiences.
                            </p>

                            <div class="price-row">
                                <span>Starting at</span>
                                <del class="old-price">INR 24,583</del>
                                <h3>INR 14,750</h3>
                            </div>

                            <a href="javascript:void(0)" class="btn btn-primary">
                                Connect With An Expert
                                <i class="icon-arrow"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="listing-secB">
            <div class="container">
                <div class="heading">
                    <h3>Plan Your <span>Ladakh Trip</span></h3>
                    <p>
                        Everything you need to know before exploring the breathtaking
                        landscapes of Ladakh.
                    </p>
                </div>

                <div class="highlight-grid">
                    <div class="highlight-card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 1024 1024">
                                <path d="M0 0h1024v1024H0z" fill="none" />
                                <path fill="currentColor"
                                    d="m960 95.888l-256.224.001V32.113c0-17.68-14.32-32-32-32s-32 14.32-32 32v63.76h-256v-63.76c0-17.68-14.32-32-32-32s-32 14.32-32 32v63.76H64c-35.344 0-64 28.656-64 64v800c0 35.343 28.656 64 64 64h896c35.344 0 64-28.657 64-64v-800c0-35.329-28.656-63.985-64-63.985m0 863.985H64v-800h255.776v32.24c0 17.679 14.32 32 32 32s32-14.321 32-32v-32.224h256v32.24c0 17.68 14.32 32 32 32s32-14.32 32-32v-32.24H960zM736 511.888h64c17.664 0 32-14.336 32-32v-64c0-17.664-14.336-32-32-32h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32m0 255.984h64c17.664 0 32-14.32 32-32v-64c0-17.664-14.336-32-32-32h-64c-17.664 0-32 14.336-32 32v64c0 17.696 14.336 32 32 32m-192-128h-64c-17.664 0-32 14.336-32 32v64c0 17.68 14.336 32 32 32h64c17.664 0 32-14.32 32-32v-64c0-17.648-14.336-32-32-32m0-255.984h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32h64c17.664 0 32-14.336 32-32v-64c0-17.68-14.336-32-32-32m-256 0h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32h64c17.664 0 32-14.336 32-32v-64c0-17.68-14.336-32-32-32m0 255.984h-64c-17.664 0-32 14.336-32 32v64c0 17.68 14.336 32 32 32h64c17.664 0 32-14.32 32-32v-64c0-17.648-14.336-32-32-32" />
                            </svg>
                            <!-- Backend: Make this icon dynamic and use an image upload field.
                      If an image is provided from the backend, display it here. -->
                            <!-- <img src=""/> -->

                        </div>
                        <h6>Best Time to Visit</h6>
                        <p>May – September</p>
                    </div>

                    <div class="highlight-card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48">
                                <path d="M0 0h48v48H0z" fill="none" />
                                <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                                    <path d="M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20Z" />
                                    <path stroke-linecap="round" d="M24.008 12v12.01l8.479 8.48" />
                                </g>
                            </svg>
                            <!-- Backend: Make this icon dynamic and use an image upload field.
                      If an image is provided from the backend, display it here. -->
                            <!-- <img src=""/> -->
                        </div>
                        <h6>Ideal Duration</h6>
                        <p>6 – 10 Days</p>
                    </div>

                    <div class="highlight-card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                                <path d="M0 0h32v32H0z" fill="none" />
                                <path fill="currentColor"
                                    d="m16 5l-.313.28L4.28 16.813l-.686.688l.687.72l9.5 9.5l.72.687l.69-.687l11.53-11.407L27 16V5zm.844 2H25v8.156L14.5 25.594L6.406 17.5zM22 9a1 1 0 1 0 0 2a1 1 0 0 0 0-2" />
                            </svg>
                            <!-- Backend: Make this icon dynamic and use an image upload field.
                      If an image is provided from the backend, display it here. -->
                            <!-- <img src=""/> -->
                        </div>
                        <h6>Starting From</h6>
                        <p>₹18,999 / Person</p>
                    </div>

                    <div class="highlight-card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 48 48">
                                <path d="M0 0h48v48H0z" fill="none" />
                                <path fill="currentColor"
                                    d="M15.247 38h17.506a1.247 1.247 0 0 1 .128 2.49l-.128.006H15.247a1.247 1.247 0 0 1-.128-2.49zm-6-5h29.505a1.248 1.248 0 0 1 .128 2.49l-.128.006H9.248a1.248 1.248 0 0 1-.128-2.49zM24 7c6.337 0 9.932 4.195 10.455 9.26h.16c4.078 0 7.384 3.298 7.384 7.365s-3.306 7.365-7.384 7.365h-21.23C9.306 30.99 6 27.693 6 23.625s3.306-7.365 7.384-7.365h.16C14.07 11.161 17.662 7 24 7m0 2.495c-4.261 0-7.975 3.448-7.975 8.21c0 .755-.656 1.348-1.408 1.348h-1.42c-2.594 0-4.697 2.113-4.697 4.72c0 2.608 2.103 4.722 4.697 4.722h21.606c2.594 0 4.697-2.114 4.697-4.721s-2.103-4.722-4.697-4.722h-1.42c-.752 0-1.408-.592-1.408-1.346c0-4.824-3.714-8.21-7.975-8.21" />
                            </svg>
                            <!-- Backend: Make this icon dynamic and use an image upload field.
                      If an image is provided from the backend, display it here. -->
                            <!-- <img src=""/> -->
                        </div>
                        <h6>Weather</h6>
                        <p>5°C – 25°C</p>
                    </div>

                    <div class="highlight-card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path fill="currentColor"
                                    d="M23 18H1l7.25-9.67l2 2.67L14 6zm-11.5-5.33L14 16h5l-5-6.67zM5 16h6.5l-3.25-4.33z" />
                            </svg>
                            <!-- Backend: Make this icon dynamic and use an image upload field.
                      If an image is provided from the backend, display it here. -->
                            <!-- <img src=""/> -->
                        </div>
                        <h6>Top Experiences</h6>
                        <p>Pangong • Nubra</p>
                    </div>

                    <div class="highlight-card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5">
                                    <path
                                        d="m15.819 13.329l-5.324 5.99a2 2 0 0 1-2.99 0l-5.324-5.99a2 2 0 0 1 0-2.658l5.324-5.99a2 2 0 0 1 2.99 0l5.324 5.99a2 2 0 0 1 0 2.658" />
                                    <path
                                        d="m12 6.375l1.505-1.693a2 2 0 0 1 2.99 0l5.324 5.99a2 2 0 0 1 0 2.657l-5.324 5.99a2 2 0 0 1-2.99 0L12 17.624" />
                                </g>
                            </svg>
                            <!-- Backend: Make this icon dynamic and use an image upload field.
                      If an image is provided from the backend, display it here. -->
                            <!-- <img src=""/> -->
                        </div>
                        <h6>Best For</h6>
                        <p>Couples • Groups</p>
                    </div>
                </div>

                <div class="center-btn">
                    <a href="javascript:void()" class="btn btn-primary">Explore Ladakh Packages</a>
                    <a href="javascript:void()" class="btn btn-outline-primary">Plan Your Ladakh Trip</a>
                </div>
            </div>
        </section>

        <section class="about-destination">
            <div class="container">
                <div class="about-card">
                    <div class="about-head">
                        <span class="tag">Destination Guide</span>
                        <h3>Ladakh Tour Packages</h3>
                        <div class="meta-row">
                            <span class="meta-item">
                                <i class="icon-check"></i>
                                Curated by Our Travel Experts
                            </span>
                            <span class="meta-dot"></span>
                            <span class="meta-item">Updated as of August 2026</span>
                        </div>
                    </div>

                    <div class="about-body">
                        <p>
                            Explore the breathtaking landscapes of Ladakh with carefully
                            designed tour packages covering Leh, Nubra Valley, Pangong Lake,
                            Khardung La, Tso Moriri and other popular destinations. Whether
                            you're planning a short getaway or a longer mountain adventure,
                            our Ladakh packages are designed to make your journey
                            comfortable and memorable.
                        </p>

                        <div class="about-expand">
                            <p>
                                Ladakh is known for its dramatic Himalayan landscapes, ancient
                                monasteries, high-altitude mountain passes and beautiful
                                lakes. A typical Ladakh trip can take you from the lively
                                streets of Leh to the peaceful monasteries of Thiksey and
                                Hemis, followed by scenic drives through Nubra Valley and the
                                stunning blue waters of Pangong Lake.
                            </p>

                            <p>
                                Our Ladakh tour packages can include accommodation,
                                sightseeing, local transfers, airport or bus-station pickup,
                                selected activities and assistance throughout the journey.
                                Popular itineraries generally range from 5 to 10 days
                                depending on the destinations and experiences you want to
                                include.
                            </p>

                            <ul class="about-list">
                                <li>Sufficient time for altitude acclimatisation</li>
                                <li>Flexible routes suited to weather and road conditions</li>
                                <li>
                                    Options for couples, families, friends and solo travellers
                                </li>
                                <li>
                                    Scenic road trips, monastery visits and lakeside camping
                                </li>
                            </ul>

                            <div class="price-table-wrap">
                                <h6>Ladakh Trip Cost Breakdown</h6>
                                <div class="table-scroll">
                                    <table class="price-table">
                                        <thead>
                                            <tr>
                                                <th>Package Type</th>
                                                <th>Duration</th>
                                                <th>Price / Person</th>
                                                <th>Best For</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Budget Ladakh</td>
                                                <td>5–7 Days</td>
                                                <td>INR 18,500 – 40,000</td>
                                                <td>Students, solo travellers</td>
                                            </tr>
                                            <tr>
                                                <td>Mid-Range Ladakh</td>
                                                <td>6–8 Days</td>
                                                <td>INR 40,000 – 70,000</td>
                                                <td>Couples, families</td>
                                            </tr>
                                            <tr>
                                                <td>Luxury Ladakh</td>
                                                <td>7–10 Days</td>
                                                <td>INR 70,000 – 1,20,000+</td>
                                                <td>Honeymooners, premium</td>
                                            </tr>
                                            <tr>
                                                <td>Group Departures</td>
                                                <td>5–8 Days</td>
                                                <td>From INR 18,500</td>
                                                <td>Solo travellers, friend groups</td>
                                            </tr>
                                            <tr>
                                                <td>Bike Trips</td>
                                                <td>6–9 Days</td>
                                                <td>INR 19,000 – 55,000</td>
                                                <td>Adventure travellers</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <p>
                                Since Ladakh is a high-altitude destination, proper planning
                                is important — allowing time to acclimatise and keeping some
                                flexibility for weather and road conditions makes the trip
                                much more comfortable overall.
                            </p>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-primary" id="readMoreBtn">
                        Read More
                        <i class="icon-chevron"></i>
                    </button>
                </div>
            </div>
        </section>

        <section class="listing-secA">
            <div class="container">
                <div class="heading">
                    <h3>Ladakh <span>Tour Packagess</span></h3>
                    <p>
                        Choose from our handpicked travel experiences, designed to make
                        every journey unforgettable.
                    </p>
                </div>
                <div class="swiper-wrap">
                    <div class="swiper thirdSilder">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="trip_card2">
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

                                        <h3><a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a></h3>

                                        <div class="innerSave">
                                            <s>INR 3,06,151</s>
                                            <span class="saveChip">Save INR 75,900</span>
                                        </div>
                                        <p class="price">INR 2,30,251</p>

                                        <div class="btns">
                                            <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                                    <path
                                                        d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                                </svg>
                                            </a>
                                            <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="trip_card2">
                                    <a href="listing-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="assets/images/home/card2.jpg" alt="" />
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


                                        <h3><a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a></h3>

                                        <div class="innerSave">
                                            <s>INR 3,06,151</s>
                                            <span class="saveChip">Save INR 75,900</span>
                                        </div>
                                        <p class="price">INR 2,30,251</p>

                                        <div class="btns">
                                            <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                                    <path
                                                        d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                                </svg>
                                            </a>
                                            <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="trip_card2">
                                    <a href="listing-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="assets/images/home/card3.jpg" alt="" />
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

                                        <h3><a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a></h3>

                                        <div class="innerSave">
                                            <s>INR 3,06,151</s>
                                            <span class="saveChip">Save INR 75,900</span>
                                        </div>
                                        <p class="price">INR 2,30,251</p>

                                        <div class="btns">
                                            <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                                    <path
                                                        d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                                </svg>
                                            </a>
                                            <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="trip_card2">
                                    <a href="listing-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="assets/images/home/card4.jpg" alt="" />
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

                                        <h3><a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a></h3>
                                        <div class="innerSave">
                                            <s>INR 3,06,151</s>
                                            <span class="saveChip">Save INR 75,900</span>
                                        </div>
                                        <p class="price">INR 2,30,251</p>

                                        <div class="btns">
                                            <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                                    <path
                                                        d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                                </svg>
                                            </a>
                                            <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="trip_card2">
                                    <a href="listing-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="assets/images/home/card1.jpg" alt="" />
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

                                        <h3><a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a></h3>

                                        <div class="innerSave">
                                            <s>INR 3,06,151</s>
                                            <span class="saveChip">Save INR 75,900</span>
                                        </div>
                                        <p class="price">INR 2,30,251</p>

                                        <div class="btns">
                                            <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                                    <path
                                                        d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                                </svg>
                                            </a>
                                            <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
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

        <section class="listing-secC">
            <div class="container">
                <div class="heading">
                    <h3>Trusted Travel <span>Partner</span></h3>
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
                            Every package on this page qualifies for early-booking discounts,
                            free transfers and flexible date changes — offer ends soon.
                        </p>

                        <ul class="group-offer-banner__perks">
                            <li>Early Bird Discount up to 40% Off</li>
                            <li>Free Transfers on All Packages</li>
                            <li>Free Cancellation Up to 15 Days Before Travel</li>
                        </ul>

                        <div class="group-offer-banner__actions">
                            <a href="#package-list" class="btn btn-white">
                                View Offers
                            </a>
                            <a href="javascript:void()" data-model=".enquire-pop" class="btn btn-outline-white">
                                Get A Quote
                            </a>
                        </div>
                    </div>

                    <div class="group-offer-banner__media">

                        <div class="group-offer-banner__img group-offer-banner__img--secondary">
                            <img loading="lazy" src="assets/images/listing/banner1.jpg"
                                alt="Travellers enjoying their trip" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="listing-secE">
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
                                        <img loading="lazy" src="assets/images/home/card1.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card2.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card3.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card4.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card1.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                    <!-- <div class="center-btn">
                <a href="javascript:void()" class="btn btn-outline-primary"
                  >View All</a
                >
              </div> -->
                </div>
        </section>

        <section class="listing-secD">
            <div class="container">
                <div class="heading">
                    <h3>Loved by <span>Ladakh Travellers</span></h3>
                    <div class="swiper-group">
                        <button type="button" class="testimonial2-prev btn-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                <path fill="currentColor"
                                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                            </svg>
                        </button>
                        <button type="button" class="testimonial2-next btn-next">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                <path fill="currentColor"
                                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="grid">
                    <div class="rating_wrap">
                        <div class="ring">
                            <svg viewBox="0 0 120 120">
                                <circle class="ring-bg" cx="60" cy="60" r="52"></circle>
                                <circle class="ring-fill" cx="60" cy="60" r="52"></circle>
                            </svg>
                            <div class="ring-score">
                                <h2>4.5</h2>
                                <span>out of 5</span>
                            </div>
                        </div>

                        <div class="rating-stars">
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

                        <a href="javascript:void()" class="review-link">53,688 Ladakh Reviews</a>
                        <p class="review-sub">by customers from 70+ countries</p>
                    </div>

                    <div class="swiper_wrap">
                        <div class="swiper TestimonialSlider2">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="header">
                                            <img loading="lazy" src="assets/images/home/client1.png" alt="Sanjeev Ahuja" />
                                            <div class="name">
                                                <h6>Sanjeev Ahuja</h6>
                                                <div class="badge-star">
                                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                                        <path
                                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                    </svg>
                                                    <span>5.0</span>
                                                </div>
                                            </div>
                                            <div class="quotes">
                                                <svg width="30" height="22" viewBox="0 0 44 34" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5654 42.7691 19.7951 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                                                        fill="#F3F4F6" stroke="#E5E7EB" />
                                                </svg>
                                            </div>
                                        </div>

                                        <p class="quote">
                                            Very well organised trip by Thrillophilia. This was our
                                            3rd trip and everything was smooth from start to finish.
                                        </p>

                                        <div class="photo-strip">
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg" alt="" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg" alt="" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg" alt="" />
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="header">
                                            <img loading="lazy" src="assets/images/home/client2.png" alt="Vicky Gupta" />
                                            <div class="name">
                                                <h6>Vicky Gupta</h6>
                                                <div class="badge-star">
                                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                                        <path
                                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                    </svg>
                                                    <span>5.0</span>
                                                </div>
                                            </div>
                                            <div class="quotes">
                                                <svg width="30" height="22" viewBox="0 0 44 34" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5654 42.7691 19.7951 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                                                        fill="#F3F4F6" stroke="#E5E7EB" />
                                                </svg>
                                            </div>
                                        </div>

                                        <p class="quote">
                                            Excellent service by Thrillophilia. I strongly recommend
                                            booking their luxurious packages, worth every rupee.
                                        </p>

                                        <div class="photo-strip">
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg" alt="" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg" alt="" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg" alt="" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg" alt="" />
                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="header">
                                            <img loading="lazy" src="assets/images/home/client3.png" alt="Floyd Miles" />
                                            <div class="name">
                                                <h6>Floyd Miles</h6>
                                                <div class="badge-star">
                                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                                        <path
                                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                    </svg>
                                                    <span>4.6</span>
                                                </div>
                                            </div>
                                            <div class="quotes">
                                                <svg width="30" height="22" viewBox="0 0 44 34" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5654 42.7691 19.7951 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                                                        fill="#F3F4F6" stroke="#E5E7EB" />
                                                </svg>
                                            </div>
                                        </div>

                                        <p class="quote">
                                            Morem ipsum dolor siter amet areaeey consec taetur
                                            adipisc service ollwing ipsum dolor consectetur.
                                        </p>

                                        <div class="photo-strip">
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg" alt="" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg" alt="" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg" alt="" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="listing-secF">
            <div class="container">
                <div class="heading">
                    <h3>Ladakh <span>Best Deals</span></h3>
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
                                        <img loading="lazy" src="assets/images/home/card1.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card2.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card3.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card4.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card1.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                <!-- <div class="center-btn">
                <a href="javascript:void()" class="btn btn-outline-primary"
                  >View All</a
                >
              </div> -->
            </div>
        </section>



        <section class="listing-secG">
            <div class="container">
                <div class="grid">
                    <div class="glow"></div>

                    <div class="promo-left">
                        <span class="promo-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <g fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.594 2.319a3.26 3.26 0 0 1 2.812 0c.387.185.74.487 1.231.905l.078.066c.238.203.313.265.389.316c.193.13.41.219.637.264c.09.018.187.027.499.051l.101.008c.642.051 1.106.088 1.51.23a3.27 3.27 0 0 1 1.99 1.99c.142.404.178.868.23 1.51l.008.101c.024.312.033.41.051.499c.045.228.135.445.264.638c.051.075.113.15.316.388l.066.078c.419.49.72.844.905 1.23c.425.89.425 1.924 0 2.813c-.184.387-.486.74-.905 1.231l-.066.078a5 5 0 0 0-.316.389c-.13.193-.219.41-.264.637c-.018.09-.026.187-.051.499l-.009.101c-.05.642-.087 1.106-.23 1.51a3.26 3.26 0 0 1-1.989 1.99c-.404.142-.868.178-1.51.23l-.101.008a5 5 0 0 0-.499.051a1.8 1.8 0 0 0-.637.264a5 5 0 0 0-.39.316l-.077.066c-.49.419-.844.72-1.23.905a3.26 3.26 0 0 1-2.813 0c-.387-.184-.74-.486-1.231-.905l-.078-.066a5 5 0 0 0-.388-.316a1.8 1.8 0 0 0-.638-.264a5 5 0 0 0-.499-.051l-.101-.009c-.642-.05-1.106-.087-1.51-.23a3.26 3.26 0 0 1-1.99-1.989c-.142-.404-.179-.868-.23-1.51l-.008-.101a5 5 0 0 0-.051-.499a1.8 1.8 0 0 0-.264-.637a5 5 0 0 0-.316-.39l-.066-.077c-.418-.49-.72-.844-.905-1.23a3.26 3.26 0 0 1 0-2.813c.185-.387.487-.74.905-1.231l.066-.078a5 5 0 0 0 .316-.388c.13-.193.219-.41.264-.638c.018-.09.027-.187.051-.499l.008-.101c.051-.642.088-1.106.23-1.51a3.26 3.26 0 0 1 1.99-1.99c.404-.142.868-.179 1.51-.23l.101-.008a5 5 0 0 0 .499-.051c.228-.045.445-.135.638-.264c.075-.051.15-.113.388-.316l.078-.066c.49-.418.844-.72 1.23-.905m2.163 1.358a1.76 1.76 0 0 0-1.514 0c-.185.088-.38.247-.981.758l-.03.025c-.197.168-.34.291-.497.396c-.359.24-.761.407-1.185.49c-.185.037-.373.052-.632.073l-.038.003c-.787.063-1.036.089-1.23.157c-.5.177-.894.57-1.07 1.071c-.07.194-.095.443-.158 1.23l-.003.038c-.02.259-.036.447-.072.632c-.084.424-.25.826-.49 1.185c-.106.157-.229.3-.397.498l-.025.029c-.511.6-.67.796-.758.98a1.76 1.76 0 0 0 0 1.515c.088.185.247.38.758.981l.025.03c.168.197.291.34.396.497c.24.359.407.761.49 1.185c.037.185.052.373.073.632l.003.038c.063.787.089 1.036.157 1.23c.177.5.57.894 1.071 1.07c.194.07.443.095 1.23.158l.038.003c.259.02.447.036.632.072c.424.084.826.25 1.185.49c.157.106.3.229.498.397l.029.025c.6.511.796.67.98.758a1.76 1.76 0 0 0 1.515 0c.185-.088.38-.247.981-.758l.03-.025c.197-.168.34-.291.497-.396c.359-.24.761-.407 1.185-.49a6 6 0 0 1 .632-.073l.038-.003c.787-.063 1.036-.089 1.23-.157c.5-.177.894-.57 1.07-1.071c.07-.194.095-.444.158-1.23l.003-.038a6 6 0 0 1 .072-.633c.084-.423.25-.825.49-1.184c.106-.157.229-.3.397-.498l.025-.029c.511-.6.67-.796.758-.98a1.76 1.76 0 0 0 0-1.515c-.088-.185-.247-.38-.758-.981l-.025-.03c-.168-.197-.291-.34-.396-.497a3.3 3.3 0 0 1-.49-1.185a6 6 0 0 1-.073-.632l-.003-.038c-.063-.787-.089-1.036-.157-1.23c-.177-.5-.57-.894-1.071-1.07c-.194-.07-.444-.095-1.23-.158l-.038-.003a6 6 0 0 1-.633-.072a3.3 3.3 0 0 1-1.184-.49c-.157-.106-.3-.229-.498-.397l-.029-.025c-.6-.511-.796-.67-.98-.758"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd"
                                        d="M15.543 8.457a.753.753 0 0 1 0 1.065l-6.021 6.02a.753.753 0 0 1-1.065-1.064l6.021-6.02a.753.753 0 0 1 1.065 0"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M15.512 14.509a1.004 1.004 0 1 1-2.007 0a1.004 1.004 0 0 1 2.007 0m-5.017-5.018a1.004 1.004 0 1 1-2.007 0a1.004 1.004 0 0 1 2.007 0" />
                                </g>
                            </svg>

                            Monsoon Sale
                        </span>

                        <h3>Save up to INR 30,000 on selected Ladakh trips</h3>
                        <p>
                            Connect with our destination experts to unlock exclusive monsoon
                            discounts before the offer ends.
                        </p>

                        <a href="javascript:void()" class="btn btn-promo">
                            Know More About the Deal
                            <i class="icon-arrow"></i>
                        </a>
                    </div>

                    <div class="promo-right">
                        <span class="countdown-label">Hurry, sale ends in</span>

                        <div class="countdown" id="countdown">
                            <div class="time-block">
                                <div class="flip" data-unit="days">
                                    <span class="digit">03</span>
                                </div>
                                <span class="unit-label">Days</span>
                            </div>

                            <span class="sep">:</span>

                            <div class="time-block">
                                <div class="flip" data-unit="hours">
                                    <span class="digit">11</span>
                                </div>
                                <span class="unit-label">Hours</span>
                            </div>

                            <span class="sep">:</span>

                            <div class="time-block">
                                <div class="flip" data-unit="minutes">
                                    <span class="digit">24</span>
                                </div>
                                <span class="unit-label">Mins</span>
                            </div>

                            <span class="sep">:</span>

                            <div class="time-block">
                                <div class="flip" data-unit="seconds">
                                    <span class="digit">09</span>
                                </div>
                                <span class="unit-label">Secs</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="listing-secA">
            <div class="container">
                <div class="heading">
                    <h3>Ladakh <span>Group Tours</span></h3>
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
                                        <img loading="lazy" src="assets/images/home/card1.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card2.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card3.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card4.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card1.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                <!-- <div class="center-btn">
                <a href="javascript:void()" class="btn btn-outline-primary"
                  >View All</a
                >
              </div> -->
            </div>
        </section>

        <section class="listing-secF">
            <div class="container">
                <div class="heading">
                    <h3>Ladakh <span> Family Tours</span></h3>
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
                                        <img loading="lazy" src="assets/images/home/card1.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card2.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card3.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card4.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                                        <img loading="lazy" src="assets/images/home/card1.jpg" alt="" />
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
                                            <a href="listing-detail.html" target="_blank">Scenic Iceland With Diamond
                                                Circle</a>
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
                <!-- <div class="center-btn">
                <a href="javascript:void()" class="btn btn-outline-primary"
                  >View All</a
                >
              </div> -->
            </div>
        </section>

        <section class="listing-secI">
            <div class="container">
                <div class="heading">
                    <h3>Explore More <span>About Ladakh</span></h3>
                    <p>
                        Discover useful information and travel insights to help you plan
                        your perfect Ladakh journey.
                    </p>
                </div>

                <div class="accordion-wrapper">
                    <!-- Item 01 -->
                    <div class="accordion-item active">
                        <div class="accordion-header">
                            <span class="accordion-index">01</span>

                            <h4>Ladakh Tour Packages From Popular Indian Cities</h4>

                            <span class="accordion-icon">−</span>
                        </div>

                        <div class="accordion-content" style="display: block">
                            <p>
                                Explore popular Ladakh tour packages from major cities across
                                India. Choose from different travel options based on your
                                preferred duration, budget, and holiday experience.
                            </p>
                        </div>
                    </div>

                    <!-- Item 02 -->
                    <div class="accordion-item">
                        <div class="accordion-header">
                            <span class="accordion-index">02</span>

                            <h4>Best Selling Ladakh Itineraries</h4>

                            <span class="accordion-icon">+</span>
                        </div>

                        <div class="accordion-content">
                            <p>
                                Discover carefully planned Ladakh itineraries covering the
                                region's most popular destinations and experiences. Plan your
                                journey according to your available time and travel
                                preferences.
                            </p>
                        </div>
                    </div>

                    <!-- Item 03 -->
                    <div class="accordion-item">
                        <div class="accordion-header">
                            <span class="accordion-index">03</span>

                            <h4>All About Ladakh Trip</h4>

                            <span class="accordion-icon">+</span>
                        </div>

                        <div class="accordion-content">
                            <p>
                                Get useful information about planning a Ladakh trip, including
                                popular destinations, local experiences, accommodation
                                options, travel routes, and important things to know before
                                travelling.
                            </p>
                        </div>
                    </div>

                    <!-- Item 04 -->
                    <div class="accordion-item">
                        <div class="accordion-header">
                            <span class="accordion-index">04</span>

                            <h4>More Things To Do in Ladakh</h4>

                            <span class="accordion-icon">+</span>
                        </div>

                        <div class="accordion-content">
                            <p>
                                Ladakh offers a wide range of experiences for every type of
                                traveller. Explore scenic landscapes, adventure activities,
                                cultural attractions, road trips, and peaceful mountain
                                escapes.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="listing-secA">
            <div class="container">
                <div class="heading">
                    <h3>Explore Nearby <span>Destinations</span></h3>
                    <p>
                        Discover beautiful destinations around Ladakh and plan your
                        perfect Himalayan getaway.
                    </p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper thirdSilder">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="listing-detail.html" target="_blank" class="trip_card3">
                                    <div class="img">
                                        <img loading="lazy" src="assets/images/home/card2.jpg" alt="Leh" />
                                    </div>

                                    <span class="rating-badge">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        4.8
                                    </span>

                                    <div class="content">
                                        <p class="type">Tour Packages</p>
                                        <h3 class="place">Leh</h3>
                                        <div class="foot">
                                            <p class="price"><small>Starts at</small>INR 14,750</p>
                                            <span class="arrow-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="listing-detail.html" target="_blank" class="trip_card3">
                                    <div class="img">
                                        <img loading="lazy" src="assets/images/home/card1.jpg" alt="Nubra Valley" />
                                    </div>

                                    <span class="rating-badge">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        4.6
                                    </span>

                                    <div class="content">
                                        <p class="type">Tour Packages</p>
                                        <h3 class="place">Nubra Valley</h3>
                                        <div class="foot">
                                            <p class="price"><small>Starts at</small>INR 19,500</p>
                                            <span class="arrow-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="listing-detail.html" target="_blank" class="trip_card3">
                                    <div class="img">
                                        <img loading="lazy" src="assets/images/home/card3.jpg" alt="Pangong Lake" />
                                    </div>

                                    <span class="rating-badge">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        4.9
                                    </span>

                                    <div class="content">
                                        <p class="type">Tour Packages</p>
                                        <h3 class="place">Pangong Lake</h3>
                                        <div class="foot">
                                            <p class="price"><small>Starts at</small>INR 22,000</p>
                                            <span class="arrow-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <a href="listing-detail.html" target="_blank" class="trip_card3">
                                    <div class="img">
                                        <img loading="lazy" src="assets/images/home/card4.jpg" alt="Tso Moriri" />
                                    </div>

                                    <span class="rating-badge">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                        4.7
                                    </span>

                                    <div class="content">
                                        <p class="type">Tour Packages</p>
                                        <h3 class="place">Tso Moriri</h3>
                                        <div class="foot">
                                            <p class="price"><small>Starts at</small>INR 25,900</p>
                                            <span class="arrow-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
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
                        <button type="button" class="thirdSilder-prev btn-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                <path fill="#ffff"
                                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                            </svg>
                        </button>

                        <button type="button" class="thirdSilder-next btn-next">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                                <path fill="#ffff"
                                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="center-btn">
                    <a href="javascript:void()" class="btn btn-outline-primary">View All</a>
                </div>
            </div>
        </section>

        <section class="seo-links-sec">
            <div class="container">
                <div class="heading">
                    <h3>Explore More <span>About Ladakh</span></h3>
                    <p>
                        Discover popular Ladakh tours, itineraries, places to visit and
                        experiences to make your journey unforgettable.
                    </p>
                </div>

                <div class="seo-links-wrapper">
                    <!-- Category 01 -->
                    <div class="seo-link-block">
                        <h4>Ladakh Tour Packages From Popular Indian Cities</h4>

                        <div class="seo-link-wrap">
                            <a href="javascript:void()">Ladakh Tour Packages From Ahmedabad</a>
                            <a href="javascript:void()">Ladakh Tour Packages From Kolkata</a>
                            <a href="javascript:void()">Ladakh Tour Packages From Bangalore</a>
                            <a href="javascript:void()">Ladakh Tour Packages From Delhi</a>
                            <a href="javascript:void()">Ladakh Tour Packages From Mumbai</a>
                            <a href="javascript:void()">Ladakh Tour Packages From Nashik</a>
                            <a href="javascript:void()">Ladakh Tour Packages From Surat</a>
                            <a href="javascript:void()">Ladakh Tour Packages From Pune</a>
                            <a href="javascript:void()">Ladakh Tour Packages From Jaipur</a>
                            <a href="javascript:void()">Ladakh Tour Packages From Hyderabad</a>
                            <a href="javascript:void()">Ladakh Tour Packages From Lucknow</a>
                            <a href="javascript:void()">Ladakh Tour Packages From Vadodara</a>
                        </div>
                    </div>

                    <!-- Category 02 -->
                    <div class="seo-link-block">
                        <h4>Best Selling Ladakh Itineraries</h4>

                        <div class="seo-link-wrap">
                            <a href="javascript:void()">Ladakh Itinerary for 5 Days</a>
                            <a href="javascript:void()">Ladakh Itinerary for 6 Days</a>
                            <a href="javascript:void()">Ladakh Itinerary for 7 Days</a>
                            <a href="javascript:void()">Ladakh Itinerary for 8 Days</a>
                            <a href="javascript:void()">Ladakh Itinerary for 9 Days</a>
                            <a href="javascript:void()">Ladakh Itinerary for 10 Days</a>
                            <a href="javascript:void()">Ladakh Itinerary for 11 Days</a>
                            <a href="javascript:void()">Ladakh Itinerary for 12 Days</a>
                        </div>
                    </div>

                    <!-- Category 03 -->
                    <div class="seo-link-block">
                        <h4>All About Ladakh Trip</h4>

                        <div class="seo-link-wrap">
                            <a href="javascript:void()">Tourist Places in Ladakh</a>
                            <a href="javascript:void()">What to Do in Ladakh</a>
                            <a href="javascript:void()">Places to Stay in Ladakh</a>
                            <a href="javascript:void()">Best Time to Visit Ladakh</a>
                            <a href="javascript:void()">How to Reach Ladakh</a>
                            <a href="javascript:void()">Ladakh Travel Guide</a>
                        </div>
                    </div>

                    <!-- Category 04 -->
                    <div class="seo-link-block">
                        <h4>More Things To Do in Ladakh</h4>

                        <div class="seo-link-wrap">
                            <a href="javascript:void()">Luxury Tours in Ladakh</a>
                            <a href="javascript:void()">Group Tours in Ladakh</a>
                            <a href="javascript:void()">Biking in Ladakh</a>
                            <a href="javascript:void()">Family Tours in Ladakh</a>
                            <a href="javascript:void()">Honeymoon in Ladakh</a>
                            <a href="javascript:void()">Best Deals in Ladakh</a>
                            <a href="javascript:void()">Car Rentals in Ladakh</a>
                            <a href="javascript:void()">Difficult Treks in Ladakh</a>
                            <a href="javascript:void()">Motorbike Trips in Ladakh</a>
                            <a href="javascript:void()">Jeep Safari in Ladakh</a>
                            <a href="javascript:void()">Snow Trips in Ladakh</a>
                            <a href="javascript:void()">Camping in Ladakh</a>
                            <a href="javascript:void()">Winter Treks in Ladakh</a>
                            <a href="javascript:void()">Monsoon Treks in Ladakh</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@push('scripts')

    <script>
        const readMoreBtn = document.getElementById("readMoreBtn");
        const aboutExpand = document.querySelector(".about-expand");

        readMoreBtn.addEventListener("click", () => {
            const isOpen = aboutExpand.classList.toggle("is-open");
            readMoreBtn.classList.toggle("is-open", isOpen);
            readMoreBtn.querySelector("button").textContent = isOpen
                ? "Read Less"
                : "Read More";
        });
    </script>

@endpush