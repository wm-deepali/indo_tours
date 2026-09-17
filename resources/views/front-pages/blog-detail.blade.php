@extends('layouts.app')

@section('title', 'Blog Detail | Indo Tours & Adventures')
@section('meta_description', '')

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/sass/blog-detail/detail.css') }}" />
@endpush

@section('content')


  <main>

    <section class="detail-secA">
      <div class="container">

        <nav class="breadcrumb breadcrumb-dark" aria-label="Breadcrumb">
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><span class="breadcrumb-separator">/</span></li>
            <li><a href="{{ route('blogs') }}">Blog</a></li>
            <li><span class="breadcrumb-separator">/</span></li>
            <li><a href="{{ route('blog.detail', $blog->slug) }}" class="active">{{ $blog->title }}</a></li>
          </ul>
        </nav>

        <div class="grid">
          <div class="detail_wrapper">
            <!-- Blog Header -->
            <div class="top_detail">
              <div class="content_all">
                @if($blog->tag)
                  <span class="tag">{{ $blog->tag }}</span>
                @endif

                <h1>{{ $blog->h1 ?: $blog->title }}</h1>

                <div class="meta">
                  <div class="meta_author">
                    <img loading="lazy" src="{{ $blog->author->avatar_url ?? asset('assets/images/home/client2.png') }}"
                      alt="{{ $blog->author->name ?? 'Travel Team' }}" />
                    <div class="meta_info">
                      <p class="name">{{ $blog->author->name ?? 'Travel Team' }}</p>
                      <p class="date">{{ $blog->published_at?->format('F j, Y') }}</p>
                    </div>
                  </div>

                  <div class="meta_views">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                      <path d="M0 0h16v16H0z" fill="none" />
                      <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width=".929">
                        <path
                          d="M8 3.895C12.447 3.895 14.5 8 14.5 8s-2.053 4.105-6.5 4.105S1.5 8 1.5 8S3.553 3.895 8 3.895Z" />
                        <path d="M9.94 8a2 2 0 1 1-3.999 0a2 2 0 0 1 4 0Z" />
                      </g>
                    </svg>
                    <span>{{ number_format($blog->views) }} Views</span>
                  </div>
                </div>

                <!-- Share -->
                <div class="share_col">
                  <span class="share_label">Share</span>

                  @php
                    $shareUrl = urlencode(route('blog.detail', $blog->slug));
                    $shareTitle = urlencode($blog->h1 ?: $blog->title);
                  @endphp

                  <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank"
                    rel="noopener" class="share_ic tw" aria-label="Share on Twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                      <path d="M0 0h24v24H0z" fill="none" />
                      <path fill="currentColor"
                        d="M22.213 5.656a8.4 8.4 0 0 1-2.402.658A4.2 4.2 0 0 0 21.649 4c-.82.488-1.719.83-2.655 1.015a4.182 4.182 0 0 0-7.126 3.814a11.87 11.87 0 0 1-8.621-4.37a4.17 4.17 0 0 0-.566 2.103c0 1.45.739 2.731 1.86 3.481a4.2 4.2 0 0 1-1.894-.523v.051a4.185 4.185 0 0 0 3.355 4.102a4.2 4.2 0 0 1-1.89.072A4.185 4.185 0 0 0 8.02 16.65a8.4 8.4 0 0 1-6.192 1.732a11.83 11.83 0 0 0 6.41 1.88c7.694 0 11.9-6.373 11.9-11.9q0-.271-.012-.541a8.5 8.5 0 0 0 2.086-2.164" />
                    </svg>
                  </a>

                  <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener"
                    class="share_ic fb" aria-label="Share on Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                      <path d="M0 0h24v24H0z" fill="none" />
                      <path fill="currentColor"
                        d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4z" />
                    </svg>
                  </a>

                  <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank"
                    rel="noopener" class="share_ic wa" aria-label="Share on WhatsApp">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                      <path d="M0 0h24v24H0z" fill="none" />
                      <path fill="currentColor"
                        d="M16.6 14c-.2-.1-1.5-.7-1.7-.8s-.4-.1-.6.1s-.6.8-.8 1c-.1.2-.3.2-.5.1c-.7-.3-1.4-.7-2-1.2c-.5-.5-1-1.1-1.4-1.7c-.1-.2 0-.4.1-.5s.2-.3.4-.4c.1-.1.2-.3.2-.4c.1-.1.1-.3 0-.4S9.7 8.5 9.5 8c-.1-.7-.3-.7-.5-.7h-.5c-.2 0-.5.2-.6.3Q7 8.5 7 9.7c.1.9.4 1.8 1 2.6c1.1 1.6 2.5 2.9 4.2 3.7c.5.2.9.4 1.4.5c.5.2 1 .2 1.6.1c.7-.1 1.3-.6 1.7-1.2c.2-.4.2-.8.1-1.2zm2.5-9.1C15.2 1 8.9 1 5 4.9c-3.2 3.2-3.8 8.1-1.6 12L2 22l5.3-1.4c1.5.8 3.1 1.2 4.7 1.2c5.5 0 9.9-4.4 9.9-9.9c.1-2.6-1-5.1-2.8-7m-2.7 14c-1.3.8-2.8 1.3-4.4 1.3c-1.5 0-2.9-.4-4.2-1.1l-.3-.2l-3.1.8l.8-3l-.2-.3c-2.4-4-1.2-9 2.7-11.5S16.6 3.7 19 7.5c2.4 3.9 1.3 9-2.6 11.4" />
                    </svg>
                  </a>
                </div>
              </div>

              <img loading="lazy" src="{{ $blog->featured_image_url }}" alt="{{ $blog->title }}" />

            </div>

            {!! $blog->content !!}


            <div class="comment_wrapper">

              {{-- Existing approved comments --}}
              @if($blog->comments->count())
                <div class="comment_list">
                  <h3>{{ $blog->comments->count() }} Comments</h3>

                  @foreach($blog->comments as $comment)
                    <div class="author_block">
                      <div class="author_avatar">
                        <img loading="lazy" src="{{ $comment->photo_url ?: asset('assets/images/home/client2.png') }}"
                          alt="{{ $comment->name }}" />
                      </div>

                      <div class="author_info">
                        <h5>{{ $comment->name }}</h5>
                        <p>{{ $comment->comment }}</p>
                        <a href="javascript:void()" class="author_link">{{ $comment->created_at->format('F j, Y') }}</a>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endif

              <!-- Comment Form -->
              <div class="comment_form_box">
                <h3>Share Your Travel Experience</h3>

                @if(session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form id="commentForm" action="{{ route('blog.comment.store', $blog->slug) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf

                  <div class="field-row">
                    <div class="field">
                      <input type="text" name="name" value="{{ old('name') }}" placeholder=" " class="field__input"
                        required />
                      <label class="field__label">Your Name<span>*</span></label>
                      @error('name') <span class="error_text">{{ $message }}</span> @enderror
                    </div>

                    <div class="field">
                      <input type="email" name="email" value="{{ old('email') }}" placeholder=" " class="field__input"
                        required />
                      <label class="field__label">Your E-mail<span>*</span></label>
                      @error('email') <span class="error_text">{{ $message }}</span> @enderror
                    </div>
                  </div>

                  <div class="field field--textarea">
                    <textarea name="comment" placeholder=" " class="field__input" rows="5"
                      required>{{ old('comment') }}</textarea>
                    <label class="field__label">Share Your Experience<span>*</span></label>
                    @error('comment') <span class="error_text">{{ $message }}</span> @enderror
                  </div>

                  <div class="field field--file">
                    <label class="field__label field__label--static">Add a Photo (optional)</label>
                    <input type="file" name="photo" accept="image/*" class="field__file" />
                    @error('photo') <span class="error_text">{{ $message }}</span> @enderror
                  </div>

                  <label class="checkbox_field">
                    <input type="checkbox" name="agree" required />
                    <span class="box"></span>
                    <span class="text">
                      I agree that my submitted data is being collected and
                      stored. For further details on how we handle your
                      information, please see our
                      <a href="javascript:void()">Privacy Policy</a>
                    </span>
                  </label>

                  <button type="submit" class="btn btn-primary">
                    Submit Your Comment
                  </button>
                </form>
              </div>
            </div>

            <div class="form_wrapper">
              <div class="grid_card">
                <!-- Newsletter Card -->
                <div class="card card--newsletter">
                  <h4>Get Travel Inspiration & Updates</h4>
                  <div class="divider"></div>

                  <form id="newsletterForm">
                    <div class="subscribe_row">
                      <input type="email" name="email" placeholder="Enter your email address" class="subscribe_input"
                        required />
                      <button type="submit" class="btn btn-primary">
                        Subscribe
                      </button>
                    </div>

                    <label class="checkbox_field">
                      <input type="checkbox" name="terms" required />
                      <span class="box"></span>
                      <span class="text">
                        I agree to receive travel updates and accept the terms
                        &amp; conditions
                      </span>
                    </label>
                  </form>
                </div>

                <!-- Popular Stories Card -->
                <div class="card card--stories">
                  <h4>Popular Travel Stories</h4>
                  <div class="divider"></div>

                  <div class="story_list">
                    @foreach($popularStories as $story)
                      <a href="{{ route('blog.detail', $story->slug) }}" target="_blank" class="story_item">
                        <div class="story_thumb">
                          <img loading="lazy" src="{{ $story->featured_image_url }}" alt="{{ $story->title }}" />
                        </div>
                        <div class="story_info">
                          <p class="story_title">{{ $story->title }}</p>
                          <span class="story_views">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16">
                              <path d="M0 0h16v16H0z" fill="none" />
                              <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width=".929">
                                <path
                                  d="M8 3.895C12.447 3.895 14.5 8 14.5 8s-2.053 4.105-6.5 4.105S1.5 8 1.5 8S3.553 3.895 8 3.895Z" />
                                <path d="M9.94 8a2 2 0 1 1-3.999 0a2 2 0 0 1 4 0Z" />
                              </g>
                            </svg>
                            {{ number_format($story->views) }} Views
                          </span>
                        </div>
                      </a>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>

    <!-- GROUP OFFER BANNER -->
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

    {{-- POPULAR TOUR PACKAGES SWIPER --}}
    @if($blog->tourPackages->count())
      <section class="related-tour-package">
        <div class="container">
          <div class="heading">
            <div class="heading">
              <h3>{!! $blog->tour_package_heading ?: 'Popular <span>Tour Packages</span>' !!}</h3>
              <p>
                {{ $blog->tour_package_description ?: 'Handpicked itineraries loved by travellers — pick yours and get going.' }}
              </p>
            </div>
          </div>

          <div class="swiper-wrap">
            <div class="swiper thirdSilder">
              <div class="swiper-wrapper">
                @foreach($blog->tourPackages as $package)
                  @php
                    $hasDiscount = $package->old_price && $package->old_price > $package->price;
                    $saveAmount = $hasDiscount ? number_format($package->old_price - $package->price) : null;
                    $avgRating = $package->reviews_avg_rating ? number_format($package->reviews_avg_rating, 1) : null;
                    $reviewCount = $package->reviews_count ?? 0;
                    $packageUrl = route('tourpackage.show', $package->slug); // TODO: confirm actual route name
                    $packageImg = $package->main_image && file_exists(public_path($package->main_image))
                      ? asset($package->main_image)
                      : asset('assets/images/blog/banner.avif');
                  @endphp

                  <div class="swiper-slide">
                    <div class="trip_card">
                      <a href="{{ $packageUrl }}" target="_blank" class="img">
                        <img loading="lazy" src="{{ $packageImg }}" alt="{{ $package->name }}" />
                        @if($saveAmount)
                          <span class="save">Save INR {{ $saveAmount }}</span>
                        @endif
                      </a>
                      <div class="content">
                        <div class="rating">
                          @if($package->duration_text)
                            <span>{{ $package->duration_text }}</span>
                          @endif
                          @if($avgRating)
                            <div class="star">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                              </svg>
                              <span>{{ $avgRating }}</span>
                              <em>({{ $reviewCount }})</em>
                            </div>
                          @endif
                        </div>
                        <h3>
                          <a href="{{ $packageUrl }}" target="_blank">{{ $package->name }}</a>
                        </h3>
                        <div class="innerSave">
                          @if($hasDiscount)
                            <s>INR {{ number_format($package->old_price) }}</s>
                            <span class="saveChip">Save INR {{ $saveAmount }}</span>
                          @endif
                        </div>
                        <p class="price">INR
                          {{ number_format($package->price) }}{{ $package->price_unit_text ? ' ' . $package->price_unit_text : '' }}
                        </p>
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
              <button type="button" class="thirdSilder-prev btn-prev" aria-label="Previous">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                  <path fill="#fff"
                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                </svg>
              </button>
              <button type="button" class="thirdSilder-next btn-next" aria-label="Next">
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

    {{-- RELATED DESTINATIONS SWIPER --}}
    @if($blog->destinations->count())
      <section class="related-tour-package">
        <div class="container">
          <div class="heading">
            <div class="heading">
              <h3>{!! $blog->destination_heading ?: 'Related <span>Destinations</span>' !!}</h3>
              <p>
                {{ $blog->destination_description ?: 'Explore the destinations covered in this story.' }}
              </p>
            </div>
          </div>

          <div class="swiper-wrap">
            <div class="swiper thirdSilder">
              <div class="swiper-wrapper">
                @foreach($blog->destinations as $destination)
                  @php
                    $destUrl = route('destination.show', $destination->slug); // TODO: confirm actual route name
                    $destImg = $destination->image && file_exists(public_path($destination->image))
                      ? asset($destination->image)
                      : asset('assets/images/blog/banner.avif');
                  @endphp


                  <div class="swiper-slide">
                    <div class="trip_card">
                      <a href="{{ $destUrl }}" target="_blank" class="img">
                        <img loading="lazy" src="{{ $destImg }}" alt="{{ $destination->name }}" />
                      </a>
                      <div class="content">
                        <div class="rating">
                          @if($destination->duration_text)
                            <span>{{ $destination->duration_text }}</span>
                          @endif
                          @if($destination->location_text)
                            <span>{{ $destination->location_text }}</span>
                          @endif
                        </div>
                        <h3>
                          <a href="{{ $destUrl }}" target="_blank">{{ $destination->name }}</a>
                        </h3>
                        @if($destination->short_description)
                          <p class="price">{{ Str::limit($destination->short_description, 80) }}</p>
                        @endif
                        <div class="btns">
                          <a href="{{ $destUrl }}" target="_blank" class="btn btn-primary"
                            style="width:100%; text-align:center;">
                            Explore Destination
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="swiper-group">
              <button type="button" class="thirdSilder-prev btn-prev" aria-label="Previous">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                  <path fill="#fff"
                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                </svg>
              </button>
              <button type="button" class="thirdSilder-next btn-next" aria-label="Next">
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

    {{-- POPULAR ATTRACTIONS SWIPER --}}
    @if($blog->attractions->count())
      <section class="related-tour-package">
        <div class="container">
          <div class="heading">
            <div class="heading">
              <h3>{!! $blog->attraction_heading ?: 'Popular <span>Attractions</span>' !!}</h3>
              <p>
                {{ $blog->attraction_description ?: 'Must-visit spots related to this blog.' }}
              </p>
            </div>
          </div>

          <div class="swiper-wrap">
            <div class="swiper thirdSilder">
              <div class="swiper-wrapper">
                @foreach($blog->attractions as $attraction)
                  @php
                    $attrUrl = route('attraction.show', $attraction->slug); // TODO: confirm actual route name
                    $attrImg = $attraction->image && file_exists(public_path($attraction->image))
                      ? asset($attraction->image)
                      : asset('assets/images/blog/banner.avif');
                  @endphp

                  <div class="swiper-slide">
                    <div class="trip_card">
                      <a href="{{ $attrUrl }}" target="_blank" class="img">
                        <img loading="lazy" src="{{ $attrImg }}" alt="{{ $attraction->name }}" />
                      </a>
                      <div class="content">
                        <div class="rating">
                          @if($attraction->duration_text)
                            <span>{{ $attraction->duration_text }}</span>
                          @endif
                          @if($attraction->rating)
                            <div class="star">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                              </svg>
                              <span>{{ number_format($attraction->rating, 1) }}</span>
                              <em>({{ $attraction->review_count ?? 0 }})</em>
                            </div>
                          @endif
                        </div>
                        <h3>
                          <a href="{{ $attrUrl }}" target="_blank">{{ $attraction->name }}</a>
                        </h3>
                        @if($attraction->short_description)
                          <p class="price">{{ Str::limit($attraction->short_description, 80) }}</p>
                        @endif
                        <div class="btns">
                          <a href="{{ $attrUrl }}" target="_blank" class="btn btn-primary"
                            style="width:100%; text-align:center;">
                            Explore Attraction
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="swiper-group">
              <button type="button" class="thirdSilder-prev btn-prev" aria-label="Previous">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                  <path fill="#fff"
                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                </svg>
              </button>
              <button type="button" class="thirdSilder-next btn-next" aria-label="Next">
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

    {{-- THINGS TO DO / ACTIVITIES SWIPER --}}
    @if($blog->activities->count())
      <section class="related-tour-package">
        <div class="container">
          <div class="heading">
            <div class="heading">
              <h3>{!! $blog->activity_heading ?: 'Things <span>To Do</span>' !!}</h3>
              <p>
                {{ $blog->activity_description ?: 'Exciting activities you can add to your trip.' }}
              </p>
            </div>
          </div>

          <div class="swiper-wrap">
            <div class="swiper thirdSilder">
              <div class="swiper-wrapper">
                @foreach($blog->activities as $activity)
                  @php
                    $actUrl = route('activities.show', $activity->slug); // TODO: confirm actual route name
                    $actImg = $activity->main_image && file_exists(public_path($activity->main_image))
                      ? asset($activity->main_image)
                      : asset('assets/images/blog/banner.avif');
                  @endphp

                  <div class="swiper-slide">
                    <div class="trip_card">
                      <a href="{{ $actUrl }}" target="_blank" class="img">
                        <img loading="lazy" src="{{ $actImg }}" alt="{{ $activity->name }}" />
                      </a>
                      <div class="content">
                        <div class="rating">
                          @if($activity->duration_text)
                            <span>{{ $activity->duration_text }}</span>
                          @endif
                          @if($activity->rating)
                            <div class="star">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                              </svg>
                              <span>{{ number_format($activity->rating, 1) }}</span>
                              <em>({{ $activity->review_count ?? 0 }})</em>
                            </div>
                          @endif
                        </div>
                        <h3>
                          <a href="{{ $actUrl }}" target="_blank">{{ $activity->name }}</a>
                        </h3>
                        @if($activity->location_label)
                          <div class="innerSave">
                            <span>{{ $activity->location_label }}</span>
                          </div>
                        @endif
                        @if($activity->starting_price)
                          <p class="price">
                            From INR
                            {{ number_format($activity->starting_price) }}{{ $activity->price_unit ? ' ' . $activity->price_unit : '' }}
                          </p>
                        @endif
                        <div class="btns">
                          <a href="{{ $actUrl }}" target="_blank" class="btn btn-primary"
                            style="width:100%; text-align:center;">
                            Explore Activity
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="swiper-group">
              <button type="button" class="thirdSilder-prev btn-prev" aria-label="Previous">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                  <path fill="#fff"
                    d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0" />
                </svg>
              </button>
              <button type="button" class="thirdSilder-next btn-next" aria-label="Next">
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

  </main>

@endsection