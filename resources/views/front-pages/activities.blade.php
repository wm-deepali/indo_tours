@extends('layouts.app')

@section('title', 'Activities | Indo Tours & Adventures')
@section('meta_description', 'Indo Tours & Adventures is a leading travel company offering a wide range of tour packages, including domestic and international destinations. Explore the world with our expertly crafted itineraries and exceptional services.')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/activity/activity.css') }}" />
@endpush

@section('content')

  <main>

    @php
      $benefitIcons = [
        'star' => '<path d="M12 2l2.4 6.6L21 11l-6.6 2.4L12 20l-2.4-6.6L3 11l6.6-2.4z" />',
        'clock' => '<circle cx="12" cy="12" r="9" /><path d="M12 7v5l3 3" />',
        'check-circle' => '<path d="M9 12l2 2 4-4" /><circle cx="12" cy="12" r="9" />',
        'shield' => '<path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9" /><path d="M13.73 21a2 2 0 0 1-3.46 0" />',
        'heart' => '<path d="M12 21s-7-4.35-9.5-8.5C1 9 2.5 5.5 6 5c2-.3 3.5.7 4.5 2.2C11.5 5.7 13 4.7 15 5c3.5.5 5 4 3.5 7.5C19 16.65 12 21 12 21z" />',
        'thumbs-up' => '<path d="M7 22V11m0 11h10.5a2 2 0 0 0 2-1.7l1.4-8A2 2 0 0 0 19 9h-5l1-4.5A1.5 1.5 0 0 0 13.5 3L7 11" />',
        'gift' => '<rect x="3" y="8" width="18" height="13" rx="1" /><path d="M12 8V21M3 12h18M7.5 8a2.5 2.5 0 1 1 0-5C10 3 12 8 12 8s2-5 4.5-5a2.5 2.5 0 1 1 0 5" />',
        'headset' => '<path d="M3 18v-6a9 9 0 0 1 18 0v6" /><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z" />',
      ];
    @endphp

    <!-- HERO SECTION -->
    <section class="listing-banner">
      <div class="bg">
        <div class="swiper listSlider">
          <div class="swiper-wrapper">
            @forelse($landingPage->hero_slider_images ?? [] as $slide)
              <div class="swiper-slide">
                <img loading="lazy" src="{{ asset('storage/' . $slide['image']) }}" alt="{{ $slide['alt'] ?? '' }}" />
              </div>
            @empty
              <div class="swiper-slide">
                <img loading="lazy" src="{{ asset('assets/images/listing/default-hero.jpg') }}" alt="" />
              </div>
            @endforelse
          </div>
        </div>

        <div class="container">
          <nav class="breadcrumb breadcrumb-light" aria-label="Breadcrumb">
            <ul>
              <li><a href="/">Home</a></li>
              <li><span class="breadcrumb-separator">/</span></li>
              <li><a href="/activities/" class="active">Activities</a></li>
            </ul>
          </nav>

          <div class="bg-wrapper">
            <div class="content">
              @if($landingPage->hero_badge_text ?? null)
                <span class="offer-tag">{{ $landingPage->hero_badge_text }}</span>
              @endif

              <h1>{{ $landingPage->hero_heading ?? 'Best Activities' }}</h1>

              @if($landingPage->hero_description ?? null)
                <p>{{ $landingPage->hero_description }}</p>
              @endif

              @if($landingPage->hero_cta_text ?? null)
                <a href="{{ $landingPage->hero_cta_url ?: '#' }}" class="btn btn-primary">
                  {{ $landingPage->hero_cta_text }}
                  <i class="icon-arrow"></i>
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- INTRO SECTION -->
    <section class="activities-intro">
      <div class="container">
        <div class="heading">
          <h3>{{ $landingPage->intro_heading ?? 'Things to Do' }}</h3>
          @if($landingPage->intro_description ?? null)
            <p>{{ $landingPage->intro_description }}</p>
          @endif
        </div>
      </div>
    </section>

    <!-- INDIA TAB SECTION -->
    @include('front-pages.partials.activities-section', [
      'sectionId' => 'indian-activities-grid',
      'tabPrefix' => 'india',
      'heading' => 'Indian Activities',
      'eyebrow' => 'Explore Closer To Home',
      'activities' => $indianActivities,
      'categories' => $categories,
    ])

    <!-- PROMO OFFER SECTION -->
    <section class="listing-secG">
      <div class="container">
        <div class="grid">
          <div class="glow"></div>

          <div class="promo-left">
            @if($landingPage->offer_badge_text ?? null)
              <span class="promo-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                  <path d="M0 0h24v24H0z" fill="none" />
                  <g fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M10.594 2.319a3.26 3.26 0 0 1 2.812 0c.387.185.74.487 1.231.905l.078.066c.238.203.313.265.389.316c.193.13.41.219.637.264c.09.018.187.027.499.051l.101.008c.642.051 1.106.088 1.51.23a3.27 3.27 0 0 1 1.99 1.99c.142.404.178.868.23 1.51l.008.101c.024.312.033.41.051.499c.045.228.135.445.264.638c.051.075.113.15.316.388l.066.078c.419.49.72.844.905 1.23c.425.89.425 1.924 0 2.813c-.184.387-.486.74-.905 1.231l-.066.078a5 5 0 0 0-.316.389c-.13.193-.219.41-.264.637c-.018.09-.026.187-.051.499l-.009.101c-.05.642-.087 1.106-.23 1.51a3.26 3.26 0 0 1-1.989 1.99c-.404.142-.868.178-1.51.23l-.101.008a5 5 0 0 0-.499.051a1.8 1.8 0 0 0-.637.264a5 5 0 0 0-.39.316l-.077.066c-.49.419-.844.72-1.23.905a3.26 3.26 0 0 1-2.813 0c-.387-.184-.74-.486-1.231-.905l-.078-.066a5 5 0 0 0-.388-.316a1.8 1.8 0 0 0-.638-.264a5 5 0 0 0-.499-.051l-.101-.009c-.642-.05-1.106-.087-1.51-.23a3.26 3.26 0 0 1-1.99-1.989c-.142-.404-.179-.868-.23-1.51l-.008-.101a5 5 0 0 0-.051-.499a1.8 1.8 0 0 0-.264-.637a5 5 0 0 0-.316-.39l-.066-.077c-.418-.49-.72-.844-.905-1.23a3.26 3.26 0 0 1 0-2.813c.185-.387.487-.74.905-1.231l.066-.078a5 5 0 0 0 .316-.388c.13-.193.219-.41.264-.638c.018-.09.027-.187.051-.499l.008-.101c.051-.642.088-1.106.23-1.51a3.26 3.26 0 0 1 1.99-1.99c.404-.142.868-.179 1.51-.23l.101-.008a5 5 0 0 0 .499-.051c.228-.045.445-.135.638-.264c.075-.051.15-.113.388-.316l.078-.066c.49-.418.844-.72 1.23-.905"
                      clip-rule="evenodd" />
                    <path fill-rule="evenodd"
                      d="M15.543 8.457a.753.753 0 0 1 0 1.065l-6.021 6.02a.753.753 0 0 1-1.065-1.064l6.021-6.02a.753.753 0 0 1 1.065 0"
                      clip-rule="evenodd" />
                    <path
                      d="M15.512 14.509a1.004 1.004 0 1 1-2.007 0a1.004 1.004 0 0 1 2.007 0m-5.017-5.018a1.004 1.004 0 1 1-2.007 0a1.004 1.004 0 0 1 2.007 0" />
                  </g>
                </svg>
                {{ $landingPage->offer_badge_text }}
              </span>
            @endif

            <h3>{{ $landingPage->offer_heading ?? '' }}</h3>

            @if($landingPage->offer_description ?? null)
              <p>{{ $landingPage->offer_description }}</p>
            @endif

            @if($landingPage->offer_cta_text ?? null)
              <a href="{{ $landingPage->offer_cta_url ?: 'javascript:void()' }}" class="btn btn-promo">
                {{ $landingPage->offer_cta_text }}
                <i class="icon-arrow"></i>
              </a>
            @endif
          </div>

          @if($landingPage->offer_countdown_end ?? null)
            <div class="promo-right">
              <span class="countdown-label">Hurry, sale ends in</span>

              <div class="countdown" id="countdown" data-end="{{ $landingPage->offer_countdown_end->toIso8601String() }}">
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
          @endif
        </div>
      </div>
    </section>

    <!-- INTERNATIONAL TAB SECTION -->
    @include('front-pages.partials.activities-section', [
      'sectionId' => 'international-activities-grid',
      'tabPrefix' => 'intl',
      'heading' => 'International Activities',
      'eyebrow' => 'Handpicked For You',
      'activities' => $internationalActivities,
      'categories' => $categories,
    ])


    @if($featuredActivities->isNotEmpty())
      <section class="activities-featured">
        <div class="container">
          <div class="featured-head">
            <div class="heading">
              <h3>Top <span>Handpicked Experiences</span></h3>
              <p>
                A few of our most loved activities, chosen just for you.
              </p>
            </div>
          </div>

          <div class="activities-featured-grid">
            @foreach($featuredActivities as $activity)
              @include('front-pages.partials.activity-card', ['activity' => $activity])
            @endforeach
          </div>
        </div>
      </section>
    @endif

    <!-- GROUP OFFER BANNER -->
    <section class="group-offer-banner">
      <div class="container">
        <div class="group-offer-banner__inner">
          <div class="group-offer-banner__content">
            @if($landingPage->group_offer_badge_text ?? null)
              <span class="group-offer-banner__badge">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em">
                  <path d="M0 0h24v24H0z" fill="none" />
                  <path fill="currentColor"
                    d="M12 2l1.6 4.8L18 5l-1.8 4.4L21 12l-4.8 1.6L18 19l-4.4-1.8L12 22l-1.6-4.8L6 19l1.8-4.4L3 12l4.8-1.6L6 5l4.4 1.8z" />
                </svg>
                {{ $landingPage->group_offer_badge_text }}
              </span>
            @endif

            <h3>{{ $landingPage->group_offer_heading ?? '' }}</h3>

            @if($landingPage->group_offer_description ?? null)
              <p>{{ $landingPage->group_offer_description }}</p>
            @endif

            @if(!empty($landingPage->group_offer_perks))
              <ul class="group-offer-banner__perks">
                @foreach($landingPage->group_offer_perks as $perk)
                  <li>{{ $perk }}</li>
                @endforeach
              </ul>
            @endif

            <div class="group-offer-banner__actions">
              @if($landingPage->group_offer_cta1_text ?? null)
                <a href="{{ $landingPage->group_offer_cta1_url ?: '#' }}" class="btn btn-white">
                  {{ $landingPage->group_offer_cta1_text }}
                </a>
              @endif

              @if($landingPage->group_offer_cta2_text ?? null)
                <a href="{{ $landingPage->group_offer_cta2_url ?: 'javascript:void()' }}" data-model=".enquire-pop"
                  class="btn btn-outline-white">
                  {{ $landingPage->group_offer_cta2_text }}
                </a>
              @endif
            </div>
          </div>

          @if($landingPage->group_offer_image ?? null)
            <div class="group-offer-banner__media">
              <div class="group-offer-banner__img group-offer-banner__img--secondary">
                <img loading="lazy" src="{{ asset('storage/' . $landingPage->group_offer_image) }}"
                  alt="{{ $landingPage->group_offer_heading }}" />
              </div>
            </div>
          @endif
        </div>
      </div>
    </section>

    <!-- ACTIVITY PLANNING GUIDE -->
    <section class="activities-planning">
      <div class="container">
        <div class="planning-head">
          @if($landingPage->planning_eyebrow ?? null)
            <span class="eyebrow">{{ $landingPage->planning_eyebrow }}</span>
          @endif
          <h2>{{ $landingPage->planning_heading ?? '' }}</h2>
        </div>

        @foreach($landingPage->planning_blocks ?? [] as $block)
          @if(!empty($block['title']) || !empty($block['content']))
            <h3>{{ $block['title'] ?? '' }}</h3>
            <p>{{ $block['content'] ?? '' }}</p>
          @endif
        @endforeach
      </div>
    </section>

    <!-- WHY BOOK WITH US -->
    <section class="activities-benefits">
      <div class="container">
        <div class="heading">
          <h3>{{ $landingPage->benefits_heading ?? 'Why Book With Us?' }}</h3>
          @if($landingPage->benefits_description ?? null)
            <p>{{ $landingPage->benefits_description }}</p>
          @endif
        </div>

        <div class="activities-benefits-grid">
          @foreach($landingPage->benefits_items ?? [] as $item)
            <div class="benefit-item">
              <span class="benefit-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="1.8">
                  {!! $benefitIcons[$item['icon'] ?? 'star'] ?? $benefitIcons['star'] !!}
                </svg>
              </span>
              <h3>{{ $item['title'] ?? '' }}</h3>
              <p>{{ $item['description'] ?? '' }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- DESTINATION SECTION -->
    @if($relatedDestinations->isNotEmpty())
      <section class="categories-sec">
        <div class="container">
          <div class="heading">
            <h3>{{ $landingPage->related_destinations_heading ?? 'Popular Related Destinations' }}</h3>
            @if($landingPage->related_destinations_description ?? null)
              <p>{{ $landingPage->related_destinations_description }}</p>
            @endif
          </div>

          <div class="category-grid">
            @foreach($relatedDestinations as $destination)
              <a href="/attraction/{{ $destination->slug }}/" target="_blank" class="category_card">
                <img loading="lazy"
                  src="{{ $destination->image ? asset('storage/' . $destination->image) : asset('assets/images/blog/mount.jpg') }}"
                  alt="{{ $destination->name }}" />
                <div class="content">
                  <span class="pill">{{ $destination->name }}</span>
                  <p class="desc">{{ $destination->short_description }}</p>
                </div>
              </a>
            @endforeach
          </div>
        </div>
      </section>
    @endif

    <!-- SEO LINK SECTION -->
    @if(!empty($landingPage->seo_link_blocks))
      <section class="seo-links-sec">
        <div class="container">
          <div class="heading">
            <h3>{{ $landingPage->seo_links_heading ?? 'Explore More' }}</h3>
            @if($landingPage->seo_links_description ?? null)
              <p>{{ $landingPage->seo_links_description }}</p>
            @endif
          </div>

          <div class="seo-links-wrapper">
            @foreach($landingPage->seo_link_blocks as $block)
              <div class="seo-link-block">
                <h4>{{ $block['heading'] }}</h4>
                <div class="seo-link-wrap">
                  @foreach($block['links'] as $link)
                    <a href="{{ $link['url'] }}">{{ $link['text'] }}</a>
                  @endforeach
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
    @endif

    <!-- FINAL CTA -->
    <section class="activities-cta">
      <div class="container">
        <h2>{{ $landingPage->final_cta_heading ?? '' }}</h2>

        @if($landingPage->final_cta_description ?? null)
          <p>{{ $landingPage->final_cta_description }}</p>
        @endif

        <div class="activities-cta-actions">
          @if($landingPage->final_cta1_text ?? null)
            <a href="{{ $landingPage->final_cta1_url ?: 'javascript:void(0)' }}" class="btn btn-white">
              {{ $landingPage->final_cta1_text }}
              <i class="icon-arrow"></i>
            </a>
          @endif

          @if($landingPage->final_cta2_text ?? null)
            <a href="{{ $landingPage->final_cta2_url ?: '#' }}" class="btn btn-outline">
              {{ $landingPage->final_cta2_text }}
            </a>
          @endif
        </div>
      </div>
    </section>

  </main>

@endsection

@push('scripts')

  @if($landingPage->offer_countdown_end ?? null)
    <script>
      (function () {
        var countdownEl = document.getElementById('countdown');
        if (!countdownEl) return;

        var endTime = new Date(countdownEl.dataset.end).getTime();

        function pad(n) { return String(n).padStart(2, '0'); }

        function tick() {
          var distance = endTime - Date.now();
          if (distance < 0) distance = 0;

          var days = Math.floor(distance / 86400000);
          var hours = Math.floor((distance % 86400000) / 3600000);
          var minutes = Math.floor((distance % 3600000) / 60000);
          var seconds = Math.floor((distance % 60000) / 1000);

          countdownEl.querySelector('[data-unit="days"] .digit').textContent = pad(days);
          countdownEl.querySelector('[data-unit="hours"] .digit').textContent = pad(hours);
          countdownEl.querySelector('[data-unit="minutes"] .digit').textContent = pad(minutes);
          countdownEl.querySelector('[data-unit="seconds"] .digit').textContent = pad(seconds);
        }

        tick();
        setInterval(tick, 1000);
      })();
    </script>
  @endif

@endpush