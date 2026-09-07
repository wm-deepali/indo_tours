@extends('layouts.app')

@section('title', $destination->meta_title ?: $destination->name . ' | Indo Tours & Adventures')
@section('meta_description', $destination->meta_description ?: $destination->short_description)
@section('canonical', $destination->canonical_url ?: url()->current())

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/destination-detail/detail.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/themes/base/jquery-ui.min.css" />
@endpush

@section('content')

    {{-- Hero Section --}}
    <section class="detail-banner">
        <div class="container">
            <div class="grid">
                @php $galleryImages = $destination->galleries; @endphp

                @forelse ($galleryImages->take(4) as $gallery)
                    <a href="{{ asset('storage/' . $gallery->image) }}" data-fancybox="gallery" class="item">
                        <img loading="lazy" src="{{ asset('storage/' . $gallery->image) }}"
                            alt="{{ $gallery->caption ?? $destination->name }}" />
                        <div class="image-overlay">
                            <h3>{{ $gallery->caption ?? $destination->name }}</h3>
                            <span>{{ $destination->location_text }}</span>
                        </div>
                    </a>
                @empty
                    <a href="{{ $destination->image ? asset('storage/' . $destination->image) : asset('assets/images/blog/default.jpg') }}"
                        data-fancybox="gallery" class="item">
                        <img loading="lazy"
                            src="{{ $destination->image ? asset('storage/' . $destination->image) : asset('assets/images/blog/default.jpg') }}"
                            alt="{{ $destination->name }}" />
                        <div class="image-overlay">
                            <h3>{{ $destination->name }}</h3>
                            <span>{{ $destination->location_text }}</span>
                        </div>
                    </a>
                @endforelse

                @if ($galleryImages->count() > 4)
                    <a href="{{ asset('storage/' . $galleryImages[4]->image) }}" data-fancybox="gallery"
                        class="item more-images">
                        <img loading="lazy" src="{{ asset('storage/' . $galleryImages[4]->image) }}"
                            alt="{{ $destination->name }} attractions" />
                        <div class="image-overlay">
                            <strong>{{ $galleryImages->count() - 4 }}+</strong>
                            <span>More Attractions</span>
                        </div>
                    </a>

                    @foreach ($galleryImages->slice(4) as $gallery)
                        <a href="{{ asset('storage/' . $gallery->image) }}" data-fancybox="gallery" class="gallery-hidden"></a>
                    @endforeach
                @endif
            </div>

            <!-- Destination Information -->
            <div class="detail_content">
                <ul class="Breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('destinations') }}">Destinations</a></li>
                    @if ($destination->country)
                        <li><a href="javascript:void(0)">{{ $destination->country->name }}</a></li>
                    @endif
                    <li>{{ $destination->name }}</li>
                </ul>

                <div class="info-row">
                    <!-- LEFT -->
                    <div class="info-left">
                        <h1 class="title">{{ $destination->h1 ?: $destination->name }}</h1>

                        <p class="location">{{ $destination->location_text }}</p>

                        <div class="rating">
                            <span class="stars">★★★★★</span>
                            <span>4.8/5</span>
                            <span class="count">· 124 Reviews</span>
                        </div>

                        <p class="desc">{{ $destination->description }}</p>
                    </div>

                    <!-- RIGHT -->
                    <div class="info-right">
                        <div class="facts">
                            @if ($destination->duration_text)
                                <div class="facts-item">
                                    <span class="label">Duration</span>
                                    <span class="value">{{ $destination->duration_text }}</span>
                                </div>
                            @endif

                            @if ($destination->best_time_text)
                                <div class="facts-item">
                                    <span class="label">Best Time</span>
                                    <span class="value">{{ $destination->best_time_text }}</span>
                                </div>
                            @endif

                            @if ($destination->budget_text)
                                <div class="facts-item">
                                    <span class="label">Budget</span>
                                    <span class="value">{{ $destination->budget_text }}</span>
                                </div>
                            @endif

                            @if (!empty($destination->best_for_tags))
                                <div class="facts-item">
                                    <span class="label">Best For</span>
                                    <div class="tags">
                                        @foreach ($destination->best_for_tags as $tag)
                                            <span>{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="actions">
                            <button class="btn btn-outline-primary" type="button">＋ Add to My Trip</button>
                            <button class="btn btn-primary" type="button">Plan a Trip</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Tour Packages Section --}}
    <section class="tour-package-near-h1">
        <div class="container">
            <div class="heading">
                <h3>Kashmir <span>Tour Packages</span></h3>
                <p>
                    Handpicked itineraries to help you plan the perfect Kashmir trip.
                </p>
            </div>

            <div class="swiper-wrap">
                <div class="swiper thirdSilder">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="trip_card">
                                <a href="listing-detail.html" target="_blank" class="img">
                                    <img loading="lazy" src="{{ asset('assets/images/attraction/kashmir1.jpg') }}"
                                        alt="Kashmir Escape Package" />
                                    <span class="save">Save INR 5,900</span>
                                </a>
                                <div class="content">
                                    <div class="rating">
                                        <span>5N / 6D</span>
                                        <div class="star">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                            <span>4.6</span>
                                            <em>(78)</em>
                                        </div>
                                    </div>

                                    <h3>
                                        <a href="listing-detail.html" target="_blank">Kashmir Escape</a>
                                    </h3>

                                    <div class="innerSave">
                                        <s>INR 30,800</s>
                                        <span class="saveChip">Save INR 5,900</span>
                                    </div>
                                    <p class="price">INR 24,900</p>

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

                        <div class="swiper-slide">
                            <div class="trip_card">
                                <a href="listing-detail.html" target="_blank" class="img">
                                    <img loading="lazy" src="{{ asset('assets/images/attraction/kashmir2.jpg') }}"
                                        alt="Good Vibes Kashmir Package" />
                                    <span class="save">Save INR 7,200</span>
                                </a>
                                <div class="content">
                                    <div class="rating">
                                        <span>5N / 6D</span>
                                        <div class="star">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                            <span>4.7</span>
                                            <em>(103)</em>
                                        </div>
                                    </div>

                                    <h3>
                                        <a href="listing-detail.html" target="_blank">Good Vibes Kashmir</a>
                                    </h3>

                                    <div class="innerSave">
                                        <s>INR 38,000</s>
                                        <span class="saveChip">Save INR 7,200</span>
                                    </div>
                                    <p class="price">INR 30,800</p>

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

                        <div class="swiper-slide">
                            <div class="trip_card">
                                <a href="listing-detail.html" target="_blank" class="img">
                                    <img loading="lazy" src="{{ asset('assets/images/attraction/kashmir3.jpg') }}"
                                        alt="Kashmir Explorer Package" />
                                    <span class="save">Save INR 9,000</span>
                                </a>
                                <div class="content">
                                    <div class="rating">
                                        <span>6N / 7D</span>
                                        <div class="star">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                            <span>4.6</span>
                                            <em>(64)</em>
                                        </div>
                                    </div>

                                    <h3>
                                        <a href="listing-detail.html" target="_blank">Kashmir Explorer</a>
                                    </h3>

                                    <div class="innerSave">
                                        <s>INR 44,900</s>
                                        <span class="saveChip">Save INR 9,000</span>
                                    </div>
                                    <p class="price">INR 35,900</p>

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

                        <div class="swiper-slide">
                            <div class="trip_card">
                                <a href="listing-detail.html" target="_blank" class="img">
                                    <img loading="lazy" src="{{ asset('assets/images/attraction/kashmir4.jpg') }}"
                                        alt="Kashmir Honeymoon Package" />
                                    <span class="save">Save INR 11,500</span>
                                </a>
                                <div class="content">
                                    <div class="rating">
                                        <span>5N / 6D</span>
                                        <div class="star">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                            <span>4.8</span>
                                            <em>(120)</em>
                                        </div>
                                    </div>

                                    <h3>
                                        <a href="listing-detail.html" target="_blank">Kashmir Honeymoon</a>
                                    </h3>

                                    <div class="innerSave">
                                        <s>INR 52,400</s>
                                        <span class="saveChip">Save INR 11,500</span>
                                    </div>
                                    <p class="price">INR 40,900</p>

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

    {{-- Verdict Section --}}
    <section class="detail-secA">
        <div class="container">
            <div class="grid">
                <!-- LEFT: verdict panel -->
                <div class="panel">
                    <div class="panel__top">
                        <p class="eyebrow">Quick decision</p>
                        <h3>{{ $destination->verdict_title ?: 'Is ' . $destination->name . ' right for you?' }}</h3>
                        <p>
                            Match what you're looking for against what {{ $destination->name }} actually
                            offers, before you plan a single day.
                        </p>
                    </div>

                    <div class="panel__verdict">
                        <span class="verdict__label">Recommended for</span>
                        <p class="verdict__value">
                            {{ $destination->recommended_for }}
                        </p>
                        <button class="btn btn-white" type="button">Enquire Now</button>
                    </div>
                </div>

                <!-- RIGHT: match list -->
                <div class="matches">
                    @foreach ($destination->matches as $index => $match)
                        <div class="match">
                            <div>
                                <span class="match__num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <p class="match__want">{{ $match->want }}</p>
                            </div>
                            <div class="match__offer">
                                <div class="icon">
                                    <img loading="lazy"
                                        src="{{ $match->icon ? asset('storage/' . $match->icon) : asset('assets/icon/mount.png') }}" />
                                </div>
                                <p>{{ $match->offer_text }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Stay Section --}}
    <section class="detail-secB">
        <div class="container">
            <div class="heading">
                <h3>Where Should You <span>Stay in {{ $destination->name }}?</span></h3>
                <p>
                    {{ $destination->name }} is spread across several areas, and where you stay can
                    change the experience of your trip.
                </p>
            </div>

            <div class="stay-flex">
                @foreach ($destination->areas as $index => $area)
                    <div class="area @if($index === 0) is-open @endif" data-area="{{ Str::slug($area->name) }}">
                        <img loading="lazy"
                            src="{{ $area->image ? asset('storage/' . $area->image) : asset('assets/images/blog/default.jpg') }}"
                            alt="{{ $area->name }}" />

                        <div class="area__collapsed">
                            <span class="num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="name">{{ $area->name }}</span>
                        </div>

                        <div class="area__expanded">
                            @if ($area->tag)
                                <div class="tags-row">
                                    <span>{{ $area->tag }}</span>
                                </div>
                            @endif

                            <h4>{{ $area->name }}</h4>

                            @if ($area->stay_duration)
                                <div class="meta-row">
                                    <div class="meta-item">
                                        <span class="meta-item__label">Stay</span>
                                        <span class="meta-item__value">{{ $area->stay_duration }}</span>
                                    </div>
                                </div>
                            @endif

                            @if ($area->why_text)
                                <p class="why">{{ $area->why_text }}</p>
                            @endif

                            @if ($area->nearby_text)
                                <p class="nearby">
                                    <strong>Nearby:</strong>
                                    {{ $area->nearby_text }}
                                </p>
                            @endif

                            <a href="javascript:void(0)" class="btn btn-outline-white">
                                Enquire Now
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why Visit Section --}}
    <section class="detail-secC">
        <div class="container">
            <div class="heading">
                <h3>Why Visit <span>{{ $destination->name }}?</span></h3>
                <p>The reasons travelers keep coming back</p>
            </div>

            <div class="why-kashmir__wrap">
                <div class="why-kashmir__media">
                    <img loading="lazy"
                        src="{{ $destination->why_visit_image ? asset('storage/' . $destination->why_visit_image) : asset('assets/images/blog/default.jpg') }}"
                        alt="{{ $destination->name }}" />
                    @if ($destination->why_visit_media_tag)
                        <div class="why-kashmir__media-tag">
                            <img loading="lazy" src="{{ asset('assets/icon/mount.png') }}" />
                            {{ $destination->why_visit_media_tag }}
                        </div>
                    @endif
                </div>

                <div class="why-kashmir__list">
                    @foreach ($destination->highlights as $highlight)
                        <div class="why-kashmir__item">
                            <span class="why-kashmir__icon">
                                <img loading="lazy"
                                    src="{{ $highlight->icon ? asset('storage/' . $highlight->icon) : asset('assets/icon/mount.png') }}" />
                            </span>
                            <div class="why-kashmir__text">
                                <h4>{{ $highlight->title }}</h4>
                                <p>{{ $highlight->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Places Section --}}
    <section class="detail-secD places">
        <div class="container">
            <div class="heading">
                <h3>Places to <span>Visit</span></h3>
                <p>Where your {{ $destination->name }} journey takes you</p>
            </div>

            <div class="places__grid">
                @foreach ($destination->places as $place)
                    <a href="#" class="places__card @if($place->is_featured) places__card--large @endif">
                        <img loading="lazy"
                            src="{{ $place->image ? asset('storage/' . $place->image) : asset('assets/images/blog/default.jpg') }}"
                            alt="{{ $place->name }}" />
                        <div class="places__overlay">
                            <h4>{{ $place->name }}</h4>
                            <p>{{ $place->description }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="places__cta">
                <a href="#" class="btn btn-primary">Explore All Places</a>
            </div>
        </div>
    </section>

    {{-- Offer Banner --}}
    @php $banner = $destination->banner; @endphp
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
                        {{ $banner->badge_text ?? 'Limited-Time Offer' }}
                    </span>

                    <h3>{{ $banner->heading ?? 'Book Your Trip Early — Save Up to 40%' }}</h3>

                    <p>{{ $banner->description ?? 'Grab early-booking discounts, seasonal deals and free add-on experiences before this offer ends.' }}
                    </p>

                    <ul class="group-offer-banner__perks">
                        @forelse (($banner->perks ?? []) as $perk)
                            <li>{{ $perk }}</li>
                        @empty
                            <li>Early Bird Discount up to 40% Off</li>
                            <li>Free Airport Transfers Included</li>
                            <li>Flexible Rescheduling on Select Packages</li>
                        @endforelse
                    </ul>

                    <div class="group-offer-banner__actions">
                        <a href="{{ $banner->cta_primary_link ?? '' }}" class="btn btn-white">
                            {{ $banner->cta_primary_text ?? 'Explore Packages' }}
                        </a>
                        <a href="javascript:void()" data-model=".enquire-pop" class="btn btn-outline-white">
                            {{ $banner->cta_secondary_text ?? 'Get A Quote' }}
                        </a>
                    </div>
                </div>

                <div class="group-offer-banner__media">
                    <div class="group-offer-banner__img group-offer-banner__img--secondary">
                        <img loading="lazy"
                            src="{{ $banner && $banner->image ? asset('storage/' . $banner->image) : asset('assets/images/home/party.jpg') }}"
                            alt="Travellers enjoying their trip" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Experiences --}}
    <section class="detail-secE activities">
        <div class="container">
            <div class="heading">
                <h3>Experiences You <span>Shouldn't Miss</span></h3>
                <p>Handpicked moments that define a {{ $destination->name }} trip</p>
            </div>

            <div class="activities__grid">
                @foreach ($destination->activities as $activity)
                    <div class="activities__card @if($activity->is_featured) activities__card--large @endif">
                        <img loading="lazy"
                            src="{{ $activity->image ? asset('storage/' . $activity->image) : asset('assets/images/blog/default.jpg') }}"
                            alt="{{ $activity->title }}" />
                        <div class="activities__overlay">
                            @if ($activity->tag)
                                <span class="activities__tag">{{ $activity->tag }}</span>
                            @endif
                            <h4>{{ $activity->title }}</h4>
                            <p>{{ $activity->description }}</p>
                            <button type="button" class="btn btn-white" data-model=".enquire-pop">Enquire Now</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Routes --}}
    <section class="detail-secF routes">
        <div class="container">
            <div class="heading">
                <h3>Choose Your <span>{{ $destination->name }} Route</span></h3>
                <p>From a quick escape to a slow, complete exploration</p>
            </div>

            <div class="routes__box">
                @foreach ($destination->routes as $index => $route)
                    <input type="radio" name="route" id="route-{{ $route->days }}" class="routes__radio" @if($index === 0) checked
                    @endif />
                @endforeach

                <div class="routes__tabs">
                    @foreach ($destination->routes as $route)
                        <label for="route-{{ $route->days }}" class="routes__tab">
                            <span class="routes__tab-days">{{ $route->days }}</span>
                            <span class="routes__tab-info">
                                <strong>{{ $route->label }}</strong>
                                <small>{{ $route->subtitle }}</small>
                            </span>
                        </label>
                    @endforeach
                </div>

                <div class="routes__panels">
                    @foreach ($destination->routes as $route)
                        <div class="routes__panel routes__panel-{{ $route->days }}">
                            <span class="routes__panel-tag">{{ $route->days }} Days · {{ $route->label }}</span>

                            @if (!empty($route->path))
                                <div class="routes__path">
                                    @foreach ($route->path as $place)
                                        <span>{{ $place }}</span>@if(!$loop->last)<i>→</i>@endif
                                    @endforeach
                                </div>
                            @endif

                            @if ($route->note)
                                <p class="routes__note">{{ $route->note }}</p>
                            @endif
                        </div>
                    @endforeach

                    <div class="routes__action">
                        <button type="button">Customize Route</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Journey --}}
    <section class="detail-secG journey">
        <div class="container">
            <div class="heading">
                <h3>A Sample <span>{{ $destination->journeyDays->where('is_departure', false)->count() + 1 }}-Day
                        {{ $destination->name }} Trip</span></h3>
                <p>Where you'll go, stay, and eat — day by day</p>
            </div>

            <div class="journey__spine">
                @foreach ($destination->journeyDays as $index => $day)
                    @if ($day->is_departure)
                        <div class="journey__end">
                            <span class="journey__daytag journey__daytag--end">Day {{ $day->day_number }}</span>
                            <h4>{{ $day->title }}</h4>
                            <p>{{ $day->flow_text }}</p>
                        </div>
                    @else
                        <div class="journey__day @if($index % 2 === 1) journey__day--rev @endif">
                            <div class="journey__img">
                                <img loading="lazy"
                                    src="{{ $day->image ? asset('storage/' . $day->image) : asset('assets/images/blog/default.jpg') }}"
                                    alt="{{ $day->title }}" />
                            </div>

                            <div class="journey__card">
                                <span class="journey__daytag">Day {{ $day->day_number }}</span>
                                <h4>{{ $day->title }}</h4>
                                <p class="journey__flow">{{ $day->flow_text }}</p>

                                <div class="journey__chips">
                                    @if ($day->stay_text)
                                        <span class="journey__chip journey__chip--stay">
                                            <img loading="lazy" src="{{ asset('assets/icon/hotel.png') }}" alt="" />
                                            Stay: {{ $day->stay_text }}
                                        </span>
                                    @endif

                                    @if ($day->food_text)
                                        <span class="journey__chip journey__chip--food">
                                            <img loading="lazy" src="{{ asset('assets/icon/food2.png') }}" alt="" />
                                            Taste: {{ $day->food_text }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="journey__action">
                <button type="button" class="btn btn-primary">Customize This Itinerary</button>
                <button type="button" class="btn btn-outline-primary">Explore Restaurants</button>
            </div>
        </div>
    </section>

    <!-- Best Time to Visit -->
    <section class="detail-secH season">
        <div class="container">
            <div class="heading">
                <h3>When Should You <span>Visit {{ $destination->name }}?</span></h3>
                <p>Each season shows {{ $destination->name }} differently</p>
            </div>

            <div class="season__grid">
                @foreach ($destination->seasons as $season)
                    <div class="season__item">
                        <span class="season__range">{{ $season->range_text }}</span>
                        <h4>{{ $season->name }}</h4>
                        <p>{{ $season->description }}</p>
                    </div>
                @endforeach
            </div>

            @if (!empty($destination->season_highlights))
                <div class="season__highlights">
                    @foreach ($destination->season_highlights as $highlight)
                        <span>{{ $highlight['label'] }}: <strong>{{ $highlight['value'] }}</strong></span>
                        @if (!$loop->last)<span class="season__sep"></span>@endif
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Trip Budget -->
    <section class="detail-secI budget">
        <div class="container">
            <div class="heading">
                <h3>What Will Your <span>{{ $destination->name }} Trip Cost?</span></h3>
                <p>{{ $destination->budget_intro_text ?: 'Estimated per-person budget for your trip' }}</p>
            </div>

            <div class="budget__tiers">
                @foreach ($destination->budgetTiers as $tier)
                    <div class="budget__tier @if($tier->is_featured) budget__tier--featured @endif">
                        @if ($tier->badge_text)
                            <span class="budget__badge">{{ $tier->badge_text }}</span>
                        @endif
                        <span class="budget__name">{{ $tier->name }}</span>
                        <span class="budget__price">
                            ₹{{ $tier->price_from }}@if($tier->price_to)<small>–{{ $tier->price_to }}</small>@elseif($tier->price_suffix)<small>{{ $tier->price_suffix }}</small>@endif
                        </span>
                        <p>{{ $tier->description }}</p>
                    </div>
                @endforeach
            </div>

            @if ($destination->budgetBreakdown->isNotEmpty())
                <div class="budget__breakdown">
                    @foreach ($destination->budgetBreakdown as $row)
                        <div class="budget__row">
                            <span>{{ $row->label }}</span>
                            <div class="budget__track">
                                <div class="budget__fill" style="width: {{ $row->percent }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($destination->budget_note)
                <p class="budget__note">{{ $destination->budget_note }}</p>
            @endif

            <div class="budget__action">
                <button type="button" class="btn btn-primary">Plan My Budget</button>
            </div>
        </div>
    </section>

    {{-- Related Packages --}}
    <section class="related-tour-package">
        <div class="container">
            <div class="heading">
                <h3>Related <span>Packages</span></h3>
                <p>
                    Explore more tour packages combining Kashmir with nearby
                    destinations.
                </p>
            </div>

            <div class="swiper-wrap">
                <div class="swiper thirdSilder">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="trip_card">
                                <a href="listing-detail.html" target="_blank" class="img">
                                    <img loading="lazy" src="{{ asset('assets/images/attraction/kashmir5.jpg')}}"
                                        alt="Leh Ladakh Tour Package" />
                                    <span class="save">Save INR 18,000</span>
                                </a>
                                <div class="content">
                                    <div class="rating">
                                        <span>7 days & 6 nights</span>
                                        <div class="star">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                            <span>4.7</span>
                                            <em>(95)</em>
                                        </div>
                                    </div>

                                    <h3>
                                        <a href="listing-detail.html" target="_blank">Leh Ladakh High-Altitude Adventure</a>
                                    </h3>

                                    <div class="innerSave">
                                        <s>INR 63,000</s>
                                        <span class="saveChip">Save INR 18,000</span>
                                    </div>
                                    <p class="price">INR 45,000</p>

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

                        <div class="swiper-slide">
                            <div class="trip_card">
                                <a href="listing-detail.html" target="_blank" class="img">
                                    <img loading="lazy" src="{{ asset('assets/images/destinaiton/ride.jpg') }}"
                                        alt="Manali Tour Package" />
                                    <span class="save">Save INR 10,500</span>
                                </a>
                                <div class="content">
                                    <div class="rating">
                                        <span>5 days & 4 nights</span>
                                        <div class="star">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                            <span>4.5</span>
                                            <em>(72)</em>
                                        </div>
                                    </div>

                                    <h3>
                                        <a href="listing-detail.html" target="_blank">Manali Snow Valley Escape</a>
                                    </h3>

                                    <div class="innerSave">
                                        <s>INR 38,500</s>
                                        <span class="saveChip">Save INR 10,500</span>
                                    </div>
                                    <p class="price">INR 28,000</p>

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

                        <div class="swiper-slide">
                            <div class="trip_card">
                                <a href="listing-detail.html" target="_blank" class="img">
                                    <img loading="lazy" src="{{ asset('assets/images/destinaiton/garder.jpg') }}"
                                        alt="Shimla Tour Package" />
                                    <span class="save">Save INR 8,200</span>
                                </a>
                                <div class="content">
                                    <div class="rating">
                                        <span>4 days & 3 nights</span>
                                        <div class="star">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                            <span>4.4</span>
                                            <em>(58)</em>
                                        </div>
                                    </div>

                                    <h3>
                                        <a href="listing-detail.html" target="_blank">Shimla Hill Station Getaway</a>
                                    </h3>

                                    <div class="innerSave">
                                        <s>INR 26,700</s>
                                        <span class="saveChip">Save INR 8,200</span>
                                    </div>
                                    <p class="price">INR 18,500</p>

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

                        <div class="swiper-slide">
                            <div class="trip_card">
                                <a href="listing-detail.html" target="_blank" class="img">
                                    <img loading="lazy" src="{{ asset('assets/images/attraction/kashmir5.jpg') }}"
                                        alt="Leh Ladakh Tour Package" />
                                    <span class="save">Save INR 18,000</span>
                                </a>
                                <div class="content">
                                    <div class="rating">
                                        <span>7 days & 6 nights</span>
                                        <div class="star">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                            <span>4.7</span>
                                            <em>(95)</em>
                                        </div>
                                    </div>

                                    <h3>
                                        <a href="listing-detail.html" target="_blank">Leh Ladakh High-Altitude Adventure</a>
                                    </h3>

                                    <div class="innerSave">
                                        <s>INR 63,000</s>
                                        <span class="saveChip">Save INR 18,000</span>
                                    </div>
                                    <p class="price">INR 45,000</p>

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

    {{-- More About Destination --}}
    <section class="more-about">
        <div class="container">
            <div class="heading">
                <h3>More About <span>{{ $destination->name }}</span></h3>
                <p>{{ $destination->more_about_intro ?: 'Explore more places, packages and experiences for your ' . $destination->name . ' trip.' }}
                </p>
            </div>

            <div class="rte-content">
                {!! $destination->more_about_content !!}
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    @if ($destination->faqs->isNotEmpty())
        <section class="attraction_accordion">
            <div class="container">
                <div class="heading">
                    <h3>Frequently Asked <span>Questions</span></h3>
                </div>

                <div class="accordion-wrapper">
                    @foreach ($destination->faqs as $faq)
                        <div class="accordion-item">
                            <div class="accordion-body">
                                <div class="accordion-header @if($loop->first) active @endif">
                                    <h4>{{ $faq->question }}</h4>
                                    <span class="accordion-icon">@if($loop->first)−@else+@endif</span>
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

@endsection

@push('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const areas = document.querySelectorAll(".detail-secB .area");

            if (!areas.length) return;

            // First area is active by default
            areas.forEach((area, index) => {
                area.classList.toggle("is-open", index === 0);
            });

            // Open only the clicked area
            areas.forEach((area) => {
                area.addEventListener("click", () => {
                    areas.forEach((item) => {
                        item.classList.remove("is-open");
                    });

                    area.classList.add("is-open");
                });
            });
        });
    </script>
@endpush