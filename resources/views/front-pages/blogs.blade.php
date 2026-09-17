@extends('layouts.app')

@section('title', 'Blogs | Indo Tours & Adventures')
@section('meta_description', '')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/blog/blog.css') }}" />
@endpush

@section('content')

  <main>

    <section class="banner">
      <div class="bg">
        <nav class="breadcrumb left breadcrumb-light" aria-label="Breadcrumb">
          <ul>
            <li>
              <a href="{{ route('home') }}">Home</a>
            </li>

            <li>
              <span class="breadcrumb-separator">/</span>
            </li>

            <li>
              <a href="{{ route('blogs') }}" class="active">Blogs</a>
            </li>
          </ul>
        </nav>
        <img loading="lazy" src="assets/images/blog/banner.avif" />
        <div class="container">
          <div class="banner-wrapper">
            <div class="content">
              <h1>Journey Stories</h1>

              <p>
                Explore destinations, travel tips, local experiences, and
                inspiration to make every journey more memorable.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="blog-secA">
      <div class="container">
        <div class="heading">
          <h3>Indo Tours & Adventures <span>Journey Stories</span></h3>
          <p>
            Discover inspiring journeys, unforgettable experiences, and
            destinations worth exploring.
          </p>
        </div>
        <div class="swiper-wrap">
          <div class="swiper fourSilder">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <a href="blog-detail-secondary.html" target="_blank" class="journey_card">
                  <div class="img">
                    <img loading="lazy" src="assets/images/blog/manali.jpg" alt="Manali mountains" />
                  </div>
                  <div class="content">
                    <h5>Manali</h5>
                    <p>Mountain Escape</p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide">
                <a href="blog-detail-secondary.html" target="_blank" class="journey_card">
                  <div class="img">
                    <img loading="lazy" src="assets/images/blog/goa.jpg" alt="Goa beach" />
                  </div>
                  <div class="content">
                    <h5>Goa</h5>
                    <p>Beach Getaway</p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide">
                <a href="blog-detail-secondary.html" target="_blank" class="journey_card">
                  <div class="img">
                    <img loading="lazy" src="assets/images/blog/dubai.jpg" alt="Dubai skyline" />
                  </div>
                  <div class="content">
                    <h5>Dubai</h5>
                    <p>Luxury Escape</p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide">
                <a href="blog-detail-secondary.html" target="_blank" class="journey_card">
                  <div class="img">
                    <img loading="lazy" src="assets/images/blog/kashmir.jpg" alt="Kashmir landscape" />
                  </div>
                  <div class="content">
                    <h5>Kashmir</h5>
                    <p>Valley Adventure</p>
                  </div>
                </a>
              </div>

              <div class="swiper-slide">
                <a href="blog-detail-secondary.html" target="_blank" class="journey_card">
                  <div class="img">
                    <img loading="lazy" src="assets/images/blog/goa.jpg" alt="Goa beach" />
                  </div>
                  <div class="content">
                    <h5>Goa</h5>
                    <p>Beach Getaway</p>
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

    <!-- CATEGORIES SECTION -->
    @foreach($categories as $index => $category)
      <section class="comman_blog {{ $index % 2 === 0 ? 'bg-gray' : '' }}">
        <div class="container">
          <div class="heading">
            <h3>Experience <span>{{ $category->name }}</span></h3>
            <p>{{ $category->subtitle }}</p>
          </div>

          <div class="swiper-wrap">
            <div class="swiper thirdSilder">
              <div class="swiper-wrapper">
                @foreach($category->blogs as $blog)
                  <div class="swiper-slide">
                    <a href="{{ route('blog.detail', $blog->slug) }}" target="_blank" class="blog_card">
                      <div class="img">
                        <img loading="lazy" src="{{ $blog->featured_image_url }}" alt="{{ $blog->title }}" />
                        @if($blog->tag)
                          <span class="tag">{{ $blog->tag }}</span>
                        @endif
                      </div>

                      <div class="content">
                        <h4>{{ $blog->title }}</h4>
                        <p>{{ $blog->short_description }}</p>

                        <div class="btn btn-outline-primary">
                          Read More
                          <img loading="lazy" src="assets/icon/arrow.svg" />
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
    @endforeach

    <!-- LATEST BLOG SECTION -->
    <section class="blog-secB">
      <div class="container">
        <div class="heading">
          <h3>Latest <span>Travel Stories</span></h3>
          <p>Discover inspiring destinations, travel tips, and unforgettable experiences.</p>
        </div>

        <div class="blog-layout">
          @if($latestBlogs->isNotEmpty())
            @php $featured = $latestBlogs->first(); @endphp
            <a href="{{ route('blog.detail', $featured->slug) }}" target="_blank" class="featured_post">
              <div class="img">
                <img loading="lazy" src="{{ $featured->featured_image_url }}" alt="{{ $featured->title }}" />
              </div>
              <div class="content">
                <h4>{{ $featured->title }}</h4>
                <div class="meta">
                  <span class="author">{{ $featured->author->name ?? 'Travel Team' }}</span>
                  <span class="dot"></span>
                  <span class="date">{{ $featured->published_at?->format('F j, Y') }}</span>
                </div>
              </div>
            </a>

            <div class="post_list">
              @foreach($latestBlogs->skip(1) as $blog)
                <a href="{{ route('blog.detail', $blog->slug) }}" target="_blank" class="post_item">
                  <div class="img">
                    <img loading="lazy" src="{{ $blog->featured_image_url }}" alt="{{ $blog->title }}" />
                  </div>
                  <div class="content">
                    <h5>{{ $blog->title }}</h5>
                    <div class="meta">
                      <span class="author">{{ $blog->author->name ?? 'Travel Team' }}</span>
                      <span class="dot"></span>
                      <span class="date">{{ $blog->published_at?->format('F j, Y') }}</span>
                    </div>
                  </div>
                </a>
              @endforeach
            </div>
          @endif
        </div>
      </div>
    </section>

    <!-- DESTINATION SECTION -->
    <section class="blog-secC">
      <div class="container">
        <div class="heading">
          <h3>Featured <span>Destinations</span></h3>
          <p>
            Explore handpicked destinations for your next unforgettable
            journey.
          </p>
        </div>

        <div class="destination-grid">
          @foreach ($destinations as $index => $destination)
            <a href="{{ route('destination.show', $destination->slug) }}"
              class="destination-card @if ($index === 0) destination-card--large @endif">
              <div class="img">
                <img loading="lazy"
                  src="{{ $destination->image ? asset('storage/' . $destination->image) : asset('assets/images/blog/banner.avif') }}"
                  alt="{{ $destination->name }}" />
              </div>

              <div class="content">
                <span class="index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <h4>{{ $destination->name }}</h4>
                <span class="country">{{ $destination->location_text }}</span>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </section>

  </main>

@endsection