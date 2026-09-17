@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/attractions/attractions.css')}}" />
@endpush

@section('content')

  <main>

    <!-- HERO SECTION -->
    <section class="banner attraction-banner">
      <div class="bg">
        <video autoplay="" muted="" loop="" playsinline="" class="bg-video"
          src="{{ $landingPage->hero_video ? asset('storage/' . $landingPage->hero_video) : asset('assets/video/trip2.mp4') }}"
          poster="{{ asset('assets/video/poster/trip2.png') }}">
          <source
            src="{{ $landingPage->hero_video ? asset('storage/' . $landingPage->hero_video) : asset('assets/video/home-banner.mp4') }}"
            type="video/mp4" />
        </video>
        <nav class="breadcrumb breadcrumb-light left" aria-label="Breadcrumb">
          <ul>
            <li>
              <a href="{{ route('home') }}">Home</a>
            </li>

            <li>
              <span class="breadcrumb-separator">/</span>
            </li>

            <li>
              <a href="{{ route('attractions') }}" class="active">Attractions</a>
            </li>
          </ul>
        </nav>
        <div class="container">
          <div class="banner-wrapper">
            <div class="content">
              <div class="attraction-search">
                <div class="search-wrapper">
                  <div class="search-content">
                    <h1>{{ $landingPage->hero_heading ?? 'Find Your Perfect Attraction' }}</h1>
                    @if($landingPage->hero_description ?? null)
                      <p>{{ $landingPage->hero_description }}</p>
                    @else
                      <p>
                        Search for places, experiences and attractions to make
                        your next trip unforgettable.
                      </p>
                    @endif
                  </div>

                  <form class="attraction-filter">
                    <div class="search-field">
                      <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="1.5" d="M19 11.5a7.5 7.5 0 1 1-15 0a7.5 7.5 0 0 1 15 0m-2.107 5.42l3.08 3.08" />
                      </svg>

                      <input type="text" name="search" placeholder="Search attractions or destinations..." />
                    </div>

                    <div class="select-field">
                      <select name="destination" class="js-nice-select">
                        <option value="">Select Destination</option>
                        @foreach($allDestinations as $destination)
                          <option value="{{ $destination->slug }}">{{ $destination->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="select-field">
                      <select name="category" class="js-nice-select">
                        <option value="">Select Category</option>
                        <option value="nature">Nature & Mountains</option>
                        <option value="beaches">Beaches</option>
                        <option value="historical">Historical Places</option>
                        <option value="wildlife">Wildlife & Safari</option>
                        <option value="adventure">Adventure</option>
                        <option value="culture">Culture & Heritage</option>
                      </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-search"></i>
                      Search
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- DESTINATION SECTION -->
    <section class="destinations-sec">
      <div class="container">
        <div class="heading">
          <h3>{{ $landingPage->destinations_heading ?? 'Explore Attractions by Destination' }}</h3>
          @if($landingPage->destinations_description ?? null)
            <p>{{ $landingPage->destinations_description }}</p>
          @else
            <p>
              Find amazing places to visit across popular destinations and start
              planning your perfect journey.
            </p>
          @endif
        </div>

        <div class="destination-grid">
          @forelse($destinations as $destination)
            <a href="{{ route('destination.show', $destination->slug) }}" target="_blank" class="destination_card">
              <div class="img">
                <img loading="lazy"
                  src="{{ $destination->image ? asset('storage/' . $destination->image) : asset('assets/images/blog/default.jpg') }}"
                  alt="{{ $destination->name }}" />
              </div>
              <div class="content">
                <p class="tag">{{ $destination->name }}</p>
                <h5>Explore {{ $destination->name }}</h5>
                <p class="desc">
                  {{ $destination->short_description }}
                </p>
                <button class="link-btn">
                  View Attractions
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M5 12h14M13 6l6 6-6 6" />
                  </svg>
                </button>
              </div>
            </a>
          @empty
            <p>No destinations available yet.</p>
          @endforelse
        </div>
      </div>
    </section>

    <!-- FEATURED ATTRACTION SECTION -->
    <section class="attractions-secA">
      <div class="container">
        <div class="heading">
          <h3>{{ $landingPage->featured_heading ?? 'Featured Attractions' }}</h3>
          @if($landingPage->featured_description ?? null)
            <p>{{ $landingPage->featured_description }}</p>
          @else
            <p>
              Explore some of the most popular places and experiences
              recommended for your next journey.
            </p>
          @endif
        </div>
        <div class="swiper-wrap">
          <div class="swiper fourSilder">
            <div class="swiper-wrapper">
              @forelse($featuredAttractions as $attraction)
                <div class="swiper-slide">
                  <a href="{{ route('attraction.show', $attraction->slug) }}" target="_blank" class="journey_card2">
                    <div class="img">
                      <img loading="lazy"
                        src="{{ $attraction->image ? asset('storage/' . $attraction->image) : asset('assets/images/blog/default.jpg') }}"
                        alt="{{ $attraction->name }}" />
                    </div>

                    <div class="content">
                      <h5>{{ $attraction->name }}</h5>

                      <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                          <path d="M0 0h24v24H0z" fill="none" />
                          <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2">
                            <circle cx="12" cy="10" r="3" />
                            <path
                              d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
                          </g>
                        </svg>
                        <p>
                          {{ collect([$attraction->city?->name, $attraction->state?->name, $attraction->country?->name])->filter()->implode(', ') }}
                        </p>
                      </div>

                      <p>
                        {{ $attraction->short_description }}
                      </p>
                    </div>
                  </a>
                </div>
              @empty
                <p>No featured attractions yet.</p>
              @endforelse
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

    <!-- CATERGORY SECTION -->
    <section class="categories-sec">
      <div class="container">
        <div class="heading">
          <h3>{{ $landingPage->categories_heading ?? 'Explore Attractions by Category' }}</h3>
          @if($landingPage->categories_description ?? null)
            <p>{{ $landingPage->categories_description }}</p>
          @else
            <p>
              Whatever kind of experience you're looking for, discover
              attractions that match your travel style.
            </p>
          @endif
        </div>

        <div class="category-grid">
          @forelse($categories as $category)
            <a href="#" target="_blank" class="category_card">
              <img loading="lazy"
                src="{{ $category->image ? asset('storage/' . $category->image) : asset('assets/images/blog/default.jpg') }}"
                alt="{{ $category->name }}" />
              <div class="content">
                <span class="pill">{{ $category->name }}</span>
                <p class="desc">
                  {{ $category->description }}
                </p>
              </div>
            </a>
          @empty
            <p>No categories available yet.</p>
          @endforelse
        </div>
      </div>
    </section>

    <!-- MUST VISIT ATTRACTION SECTION -->
    <section class="must-visit-sec">
      <div class="container">
        <div class="heading">
          <h3>{{ $landingPage->must_visit_heading ?? 'Must-Visit Attractions' }}</h3>
          @if($landingPage->must_visit_description ?? null)
            <p>{{ $landingPage->must_visit_description }}</p>
          @else
            <p>
              Add these unforgettable places to your travel wishlist and make
              your next trip truly special.
            </p>
          @endif
        </div>

        <div class="attraction-list">
          @forelse($mustVisitAttractions as $attraction)
            <div class="attraction_row">
              <a href="{{ route('attraction.show', $attraction->slug) }}" target="_blank" class="img">
                @if($attraction->image)
                  <img loading="lazy" src="{{ asset('storage/' . $attraction->image) }}" alt="{{ $attraction->name }}">
                @else
                  <img loading="lazy" src="{{ asset('assets/images/blog/mount.jpg') }}" alt="{{ $attraction->name }}">
                @endif
              </a>
              <div class="content">
                <div class="meta">
                  <span class="location">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="12" cy="10" r="3" />
                      <path
                        d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
                    </svg>
                    {{ collect([$attraction->city?->name, $attraction->state?->name, $attraction->country?->name])->filter()->implode(', ') }}
                  </span>
                  @if(!empty($attraction->best_for_tags))
                    <span class="divider">•</span>
                    <span class="category">{{ implode(' • ', array_slice($attraction->best_for_tags, 0, 2)) }}</span>
                  @endif
                </div>
                <h4><a href="{{ route('attraction.show', $attraction->slug) }}" target="_blank">{{ $attraction->name }}</a>
                </h4>
                <p class="desc">
                  {{ $attraction->short_description }}
                </p>
                <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
              </div>
            </div>
          @empty
            <p>No attractions available right now.</p>
          @endforelse
        </div>
      </div>
    </section>

    <!-- PROMO SECTION -->
    <section class="app-promo">
      <div class="container">
        <div class="app-promo-inner">
          <div class="app-promo-text">
            <span class="eyebrow">{{ $landingPage->promo_eyebrow ?? 'Plan Your Trip' }}</span>
            <h3>{{ $landingPage->promo_heading ?? "Can't Decide Where to Go?" }}</h3>
            @if($landingPage->promo_description ?? null)
              <p>{{ $landingPage->promo_description }}</p>
            @else
              <p>
                Tell us what kind of experience you're looking for, and we'll
                help you plan a trip around the places you want to explore.
              </p>
            @endif

            <div class="cta-btns">
              <a href="{{ $landingPage->promo_primary_url ?: 'javascript:void(0)' }}" class="sbmt btn btn-white">
                {{ $landingPage->promo_primary_text ?? 'Plan My Trip' }}
              </a>
              <a href="{{ $landingPage->promo_secondary_url ?: 'javascript:void(0)' }}" class="btn btn-outline-white">
                {{ $landingPage->promo_secondary_text ?? 'Explore Tour Packages' }}
              </a>
            </div>
          </div>

          <div class="app-promo-visual">
            <div class="phone phone--back">
              <img loading="lazy"
                src="{{ $landingPage->promo_image ? asset('storage/' . $landingPage->promo_image) : asset('assets/icon/h3-destination-shape.png') }}"
                alt="App preview" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- GUIDE SECTION -->
    @if($landingPage->guide_items)
      <section class="comman_blog bg-gray">
        <div class="container">
          <div class="heading">
            <h3>{{ $landingPage->guides_heading ?? 'Travel Inspiration & Guides' }}</h3>
            @if($landingPage->guides_description ?? null)
              <p>{{ $landingPage->guides_description }}</p>
            @else
              <p>
                Get useful travel tips, destination guides and inspiration to help
                you plan your next adventure.
              </p>
            @endif
          </div>

          <div class="swiper-wrap">
            <div class="swiper thirdSilder">
              <div class="swiper-wrapper">
                @foreach($landingPage->guide_items as $item)
                  <div class="swiper-slide">
                    <a href="{{ $item['link_url'] ?: 'javascript:void()' }}" target="_blank" class="blog_card">
                      <div class="img">
                        <img loading="lazy"
                          src="{{ !empty($item['image']) ? asset('storage/' . $item['image']) : asset('assets/images/blog/default.jpg') }}"
                          alt="{{ $item['title'] }}" />
                        @if(!empty($item['category']))
                          <span class="tag">{{ $item['category'] }}</span>
                        @endif
                      </div>

                      <div class="content">
                        <h4>{{ $item['title'] }}</h4>
                        <p>{{ $item['description'] }}</p>

                        <span class="btn btn-outline-primary">
                          Read Guide
                          <img loading="lazy" src="{{ asset('assets/icon/arrow.svg') }}" alt="" />
                        </span>
                      </div>
                    </a>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="btn-center">
              <a href="javascript:void()" class="btn btn-primary">
                View All Travel Guides
              </a>
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

    <!-- FAQ SECTION -->
    @if($landingPage->faqs)
      <section class="attraction_accordion">
        <div class="container">
          <div class="heading">
            <h3>{{ $landingPage->faqs_heading ?? 'Frequently Asked Questions' }}</h3>
          </div>

          <div class="accordion-wrapper">
            @foreach($landingPage->faqs as $index => $faq)
              <div class="accordion-item">
                <div class="accordion-body">
                  <div class="accordion-header @if($index === 0) active @endif">
                    <h4>{{ $faq['question'] }}</h4>
                    <span class="accordion-icon">{{ $index === 0 ? '−' : '+' }}</span>
                  </div>

                  <div class="accordion-content">
                    <p>{{ $faq['answer'] }}</p>
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