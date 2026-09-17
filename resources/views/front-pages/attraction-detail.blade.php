@extends('layouts.app')

@section('title', ($attraction->meta_title ?: $attraction->h1 ?: $attraction->name) . ' | Indo Tours & Adventures')
@section('meta_description', $attraction->meta_description ?: $attraction->short_description)
@section('canonical', $attraction->canonical_url ?: url()->current())
@section('robots', $attraction->robots ?: 'index, follow')

@section('og_title', $attraction->og_title ?: $attraction->meta_title ?: $attraction->name)
@section('og_description', $attraction->og_description ?: $attraction->meta_description ?: $attraction->short_description)
@section('og_image', asset('storage/' . ($attraction->og_image ?: $attraction->image)))

@section('twitter_title', $attraction->og_title ?: $attraction->meta_title ?: $attraction->name)
@section('twitter_description', $attraction->og_description ?: $attraction->meta_description ?: $attraction->short_description)
@section('twitter_image', asset('storage/' . ($attraction->twitter_card_image ?: $attraction->og_image ?: $attraction->image)))

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/attraction-detail/detail.css') }}" />
@endpush

@section('content')

  <main>

    {{--attraction detail banner--}}
    <section class="detail-banner">
      <div class="container">
        <div class="grid">
          @php
            $galleries = $attraction->galleries;
            $mainGalleries = $galleries->take(4);
            $remainingCount = max($galleries->count() - 4, 0);
          @endphp

          @foreach($mainGalleries as $index => $gallery)
            <a href="{{ asset('storage/' . $gallery->image) }}" data-fancybox="gallery{{ $index + 1 }}" class="item">
              <img loading="lazy" src="{{ asset('storage/' . $gallery->image) }}"
                alt="{{ $gallery->title ?: $attraction->name }}" />
              @if($gallery->title || $gallery->subtitle)
                <div class="image-overlay">
                  @if($gallery->title)
                  <h3>{{ $gallery->title }}</h3>@endif
                  @if($gallery->subtitle)<span>{{ $gallery->subtitle }}</span>@endif
                </div>
              @endif
            </a>
          @endforeach

          @if($remainingCount > 0)
            @php $fifthImage = $galleries->get(4); @endphp
            <a href="{{ asset('storage/' . $fifthImage->image) }}" data-fancybox="gallery5" class="item more-images">
              <img loading="lazy" src="{{ asset('storage/' . $fifthImage->image) }}"
                alt="{{ $attraction->name }} Gallery" />
              <div class="image-overlay">
                <strong>{{ $remainingCount }}+</strong>
                <span>More Attractions</span>
              </div>
            </a>

            {{-- gallery_more: same group id, aggregates every image so "+N More" can browse the full set --}}
            @foreach($galleries as $extra)
              <a href="{{ asset('storage/' . $extra->image) }}" data-fancybox="gallery5"></a>
            @endforeach
          @endif
        </div>
        <div class="detail_content">
          <ul class="Breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('attractions') }}">Attractions</a></li>
            @if($attraction->country)
              <li><a href="javascript:void()">{{ $attraction->country->name }}</a></li>
            @endif
            @if($attraction->state)
              <li><a href="javascript:void()">{{ $attraction->state->name }}</a></li>
            @endif
          </ul>

          <div class="info-row">
            <div class="info-left">
              <h1 class="title">{{ $attraction->h1 ?: $attraction->name }}</h1>
              <p class="location">
                {{ $attraction->country?->name }}
                @if($attraction->state)
                  <span>·</span> {{ $attraction->state->name }}
                @endif
              </p>

              <div class="rating">
                <span class="stars">★★★★★</span>
                4.8/5 <span class="count">· 124 Reviews</span>
              </div>

              <p class="desc">
                {{ $attraction->description }}
              </p>
            </div>

            <div class="info-right">
              <div class="facts">
                @if($attraction->best_time_text)
                  <div class="facts-item">
                    <span class="label">Best Time</span>
                    <span class="value">{{ $attraction->best_time_text }}</span>
                  </div>
                @endif
                @if($attraction->duration_text)
                  <div class="facts-item">
                    <span class="label">Stay</span>
                    <span class="value">{{ $attraction->duration_text }}</span>
                  </div>
                @endif
                @if(!empty($attraction->best_for_tags))
                  <div class="facts-item">
                    <span class="label">Ideal For</span>
                    <div class="tags">
                      @foreach($attraction->best_for_tags as $tag)
                        <span>{{ $tag }}</span>
                      @endforeach
                    </div>
                  </div>
                @endif
              </div>

              <div class="actions">
                <button class="btn btn-outline-primary" type="button">
                  ＋ Add to My Trip
                </button>
                <button class="btn btn-primary" type="button">
                  Plan Trip
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- PACKAGE SECTION --}}
    @if($attraction->tourPackages->isNotEmpty())
      <section class="tour-package-near-h1">
        <div class="container">
          <div class="heading">
            <h3>{{ $attraction->name }} <span>Tour Packages</span></h3>
            <p>
              Handpicked itineraries to help you plan the perfect {{ $attraction->name }} trip.
            </p>
          </div>

          <div class="swiper-wrap">
            <div class="swiper thirdSilder">
              <div class="swiper-wrapper">
                @foreach($attraction->tourPackages as $package)
                  <div class="swiper-slide">
                    <div class="trip_card">
                      <a href="{{ route('tourpackage.show', $package->slug) }}" target="_blank" class="img">
                        @if($package->main_image)
                          <img loading="lazy" src="{{ asset('storage/' . $package->main_image) }}" alt="{{ $package->name }}" />
                        @endif
                        @if($package->old_price && $package->price && $package->old_price > $package->price)
                          <span class="save">Save INR
                            {{ number_format($package->old_price - $package->price) }}</span>
                        @endif
                      </a>

                      <div class="content">
                        <div class="rating">
                          @if($package->duration_text)
                            <span>{{ $package->duration_text }}</span>
                          @endif

                          @if($package->rating)
                            <div class="star">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                              </svg>
                              <span>{{ $package->rating }}</span>
                              @if($package->review_count)
                                <em>({{ $package->review_count }})</em>
                              @endif
                            </div>
                          @endif
                        </div>

                        <h3>
                          <a href="{{ route('tourpackage.show', $package->slug) }}" target="_blank">
                            {{ $package->name }}
                          </a>
                        </h3>

                        @if($package->old_price && $package->price && $package->old_price > $package->price)
                          <div class="innerSave">
                            <s>INR {{ number_format($package->old_price) }}</s>
                            <span class="saveChip">Save INR
                              {{ number_format($package->old_price - $package->price) }}</span>
                          </div>
                        @endif

                        @if($package->price)
                          <p class="price">INR {{ number_format($package->price) }}</p>
                        @endif

                        <div class="btns">
                          <a href="tel:+91 000 000 000" class="btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                              stroke-width="1.5" stroke-linejoin="round">
                              <path
                                d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                            </svg>
                          </a>
                          <button data-model=".enquire-pop" data-package-id="{{ $package->id }}" class="btn btn-primary">
                            Enquire Now
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
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
    @endif

    {{--attraction detail section--}}
    <section class="detail-secA">
      <div class="grid">
        <div class="img">
          <img loading="lazy" src="{{ asset('storage/' . ($attraction->about_image ?: $attraction->image)) }}"
            alt="{{ $attraction->name }}" />
          <span class="img__tag">{{ $attraction->name }}</span>
        </div>

        <div class="item-content">
          <div class="heading">
            <h3>About <span>{{ $attraction->name }}</span></h3>
          </div>

          {!! $attraction->about_content !!}

          <div class="info-row">
            @php $locationParts = array_filter([$attraction->state?->name, $attraction->country?->name]); @endphp

            @if(!empty($locationParts))
              <div class="info-item">
                <div class="icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <g fill="none">
                      <path
                        d="M12 2a8 8 0 0 1 8 8c0 6.5-8 12-8 12s-8-5.5-8-12a8 8 0 0 1 8-8m0 5a3 3 0 1 0 0 6a3 3 0 0 0 0-6"
                        clip-rule="evenodd" />
                      <path stroke="currentColor" stroke-width="2" d="M20 10c0 6.5-8 12-8 12s-8-5.5-8-12a8 8 0 1 1 16 0Z" />
                      <path stroke="currentColor" stroke-width="2" d="M15 10a3 3 0 1 1-6 0a3 3 0 0 1 6 0Z" />
                    </g>
                  </svg>
                </div>
                <div>
                  <span class="label">Location</span>
                  <span class="value">{{ implode(', ', $locationParts) }}</span>
                </div>
              </div>
            @endif

            @if($attraction->best_time_text)
              <div class="info-item">
                <div class="icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path fill="currentColor" fill-rule="evenodd"
                      d="M2 12c0 5.515 4.485 10 10 10s10-4.485 10-10S17.515 2 12 2S2 6.485 2 12m1.5 0c0-4.685 3.815-8.5 8.5-8.5s8.5 3.815 8.5 8.5s-3.815 8.5-8.5 8.5s-8.5-3.815-8.5-8.5m7.75.31l3.47 3.47l1.06-1.06l-3.03-3.03V6.495h-1.5z"
                      clip-rule="evenodd" />
                  </svg>
                </div>
                <div>
                  <span class="label">Best Time</span>
                  <span class="value">{{ $attraction->best_time_text }}</span>
                </div>
              </div>
            @endif

            @if($attraction->duration_text)
              <div class="info-item">
                <div class="icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <g fill="none">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M7.667 3.667V1m8.666 2.667V1" />
                      <rect width="18" height="16.667" x="3" y="3.667" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="1.5" rx="2.667" ry="2.667" />
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 8.333h18" />
                      <path fill="currentColor"
                        d="M12 11c-.735 0-1.333.599-1.333 1.333s.598 1.334 1.333 1.334s1.333-.6 1.333-1.334S12.735 11 12 11m4.667 2.667c.734 0 1.333-.6 1.333-1.334S17.4 11 16.667 11s-1.334.599-1.334 1.333s.599 1.334 1.334 1.334M12 15c-.735 0-1.333.599-1.333 1.333s.598 1.334 1.333 1.334s1.333-.6 1.333-1.334S12.735 15 12 15m-4.667 0C6.6 15 6 15.599 6 16.333s.599 1.334 1.333 1.334s1.334-.6 1.334-1.334S8.067 15 7.333 15m9.334 0c-.735 0-1.334.599-1.334 1.333s.599 1.334 1.334 1.334S18 17.067 18 16.333S17.4 15 16.667 15" />
                    </g>
                  </svg>
                </div>
                <div>
                  <span class="label">Recommended Duration</span>
                  <span class="value">{{ $attraction->duration_text }}</span>
                </div>
              </div>
            @endif

            @if(!empty($attraction->best_for_tags))
              <div class="info-item">
                <div class="icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path fill="currentColor"
                      d="M2.596 18.616v-1.647q0-.696.36-1.197q.361-.5.97-.8q1.301-.62 2.584-.988q1.282-.368 3.086-.368t3.087.368t2.584.988q.608.3.969.8q.36.501.36 1.197v1.647zm16 0v-1.693q0-.87-.352-1.641q-.351-.772-.998-1.324q.737.15 1.42.416q.682.267 1.35.599q.65.327 1.019.837t.369 1.113v1.693zM7.473 10.508q-.877-.877-.877-2.123t.877-2.123t2.123-.877t2.123.877t.877 2.123t-.877 2.123t-2.123.877t-2.123-.877m8.511 0q-.881.877-2.118.877q-.064 0-.162-.015t-.162-.031q.509-.623.781-1.382q.273-.758.273-1.575t-.285-1.56q-.286-.745-.769-1.391q.081-.029.162-.038t.162-.009q1.237 0 2.118.877t.882 2.123t-.882 2.124M3.596 17.616h12v-.647q0-.352-.176-.615t-.632-.504q-1.119-.598-2.36-.916t-2.832-.318t-2.833.318q-1.24.318-2.36.916q-.455.24-.631.504q-.176.263-.176.615zm7.413-7.819q.587-.587.587-1.412t-.587-1.413t-1.413-.587t-1.412.587t-.588 1.413t.588 1.412t1.412.588t1.413-.588M9.596 8.385" />
                  </svg>
                </div>
                <div>
                  <span class="label">Best For</span>
                  <span class="value">{{ implode(', ', $attraction->best_for_tags) }}</span>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </section>

    {{-- highlights section --}}
    <section class="detail-secB">
      <div class="container">
        <div class="heading">
          <h3>Why Visit <span>{{ $attraction->name }}?</span></h3>
          <p>Where breathtaking landscapes meet unforgettable experiences.</p>
        </div>

        <div class="grid">
          @foreach($attraction->highlights as $highlight)
            <div class="card">
              <div class="icon">
                @if($highlight->icon)
                  <img loading="lazy" src="{{ asset('storage/' . $highlight->icon) }}" alt="{{ $highlight->title }}" />
                @endif
              </div>
              <h4>{{ $highlight->title }}</h4>
              <p>{{ $highlight->description }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    {{-- experiences section --}}
    <section class="detail-secC">
      <div class="container">
        <div class="heading">
          <h3>Experiences to <span>Explore</span></h3>
          <p>Discover the best experiences and adventures {{ $attraction->name }} has to offer.</p>
        </div>

        <div class="grid">
          @foreach($attraction->experiences as $index => $experience)
            <a href="javascript:void()" class="card">
              <div class="card__img">
                @if($experience->image)
                  <img loading="lazy" src="{{ asset('storage/' . $experience->image) }}" alt="{{ $experience->title }}" />
                @endif
                <span class="num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                @if($experience->duration_text)
                  <span class="duration">{{ $experience->duration_text }}</span>
                @endif
              </div>
              <div class="card__body">
                <h4>{{ $experience->title }}</h4>
                <p>{{ $experience->description }}</p>
                <button class="btn btn-outline-primary" type="button">
                  Enquire Now
                </button>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </section>

    {{-- places to visit section --}}
    <section class="detail-secE">
      <div class="container">
        <div class="heading">
          <h3>Places to <span>Visit in {{ $attraction->name }}</span></h3>
          <p>Handpicked destinations across the area, each with its own character.</p>
        </div>

        <div class="swiper-wrap">
          <div class="swiper placesSlider">
            <div class="swiper-wrapper">
              @foreach($attraction->places as $place)
                <div class="swiper-slide">
                  <a href="javascript:void()" class="place-card">
                    <div class="place-card__image">
                      @if($place->image)
                        <img loading="lazy" src="{{ asset('storage/' . $place->image) }}" alt="{{ $place->title }}" />
                      @endif
                      @if($place->tag)
                        <span class="place-card__tag">{{ $place->tag }}</span>
                      @endif
                    </div>

                    <div class="place-card__body">
                      <h5>{{ $place->title }}</h5>
                      <p>{{ $place->description }}</p>
                      <span class="btn btn-outline-white">
                        {{ $place->button_text ?: 'Explore ' . $place->title }}
                      </span>
                    </div>
                  </a>
                </div>
              @endforeach
            </div>
          </div>

          <div class="swiper-group">
            <button type="button" class="placesSlider-prev btn-prev" aria-label="Previous places">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                <path fill="#fff"
                  d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0">
                </path>
              </svg>
            </button>
            <button type="button" class="placesSlider-next btn-next" aria-label="Next places">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                <path fill="#fff"
                  d="M414.592 149.376L746.24 489.6a32 32 0 0 1 0 44.672L414.592 874.624a29.12 29.12 0 0 1-41.728 0a30.59 30.59 0 0 1 0-42.752l311.872-319.936L372.864 192.064a30.59 30.59 0 0 1 0-42.688a29.12 29.12 0 0 1 41.728 0">
                </path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </section>

    {{-- itineraries section --}}
    <section class="detail-secD">
      <div class="container">
        <div class="heading">
          <h3>How Many Days <span> Do You Need?</span></h3>
          <p>This is especially useful for your website — pick a pace and we'll build the route.</p>
        </div>

        <div class="grid">
          @foreach($attraction->itineraries as $itinerary)
            <div class="plan-card {{ $itinerary->is_popular ? 'is-popular' : '' }}">
              <div class="plan-card__days">
                <span class="num">{{ $itinerary->days }}</span>
                <span class="label">Days</span>
              </div>
              <h4>{{ $itinerary->title }}</h4>
              <div class="route">
                @foreach($itinerary->stops as $index => $stop)
                  <span>{{ $stop->stop_name }}</span>
                  @if(!$loop->last)
                    <span class="arrow">→</span>
                  @endif
                @endforeach
              </div>
            </div>
          @endforeach
        </div>

        <div class="cta">
          <p>Pick a plan above, or customize every stop yourself.</p>
          <button class="btn btn-primary" type="button">
            Build My {{ $attraction->name }} Trip
          </button>
        </div>
      </div>
    </section>

    {{-- OFFER BANNER --}}
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
              {{ $attraction->offer_badge_text ?: 'Limited-Time Offer' }}
            </span>

            <h3>{{ $attraction->offer_title ?: 'Book Your ' . $attraction->name . ' Trip Early — Save Up to 40%' }}</h3>

            <p>
              {{ $attraction->offer_description ?: 'Grab early-booking discounts, seasonal deals and free add-on experiences before this offer ends.' }}
            </p>

            @php
              $perks = !empty($attraction->offer_perks) ? $attraction->offer_perks : [
                'Early Bird Discount up to 40% Off',
                'Free Airport Transfers Included',
                'Flexible Rescheduling on Select Packages',
              ];
            @endphp

            <ul class="group-offer-banner__perks">
              @foreach($perks as $perk)
                <li>{{ $perk }}</li>
              @endforeach
            </ul>

            <div class="group-offer-banner__actions">
              <a href="{{ $attraction->offer_button_url ?? '' }}" class="btn btn-white">
                {{ $attraction->offer_button_text ?: 'Explore Packages' }}
              </a>
              <a href="javascript:void()" data-model=".enquire-pop" class="btn btn-outline-white">
                Get A Quote
              </a>
            </div>
          </div>

          <div class="group-offer-banner__media">
            <div class="group-offer-banner__img group-offer-banner__img--secondary">
              <img loading="lazy" src="{{ asset('storage/' . ($attraction->offer_image ?: $attraction->image)) }}"
                alt="Travellers enjoying their trip" />
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- TRAVEL INFO --}}
    @if($attraction->seasons->isNotEmpty() || $attraction->transports->isNotEmpty() || $attraction->budgetTiers->isNotEmpty() || $attraction->carryGroups->isNotEmpty())
      <section class="detail-secF">
        <div class="container">
          <div class="heading">
            <h3>{{ $attraction->name }} <span>Travel Information</span></h3>
            <p>
              Everything you need to plan the practical side of your trip —
              season, transport, budget and what to pack.
            </p>
          </div>

          <!-- 1. Best Time to Visit -->
          @if($attraction->seasons->isNotEmpty())
            <div class="season-strip">
              <div class="season-strip__label">
                <div class="icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path fill="#114c9e"
                      d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3m1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z" />
                  </svg>
                </div>
                <h4>Best Time to Visit</h4>
              </div>

              <div class="season-grid">
                @foreach($attraction->seasons as $season)
                  <div class="season-card {{ $season->is_active ? 'is-active' : '' }}">
                    @if($season->months)
                      <span class="season-card__months">{{ $season->months }}</span>
                    @endif
                    <h5>{{ $season->title }}</h5>
                    @if($season->description)
                      <p>{{ $season->description }}</p>
                    @endif
                    @if(!empty($season->tags))
                      <div class="tags">
                        @foreach($season->tags as $tag)
                          <span>{{ $tag }}</span>
                        @endforeach
                      </div>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- 2. How to Reach -->
          @if($attraction->transports->isNotEmpty())
            <div class="reach-block">
              <div class="reach-block__label">
                <div class="icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15">
                    <path d="M0 0h15v15H0z" fill="none" />
                    <path fill="#114c9e"
                      d="M14.5 6.497h.5v-.139l-.071-.119zm-14 0l-.429-.258L0 6.36v.138zm2.126-3.541l-.429-.258zm9.748 0l.429-.258zM3.5 11.5V11H3v.5zm8 0h.5V11h-.5zM14 6.497V12.5h1V6.497zM.929 6.754l2.126-3.54l-.858-.516L.071 6.24zM5.198 2h4.604V1H5.198zm6.747 1.213l2.126 3.541l.858-.515l-2.126-3.54zM2.5 13h-1v1h1zm.5-1.5v1h1v-1zM13.5 13h-1v1h1zm-1.5-.5v-1h-1v1zm-.5-1.5h-8v1h8zM1 12.5V6.497H0V12.5zm11.5.5a.5.5 0 0 1-.5-.5h-1a1.5 1.5 0 0 0 1.5 1.5zm-10 1A1.5 1.5 0 0 0 4 12.5H3a.5.5 0 0 1-.5.5zm-1-1a.5.5 0 0 1-.5-.5H0A1.5 1.5 0 0 0 1.5 14zM9.802 2a2.5 2.5 0 0 1 2.143 1.213l.858-.515A3.5 3.5 0 0 0 9.802 1zM3.055 3.213A2.5 2.5 0 0 1 5.198 2V1a3.5 3.5 0 0 0-3 1.698zM14 12.5a.5.5 0 0 1-.5.5v1a1.5 1.5 0 0 0 1.5-1.5zM2 10h3V9H2zm11-1h-3v1h3zM3 7h9V6H3z" />
                  </svg>
                </div>
                <h4>How to Reach</h4>
              </div>

              <div class="ticket-grid">
                @foreach($attraction->transports as $transport)
                  <div class="ticket">
                    <div class="ticket__top">
                      <div class="mode-icon">
                        @if($transport->mode_type === 'train')
                          <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path fill="#114c9e"
                              d="M5 15.116V6q0-.979.563-1.574t1.524-.912T9.322 3.1T12 3q1.458 0 2.728.099t2.223.413t1.501.911T19 6v9.116q0 1.205-.84 2.045q-.839.839-2.044.839l1.5 1.5v.5h-.847l-2-2H9.231l-2 2h-.846v-.5l1.5-1.5q-1.206 0-2.045-.84Q5 16.322 5 15.116M6 11h5.5V6.539H6zm6.5 0H18V6.539h-5.5zm-3.204 4.3q.32-.314.32-.796q0-.481-.315-.8t-.796-.32t-.801.315t-.32.796t.315.801t.797.32t.8-.315m7 0q.32-.315.32-.796t-.315-.801t-.796-.32t-.801.315t-.32.796t.315.801t.796.32t.801-.315" />
                          </svg>
                        @else
                          <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path fill="#114c9e"
                              d="M20.56 3.91c.59.59.59 1.54 0 2.12l-3.89 3.89l2.12 9.19l-1.41 1.42l-3.88-7.43L9.6 17l.36 2.47l-1.07 1.06l-1.76-3.18l-3.19-1.77L5 14.5l2.5.37L11.37 11L3.94 7.09l1.42-1.41l9.19 2.12l3.89-3.89c.56-.58 1.56-.58 2.12 0" />
                          </svg>
                        @endif
                      </div>
                      <div>
                        <p class="mode-name">{{ $transport->mode_name }}</p>
                        @if($transport->mode_sub)
                          <p class="mode-sub">{{ $transport->mode_sub }}</p>
                        @endif
                      </div>
                    </div>
                    @if($transport->description)
                      <div class="ticket__divider"></div>
                      <div class="ticket__body">
                        <p>{{ $transport->description }}</p>
                      </div>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- 3. Estimated Budget -->
          @if($attraction->budgetTiers->isNotEmpty())
            <div class="budget-block">
              <div class="budget-block__label">
                <div class="icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <g fill="#114c9e">
                      <path
                        d="M19 12C19 12.5523 18.5523 13 18 13C17.4477 13 17 12.5523 17 12C17 11.4477 17.4477 11 18 11C18.5523 11 19 11.4477 19 12Z" />
                      <path fill-rule="evenodd"
                        d="M9.94358 3.25H13.0564C14.8942 3.24998 16.3498 3.24997 17.489 3.40314C18.6614 3.56076 19.6104 3.89288 20.3588 4.64124C21.2831 5.56563 21.5777 6.80363 21.6847 8.41008C22.2619 8.6641 22.6978 9.2013 22.7458 9.88179C22.7501 9.94199 22.75 10.0069 22.75 10.067C22.75 10.0725 22.75 10.0779 22.75 10.0833V13.9167C22.75 13.9221 22.75 13.9275 22.75 13.933C22.75 13.9931 22.7501 14.058 22.7458 14.1182C22.6978 14.7987 22.2619 15.3359 21.6847 15.5899C21.5777 17.1964 21.2831 18.4344 20.3588 19.3588C19.6104 20.1071 18.6614 20.4392 17.489 20.5969C16.3498 20.75 14.8942 20.75 13.0564 20.75H9.94359C8.10583 20.75 6.65019 20.75 5.51098 20.5969C4.33856 20.4392 3.38961 20.1071 2.64124 19.3588C1.89288 18.6104 1.56076 17.6614 1.40314 16.489C1.24997 15.3498 1.24998 13.8942 1.25 12.0564V11.9436C1.24998 10.1058 1.24997 8.65019 1.40314 7.51098C1.56076 6.33856 1.89288 5.38961 2.64124 4.64124C3.38961 3.89288 4.33856 3.56076 5.51098 3.40314C6.65019 3.24997 8.10582 3.24998 9.94358 3.25ZM20.1679 15.75H18.2308C16.0856 15.75 14.25 14.1224 14.25 12C14.25 9.87756 16.0856 8.25 18.2308 8.25H20.1679C20.0541 6.90855 19.7966 6.20043 19.2981 5.7019C18.8749 5.27869 18.2952 5.02502 17.2892 4.88976C16.2615 4.75159 14.9068 4.75 13 4.75H10C8.09318 4.75 6.73851 4.75159 5.71085 4.88976C4.70476 5.02502 4.12511 5.27869 3.7019 5.7019C3.27869 6.12511 3.02502 6.70476 2.88976 7.71085C2.75159 8.73851 2.75 10.0932 2.75 12C2.75 13.9068 2.75159 15.2615 2.88976 16.2892C3.02502 17.2952 3.27869 17.8749 3.7019 18.2981C4.12511 18.7213 4.70476 18.975 5.71085 19.1102C6.73851 19.2484 8.09318 19.25 10 19.25H13C14.9068 19.25 16.2615 19.2484 17.2892 19.1102C18.2952 18.975 18.8749 18.7213 19.2981 18.2981C19.7966 17.7996 20.0541 17.0915 20.1679 15.75ZM5.25 8C5.25 7.58579 5.58579 7.25 6 7.25H10C10.4142 7.25 10.75 7.58579 10.75 8C10.75 8.41421 10.4142 8.75 10 8.75H6C5.58579 8.75 5.25 8.41421 5.25 8ZM20.9235 9.75023C20.9032 9.75001 20.8766 9.75 20.8333 9.75H18.2308C16.8074 9.75 15.75 10.8087 15.75 12C15.75 13.1913 16.8074 14.25 18.2308 14.25H20.8333C20.8766 14.25 20.9032 14.25 20.9235 14.2498C20.936 14.2496 20.9426 14.2495 20.9457 14.2493L20.9479 14.2492C21.1541 14.2367 21.2427 14.0976 21.2495 14.0139C21.2495 14.0139 21.2497 14.0076 21.2498 13.9986C21.25 13.9808 21.25 13.9572 21.25 13.9167V10.0833C21.25 10.0428 21.25 10.0192 21.2498 10.0014C21.2497 9.99238 21.2495 9.98609 21.2495 9.98609C21.2427 9.90242 21.1541 9.7633 20.9479 9.75076C20.9479 9.75076 20.943 9.75043 20.9235 9.75023Z"
                        clip-rule="evenodd" />
                    </g>
                  </svg>
                </div>
                <h4>Estimated Budget</h4>
              </div>

              <div class="pkg-grid">
                @foreach($attraction->budgetTiers as $tier)
                  <div class="pkg-card {{ $tier->is_recommended ? 'is-recommended' : '' }}">
                    <span class="pkg-card__tier">{{ $tier->tier_name }}</span>
                    @if($tier->price_range)
                      <p class="pkg-card__price">
                        {{ $tier->price_range }} <span>{{ $tier->price_unit ?: '/ day' }}</span>
                      </p>
                    @endif
                    @if($tier->note)
                      <p class="pkg-card__note">{{ $tier->note }}</p>
                    @endif
                    @if(!empty($tier->features))
                      <ul class="pkg-card__features">
                        @foreach($tier->features as $feature)
                          <li><span class="check">✓</span>{{ $feature }}</li>
                        @endforeach
                      </ul>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- 4. What to Carry -->
          @if($attraction->carryGroups->isNotEmpty())
            <div class="carry-block">
              <div class="carry-block__label">
                <div class="icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path fill="#114c9e"
                      d="M16 17q1.25 0 2.125.875T19 20t-.875 2.125T16 23q-.95 0-1.713-.55T13.176 21H8q-.825 0-1.412-.587T6 19V9q0-.825.588-1.412T8 7h6V4q-.825 0-1.412-.587T12 2h4zm-7 2V9H8v10zm2-10v10h2.175q.1-.375.325-.687t.5-.563V9zm6.063 12.063q.437-.438.437-1.063t-.437-1.062T16 18.5t-1.062.438T14.5 20t.438 1.063T16 21.5t1.063-.437M9 19V9zm2-10v10z" />
                  </svg>
                </div>
                <h4>What to Carry</h4>
              </div>

              <div class="carry-grid">
                @foreach($attraction->carryGroups as $group)
                  <div class="carry-group">
                    <p class="carry-group__title">{{ $group->title }}</p>
                    @if(!empty($group->items))
                      <ul>
                        @foreach($group->items as $item)
                          <li><span class="dot"></span>{{ $item }}</li>
                        @endforeach
                      </ul>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
          @endif
        </div>
      </section>
    @endif

    {{-- MAP SECTION --}}
    @if($attraction->map_location)
      <section class="detail-secG">
        <div class="container">
          <div class="heading">
            <h3>Where is <span>{{ $attraction->name }}?</span></h3>
            <p>
              Discover {{ $attraction->name }}’s location, surroundings, and the best gateway to
              the region.
            </p>
          </div>

          <div class="map-wrap">
            <iframe src="https://www.google.com/maps?q={{ urlencode($attraction->map_location) }}&output=embed"
              loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen>
            </iframe>
          </div>

          <div class="map-footer">
            <div class="map-location">
              <span class="pin"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                  <path d="M0 0h24v24H0z" fill="none" />
                  <g fill="none">
                    <path d="M12 2a8 8 0 0 1 8 8c0 6.5-8 12-8 12s-8-5.5-8-12a8 8 0 0 1 8-8m0 5a3 3 0 1 0 0 6a3 3 0 0 0 0-6"
                      clip-rule="evenodd" />
                    <path stroke="#114c9e" stroke-width="2" d="M20 10c0 6.5-8 12-8 12s-8-5.5-8-12a8 8 0 1 1 16 0Z" />
                    <path stroke="#114c9e" stroke-width="2" d="M15 10a3 3 0 1 1-6 0a3 3 0 0 1 6 0Z" />
                  </g>
                </svg>
              </span>
              <p>{{ $attraction->map_location }}</p>
            </div>

            <a href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode($attraction->map_location) }}"
              target="_blank" rel="noopener" class="btn btn-primary">
              Get Directions
            </a>
          </div>
        </div>
      </section>
    @endif

    {{-- APP PROMO --}}
    <section class="app-promo">
      <div class="container">
        <div class="app-promo-inner">
          <div class="app-promo-text">
            <span class="eyebrow">{{ $attraction->promo_eyebrow ?: 'Plan Your Trip' }}</span>
            <h3>{{ $attraction->promo_title ?: 'Ready to Explore ' . $attraction->name . '?' }}</h3>
            <p>
              {{ $attraction->promo_description ?: 'Create your personalized ' . $attraction->name . ' itinerary and discover the best places, experiences and attractions based on your travel style.' }}
            </p>

            <div class="cta-btns">
              <a href="{{ $attraction->promo_button_url ?? "" }}" class="sbmt btn btn-white">
                {{ $attraction->promo_button_text ?: 'Plan My ' . $attraction->name . ' Trip' }}
              </a>
              <a href="javascript:void(0)" data-model=".enquire-pop" class="btn btn-outline-white">
                Enquire Now
              </a>
            </div>
          </div>

          <div class="app-promo-visual">
            <div class="phone phone--back">
              <img loading="lazy" src="{{ asset('assets/icon/h3-destination-shape.png') }}" alt="App preview" />
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- RELATED PACKAGES --}}
    @if($relatedPackages->isNotEmpty())
      <section class="related-tour-package">
        <div class="container">
          <div class="heading">
            <h3>Related <span>Packages</span></h3>
            <p>
              Explore more tour packages combining {{ $attraction->name }} with nearby destinations.
            </p>
          </div>

          <div class="swiper-wrap">
            <div class="swiper thirdSilder">
              <div class="swiper-wrapper">
                @foreach($relatedPackages as $package)
                  <div class="swiper-slide">
                    <div class="trip_card">
                      <a href="{{ route('tourpackage.show', $package->slug) }}" target="_blank" class="img">
                        @if($package->main_image)
                          <img loading="lazy" src="{{ asset('storage/' . $package->main_image) }}" alt="{{ $package->name }}" />
                        @endif
                        @if($package->old_price && $package->price && $package->old_price > $package->price)
                          <span class="save">Save INR
                            {{ number_format($package->old_price - $package->price) }}</span>
                        @endif
                      </a>

                      <div class="content">
                        <div class="rating">
                          @if($package->duration_text)
                            <span>{{ $package->duration_text }}</span>
                          @endif

                          @if($package->rating)
                            <div class="star">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                              </svg>
                              <span>{{ $package->rating }}</span>
                              @if($package->review_count)
                                <em>({{ $package->review_count }})</em>
                              @endif
                            </div>
                          @endif
                        </div>

                        <h3>
                          <a href="{{ route('tourpackage.show', $package->slug) }}" target="_blank">
                            {{ $package->name }}
                          </a>
                        </h3>

                        @if($package->old_price && $package->price && $package->old_price > $package->price)
                          <div class="innerSave">
                            <s>INR {{ number_format($package->old_price) }}</s>
                            <span class="saveChip">Save INR
                              {{ number_format($package->old_price - $package->price) }}</span>
                          </div>
                        @endif

                        @if($package->price)
                          <p class="price">INR {{ number_format($package->price) }}</p>
                        @endif

                        <div class="btns">
                          <a href="tel:+91 000 000 000" class="btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                              stroke-width="1.5" stroke-linejoin="round">
                              <path
                                d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                            </svg>
                          </a>
                          <button data-model=".enquire-pop" data-package-id="{{ $package->id }}" class="btn btn-primary">
                            Enquire Now
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
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
    @endif

    {{-- RELATED ATTRACTIONS --}}
    @if($relatedAttractions->isNotEmpty())
      <section class="detail-secI">
        <div class="container">
          <div class="heading">
            <h3>Related <span>Attractions</span></h3>
            <p>
              Explore more beautiful destinations and unforgettable places worth
              adding to your journey.
            </p>
          </div>

          <div class="swiper-wrap">
            <div class="swiper fourSilder">
              <div class="swiper-wrapper">
                @foreach($relatedAttractions as $related)
                  <div class="swiper-slide">
                    <a href="{{ route('attraction.detail', $related) }}" class="journey_card">
                      <div class="img">
                        <img loading="lazy" src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" />
                      </div>

                      <div class="content">
                        <h5>{{ $related->name }}</h5>
                        <p>{{ $related->short_description }}</p>
                      </div>
                    </a>
                  </div>
                @endforeach
              </div>
            </div>

            <!-- Navigation -->
            <div class="swiper-group">
              <button type="button" class="fourSilder-prev btn-prev" aria-label="Previous attractions">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                  <path fill="#fff"
                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                </svg>
              </button>

              <button type="button" class="fourSilder-next btn-next" aria-label="Next attractions">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                  <path fill="#fff"
                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                </svg>
              </button>
            </div>
          </div>

          <!-- View All -->
          <div class="center-btn">
            <a href="{{ route('attractions') }}" class="btn btn-primary">
              Explore All Attractions
            </a>
          </div>
        </div>
      </section>
    @endif

    {{-- MORE ABOUT --}}
    @if($attraction->about_more_content)
      <section class="more-about">
        <div class="container">
          <div class="heading">
            <h3>More About <span>{{ $attraction->about_more_title ?: $attraction->name }}</span></h3>
            <p>Explore nearby places, activities and tour packages for your trip.</p>
          </div>

          <div class="rte-content">
            {!! $attraction->about_more_content !!}
          </div>
        </div>
      </section>
    @endif

    {{-- FAQ --}}
    @if($attraction->faqs->isNotEmpty())
      <section class="attraction_accordion">
        <div class="container">
          <div class="heading">
            <h3>Frequently Asked <span>Questions</span></h3>
          </div>

          <div class="accordion-wrapper">
            @foreach($attraction->faqs as $index => $faq)
              <div class="accordion-item">
                <div class="accordion-body">
                  <div class="accordion-header {{ $index === 0 ? 'active' : '' }}">
                    <h4>{{ $faq->question }}</h4>
                    <span class="accordion-icon">{{ $index === 0 ? '−' : '+' }}</span>
                  </div>
                  <div class="accordion-content">
                    <p>{{ $faq->answer }}</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
    @endif

  </main>

@endsection

@push('scripts')
    @php
        $breadcrumbItems = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Attractions', 'url' => route('attractions')],
        ];
        if ($attraction->country) {
            $breadcrumbItems[] = ['name' => $attraction->country->name, 'url' => url()->current()];
        }
        if ($attraction->state) {
            $breadcrumbItems[] = ['name' => $attraction->state->name, 'url' => url()->current()];
        }
        $breadcrumbItems[] = ['name' => $attraction->name, 'url' => url()->current()];

        $schema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => collect($breadcrumbItems)->map(fn($item, $i) => [
                        '@type' => 'ListItem',
                        'position' => $i + 1,
                        'name' => $item['name'],
                        'item' => $item['url'],
                    ])->values()->all(),
                ],
                [
                    '@type' => 'TouristAttraction',
                    '@id' => url()->current() . '#attraction',
                    'name' => $attraction->name,
                    'description' => $attraction->meta_description ?: $attraction->short_description,
                    'url' => url()->current(),
                    'image' => asset('storage/' . ($attraction->image ?: $attraction->about_image)),
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressLocality' => $attraction->city?->name,
                        'addressRegion' => $attraction->state?->name,
                        'addressCountry' => $attraction->country?->name,
                    ],
                    'aggregateRating' => $attraction->rating ? [
                        '@type' => 'AggregateRating',
                        'ratingValue' => $attraction->rating,
                        'reviewCount' => $attraction->review_count ?: 1,
                    ] : null,
                ],
            ],
        ];

        if ($attraction->faqs->isNotEmpty()) {
            $schema['@graph'][] = [
                '@type' => 'FAQPage',
                'mainEntity' => $attraction->faqs->map(fn($faq) => [
                    '@type' => 'Question',
                    'name' => $faq->question,
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq->answer],
                ])->values()->all(),
            ];
        }
    @endphp

    <script type="application/ld+json">
        {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush