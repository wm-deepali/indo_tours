@extends('layouts.app')

@section('title', $subCategory->meta_title ?? $subCategory->name . ' | Indo Tours & Adventures')
@section('meta_description', $subCategory->meta_description ?? 'Indo Tours & Adventures is a leading travel company offering a wide range of tour packages, including domestic and international destinations. Explore the world with our expertly crafted itineraries and exceptional services.')
@section('canonical', $subCategory->canonical_url ?: url()->current())
@section('robots', $subCategory->robots ?: 'index, follow')

@section('og_title', $subCategory->og_title ?? $subCategory->meta_title ?? $subCategory->name)
@section('og_description', $subCategory->og_description ?? $subCategory->meta_description ?? $subCategory->intro_text)
@section('og_image', asset('storage/' . ($subCategory->og_image ?: $subCategory->banner_image_one)))

@section('twitter_title', $subCategory->twitter_title ?? $subCategory->og_title ?? $subCategory->meta_title ?? $subCategory->name)
@section('twitter_description', $subCategory->twitter_description ?? $subCategory->og_description ?? $subCategory->meta_description ?? $subCategory->intro_text)
@section('twitter_image', asset('storage/' . ($subCategory->twitter_card_image ?: ($subCategory->og_image ?: $subCategory->banner_image_one))))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/listing/listing.css') }}" />
@endpush

@section('content')

    <main>

        <!-- BASIC INFO SECTION -->
        <section class="listing-banner">
            <div class="bg">
                <div class="swiper listSlider">
                    <div class="swiper-wrapper">
                        @if($subCategory->banner_image_one)
                            <div class="swiper-slide">
                                <img loading="lazy" src="{{ asset('storage/' . $subCategory->banner_image_one) }}"
                                    alt="{{ $subCategory->name }}" />
                            </div>
                        @endif

                        @if($subCategory->banner_image_two)
                            <div class="swiper-slide">
                                <img loading="lazy" src="{{ asset('storage/' . $subCategory->banner_image_two) }}"
                                    alt="{{ $subCategory->name }}" />
                            </div>
                        @endif

                        @if(!$subCategory->banner_image_one && !$subCategory->banner_image_two)
                            <div class="swiper-slide">
                                <img loading="lazy" src="{{ asset('assets/images/listing/banner1.jpg') }}"
                                    alt="{{ $subCategory->name }}" />
                            </div>
                        @endif
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

                            @if($subCategory->category)
                                <li>
                                    <a
                                        href="{{ route('category.show', $subCategory->category->slug) }}">{{ $subCategory->category->name }}</a>
                                </li>
                                <li>
                                    <span class="breadcrumb-separator">/</span>
                                </li>
                            @endif

                            <li>
                                <a href="{{ route('subcategory.show', $subCategory->slug) }}"
                                    class="active">{{ $subCategory->name }}</a>
                            </li>
                        </ul>
                    </nav>

                    <div class="bg-wrapper">
                        <div class="content">
                            @if($subCategory->offer_tag_text)
                                <span class="offer-tag">
                                    {{ $subCategory->offer_tag_text }}
                                </span>
                            @endif

                            <h1>{{ $subCategory->h1 ?? $subCategory->name }}</h1>

                            <span class="divider"></span>

                            @if($subCategory->intro_text)
                                <p>{!! nl2br(e($subCategory->intro_text)) !!}</p>
                            @endif
                            <div class="price-row">
                                <span>Starting at</span>
                                <del class="old-price">INR 24,583</del>
                                <h3>INR 14,750</h3>
                            </div>

                            @if($subCategory->button1_text)
                                <a href="{{ $subCategory->button1_url ?? 'javascript:void(0)' }}" class="btn btn-primary">
                                    {{ $subCategory->button1_text }}
                                    <i class="icon-arrow"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- HIGHLIGHTS SECTION -->
        <section class="listing-secB">
            <div class="container">
                <div class="heading">
                    <h3>{{ $subCategory->heading_text }} <span>{{ $subCategory->heading_highlight }}</span></h3>
                    @if($subCategory->heading_intro)
                        <p>{{ $subCategory->heading_intro }}</p>
                    @endif
                </div>

                @if($subCategory->highlights->count())
                    <div class="highlight-grid">
                        @foreach($subCategory->highlights as $highlight)
                            <div class="highlight-card">
                                <div class="icon">
                                    @if($highlight->icon_image)
                                        <img src="{{ asset('storage/' . $highlight->icon_image) }}" alt="{{ $highlight->title }}" />
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                            <path d="M0 0h24v24H0z" fill="none" />
                                            <path fill="currentColor"
                                                d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                        </svg>
                                    @endif
                                </div>
                                <h6>{{ $highlight->title }}</h6>
                                <p>{{ $highlight->value }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="center-btn">
                    @if($subCategory->button1_text)
                        <a href="{{ $subCategory->button1_url ?? 'javascript:void()' }}"
                            class="btn btn-primary">{{ $subCategory->button1_text }}</a>
                    @endif
                    @if($subCategory->button2_text)
                        <a href="{{ $subCategory->button2_url ?? 'javascript:void()' }}"
                            class="btn btn-outline-primary">{{ $subCategory->button2_text }}</a>
                    @endif
                </div>
            </div>
        </section>

        <!-- PACKAGES SECTION -->
        @if($subCategory->tourPackages->isNotEmpty())
            <section class="listing-secA">
                <div class="container">
                    <div class="heading">
                        <h3>{{ $subCategory->name }} <span>Tour Packages</span></h3>
                        <p>
                            Choose from our handpicked travel experiences, designed to make
                            every journey unforgettable.
                        </p>
                    </div>
                    <div class="swiper-wrap">
                        <div class="swiper thirdSilder">
                            <div class="swiper-wrapper">
                                @foreach($subCategory->tourPackages as $package)
                                    <div class="swiper-slide">
                                        <div class="trip_card2">
                                            <a href="{{ route('tourpackage.show', $package->slug) }}" target="_blank" class="img">
                                                @if($package->main_image)
                                                    <img loading="lazy" src="{{ asset('storage/' . $package->main_image) }}"
                                                        alt="{{ $package->name }}" />
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
                                                </div>

                                                <h3><a href="{{ route('tourpackage.show', $package->slug) }}"
                                                        target="_blank">{{ $package->name }}</a></h3>

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
                                                    <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                                            <path
                                                                d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                                        </svg>
                                                    </a>
                                                    <button data-model=".enquire-pop" data-package-id="{{ $package->id }}"
                                                        class="btn btn-primary">Enquire Now</button>
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
                        <a href="{{ route('subcategory.show', $subCategory->slug) }}#packages"
                            class="btn btn-outline-primary">View All</a>
                    </div>
                </div>
            </section>
        @endif

        <!-- OFFER BANNER SECTION -->
        <section class="group-offer-banner">
            <div class="container">
                <div class="group-offer-banner__inner">
                    <div class="group-offer-banner__content">
                        @if($subCategory->cta_badge_text)
                            <span class="group-offer-banner__badge">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path fill="currentColor"
                                        d="M12 2l1.6 4.8L18 5l-1.8 4.4L21 12l-4.8 1.6L18 19l-4.4-1.8L12 22l-1.6-4.8L6 19l1.8-4.4L3 12l4.8-1.6L6 5l4.4 1.8z" />
                                </svg>
                                {{ $subCategory->cta_badge_text }}
                            </span>
                        @endif

                        @if($subCategory->cta_title)
                            <h3>{{ $subCategory->cta_title }}</h3>
                        @endif

                        @if($subCategory->cta_description)
                            <p>{{ $subCategory->cta_description }}</p>
                        @endif

                        @if($subCategory->ctaPerks->count())
                            <ul class="group-offer-banner__perks">
                                @foreach($subCategory->ctaPerks as $perk)
                                    <li>{{ $perk->text }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="group-offer-banner__actions">
                            @if($subCategory->cta_button_text)
                                <a href="{{ $subCategory->cta_button_url ?? 'javascript:void()' }}" class="btn btn-white">
                                    {{ $subCategory->cta_button_text }}
                                </a>
                            @endif

                            @if($subCategory->cta_button2_text)
                                <a href="javascript:void()" data-model=".enquire-pop" class="btn btn-outline-white">
                                    {{ $subCategory->cta_button2_text }}
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="group-offer-banner__media">
                        <div class="group-offer-banner__img group-offer-banner__img--secondary">
                            <img loading="lazy"
                                src="{{ $subCategory->cta_image ? asset('storage/' . $subCategory->cta_image) : asset('assets/images/listing/banner1.jpg') }}"
                                alt="{{ $subCategory->name }}" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ACTIVITIES SECTION -->
        @if($activities->count())
            <section class="listing-secE">
                <div class="container">
                    <div class="heading">
                        <h3>Popular <span>{{ $subCategory->name }} Activities</span></h3>
                        <p>
                            Handpicked experiences and things to do, curated to make your trip more memorable.
                        </p>
                    </div>
                    <div class="swiper-wrap">
                        <div class="swiper thirdSilder">
                            <div class="swiper-wrapper">
                                @foreach($activities as $activity)
                                    <div class="swiper-slide">
                                        <div class="trip_card">
                                            <a href="{{ route('activities.show', $activity->slug) }}" target="_blank" class="img">
                                                @if($activity->main_image)
                                                    <img loading="lazy" src="{{ asset('storage/' . $activity->main_image) }}"
                                                        alt="{{ $activity->name }}" />
                                                @endif
                                                @if($activity->banner_tag)
                                                    <span class="save">{{ $activity->banner_tag }}</span>
                                                @endif
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
                                                            <span>{{ $activity->rating }}</span>
                                                            @if($activity->review_count)
                                                                <em>({{ $activity->review_count }})</em>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>

                                                <h3>
                                                    <a href="{{ route('activities.show', $activity->slug) }}" target="_blank">
                                                        {{ $activity->name }}
                                                    </a>
                                                </h3>

                                                @if($activity->starting_price)
                                                    <p class="price">
                                                        {{ $activity->price_unit ?? 'INR' }}
                                                        {{ number_format($activity->starting_price) }}
                                                    </p>
                                                @endif

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
                                @endforeach
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
                </div>
            </section>
        @endif

        <!-- REVIEWS SECTION -->
        @if($reviews->count())
            <section class="listing-secD">
                <div class="container">
                    <div class="heading">
                        <h3>Loved by <span>{{ $subCategory->name }} Travellers</span></h3>
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
                            @php $avgRating = round($reviews->avg('rating'), 1); @endphp
                            <div class="ring">
                                <svg viewBox="0 0 120 120">
                                    <circle class="ring-bg" cx="60" cy="60" r="52"></circle>
                                    <circle class="ring-fill" cx="60" cy="60" r="52"></circle>
                                </svg>
                                <div class="ring-score">
                                    <h2>{{ $avgRating }}</h2>
                                    <span>out of 5</span>
                                </div>
                            </div>

                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                    </svg>
                                @endfor
                            </div>

                            <a href="javascript:void()" class="review-link">
                                {{ number_format($reviews->count()) }} {{ $subCategory->name }} Reviews
                            </a>
                            <p class="review-sub">by customers from 70+ countries</p>
                        </div>

                        <div class="swiper_wrap">
                            <div class="swiper TestimonialSlider2">
                                <div class="swiper-wrapper">
                                    @foreach($reviews as $review)
                                        <div class="swiper-slide">
                                            <div class="card">
                                                <div class="header">
                                                    @if($review->photo)
                                                        <img loading="lazy" src="{{ asset('storage/' . $review->photo) }}"
                                                            alt="{{ $review->full_name }}" />
                                                    @else
                                                        <div class="avatar-initials">{{ $review->initials() }}</div>
                                                    @endif

                                                    <div class="name">
                                                        <h6>{{ $review->full_name }}</h6>
                                                        @if($review->designation)
                                                            <span class="designation">{{ $review->designation }}</span>
                                                        @endif

                                                        <div class="badge-star">
                                                            <svg viewBox="0 0 24 24" fill="currentColor">
                                                                <path
                                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                            </svg>
                                                            <span>{{ number_format($review->rating, 1) }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="quotes">
                                                        <svg width="30" height="22" viewBox="0 0 44 34" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5654 42.7691 19.795 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                                                                fill="#F3F4F6" stroke="#E5E7EB" />
                                                        </svg>
                                                    </div>
                                                </div>

                                                <p class="quote">{{ $review->review }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- PROMO BANNER SECTION -->
        <section class="listing-secG">
            <div class="container">
                <div class="grid">
                    <div class="glow"></div>

                    <div class="promo-left">
                        @if($subCategory->promo_badge_text)
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

                                {{ $subCategory->promo_badge_text }}
                            </span>
                        @endif

                        @if($subCategory->promo_title)
                            <h3>{{ $subCategory->promo_title }}</h3>
                        @endif

                        @if($subCategory->promo_description)
                            <p>{{ $subCategory->promo_description }}</p>
                        @endif

                        @if($subCategory->promo_button_text)
                            <a href="{{ $subCategory->promo_button_url ?? 'javascript:void()' }}" class="btn btn-promo">
                                {{ $subCategory->promo_button_text }}
                                <i class="icon-arrow"></i>
                            </a>
                        @endif
                    </div>

                    @if($subCategory->promo_end_at)
                        <div class="promo-right">
                            <span class="countdown-label">Hurry, sale ends in</span>

                            <div class="countdown" id="countdown"
                                data-end="{{ $subCategory->promo_end_at->format('Y-m-d\TH:i:s') }}">
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

        <!-- ATTRACTIONS SECTION -->
        @if($attractions->count())
            <section class="listing-secF">
                <div class="container">
                    <div class="heading">
                        <h3>Popular <span>{{ $subCategory->name }} Attractions</span></h3>
                        @if($subCategory->intro_text)
                            <p>{{ $subCategory->intro_text }}</p>
                        @endif
                    </div>

                    <div class="swiper-wrap">
                        <div class="swiper thirdSilder">
                            <div class="swiper-wrapper">
                                @foreach($attractions as $attraction)

                                    <div class="swiper-slide">
                                        <div class="trip_card">
                                            <a href="{{ route('attraction.show', $attraction->slug) }}" target="_blank" class="img">
                                                <img loading="lazy"
                                                    src="{{ $attraction->image ? asset('storage/' . $attraction->image) : asset('assets/images/listing/placeholder.jpg') }}"
                                                    alt="{{ $attraction->name }}" />
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
                                                            <span>{{ $attraction->rating }}</span>
                                                            @if($attraction->review_count)
                                                                <em>({{ $attraction->review_count }})</em>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>

                                                <h3>
                                                    <a href="{{ route('attraction.show', $attraction->slug) }}" target="_blank">
                                                        {{ $attraction->name }}
                                                    </a>
                                                </h3>

                                                @if($attraction->short_description)
                                                    <p style="font-size:13px;color:#6d7175;margin:6px 0 0;">
                                                        {{ \Illuminate\Support\Str::limit($attraction->short_description, 80) }}
                                                    </p>
                                                @endif

                                                <div class="btns" style="margin-top:14px;">
                                                    <a href="tel:+91 000 000 000" class="btn btn-outline-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                                            <path
                                                                d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                                        </svg>
                                                    </a>

                                                    <a href="{{ route('attraction.show', $attraction->slug) }}" target="_blank"
                                                        class="btn btn-primary">
                                                        View Details
                                                    </a>
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
                </div>
            </section>
        @endif

        <!-- FAQ SECTION -->
        <section class="listing-secI">
            <div class="container">
                <div class="heading">
                    <h3>{{ $subCategory->faq_heading }} <span>{{ $subCategory->faq_heading_highlight }}</span></h3>
                    @if($subCategory->faq_intro)
                        <p>{{ $subCategory->faq_intro }}</p>
                    @endif
                </div>

                @if($subCategory->faqs->count())
                    <div class="accordion-wrapper">
                        @foreach($subCategory->faqs as $faq)
                            <div class="accordion-item {{ $loop->first ? 'active' : '' }}">
                                <div class="accordion-header">
                                    <span class="accordion-index">{{ sprintf('%02d', $loop->iteration) }}</span>
                                    <h4>{{ $faq->question }}</h4>
                                    <span class="accordion-icon">{{ $loop->first ? '−' : '+' }}</span>
                                </div>

                                <div class="accordion-content" style="{{ $loop->first ? 'display: block' : '' }}">
                                    <p>{{ $faq->answer }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <!-- DESTINATIONS SECTION -->
        @if($destinations->count())
            <section class="listing-secA">
                <div class="container">
                    <div class="heading">
                        <h3>Explore Nearby <span>Destinations</span></h3>
                        <p>
                            Discover beautiful destinations around {{ $subCategory->name }} and plan your
                            perfect getaway.
                        </p>
                    </div>

                    <div class="swiper-wrap">
                        <div class="swiper thirdSilder">
                            <div class="swiper-wrapper">
                                @foreach($destinations as $destination)

                                    <div class="swiper-slide">
                                        <a href="{{ route('destination.show', $destination->slug) }}" target="_blank"
                                            class="trip_card3">
                                            <div class="img">
                                                <img loading="lazy"
                                                    src="{{ $destination->image ? asset('storage/' . $destination->image) : asset('assets/images/listing/placeholder.jpg') }}"
                                                    alt="{{ $destination->name }}" />
                                            </div>

                                            <div class="content">
                                                <p class="type">Tour Packages</p>
                                                <h3 class="place">{{ $destination->name }}</h3>

                                                @if($destination->best_time_text)
                                                    <p class="best-time" style="font-size:12px;color:#8c9196;margin:2px 0 0;">
                                                        Best time: {{ $destination->best_time_text }}
                                                    </p>
                                                @endif

                                                <div class="foot">
                                                    @if($destination->budget_text)
                                                        <p class="price"><small>Starts at</small>{{ $destination->budget_text }}</p>
                                                    @endif

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
                        <a href="javascript:void()" class="btn btn-outline-primary">View All</a>
                    </div>
                </div>
            </section>
        @endif

        <!-- HYPERLINK SECTION -->
        @if($destinations->isNotEmpty() || $attractions->isNotEmpty() || $activities->isNotEmpty())
            <section class="seo-links-sec">
                <div class="container">
                    <div class="heading">
                        <h3>Explore More <span>About {{ $subCategory->name }}</span></h3>
                        <p>
                            {{ $subCategory->short_description ?? 'Discover popular tours, itineraries, places to visit and experiences to make your journey unforgettable.' }}
                        </p>
                    </div>

                    <div class="seo-links-wrapper">
                        {{-- Destinations --}}
                        @if($destinations->isNotEmpty())
                            <div class="seo-link-block">
                                <h4>Popular {{ $subCategory->name }} Destinations</h4>
                                <div class="seo-link-wrap">
                                    @foreach($destinations as $destination)
                                        <a href="{{ route('destination.show', $destination->slug) }}">{{ $destination->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Attractions --}}
                        @if($attractions->isNotEmpty())
                            <div class="seo-link-block">
                                <h4>Top {{ $subCategory->name }} Attractions</h4>
                                <div class="seo-link-wrap">
                                    @foreach($attractions as $attraction)
                                        <a href="{{ route('attraction.show', $attraction->slug) }}">{{ $attraction->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Activities --}}
                        @if($activities->isNotEmpty())
                            <div class="seo-link-block">
                                <h4>Things To Do in {{ $subCategory->name }}</h4>
                                <div class="seo-link-wrap">
                                    @foreach($activities as $activity)
                                        <a href="{{ route('activities.show', $activity->slug) }}">{{ $activity->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Static evergreen info block --}}
                        <div class="seo-link-block">
                            <h4>All About {{ $subCategory->name }} Trip</h4>
                            <div class="seo-link-wrap">
                                <a href="javascript:void()">Tourist Places in {{ $subCategory->name }}</a>
                                <a href="javascript:void()">What to Do in {{ $subCategory->name }}</a>
                                <a href="javascript:void()">Places to Stay in {{ $subCategory->name }}</a>
                                <a href="javascript:void()">Best Time to Visit {{ $subCategory->name }}</a>
                                <a href="javascript:void()">How to Reach {{ $subCategory->name }}</a>
                                <a href="javascript:void()">{{ $subCategory->name }} Travel Guide</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

    </main>

@endsection

@push('scripts')

    @php
        $subCategoryBreadcrumbItems = [
            ['name' => 'Home', 'url' => url('/')],
        ];

        if ($subCategory->category) {
            $subCategoryBreadcrumbItems[] = [
                'name' => $subCategory->category->name,
                'url' => route('category.show', $subCategory->category->slug),
            ];
        }

        $subCategoryBreadcrumbItems[] = [
            'name' => $subCategory->name,
            'url' => url()->current(),
        ];

        $subCategorySchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => collect($subCategoryBreadcrumbItems)->map(function ($item, $i) {
                        return [
                            '@type' => 'ListItem',
                            'position' => $i + 1,
                            'name' => $item['name'],
                            'item' => $item['url'],
                        ];
                    })->values()->all(),
                ],
                array_filter([
                    '@type' => 'CollectionPage',
                    '@id' => url()->current() . '#subcategory',
                    'name' => $subCategory->h1 ?? $subCategory->name,
                    'description' => $subCategory->meta_description ?? $subCategory->intro_text,
                    'url' => url()->current(),
                    'image' => $subCategory->banner_image_one ? asset('storage/' . $subCategory->banner_image_one) : null,
                ]),
            ],
        ];

        if ($subCategory->faqs->isNotEmpty()) {
            $subCategorySchema['@graph'][] = [
                '@type' => 'FAQPage',
                'mainEntity' => $subCategory->faqs->map(function ($faq) {
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
        {!! json_encode($subCategorySchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

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

    @if($subCategory->promo_end_at)
        <script>
            (function () {
                const el = document.getElementById('countdown');
                const endTime = new Date(el.dataset.end).getTime();

                function pad(n) { return String(n).padStart(2, '0'); }

                function tick() {
                    const now = Date.now();
                    let diff = Math.max(0, endTime - now);

                    const days = Math.floor(diff / 86400000);
                    diff -= days * 86400000;
                    const hours = Math.floor(diff / 3600000);
                    diff -= hours * 3600000;
                    const minutes = Math.floor(diff / 60000);
                    diff -= minutes * 60000;
                    const seconds = Math.floor(diff / 1000);

                    el.querySelector('[data-unit="days"] .digit').textContent = pad(days);
                    el.querySelector('[data-unit="hours"] .digit').textContent = pad(hours);
                    el.querySelector('[data-unit="minutes"] .digit').textContent = pad(minutes);
                    el.querySelector('[data-unit="seconds"] .digit').textContent = pad(seconds);
                }

                tick();
                setInterval(tick, 1000);
            })();
        </script>
    @endif

    <script>
        if (window.Swiper) {
            new Swiper('.listSlider', {
                loop: true,
                autoplay: { delay: 4000 },
            });
        }

        document.querySelectorAll('.accordion-header').forEach(function (header) {
            header.addEventListener('click', function () {
                const item = header.closest('.accordion-item');
                const content = item.querySelector('.accordion-content');
                const icon = header.querySelector('.accordion-icon');
                const isOpen = content.style.display === 'block';

                document.querySelectorAll('.accordion-item').forEach(function (i) {
                    i.classList.remove('active');
                    i.querySelector('.accordion-content').style.display = 'none';
                    i.querySelector('.accordion-icon').textContent = '+';
                });

                if (!isOpen) {
                    item.classList.add('active');
                    content.style.display = 'block';
                    icon.textContent = '−';
                }
            });
        });
    </script>

@endpush