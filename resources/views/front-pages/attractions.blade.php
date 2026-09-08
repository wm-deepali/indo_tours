@extends('layouts.app')

@section('title', 'Attractions | Indo Tours & Adventures')
@section('meta_description', 'Explore a variety of attractions across domestic and international destinations. Discover the world with our expertly crafted itineraries and exceptional services.')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/attractions/attractions.css')}}" />
@endpush

@section('content')


  <main>
    <section class="banner attraction-banner">
      <div class="bg">
        <video autoplay="" muted="" loop="" playsinline="" class="bg-video" src="{{ asset('assets/video/trip2.mp4') }}"
          poster="{{ asset('assets/video/poster/trip2.png') }}">
          <source src="{{ asset('assets/video/home-banner.mp4') }}" type="video/mp4" />
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
                    <h1>Find Your Perfect Attraction</h1>
                    <p>
                      Search for places, experiences and attractions to make
                      your next trip unforgettable.
                    </p>
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
                        <option value="kashmir">Kashmir</option>
                        <option value="goa">Goa</option>
                        <option value="manali">Manali</option>
                        <option value="rajasthan">Rajasthan</option>
                        <option value="kerala">Kerala</option>
                        <option value="dubai">Dubai</option>
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

    <section class="destinations-sec">
      <div class="container">
        <div class="heading">
          <h3>Explore Attractions by <span>Destination</span></h3>
          <p>
            Find amazing places to visit across popular destinations and start
            planning your perfect journey.
          </p>
        </div>

        <div class="destination-grid">
          <a href="#" target="_blank" class="destination_card">
            <div class="img">
              <img loading="lazy" src="{{ asset('assets/images/blog/kashmir.jpg') }}" alt="Kashmir" />
            </div>
            <div class="content">
              <p class="tag">Kashmir</p>
              <h5>Explore Kashmir</h5>
              <p class="desc">
                Discover mountains, lakes, valleys and breathtaking natural
                landscapes.
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

          <a href="#" target="_blank" class="destination_card">
            <div class="img">
              <img loading="lazy" src="{{ asset('assets/images/blog/hawamahal.jpg') }}" alt="Rajasthan" />
            </div>
            <div class="content">
              <p class="tag">Rajasthan</p>
              <h5>Explore Rajasthan</h5>
              <p class="desc">
                Experience royal palaces, historic forts and vibrant cultural
                heritage.
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

          <a href="#" target="_blank" class="destination_card">
            <div class="img">
              <img loading="lazy" src="{{ asset('assets/images/blog/goa.jpg') }}" alt="Goa" />
            </div>
            <div class="content">
              <p class="tag">Goa</p>
              <h5>Explore Goa</h5>
              <p class="desc">
                Relax on beautiful beaches and experience Goa's vibrant
                coastal lifestyle.
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

          <a href="#" target="_blank" class="destination_card">
            <div class="img">
              <img loading="lazy" src="{{ asset('assets/images/blog/manali.jpg') }}" alt="Kerala" />
            </div>
            <div class="content">
              <p class="tag">Kerala</p>
              <h5>Explore Kerala</h5>
              <p class="desc">
                Discover tranquil backwaters, lush landscapes and unique
                cultural experiences.
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

          <a href="#" target="_blank" class="destination_card">
            <div class="img">
              <img loading="lazy" src="{{ asset('assets/images/blog/manali.jpg') }}" alt="Manali" />
            </div>
            <div class="content">
              <p class="tag">Manali</p>
              <h5>Explore Manali</h5>
              <p class="desc">
                Experience mountain views, adventure activities and peaceful
                Himalayan escapes.
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

          <a href="#" target="_blank" class="destination_card">
            <div class="img">
              <img loading="lazy" src="{{ asset('assets/images/blog/dubai.jpg') }}" alt="Dubai" />
            </div>
            <div class="content">
              <p class="tag">Dubai</p>
              <h5>Explore Dubai</h5>
              <p class="desc">
                Discover modern landmarks, luxury experiences, desert
                adventures and vibrant city life.
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
        </div>
      </div>
    </section>

    <section class="attractions-secA">
      <div class="container">
        <div class="heading">
          <h3>Featured <span>Attractions</span></h3>
          <p>
            Explore some of the most popular places and experiences
            recommended for your next journey.
          </p>
        </div>
        <div class="swiper-wrap">
          <div class="swiper fourSilder">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <a href="#" target="_blank" class="journey_card2">
                  <div class="img">
                    <img loading="lazy" src="{{ asset('assets/images/blog/manali.jpg') }}" alt="Solang Valley, Manali" />
                  </div>

                  <div class="content">
                    <h5>Solang Valley</h5>

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

                      <p>Manali, India</p>
                    </div>

                    <p>
                      Enjoy breathtaking mountain views, adventure activities
                      and the peaceful beauty of the Himalayas at Solang
                      Valley.
                    </p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide">
                <a href="#" target="_blank" class="journey_card2">
                  <div class="img">
                    <img loading="lazy" src="{{ asset('assets/images/blog/goa.jpg') }}" alt="Baga Beach, Goa" />
                  </div>

                  <div class="content">
                    <h5>Baga Beach</h5>

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

                      <p>Goa, India</p>
                    </div>

                    <p>
                      Relax by the Arabian Sea, enjoy water sports and
                      experience the vibrant beach culture of Goa at Baga
                      Beach.
                    </p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide">
                <a href="#" target="_blank" class="journey_card2">
                  <div class="img">
                    <img loading="lazy" src="{{ asset('assets/images/blog/dubai.jpg') }}" alt="Burj Khalifa, Dubai" />
                  </div>

                  <div class="content">
                    <h5>Burj Khalifa</h5>

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

                      <p>Dubai, UAE</p>
                    </div>

                    <p>
                      Experience spectacular city views from one of the
                      world's most iconic skyscrapers in the heart of Downtown
                      Dubai.
                    </p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide">
                <a href="#" target="_blank" class="journey_card2">
                  <div class="img">
                    <img loading="lazy" src="{{ asset('assets/images/blog/kashmir.jpg') }}" alt="Dal Lake, Kashmir" />
                  </div>

                  <div class="content">
                    <h5>Dal Lake</h5>

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

                      <p>Srinagar, Kashmir</p>
                    </div>

                    <p>
                      Cruise through the calm waters of Dal Lake and admire
                      the beautiful mountains, houseboats and traditional
                      Kashmiri scenery.
                    </p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide">
                <a href="#" target="_blank" class="journey_card2">
                  <div class="img">
                    <img loading="lazy" src="{{ asset('assets/images/blog/hawamahal.jpg') }}" alt="Hawa Mahal, Jaipur" />
                  </div>

                  <div class="content">
                    <h5>Hawa Mahal</h5>

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

                      <p>Jaipur, India</p>
                    </div>

                    <p>
                      Discover the stunning pink façade, historic architecture
                      and royal heritage of Jaipur at the iconic Hawa Mahal.
                    </p>
                  </div>
                </a>
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

    <section class="categories-sec">
      <div class="container">
        <div class="heading">
          <h3>Explore Attractions by <span>Category</span></h3>
          <p>
            Whatever kind of experience you're looking for, discover
            attractions that match your travel style.
          </p>
        </div>

        <div class="category-grid">
          <a href="#" target="_blank" class="category_card">
            <img loading="lazy" src="{{ asset('assets/images/blog/mount.jpg') }}" alt="Nature and Mountains" />
            <div class="content">
              <span class="pill">Nature & Mountains</span>
              <p class="desc">
                Escape into breathtaking landscapes, valleys and mountain
                destinations.
              </p>
            </div>
          </a>

          <a href="#" target="_blank" class="category_card">
            <img loading="lazy" src="{{ asset('assets/images/blog/beach.jpg') }}" alt="Beaches" />
            <div class="content">
              <span class="pill">Beaches</span>
              <p class="desc">
                Discover beautiful coastlines, peaceful beaches and exciting
                water experiences.
              </p>
            </div>
          </a>

          <a href="#" target="_blank" class="category_card">
            <img loading="lazy" src="{{ asset('assets/images/blog/histroical.avif') }}" alt="Historical Places" />
            <div class="content">
              <span class="pill">Historical Places</span>
              <p class="desc">
                Step into history and explore iconic monuments, forts and
                heritage sites.
              </p>
            </div>
          </a>

          <a href="#" target="_blank" class="category_card">
            <img loading="lazy" src="{{ asset('assets/images/blog/wild.avif') }}" alt="Wildlife and Safari" />
            <div class="content">
              <span class="pill">Wildlife & Safari</span>
              <p class="desc">
                Get closer to nature with wildlife reserves, national parks
                and safari experiences.
              </p>
            </div>
          </a>

          <a href="#" target="_blank" class="category_card">
            <img loading="lazy" src="{{ asset('assets/images/blog/travel.avif') }}" alt="Adventure" />
            <div class="content">
              <span class="pill">Adventure</span>
              <p class="desc">
                Add excitement to your journey with trekking, rafting and
                thrilling outdoor activities.
              </p>
            </div>
          </a>

          <a href="#" target="_blank" class="category_card">
            <img loading="lazy" src="{{ asset('assets/images/blog/culture.avif') }}" alt="Culture and Heritage" />
            <div class="content">
              <span class="pill">Culture & Heritage</span>
              <p class="desc">
                Experience local traditions, architecture, food and
                fascinating cultural heritage.
              </p>
            </div>
          </a>
        </div>
      </div>
    </section>

    <section class="must-visit-sec">
      <div class="container">
        <div class="heading">
          <h3>Must-Visit <span>Attractions</span></h3>
          <p>
            Add these unforgettable places to your travel wishlist and make
            your next trip truly special.
          </p>
        </div>

        <div class="attraction-list">
          @forelse($mustVisitAttractions as $attraction)
            <div class="attraction_row">
              <a href="javascript:void()" target="_blank" class="img">
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
                <h4><a href="javascript:void()" target="_blank">{{ $attraction->name }}</a></h4>
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
    <section class="app-promo">
      <div class="container">
        <div class="app-promo-inner">
          <div class="app-promo-text">
            <span class="eyebrow">Plan Your Trip</span>
            <h3>Can't Decide Where to Go?</h3>
            <p>
              Tell us what kind of experience you're looking for, and we'll
              help you plan a trip around the places you want to explore.
            </p>

            <div class="cta-btns">
              <a href="javascript:void(0)" class="sbmt btn btn-white">
                Plan My Trip
              </a>
              <a href="javascript:void(0)" class="btn btn-outline-white">
                Explore Tour Packages
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

    <section class="comman_blog bg-gray">
      <div class="container">
        <div class="heading">
          <h3>Travel <span>Inspiration & Guides</span></h3>
          <p>
            Get useful travel tips, destination guides and inspiration to help
            you plan your next adventure.
          </p>
        </div>

        <div class="swiper-wrap">
          <div class="swiper thirdSilder">
            <div class="swiper-wrapper">
              <!-- Kashmir -->
              <div class="swiper-slide">
                <div class="blog_card">
                  <div class="img">
                    <img loading="lazy" src="{{ asset('assets/images/blog/kashmir.jpg') }}"
                      alt="Beautiful Kashmir travel destination" />
                    <span class="tag">Kashmir</span>
                  </div>

                  <div class="content">
                    <h4>Best Places to Visit in Kashmir</h4>

                    <p>
                      Discover the most beautiful destinations and experiences
                      to add to your Kashmir itinerary.
                    </p>

                    <a href="javascript:void()" class="btn btn-outline-primary">
                      Read Guide
                      <img loading="lazy" src="{{ asset('assets/icon/arrow.svg') }}" alt="" />
                    </a>
                  </div>
                </div>
              </div>

              <!-- Goa -->
              <div class="swiper-slide">
                <div class="blog_card">
                  <div class="img">
                    <img loading="lazy" src="{{ asset('assets/images/blog/goa.jpg') }}"
                      alt="Goa beaches and travel destination" />
                    <span class="tag">Goa</span>
                  </div>

                  <div class="content">
                    <h4>Top Things to Do in Goa</h4>

                    <p>
                      From beaches and water activities to local experiences,
                      discover what makes Goa special.
                    </p>

                    <a href="javascript:void()" class="btn btn-outline-primary">
                      Read Guide
                      <img loading="lazy" src="{{ asset('assets/icon/arrow.svg') }}" alt="" />
                    </a>
                  </div>
                </div>
              </div>

              <!-- Rajasthan -->
              <div class="swiper-slide">
                <div class="blog_card">
                  <div class="img">
                    <img loading="lazy" src="{{ asset('assets/images/blog/hawamahal.jpg') }}"
                      alt="Rajasthan travel destination" />
                    <span class="tag">Rajasthan</span>
                  </div>

                  <div class="content">
                    <h4>Complete Rajasthan Travel Guide</h4>

                    <p>
                      Explore royal cities, historic forts, cultural
                      experiences and unforgettable destinations.
                    </p>

                    <a href="javascript:void()" class="btn btn-outline-primary">
                      Read Guide
                      <img loading="lazy" src="{{ asset('assets/icon/arrow.svg') }}" alt="" />
                    </a>
                  </div>
                </div>
              </div>

              <!-- Manali -->
              <div class="swiper-slide">
                <div class="blog_card">
                  <div class="img">
                    <img loading="lazy" src="{{ asset('assets/images/blog/manali.jpg') }}"
                      alt="Manali mountains and travel destination" />
                    <span class="tag">Manali</span>
                  </div>

                  <div class="content">
                    <h4>Best Places to Visit in Manali</h4>

                    <p>
                      Explore scenic mountains, adventure activities and
                      peaceful escapes for your next Manali trip.
                    </p>

                    <a href="javascript:void()" class="btn btn-outline-primary">
                      Read Guide
                      <img loading="lazy" src="{{ asset('assets/icon/arrow.svg') }}" alt="" />
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- View All -->
          <div class="btn-center">
            <a href="javascript:void()" class="btn btn-primary">
              View All Travel Guides
            </a>
          </div>

          <!-- Slider Navigation -->
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

    <section class="attraction_accordion">
      <div class="container">
        <div class="heading">
          <h3>Frequently Asked <span>Questions</span></h3>
        </div>

        <div class="accordion-wrapper">
          <div class="accordion-item">
            <div class="accordion-body">
              <div class="accordion-header active">
                <h4>What is an attraction?</h4>
                <span class="accordion-icon">−</span>
              </div>

              <div class="accordion-content">
                <p>
                  An attraction is a place, landmark, natural site, cultural
                  location or experience that travellers can visit and enjoy
                  during their journey.
                </p>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <div class="accordion-body">
              <div class="accordion-header">
                <h4>Can I include attractions in my tour package?</h4>
                <span class="accordion-icon">+</span>
              </div>

              <div class="accordion-content">
                <p>
                  Yes. You can discuss your preferred attractions with our
                  travel team and create an itinerary based on your travel
                  requirements.
                </p>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <div class="accordion-body">
              <div class="accordion-header">
                <h4>Can I create a customised trip?</h4>
                <span class="accordion-icon">+</span>
              </div>

              <div class="accordion-content">
                <p>
                  Yes. Our team can help you plan a customised journey based
                  on your destination, travel dates, interests and
                  requirements.
                </p>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <div class="accordion-body">
              <div class="accordion-header">
                <h4>How do I find attractions for a destination?</h4>
                <span class="accordion-icon">+</span>
              </div>

              <div class="accordion-content">
                <p>
                  Use the search and destination filters above to explore
                  attractions by location or category.
                </p>
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <div class="accordion-body">
              <div class="accordion-header">
                <h4>Can I visit multiple attractions in one trip?</h4>
                <span class="accordion-icon">+</span>
              </div>

              <div class="accordion-content">
                <p>
                  Yes. Multiple attractions can be included in your itinerary
                  depending on your travel duration, destination and preferred
                  experiences.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection