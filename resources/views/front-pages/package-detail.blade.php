@extends('layouts.app')

@section('title', $tourPackage->meta_title ?? $tourPackage->name . ' | Indo Tours & Adventures')
@section('meta_description', $tourPackage->meta_description ?? Str::limit(strip_tags($tourPackage->overview_content), 160))
@section('canonical', $tourPackage->canonical_url ?: url()->current())
@section('robots', $tourPackage->robots ?: 'index, follow')

@section('og_title', $tourPackage->og_title ?? $tourPackage->meta_title ?? $tourPackage->name)
@section('og_description', $tourPackage->og_description ?? $tourPackage->meta_description ?? Str::limit(strip_tags($tourPackage->overview_content), 160))
@section('og_image', asset('storage/' . ($tourPackage->og_image ?: $tourPackage->main_image)))

@section('twitter_title', $tourPackage->og_title ?? $tourPackage->meta_title ?? $tourPackage->name)
@section('twitter_description', $tourPackage->og_description ?? $tourPackage->meta_description ?? Str::limit(strip_tags($tourPackage->overview_content), 160))
@section('twitter_image', asset('storage/' . ($tourPackage->twitter_card_image ?: $tourPackage->main_image)))

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/listing-detail/detail.css') }}" />
@endpush

@section('content')

  @php
    $bannerImages = collect([
      $tourPackage->main_image,
      $tourPackage->top_image,
      $tourPackage->bottom_left_image,
      $tourPackage->bottom_right_image,
    ])->filter();

    $locationParts = collect([
      $tourPackage->city->name ?? null,
      $tourPackage->state->name ?? null,
      $tourPackage->country->name ?? null,
    ])->filter();

    $reviewCount = $tourPackage->reviews->count();
    $avgRating = $reviewCount ? round($tourPackage->reviews->avg('rating'), 1) : 0;

    $ratingBreakdown = collect(range(5, 1))->mapWithKeys(function ($star) use ($tourPackage, $reviewCount) {
      $count = $tourPackage->reviews->where('rating', $star)->count();
      $percent = $reviewCount ? round($count / $reviewCount * 100) : 0;
      return [$star => ['count' => $count, 'percent' => $percent]];
    });
  @endphp


  <main>

    <!-- BANNER SECTION -->
    <section class="detail-banner">
      <div class="container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb breadcrumb-dark" aria-label="Breadcrumb">
          <ul>
            <li><a href="/">Home</a></li>
            <li><span class="breadcrumb-separator">/</span></li>
            @if($tourPackage->subCategory)
              <li><a
                  href="{{ route('subcategory.show', $tourPackage->subCategory->slug) }}">{{ $tourPackage->subCategory->name }}</a>
              </li>
              <li><span class="breadcrumb-separator">/</span></li>
            @endif
            <li>
              <a href="{{ route('tourpackage.show', $tourPackage->slug) }}" class="active">
                {{ $tourPackage->name }}
              </a>
            </li>
          </ul>
        </nav>

        <!-- ================= DESKTOP GRID (hidden below 991px) ================= -->
        <div class="grid">
          <!-- MAIN IMAGE -->
          <div class="item-img item-main">
            @if($tourPackage->main_image)
              <img loading="lazy" src="{{ asset('storage/' . $tourPackage->main_image) }}" alt="{{ $tourPackage->name }}" />
            @endif
            <div class="image-overlay"></div>
            <div class="image-content main-content">
              @if($tourPackage->banner_tag_text)
                <span class="image-tag">{{ $tourPackage->banner_tag_text }}</span>
              @endif
              <h1>{{ $tourPackage->name }}</h1>
              @if($tourPackage->banner_intro)
                <p>{{ $tourPackage->banner_intro }}</p>
              @endif
            </div>

            <!-- ACTION BUTTONS -->
            <div class="img-actions">
              @if($bannerImages->isNotEmpty())
                <a data-fancybox="gallery1" href="{{ asset('storage/' . $bannerImages->first()) }}" type="button"
                  class="action-btn">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path fill="currentColor" fill-rule="evenodd"
                      d="M16.375 4.5H4.625a.125.125 0 0 0-.125.125v8.254l2.859-1.54a.75.75 0 0 1 .68-.016l2.384 1.142l2.89-2.074a.75.75 0 0 1 .874 0l2.313 1.66V4.625a.125.125 0 0 0-.125-.125m.125 9.398l-2.75-1.975l-2.813 2.02a.75.75 0 0 1-.76.067l-2.444-1.17L4.5 14.583v1.792c0 .069.056.125.125.125h11.75a.125.125 0 0 0 .125-.125zM4.625 3C3.728 3 3 3.728 3 4.625v11.75C3 17.273 3.728 18 4.625 18h11.75c.898 0 1.625-.727 1.625-1.625V4.625C18 3.728 17.273 3 16.375 3zM20 8v11c0 .69-.31 1-.999 1H6v1.5h13.001c1.52 0 2.499-.982 2.499-2.5V8z"
                      clip-rule="evenodd" />
                  </svg>
                  Gallery
                </a>

                @foreach($bannerImages as $img)
                  <a data-fancybox="gallery1" href="{{ asset('storage/' . $img) }}"></a>
                @endforeach
              @endif

              @if($tourPackage->video_url)
                <button data-video="{{ asset($tourPackage->video_url) }}" type="button" class="action-btn">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <rect width="20" height="16" x="2" y="4" rx="4" />
                      <path d="m15 12l-5-3v6z" />
                    </g>
                  </svg>
                  Video
                </button>
              @endif
            </div>
          </div>

          <!-- TOP IMAGE -->
          @if($tourPackage->top_image)
            <div class="item-img item-top">
              <img loading="lazy" src="{{ asset('storage/' . $tourPackage->top_image) }}"
                alt="{{ $tourPackage->name }} - Destinations" />
              <div class="image-overlay"></div>
              <div class="image-content">
                <span class="image-label">Explore</span>
                <h3>Destinations</h3>
              </div>
            </div>
          @endif

          <!-- BOTTOM LEFT -->
          @if($tourPackage->bottom_left_image)
            <div class="item-img item-bottom-left">
              <img loading="lazy" src="{{ asset('storage/' . $tourPackage->bottom_left_image) }}"
                alt="{{ $tourPackage->name }} - Stays" />
              <div class="image-overlay"></div>
              <div class="image-content">
                <span class="image-label">Stay</span>
                <h3>Stays</h3>
              </div>
            </div>
          @endif

          <!-- BOTTOM RIGHT -->
          @if($tourPackage->bottom_right_image)
            <div class="item-img item-bottom-right">
              <img loading="lazy" src="{{ asset('storage/' . $tourPackage->bottom_right_image) }}"
                alt="{{ $tourPackage->name }} - Activities" />
              <div class="image-overlay"></div>
              <div class="image-content">
                <span class="image-label">Experience</span>
                <h3>Activities & Sightseeing</h3>
              </div>
            </div>
          @endif
        </div>

        <!-- ================= MOBILE/TABLET SWIPER (visible below 991px) ================= -->
        <div class="banner-swiper swiper">
          <div class="swiper-wrapper">
            @foreach($bannerImages as $img)
              <div class="swiper-slide">
                <img loading="lazy" src="{{ asset('storage/' . $img) }}" alt="{{ $tourPackage->name }}" />
              </div>
            @endforeach
          </div>

          <div class="image-overlay"></div>

          <div class="image-content main-content">
            @if($tourPackage->banner_tag_text)
              <span class="image-tag">{{ $tourPackage->banner_tag_text }}</span>
            @endif
            <h1>{{ $tourPackage->name }}</h1>
            @if($tourPackage->banner_intro)
              <p>{{ $tourPackage->banner_intro }}</p>
            @endif
          </div>

          <div class="swiper-pagination"></div>
        </div>

        <!-- META -->
        <div class="banner-meta">
          @if($locationParts->isNotEmpty())
            <span class="location">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none" />
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                  <circle cx="12" cy="10" r="3" />
                  <path
                    d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
                </g>
              </svg>
              {{ $locationParts->implode(', ') }}
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
      </div>
    </section>

    <!-- DETAIL SECTION -->
    <section class="detail-secA">
      <div class="container">
        <div class="grid">
          <div class="detail_wrapper">
            <div class="trip_info">
              <div class="trip-head">
                <h1>{{ $tourPackage->name }}</h1>
                @if($tourPackage->duration_text)
                  <span class="duration-pill">{{ $tourPackage->duration_text }}</span>
                @endif

                @if($tourPackage->price)
                  <div class="trip-price">
                    @if($tourPackage->old_price)
                      <span class="trip-price__old">₹{{ number_format($tourPackage->old_price) }}</span>
                    @endif
                    <span class="trip-price__now">
                      ₹{{ number_format($tourPackage->price) }}
                      @if($tourPackage->price_unit_text)
                        <small>{{ $tourPackage->price_unit_text }}</small>
                      @endif
                    </span>
                  </div>
                @endif
              </div>

              @if($tourPackage->routeStops->isNotEmpty())
                <div class="route-timeline">
                  @foreach($tourPackage->routeStops as $stop)
                    <div class="route-step">
                      <span class="dot">{{ $loop->iteration }}</span>
                      <div class="step-text">
                        <small>Stop</small>
                        <strong>{{ $stop->name }}</strong>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endif

              @if($tourPackage->features->isNotEmpty())
                <div class="feature-row">
                  @foreach($tourPackage->features as $feature)
                    <div class="feature-pill">
                      @if($feature->icon_image)
                        <img loading="lazy" src="{{ asset('storage/' . $feature->icon_image) }}" alt="" width="20"
                          height="20" />
                      @endif
                      {{ $feature->text }}
                    </div>
                  @endforeach
                </div>
              @endif

              <div class="section-divider"></div>

              @if($tourPackage->durationOptions->isNotEmpty())
                <div class="duration-select">
                  <h6>Find Your Perfect Trip</h6>

                  <div class="duration-scroll">
                    @foreach($tourPackage->durationOptions as $option)
                      <div class="duration-card {{ $loop->first ? 'active' : '' }}">
                        <div class="d-img">
                          @if($option->image)
                            <img loading="lazy" src="{{ asset('storage/' . $option->image) }}"
                              alt="{{ $option->days_label }}" />
                          @endif
                          <span class="d-days">{{ $option->days_label }}</span>
                        </div>
                        <p class="d-label">Starting From</p>
                        <p class="d-price">₹{{ number_format($option->price) }}</p>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif
            </div>

            @if($tourPackage->routeStops->isNotEmpty())
              <div class="direction">
                <div class="direction-head">
                  <h6>Destination Routes</h6>
                  <span class="route-count">{{ $tourPackage->routeStops->count() }} Stops</span>
                </div>

                <div class="route-box">
                  @foreach($tourPackage->routeStops as $stop)
                    <div class="route-item">
                      <span class="route-dot">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                      <span>{{ $stop->name }}</span>
                    </div>
                    @if(!$loop->last)
                      <span class="route-arrow">→</span>
                    @endif
                  @endforeach
                </div>
              </div>
            @endif

            <!-- ============ SECTION NAV ============ -->
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
                @if($tourPackage->overview_title)
                  <h6>{{ $tourPackage->overview_title }}</h6>
                @endif
                @if($tourPackage->overview_content)
                  <p>{{ $tourPackage->overview_content }}</p>
                @endif
              </div>

              @if($tourPackage->highlights->isNotEmpty())
                <div class="tab-block">
                  <h6>Trip Highlights</h6>
                  <ul class="check-list">
                    @foreach($tourPackage->highlights as $highlight)
                      <li>
                        <span class="check-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 12l2 2 4-4" />
                            <circle cx="12" cy="12" r="10" />
                          </svg>
                        </span>
                        {{ $highlight->text }}
                      </li>
                    @endforeach
                  </ul>
                </div>
              @endif
              <!-- ============ END SECTION NAV ============ -->

              @if($tourPackage->itineraryDays->isNotEmpty())
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
                    @foreach($tourPackage->itineraryDays->sortBy('day_number') as $day)
                      <div class="accordion-item {{ $loop->first ? 'active' : '' }}">
                        <div class="timeline-track">
                          <span class="day-marker">{{ str_pad($day->day_number, 2, '0', STR_PAD_LEFT) }}</span>
                          @if(!$loop->last)<span class="track-line"></span>@endif
                        </div>

                        <div class="accordion-body">
                          <div class="accordion-header">
                            <h4>{{ $day->title }}</h4>
                            <span class="accordion-icon">{{ $loop->first ? '−' : '+' }}</span>
                          </div>
                          <div class="accordion-content" style="{{ $loop->first ? 'display: block' : '' }}">
                            <p>{{ $day->content }}</p>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif

              @if($tourPackage->hotelStays->isNotEmpty())
                <div class="hotel_wrapper" id="hotel">
                  <div class="hw-head">
                    <h6>Hotel Details</h6>
                  </div>

                  <div class="hw-list">
                    @foreach($tourPackage->hotelStays as $stay)
                      @php
                        $galleries = $stay->hotel->galleries ?? collect();
                        $mainImage = $galleries->first();
                        $thumbs = $galleries->slice(1, 6);
                        $remainingCount = $galleries->count() - 7;
                      @endphp

                      <div class="hw-item {{ $loop->first ? 'active' : '' }}">
                        <div class="hw-daytag">
                          @if($stay->day_label)<span class="hw-day">{{ $stay->day_label }}</span>@endif
                          <h4>{{ $stay->title }}</h4>
                          <span class="hw-toggle">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                              <path d="M6 9l6 6 6-6" />
                            </svg>
                          </span>
                        </div>

                        <div class="hw-content {{ $loop->first ? 'show' : '' }}" {{ $loop->first ? 'style=display:block' : '' }}>
                          <div class="hw-stay-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                              <path
                                d="M3 18v-6.6a2 2 0 0 1 .16-.79l2.32-5.4A2 2 0 0 1 7.32 4h9.36a2 2 0 0 1 1.84 1.21l2.32 5.4a2 2 0 0 1 .16.79V18M8 10h8" />
                            </svg>
                            Stay At
                          </div>

                          <div class="hw-hotel-name">
                            {{ $stay->hotel->name ?? '' }}

                            @if($stay->hotel && $stay->hotel->rating)
                              <span class="hw-stars">
                                @for($i = 1; $i <= (int) $stay->hotel->rating; $i++)
                                  <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1z" />
                                  </svg>
                                @endfor
                              </span>
                            @endif
                          </div>

                          @if($stay->check_in || $stay->check_out)
                            <div class="hw-meta">
                              <div class="hw-meta-item">
                                <small>Check In</small>
                                <strong>{{ $stay->check_in }}</strong>
                              </div>
                              <div class="hw-meta-item hw-meta-item--right">
                                <small>Check Out</small>
                                <strong>{{ $stay->check_out }}</strong>
                              </div>
                            </div>
                          @endif

                          @if($galleries->isNotEmpty())
                            <div class="hw-gallery">
                              <a href="{{ asset($mainImage->image) }}" data-fancybox="hotel-{{ $stay->id }}"
                                class="hw-gallery-main">
                                <img loading="lazy" src="{{ asset($mainImage->image) }}"
                                  alt="{{ $stay->hotel->name ?? '' }}" />
                                @if($stay->hotel && $stay->hotel->rating)
                                  <span class="hw-rating-badge">
                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                      <path d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1z" />
                                    </svg>
                                    {{ $stay->hotel->rating }}/5
                                  </span>
                                @endif
                              </a>

                              @foreach($thumbs as $index => $thumb)
                                @php $isLastThumb = $loop->last && $remainingCount > 0; @endphp
                                <a href="{{ asset($thumb->image) }}" data-fancybox="hotel-{{ $stay->id }}"
                                  class="hw-thumb {{ $isLastThumb ? 'hw-thumb--more' : '' }}">
                                  <img loading="lazy" src="{{ asset($thumb->image) }}" alt="" />
                                  @if($isLastThumb)
                                    <div class="hw-more-overlay">
                                      <span>View all</span>
                                      <strong>({{ $galleries->count() }})</strong>
                                    </div>
                                  @endif
                                </a>
                              @endforeach

                              {{-- Remaining images beyond the visible thumbs, still in the fancybox group --}}
                              @foreach($galleries->slice(7) as $extra)
                                <a href="{{ asset('storage/' . $extra->image) }}" data-fancybox="hotel-{{ $stay->id }}"
                                  style="display:none;"></a>
                              @endforeach
                            </div>
                          @endif

                          <div class="hw-inclusions">
                            <span class="hw-inclusions-label">Meals</span>
                            <div class="hw-inclusions-list">
                              <div
                                class="hw-inclusion {{ $stay->breakfast_included ? 'hw-inclusion--yes' : 'hw-inclusion--no' }}">
                                <div>
                                  <span>Breakfast</span>
                                  <small>{{ $stay->breakfast_included ? 'Included' : 'Not Included' }}</small>
                                </div>
                              </div>
                              <div
                                class="hw-inclusion {{ $stay->lunch_included ? 'hw-inclusion--yes' : 'hw-inclusion--no' }}">
                                <div>
                                  <span>Lunch</span>
                                  <small>{{ $stay->lunch_included ? 'Included' : 'Not Included' }}</small>
                                </div>
                              </div>
                              <div
                                class="hw-inclusion {{ $stay->dinner_included ? 'hw-inclusion--yes' : 'hw-inclusion--no' }}">
                                <div>
                                  <span>Dinner</span>
                                  <small>{{ $stay->dinner_included ? 'Included' : 'Not Included' }}</small>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif

              @if($tourPackage->includes->isNotEmpty() || $tourPackage->excludes->isNotEmpty())
                <div class="include_exclude" id="include">
                  <h6 class="include_exclude__title">What's Included / Excluded</h6>
                  <p class="include_exclude__subtitle">Everything you need to know before you book — no hidden surprises.
                  </p>

                  <div class="include_exclude__grid">
                    @if($tourPackage->includes->isNotEmpty())
                      <div class="ie-card ie-card--include">
                        <div class="ie-card__head">
                          <span class="ie-card__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                              <path d="M0 0h28v28H0z" fill="none" />
                              <path fill="currentColor"
                                d="M6.75 3h14.5A3.75 3.75 0 0 1 25 6.75v6.45a3.75 3.75 0 0 0-1.5-.987V6.75a2.25 2.25 0 0 0-2.25-2.25h-6.5v7.635a3.74 3.74 0 0 0-1.5.82V4.5h-6.5A2.25 2.25 0 0 0 4.5 6.75v6.5h8.455c-.38.424-.664.935-.82 1.5H4.5v6.5a2.25 2.25 0 0 0 2.25 2.25h5.463c.205.578.547 1.091.988 1.5H6.75A3.75 3.75 0 0 1 3 21.25V6.75A3.75 3.75 0 0 1 6.75 3M13 15.75A2.75 2.75 0 0 1 15.75 13h6.5A2.75 2.75 0 0 1 25 15.75v6.5A2.75 2.75 0 0 1 22.25 25h-6.5A2.75 2.75 0 0 1 13 22.25z" />
                            </svg>
                          </span>
                          <h3>The Cost Includes</h3>
                        </div>
                        <ul class="ie-list">
                          @foreach($tourPackage->includes as $include)
                            <li><span class="ie-list__icon ie-list__icon--yes"><i
                                  class="fas fa-check"></i></span>{{ $include->text }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    @if($tourPackage->excludes->isNotEmpty())
                      <div class="ie-card ie-card--exclude">
                        <div class="ie-card__head">
                          <span class="ie-card__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                              <path d="M0 0h16v16H0z" fill="none" />
                              <path fill="currentColor"
                                d="M14.682 8.318a4.5 4.5 0 1 0-6.364 6.363a4.5 4.5 0 0 0 6.364-6.362zm-.328 3.536A.5.5 0 0 1 14 12H9a.5.5 0 1 1 0-1h5a.5.5 0 0 1 .354.854m-9.259-.666c.328 0 .637.089.905.243V12.5h-.276a.82.82 0 0 0-.779-.296a1 1 0 0 0-.13.035l-1.587.565a.42.42 0 0 1-.446-.112a7 7 0 0 1-1.473-2.536a.41.41 0 0 1 .126-.441l1.286-1.087a.82.82 0 0 0 0-1.256L1.435 6.285a.41.41 0 0 1-.126-.441a7 7 0 0 1 1.473-2.536a.42.42 0 0 1 .446-.112l1.587.565a.827.827 0 0 0 1.092-.628l.302-1.652a.41.41 0 0 1 .321-.329a7.1 7.1 0 0 1 2.939 0a.41.41 0 0 1 .321.329l.303 1.652a.826.826 0 0 0 1.092.627l1.587-.565a.42.42 0 0 1 .446.112a7 7 0 0 1 1.472 2.536a.41.41 0 0 1-.126.441l-.467.395a5.4 5.4 0 0 0-1.042-.43l.551-.466a6 6 0 0 0-.879-1.511l-1.207.43a2 2 0 0 1-.615.106a1.825 1.825 0 0 1-1.796-1.496L8.88 2.061a6.2 6.2 0 0 0-1.761.001L6.89 3.313a1.83 1.83 0 0 1-2.411 1.39l-1.207-.43q-.553.692-.879 1.511l.974.823q.113.097.21.21c.317.372.47.844.43 1.33a1.8 1.8 0 0 1-.64 1.243l-.974.823q.326.819.879 1.511l1.207-.43a1.9 1.9 0 0 1 .616-.106m1.962-2.907a5.5 5.5 0 0 0-.581 1a1.98 1.98 0 0 1-.477-1.282a2 2 0 0 1 2-2c.491 0 .935.184 1.282.477a5.6 5.6 0 0 0-.838.451c-.058.039-.108.088-.165.129c-.09-.027-.18-.057-.28-.057a1 1 0 0 0-1 1c0 .1.03.191.057.283z" />
                            </svg>
                          </span>
                          <h3>The Cost Excludes</h3>
                        </div>
                        <ul class="ie-list">
                          @foreach($tourPackage->excludes as $exclude)
                            <li><span class="ie-list__icon ie-list__icon--no"><i
                                  class="fas fa-times"></i></span>{{ $exclude->text }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                  </div>
                </div>
              @endif

              @if($tourPackage->faqs->isNotEmpty())
                <div class="policy" id="faqs">
                  <div class="policy-more">
                    <div class="policy-more__header">
                      <h3>Trip FAQs</h3>
                    </div>
                  </div>

                  <div class="accordion-wrapper">
                    @foreach($tourPackage->faqs as $faq)
                      <div class="accordion-item">
                        <div class="accordion-header">
                          <h3>{{ $faq->question }}</h3>
                          <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content">
                          <div class="accordion-content__inner">
                            <p>{{ $faq->answer }}</p>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif

              @if($tourPackage->map_embed_url)
                <div class="map" id="map">
                  <div class="heading">
                    <h6>Map</h6>
                  </div>
                  <div class="map_wrap">
                    <iframe src="{{ $tourPackage->map_embed_url }}" width="100%" height="450" style="border: 0"
                      allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                  </div>
                </div>
              @endif

              @if($tourPackage->policies->isNotEmpty())
                <div class="policy">
                  <div class="accordion-wrapper">
                    @foreach($tourPackage->policies as $policy)
                      <div class="accordion-item">
                        <div class="accordion-header">
                          <h3>{{ $policy->title }}</h3>
                          <span class="accordion-icon">+</span>
                        </div>
                        <div class="accordion-content">
                          <div class="accordion-content__inner">
                            <p>{!! nl2br(e($policy->content)) !!}</p>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif
            </div>
          </div>

          <div class="quote-card">
            <div class="quote-card__accent"></div>

            <div class="quote-card__head">
              <h3 class="quote-card__title">Start Planning Your Journey</h3>
              @if($tourPackage->price)
                <div class="quote-card__price">
                  <span class="quote-card__now">₹{{ number_format($tourPackage->price) }}</span>
                  @if($tourPackage->old_price)
                    <span class="quote-card__old">₹{{ number_format($tourPackage->old_price) }}</span>
                    <span class="quote-card__save">Save
                      ₹{{ number_format($tourPackage->old_price - $tourPackage->price) }}</span>
                  @endif
                </div>
              @endif
            </div>

            <form id="enquiryForm" action="{{ route('enquiries.store') }}" method="POST">
              @csrf
              <input type="hidden" name="tour_package_id" value="{{ $tourPackage->id }}">

              <div class="field">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                  <path d="M0 0h24v24H0z" fill="none" />
                  <path fill="#191a19"
                    d="M12 4.75a2.25 2.25 0 1 0 0 4.5a2.25 2.25 0 0 0 0-4.5M8.25 7a3.75 3.75 0 1 1 7.5 0a3.75 3.75 0 0 1-7.5 0m1.064 5.819c.132.098.302.213.505.327c.513.29 1.265.59 2.18.59s1.668-.3 2.181-.59c.203-.114.373-.229.505-.327q.282.075.559.166l.96.315c.72.237 1.264.812 1.458 1.523l.397 2.864c.075.544-.21.939-.606 1.033c-1.047.25-2.812.53-5.453.53s-4.407-.28-5.454-.53c-.395-.094-.68-.489-.606-1.033l.397-2.864A2.23 2.23 0 0 1 7.796 13.3l.96-.315q.276-.09.558-.166m.71-1.355l-.291-.287l-.402.092q-.526.12-1.044.291l-.96.315a3.72 3.72 0 0 0-2.454 2.616l-.01.04l-.408 2.95c-.161 1.164.462 2.393 1.744 2.698c1.17.279 3.052.571 5.8.571c2.749 0 4.631-.292 5.801-.57c1.282-.306 1.906-1.535 1.745-2.698l-.409-2.95l-.01-.04a3.72 3.72 0 0 0-2.455-2.617l-.959-.315q-.517-.17-1.044-.29l-.402-.093l-.29.286l-.001.001a2 2 0 0 1-.12.101a3 3 0 0 1-.41.274a2.96 2.96 0 0 1-1.445.397a2.96 2.96 0 0 1-1.445-.397a3.2 3.2 0 0 1-.53-.375" />
                </svg>
                <input type="text" name="full_name" placeholder=" " class="field__input has-icon" required />
                <label class="field__label">Full Name<span>*</span></label>
              </div>

              <div class="field">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                  <path d="M0 0h24v24H0z" fill="none" />
                  <path fill="#191a19"
                    d="M19.25 4H4.75A2.755 2.755 0 0 0 2 6.75v10.5A2.755 2.755 0 0 0 4.75 20h14.5A2.755 2.755 0 0 0 22 17.25V6.75A2.755 2.755 0 0 0 19.25 4M4.75 5.5h14.5c.69 0 1.25.56 1.25 1.25v.975l-8.5 4.91l-8.5-4.91V6.75c0-.69.56-1.25 1.25-1.25m14.5 13H4.75c-.69 0-1.25-.56-1.25-1.25V9.46l8.5 4.91l8.5-4.91v7.79c0 .69-.56 1.25-1.25 1.25" />
                </svg>
                <input type="email" name="email" placeholder=" " class="field__input has-icon" required />
                <label class="field__label">Email<span>*</span></label>
              </div>

              <div class="field-row field-row--phone">
                <div class="code-select">
                  +91 <i class="fas fa-chevron-down"></i>
                </div>
                <div class="field" style="margin-bottom: 0">
                  <input type="tel" name="phone" placeholder=" " class="field__input" required />
                  <label class="field__label">Phone<span>*</span></label>
                </div>
              </div>

              <div class="field-row">
                <div class="field" style="margin-bottom: 0">
                  <input type="text" name="dates" placeholder=" " class="field__input" required />
                  <label class="field__label">Travel Date<span>*</span></label>
                </div>
                <div class="field" style="margin-bottom: 0">
                  <input type="number" min="1" name="traveller_count" placeholder=" " class="field__input" required />
                  <label class="field__label">Travellers<span>*</span></label>
                </div>
              </div>

              <div class="field field--textarea">
                <textarea name="message" placeholder=" " class="field__input" rows="3"></textarea>
                <label class="field__label">Message</label>
              </div>

              <button type="submit" class="btn btn-primary smt">Send Enquiry</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- OFFER BANNER -->
    @if($tourPackage->group_offer_title)
      <section class="group-offer-banner">
        <div class="container">
          <div class="group-offer-banner__inner">
            <div class="group-offer-banner__content">
              @if($tourPackage->group_offer_badge_text)
                <span class="group-offer-banner__badge">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path fill="currentColor"
                      d="M12 2l1.6 4.8L18 5l-1.8 4.4L21 12l-4.8 1.6L18 19l-4.4-1.8L12 22l-1.6-4.8L6 19l1.8-4.4L3 12l4.8-1.6L6 5l4.4 1.8z" />
                  </svg>
                  {{ $tourPackage->group_offer_badge_text }}
                </span>
              @endif

              <h3>{{ $tourPackage->group_offer_title }}</h3>

              @if($tourPackage->group_offer_description)
                <p>{{ $tourPackage->group_offer_description }}</p>
              @endif

              <div class="group-offer-banner__actions">
                @if($tourPackage->group_offer_button1_text)
                  <a href="{{ $tourPackage->group_offer_button1_url ?: route('subcategory.show', $tourPackage->subCategory->slug ?? '') }}"
                    class="btn btn-white">
                    {{ $tourPackage->group_offer_button1_text }}
                  </a>
                @endif
                <a href="javascript:void()" data-model=".enquire-pop" data-package-id="{{ $tourPackage->id }}"
                  class="btn btn-outline-white">
                  Get A Quote
                </a>
              </div>
            </div>

            @if($tourPackage->group_offer_image)
              <div class="group-offer-banner__media">
                <div class="group-offer-banner__img group-offer-banner__img--secondary">
                  <img loading="lazy" src="{{ asset('storage/' . $tourPackage->group_offer_image) }}"
                    alt="{{ $tourPackage->group_offer_title }}" />
                </div>
              </div>
            @endif
          </div>
        </div>
      </section>
    @endif

    <!-- PROMO BANNER -->
    @if($tourPackage->promo_title && $tourPackage->promo_end_at)
      <section class="listing-secG">
        <div class="container">
          <div class="grid">
            <div class="glow"></div>

            <div class="promo-left">
              @if($tourPackage->promo_badge_text)
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
                  {{ $tourPackage->promo_badge_text }}
                </span>
              @endif

              <h3>{{ $tourPackage->promo_title }}</h3>

              @if($tourPackage->promo_description)
                <p>{{ $tourPackage->promo_description }}</p>
              @endif

              @if($tourPackage->promo_button_text)
                <a href="{{ $tourPackage->promo_button_url ?: '#' }}" class="btn btn-promo">
                  {{ $tourPackage->promo_button_text }}
                  <i class="icon-arrow"></i>
                </a>
              @endif
            </div>

            <div class="promo-right">
              <span class="countdown-label">Hurry, sale ends in</span>

              <div class="countdown" id="countdown"
                data-end="{{ \Carbon\Carbon::parse($tourPackage->promo_end_at)->toIso8601String() }}">
                <div class="time-block">
                  <div class="flip" data-unit="days"><span class="digit">00</span></div>
                  <span class="unit-label">Days</span>
                </div>
                <span class="sep">:</span>
                <div class="time-block">
                  <div class="flip" data-unit="hours"><span class="digit">00</span></div>
                  <span class="unit-label">Hours</span>
                </div>
                <span class="sep">:</span>
                <div class="time-block">
                  <div class="flip" data-unit="minutes"><span class="digit">00</span></div>
                  <span class="unit-label">Mins</span>
                </div>
                <span class="sep">:</span>
                <div class="time-block">
                  <div class="flip" data-unit="seconds"><span class="digit">00</span></div>
                  <span class="unit-label">Secs</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    @endif

    <!-- REVIEW SECTION -->
    <section class="detail-secF">
      <div class="heading">
        <h3>Traveler <span>Reviews</span></h3>
        <a href="javascript:void()" class="btn btn-secondary" data-model=".review_pop">
          Write a Review
        </a>
      </div>

      <div class="grid">
        <!-- Rating Summary -->
        <div class="rating-wrapper">
          <h2>{{ $reviewCount ? $avgRating : '—' }}</h2>

          <div class="stars">
            @for($i = 1; $i <= 5; $i++)
              <svg viewBox="0 0 24 24" fill="currentColor" style="opacity: {{ $i <= round($avgRating) ? 1 : 0.3 }}">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
              </svg>
            @endfor
          </div>

          <p class="total-reviews">{{ $reviewCount }} {{ Str::plural('Review', $reviewCount) }}</p>

          <div class="rating-bars">
            @foreach($ratingBreakdown as $star => $data)
              <div class="bar-row">
                <span class="label">{{ $star }}</span>
                <div class="bar-track">
                  <div class="bar-fill" style="width: {{ $data['percent'] }}%"></div>
                </div>
                <span class="count">{{ $data['count'] }}</span>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Review Swiper -->
        <div class="swiper-wrap">
          @if($tourPackage->reviews->isNotEmpty())
            <div class="swiper reviewSlider">
              <div class="swiper-wrapper">
                @foreach($tourPackage->reviews as $review)
                  <div class="swiper-slide">
                    <div class="card">
                      <div class="header">
                        @if($review->photo)
                          <img loading="lazy" src="{{ asset('storage/' . $review->photo) }}" alt="{{ $review->full_name }}" />
                        @else
                          <span class="avatar-initials">{{ $review->initials() }}</span>
                        @endif
                        <div class="name">
                          <h6>{{ $review->full_name }}</h6>
                          <p>{{ $review->designation ?: $review->created_at->format('d M Y') }}</p>
                        </div>
                      </div>

                      <p class="quote">"{{ $review->review }}"</p>

                      <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                          <svg viewBox="0 0 24 24" fill="currentColor" style="opacity: {{ $i <= $review->rating ? 1 : 0.3 }}">
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
          @else
            <div class="no-reviews">
              <p>No reviews yet — be the first to share your experience on this trip.</p>
            </div>
          @endif
        </div>
      </div>
    </section>

    <!-- RELATED PACKAGES -->
    @if($relatedPackages->isNotEmpty())
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
                @foreach($relatedPackages as $package)
                  <div class="swiper-slide">
                    <a href="{{ route('tourpackage.show', $package->slug) }}" target="_blank" class="trip_card3">
                      <div class="img">
                        @if($package->main_image)
                          <img loading="lazy" src="{{ asset('storage/' . $package->main_image) }}" alt="{{ $package->name }}" />
                        @endif
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
                        <h3 class="place">{{ $package->name }}</h3>
                        <div class="foot">
                          @if($package->price)
                            <p class="price"><small>Starts at</small>INR {{ number_format($package->price) }}</p>
                          @endif
                          <span class="arrow-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                              stroke-width="2">
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
            <a href="{{ route('subcategory.show', $tourPackage->subCategory->slug ?? '') }}"
              class="btn btn-outline-primary">View All</a>
          </div>
        </div>
      </section>
    @endif

    <!-- HYPERLINK SECTION -->
    @if($tourPackage->subCategory || $tourPackage->destinations->isNotEmpty() || $tourPackage->attractions->isNotEmpty() || $tourPackage->activities->isNotEmpty())
      <section class="seo-links-sec">
        <div class="container">
          <div class="heading">
            <h3>Explore More <span>{{ $tourPackage->name }}</span></h3>
            <p>
              Discover related categories, destinations and experiences for this {{ $tourPackage->name }} trip.
            </p>
          </div>

          <div class="seo-links-wrapper">
            {{-- Category / Sub-Category --}}
            @if($tourPackage->subCategory)
              <div class="seo-link-block">
                <h4>Browse By Category</h4>
                <div class="seo-link-wrap">
                  @if($tourPackage->subCategory->category)
                    <a href="{{ route('category.show', $tourPackage->subCategory->category->slug) }}">
                      {{ $tourPackage->subCategory->category->name }}
                    </a>
                  @endif

                  <a href="{{ route('subcategory.show', $tourPackage->subCategory->slug) }}">
                    {{ $tourPackage->subCategory->name }}
                  </a>
                </div>
              </div>
            @endif

            {{-- Destinations --}}
            @if($tourPackage->destinations->isNotEmpty())
              <div class="seo-link-block">
                <h4>Destinations Covered On This Trip</h4>
                <div class="seo-link-wrap">
                  @foreach($tourPackage->destinations as $destination)
                    <a href="{{ route('destination.show', $destination->slug) }}">{{ $destination->name }}</a>
                  @endforeach
                </div>
              </div>
            @endif

            {{-- Attractions --}}
            @if($tourPackage->attractions->isNotEmpty())
              <div class="seo-link-block">
                <h4>Top Attractions On This Route</h4>
                <div class="seo-link-wrap">
                  @foreach($tourPackage->attractions as $attraction)
                    <a href="{{ route('attraction.show', $attraction->slug) }}">{{ $attraction->name }}</a>
                  @endforeach
                </div>
              </div>
            @endif

            {{-- Activities --}}
            @if($tourPackage->activities->isNotEmpty())
              <div class="seo-link-block">
                <h4>Things To Do On This Trip</h4>
                <div class="seo-link-wrap">
                  @foreach($tourPackage->activities as $activity)
                    <a href="{{ route('activities.show', $activity->slug) }}">{{ $activity->name }}</a>
                  @endforeach
                </div>
              </div>
            @endif
          </div>
        </div>
      </section>
    @endif

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
          <input type="hidden" name="tour_package_id" value="{{ $tourPackage->id }}">
          <input type="hidden" name="reviewable_type" value="tour_package">
          <input type="hidden" name="reviewable_id" value="{{ $tourPackage->id }}">

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
  @php
    $breadcrumbItems = [
      ['name' => 'Home', 'url' => url('/')],
    ];
    if ($tourPackage->subCategory) {
      $breadcrumbItems[] = ['name' => $tourPackage->subCategory->name, 'url' => route('subcategory.show', $tourPackage->subCategory->slug)];
    }
    $breadcrumbItems[] = ['name' => $tourPackage->name, 'url' => url()->current()];

    $schema = [
      '@context' => 'https://schema.org',
      '@graph' => [
        [
          '@type' => 'BreadcrumbList',
          'itemListElement' => collect($breadcrumbItems)->map(function ($item, $i) {
            return [
              '@type' => 'ListItem',
              'position' => $i + 1,
              'name' => $item['name'],
              'item' => $item['url'],
            ];
          })->values()->all(),
        ],
        array_filter([
          '@type' => 'TouristTrip',
          '@id' => url()->current() . '#trip',
          'name' => $tourPackage->name,
          'description' => $tourPackage->meta_description ?? Str::limit(strip_tags($tourPackage->overview_content), 160),
          'url' => url()->current(),
          'image' => $tourPackage->main_image ? asset('storage/' . $tourPackage->main_image) : null,
          'touristType' => $locationParts->isNotEmpty() ? $locationParts->implode(', ') : null,
          'offers' => $tourPackage->price ? [
            '@type' => 'Offer',
            'price' => $tourPackage->price,
            'priceCurrency' => 'INR',
            'url' => url()->current(),
            'availability' => 'https://schema.org/InStock',
          ] : null,
          'aggregateRating' => $reviewCount ? [
            '@type' => 'AggregateRating',
            'ratingValue' => $avgRating,
            'reviewCount' => $reviewCount,
          ] : null,
          'review' => $tourPackage->reviews->isNotEmpty() ? $tourPackage->reviews->map(function ($review) {
            return [
              '@type' => 'Review',
              'author' => [
                '@type' => 'Person',
                'name' => $review->full_name,
              ],
              'datePublished' => $review->created_at->toDateString(),
              'reviewBody' => $review->review,
              'reviewRating' => [
                '@type' => 'Rating',
                'ratingValue' => $review->rating,
                'bestRating' => 5,
              ],
            ];
          })->values()->all() : null,
        ]),
      ],
    ];

    if ($tourPackage->faqs->isNotEmpty()) {
      $schema['@graph'][] = [
        '@type' => 'FAQPage',
        'mainEntity' => $tourPackage->faqs->map(function ($faq) {
          return [
            '@type' => 'Question',
            'name' => $faq->question,
            'acceptedAnswer' => [
              '@type' => 'Answer',
              'text' => $faq->answer,
            ],
          ];
        })->values()->all(),
      ];
    }
  @endphp

  <script type="application/ld+json">
    {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
  </script>

  <script>
    $(function () {
      $(".hotel_wrapper .hw-daytag").on("click", function () {
        var $item = $(this).closest(".hw-item");
        var $content = $item.find(".hw-content");
        var isActive = $item.hasClass("active");

        $(".hotel_wrapper .hw-item").not($item).each(function () {
          $(this).removeClass("active");
          $(this).find(".hw-content").removeClass("show").slideUp(250);
        });

        if (isActive) {
          $item.removeClass("active");
          $content.removeClass("show").slideUp(250);
        } else {
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
          { scrollTop: $target.offset().top - $("header").outerHeight() - 20 },
          500
        );
      });

      var $sections = $items.map(function () {
        var id = $(this).data("scroll");
        var $el = $("#" + id);
        return $el.length ? { id: id, el: $el } : null;
      }).get();

      $(window).on("scroll", function () {
        var scrollPos = $(window).scrollTop() + $("header").outerHeight() + 40;
        var current = $sections[0] ? $sections[0].id : null;

        $sections.forEach(function (s) {
          if (s.el.offset().top <= scrollPos) current = s.id;
        });

        $items.removeClass("active");
        $nav.find('li[data-scroll="' + current + '"]').addClass("active");
      });
    });

    $(function () {
      var $countdown = $('#countdown');
      if (!$countdown.length) return;

      var end = new Date($countdown.data('end')).getTime();

      var tick = function () {
        var now = new Date().getTime();
        var diff = end - now;

        if (diff <= 0) {
          $countdown.closest('.listing-secG').fadeOut(300);
          clearInterval(timer);
          return;
        }

        var days = Math.floor(diff / (1000 * 60 * 60 * 24));
        var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        var secs = Math.floor((diff % (1000 * 60)) / 1000);

        $countdown.find('[data-unit="days"] .digit').text(String(days).padStart(2, '0'));
        $countdown.find('[data-unit="hours"] .digit').text(String(hours).padStart(2, '0'));
        $countdown.find('[data-unit="minutes"] .digit').text(String(mins).padStart(2, '0'));
        $countdown.find('[data-unit="seconds"] .digit').text(String(secs).padStart(2, '0'));
      };

      tick();
      var timer = setInterval(tick, 1000);
    });

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

      // ---- Enquiry form (plain fields, no files) ----
      $('#enquiryForm').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);

        $.ajax({
          url: $form.attr('action'),
          method: 'POST',
          data: $form.serialize(),
          headers: { 'X-CSRF-TOKEN': csrfToken },
          dataType: 'json',
        })
          .done(function (res) {
            alert(res.message || 'Thanks! We will contact you shortly.');
            $form[0].reset();
          })
          .fail(function (xhr) {
            var message = 'Something went wrong. Please check the form and try again.';
            if (xhr.responseJSON && xhr.responseJSON.errors) {
              message = Object.values(xhr.responseJSON.errors).flat().join(' ');
            }
            alert(message);
          });
      });
    });

  </script>
@endpush