@extends('layouts.app')

@php
  $galleryUrls = $hotel->galleries->map(fn($g) => asset($g->image))->values();   // gallery paths are stored as "storage/..."
  $ogImage = $hotel->og_image ? asset('storage/' . $hotel->og_image) : $galleryUrls->first();
  $twitterImage = $hotel->twitter_card_image ? asset('storage/' . $hotel->twitter_card_image) : $ogImage;

  $metaDesc = $hotel->meta_description
    ?: Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($hotel->short_description ?: $hotel->description))), 160);
@endphp

@section('title', $hotel->meta_title ?: $hotel->name . ' | Indo Tours & Adventures')
@section('meta_description', $metaDesc)
@section('canonical', $hotel->canonical_url ?: url()->current())
@section('robots', $hotel->robots ?: 'index, follow')

@section('og_title', $hotel->og_title ?: $hotel->meta_title ?: $hotel->name)
@section('og_description', $hotel->og_description ?: $metaDesc)
@section('og_image', $ogImage ?? '')

@section('twitter_title', $hotel->og_title ?: $hotel->meta_title ?: $hotel->name)
@section('twitter_description', $hotel->og_description ?: $metaDesc)
@section('twitter_image', $twitterImage ?? '')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/listing-detail/detail.css') }}" />
@endpush

@section('content')

  @php
    $bannerImages = $galleryUrls->take(4);

    $locationParts = collect([
      $hotel->city->name ?? null,
      $hotel->state->name ?? null,
      $hotel->country->name ?? null,
    ])->filter();
    $locationLine = $hotel->location ?: $locationParts->implode(', ');

    $starCount = (int) $hotel->star_rating;
    $minPrice = $hotel->rooms->min('price');
    $facilities = collect($hotel->facilities ?? []);
    $mapPoints = collect($hotel->map_points ?? []);

    $checkIn = $hotel->check_in_time ? \Carbon\Carbon::parse($hotel->check_in_time)->format('h:i A') : null;
    $checkOut = $hotel->check_out_time ? \Carbon\Carbon::parse($hotel->check_out_time)->format('h:i A') : null;
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
            <li>
              <a href="{{ route('hotel.show', $hotel->slug) }}" class="active">{{ $hotel->name }}</a>
            </li>
          </ul>
        </nav>

        <!-- ================= DESKTOP GRID ================= -->
        <div class="grid">
          <!-- MAIN IMAGE -->
          <div class="item-img item-main">
            @if($bannerImages->isNotEmpty())
              <img loading="lazy" src="{{ $bannerImages->first() }}" alt="{{ $hotel->name }}" />
            @endif
            <div class="image-overlay"></div>
            <div class="image-content main-content">
              @if($hotel->category)
                <span class="image-tag">{{ $hotel->category }}</span>
              @endif
              <h1>{{ $hotel->h1 ?: $hotel->name }}</h1>
              @if($hotel->short_description)
                <p>{{ Str::limit($hotel->short_description, 140) }}</p>
              @endif
            </div>

            <!-- ACTION BUTTONS -->
            <div class="img-actions">
              @if($galleryUrls->isNotEmpty())
                <a data-fancybox="gallery1" href="{{ $galleryUrls->first() }}" type="button" class="action-btn">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path fill="currentColor" fill-rule="evenodd"
                      d="M16.375 4.5H4.625a.125.125 0 0 0-.125.125v8.254l2.859-1.54a.75.75 0 0 1 .68-.016l2.384 1.142l2.89-2.074a.75.75 0 0 1 .874 0l2.313 1.66V4.625a.125.125 0 0 0-.125-.125m.125 9.398l-2.75-1.975l-2.813 2.02a.75.75 0 0 1-.76.067l-2.444-1.17L4.5 14.583v1.792c0 .069.056.125.125.125h11.75a.125.125 0 0 0 .125-.125zM4.625 3C3.728 3 3 3.728 3 4.625v11.75C3 17.273 3.728 18 4.625 18h11.75c.898 0 1.625-.727 1.625-1.625V4.625C18 3.728 17.273 3 16.375 3zM20 8v11c0 .69-.31 1-.999 1H6v1.5h13.001c1.52 0 2.499-.982 2.499-2.5V8z"
                      clip-rule="evenodd" />
                  </svg>
                  Gallery ({{ $galleryUrls->count() }})
                </a>

                {{-- every gallery photo joins the lightbox group --}}
                @foreach($galleryUrls as $url)
                  <a data-fancybox="gallery1" href="{{ $url }}"></a>
                @endforeach
              @endif
            </div>
          </div>

          <!-- TOP IMAGE -->
          @if($bannerImages->count() > 1)
            <div class="item-img item-top">
              <img loading="lazy" src="{{ $bannerImages[1] }}" alt="{{ $hotel->name }} - Gallery" />
              <div class="image-overlay"></div>
              <div class="image-content">
                <span class="image-label">Explore</span>
                <h3>Hotel Gallery</h3>
              </div>
            </div>
          @endif

          <!-- BOTTOM LEFT -->
          @if($bannerImages->count() > 2)
            <div class="item-img item-bottom-left">
              <img loading="lazy" src="{{ $bannerImages[2] }}" alt="{{ $hotel->name }} - Rooms" />
              <div class="image-overlay"></div>
              <div class="image-content">
                <span class="image-label">Stay</span>
                <h3>Rooms & Suites</h3>
              </div>
            </div>
          @endif

          <!-- BOTTOM RIGHT -->
          @if($bannerImages->count() > 3)
            <div class="item-img item-bottom-right">
              <img loading="lazy" src="{{ $bannerImages[3] }}" alt="{{ $hotel->name }} - Facilities" />
              <div class="image-overlay"></div>
              <div class="image-content">
                <span class="image-label">Enjoy</span>
                <h3>Hotel Facilities</h3>
              </div>
            </div>
          @endif
        </div>

        <!-- ================= MOBILE/TABLET SWIPER ================= -->
        <div class="banner-swiper swiper">
          <div class="swiper-wrapper">
            @foreach($bannerImages as $url)
              <div class="swiper-slide">
                <img loading="lazy" src="{{ $url }}" alt="{{ $hotel->name }}" />
              </div>
            @endforeach
          </div>

          <div class="image-overlay"></div>

          <div class="image-content main-content">
            @if($hotel->category)
              <span class="image-tag">{{ $hotel->category }}</span>
            @endif
            <h1>{{ $hotel->h1 ?: $hotel->name }}</h1>
            @if($hotel->short_description)
              <p>{{ Str::limit($hotel->short_description, 140) }}</p>
            @endif
          </div>

          <div class="swiper-pagination"></div>
        </div>

        <!-- META -->
        <div class="banner-meta">
          @if($locationLine)
            <span class="location">
              <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none" />
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                  <circle cx="12" cy="10" r="3" />
                  <path
                    d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
                </g>
              </svg>
              {{ $locationLine }}
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
                <h1>
                  {{ $hotel->name }}
                  @if($starCount)
                    <span class="hw-stars" aria-label="{{ $starCount }} star hotel"
                      style="display:inline-flex;gap:2px;color:#f5a623;vertical-align:middle;margin-left:8px;">
                      @for($i = 1; $i <= $starCount; $i++)
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                          <path d="M12 2l3.1 6.3 6.9 1-5 4.9 1.2 6.9L12 17.8 5.8 21l1.2-6.9-5-4.9 6.9-1z" />
                        </svg>
                      @endfor
                    </span>
                  @endif
                </h1>

                @if($hotel->category)
                  <span class="duration-pill">{{ $hotel->category }}</span>
                @endif
                @if($hotel->rating)
                  <span class="duration-pill">★ {{ number_format($hotel->rating, 1) }}/5 Guest Rating</span>
                @endif

                @if($minPrice)
                  <div class="trip-price">
                    <span class="trip-price__now">
                      ₹{{ number_format($minPrice) }}
                      <small>per night, from</small>
                    </span>
                  </div>
                @endif
              </div>

              @if($facilities->isNotEmpty())
                <div class="feature-row">
                  @foreach($facilities->take(6) as $facility)
                    <div class="feature-pill">{{ $facility }}</div>
                  @endforeach
                </div>
              @endif

              <div class="section-divider"></div>
            </div>

            <!-- ============ SECTION NAV ============ -->
            <div class="scroll-sections">
              <div class="trip_tabing">
                <ul class="section-nav">
                  <li class="active" data-scroll="overview">Overview</li>
                  @if($hotel->rooms->isNotEmpty())<li data-scroll="rooms">Rooms</li>@endif
                  @if($facilities->isNotEmpty())<li data-scroll="facilities">Facilities</li>@endif
                  @if($checkIn || $checkOut)<li data-scroll="timings">Check-in / Out</li>@endif
                  @if($hotel->map_embed_url || $hotel->address)<li data-scroll="map">Map</li>@endif
                </ul>
              </div>

              <div class="tab-block" id="overview">
                <h6>About {{ $hotel->name }}</h6>
                @if($hotel->short_description)
                  <p>{{ $hotel->short_description }}</p>
                @endif
                @if($hotel->description)
                  {!! $hotel->description !!}
                @endif
              </div>

              {{-- ============ ROOMS (reuses the hotel accordion styles) ============ --}}
              @if($hotel->rooms->isNotEmpty())
                <div class="hotel_wrapper" id="rooms">
                  <div class="hw-head">
                    <h6>Choose Your Room</h6>
                  </div>

                  <div class="hw-list">
                    @foreach($hotel->rooms as $room)
                      @php
                        $roomImgs = $room->images->map(fn($im) => asset('storage/' . $im->image))->values();
                        $roomThumbs = $roomImgs->slice(1, 6);
                        $roomRemaining = $roomImgs->count() - 7;
                      @endphp

                      <div class="hw-item {{ $loop->first ? 'active' : '' }}">
                        <div class="hw-daytag">
                          @if($room->room_type)<span class="hw-day">{{ $room->room_type }}</span>@endif
                          <h4>{{ $room->name }}</h4>
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
                            Room Details
                          </div>

                          <div class="hw-hotel-name">{{ $room->name }}</div>

                          <div class="hw-meta">
                            <div class="hw-meta-item">
                              <small>Occupancy</small>
                              <strong>{{ $room->max_adults }} Adult{{ $room->max_adults > 1 ? 's' : '' }}{{ $room->max_children ? ', ' . $room->max_children . ' Child' . ($room->max_children > 1 ? 'ren' : '') : '' }}</strong>
                            </div>
                            @if($room->bed_type)
                              <div class="hw-meta-item">
                                <small>Bed</small>
                                <strong>{{ $room->bed_type }}</strong>
                              </div>
                            @endif
                            @if($room->room_size)
                              <div class="hw-meta-item hw-meta-item--right">
                                <small>Room Size</small>
                                <strong>{{ $room->room_size }}</strong>
                              </div>
                            @endif
                          </div>

                          @if($room->description)
                            <p>{!! nl2br(e($room->description)) !!}</p>
                          @endif

                          @if($roomImgs->isNotEmpty())
                            <div class="hw-gallery">
                              <a href="{{ $roomImgs->first() }}" data-fancybox="room-{{ $room->id }}" class="hw-gallery-main">
                                <img loading="lazy" src="{{ $roomImgs->first() }}" alt="{{ $room->name }} at {{ $hotel->name }}" />
                              </a>

                              @foreach($roomThumbs as $thumb)
                                @php $isLastThumb = $loop->last && $roomRemaining > 0; @endphp
                                <a href="{{ $thumb }}" data-fancybox="room-{{ $room->id }}"
                                  class="hw-thumb {{ $isLastThumb ? 'hw-thumb--more' : '' }}">
                                  <img loading="lazy" src="{{ $thumb }}" alt="" />
                                  @if($isLastThumb)
                                    <div class="hw-more-overlay">
                                      <span>View all</span>
                                      <strong>({{ $roomImgs->count() }})</strong>
                                    </div>
                                  @endif
                                </a>
                              @endforeach

                              {{-- remaining photos stay in the lightbox group --}}
                              @foreach($roomImgs->slice(7) as $extra)
                                <a href="{{ $extra }}" data-fancybox="room-{{ $room->id }}" style="display:none;"></a>
                              @endforeach
                            </div>
                          @endif

                          @if(!empty($room->amenities))
                            <div class="tab-block" style="padding-left:0;padding-right:0;">
                              <h6>Room Amenities</h6>
                              <ul class="check-list">
                                @foreach($room->amenities as $amenity)
                                  <li>
                                    <span class="check-icon">
                                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 12l2 2 4-4" />
                                        <circle cx="12" cy="12" r="10" />
                                      </svg>
                                    </span>
                                    {{ $amenity }}
                                  </li>
                                @endforeach
                              </ul>
                            </div>
                          @endif

                          <div class="trip-price">
                            @if($room->old_price)
                              <span class="trip-price__old">₹{{ number_format($room->old_price) }}</span>
                            @endif
                            @if($room->price)
                              <span class="trip-price__now">
                                ₹{{ number_format($room->price) }}
                                <small>{{ $room->price_unit }}{{ $room->tax_note ? ' · ' . $room->tax_note : '' }}</small>
                              </span>
                            @else
                              <span class="trip-price__now"><small>Price on request</small></span>
                            @endif
                          </div>

                          <a href="javascript:void(0)" class="btn btn-primary js-enquire-room" data-room="{{ $room->name }}"
                            style="margin-top:14px;">
                            Enquire About This Room
                          </a>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif

              {{-- ============ FACILITIES ============ --}}
              @if($facilities->isNotEmpty())
                <div class="tab-block" id="facilities">
                  <h6>Hotel Facilities & Amenities</h6>
                  <ul class="check-list">
                    @foreach($facilities as $facility)
                      <li>
                        <span class="check-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 12l2 2 4-4" />
                            <circle cx="12" cy="12" r="10" />
                          </svg>
                        </span>
                        {{ $facility }}
                      </li>
                    @endforeach
                  </ul>
                </div>
              @endif

              {{-- ============ CHECK-IN / CHECK-OUT ============ --}}
              @if($checkIn || $checkOut)
                <div class="tab-block" id="timings">
                  <h6>Check-in & Check-out</h6>
                  <div class="hw-meta">
                    <div class="hw-meta-item">
                      <small>Check In</small>
                      <strong>{{ $checkIn ?? '—' }}</strong>
                    </div>
                    <div class="hw-meta-item hw-meta-item--right">
                      <small>Check Out</small>
                      <strong>{{ $checkOut ?? '—' }}</strong>
                    </div>
                  </div>
                </div>
              @endif

              {{-- ============ MAP ============ --}}
              @if($hotel->map_embed_url || $hotel->address)
                <div class="map" id="map">
                  <div class="heading">
                    <h6>Where is {{ $hotel->name }}?</h6>
                  </div>

                  @if($hotel->map_embed_url)
                    <div class="map_wrap">
                      <iframe src="{{ $hotel->map_embed_url }}" width="100%" height="450" style="border: 0"
                        allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    </div>
                  @endif

                  @if($hotel->address)
                    <p style="margin-top:14px;">{{ $hotel->address }}</p>
                  @endif

                  @if($mapPoints->isNotEmpty())
                    <ul class="check-list" style="margin-top:10px;">
                      @foreach($mapPoints as $point)
                        <li>
                          <span class="check-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                              stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                              <path d="M9 12l2 2 4-4" />
                              <circle cx="12" cy="12" r="10" />
                            </svg>
                          </span>
                          {{ $point }}
                        </li>
                      @endforeach
                    </ul>
                  @endif

                  @if($hotel->map_directions_url)
                    <a href="{{ $hotel->map_directions_url }}" target="_blank" rel="noopener"
                      class="btn btn-outline-primary" style="margin-top:14px;">Get Directions</a>
                  @endif
                </div>
              @endif
            </div>
          </div>

          <!-- ENQUIRY CARD -->
          <div class="quote-card">
            <div class="quote-card__accent"></div>

            <div class="quote-card__head">
              <h3 class="quote-card__title">Enquire About This Stay</h3>
              @if($minPrice)
                <div class="quote-card__price">
                  <span class="quote-card__now">₹{{ number_format($minPrice) }}</span>
                  <span class="quote-card__old" style="text-decoration:none;">per night, from</span>
                </div>
              @endif
            </div>

            <form id="enquiryForm" action="{{ route('hotel.enquiry.store') }}" method="POST">
              @csrf
              <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

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
                  <label class="field__label">Stay Dates<span>*</span></label>
                </div>
                <div class="field" style="margin-bottom: 0">
                  <input type="number" min="1" name="traveller_count" placeholder=" " class="field__input" required />
                  <label class="field__label">Guests<span>*</span></label>
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

  </main>

@endsection

@push('scripts')
  @php
    $breadcrumbItems = [
      ['name' => 'Home', 'url' => url('/')],
      ['name' => $hotel->name, 'url' => url()->current()],
    ];

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
          '@type' => 'Hotel',
          '@id' => url()->current() . '#hotel',
          'name' => $hotel->name,
          'description' => $metaDesc,
          'url' => url()->current(),
          'image' => $galleryUrls->take(5)->all() ?: null,
          'address' => $hotel->address ? array_filter([
            '@type' => 'PostalAddress',
            'streetAddress' => $hotel->address,
            'addressLocality' => $hotel->city->name ?? null,
            'addressRegion' => $hotel->state->name ?? null,
            'addressCountry' => $hotel->country->name ?? null,
          ]) : null,
          'starRating' => $starCount ? ['@type' => 'Rating', 'ratingValue' => $starCount] : null,
          'checkinTime' => $hotel->check_in_time ? \Carbon\Carbon::parse($hotel->check_in_time)->format('H:i') : null,
          'checkoutTime' => $hotel->check_out_time ? \Carbon\Carbon::parse($hotel->check_out_time)->format('H:i') : null,
          'amenityFeature' => $facilities->map(fn($f) => ['@type' => 'LocationFeatureSpecification', 'name' => $f, 'value' => true])->values()->all() ?: null,
          'priceRange' => $minPrice ? 'From INR ' . number_format($minPrice) : null,
        ]),
      ],
    ];
  @endphp

  <script type="application/ld+json">
    {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}
  </script>

  <script>
    // Room accordion (same behaviour as the tour package "Hotel Details" block)
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

    // Section nav (click to scroll + highlight on scroll)
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

    // "Enquire About This Room" -> scroll to the enquiry card and pre-fill the message
    $(function () {
      $(".js-enquire-room").on("click", function () {
        var room = $(this).data("room");
        var $form = $("#enquiryForm");
        var $msg = $form.find('textarea[name="message"]');

        $msg.val("I'm interested in the " + room + " at " + @json($hotel->name) + ".");
        $("html, body").animate({ scrollTop: $form.closest(".quote-card").offset().top - $("header").outerHeight() - 20 }, 500);
        $form.find('input[name="full_name"]').trigger("focus");
      });
    });

    // Enquiry form
    $(function () {
      var csrfToken = $('meta[name="csrf-token"]').attr('content');

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
            if (res.redirect) {
              window.location.href = res.redirect;   // thank-you page, same as the quick enquiry popup
              return;
            }
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