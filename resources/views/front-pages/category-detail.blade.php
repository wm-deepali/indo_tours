@extends('layouts.app')

@section('title', 'Category Listing | Indo Tours & Adventures')
@section('meta_description', 'Indo Tours & Adventures is a leading travel company offering a wide range of tour packages, including domestic and international destinations. Explore the world with our expertly crafted itineraries and exceptional services.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/category-listing/category-listing.css') }}" />
@endpush

@section('content')

    <main>

        <!-- BASIC INFO SECTION -->
        <section class="listing-banner">
            <div class="bg">
                <div class="swiper listSlider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img loading="lazy" src="{{ asset('assets/images/listing/banner1.jpg')}}"
                                alt="{{ $category->name }}" />
                        </div>

                        <div class="swiper-slide">
                            <img loading="lazy" src="{{ asset('assets/images/listing/banner2.jpg')}}"
                                alt="{{ $category->name }}" />
                        </div>
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

                            <li>
                                <a href="{{ route('category.show', $category->slug) }}"
                                    class="active">{{ $category->name }}</a>
                            </li>
                        </ul>
                    </nav>

                    <div class="bg-wrapper">
                        <div class="content">
                            @if($category->sub_title)
                                <span class="offer-tag">{{ $category->sub_title }}</span>
                            @endif

                            <h1>{{ $category->h1 ?? $category->heading ?? $category->name }}</h1>

                            <span class="divider"></span>

                            @if($category->short_description)
                                <p>{{ $category->short_description }}</p>
                            @endif

                            <div class="price-row">
                                <span>Starting at</span>
                                <del class="old-price">INR 1,87,638</del>
                                <h3>INR 93,819</h3>
                            </div>

                            <a href="javascript:void(0)" class="btn btn-primary">
                                Connect With An Expert
                                <i class="icon-arrow"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- LISTING SECTION -->
        <section class="listing-secB">
            <div class="container">
                <div class="heading">
                    <span class="eyebrow">{{ $category->listing_eyebrow }}</span>
                    <h3>{{ $category->listing_heading }} <span>{{ $category->listing_heading_highlight }}</span></h3>
                </div>

                @if($category->listing_intro)
                    <p class="intro-lead">{{ $category->listing_intro }}</p>
                @endif

                @if($category->facts->count())
                    <div class="fact-strip">
                        @foreach($category->facts as $fact)
                            <div class="fact-strip__item">
                                <span class="fact-strip__num">{{ $fact->number }}</span>
                                <span class="fact-strip__label">{{ $fact->label }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="center-btn">
                    @if($category->listing_button_text)
                        <a href="{{ $category->listing_button_url ?? 'javascript:void()' }}"
                            class="btn btn-primary">{{ $category->listing_button_text }}</a>
                    @endif
                    @if($category->listing_button2_text)
                        <a href="{{ $category->listing_button2_url ?? 'javascript:void()' }}"
                            class="btn btn-outline-primary">{{ $category->listing_button2_text }}</a>
                    @endif
                </div>
            </div>
        </section>

        <section class="listing-secA">
            <div class="container">
                <div class="heading">
                    <h3>Europe <span>Honeymoon Packages</span></h3>
                    <p>
                        Choose from our handpicked travel experiences, designed to make every journey unforgettable.
                    </p>
                </div>

                <div class="trip-grid">
                    <div class="trip_card">
                        <a href="listing-detail.html" target="_blank" class="img">
                            <img loading="lazy"
                                src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=600&q=80"
                                alt="Paris" />
                            <span class="save">Save INR 45,900</span>
                        </a>

                        <div class="content">
                            <div class="rating">
                                <span>6 days &amp; 5 nights</span>
                                <div class="star">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                    </svg>
                                    <span>4.7</span>
                                    <em>(21)</em>
                                </div>
                            </div>

                            <h3>
                                <a href="listing-detail.html" target="_blank">Romantic Paris Honeymoon Escape</a>
                            </h3>

                            <div class="innerSave">
                                <s>INR 1,39,719</s>
                                <span class="saveChip">Save INR 45,900</span>
                            </div>
                            <p class="price">INR 93,819</p>

                            <div class="btns">
                                <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                        <path
                                            d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                    </svg>
                                </a>
                                <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
                            </div>
                        </div>
                    </div>

                    <div class="trip_card">
                        <a href="listing-detail.html" target="_blank" class="img">
                            <img loading="lazy"
                                src="https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fit=crop&w=600&q=80"
                                alt="Switzerland" />
                            <span class="save">Save INR 62,300</span>
                        </a>

                        <div class="content">
                            <div class="rating">
                                <span>7 days &amp; 6 nights</span>
                                <div class="star">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                    </svg>
                                    <span>4.8</span>
                                    <em>(34)</em>
                                </div>
                            </div>

                            <h3>
                                <a href="listing-detail.html" target="_blank">Switzerland Alps Honeymoon Retreat</a>
                            </h3>

                            <div class="innerSave">
                                <s>INR 1,86,300</s>
                                <span class="saveChip">Save INR 62,300</span>
                            </div>
                            <p class="price">INR 1,24,000</p>

                            <div class="btns">
                                <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                        <path
                                            d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                    </svg>
                                </a>
                                <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
                            </div>
                        </div>
                    </div>

                    <div class="trip_card">
                        <a href="listing-detail.html" target="_blank" class="img">
                            <img loading="lazy"
                                src="https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?auto=format&fit=crop&w=600&q=80"
                                alt="Italy" />
                            <span class="save">Save INR 58,700</span>
                        </a>

                        <div class="content">
                            <div class="rating">
                                <span>8 days &amp; 7 nights</span>
                                <div class="star">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                    </svg>
                                    <span>4.6</span>
                                    <em>(18)</em>
                                </div>
                            </div>

                            <h3>
                                <a href="listing-detail.html" target="_blank">Italy Romance: Venice, Rome &amp; Florence</a>
                            </h3>

                            <div class="innerSave">
                                <s>INR 1,78,700</s>
                                <span class="saveChip">Save INR 58,700</span>
                            </div>
                            <p class="price">INR 1,20,000</p>

                            <div class="btns">
                                <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                        <path
                                            d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                    </svg>
                                </a>
                                <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
                            </div>
                        </div>
                    </div>

                    <div class="trip_card">
                        <a href="listing-detail.html" target="_blank" class="img">
                            <img loading="lazy"
                                src="https://images.unsplash.com/photo-1516550893923-42d28e5677af?auto=format&fit=crop&w=600&q=80"
                                alt="Austria" />
                            <span class="save">Save INR 39,500</span>
                        </a>

                        <div class="content">
                            <div class="rating">
                                <span>6 days &amp; 5 nights</span>
                                <div class="star">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                    </svg>
                                    <span>4.5</span>
                                    <em>(12)</em>
                                </div>
                            </div>

                            <h3>
                                <a href="listing-detail.html" target="_blank">Austria Honeymoon: Vienna &amp; Salzburg</a>
                            </h3>

                            <div class="innerSave">
                                <s>INR 1,29,500</s>
                                <span class="saveChip">Save INR 39,500</span>
                            </div>
                            <p class="price">INR 90,000</p>

                            <div class="btns">
                                <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                        <path
                                            d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                    </svg>
                                </a>
                                <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
                            </div>
                        </div>
                    </div>

                    <div class="trip_card">
                        <a href="listing-detail.html" target="_blank" class="img">
                            <img loading="lazy"
                                src="https://images.unsplash.com/photo-1534351590666-13e3e96b5017?auto=format&fit=crop&w=600&q=80"
                                alt="Amsterdam" />
                            <span class="save">Save INR 33,200</span>
                        </a>

                        <div class="content">
                            <div class="rating">
                                <span>5 days &amp; 4 nights</span>
                                <div class="star">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                    </svg>
                                    <span>4.4</span>
                                    <em>(9)</em>
                                </div>
                            </div>

                            <h3>
                                <a href="listing-detail.html" target="_blank">Amsterdam &amp; Tulip Fields Getaway</a>
                            </h3>

                            <div class="innerSave">
                                <s>INR 1,08,200</s>
                                <span class="saveChip">Save INR 33,200</span>
                            </div>
                            <p class="price">INR 75,000</p>

                            <div class="btns">
                                <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                        <path
                                            d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                    </svg>
                                </a>
                                <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
                            </div>
                        </div>
                    </div>

                    <div class="trip_card">
                        <a href="listing-detail.html" target="_blank" class="img">
                            <img loading="lazy"
                                src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=600&q=80"
                                alt="Paris" />
                            <span class="save">Save INR 45,900</span>
                        </a>

                        <div class="content">
                            <div class="rating">
                                <span>6 days &amp; 5 nights</span>
                                <div class="star">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                    </svg>
                                    <span>4.7</span>
                                    <em>(21)</em>
                                </div>
                            </div>

                            <h3>
                                <a href="listing-detail.html" target="_blank">Romantic Paris Honeymoon Escape</a>
                            </h3>

                            <div class="innerSave">
                                <s>INR 1,39,719</s>
                                <span class="saveChip">Save INR 45,900</span>
                            </div>
                            <p class="price">INR 93,819</p>

                            <div class="btns">
                                <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                        <path
                                            d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                    </svg>
                                </a>
                                <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
                            </div>
                        </div>
                    </div>

                    <div class="trip_card">
                        <a href="listing-detail.html" target="_blank" class="img">
                            <img loading="lazy"
                                src="https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fit=crop&w=600&q=80"
                                alt="Switzerland" />
                            <span class="save">Save INR 62,300</span>
                        </a>

                        <div class="content">
                            <div class="rating">
                                <span>7 days &amp; 6 nights</span>
                                <div class="star">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                    </svg>
                                    <span>4.8</span>
                                    <em>(34)</em>
                                </div>
                            </div>

                            <h3>
                                <a href="listing-detail.html" target="_blank">Switzerland Alps Honeymoon Retreat</a>
                            </h3>

                            <div class="innerSave">
                                <s>INR 1,86,300</s>
                                <span class="saveChip">Save INR 62,300</span>
                            </div>
                            <p class="price">INR 1,24,000</p>

                            <div class="btns">
                                <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                        <path
                                            d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                    </svg>
                                </a>
                                <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
                            </div>
                        </div>
                    </div>

                    <div class="trip_card">
                        <a href="listing-detail.html" target="_blank" class="img">
                            <img loading="lazy"
                                src="https://images.unsplash.com/photo-1541849546-216549ae216d?auto=format&fit=crop&w=600&q=80"
                                alt="Prague" />
                            <span class="save">Save INR 28,900</span>
                        </a>

                        <div class="content">
                            <div class="rating">
                                <span>5 days &amp; 4 nights</span>
                                <div class="star">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                    </svg>
                                    <span>4.5</span>
                                    <em>(15)</em>
                                </div>
                            </div>

                            <h3><a href="listing-detail.html" target="_blank">Prague Fairytale Honeymoon</a></h3>

                            <div class="innerSave">
                                <s>INR 98,900</s>
                                <span class="saveChip">Save INR 28,900</span>
                            </div>
                            <p class="price">INR 70,000</p>

                            <div class="btns">
                                <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                        <path
                                            d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                    </svg>
                                </a>
                                <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="center-btn">
                    <a href="javascript:void()" class="btn btn-outline-primary">View All</a>
                </div>
            </div>
        </section>

        <!-- OFFER BANNER SECTION -->
        <section class="group-offer-banner">
            <div class="container">
                <div class="group-offer-banner__inner">
                    <div class="group-offer-banner__content">
                        @if($category->cta_badge_text)
                            <span class="group-offer-banner__badge">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <path fill="currentColor"
                                        d="M12 2l1.6 4.8L18 5l-1.8 4.4L21 12l-4.8 1.6L18 19l-4.4-1.8L12 22l-1.6-4.8L6 19l1.8-4.4L3 12l4.8-1.6L6 5l4.4 1.8z" />
                                </svg>
                                {{ $category->cta_badge_text }}
                            </span>
                        @endif

                        @if($category->cta_title)
                            <h3>{{ $category->cta_title }}</h3>
                        @endif

                        @if($category->cta_description)
                            <p>{{ $category->cta_description }}</p>
                        @endif

                        @if($category->ctaPerks->count())
                            <ul class="group-offer-banner__perks">
                                @foreach($category->ctaPerks as $perk)
                                    <li>{{ $perk->text }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="group-offer-banner__actions">
                            @if($category->cta_button_text)
                                <a href="{{ $category->cta_button_url ?? 'javascript:void()' }}" class="btn btn-white">
                                    {{ $category->cta_button_text }}
                                </a>
                            @endif

                            @if($category->cta_button2_text)
                                <a href="javascript:void()" data-model=".enquire-pop" class="btn btn-outline-white">
                                    {{ $category->cta_button2_text }}
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="group-offer-banner__media">
                        <div class="group-offer-banner__img group-offer-banner__img--secondary">
                            <img loading="lazy"
                                src="{{ $category->cta_image ? asset($category->cta_image) : asset('assets/images/listing/banner1.jpg') }}"
                                alt="{{ $category->name }}" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="listing-secE">
            <div class="container">
                <div class="heading">
                    <h3>Europe Honeymoon <span>Packages</span></h3>
                    <p>
                        Discover romantic escapes across Europe, thoughtfully planned for unforgettable moments
                        together.
                    </p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper thirdSilder">
                        <div class="swiper-wrapper">
                            <!-- CARD 1 -->
                            <div class="swiper-slide">
                                <div class="trip_card">
                                    <a href="listing-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="assets/images/home/card1.jpg"
                                            alt="Romantic Paris and Switzerland Honeymoon" />
                                        <span class="save">Save INR 45,000</span>
                                    </a>

                                    <div class="content">
                                        <div class="rating">
                                            <span>7 days & 6 nights</span>

                                            <div class="star">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                </svg>
                                                <span>4.8</span>
                                                <em>(24)</em>
                                            </div>
                                        </div>

                                        <h3>
                                            <a href="listing-detail.html" target="_blank">
                                                Romantic Paris & Switzerland Honeymoon
                                            </a>
                                        </h3>

                                        <div class="innerSave">
                                            <s>INR 1,42,500</s>
                                            <span class="saveChip">Save INR 45,000</span>
                                        </div>

                                        <p class="price">INR 97,500</p>

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

                            <!-- CARD 2 -->
                            <div class="swiper-slide">
                                <div class="trip_card">
                                    <a href="listing-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="assets/images/home/card2.jpg"
                                            alt="Italy Honeymoon Package" />
                                        <span class="save">Save INR 38,500</span>
                                    </a>

                                    <div class="content">
                                        <div class="rating">
                                            <span>8 days & 7 nights</span>

                                            <div class="star">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                </svg>
                                                <span>4.7</span>
                                                <em>(19)</em>
                                            </div>
                                        </div>

                                        <h3>
                                            <a href="listing-detail.html" target="_blank">
                                                Romantic Italy Honeymoon Escape
                                            </a>
                                        </h3>

                                        <div class="innerSave">
                                            <s>INR 1,36,500</s>
                                            <span class="saveChip">Save INR 38,500</span>
                                        </div>

                                        <p class="price">INR 98,000</p>

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

                            <!-- CARD 3 -->
                            <div class="swiper-slide">
                                <div class="trip_card">
                                    <a href="listing-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="assets/images/home/card3.jpg"
                                            alt="Greece Honeymoon Package" />
                                        <span class="save">Save INR 42,000</span>
                                    </a>

                                    <div class="content">
                                        <div class="rating">
                                            <span>7 days & 6 nights</span>

                                            <div class="star">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                </svg>
                                                <span>4.9</span>
                                                <em>(31)</em>
                                            </div>
                                        </div>

                                        <h3>
                                            <a href="listing-detail.html" target="_blank">
                                                Santorini & Athens Romantic Getaway
                                            </a>
                                        </h3>

                                        <div class="innerSave">
                                            <s>INR 1,45,000</s>
                                            <span class="saveChip">Save INR 42,000</span>
                                        </div>

                                        <p class="price">INR 1,03,000</p>

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

                            <!-- CARD 4 -->
                            <div class="swiper-slide">
                                <div class="trip_card">
                                    <a href="listing-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="assets/images/home/card4.jpg"
                                            alt="Switzerland Honeymoon Package" />
                                        <span class="save">Save INR 50,000</span>
                                    </a>

                                    <div class="content">
                                        <div class="rating">
                                            <span>9 days & 8 nights</span>

                                            <div class="star">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                </svg>
                                                <span>4.8</span>
                                                <em>(27)</em>
                                            </div>
                                        </div>

                                        <h3>
                                            <a href="listing-detail.html" target="_blank">
                                                Switzerland Honeymoon Highlights
                                            </a>
                                        </h3>

                                        <div class="innerSave">
                                            <s>INR 1,68,000</s>
                                            <span class="saveChip">Save INR 50,000</span>
                                        </div>

                                        <p class="price">INR 1,18,000</p>

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

                            <!-- CARD 5 -->
                            <div class="swiper-slide">
                                <div class="trip_card">
                                    <a href="listing-detail.html" target="_blank" class="img">
                                        <img loading="lazy" src="assets/images/home/card1.jpg"
                                            alt="France and Italy Honeymoon Package" />
                                        <span class="save">Save INR 48,000</span>
                                    </a>

                                    <div class="content">
                                        <div class="rating">
                                            <span>10 days & 9 nights</span>

                                            <div class="star">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path
                                                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                </svg>
                                                <span>4.7</span>
                                                <em>(22)</em>
                                            </div>
                                        </div>

                                        <h3>
                                            <a href="listing-detail.html" target="_blank">
                                                France & Italy Romantic Escape
                                            </a>
                                        </h3>

                                        <div class="innerSave">
                                            <s>INR 1,72,000</s>
                                            <span class="saveChip">Save INR 48,000</span>
                                        </div>

                                        <p class="price">INR 1,24,000</p>

                                        <div class="btns">
                                            <a href="tel:+91 000 000 000" class="btn btn-outline-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                                    <path
                                                        d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282-1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
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
            </div>
        </section>

        <!-- PROMO BANNER SECTION -->
        <section class="listing-secG">
            <div class="container">
                <div class="grid">
                    <div class="glow"></div>

                    <div class="promo-left">
                        @if($category->promo_badge_text)
                            <span class="promo-badge">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                    <path d="M0 0h24v24H0z" fill="none" />
                                    <g fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10.594 2.319a3.26 3.26 0 0 1 2.812 0c.387.185.74.487 1.231.905l.078.066c.238.203.313.265.389.316c.193.13.41.219.637.264c.09.018.187.027.499.051l.101.008c.642.051 1.106.088 1.51.23a3.27 3.27 0 0 1 1.99 1.99c.142.404.178.868.23 1.51l.008.101c.024.312.033.41.051.499c.045.228.135.445.264.638c.051.075.113.15.316.388l.066.078c.419.49.72.844.905 1.23c.425.89.425 1.924 0 2.813c-.184.387-.486.74-.905 1.231l-.066.078a5 5 0 0 0-.316.389c-.13.193-.219.41-.264.637c-.018.09-.026.187-.051.499l-.009.101c-.05.642-.087 1.106-.23 1.51a3.26 3.26 0 0 1-1.989 1.99c-.404.142-.868.178-1.51.23l-.101.008a5 5 0 0 0-.499.051a1.8 1.8 0 0 0-.637.264a5 5 0 0 0-.39.316l-.077.066c-.49.419-.844.72-1.23.905a3.26 3.26 0 0 1-2.813 0c-.387-.184-.74-.486-1.231-.905l-.078-.066a1.8 1.8 0 0 0-.388-.316a1.8 1.8 0 0 0-.638-.264a5 5 0 0 0-.499-.051l-.101-.009c-.642-.05-1.106-.087-1.51-.23a3.26 3.26 0 0 1-1.99-1.989c-.142-.404-.179-.868-.23-1.51l-.008-.101a5 5 0 0 0-.051-.499a1.8 1.8 0 0 0-.264-.637a5 5 0 0 0-.316-.39l-.066-.077c-.418-.49-.72-.844-.905-1.23a3.26 3.26 0 0 1 0-2.813c.185-.387.487-.74.905-1.231l.066-.078a5 5 0 0 0 .316-.388c.13-.193.219-.41.264-.638c.018-.09.027-.187.051-.499l.008-.101c.051-.642.088-1.106.23-1.51a3.26 3.26 0 0 1 1.99-1.99c.404-.142.868-.179 1.51-.23l.101-.008a5 5 0 0 0 .499-.051c.228-.045.445-.135.638-.264c.075-.051.15-.113.388-.316l.078-.066c.49-.418.844-.72 1.23-.905m2.163 1.358a1.76 1.76 0 0 0-1.514 0c-.185.088-.38.247-.981.758l-.03.025c-.197.168-.34.291-.497.396c-.359.24-.761.407-1.185.49c-.185.037-.373.052-.632.073l-.038.003c-.787.063-1.036.089-1.23.157c-.5.177-.894.57-1.07 1.071c-.07.194-.095.443-.158 1.23l-.003.038c-.02.259-.036.447-.072.632c-.084.424-.25.826-.49 1.185c-.106.157-.229.3-.397.498l-.025.029c-.511.6-.67.796-.758.98a1.76 1.76 0 0 0 0 1.515c.088.185.247.38.758.981l.025.03c.168.197.291.34.396.497c.24.359.407.761.49 1.185c.037.185.052.373.073.632l.003.038c.063.787.089 1.036.157 1.23c.177.5.57.894 1.071 1.07c.194.07.443.095 1.23.158l.038.003c.259.02.447.036.632.072c.424.084.826.25 1.185.49c.157.106.3.229.498.397l.029.025c.6.511.796.67.98.758a1.76 1.76 0 0 0 1.515 0c.185-.088.38-.247.981-.758l.03-.025c.197-.168.34-.291.497-.396c.359-.24.761-.407 1.185-.49a6 6 0 0 1 .632-.073l.038-.003c.787-.063 1.036-.089 1.23-.157c.5-.177.894-.57 1.07-1.071c.07-.194.095-.444.158-1.23l.003-.038a6 6 0 0 1 .072-.633c.084-.423.25-.825.49-1.184c.106-.157.229-.3.397-.498l.025-.029c.511-.6.67-.796.758-.98a1.76 1.76 0 0 0 0-1.515c-.088-.185-.247-.38-.758-.981l-.025-.03c-.168-.197-.291-.34-.396-.497a3.3 3.3 0 0 1-.49-1.185a6 6 0 0 1-.073-.632l-.003-.038c-.063-.787-.089-1.036-.157-1.23c-.177-.5-.57-.894-1.071-1.07c-.194-.07-.444-.095-1.23-.158l-.038-.003a6 6 0 0 1-.633-.072a3.3 3.3 0 0 1-1.184-.49c-.157-.106-.3-.229-.498-.397l-.029-.025c-.6-.511-.796-.67-.98-.758"
                                            clip-rule="evenodd" />
                                        <path fill-rule="evenodd"
                                            d="M15.543 8.457a.753.753 0 0 1 0 1.065l-6.021 6.02a.753.753 0 0 1-1.065-1.064l6.021-6.02a.753.753 0 0 1 1.065 0"
                                            clip-rule="evenodd" />
                                        <path
                                            d="M15.512 14.509a1.004 1.004 0 1 1-2.007 0a1.004 1.004 0 0 1 2.007 0m-5.017-5.018a1.004 1.004 0 1 1-2.007 0a1.004 1.004 0 0 1 2.007 0" />
                                    </g>
                                </svg>

                                {{ $category->promo_badge_text }}
                            </span>
                        @endif

                        @if($category->promo_title)
                            <h3>{{ $category->promo_title }}</h3>
                        @endif

                        @if($category->promo_description)
                            <p>{{ $category->promo_description }}</p>
                        @endif

                        @if($category->promo_button_text)
                            <a href="{{ $category->promo_button_url ?? 'javascript:void()' }}" class="btn btn-promo">
                                {{ $category->promo_button_text }}
                                <i class="icon-arrow"></i>
                            </a>
                        @endif
                    </div>

                    @if($category->promo_end_at)
                        <div class="promo-right">
                            <span class="countdown-label">Hurry, offer ends in</span>

                            <div class="countdown" id="countdown"
                                data-end="{{ $category->promo_end_at->format('Y-m-d\TH:i:s') }}">
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

        <!-- ATTRACTION SECTION -->
        @if($category->attractionLinks->count())
            <section class="listing-secF">
                <div class="container">
                    <div class="heading">
                        <h3>More Romantic <span>{{ $category->name }} Escapes</span></h3>
                        @if($category->short_description)
                            <p>{{ $category->short_description }}</p>
                        @endif
                    </div>

                    <div class="swiper-wrap">
                        <div class="swiper thirdSilder">
                            <div class="swiper-wrapper">
                                @foreach($category->attractionLinks as $link)
                                    @php $attraction = $link->attraction; @endphp
                                    @continue(!$attraction)

                                    <div class="swiper-slide">
                                        <div class="trip_card">
                                            <a href="{{ route('attraction.show', $attraction->slug) }}" target="_blank" class="img">
                                                <img loading="lazy"
                                                    src="{{ $attraction->image ? asset($attraction->image) : asset('assets/images/listing/placeholder.jpg') }}"
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

        <section class="listing-secD">
            <div class="container">
                <div class="heading">
                    <h3>Loved by <span>Honeymoon Couples</span></h3>
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
                        <div class="ring">
                            <svg viewBox="0 0 120 120">
                                <circle class="ring-bg" cx="60" cy="60" r="52"></circle>
                                <circle class="ring-fill" cx="60" cy="60" r="52"></circle>
                            </svg>

                            <div class="ring-score">
                                <h2>4.9</h2>
                                <span>out of 5</span>
                            </div>
                        </div>

                        <div class="rating-stars">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                            </svg>
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                            </svg>
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                            </svg>
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                            </svg>
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                            </svg>
                        </div>

                        <a href="javascript:void()" class="review-link"> 53,688 Europe Honeymoon Reviews </a>

                        <p class="review-sub">by couples from 70+ countries</p>
                    </div>

                    <div class="swiper_wrap">
                        <div class="swiper TestimonialSlider2">
                            <div class="swiper-wrapper">
                                <!-- Review 01 -->
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="header">
                                            <img loading="lazy" src="assets/images/home/client1.png" alt="Sanjeev Ahuja" />

                                            <div class="name">
                                                <h6>Sanjeev Ahuja</h6>

                                                <div class="badge-star">
                                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                                        <path
                                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                    </svg>
                                                    <span>5.0</span>
                                                </div>
                                            </div>

                                            <div class="quotes">
                                                <svg width="30" height="22" viewBox="0 0 44 34" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5654 42.7691 19.7951 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                                                        fill="#F3F4F6" stroke="#E5E7EB" />
                                                </svg>
                                            </div>
                                        </div>

                                        <p class="quote">
                                            Our Europe honeymoon was beautifully planned. Paris and Switzerland were
                                            absolutely magical, and everything was smooth from start to finish.
                                        </p>

                                        <div class="photo-strip">
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg"
                                                alt="Europe honeymoon experience" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg"
                                                alt="Paris honeymoon experience" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg"
                                                alt="Switzerland honeymoon experience" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Review 02 -->
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="header">
                                            <img loading="lazy" src="assets/images/home/client2.png" alt="Vicky Gupta" />

                                            <div class="name">
                                                <h6>Vicky Gupta</h6>

                                                <div class="badge-star">
                                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                                        <path
                                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                    </svg>
                                                    <span>5.0</span>
                                                </div>
                                            </div>

                                            <div class="quotes">
                                                <svg width="30" height="22" viewBox="0 0 44 34" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5655 42.7691 19.7951 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                                                        fill="#F3F4F6" stroke="#E5E7EB" />
                                                </svg>
                                            </div>
                                        </div>

                                        <p class="quote">
                                            Excellent service and a wonderful honeymoon experience. Santorini and
                                            Athens were perfect, and every arrangement was handled with great
                                            attention to detail.
                                        </p>

                                        <div class="photo-strip">
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg"
                                                alt="Santorini honeymoon experience" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg"
                                                alt="Greece honeymoon experience" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg"
                                                alt="Europe couple holiday" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg"
                                                alt="Romantic Europe trip" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Review 03 -->
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="header">
                                            <img loading="lazy" src="assets/images/home/client3.png" alt="Floyd Miles" />

                                            <div class="name">
                                                <h6>Floyd Miles</h6>

                                                <div class="badge-star">
                                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                                        <path
                                                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                    </svg>
                                                    <span>4.8</span>
                                                </div>
                                            </div>

                                            <div class="quotes">
                                                <svg width="30" height="22" viewBox="0 0 44 34" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5655 42.7691 19.7951 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                                                        fill="#F3F4F6" stroke="#E5E7EB" />
                                                </svg>
                                            </div>
                                        </div>

                                        <p class="quote">
                                            Everything about our Italy honeymoon was wonderful. Rome, Florence and
                                            Venice gave us unforgettable memories, and the entire trip was organised
                                            perfectly.
                                        </p>

                                        <div class="photo-strip">
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg"
                                                alt="Italy honeymoon experience" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg"
                                                alt="Rome honeymoon experience" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg"
                                                alt="Venice honeymoon experience" />
                                            <img loading="lazy" src="assets/images/listing/rarting-view.jpg"
                                                alt="Romantic Italy trip" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ SECTION -->
        <section class="listing-secI">
            <div class="container">
                <div class="heading">
                    <h3>{{ $category->plan_heading }} <span>{{ $category->plan_heading_highlight }}</span></h3>
                    @if($category->plan_intro)
                        <p>{{ $category->plan_intro }}</p>
                    @endif
                </div>

                @if($category->faqs->count())
                    <div class="accordion-wrapper">
                        @foreach($category->faqs as $faq)
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

        <!-- DESTINATION SECTION -->
        @if($category->destinationLinks->count())
            <section class="listing-secV">
                <div class="container">
                    <div class="heading">
                        <h3>Popular {{ $category->name }} <span>Destinations</span></h3>
                        @if($category->short_description)
                            <p>{{ $category->short_description }}</p>
                        @endif
                    </div>

                    <div class="swiper-wrap">
                        <div class="swiper thirdSilder">
                            <div class="swiper-wrapper">
                                @foreach($category->destinationLinks as $link)
                                    @php $destination = $link->destination; @endphp
                                    @continue(!$destination)

                                    <div class="swiper-slide">
                                        <a href="{{ route('destination.show', $destination->slug) }}" target="_blank"
                                            class="trip_card3">
                                            <div class="img">
                                                <img loading="lazy"
                                                    src="{{ $destination->image ? asset($destination->image) : asset('assets/images/listing/placeholder.jpg') }}"
                                                    alt="{{ $destination->name }}" />
                                            </div>

                                            @if($destination->duration_text)
                                                <span class="rating-badge">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <circle cx="12" cy="12" r="9" />
                                                        <path d="M12 8v5M12 16h.01" />
                                                    </svg>
                                                    {{ $destination->duration_text }}
                                                </span>
                                            @endif

                                            <div class="content">
                                                <p class="type">{{ $category->name }}</p>
                                                <h3 class="place">{{ $destination->name }}</h3>

                                                @if($destination->best_time_text)
                                                    <p class="best-time" style="font-size:12px;color:#8c9196;margin:2px 0 0;">
                                                        Best time: {{ $destination->best_time_text }}
                                                    </p>
                                                @endif

                                                <div class="foot">
                                                    @if($destination->budget_text)
                                                        <p class="price"><small>Budget</small>{{ $destination->budget_text }}</p>
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
                </div>
            </section>
        @endif

        <section class="seo-links-sec">
            <div class="container">
                <div class="heading">
                    <h3>Explore More <span>Europe Honeymoons</span></h3>
                    <p>
                        Discover romantic destinations, honeymoon itineraries, travel tips and unforgettable
                        experiences to plan your perfect Europe honeymoon.
                    </p>
                </div>

                <div class="seo-links-wrapper">
                    <!-- Category 01 -->
                    <div class="seo-link-block">
                        <h4>Europe Honeymoon Packages From Popular Indian Cities</h4>

                        <div class="seo-link-wrap">
                            <a href="javascript:void()">Europe Honeymoon Packages From Delhi</a>
                            <a href="javascript:void()">Europe Honeymoon Packages From Mumbai</a>
                            <a href="javascript:void()">Europe Honeymoon Packages From Bangalore</a>
                            <a href="javascript:void()">Europe Honeymoon Packages From Ahmedabad</a>
                            <a href="javascript:void()">Europe Honeymoon Packages From Hyderabad</a>
                            <a href="javascript:void()">Europe Honeymoon Packages From Chennai</a>
                            <a href="javascript:void()">Europe Honeymoon Packages From Pune</a>
                            <a href="javascript:void()">Europe Honeymoon Packages From Kolkata</a>
                            <a href="javascript:void()">Europe Honeymoon Packages From Jaipur</a>
                            <a href="javascript:void()">Europe Honeymoon Packages From Lucknow</a>
                            <a href="javascript:void()">Europe Honeymoon Packages From Surat</a>
                            <a href="javascript:void()">Europe Honeymoon Packages From Chandigarh</a>
                        </div>
                    </div>

                    <!-- Category 02 -->
                    <div class="seo-link-block">
                        <h4>Best Selling Europe Honeymoon Itineraries</h4>

                        <div class="seo-link-wrap">
                            <a href="javascript:void()">Europe Honeymoon Itinerary for 5 Days</a>
                            <a href="javascript:void()">Europe Honeymoon Itinerary for 6 Days</a>
                            <a href="javascript:void()">Europe Honeymoon Itinerary for 7 Days</a>
                            <a href="javascript:void()">Europe Honeymoon Itinerary for 8 Days</a>
                            <a href="javascript:void()">Europe Honeymoon Itinerary for 9 Days</a>
                            <a href="javascript:void()">Europe Honeymoon Itinerary for 10 Days</a>
                            <a href="javascript:void()">Europe Honeymoon Itinerary for 12 Days</a>
                            <a href="javascript:void()">Europe Honeymoon Itinerary for 15 Days</a>
                        </div>
                    </div>

                    <!-- Category 03 -->
                    <div class="seo-link-block">
                        <h4>Popular Europe Honeymoon Destinations</h4>

                        <div class="seo-link-wrap">
                            <a href="javascript:void()">Paris Honeymoon Packages</a>
                            <a href="javascript:void()">Switzerland Honeymoon Packages</a>
                            <a href="javascript:void()">Santorini Honeymoon Packages</a>
                            <a href="javascript:void()">Italy Honeymoon Packages</a>
                            <a href="javascript:void()">Venice Honeymoon Packages</a>
                            <a href="javascript:void()">Greece Honeymoon Packages</a>
                            <a href="javascript:void()">France Honeymoon Packages</a>
                            <a href="javascript:void()">Austria Honeymoon Packages</a>
                            <a href="javascript:void()">Spain Honeymoon Packages</a>
                            <a href="javascript:void()">Amsterdam Honeymoon Packages</a>
                            <a href="javascript:void()">Prague Honeymoon Packages</a>
                            <a href="javascript:void()">London Honeymoon Packages</a>
                        </div>
                    </div>

                    <!-- Category 04 -->
                    <div class="seo-link-block">
                        <h4>Romantic Europe Honeymoon Experiences</h4>

                        <div class="seo-link-wrap">
                            <a href="javascript:void()">Paris Romantic Experiences</a>
                            <a href="javascript:void()">Swiss Alps Honeymoon Experiences</a>
                            <a href="javascript:void()">Santorini Sunset Experiences</a>
                            <a href="javascript:void()">Venice Gondola Ride for Couples</a>
                            <a href="javascript:void()">Romantic Europe Train Journeys</a>
                            <a href="javascript:void()">Luxury Europe Honeymoon Packages</a>
                            <a href="javascript:void()">Couple Tours in Europe</a>
                            <a href="javascript:void()">Europe Honeymoon Packages for Couples</a>
                            <a href="javascript:void()">Europe Honeymoon Packages with Flights</a>
                            <a href="javascript:void()">Europe Honeymoon Packages with Hotels</a>
                            <a href="javascript:void()">Budget Europe Honeymoon Packages</a>
                            <a href="javascript:void()">Luxury Europe Honeymoon Experiences</a>
                            <a href="javascript:void()">Best Europe Honeymoon Deals</a>
                            <a href="javascript:void()">Customized Europe Honeymoon Packages</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection

@push('scripts')

    @if($category->promo_end_at)
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

@endpush