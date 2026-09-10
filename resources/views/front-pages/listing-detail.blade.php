@extends('layouts.app')

@section('title', 'Detail | Indo Tours & Adventures')
@section('meta_description', 'Indo Tours & Adventures is a leading travel company offering a wide range of tour packages, including domestic and international destinations. Explore the world with our expertly crafted itineraries and exceptional services.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/listing-detail/detail.css') }}" />
@endpush

@section('content')


    <main>
     <section class="detail-banner">
  <div class="container">
    <!-- Breadcrumb -->
    <nav class="breadcrumb breadcrumb-dark" aria-label="Breadcrumb">
      <ul>
        <li><a href="/">Home</a></li>
        <li><span class="breadcrumb-separator">/</span></li>
        <li><a href="/ladakh/">Ladakh</a></li>
        <li><span class="breadcrumb-separator">/</span></li>
        <li>
          <a href="/ladakh/tour-packages/" class="active">
            Ladakh Tour Packages
          </a>
        </li>
      </ul>
    </nav>

    <!-- ================= DESKTOP GRID (hidden below 991px) ================= -->
    <div class="grid">
      <!-- MAIN IMAGE -->
      <div class="item-img item-main">
        <img loading="lazy" src="assets/images/listing/banner1.jpg" alt="Ladakh, India" />
        <div class="image-overlay"></div>
        <div class="image-content main-content">
          <span class="image-tag">Explore Ladakh</span>
          <h1>Ladakh Tour Packages</h1>
          <p>
            Discover breathtaking mountains, peaceful monasteries,
            high-altitude lakes and unforgettable Himalayan experiences.
          </p>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="img-actions">
          <a data-fancybox="gallery1" href="assets/images/listing/banner1.jpg" type="button" class="action-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path d="M0 0h24v24H0z" fill="none" />
              <path fill="currentColor" fill-rule="evenodd"
                d="M16.375 4.5H4.625a.125.125 0 0 0-.125.125v8.254l2.859-1.54a.75.75 0 0 1 .68-.016l2.384 1.142l2.89-2.074a.75.75 0 0 1 .874 0l2.313 1.66V4.625a.125.125 0 0 0-.125-.125m.125 9.398l-2.75-1.975l-2.813 2.02a.75.75 0 0 1-.76.067l-2.444-1.17L4.5 14.583v1.792c0 .069.056.125.125.125h11.75a.125.125 0 0 0 .125-.125zM4.625 3C3.728 3 3 3.728 3 4.625v11.75C3 17.273 3.728 18 4.625 18h11.75c.898 0 1.625-.727 1.625-1.625V4.625C18 3.728 17.273 3 16.375 3zM20 8v11c0 .69-.31 1-.999 1H6v1.5h13.001c1.52 0 2.499-.982 2.499-2.5V8z"
                clip-rule="evenodd" />
            </svg>
            Gallery
          </a>

          <!-- Gallery -->
          <a data-fancybox="gallery1" href="assets/images/listing/banner2.jpg"></a>
          <a data-fancybox="gallery1" href="assets/images/listing/banner1.jpg"></a>
          <a data-fancybox="gallery1" href="assets/images/listing/banner2.jpg"></a>

          <button data-video="assets/video/trip.mp4" type="button" class="action-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path d="M0 0h24v24H0z" fill="none" />
              <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <rect width="20" height="16" x="2" y="4" rx="4" />
                <path d="m15 12l-5-3v6z" />
              </g>
            </svg>
            Video
          </button>
        </div>
      </div>

      <!-- TOP IMAGE -->
      <div class="item-img item-top">
        <img loading="lazy" src="assets/images/listing/banner2.jpg" alt="Ladakh Destinations" />
        <div class="image-overlay"></div>
        <div class="image-content">
          <span class="image-label">Explore</span>
          <h3>Destinations</h3>
        </div>
      </div>

      <!-- BOTTOM LEFT -->
      <div class="item-img item-bottom-left">
        <img loading="lazy" src="assets/images/listing/banner1.jpg" alt="Ladakh Stays" />
        <div class="image-overlay"></div>
        <div class="image-content">
          <span class="image-label">Stay</span>
          <h3>Stays</h3>
        </div>
      </div>

      <!-- BOTTOM RIGHT -->
      <div class="item-img item-bottom-right">
        <img loading="lazy" src="assets/images/listing/banner2.jpg" alt="Ladakh Activities" />
        <div class="image-overlay"></div>
        <div class="image-content">
          <span class="image-label">Experience</span>
          <h3>Activities & Sightseeing</h3>
        </div>
      </div>
    </div>

    <!-- ================= MOBILE/TABLET SWIPER (visible below 991px) ================= -->
    <div class="banner-swiper swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img loading="lazy" src="assets/images/listing/banner1.jpg" alt="Ladakh, India" />
        </div>
        <div class="swiper-slide">
          <img loading="lazy" src="assets/images/listing/banner2.jpg" alt="Ladakh Destinations" />
        </div>
        <div class="swiper-slide">
          <img loading="lazy" src="assets/images/listing/banner1.jpg" alt="Ladakh Stays" />
        </div>
        <div class="swiper-slide">
          <img loading="lazy" src="assets/images/listing/banner2.jpg" alt="Ladakh Activities" />
        </div>
      </div>

      <div class="image-overlay"></div>

      <div class="image-content main-content">
        <span class="image-tag">Explore Ladakh</span>
        <h1>Ladakh Tour Packages</h1>
        <p>
          Discover breathtaking mountains, peaceful monasteries,
          high-altitude lakes and unforgettable Himalayan experiences.
        </p>
      </div>

      <div class="swiper-pagination"></div>
    </div>

    <!-- META -->
    <div class="banner-meta">
      <span class="location">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
          <path d="M0 0h24v24H0z" fill="none" />
          <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <circle cx="12" cy="10" r="3" />
            <path d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
          </g>
        </svg>
        Ladakh, India
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
  </div>
</section>

      <section class="detail-secA">
        <div class="container">
          <div class="grid">
            <div class="detail_wrapper">
              <div class="trip_info">
               <div class="trip-head">
  <h1>Leh Ladakh Expedition</h1>
  <span class="duration-pill">6D / 5N</span>

  <div class="trip-price">
    <span class="trip-price__old">₹29,500</span>
    <span class="trip-price__now">₹22,900 <small>Per Adult</small></span>
  </div>
</div>

                <div class="route-timeline">
                  <div class="route-step">
                    <span class="dot">2</span>
                    <div class="step-text">
                      <small>Days in</small>
                      <strong>Manali</strong>
                    </div>
                  </div>

                  <div class="route-step">
                    <span class="dot">1</span>
                    <div class="step-text">
                      <small>Day in</small>
                      <strong>Solang Valley</strong>
                    </div>
                  </div>

                  <div class="route-step">
                    <span class="dot">1</span>
                    <div class="step-text">
                      <small>Day in</small>
                      <strong>Kasol</strong>
                    </div>
                  </div>

                  <div class="route-step">
                    <span class="dot">2</span>
                    <div class="step-text">
                      <small>Days in</small>
                      <strong>Manali</strong>
                    </div>
                  </div>
                </div>

                <div class="feature-row">
                  <div class="feature-pill">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="1em"
                      height="1em"
                      viewBox="0 0 24 24"
                    >
                      <path d="M0 0h24v24H0z" fill="none" />
                      <g fill="none" stroke="currentColor" stroke-width="1.5">
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M8 10h8m-9 4h1m8 0h1"
                        />
                        <path
                          d="M3 18v-6.59a2 2 0 0 1 .162-.787l2.319-5.41A2 2 0 0 1 7.319 4h9.362a2 2 0 0 1 1.838 1.212l2.32 5.41a2 2 0 0 1 .161.789V18M3 18v2.4a.6.6 0 0 0 .6.6h2.8a.6.6 0 0 0 .6-.6V18m-4 0h4m14 0v2.4a.6.6 0 0 1-.6.6h-2.8a.6.6 0 0 1-.6-.6V18m4 0h-4M7 18h10"
                        />
                      </g>
                    </svg>
                    Transfers Included
                  </div>

                  <div class="feature-pill">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="1em"
                      height="1em"
                      viewBox="0 0 24 24"
                    >
                      <path d="M0 0h24v24H0z" fill="none" />
                      <path
                        fill="currentColor"
                        d="M21 10.78V8c0-1.65-1.35-3-3-3h-4c-.77 0-1.47.3-2 .78c-.53-.48-1.23-.78-2-.78H6C4.35 5 3 6.35 3 8v2.78c-.61.55-1 1.34-1 2.22v6h2v-2h16v2h2v-6c0-.88-.39-1.67-1-2.22M14 7h4c.55 0 1 .45 1 1v2h-6V8c0-.55.45-1 1-1M5 8c0-.55.45-1 1-1h4c.55 0 1 .45 1 1v2H5zm-1 7v-2c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v2z"
                      />
                    </svg>
                    Stay Included
                  </div>

                  <div class="feature-pill">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="1em"
                      height="1em"
                      viewBox="0 0 48 48"
                    >
                      <path d="M0 0h48v48H0z" fill="none" />
                      <g fill="currentColor">
                        <path
                          d="M5 28a1 1 0 1 0 0 2h3a8 8 0 0 0 8 8h16a8 8 0 0 0 8-8h3a1 1 0 1 0 0-2z"
                        />
                        <path
                          fill-rule="evenodd"
                          d="M23.105 10.054L24 10.5l.895.447l-.002.003l-.012.025l-.05.11a9 9 0 0 0-.6 1.861c-.236 1.179-.149 2.222.476 2.847c1.375 1.375 1.288 3.332 1.024 4.653a11 11 0 0 1-.806 2.438l-.02.043l-.007.013l-.002.005l-.001.001L24 22.5l-.895-.447l.002-.003l.012-.025l.05-.11a9 9 0 0 0 .6-1.861c.236-1.179.149-2.222-.476-2.847c-1.375-1.375-1.288-3.332-1.024-4.653a11 11 0 0 1 .806-2.438l.02-.043l.007-.013l.002-.004zm-7.935 2.387l.83.56c.829.559.83.558.83.558v-.001v.001l-.013.02l-.054.085a6 6 0 0 0-.192.344a5.8 5.8 0 0 0-.45 1.128c-.24.892-.154 1.596.474 2.06c1.622 1.202 1.536 2.999 1.214 4.19a7.8 7.8 0 0 1-.605 1.528a8 8 0 0 1-.363.627l-.008.012l-.002.004l-.001.001s-.001.002-.83-.558s-.83-.559-.83-.559l.013-.019l.054-.086a7 7 0 0 0 .192-.344c.155-.298.333-.698.45-1.128c.24-.892.154-1.595-.474-2.06c-1.622-1.202-1.536-2.998-1.214-4.19c.165-.612.409-1.15.605-1.528a8 8 0 0 1 .363-.626l.007-.012l.003-.005zm17 0l.83.56c.829.559.83.558.83.558v-.001v.001l-.013.02l-.054.085a6 6 0 0 0-.192.344a5.8 5.8 0 0 0-.45 1.128c-.24.892-.154 1.596.474 2.06c1.622 1.202 1.536 2.999 1.214 4.19a7.8 7.8 0 0 1-.605 1.528a8 8 0 0 1-.362.627l-.008.012l-.003.004l-.001.001s-.001.002-.83-.558s-.83-.559-.83-.559l.013-.019l.054-.086a7 7 0 0 0 .192-.344c.155-.298.333-.698.45-1.128c.24-.892.154-1.595-.474-2.06c-1.622-1.202-1.536-2.998-1.214-4.19c.165-.612.409-1.15.605-1.528a8 8 0 0 1 .362-.626l.008-.012l.003-.005z"
                          clip-rule="evenodd"
                        />
                      </g>
                    </svg>
                    Meals Included
                  </div>

                  <div class="feature-pill">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="1em"
                      height="1em"
                      viewBox="0 0 24 24"
                    >
                      <path d="M0 0h24v24H0z" fill="none" />
                      <path
                        fill="currentColor"
                        d="M17.5 7.5H15q-.213 0-.356-.144t-.144-.357t.144-.356T15 6.5h2.5V4q0-.213.144-.356t.357-.144t.356.144T18.5 4v2.5H21q.213 0 .356.144t.144.357t-.144.356T21 7.5h-2.5V10q0 .213-.144.356t-.357.144t-.356-.144T17.5 10zm-6.5 12q1.696 0 3.08-.797t2.382-2.228q-3.477.011-5.72-2.113T8.5 9q0-.517.073-1.041t.239-1.074q-1.958.736-3.135 2.383T4.5 13q0 2.692 1.904 4.596T11 19.5m6.85-3.46q-.892 2.047-2.742 3.253Q13.257 20.5 11 20.5q-3.12 0-5.31-2.19T3.5 13q0-2.7 1.693-4.766T9.52 5.65q.165-.03.288.03q.122.062.19.172q.066.11.082.249q.015.14-.052.316q-.263.619-.395 1.265T9.5 9q0 2.708 1.896 4.604T16 15.5q.323 0 .616-.032q.294-.032.601-.082q.2-.036.344.016t.222.156q.078.103.106.226q.028.122-.039.256m-7.098-1.7"
                      />
                    </svg>
                    Sightseeing Included
                  </div>
                </div>

                <div class="section-divider"></div>

                <div class="duration-select">
                  <h6>Find Your Perfect Trip</h6>

                  <div class="duration-scroll">
                    <div class="duration-card active">
                      <div class="d-img">
                        <img  loading="lazy"
                          src="assets/images/listing/rarting-view.jpg"
                          alt="4 Days Mountain Trip"
                        />
                        <span class="d-days">4 days</span>
                      </div>
                      <p class="d-label">Starting From</p>
                      <p class="d-price">₹14,999</p>
                    </div>

                    <div class="duration-card">
                      <div class="d-img">
                        <img  loading="lazy"
                          src="assets/images/home/card4.jpg"
                          alt="5 Days Mountain Trip"
                        />
                        <span class="d-days">5 days</span>
                      </div>
                      <p class="d-label">Starting From</p>
                      <p class="d-price">₹18,500</p>
                    </div>

                    <div class="duration-card">
                      <div class="d-img">
                        <img  loading="lazy"
                          src="assets/images/home/card3.jpg"
                          alt="6 Days Mountain Trip"
                        />
                        <span class="d-days">6 days</span>
                      </div>
                      <p class="d-label">Starting From</p>
                      <p class="d-price">₹22,900</p>
                    </div>

                    <div class="duration-card">
                      <div class="d-img">
                        <img  loading="lazy"
                          src="assets/images/home/card1.jpg"
                          alt="7 Days Mountain Trip"
                        />
                        <span class="d-days">7 days</span>
                      </div>
                      <p class="d-label">Starting From</p>
                      <p class="d-price">₹26,500</p>
                    </div>

                    <div class="duration-card">
                      <div class="d-img">
                        <img  loading="lazy"
                          src="assets/images/home/card2.jpg"
                          alt="8 Days Mountain Trip"
                        />
                        <span class="d-days">8 days</span>
                      </div>
                      <p class="d-label">Starting From</p>
                      <p class="d-price">₹31,900</p>
                    </div>

                    <a href="javascript:void(0)" class="duration-more">
                      <span class="count">+3</span>
                      More
                    </a>
                  </div>
                </div>
              </div>

              <div class="direction">
                <div class="direction-head">
                  <h6>Destination Routes</h6>
                  <span class="route-count">4 Stops</span>
                </div>

                <div class="route-box">
                  <div class="route-item">
                    <span class="route-dot">01</span>
                    <span>Leh</span>
                  </div>

                  <span class="route-arrow">→</span>

                  <div class="route-item">
                    <span class="route-dot">02</span>
                    <span>Nubra Valley</span>
                  </div>

                  <span class="route-arrow">→</span>

                  <div class="route-item">
                    <span class="route-dot">03</span>
                    <span>Pangong Tso</span>
                  </div>

                  <span class="route-arrow">→</span>

                  <div class="route-item">
                    <span class="route-dot">04</span>
                    <span>Leh</span>
                  </div>
                </div>
              </div>

              <!-- ============ SECTION NAV (renamed from tab-nav, now scroll-links) ============ -->
              <div class="scroll-sections">
                <div class="trip_tabing">
                  <ul class="section-nav">
                    <li class="active" data-scroll="overview">Overview</li>
                    <li data-scroll="itinerary">Itinerary</li>
                    <li data-scroll="hotel">Stay</li>
                    <li data-scroll="include">Includes</li>
                    <li data-scroll="faqs">FAQs</li>
                    <li data-scroll="map">Map</li>
                  </ul>
                </div>
                <div class="tab-block" id="overview">
                  <h6>About This Tour</h6>
                  <p>
                    Dubai, a dazzling city of contrasts, can be overwhelming for
                    any visitor. This tour is crafted to be your perfect
                    introduction, eliminating the stress of planning and
                    navigation. We guide you seamlessly from the historic charm
                    of ancient souks to the breathtaking ambition of modern
                    skyscrapers. Experience the very best of Dubai's timeless
                    heritage and futuristic vision in one effortless journey.
                  </p>
                </div>

                <div class="tab-block">
                  <h6>Trip Highlights</h6>
                  <ul class="check-list">
                    <li>
                      <span class="check-icon">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path d="M9 12l2 2 4-4" />
                          <circle cx="12" cy="12" r="10" />
                        </svg>
                      </span>
                      Explore the stunning contrast between old Dubai and
                      futuristic skyscrapers.
                    </li>
                    <li>
                      <span class="check-icon">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path d="M9 12l2 2 4-4" />
                          <circle cx="12" cy="12" r="10" />
                        </svg>
                      </span>
                      Your expert guide shares stories of Dubai's incredible
                      transformation.
                    </li>
                    <li>
                      <span class="check-icon">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path d="M9 12l2 2 4-4" />
                          <circle cx="12" cy="12" r="10" />
                        </svg>
                      </span>
                      The perfect, stress-free introduction for any first-time
                      visitor.
                    </li>
                  </ul>
                </div>
                <!-- ============ END SECTION NAV ============ -->

                <div class="Itinerary" id="itinerary">
                  <div class="itinerary-head">
                    <h6>Itinerary</h6>
                    <label class="expand-toggle">
                      <span>Expand all</span>
                      <input type="checkbox" id="expandAll" />
                      <span class="toggle-slider"></span>
                    </label>
                  </div>

                  <div class="accordion-wrapper">
                    <div class="accordion-item active">
                      <div class="timeline-track">
                        <span class="day-marker">01</span>
                        <span class="track-line"></span>
                      </div>

                      <div class="accordion-body">
                        <div class="accordion-header">
                          <h4>
                            Day 01 : Arrival in Dubai and an Evening of Modern
                            Marvels
                          </h4>
                          <span class="accordion-icon">−</span>
                        </div>
                        <div class="accordion-content" style="display: block">
                          <p>
                            Welcome to the futuristic metropolis of Dubai! After
                            settling into your hotel, we'll dive into the city's
                            modern heart. This evening, you will ascend the
                            world's tallest building, the Burj Khalifa, for
                            breathtaking panoramic views. Afterward, we will
                            witness the spectacular Dubai Fountain show and
                            explore the immense Dubai Mall, a dazzling
                            introduction to the city's incredible ambition.
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <div class="timeline-track">
                        <span class="day-marker">02</span>
                        <span class="track-line"></span>
                      </div>

                      <div class="accordion-body">
                        <div class="accordion-header">
                          <h4>
                            Day 02 : Discovering the Historic Soul of Old Dubai
                            and the Souks
                          </h4>
                          <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content">
                          <p>
                            Explore the winding alleys of Al Fahidi Historic
                            District, cross the creek by traditional abra, and
                            browse the fragrant Spice Souk and glittering Gold
                            Souk for a glimpse of old-world Dubai.
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <div class="timeline-track">
                        <span class="day-marker">03</span>
                        <span class="track-line"></span>
                      </div>

                      <div class="accordion-body">
                        <div class="accordion-header">
                          <h4>
                            Day 03 : An Exciting Afternoon and Evening Adventure
                            in the Arabian Desert
                          </h4>
                          <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content">
                          <p>
                            Head into the golden dunes for a thrilling
                            dune-bashing safari, followed by a traditional
                            Bedouin camp experience with dinner, live
                            entertainment, and stargazing under the desert sky.
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <div class="timeline-track">
                        <span class="day-marker">04</span>
                      </div>

                      <div class="accordion-body">
                        <div class="accordion-header">
                          <h4>
                            Day 04 : Exploring the Iconic Palm Jumeirah Before
                            Your Departure
                          </h4>
                          <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content">
                          <p>
                            Spend your final morning at the man-made marvel of
                            Palm Jumeirah, with time to relax before your
                            airport transfer and departure.
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="hotel_wrapper" id="hotel">
                  <div class="hw-head">
                    <h6>Hotel Details</h6>
                  </div>

                  <div class="hw-list">
                    <!-- ITEM 1 -->
                    <div class="hw-item active">
                      <div class="hw-daytag">
                        <span class="hw-day">Day 1</span>
                        <h4>Arrival in Reykjavik | Day at Leisure</h4>
                        <span class="hw-toggle">
                          <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                          >
                            <path d="M6 9l6 6 6-6" />
                          </svg>
                        </span>
                      </div>

                      <div class="hw-content show">
                        <div class="hw-stay-label">
                          <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                          >
                            <path
                              d="M3 18v-6.6a2 2 0 0 1 .16-.79l2.32-5.4A2 2 0 0 1 7.32 4h9.36a2 2 0 0 1 1.84 1.21l2.32 5.4a2 2 0 0 1 .16.79V18M8 10h8"
                            />
                          </svg>
                          Stay At
                        </div>

                        <div class="hw-hotel-name">
                          Hotel Reykjavik Grand
                          <span class="hw-stars">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                              <path
                                d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1z"
                              />
                            </svg>
                            <svg viewBox="0 0 24 24" fill="currentColor">
                              <path
                                d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1z"
                              />
                            </svg>
                            <svg viewBox="0 0 24 24" fill="currentColor">
                              <path
                                d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1z"
                              />
                            </svg>
                            <svg viewBox="0 0 24 24" fill="currentColor">
                              <path
                                d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1z"
                              />
                            </svg>
                          </span>
                        </div>

                        <div class="hw-meta">
                          <div class="hw-meta-item">
                            <small>Check In</small>
                            <strong>2:00 PM</strong>
                          </div>
                          <span class="hw-meta-divider">3N</span>
                          <div class="hw-meta-item hw-meta-item--right">
                            <small>Check Out</small>
                            <strong>11:00 AM</strong>
                          </div>
                        </div>

                        <div class="hw-gallery">
                          <a
                            href="assets/images/listing/hotel1.avif"
                            data-fancybox="hotel1"
                            class="hw-gallery-main"
                          >
                            <img  loading="lazy"
                              src="assets/images/listing/hotel1.avif"
                              alt="Hotel Reykjavik Grand"
                            />
                            <span class="hw-rating-badge">
                              <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                  d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1z"
                                />
                              </svg>
                              4/5
                            </span>
                          </a>

                          <a
                            href="assets/images/listing/hotel1.avif"
                            data-fancybox="hotel1"
                            class="hw-thumb"
                          >
                            <img  loading="lazy"
                              src="assets/images/listing/hotel1.avif"
                              alt=""
                            />
                          </a>
                          <a
                            href="assets/images/listing/hotel2.avif"
                            data-fancybox="hotel1"
                            class="hw-thumb"
                          >
                            <img  loading="lazy"
                              src="assets/images/listing/hotel2.avif"
                              alt=""
                            />
                          </a>
                          <a
                            href="assets/images/listing/hotel3.avif"
                            data-fancybox="hotel1"
                            class="hw-thumb"
                          >
                            <img  loading="lazy"
                              src="assets/images/listing/hotel3.avif"
                              alt=""
                            />
                          </a>
                          <a
                            href="assets/images/listing/hotel1.avif"
                            data-fancybox="hotel1"
                            class="hw-thumb"
                          >
                            <img  loading="lazy"
                              src="assets/images/listing/hotel1.avif"
                              alt=""
                            />
                          </a>
                          <a
                            href="assets/images/listing/hotel2.avif"
                            data-fancybox="hotel1"
                            class="hw-thumb"
                          >
                            <img  loading="lazy"
                              src="assets/images/listing/hotel2.avif"
                              alt=""
                            />
                          </a>
                          <a
                            href="assets/images/listing/hotel1.avif"
                            data-fancybox="hotel1"
                            class="hw-thumb hw-thumb--more"
                          >
                            <img  loading="lazy"
                              src="assets/images/listing/hotel1.avif"
                              alt=""
                            />
                            <div class="hw-more-overlay">
                              <span>View all</span>
                              <strong>(14)</strong>
                            </div>
                          </a>
                        </div>

                        <div class="hw-inclusions">
                          <span class="hw-inclusions-label">Standard</span>
                          <div class="hw-inclusions-list">
                            <div class="hw-inclusion hw-inclusion--yes">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="1em"
                                height="1em"
                                viewBox="0 0 2048 2048"
                              >
                                <path d="M0 0h2048v2048H0z" fill="none" />
                                <path
                                  fill="currentColor"
                                  d="M1408 592q-26 0-45-19t-19-45q0-51 19-98t56-83l79-80q38-38 38-91q0-26 19-45t45-19t45 19t19 45q0 51-19 98t-56 83l-79 80q-38 38-38 91q0 26-19 45t-45 19m-384 0q-26 0-45-19t-19-45q0-51 19-98t56-83l79-80q38-38 38-91q0-26 19-45t45-19t45 19t19 45q0 51-19 98t-56 83l-79 80q-38 38-38 91q0 26-19 45t-45 19m832 176q40 0 75 15t61 41t41 61t15 75v384q0 40-15 75t-41 61t-61 41t-75 15h-57q-2 7-3 13t-4 12v39q0 66-25 124t-69 102t-102 69t-124 25h-384q-78 0-144-35t-110-93H334q-66 0-124-25t-102-68t-69-102t-25-125v-64h256q0-79 30-149t83-122t122-83t149-30q30 0 58 5t56 14V640h1024v128zM654 1152q-53 0-99 20t-82 55t-55 81t-20 100h370v-228q-26-13-54-20t-60-8m-320 512h441q-7-29-7-64v-64H153q10 28 28 51t41 41t52 26t60 10m463 67v1l1 2v-1zm867-131V768H896v832q0 40 15 75t41 61t61 41t75 15h384q40 0 75-15t61-41t41-61t15-75m256-256V960q0-26-19-45t-45-19h-64v512h64q26 0 45-19t19-45"
                                />
                              </svg>

                              <div>
                                <span>Breakfast</span>
                                <small>Included</small>
                              </div>
                            </div>
                            <div class="hw-inclusion hw-inclusion--no">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="1em"
                                height="1em"
                                viewBox="0 0 24 24"
                              >
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path
                                  fill="currentColor"
                                  d="M4.616 20q-.672 0-1.144-.472T3 18.385v-2.77h18v2.77q0 .67-.472 1.143q-.472.472-1.143.472zM4 16.616v1.769q0 .269.173.442t.443.173h14.769q.269 0 .442-.173t.173-.442v-1.77zm6.642-3.5q-.476.5-1.646.5t-1.64-.5t-1.352-.5t-1.358.5q-.477.5-1.646.5v-1q.88 0 1.358-.5q.476-.5 1.646-.5t1.64.5t1.352.5t1.358-.5t1.646-.5t1.646.5t1.358.5t1.333-.5t1.62-.5t1.678.5t1.365.5v1q-1.17 0-1.616-.5t-1.326-.5t-1.383.5t-1.671.5t-1.646-.5t-1.358-.5t-1.358.5M3 9.616V9q0-2.356 2.088-3.678T12 4t6.913 1.322T21 9v.616zM12 5q-3.908 0-5.87.958T4.034 8.615h15.932q-.133-1.7-2.096-2.657T12 5m0 3.616"
                                />
                              </svg>
                              <div>
                                <span>Lunch</span>
                                <small>Not Included</small>
                              </div>
                            </div>
                            <div class="hw-inclusion hw-inclusion--no">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="1em"
                                height="1em"
                                viewBox="0 0 24 24"
                              >
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path
                                  fill="currentColor"
                                  d="M8.242 13.423q-2.192 0-3.717-1.531T3 8.173q0-2 1.333-3.48T7.652 3h.112q-.32.529-.495 1.122t-.175 1.224q0 1.963 1.38 3.338t3.351 1.374q.367 0 .717-.061q.35-.06.67-.181q-.523 1.622-1.881 2.615t-3.089.992m-.006-1q.908 0 1.717-.374t1.405-1.051q-2.233-.16-3.743-1.772t-1.52-3.857q0-.211.028-.413q.029-.202.067-.414q-1.015.556-1.612 1.527t-.597 2.123q0 1.766 1.242 2.999q1.242 1.232 3.013 1.232m9.014-.961h2.789V7.73H17.25zm1.404 3.788q.588 0 .986-.4q.398-.402.398-.994v-1.394H17.25v1.404q0 .588.404.986q.403.398 1 .398M6.158 20h4.088q.485 0 .865-.296q.381-.296.495-.762l.44-1.711H4.358l.44 1.711q.114.466.494.762q.381.296.866.296M2 21v-1h2.25q-.16-.171-.268-.378t-.153-.436l-.752-2.955h10.25l-.752 2.956q-.044.229-.153.435q-.108.207-.268.378h6v-3.81q-.823-.17-1.364-.83q-.54-.66-.54-1.494V6.73h4.789v7.135q0 .834-.531 1.494t-1.354.83V20H22v1zm16.654-8.538"
                                />
                              </svg>

                              <div>
                                <span>Dinner</span>
                                <small>Not Included</small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- ITEM 2 -->
                    <div class="hw-item">
                      <div class="hw-daytag">
                        <span class="hw-day">Day 4</span>
                        <h4>Transfer to Akureyri | Day at Leisure</h4>
                        <span class="hw-toggle">
                          <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                          >
                            <path d="M6 9l6 6 6-6" />
                          </svg>
                        </span>
                      </div>

                      <div class="hw-content">
                        <div class="hw-checkout-note">
                          <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                          >
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 8v5M12 16h.01" />
                          </svg>
                          Check Out from Hotel Reykjavik Grand in Reykjavik
                        </div>

                        <div class="hw-stay-label">
                          <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
                          >
                            <path
                              d="M3 18v-6.6a2 2 0 0 1 .16-.79l2.32-5.4A2 2 0 0 1 7.32 4h9.36a2 2 0 0 1 1.84 1.21l2.32 5.4a2 2 0 0 1 .16.79V18M8 10h8"
                            />
                          </svg>
                          Stay At
                        </div>

                        <div class="hw-hotel-name">
                          Hotel Kjarnalundur, Akureyri
                          <span class="hw-stars">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                              <path
                                d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1z"
                              />
                            </svg>
                            <svg viewBox="0 0 24 24" fill="currentColor">
                              <path
                                d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1z"
                              />
                            </svg>
                            <svg viewBox="0 0 24 24" fill="currentColor">
                              <path
                                d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1z"
                              />
                            </svg>
                          </span>
                        </div>

                        <div class="hw-meta">
                          <div class="hw-meta-item">
                            <small>Check In</small>
                            <strong>5:30 PM</strong>
                          </div>
                          <span class="hw-meta-divider">3N</span>
                          <div class="hw-meta-item hw-meta-item--right">
                            <small>Check Out</small>
                            <strong>11:00 AM</strong>
                          </div>
                        </div>

                        <div class="hw-gallery hw-gallery--sm">
                          <a
                            href="assets/images/listing/hotel1.avif"
                            data-fancybox="hotel2"
                            class="hw-thumb"
                          >
                            <img  loading="lazy"
                              src="assets/images/listing/hotel1.avif"
                              alt=""
                            />
                          </a>
                          <a
                            href="assets/images/listing/hotel2.avif"
                            data-fancybox="hotel2"
                            class="hw-thumb"
                          >
                            <img  loading="lazy"
                              src="assets/images/listing/hotel2.avif"
                              alt=""
                            />
                          </a>
                          <a
                            href="assets/images/listing/hotel3.avif"
                            data-fancybox="hotel2"
                            class="hw-thumb"
                          >
                            <img  loading="lazy"
                              src="assets/images/listing/hotel3.avif"
                              alt=""
                            />
                          </a>
                          <a
                            href="assets/images/listing/hotel1.avif"
                            data-fancybox="hotel2"
                            class="hw-thumb hw-thumb--more"
                          >
                            <img  loading="lazy"
                              src="assets/images/listing/hotel1.avif"
                              alt=""
                            />
                            <div class="hw-more-overlay">
                              <span>View all</span>
                              <strong>(12)</strong>
                            </div>
                          </a>
                        </div>

                        <div class="hw-inclusions">
                          <span class="hw-inclusions-label">Standard</span>
                          <div class="hw-inclusions-list">
                            <div class="hw-inclusion hw-inclusion--yes">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="1em"
                                height="1em"
                                viewBox="0 0 2048 2048"
                              >
                                <path d="M0 0h2048v2048H0z" fill="none" />
                                <path
                                  fill="currentColor"
                                  d="M1408 592q-26 0-45-19t-19-45q0-51 19-98t56-83l79-80q38-38 38-91q0-26 19-45t45-19t45 19t19 45q0 51-19 98t-56 83l-79 80q-38 38-38 91q0 26-19 45t-45 19m-384 0q-26 0-45-19t-19-45q0-51 19-98t56-83l79-80q38-38 38-91q0-26 19-45t45-19t45 19t19 45q0 51-19 98t-56 83l-79 80q-38 38-38 91q0 26-19 45t-45 19m832 176q40 0 75 15t61 41t41 61t15 75v384q0 40-15 75t-41 61t-61 41t-75 15h-57q-2 7-3 13t-4 12v39q0 66-25 124t-69 102t-102 69t-124 25h-384q-78 0-144-35t-110-93H334q-66 0-124-25t-102-68t-69-102t-25-125v-64h256q0-79 30-149t83-122t122-83t149-30q30 0 58 5t56 14V640h1024v128zM654 1152q-53 0-99 20t-82 55t-55 81t-20 100h370v-228q-26-13-54-20t-60-8m-320 512h441q-7-29-7-64v-64H153q10 28 28 51t41 41t52 26t60 10m463 67v1l1 2v-1zm867-131V768H896v832q0 40 15 75t41 61t61 41t75 15h384q40 0 75-15t61-41t41-61t15-75m256-256V960q0-26-19-45t-45-19h-64v512h64q26 0 45-19t19-45"
                                />
                              </svg>

                              <div>
                                <span>Breakfast</span>
                                <small>Included</small>
                              </div>
                            </div>
                            <div class="hw-inclusion hw-inclusion--no">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="1em"
                                height="1em"
                                viewBox="0 0 24 24"
                              >
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path
                                  fill="currentColor"
                                  d="M4.616 20q-.672 0-1.144-.472T3 18.385v-2.77h18v2.77q0 .67-.472 1.143q-.472.472-1.143.472zM4 16.616v1.769q0 .269.173.442t.443.173h14.769q.269 0 .442-.173t.173-.442v-1.77zm6.642-3.5q-.476.5-1.646.5t-1.64-.5t-1.352-.5t-1.358.5q-.477.5-1.646.5v-1q.88 0 1.358-.5q.476-.5 1.646-.5t1.64.5t1.352.5t1.358-.5t1.646-.5t1.646.5t1.358.5t1.333-.5t1.62-.5t1.678.5t1.365.5v1q-1.17 0-1.616-.5t-1.326-.5t-1.383.5t-1.671.5t-1.646-.5t-1.358-.5t-1.358.5M3 9.616V9q0-2.356 2.088-3.678T12 4t6.913 1.322T21 9v.616zM12 5q-3.908 0-5.87.958T4.034 8.615h15.932q-.133-1.7-2.096-2.657T12 5m0 3.616"
                                />
                              </svg>

                              <div>
                                <span>Lunch</span>
                                <small>Not Included</small>
                              </div>
                            </div>
                            <div class="hw-inclusion hw-inclusion--no">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="1em"
                                height="1em"
                                viewBox="0 0 24 24"
                              >
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path
                                  fill="currentColor"
                                  d="M8.242 13.423q-2.192 0-3.717-1.531T3 8.173q0-2 1.333-3.48T7.652 3h.112q-.32.529-.495 1.122t-.175 1.224q0 1.963 1.38 3.338t3.351 1.374q.367 0 .717-.061q.35-.06.67-.181q-.523 1.622-1.881 2.615t-3.089.992m-.006-1q.908 0 1.717-.374t1.405-1.051q-2.233-.16-3.743-1.772t-1.52-3.857q0-.211.028-.413q.029-.202.067-.414q-1.015.556-1.612 1.527t-.597 2.123q0 1.766 1.242 2.999q1.242 1.232 3.013 1.232m9.014-.961h2.789V7.73H17.25zm1.404 3.788q.588 0 .986-.4q.398-.402.398-.994v-1.394H17.25v1.404q0 .588.404.986q.403.398 1 .398M6.158 20h4.088q.485 0 .865-.296q.381-.296.495-.762l.44-1.711H4.358l.44 1.711q.114.466.494.762q.381.296.866.296M2 21v-1h2.25q-.16-.171-.268-.378t-.153-.436l-.752-2.955h10.25l-.752 2.956q-.044.229-.153.435q-.108.207-.268.378h6v-3.81q-.823-.17-1.364-.83q-.54-.66-.54-1.494V6.73h4.789v7.135q0 .834-.531 1.494t-1.354.83V20H22v1zm16.654-8.538"
                                />
                              </svg>

                              <div>
                                <span>Dinner</span>
                                <small>Not Included</small>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="include_exclude" id="include">
                  <h6 class="include_exclude__title">
                    What's Included / Excluded
                  </h6>
                  <p class="include_exclude__subtitle">
                    Everything you need to know before you book — no hidden
                    surprises.
                  </p>

                  <div class="include_exclude__grid">
                    <!-- INCLUDES -->
                    <div class="ie-card ie-card--include">
                      <div class="ie-card__head">
                        <span class="ie-card__icon">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="1em"
                            height="1em"
                            viewBox="0 0 28 28"
                          >
                            <path d="M0 0h28v28H0z" fill="none" />
                            <path
                              fill="currentColor"
                              d="M6.75 3h14.5A3.75 3.75 0 0 1 25 6.75v6.45a3.75 3.75 0 0 0-1.5-.987V6.75a2.25 2.25 0 0 0-2.25-2.25h-6.5v7.635a3.74 3.74 0 0 0-1.5.82V4.5h-6.5A2.25 2.25 0 0 0 4.5 6.75v6.5h8.455c-.38.424-.664.935-.82 1.5H4.5v6.5a2.25 2.25 0 0 0 2.25 2.25h5.463c.205.578.547 1.091.988 1.5H6.75A3.75 3.75 0 0 1 3 21.25V6.75A3.75 3.75 0 0 1 6.75 3M13 15.75A2.75 2.75 0 0 1 15.75 13h6.5A2.75 2.75 0 0 1 25 15.75v6.5A2.75 2.75 0 0 1 22.25 25h-6.5A2.75 2.75 0 0 1 13 22.25z"
                            />
                          </svg>
                        </span>
                        <h3>The Cost Includes</h3>
                      </div>
                      <ul class="ie-list">
                        <li>
                          <span class="ie-list__icon ie-list__icon--yes"
                            ><i class="fas fa-check"></i></span
                          >Professional Dubai Tour Guide
                        </li>
                        <li>
                          <span class="ie-list__icon ie-list__icon--yes"
                            ><i class="fas fa-check"></i></span
                          >Air-Conditioned Tour Vehicle
                        </li>
                        <li>
                          <span class="ie-list__icon ie-list__icon--yes"
                            ><i class="fas fa-check"></i></span
                          >Traditional Abra Boat Ride
                        </li>
                        <li>
                          <span class="ie-list__icon ie-list__icon--yes"
                            ><i class="fas fa-check"></i></span
                          >Cold Mineral Water
                        </li>
                        <li>
                          <span class="ie-list__icon ie-list__icon--yes"
                            ><i class="fas fa-check"></i></span
                          >Hotel Pickup &amp; Drop-off
                        </li>
                        <li>
                          <span class="ie-list__icon ie-list__icon--yes"
                            ><i class="fas fa-check"></i></span
                          >All Entry Tickets &amp; Permits
                        </li>
                      </ul>
                    </div>

                    <!-- EXCLUDES -->
                    <div class="ie-card ie-card--exclude">
                      <div class="ie-card__head">
                        <span class="ie-card__icon">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="1em"
                            height="1em"
                            viewBox="0 0 16 16"
                          >
                            <path d="M0 0h16v16H0z" fill="none" />
                            <path
                              fill="currentColor"
                              d="M14.682 8.318a4.5 4.5 0 1 0-6.364 6.363a4.5 4.5 0 0 0 6.364-6.362zm-.328 3.536A.5.5 0 0 1 14 12H9a.5.5 0 1 1 0-1h5a.5.5 0 0 1 .354.854m-9.259-.666c.328 0 .637.089.905.243V12.5h-.276a.82.82 0 0 0-.779-.296a1 1 0 0 0-.13.035l-1.587.565a.42.42 0 0 1-.446-.112a7 7 0 0 1-1.473-2.536a.41.41 0 0 1 .126-.441l1.286-1.087a.82.82 0 0 0 0-1.256L1.435 6.285a.41.41 0 0 1-.126-.441a7 7 0 0 1 1.473-2.536a.42.42 0 0 1 .446-.112l1.587.565a.827.827 0 0 0 1.092-.628l.302-1.652a.41.41 0 0 1 .321-.329a7.1 7.1 0 0 1 2.939 0a.41.41 0 0 1 .321.329l.303 1.652a.826.826 0 0 0 1.092.627l1.587-.565a.42.42 0 0 1 .446.112a7 7 0 0 1 1.472 2.536a.41.41 0 0 1-.126.441l-.467.395a5.4 5.4 0 0 0-1.042-.43l.551-.466a6 6 0 0 0-.879-1.511l-1.207.43a2 2 0 0 1-.615.106a1.825 1.825 0 0 1-1.796-1.496L8.88 2.061a6.2 6.2 0 0 0-1.761.001L6.89 3.313a1.83 1.83 0 0 1-2.411 1.39l-1.207-.43q-.553.692-.879 1.511l.974.823q.113.097.21.21c.317.372.47.844.43 1.33a1.8 1.8 0 0 1-.64 1.243l-.974.823q.326.819.879 1.511l1.207-.43a1.9 1.9 0 0 1 .616-.106m1.962-2.907a5.5 5.5 0 0 0-.581 1a1.98 1.98 0 0 1-.477-1.282a2 2 0 0 1 2-2c.491 0 .935.184 1.282.477a5.6 5.6 0 0 0-.838.451c-.058.039-.108.088-.165.129c-.09-.027-.18-.057-.28-.057a1 1 0 0 0-1 1c0 .1.03.191.057.283z"
                            />
                          </svg>
                        </span>
                        <h3>The Cost Excludes</h3>
                      </div>
                      <ul class="ie-list">
                        <li>
                          <span class="ie-list__icon ie-list__icon--no"
                            ><i class="fas fa-times"></i></span
                          >Personal Travel Insurance
                        </li>
                        <li>
                          <span class="ie-list__icon ie-list__icon--no"
                            ><i class="fas fa-times"></i></span
                          >Lunch &amp; Additional Meals
                        </li>
                        <li>
                          <span class="ie-list__icon ie-list__icon--no"
                            ><i class="fas fa-times"></i></span
                          >Gratuities / Tips for Guide
                        </li>
                        <li>
                          <span class="ie-list__icon ie-list__icon--no"
                            ><i class="fas fa-times"></i></span
                          >Optional Activities &amp; Upgrades
                        </li>
                        <li>
                          <span class="ie-list__icon ie-list__icon--no"
                            ><i class="fas fa-times"></i></span
                          >Souvenirs &amp; Personal Expenses
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="map" id="map">
                  <div class="heading">
                    <h6>Map</h6>
                  </div>
                  <div class="map_wrap">
                    <iframe
                      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.0830313310485!2d77.36992837511725!3d28.627273475667696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce5a035689a39%3A0x3d9564cd104c4b57!2sWeb%20Mingo%20IT%20Solutions!5e0!3m2!1sen!2sin!4v1786444341738!5m2!1sen!2sin"
                      width="100%"
                      height="450"
                      style="border: 0"
                      allowfullscreen=""
                      loading="lazy"
                      referrerpolicy="strict-origin-when-cross-origin"
                    ></iframe>
                  </div>
                </div>
<div class="policy">
    <div class="policy-more">
        <div class="policy-more__header">
            <h3>More On Ladakh Tourism</h3>
        </div>

        <div class="policy-more__links">
            <a href="#">Ladakh Tour Packages</a>
            <span class="divider">|</span>
            <a href="#">Things to do in Ladakh</a>
            <span class="divider">|</span>
            <a href="#">Places to visit in Ladakh</a>
            <span class="divider">|</span>
            <a href="#">Best Time to Visit Ladakh</a>
            <span class="divider">|</span>
            <a href="#">Ladakh Travel Guide</a>
        </div>
    </div>

    <div class="accordion-wrapper">

        <div class="accordion-item">
            <div class="accordion-header">
                <h3>Confirmation Policy</h3>
                <span class="accordion-icon">+</span>
            </div>

            <div class="accordion-content">
                <div class="accordion-content__inner">
                    <p>Payment can be done in parts.</p>
                    <p>After making your first payment, you will receive an email confirmation with your booking details.</p>
                    <p>Once you make the 100% payment for your booking, you will receive the final booking voucher containing all the information about your trip.</p>
                    <p>Customers are advised to verify all booking details mentioned in the confirmation email.</p>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <div class="accordion-header">
                <h3>Refund Policy</h3>
                <span class="accordion-icon">+</span>
            </div>

            <div class="accordion-content">
                <div class="accordion-content__inner">
                    <ul>
                        <li>The applicable refund amount will be processed within 7–10 business days.</li>
                        <li>Refunds will be processed to the original payment method wherever applicable.</li>
                        <li>Processing time may vary depending on the customer's bank or payment provider.</li>
                        <li>Any applicable cancellation charges will be deducted before processing the refund.</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <div class="accordion-header">
                <h3>Cancellation Policy</h3>
                <span class="accordion-icon">+</span>
            </div>

            <div class="accordion-content">
                <div class="accordion-content__inner">
                    <ul>
                        <li>If cancellation is made 30 days or more before the date of travel, 25% of the total tour cost will be charged as cancellation fees.</li>
                        <li>If cancellation is made 15 to 30 days before the date of travel, 50% of the total tour cost will be charged as cancellation fees.</li>
                        <li>If cancellation is made 0 to 15 days before the date of travel, 100% of the total tour cost will be charged as cancellation fees.</li>
                        <li>Cancellation requests must be submitted through the official booking channel.</li>
                        <li>In case of unforeseen weather conditions, government restrictions, road closures, union issues, or other circumstances beyond human control, certain activities may be cancelled.</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <div class="accordion-header">
                <h3>Payment Policy</h3>
                <span class="accordion-icon">+</span>
            </div>

            <div class="accordion-content">
                <div class="accordion-content__inner">
                    <ul>
                        <li>A minimum advance payment may be required to confirm your booking.</li>
                        <li>100% of the total tour cost should be paid at least 30 days before the date of travel.</li>
                        <li>Bookings made within 30 days of travel may require full payment at the time of confirmation.</li>
                        <li>All payments must be made through the approved payment methods.</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <div class="accordion-header">
                <h3>Booking Policy</h3>
                <span class="accordion-icon">+</span>
            </div>

            <div class="accordion-content">
                <div class="accordion-content__inner">
                    <p>All bookings are subject to availability and confirmation.</p>
                    <p>Customers must provide accurate contact and traveller information while making a booking.</p>
                    <p>Any changes to the booking after confirmation may be subject to additional charges.</p>

                    <ul>
                        <li>Valid identification documents may be required.</li>
                        <li>Hotel and activity availability is subject to confirmation.</li>
                        <li>Special requests are subject to availability.</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <div class="accordion-header">
                <h3>Travel Documents</h3>
                <span class="accordion-icon">+</span>
            </div>

            <div class="accordion-content">
                <div class="accordion-content__inner">
                    <p>Travellers are responsible for carrying all necessary documents during the trip.</p>

                    <ul>
                        <li>Valid government-issued identification.</li>
                        <li>Required permits for restricted areas.</li>
                        <li>Hotel and booking vouchers.</li>
                        <li>Any additional documents required by local authorities.</li>
                    </ul>

                    <p>Travellers should keep both physical and digital copies of important documents.</p>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <div class="accordion-header">
                <h3>Hotel Policy</h3>
                <span class="accordion-icon">+</span>
            </div>

            <div class="accordion-content">
                <div class="accordion-content__inner">
                    <p>Hotel check-in and check-out timings are subject to the property's standard policies.</p>

                    <ul>
                        <li>Early check-in is subject to availability.</li>
                        <li>Late check-out may incur additional charges.</li>
                        <li>Room upgrades are subject to availability and additional charges.</li>
                        <li>Hotel preferences cannot always be guaranteed.</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <div class="accordion-header">
                <h3>Travel & Weather Policy</h3>
                <span class="accordion-icon">+</span>
            </div>

            <div class="accordion-content">
                <div class="accordion-content__inner">
                    <p>Ladakh is a high-altitude destination and weather conditions can change quickly.</p>

                    <p>Road conditions, snowfall, landslides, heavy rainfall, or other natural events may affect the planned itinerary.</p>

                    <ul>
                        <li>Routes may be changed for safety reasons.</li>
                        <li>Activities may be rescheduled depending on weather conditions.</li>
                        <li>Alternative arrangements may be provided whenever possible.</li>
                        <li>Additional costs caused by unforeseen circumstances may apply.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
              </div>
            </div>

            <div class="quote-card">
              <div class="quote-card__accent"></div>

              <div class="quote-card__head">
                <h3 class="quote-card__title">Start Planning Your Journey</h3>
                <div class="quote-card__price">
                  <span class="quote-card__now">₹22,900</span>
                  <span class="quote-card__old">₹29,500</span>
                  <span class="quote-card__save">Save ₹6,600</span>
                </div>
              </div>

              <form id="enquiryForm">
                <div class="field">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="1em"
                    height="1em"
                    viewBox="0 0 24 24"
                  >
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path
                      fill="#191a19"
                      d="M12 4.75a2.25 2.25 0 1 0 0 4.5a2.25 2.25 0 0 0 0-4.5M8.25 7a3.75 3.75 0 1 1 7.5 0a3.75 3.75 0 0 1-7.5 0m1.064 5.819c.132.098.302.213.505.327c.513.29 1.265.59 2.18.59s1.668-.3 2.181-.59c.203-.114.373-.229.505-.327q.282.075.559.166l.96.315c.72.237 1.264.812 1.458 1.523l.397 2.864c.075.544-.21.939-.606 1.033c-1.047.25-2.812.53-5.453.53s-4.407-.28-5.454-.53c-.395-.094-.68-.489-.606-1.033l.397-2.864A2.23 2.23 0 0 1 7.796 13.3l.96-.315q.276-.09.558-.166m.71-1.355l-.291-.287l-.402.092q-.526.12-1.044.291l-.96.315a3.72 3.72 0 0 0-2.454 2.616l-.01.04l-.408 2.95c-.161 1.164.462 2.393 1.744 2.698c1.17.279 3.052.571 5.8.571c2.749 0 4.631-.292 5.801-.57c1.282-.306 1.906-1.535 1.745-2.698l-.409-2.95l-.01-.04a3.72 3.72 0 0 0-2.455-2.617l-.959-.315q-.517-.17-1.044-.29l-.402-.093l-.29.286l-.001.001a2 2 0 0 1-.12.101a3 3 0 0 1-.41.274a2.96 2.96 0 0 1-1.445.397a2.96 2.96 0 0 1-1.445-.397a3.2 3.2 0 0 1-.53-.375"
                    />
                  </svg>

                  <input
                    type="text"
                    name="full_name"
                    placeholder=" "
                    class="field__input has-icon"
                    required
                  />
                  <label class="field__label">Full Name<span>*</span></label>
                </div>

                <div class="field">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="1em"
                    height="1em"
                    viewBox="0 0 24 24"
                  >
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path
                      fill="#191a19"
                      d="M19.25 4H4.75A2.755 2.755 0 0 0 2 6.75v10.5A2.755 2.755 0 0 0 4.75 20h14.5A2.755 2.755 0 0 0 22 17.25V6.75A2.755 2.755 0 0 0 19.25 4M4.75 5.5h14.5c.69 0 1.25.56 1.25 1.25v.975l-8.5 4.91l-8.5-4.91V6.75c0-.69.56-1.25 1.25-1.25m14.5 13H4.75c-.69 0-1.25-.56-1.25-1.25V9.46l8.5 4.91l8.5-4.91v7.79c0 .69-.56 1.25-1.25 1.25"
                    />
                  </svg>

                  <input
                    type="email"
                    name="email"
                    placeholder=" "
                    class="field__input has-icon"
                    required
                  />
                  <label class="field__label">Email<span>*</span></label>
                </div>

                <div class="field-row field-row--phone">
                  <div class="code-select">
                    +91 <i class="fas fa-chevron-down"></i>
                  </div>
                  <div class="field" style="margin-bottom: 0">
                    <input
                      type="tel"
                      name="phone"
                      placeholder=" "
                      class="field__input"
                      required
                    />
                    <label class="field__label">Phone<span>*</span></label>
                  </div>
                </div>

                <div class="field-row">
                  <div class="field" style="margin-bottom: 0">
                    <input
                      type="text"
                      name="dates"
                      placeholder=" "
                      class="field__input"
                      required
                    />
                    <label class="field__label"
                      >Travel Date<span>*</span></label
                    >
                  </div>
                  <div class="field" style="margin-bottom: 0">
                    <input
                      type="number"
                      min="1"
                      name="traveller_count"
                      placeholder=" "
                      class="field__input"
                      required
                    />
                    <label class="field__label">Travellers<span>*</span></label>
                  </div>
                </div>

                <div class="field field--textarea">
                  <textarea
                    name="message"
                    placeholder=" "
                    class="field__input"
                    rows="3"
                  ></textarea>
                  <label class="field__label">Message</label>
                </div>

                <button type="submit" class="btn btn-primary smt">
                  Send Enquiry
                </button>
              </form>
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
                  <path d="M0 0h24v24H0z" fill="none"/>
                  <path fill="currentColor" d="M12 2l1.6 4.8L18 5l-1.8 4.4L21 12l-4.8 1.6L18 19l-4.4-1.8L12 22l-1.6-4.8L6 19l1.8-4.4L3 12l4.8-1.6L6 5l4.4 1.8z"/>
                </svg>
                Limited-Time Offer
              </span>

              <h3>Planning a Ladakh Trip? Save Up to 40% on Early Bookings</h3>

              <p>
                Handpicked Ladakh itineraries with free transfers and flexible
                dates — book before the offer ends.
              </p>

              <div class="group-offer-banner__actions">
                <a href="listing.html" class="btn btn-white">
                  Explore Packages
                </a>
                  <a href="javascript:void()" data-model=".enquire-pop" class="btn btn-outline-white">
                  Get A Quote
                </a>
              </div>
            </div>

            <div class="group-offer-banner__media">
              <div class="group-offer-banner__img group-offer-banner__img--secondary">
                <img loading="lazy" src="assets/images/blog/kashmir.jpg" alt="Ladakh mountain landscape" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="listing-secG">
        <div class="container">
          <div class="grid">
            <div class="glow"></div>

            <div class="promo-left">
              <span class="promo-badge">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                >
                  <path d="M0 0h24v24H0z" fill="none" />
                  <g fill="currentColor">
                    <path
                      fill-rule="evenodd"
                      d="M10.594 2.319a3.26 3.26 0 0 1 2.812 0c.387.185.74.487 1.231.905l.078.066c.238.203.313.265.389.316c.193.13.41.219.637.264c.09.018.187.027.499.051l.101.008c.642.051 1.106.088 1.51.23a3.27 3.27 0 0 1 1.99 1.99c.142.404.178.868.23 1.51l.008.101c.024.312.033.41.051.499c.045.228.135.445.264.638c.051.075.113.15.316.388l.066.078c.419.49.72.844.905 1.23c.425.89.425 1.924 0 2.813c-.184.387-.486.74-.905 1.231l-.066.078a5 5 0 0 0-.316.389c-.13.193-.219.41-.264.637c-.018.09-.026.187-.051.499l-.009.101c-.05.642-.087 1.106-.23 1.51a3.26 3.26 0 0 1-1.989 1.99c-.404.142-.868.178-1.51.23l-.101.008a5 5 0 0 0-.499.051a1.8 1.8 0 0 0-.637.264a5 5 0 0 0-.39.316l-.077.066c-.49.419-.844.72-1.23.905a3.26 3.26 0 0 1-2.813 0c-.387-.184-.74-.486-1.231-.905l-.078-.066a5 5 0 0 0-.388-.316a1.8 1.8 0 0 0-.638-.264a5 5 0 0 0-.499-.051l-.101-.009c-.642-.05-1.106-.087-1.51-.23a3.26 3.26 0 0 1-1.99-1.989c-.142-.404-.179-.868-.23-1.51l-.008-.101a5 5 0 0 0-.051-.499a1.8 1.8 0 0 0-.264-.637a5 5 0 0 0-.316-.39l-.066-.077c-.418-.49-.72-.844-.905-1.23a3.26 3.26 0 0 1 0-2.813c.185-.387.487-.74.905-1.231l.066-.078a5 5 0 0 0 .316-.388c.13-.193.219-.41.264-.638c.018-.09.027-.187.051-.499l.008-.101c.051-.642.088-1.106.23-1.51a3.26 3.26 0 0 1 1.99-1.99c.404-.142.868-.179 1.51-.23l.101-.008a5 5 0 0 0 .499-.051c.228-.045.445-.135.638-.264c.075-.051.15-.113.388-.316l.078-.066c.49-.418.844-.72 1.23-.905m2.163 1.358a1.76 1.76 0 0 0-1.514 0c-.185.088-.38.247-.981.758l-.03.025c-.197.168-.34.291-.497.396c-.359.24-.761.407-1.185.49c-.185.037-.373.052-.632.073l-.038.003c-.787.063-1.036.089-1.23.157c-.5.177-.894.57-1.07 1.071c-.07.194-.095.443-.158 1.23l-.003.038c-.02.259-.036.447-.072.632c-.084.424-.25.826-.49 1.185c-.106.157-.229.3-.397.498l-.025.029c-.511.6-.67.796-.758.98a1.76 1.76 0 0 0 0 1.515c.088.185.247.38.758.981l.025.03c.168.197.291.34.396.497c.24.359.407.761.49 1.185c.037.185.052.373.073.632l.003.038c.063.787.089 1.036.157 1.23c.177.5.57.894 1.071 1.07c.194.07.443.095 1.23.158l.038.003c.259.02.447.036.632.072c.424.084.826.25 1.185.49c.157.106.3.229.498.397l.029.025c.6.511.796.67.98.758a1.76 1.76 0 0 0 1.515 0c.185-.088.38-.247.981-.758l.03-.025c.197-.168.34-.291.497-.396c.359-.24.761-.407 1.185-.49a6 6 0 0 1 .632-.073l.038-.003c.787-.063 1.036-.089 1.23-.157c.5-.177.894-.57 1.07-1.071c.07-.194.095-.444.158-1.23l.003-.038a6 6 0 0 1 .072-.633c.084-.423.25-.825.49-1.184c.106-.157.229-.3.397-.498l.025-.029c.511-.6.67-.796.758-.98a1.76 1.76 0 0 0 0-1.515c-.088-.185-.247-.38-.758-.981l-.025-.03c-.168-.197-.291-.34-.396-.497a3.3 3.3 0 0 1-.49-1.185a6 6 0 0 1-.073-.632l-.003-.038c-.063-.787-.089-1.036-.157-1.23c-.177-.5-.57-.894-1.071-1.07c-.194-.07-.444-.095-1.23-.158l-.038-.003a6 6 0 0 1-.633-.072a3.3 3.3 0 0 1-1.184-.49c-.157-.106-.3-.229-.498-.397l-.029-.025c-.6-.511-.796-.67-.98-.758"
                      clip-rule="evenodd"
                    />
                    <path
                      fill-rule="evenodd"
                      d="M15.543 8.457a.753.753 0 0 1 0 1.065l-6.021 6.02a.753.753 0 0 1-1.065-1.064l6.021-6.02a.753.753 0 0 1 1.065 0"
                      clip-rule="evenodd"
                    />
                    <path
                      d="M15.512 14.509a1.004 1.004 0 1 1-2.007 0a1.004 1.004 0 0 1 2.007 0m-5.017-5.018a1.004 1.004 0 1 1-2.007 0a1.004 1.004 0 0 1 2.007 0"
                    />
                  </g>
                </svg>

                Monsoon Sale
              </span>

              <h3>Save up to INR 30,000 on selected Ladakh trips</h3>
              <p>
                Connect with our destination experts to unlock exclusive monsoon
                discounts before the offer ends.
              </p>

              <a href="#" class="btn btn-promo">
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

      <section class="detail-secF">
        <div class="heading">
          <h3>Traveler <span>Reviews</span></h3>
          <a
            href="javascript:void()"
            class="btn btn-secondary"
            data-model=".review_pop"
          >
            Write a Review
          </a>
        </div>

        <div class="grid">
          <!-- Rating Summary -->
          <div class="rating-wrapper">
            <h2>4.8</h2>

            <div class="stars">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                ></path>
              </svg>
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                ></path>
              </svg>
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                ></path>
              </svg>
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                ></path>
              </svg>
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                ></path>
              </svg>
            </div>

            <p class="total-reviews">24 Reviews</p>

            <div class="rating-bars">
              <div class="bar-row">
                <span class="label">5</span>
                <div class="bar-track">
                  <div class="bar-fill" style="width: 85%"></div>
                </div>
                <span class="count">20</span>
              </div>

              <div class="bar-row">
                <span class="label">4</span>
                <div class="bar-track">
                  <div class="bar-fill" style="width: 15%"></div>
                </div>
                <span class="count">4</span>
              </div>

              <div class="bar-row">
                <span class="label">3</span>
                <div class="bar-track">
                  <div class="bar-fill" style="width: 0%"></div>
                </div>
                <span class="count">0</span>
              </div>

              <div class="bar-row">
                <span class="label">2</span>
                <div class="bar-track">
                  <div class="bar-fill" style="width: 0%"></div>
                </div>
                <span class="count">0</span>
              </div>

              <div class="bar-row">
                <span class="label">1</span>
                <div class="bar-track">
                  <div class="bar-fill" style="width: 0%"></div>
                </div>
                <span class="count">0</span>
              </div>
            </div>
          </div>

          <!-- Review Swiper -->
          <div class="swiper-wrap">
            <div class="swiper reviewSlider">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="card">
                    <div class="header">
                      <img  loading="lazy"
                        src="assets/images/home/client1.png"
                        alt="Floyd Miles"
                      />
                      <div class="name">
                        <h6>Floyd Miles</h6>
                        <p>CEO, Traveller</p>
                      </div>
                      <div class="quotes">
                        <svg
                          width="34"
                          height="26"
                          viewBox="0 0 44 34"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5654 42.7691 19.7951 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                            fill="white"
                            stroke="#D1D1D1"
                          />
                        </svg>
                      </div>
                    </div>

                    <p class="quote">
                      “ Morem ipsum dolor siter amet areaeey consec taetur
                      adipisc service ollwing ipsum dolor consectetur.”
                    </p>

                    <div class="stars">
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="card">
                    <div class="header">
                      <img  loading="lazy"
                        src="assets/images/home/client2.png"
                        alt="Floyd Miles"
                      />
                      <div class="name">
                        <h6>Floyd Miles</h6>
                        <p>CEO, Traveller</p>
                      </div>
                      <div class="quotes">
                        <svg
                          width="34"
                          height="26"
                          viewBox="0 0 44 34"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5654 42.7691 19.7951 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                            fill="white"
                            stroke="#D1D1D1"
                          />
                        </svg>
                      </div>
                    </div>

                    <p class="quote">
                      “ Morem ipsum dolor siter amet areaeey consec taetur
                      adipisc service ollwing ipsum dolor consectetur.”
                    </p>

                    <div class="stars">
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="card">
                    <div class="header">
                      <img  loading="lazy"
                        src="assets/images/home/client3.png"
                        alt="Floyd Miles"
                      />
                      <div class="name">
                        <h6>Floyd Miles</h6>
                        <p>CEO, Traveller</p>
                      </div>
                      <div class="quotes">
                        <svg
                          width="34"
                          height="26"
                          viewBox="0 0 44 34"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5654 42.7691 19.7951 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                            fill="white"
                            stroke="#D1D1D1"
                          />
                        </svg>
                      </div>
                    </div>

                    <p class="quote">
                      “ Morem ipsum dolor siter amet areaeey consec taetur
                      adipisc service ollwing ipsum dolor consectetur.”
                    </p>

                    <div class="stars">
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="card">
                    <div class="header">
                      <img  loading="lazy"
                        src="assets/images/home/client2.png"
                        alt="Floyd Miles"
                      />
                      <div class="name">
                        <h6>Floyd Miles</h6>
                        <p>CEO, Traveller</p>
                      </div>
                      <div class="quotes">
                        <svg
                          width="34"
                          height="26"
                          viewBox="0 0 44 34"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5654 42.7691 19.7951 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                            fill="white"
                            stroke="#D1D1D1"
                          />
                        </svg>
                      </div>
                    </div>

                    <p class="quote">
                      “ Morem ipsum dolor siter amet areaeey consec taetur
                      adipisc service ollwing ipsum dolor consectetur.”
                    </p>

                    <div class="stars">
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
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
                <button
                  type="button"
                  class="review-prev"
                  aria-label="Previous review"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1024 1024"
                  >
                    <path
                      fill="#ffff"
                      d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0"
                    />
                  </svg>
                </button>

                <button
                  type="button"
                  class="review-next"
                  aria-label="Next review"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 1024 1024"
                  >
                    <path
                      fill="#ffff"
                      d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0"
                    />
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="listing-secA">
        <div class="container">
          <div class="heading">
            <h3>More Trips to <span>Explore</span></h3>
            <p>
              Discover more exciting journeys and handpicked experiences for
              your next adventure.
            </p>
          </div>

          <div class="swiper-wrap">
            <div class="swiper thirdSilder">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="listing-detail.html" target="_blank" class="trip_card3">
                    <div class="img">
                      <img  loading="lazy" src="assets/images/home/card2.jpg" alt="Leh" />
                    </div>

                    <span class="rating-badge">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                      >
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      4.8
                    </span>

                    <div class="content">
                      <p class="type">Tour Packages</p>
                      <h3 class="place">Leh</h3>
                      <div class="foot">
                        <p class="price"><small>Starts at</small>INR 14,750</p>
                        <span class="arrow-btn">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                          >
                            <path d="M5 12h14M13 6l6 6-6 6" />
                          </svg>
                        </span>
                      </div>
                    </div>
                  </div>
                </a>

                <div class="swiper-slide">
                  <a href="listing-detail.html" target="_blank" class="trip_card3">
                    <div class="img">
                      <img  loading="lazy"
                        src="assets/images/home/card1.jpg"
                        alt="Nubra Valley"
                      />
                    </div>

                    <span class="rating-badge">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                      >
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      4.6
                    </span>

                    <div class="content">
                      <p class="type">Tour Packages</p>
                      <h3 class="place">Nubra Valley</h3>
                      <div class="foot">
                        <p class="price"><small>Starts at</small>INR 19,500</p>
                        <span class="arrow-btn">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                          >
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
                      <img  loading="lazy"
                        src="assets/images/home/card3.jpg"
                        alt="Pangong Lake"
                      />
                    </div>

                    <span class="rating-badge">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                      >
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      4.9
                    </span>

                    <div class="content">
                      <p class="type">Tour Packages</p>
                      <h3 class="place">Pangong Lake</h3>
                      <div class="foot">
                        <p class="price"><small>Starts at</small>INR 22,000</p>
                        <span class="arrow-btn">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                          >
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
                      <img  loading="lazy"
                        src="assets/images/home/card4.jpg"
                        alt="Tso Moriri"
                      />
                    </div>

                    <span class="rating-badge">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                      >
                        <path
                          d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                        />
                      </svg>
                      4.7
                    </span>

                    <div class="content">
                      <p class="type">Tour Packages</p>
                      <h3 class="place">Tso Moriri</h3>
                      <div class="foot">
                        <p class="price"><small>Starts at</small>INR 25,900</p>
                        <span class="arrow-btn">
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                          >
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
                  <path
                    fill="#ffff"
                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0"
                  />
                </svg>
              </button>

              <button type="button" class="thirdSilder-next btn-next">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                  <path
                    fill="#ffff"
                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0"
                  />
                </svg>
              </button>
            </div>
          </div>

          <div class="center-btn">
            <a href="javascript:void()" class="btn btn-outline-primary"
              >View All</a
            >
          </div>
        </div>
      </section>

      <section class="seo-links-sec">
  <div class="container">
    <div class="heading">
      <h3>Explore More <span>Leh Ladakh Expedition</span></h3>
      <p>
        Discover related departures, durations, destinations and experiences
        for this Leh Ladakh trip.
      </p>
    </div>

    <div class="seo-links-wrapper">
      <!-- Category 01 -->
      <div class="seo-link-block">
        <h4>Leh Ladakh Expedition From Popular Indian Cities</h4>

        <div class="seo-link-wrap">
          <a href="javascript:void()">Leh Ladakh Tour From Delhi</a>
          <a href="javascript:void()">Leh Ladakh Tour From Mumbai</a>
          <a href="javascript:void()">Leh Ladakh Tour From Bangalore</a>
          <a href="javascript:void()">Leh Ladakh Tour From Chandigarh</a>
          <a href="javascript:void()">Leh Ladakh Tour From Pune</a>
          <a href="javascript:void()">Leh Ladakh Tour From Ahmedabad</a>
          <a href="javascript:void()">Leh Ladakh Tour From Jaipur</a>
          <a href="javascript:void()">Leh Ladakh Tour From Hyderabad</a>
          <a href="javascript:void()">Leh Ladakh Tour From Kolkata</a>
          <a href="javascript:void()">Leh Ladakh Tour From Surat</a>
          <a href="javascript:void()">Leh Ladakh Tour From Lucknow</a>
          <a href="javascript:void()">Leh Ladakh Tour From Chennai</a>
        </div>
      </div>

      <!-- Category 02 -->
      <div class="seo-link-block">
        <h4>Choose Your Trip Duration</h4>

        <div class="seo-link-wrap">
          <a href="javascript:void()">4 Days Leh Ladakh Package</a>
          <a href="javascript:void()">5 Days Leh Ladakh Package</a>
          <a href="javascript:void()">6 Days Leh Ladakh Package</a>
          <a href="javascript:void()">7 Days Leh Ladakh Package</a>
          <a href="javascript:void()">8 Days Leh Ladakh Package</a>
          <a href="javascript:void()">9 Days Leh Ladakh Package</a>
          <a href="javascript:void()">10 Days Leh Ladakh Package</a>
        </div>
      </div>

      <!-- Category 03 -->
      <div class="seo-link-block">
        <h4>Destinations Covered On This Route</h4>

        <div class="seo-link-wrap">
          <a href="javascript:void()">Places to Visit in Leh</a>
          <a href="javascript:void()">Nubra Valley Sightseeing</a>
          <a href="javascript:void()">Pangong Tso Lake Tour</a>
          <a href="javascript:void()">Manali to Leh Route Guide</a>
          <a href="javascript:void()">Solang Valley Activities</a>
          <a href="javascript:void()">Kasol Travel Guide</a>
          <a href="javascript:void()">Best Time to Visit Ladakh</a>
          <a href="javascript:void()">How to Reach Leh Ladakh</a>
        </div>
      </div>

      <!-- Category 04 -->
      <div class="seo-link-block">
        <h4>More Ways To Experience This Trip</h4>

        <div class="seo-link-wrap">
          <a href="javascript:void()">Group Tours to Leh Ladakh</a>
          <a href="javascript:void()">Bike Trip to Leh Ladakh</a>
          <a href="javascript:void()">Family Package for Leh Ladakh</a>
          <a href="javascript:void()">Honeymoon Package Leh Ladakh</a>
          <a href="javascript:void()">Luxury Stays in Leh Ladakh</a>
          <a href="javascript:void()">Budget Leh Ladakh Packages</a>
          <a href="javascript:void()">Car Rental for Leh Ladakh</a>
          <a href="javascript:void()">Jeep Safari to Pangong Tso</a>
          <a href="javascript:void()">Camping Near Pangong Lake</a>
          <a href="javascript:void()">Monsoon Sale Ladakh Deals</a>
          <a href="javascript:void()">Weekend Getaways Near Manali</a>
          <a href="javascript:void()">Adventure Activities in Ladakh</a>
        </div>
      </div>
    </div>
  </div>
</section>

      <section class="listing-secI">
        <div class="container">
          <div class="heading">
            <h3>Have Questions? <span>We’re Here to Help.</span></h3>
          </div>

          <div class="accordion-wrapper">
            <div class="accordion-item">
              <div class="accordion-body">
                <div class="accordion-header active">
                  <h4>How far in advance should I start planning my trip?</h4>
                  <span class="accordion-icon">−</span>
                </div>
                <div class="accordion-content">
                  <p>
                    We recommend starting at least 4–6 weeks before your travel
                    date, especially for international destinations. This gives
                    enough time for visa processing, flight bookings at better
                    rates, and securing accommodation during peak season. For
                    last-minute trips, our team can still put together a plan
                    within 48 hours.
                  </p>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <div class="accordion-body">
                <div class="accordion-header">
                  <h4>Can I customize a pre-built itinerary?</h4>
                  <span class="accordion-icon">+</span>
                </div>
                <div class="accordion-content">
                  <p>
                    Absolutely. Every itinerary on our platform is a starting
                    point, not a fixed package. You can add or remove
                    destinations, change hotel categories, adjust the number of
                    days, or swap activities — our trip planner recalculates
                    pricing and logistics automatically as you edit.
                  </p>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <div class="accordion-body">
                <div class="accordion-header">
                  <h4>What's included in the trip cost?</h4>
                  <span class="accordion-icon">+</span>
                </div>
                <div class="accordion-content">
                  <p>
                    Standard packages include accommodation, daily breakfast,
                    private transfers, and a dedicated trip coordinator.
                    Flights, visas, travel insurance, and optional excursions
                    are shown separately at checkout so you always know exactly
                    what you're paying for before you confirm.
                  </p>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <div class="accordion-body">
                <div class="accordion-header">
                  <h4>What happens if I need to cancel or reschedule?</h4>
                  <span class="accordion-icon">+</span>
                </div>
                <div class="accordion-content">
                  <p>
                    Cancellations made 15 days or more before departure receive
                    a full refund minus a small processing fee. Between 7–14
                    days, you'll receive credit toward a future trip.
                    Rescheduling is free of charge up to 72 hours before your
                    travel date, subject to availability.
                  </p>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <div class="accordion-body">
                <div class="accordion-header">
                  <h4>Do you provide support during the trip?</h4>
                  <span class="accordion-icon">+</span>
                </div>
                <div class="accordion-content">
                  <p>
                    Yes — every booking comes with 24/7 on-trip support through
                    call, WhatsApp, and email. If a flight gets delayed, a hotel
                    booking has an issue, or your plans change mid-trip, our
                    local coordinators step in to resolve it in real time.
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
          <svg
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M0.75 0.75L23.25 23.25M0.75 23.25L23.25 0.75"
              stroke="black"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </button>
        <iframe id="iframe1" allow="autoplay; fullscreen" src=""></iframe>
      </div>
    </div>

    <div class="model review_pop">
      <div class="model-body">
        <div class="dialog-wrapper">
          <button class="close" type="button" aria-label="Close">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
            >
              <path
                fill="currentColor"
                d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z"
              />
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
              <input
                type="text"
                id="fullName"
                name="fullName"
                placeholder=""
                autocomplete="off"
              />
              <label for="fullName">Full Name*</label>
            </div>

            <div class="form-group">
              <input
                type="text"
                id="destination"
                name="destination"
                placeholder=""
                autocomplete="off"
              />
              <label for="destination">Destination*</label>
            </div>

            <div class="form-group">
              <textarea
                id="reviewMessage"
                name="reviewMessage"
                class="form-control"
                placeholder=""
              ></textarea>
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

@push('scripts')

    <script>
      // ================= Hotel Wrapper Accordion =================
      $(function () {
        $(".hotel_wrapper .hw-daytag").on("click", function () {
          var $item = $(this).closest(".hw-item");
          var $content = $item.find(".hw-content");
          var isActive = $item.hasClass("active");

          // close all other items
          $(".hotel_wrapper .hw-item")
            .not($item)
            .each(function () {
              $(this).removeClass("active");
              $(this).find(".hw-content").removeClass("show").slideUp(250);
            });

          if (isActive) {
            // clicking the already-open one closes it
            $item.removeClass("active");
            $content.removeClass("show").slideUp(250);
          } else {
            // open this one
            $item.addClass("active");
            $content.addClass("show").slideDown(250);
          }
        });
      });

      $(function () {
        var $nav = $(".section-nav");
        var $items = $nav.find("li[data-scroll]");

        $items.on("click", function () {
          var target = $(this).data("scroll");
          var $target = $("#" + target);

          if (!$target.length) return;

          $items.removeClass("active");
          $(this).addClass("active");

          $("html, body").animate(
            {
              scrollTop: $target.offset().top - $("header").outerHeight() - 20,
            },
            500,
          );
        });

        var $sections = $items
          .map(function () {
            var id = $(this).data("scroll");
            var $el = $("#" + id);
            return $el.length ? { id: id, el: $el } : null;
          })
          .get();

        $(window).on("scroll", function () {
          var scrollPos =
            $(window).scrollTop() + $("header").outerHeight() + 40;
          var current = $sections[0] ? $sections[0].id : null;

          $sections.forEach(function (s) {
            if (s.el.offset().top <= scrollPos) {
              current = s.id;
            }
          });

          $items.removeClass("active");
          $nav.find('li[data-scroll="' + current + '"]').addClass("active");
        });
      });
    </script>


@endpush
