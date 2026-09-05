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

    <section class="detail-secF routes">
        <div class="container">
            <div class="heading">
                <h3>Choose Your <span>Kashmir Route</span></h3>
                <p>From a quick escape to a slow, complete exploration</p>
            </div>

            <div class="routes__box">
                <input type="radio" name="route" id="route-3" class="routes__radio" checked />
                <input type="radio" name="route" id="route-5" class="routes__radio" />
                <input type="radio" name="route" id="route-7" class="routes__radio" />
                <input type="radio" name="route" id="route-10" class="routes__radio" />

                <div class="routes__tabs">
                    <label for="route-3" class="routes__tab">
                        <span class="routes__tab-days">3</span>
                        <span class="routes__tab-info">
                            <strong>Quick Escape</strong>
                            <small>Weekend trip</small>
                        </span>
                    </label>

                    <label for="route-5" class="routes__tab">
                        <span class="routes__tab-days">5</span>
                        <span class="routes__tab-info">
                            <strong>Highlights</strong>
                            <small>Balanced pace</small>
                        </span>
                    </label>

                    <label for="route-7" class="routes__tab">
                        <span class="routes__tab-days">7</span>
                        <span class="routes__tab-info">
                            <strong>Classic Kashmir</strong>
                            <small>Most picked</small>
                        </span>
                    </label>

                    <label for="route-10" class="routes__tab">
                        <span class="routes__tab-days">10</span>
                        <span class="routes__tab-info">
                            <strong>Slow Explorer</strong>
                            <small>Build your own</small>
                        </span>
                    </label>
                </div>

                <div class="routes__panels">
                    <div class="routes__panel routes__panel-3">
                        <span class="routes__panel-tag">3 Days · Quick Escape</span>
                        <div class="routes__path">
                            <span>Srinagar</span><i>→</i><span>Gulmarg</span><i>→</i><span>Srinagar</span>
                        </div>
                    </div>

                    <div class="routes__panel routes__panel-5">
                        <span class="routes__panel-tag">5 Days · Highlights</span>
                        <div class="routes__path">
                            <span>Srinagar</span><i>→</i><span>Gulmarg</span><i>→</i><span>Pahalgam</span><i>→</i><span>Srinagar</span>
                        </div>
                    </div>

                    <div class="routes__panel routes__panel-7">
                        <span class="routes__panel-tag">7 Days · Classic Kashmir</span>
                        <div class="routes__path">
                            <span>Srinagar</span><i>→</i><span>Gulmarg</span><i>→</i><span>Pahalgam</span><i>→</i><span>Sonamarg</span><i>→</i><span>Srinagar</span>
                        </div>
                    </div>

                    <div class="routes__panel routes__panel-10">
                        <span class="routes__panel-tag">10 Days · Slow Explorer</span>
                        <p class="routes__note">
                            Add Doodhpathri, Yusmarg and additional experiences at your
                            own pace.
                        </p>
                    </div>

                    <div class="routes__action">
                        <button type="button">Customize Route</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="detail-secG journey">
        <div class="container">
            <div class="heading">
                <h3>A Sample <span>7-Day Kashmir Trip</span></h3>
                <p>Where you'll go, stay, and eat — day by day</p>
            </div>

            <div class="journey__spine">
                <!-- DAY 1 -->
                <div class="journey__day">
                    <div class="journey__img">
                        <img loading="lazy" src="assets/images/attraction/kashmir1.jpg" alt="Srinagar Dal Lake" />
                    </div>

                    <div class="journey__card">
                        <span class="journey__daytag">Day 1</span>

                        <h4>Srinagar</h4>

                        <p class="journey__flow">
                            Arrival → Hotel check-in → Dal Lake → Shikara Ride
                        </p>

                        <div class="journey__chips">
                            <span class="journey__chip journey__chip--stay">
                                <img loading="lazy" src="assets/icon/hotel.png" alt="" />
                                Stay: Srinagar
                            </span>

                            <span class="journey__chip journey__chip--food">
                                <img loading="lazy" src="assets/icon/food2.png" alt="" />
                                Taste: Kahwa
                            </span>
                        </div>
                    </div>
                </div>

                <!-- DAY 2 -->
                <div class="journey__day journey__day--rev">
                    <div class="journey__img">
                        <img loading="lazy" src="assets/images/attraction/kashmir2.jpg" alt="Srinagar Mughal Gardens" />
                    </div>

                    <div class="journey__card">
                        <span class="journey__daytag">Day 2</span>

                        <h4>Srinagar</h4>

                        <p class="journey__flow">
                            Mughal Gardens → Old City → Local Market
                        </p>

                        <div class="journey__chips">
                            <span class="journey__chip journey__chip--stay">
                                <img loading="lazy" src="assets/icon/hotel.png" alt="" />
                                Stay: Srinagar
                            </span>

                            <span class="journey__chip journey__chip--food">
                                <img loading="lazy" src="assets/icon/food2.png" alt="" />
                                Taste: Yakhni
                            </span>
                        </div>
                    </div>
                </div>

                <!-- DAY 3 -->
                <div class="journey__day">
                    <div class="journey__img">
                        <img loading="lazy" src="assets/images/attraction/kashmir3.jpg" alt="Gulmarg Kashmir" />
                    </div>

                    <div class="journey__card">
                        <span class="journey__daytag">Day 3</span>

                        <h4>Gulmarg</h4>

                        <p class="journey__flow">
                            Transfer → Gondola Ride → Mountain Experiences
                        </p>

                        <div class="journey__chips">
                            <span class="journey__chip journey__chip--stay">
                                <img loading="lazy" src="assets/icon/hotel.png" alt="" />
                                Stay: Gulmarg
                            </span>

                            <span class="journey__chip journey__chip--food">
                                <img loading="lazy" src="assets/icon/food2.png" alt="" />
                                Taste: Rogan Josh
                            </span>
                        </div>
                    </div>
                </div>

                <!-- DAY 4 -->
                <div class="journey__day journey__day--rev">
                    <div class="journey__img">
                        <img loading="lazy" src="assets/images/attraction/kashmir4.jpg" alt="Pahalgam Kashmir" />
                    </div>

                    <div class="journey__card">
                        <span class="journey__daytag">Day 4</span>

                        <h4>Pahalgam</h4>

                        <p class="journey__flow">Transfer → Scenic Stops → Pahalgam</p>

                        <div class="journey__chips">
                            <span class="journey__chip journey__chip--stay">
                                <img loading="lazy" src="assets/icon/hotel.png" alt="" />
                                Stay: Pahalgam
                            </span>

                            <span class="journey__chip journey__chip--food">
                                <img loading="lazy" src="assets/icon/food2.png" alt="" />
                                Taste: Wazwan
                            </span>
                        </div>
                    </div>
                </div>

                <!-- DAY 5 -->
                <div class="journey__day">
                    <div class="journey__img">
                        <img loading="lazy" src="assets/images/attraction/kashmir5.jpg" alt="Pahalgam Valley" />
                    </div>

                    <div class="journey__card">
                        <span class="journey__daytag">Day 5</span>

                        <h4>Pahalgam</h4>

                        <p class="journey__flow">
                            Valleys → Nature Trails → Local Experiences
                        </p>

                        <div class="journey__chips">
                            <span class="journey__chip journey__chip--stay">
                                <img loading="lazy" src="assets/icon/hotel.png" alt="" />
                                Stay: Pahalgam
                            </span>

                            <span class="journey__chip journey__chip--food">
                                <img loading="lazy" src="assets/icon/food2.png" alt="" />
                                Taste: Rogan Josh
                            </span>
                        </div>
                    </div>
                </div>

                <!-- DAY 6 -->
                <div class="journey__day journey__day--rev">
                    <div class="journey__img">
                        <img loading="lazy" src="assets/images/attraction/kashmir3.jpg" alt="Sonamarg Kashmir" />
                    </div>

                    <div class="journey__card">
                        <span class="journey__daytag">Day 6</span>

                        <h4>Sonamarg</h4>

                        <p class="journey__flow">
                            Mountain Excursion → Scenic Views → Srinagar
                        </p>

                        <div class="journey__chips">
                            <span class="journey__chip journey__chip--stay">
                                <img loading="lazy" src="assets/icon/hotel.png" alt="" />
                                Stay: Srinagar
                            </span>

                            <span class="journey__chip journey__chip--food">
                                <img loading="lazy" src="assets/icon/food2.png" alt="" />
                                Taste: Kahwa
                            </span>
                        </div>
                    </div>
                </div>

                <!-- DAY 7 -->
                <div class="journey__end">
                    <span class="journey__daytag journey__daytag--end"> Day 7 </span>

                    <h4>Departure</h4>

                    <p>Breakfast → Airport Transfer → End of Trip</p>
                </div>
            </div>

            <div class="journey__action">
                <button type="button" class="btn btn-primary">
                    Customize This Itinerary
                </button>

                <button type="button" class="btn btn-outline-primary">
                    Explore Restaurants
                </button>
            </div>
        </div>
    </section>

    <!-- 11. Best Time to Visit -->
    <section class="detail-secH season">
        <div class="container">
            <div class="heading">
                <h3>When Should You <span>Visit Kashmir?</span></h3>
                <p>Each season shows Kashmir differently</p>
            </div>

            <div class="season__grid">
                <div class="season__item">
                    <span class="season__range">March – April</span>
                    <h4>Spring</h4>
                    <p>Gardens, flowers and pleasant weather.</p>
                </div>

                <div class="season__item">
                    <span class="season__range">May – June</span>
                    <h4>Summer</h4>
                    <p>Great for sightseeing and exploring valleys.</p>
                </div>

                <div class="season__item">
                    <span class="season__range">Sept – Nov</span>
                    <h4>Autumn</h4>
                    <p>Cool weather and beautiful landscapes.</p>
                </div>

                <div class="season__item">
                    <span class="season__range">Dec – Feb</span>
                    <h4>Winter</h4>
                    <p>Snow, skiing and winter experiences.</p>
                </div>
            </div>

            <div class="season__highlights">
                <span>Best overall: <strong>March – October</strong></span>
                <span class="season__sep"></span>
                <span>Best for snow: <strong>December – February</strong></span>
            </div>
        </div>
    </section>

    <!-- 12. Trip Budget -->
    <section class="detail-secI budget">
        <div class="container">
            <div class="heading">
                <h3>What Will Your <span>Kashmir Trip Cost?</span></h3>
                <p>Estimated per-person budget for a 7-day trip</p>
            </div>

            <div class="budget__tiers">
                <div class="budget__tier">
                    <span class="budget__name">Budget</span>
                    <span class="budget__price">₹25,000<small>–35,000</small></span>
                    <p>Basic stays, shared travel, local food.</p>
                </div>

                <div class="budget__tier budget__tier--featured">
                    <span class="budget__badge">Popular</span>
                    <span class="budget__name">Comfort</span>
                    <span class="budget__price">₹35,000<small>–60,000</small></span>
                    <p>3-star stays, private cabs, curated experiences.</p>
                </div>

                <div class="budget__tier">
                    <span class="budget__name">Premium</span>
                    <span class="budget__price">₹60,000<small>+</small></span>
                    <p>Luxury stays, private transport, top experiences.</p>
                </div>
            </div>

            <div class="budget__breakdown">
                <div class="budget__row">
                    <span>Stay</span>
                    <div class="budget__track">
                        <div class="budget__fill" style="width: 40%"></div>
                    </div>
                </div>
                <div class="budget__row">
                    <span>Transport</span>
                    <div class="budget__track">
                        <div class="budget__fill" style="width: 25%"></div>
                    </div>
                </div>
                <div class="budget__row">
                    <span>Food</span>
                    <div class="budget__track">
                        <div class="budget__fill" style="width: 20%"></div>
                    </div>
                </div>
                <div class="budget__row">
                    <span>Activities</span>
                    <div class="budget__track">
                        <div class="budget__fill" style="width: 15%"></div>
                    </div>
                </div>
            </div>

            <!-- <p class="budget__note">Prices vary depending on season, hotel category, transportation and activities.</p> -->

            <div class="budget__action">
                <button type="button" class="btn btn-primary">
                    Plan My Budget
                </button>
            </div>
        </div>
    </section>

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
                                    <img loading="lazy" src="assets/images/attraction/kashmir5.jpg"
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
                                    <img loading="lazy" src="assets/images/destinaiton/ride.jpg"
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
                                    <img loading="lazy" src="assets/images/destinaiton/garder.jpg"
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
                                    <img loading="lazy" src="assets/images/attraction/kashmir5.jpg"
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

    <section class="more-about">
        <div class="container">
            <div class="heading">
                <h3>More About <span>Kashmir</span></h3>
                <p>
                    Explore more places, packages and experiences for your Kashmir
                    trip.
                </p>
            </div>

            <div class="rte-content">
                <h4>Plan Your Kashmir Holiday</h4>

                <p>
                    Kashmir is known for its beautiful valleys, peaceful lakes,
                    mountain landscapes and memorable travel experiences. Explore our
                    <a href="javascript:void(0)">Kashmir Tour Packages</a>
                    to find itineraries for different trip durations and travel
                    styles.
                </p>

                <h4>Explore Popular Places in Kashmir</h4>

                <p>
                    Discover the best places to include in your itinerary, from scenic
                    valleys to peaceful mountain destinations.
                </p>

                <ul>
                    <li>
                        <a href="javascript:void(0)">Srinagar</a>
                        — Explore Dal Lake, Shikara rides, Mughal Gardens and local
                        markets.
                    </li>

                    <li>
                        <a href="javascript:void(0)">Gulmarg</a>
                        — Enjoy mountain views, Gondola rides, snow and outdoor
                        activities.
                    </li>

                    <li>
                        <a href="javascript:void(0)">Pahalgam</a>
                        — Discover beautiful valleys, rivers, forests and peaceful
                        surroundings.
                    </li>

                    <li>
                        <a href="javascript:void(0)">Sonamarg</a>
                        — Experience spectacular mountain scenery and alpine landscapes.
                    </li>

                    <li>
                        <a href="javascript:void(0)">Doodhpathri</a>
                        — Visit peaceful meadows surrounded by beautiful natural
                        scenery.
                    </li>
                </ul>

                <h4>Kashmir Tour Packages</h4>

                <p>
                    Choose a package based on your interests, travel duration and
                    budget. Explore our
                    <a href="javascript:void(0)">Family Tour Packages</a>,
                    <a href="javascript:void(0)">Honeymoon Packages</a>,
                    <a href="javascript:void(0)">Adventure Tour Packages</a>
                    and
                    <a href="javascript:void(0)">Weekend Getaways</a>
                    for more travel options.
                </p>

                <ul>
                    <li>
                        <a href="javascript:void(0)">Kashmir Family Packages</a>
                        — Comfortable holidays for families.
                    </li>

                    <li>
                        <a href="javascript:void(0)">Kashmir Honeymoon Packages</a>
                        — Romantic stays and experiences for couples.
                    </li>

                    <li>
                        <a href="javascript:void(0)">Kashmir Adventure Packages</a>
                        — Outdoor activities and exciting experiences.
                    </li>

                    <li>
                        <a href="javascript:void(0)">Kashmir Group Packages</a>
                        — Flexible travel options for groups and friends.
                    </li>
                </ul>

                <h4>Things to Do in Kashmir</h4>

                <p>
                    Make your holiday more memorable with unique local experiences and
                    sightseeing activities. Explore
                    <a href="javascript:void(0)">Kashmir Activities</a>
                    including Shikara rides, Gondola rides, sightseeing, snow
                    experiences and local food experiences.
                </p>

                <ol>
                    <li>Enjoy a traditional Shikara ride on Dal Lake.</li>
                    <li>Take the Gondola ride in Gulmarg.</li>
                    <li>Explore the valleys of Pahalgam.</li>
                    <li>Visit beautiful Mughal Gardens in Srinagar.</li>
                    <li>Experience traditional Kashmiri food and culture.</li>
                </ol>

                <h4>Combine Kashmir With Other Destinations</h4>

                <p>
                    Planning a longer holiday? You can combine Kashmir with other
                    popular Himalayan destinations. Explore our
                    <a href="javascript:void(0)">Leh Ladakh Tour Packages</a>,
                    <a href="javascript:void(0)">Himachal Tour Packages</a>,
                    <a href="javascript:void(0)">Manali Tour Packages</a>
                    and
                    <a href="javascript:void(0)">Shimla Tour Packages</a>
                    for more options.
                </p>

                <h4>Explore More Travel Options</h4>

                <p>
                    Looking for more destinations and experiences? Browse our
                    <a href="javascript:void(0)">India Tour Packages</a>,
                    <a href="javascript:void(0)">Destinations</a>,
                    <a href="javascript:void(0)">Attractions</a>
                    and
                    <a href="javascript:void(0)">Travel Experiences</a>
                    to discover your next journey.
                </p>
            </div>
        </div>
    </section>

    <section class="attraction_accordion">
        <div class="container">
            <div class="heading">
                <h3>Frequently Asked <span>Questions</span></h3>
            </div>

            <div class="accordion-wrapper">
                <!-- FAQ 1 -->
                <div class="accordion-item">
                    <div class="accordion-body">
                        <div class="accordion-header active">
                            <h4>How many days are enough for Kashmir?</h4>
                            <span class="accordion-icon">−</span>
                        </div>

                        <div class="accordion-content">
                            <p>
                                5–7 days is ideal for a first-time visit and allows you to
                                experience major destinations such as Srinagar, Gulmarg and
                                Pahalgam.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="accordion-item">
                    <div class="accordion-body">
                        <div class="accordion-header">
                            <h4>Where should I stay in Kashmir?</h4>
                            <span class="accordion-icon">+</span>
                        </div>

                        <div class="accordion-content">
                            <p>
                                Srinagar is a good base for exploring Kashmir, while adding
                                Gulmarg and Pahalgam gives you a more complete experience of
                                the region.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="accordion-item">
                    <div class="accordion-body">
                        <div class="accordion-header">
                            <h4>What is the best time to visit Kashmir?</h4>
                            <span class="accordion-icon">+</span>
                        </div>

                        <div class="accordion-content">
                            <p>
                                March–October is popular for sightseeing and pleasant
                                weather, while winter is best for experiencing snow and
                                winter activities.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="accordion-item">
                    <div class="accordion-body">
                        <div class="accordion-header">
                            <h4>How do I travel between destinations?</h4>
                            <span class="accordion-icon">+</span>
                        </div>

                        <div class="accordion-content">
                            <p>
                                Private cars and taxis are convenient options for travelling
                                between most destinations in Kashmir, especially when
                                visiting multiple places during one trip.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="accordion-item">
                    <div class="accordion-body">
                        <div class="accordion-header">
                            <h4>Can I create my own Kashmir itinerary?</h4>
                            <span class="accordion-icon">+</span>
                        </div>

                        <div class="accordion-content">
                            <p>
                                Yes. Select your preferred destinations, stays and
                                experiences to create a Kashmir itinerary that matches your
                                travel style and trip duration.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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