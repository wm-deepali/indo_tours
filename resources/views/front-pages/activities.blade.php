@extends('layouts.app')

@section('title', 'Activities | Indo Tours & Adventures')
@section('meta_description', 'Indo Tours & Adventures is a leading travel company offering a wide range of tour packages, including domestic and international destinations. Explore the world with our expertly crafted itineraries and exceptional services.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/activity/activity.css') }}" />
@endpush

@section('content')
   
    <main>
      <!-- ============================= -->
      <!-- ACTIVITIES HERO (existing banner reused) -->
      <!-- ============================= -->
      <section class="listing-banner">
        <div class="bg">
          <div class="swiper listSlider">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <img
                  loading="lazy"
                  src="https://images.unsplash.com/photo-1451337516015-6b6e9a44a8a3?auto=format&fit=crop&w=1600&q=80"
                  alt="Desert safari dunes at sunset in Dubai"
                />
              </div>
              <div class="swiper-slide">
                <img
                  loading="lazy"
                  src="https://images.unsplash.com/photo-1518684079-3c830dcef090?auto=format&fit=crop&w=1600&q=80"
                  alt="Dubai Marina skyline cruise at night"
                />
              </div>
            </div>
          </div>

          <div class="container">
            <nav class="breadcrumb breadcrumb-light" aria-label="Breadcrumb">
              <ul>
                <li><a href="/">Home</a></li>
                <li><span class="breadcrumb-separator">/</span></li>
                <li><a href="/dubai/">Dubai</a></li>
                <li><span class="breadcrumb-separator">/</span></li>
                <li>
                  <a href="/dubai/activities/" class="active">Activities</a>
                </li>
              </ul>
            </nav>

            <div class="bg-wrapper">
              <div class="content">
                <span class="offer-tag">Exclusive Dubai Activity Deals</span>

                <h1>Best Activities in Dubai</h1>

                <p>
                  Discover unforgettable things to do in Dubai, from desert
                  adventures and luxury cruises to iconic attractions and
                  thrilling experiences.
                </p>

                <a href="#dubai-activities-grid" class="btn btn-primary">
                  Explore Dubai Activities
                  <i class="icon-arrow"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ============================= -->
      <!-- DESTINATION INTRODUCTION -->
      <!-- ============================= -->
      <section class="activities-intro">
        <div class="container">
          <div class="heading">
            <h3>Things to <span>Do in Dubai</span></h3>
            <p>
              Explore Dubai’s top attractions, thrilling adventures, luxury
              experiences and unforgettable activities for every traveller.
            </p>
          </div>
        </div>
      </section>

      <!-- ============================= -->
      <!-- ACTIVITY CATEGORIES (tab-nav — uses existing common tab JS) -->
      <!-- ============================= -->
      <section class="activities-categories">
        <div class="container">
          <ul class="tab-nav">
            <li class="active" data-tab="all">All Activities</li>
            <li data-tab="adventure">Adventure</li>
            <li data-tab="desert">Desert Experiences</li>
            <li data-tab="sightseeing">Sightseeing</li>
            <li data-tab="cruises">Cruises</li>
            <li data-tab="water">Water Activities</li>
            <li data-tab="family">Family Experiences</li>
            <li data-tab="theme">Theme Parks</li>
            <li data-tab="luxury">Luxury Experiences</li>
          </ul>
        </div>
      </section>

      <!-- ============================= -->
      <!-- MAIN ACTIVITIES LISTING -->
      <!-- ============================= -->
  <section class="activities-listing" id="dubai-activities-grid">
  <div class="container">
    <div class="activities-listing-head">
      <div class="head-left">
        <span class="eyebrow">Handpicked For You</span>
        <h2>Popular Activities in Dubai</h2>
        <p>
          Explore handpicked experiences and exciting things to do during
          your Dubai trip.
        </p>
      </div>

      <div class="head-right">
        <span class="results-count">9 Activities</span>
      </div>
    </div>

    <div class="tab-nav-content">

      <!-- ==================== ALL ==================== -->
      <div class="tabs active" data-tab="all">
        <div class="activities-grid">

          <!-- Desert Safari -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Desert Safari"
              />
              <span class="save">Bestseller</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>6 Hours</span>

                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.7</span>
                  <em>(320)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Desert Safari
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 4,500</s>
                <span class="saveChip">Save INR 800</span>
              </div>

              <p class="price">INR 3,700</p>

              <div class="btns">
                <!-- Call Icon Only -->
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

          <!-- Burj Khalifa -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Burj Khalifa At The Top"
              />
              <span class="save">Save INR 700</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>1.5 Hours</span>

                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.8</span>
                  <em>(540)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Burj Khalifa At The Top
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 5,200</s>
                <span class="saveChip">Save INR 700</span>
              </div>

              <p class="price">INR 4,500</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

          <!-- Dubai City Tour -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai City Tour"
              />
              <span class="save">Save INR 400</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>4 Hours</span>

                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.5</span>
                  <em>(180)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai City Tour
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 2,800</s>
                <span class="saveChip">Save INR 400</span>
              </div>

              <p class="price">INR 2,400</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

          <!-- Dubai Aquarium -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Aquarium Experience"
              />
              <span class="save">Save INR 400</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>1 Hour</span>

                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.4</span>
                  <em>(150)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai Aquarium Experience
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 3,000</s>
                <span class="saveChip">Save INR 400</span>
              </div>

              <p class="price">INR 2,600</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

          <!-- Dubai Yacht -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Yacht Experience"
              />
              <span class="save">Save INR 1,200</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>3 Hours</span>

                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.7</span>
                  <em>(260)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai Yacht Experience
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 8,500</s>
                <span class="saveChip">Save INR 1,200</span>
              </div>

              <p class="price">INR 7,300</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 0 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

          <!-- Dubai Water Sports -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Water Sports"
              />
              <span class="save">Save INR 500</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>2 Hours</span>

                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.5</span>
                  <em>(140)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai Water Sports
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 3,800</s>
                <span class="saveChip">Save INR 500</span>
              </div>

              <p class="price">INR 3,300</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

          <!-- Skydiving -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Skydiving Experience"
              />
              <span class="save">Save INR 2,000</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>3 Hours</span>

                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.9</span>
                  <em>(410)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Skydiving Experience
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 22,000</s>
                <span class="saveChip">Save INR 2,000</span>
              </div>

              <p class="price">INR 20,000</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

          <!-- Theme Park -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Theme Park Experience"
              />
              <span class="save">Save INR 900</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>Full Day</span>

                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.6</span>
                  <em>(190)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai Theme Park Experience
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 6,500</s>
                <span class="saveChip">Save INR 900</span>
              </div>

              <p class="price">INR 5,600</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ==================== ADVENTURE ==================== -->
      <div class="tabs" data-tab="adventure">
        <div class="activities-grid">

          <!-- Desert Safari -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Desert Safari"
              />
              <span class="save">Bestseller</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>6 Hours</span>

                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.7</span>
                  <em>(320)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Desert Safari
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 4,500</s>
                <span class="saveChip">Save INR 800</span>
              </div>

              <p class="price">INR 3,700</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

          <!-- Skydiving -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Skydiving Experience"
              />
              <span class="save">Save INR 2,000</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>3 Hours</span>

                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.9</span>
                  <em>(410)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Skydiving Experience
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 22,000</s>
                <span class="saveChip">Save INR 2,000</span>
              </div>

              <p class="price">INR 20,000</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

          <!-- Dubai Water Sports -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Water Sports"
              />
              <span class="save">Save INR 500</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>2 Hours</span>

                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.5</span>
                  <em>(140)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai Water Sports
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 3,800</s>
                <span class="saveChip">Save INR 500</span>
              </div>

              <p class="price">INR 3,300</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ==================== DESERT ==================== -->
      <div class="tabs" data-tab="desert">
        <div class="activities-grid">

          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Desert Safari"
              />
              <span class="save">Bestseller</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>6 Hours</span>
                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.7</span>
                  <em>(320)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Desert Safari
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 4,500</s>
                <span class="saveChip">Save INR 800</span>
              </div>

              <p class="price">INR 3,700</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ==================== SIGHTSEEING ==================== -->
      <div class="tabs" data-tab="sightseeing">
        <div class="activities-grid">

          <!-- Burj Khalifa -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Burj Khalifa At The Top"
              />
              <span class="save">Save INR 700</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>1.5 Hours</span>
                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86-.73 1.54-1.49 1.08z"
                    />
                  </svg>
                  <span>4.8</span>
                  <em>(540)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Burj Khalifa At The Top
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 5,200</s>
                <span class="saveChip">Save INR 700</span>
              </div>

              <p class="price">INR 4,500</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

          <!-- Dubai City Tour -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai City Tour"
              />
              <span class="save">Save INR 400</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>4 Hours</span>
                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.5</span>
                  <em>(180)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai City Tour
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 2,800</s>
                <span class="saveChip">Save INR 400</span>
              </div>

              <p class="price">INR 2,400</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 0 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ==================== CRUISES ==================== -->
      <div class="tabs" data-tab="cruises">
        <div class="activities-grid">

          <!-- Dubai Marina Cruise -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Marina Luxury Cruise"
              />
              <span class="save">Save INR 500</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>2 Hours</span>
                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.6</span>
                  <em>(210)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai Marina Luxury Cruise
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 3,200</s>
                <span class="saveChip">Save INR 500</span>
              </div>

              <p class="price">INR 2,700</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

          <!-- Dubai Yacht -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Yacht Experience"
              />
              <span class="save">Save INR 1,200</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>3 Hours</span>
                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c-.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.7</span>
                  <em>(260)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai Yacht Experience
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 8,500</s>
                <span class="saveChip">Save INR 1,200</span>
              </div>

              <p class="price">INR 7,300</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 0 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ==================== WATER ==================== -->
      <div class="tabs" data-tab="water">
        <div class="activities-grid">

          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Water Sports"
              />
              <span class="save">Save INR 500</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>2 Hours</span>
                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.5</span>
                  <em>(140)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai Water Sports
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 3,800</s>
                <span class="saveChip">Save INR 500</span>
              </div>

              <p class="price">INR 3,300</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 0 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ==================== FAMILY ==================== -->
      <div class="tabs" data-tab="family">
        <div class="activities-grid">

          <!-- Aquarium -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Aquarium Experience"
              />
              <span class="save">Save INR 400</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>1 Hour</span>
                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.4</span>
                  <em>(150)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai Aquarium Experience
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 3,000</s>
                <span class="saveChip">Save INR 400</span>
              </div>

              <p class="price">INR 2,600</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 0 2.987l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

          <!-- Theme Park -->
          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Theme Park Experience"
              />
              <span class="save">Save INR 900</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>Full Day</span>
                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.6</span>
                  <em>(190)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai Theme Park Experience
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 6,500</s>
                <span class="saveChip">Save INR 900</span>
              </div>

              <p class="price">INR 5,600</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 0 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ==================== THEME PARKS ==================== -->
      <div class="tabs" data-tab="theme">
        <div class="activities-grid">

          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Theme Park Experience"
              />
              <span class="save">Save INR 900</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>Full Day</span>
                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.6</span>
                  <em>(190)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai Theme Park Experience
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 6,500</s>
                <span class="saveChip">Save INR 900</span>
              </div>

              <p class="price">INR 5,600</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- ==================== LUXURY ==================== -->
      <div class="tabs" data-tab="luxury">
        <div class="activities-grid">

          <div class="trip_card">
            <a href="activities-detail.html" target="_blank" class="img">
              <img
                loading="lazy"
                src="assets/images/blog/dubai.jpg"
                alt="Dubai Yacht Experience"
              />
              <span class="save">Save INR 1,200</span>
            </a>

            <div class="content">
              <div class="rating">
                <span>3 Hours</span>

                <div class="star">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                      d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                    />
                  </svg>
                  <span>4.7</span>
                  <em>(260)</em>
                </div>
              </div>

              <h3>
                <a href="activities-detail.html" target="_blank">
                  Dubai Yacht Experience
                </a>
              </h3>

              <div class="innerSave">
                <s>INR 8,500</s>
                <span class="saveChip">Save INR 1,200</span>
              </div>

              <p class="price">INR 7,300</p>

              <div class="btns">
                <a
                  href="tel:+910000000000"
                  class="btn btn-outline-primary"
                  aria-label="Call Now"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    stroke-linejoin="round"
                  >
                    <path
                      d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 0 2.987 0l1.707 1.707a2.11 2.11 0 0 0 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                    />
                  </svg>
                </a>

                <button
                  data-model=".enquire-pop"
                  class="btn btn-primary"
                >
                  Enquire Now
                </button>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

      <!-- ============================= -->
      <!-- DESTINATION OFFER (existing promo reused) -->
      <!-- ============================= -->
      <section class="listing-secG">
        <div class="container">
          <div class="grid">
            <div class="glow"></div>

            <div class="promo-left">
              <span class="promo-badge">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="1em"
                  height="1em"
                  viewBox="0 0 24 24"
                >
                  <path d="M0 0h24v24H0z" fill="none" />
                  <g fill="currentColor">
                    <path
                      fill-rule="evenodd"
                      d="M10.594 2.319a3.26 3.26 0 0 1 2.812 0c.387.185.74.487 1.231.905l.078.066c.238.203.313.265.389.316c.193.13.41.219.637.264c.09.018.187.027.499.051l.101.008c.642.051 1.106.088 1.51.23a3.27 3.27 0 0 1 1.99 1.99c.142.404.178.868.23 1.51l.008.101c.024.312.033.41.051.499c.045.228.135.445.264.638c.051.075.113.15.316.388l.066.078c.419.49.72.844.905 1.23c.425.89.425 1.924 0 2.813c-.184.387-.486.74-.905 1.231l-.066.078a5 5 0 0 0-.316.389c-.13.193-.219.41-.264.637c-.018.09-.026.187-.051.499l-.009.101c-.05.642-.087 1.106-.23 1.51a3.26 3.26 0 0 1-1.989 1.99c-.404.142-.868.178-1.51.23l-.101.008a5 5 0 0 0-.499.051a1.8 1.8 0 0 0-.637.264a5 5 0 0 0-.39.316l-.077.066c-.49.419-.844.72-1.23.905a3.26 3.26 0 0 1-2.813 0c-.387-.184-.74-.486-1.231-.905l-.078-.066a5 5 0 0 0-.388-.316a1.8 1.8 0 0 0-.638-.264a5 5 0 0 0-.499-.051l-.101-.009c-.642-.05-1.106-.087-1.51-.23a3.26 3.26 0 0 1-1.99-1.989c-.142-.404-.179-.868-.23-1.51l-.008-.101a5 5 0 0 0-.051-.499a1.8 1.8 0 0 0-.264-.637a5 5 0 0 0-.316-.39l-.066-.077c-.418-.49-.72-.844-.905-1.23a3.26 3.26 0 0 1 0-2.813c.185-.387.487-.74.905-1.231l.066-.078a5 5 0 0 0 .316-.388c.13-.193.219-.41.264-.638c.018-.09.027-.187.051-.499l.008-.101c.051-.642.088-1.106.23-1.51a3.26 3.26 0 0 1 1.99-1.99c.404-.142.868-.179 1.51-.23l.101-.008a5 5 0 0 0 .499-.051c.228-.045.445-.135.638-.264c.075-.051.15-.113.388-.316l.078-.066c.49-.418.844-.72 1.23-.905m2.163 1.358a1.76 1.76 0 0 0-1.514 0c-.185.088-.38.247-.981.758l-.03.025c-.197.168-.34.291-.497.396c-.359.24-.761.407-1.185.49c-.185.037-.373.052-.632.073l-.038.003c-.787.063-1.036.089-1.23.157c-.5.177-.894.57-1.07 1.071c-.07.194-.095.443-.158 1.23l-.003.038c-.02.259-.036.447-.072.632c-.084.424-.25.826-.49 1.185c-.106.157-.229.3-.397.498l-.025.029c-.511.6-.67.796-.758.98a1.76 1.76 0 0 0 0 1.515c.088.185.247.38.758.981l.025.03c.168.197.291.34.396.497c.24.359.407.761.49 1.185c.037.185.052.373.073.632l.003.038c.063.787.089 1.036.157 1.23c.177.5.57.894 1.071 1.07c.194.07.443.095 1.23.158l.038.003c.259.02.447.036.632.072c.424.084.826.25 1.185.49c.157.106.3.229.498.397l.029.025c.6.511.796.67.98.758a1.76 1.76 0 0 0 1.515 0c.185-.088.38-.247.981-.758l.03-.025c.197-.168.34-.291.497-.396c.359-.24.761-.407 1.185-.49a6 6 0 0 1 .632-.073l.038-.003c.787-.063 1.036-.089 1.23-.157c.5-.177.894-.57 1.07-1.071c.07-.194.095-.444.158-1.23l.003-.038a6 6 0 0 1 .072-.633c.084-.423.25-.825.49-1.184c.106-.157.229-.3.397-.498l.025-.029c.511-.6.67-.796.758-.98a1.76 1.76 0 0 0 0-1.515c-.088-.185-.247-.38-.758-.981l-.025-.03c-.168-.197-.291-.34-.396-.497a3.3 3.3 0 0 1-.49-1.185a6 6 0 0 1-.073-.632l-.003-.038c-.063-.787-.089-1.036-.157-1.23c-.177-.5-.57-.894-1.071-1.07c-.194-.07-.444-.095-1.23-.158l-.038-.003a6 6 0 0 1-.633-.072a3.3 3.3 0 0 1-1.184-.49c-.157-.106-.3-.229-.498-.397l-.029-.025c-.6-.511-.796-.67-.98-.758"
                      clip-rule="evenodd"
                    />
                    <path
                      fill-rule="evenodd"
                      d="M15.543 8.457a.753.753 0 0 1 0 1.065l-6.021 6.02a.753.753 0 0 1-1.065-1.064l6.021-6.02a.753.753 0 0 1 1.065 0"
                      clip-rule="evenodd"
                    />
                    <path
                      d="M15.512 14.509a1.004 1.004 0 1 1-2.007 0a1.004 1.004 0 0 1 2.007 0m-5.017-5.018a1.004 1.004 0 1 1-2.007 0a1.004 1.004 0 0 1 2.007 0"
                    />
                  </g>
                </svg>
                Dubai Experience Sale
              </span>

              <h3>Save up to INR 10,000 on selected Dubai activities</h3>
              <p>
                Book selected Dubai experiences and enjoy limited-time offers on
                unforgettable adventures.
              </p>

              <a href="javascript:void()" class="btn btn-promo">
                Explore Dubai Deals
                <i class="icon-arrow"></i>
              </a>
            </div>

            <div class="promo-right">
              <span class="countdown-label">Hurry, sale ends in</span>

              <div class="countdown" id="countdown">
                <div class="time-block">
                  <div class="flip" data-unit="days">
                    <span class="digit">03</span>
                  </div>
                  <span class="unit-label">Days</span>
                </div>
                <span class="sep">:</span>
                <div class="time-block">
                  <div class="flip" data-unit="hours">
                    <span class="digit">11</span>
                  </div>
                  <span class="unit-label">Hours</span>
                </div>
                <span class="sep">:</span>
                <div class="time-block">
                  <div class="flip" data-unit="minutes">
                    <span class="digit">24</span>
                  </div>
                  <span class="unit-label">Mins</span>
                </div>
                <span class="sep">:</span>
                <div class="time-block">
                  <div class="flip" data-unit="seconds">
                    <span class="digit">09</span>
                  </div>
                  <span class="unit-label">Secs</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ============================= -->
      <!-- MUST-TRY ACTIVITIES -->
      <!-- ============================= -->
     <section class="activities-featured">
  <div class="container">
    <div class="featured-head">
      <div class="heading">
        <h3>Top <span>Dubai Experiences</span></h3>
        <p>
          Discover unforgettable experiences that make your Dubai holiday
          truly special.
        </p>
      </div>
    </div>

    <div class="activities-featured-grid">

      <!-- Dubai Marina Cruise -->
      <div class="trip_card">
        <a href="activities-detail.html" target="_blank" class="img">
          <img
            loading="lazy"
            src="assets/images/blog/dubai.jpg"
            alt="Dubai Marina luxury dinner cruise"
          />
          <span class="save">Save INR 500</span>
        </a>

        <div class="content">
          <div class="rating">
            <span>2 Hours</span>
            <div class="star">
              <svg viewBox="0 0 24 24">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                />
              </svg>
              <span>4.6</span>
              <em>(210)</em>
            </div>
          </div>

          <h3>
            <a href="activities-detail.html" target="_blank">
              Dubai Marina Luxury Cruise
            </a>
          </h3>

          <div class="innerSave">
            <s>INR 3,200</s>
            <span class="saveChip">Save INR 500</span>
          </div>

          <p class="price">INR 2,700</p>

          <div class="btns">
            <a
              href="tel:+911234567890"
              class="btn btn-outline-primary"
              aria-label="Call Now"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linejoin="round"
              >
                <path
                  d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                />
              </svg>
            </a>

            <button
              data-model=".enquire-pop"
              class="btn btn-primary"
            >
              Enquire Now
            </button>
          </div>
        </div>
      </div>


      <!-- Burj Khalifa -->
      <div class="trip_card">
        <a href="activities-detail.html" target="_blank" class="img">
          <img
            loading="lazy"
            src="assets/images/blog/dubai.jpg"
            alt="Burj Khalifa At the Top observation deck experience"
          />
          <span class="save">Save INR 700</span>
        </a>

        <div class="content">
          <div class="rating">
            <span>1.5 Hours</span>
            <div class="star">
              <svg viewBox="0 0 24 24">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                />
              </svg>
              <span>4.8</span>
              <em>(540)</em>
            </div>
          </div>

          <h3>
            <a href="activities-detail.html" target="_blank">
              Burj Khalifa At The Top
            </a>
          </h3>

          <div class="innerSave">
            <s>INR 5,200</s>
            <span class="saveChip">Save INR 700</span>
          </div>

          <p class="price">INR 4,500</p>

          <div class="btns">
            <a
              href="tel:+911234567890"
              class="btn btn-outline-primary"
              aria-label="Call Now"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linejoin="round"
              >
                <path
                  d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                />
              </svg>
            </a>

            <button
              data-model=".enquire-pop"
              class="btn btn-primary"
            >
              Enquire Now
            </button>
          </div>
        </div>
      </div>


      <!-- Dubai City Tour -->
      <div class="trip_card">
        <a href="activities-detail.html" target="_blank" class="img">
          <img
            loading="lazy"
            src="assets/images/blog/dubai.jpg"
            alt="Guided city tour of Dubai landmarks"
          />
          <span class="save">Save INR 400</span>
        </a>

        <div class="content">
          <div class="rating">
            <span>4 Hours</span>
            <div class="star">
              <svg viewBox="0 0 24 24">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                />
              </svg>
              <span>4.5</span>
              <em>(180)</em>
            </div>
          </div>

          <h3>
            <a href="activities-detail.html" target="_blank">
              Dubai City Tour
            </a>
          </h3>

          <div class="innerSave">
            <s>INR 2,800</s>
            <span class="saveChip">Save INR 400</span>
          </div>

          <p class="price">INR 2,400</p>

          <div class="btns">
            <a
              href="tel:+911234567890"
              class="btn btn-outline-primary"
              aria-label="Call Now"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linejoin="round"
              >
                <path
                  d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                />
              </svg>
            </a>

            <button
              data-model=".enquire-pop"
              class="btn btn-primary"
            >
              Enquire Now
            </button>
          </div>
        </div>
      </div>


      <!-- Dubai Aquarium -->
      <div class="trip_card">
        <a href="activities-detail.html" target="_blank" class="img">
          <img
            loading="lazy"
            src="assets/images/blog/dubai.jpg"
            alt="Dubai Aquarium and Underwater Zoo experience"
          />
          <span class="save">Save INR 400</span>
        </a>

        <div class="content">
          <div class="rating">
            <span>1 Hour</span>
            <div class="star">
              <svg viewBox="0 0 24 24">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                />
              </svg>
              <span>4.4</span>
              <em>(150)</em>
            </div>
          </div>

          <h3>
            <a href="activities-detail.html" target="_blank">
              Dubai Aquarium Experience
            </a>
          </h3>

          <div class="innerSave">
            <s>INR 3,000</s>
            <span class="saveChip">Save INR 400</span>
          </div>

          <p class="price">INR 2,600</p>

          <div class="btns">
            <a
              href="tel:+911234567890"
              class="btn btn-outline-primary"
              aria-label="Call Now"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linejoin="round"
              >
                <path
                  d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                />
              </svg>
            </a>

            <button
              data-model=".enquire-pop"
              class="btn btn-primary"
            >
              Enquire Now
            </button>
          </div>
        </div>
      </div>


      <!-- Dubai Yacht -->
      <div class="trip_card">
        <a href="activities-detail.html" target="_blank" class="img">
          <img
            loading="lazy"
            src="assets/images/blog/dubai.jpg"
            alt="Dubai yacht experience along the coastline"
          />
          <span class="save">Save INR 1,200</span>
        </a>

        <div class="content">
          <div class="rating">
            <span>3 Hours</span>
            <div class="star">
              <svg viewBox="0 0 24 24">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                />
              </svg>
              <span>4.7</span>
              <em>(260)</em>
            </div>
          </div>

          <h3>
            <a href="activities-detail.html" target="_blank">
              Dubai Yacht Experience
            </a>
          </h3>

          <div class="innerSave">
            <s>INR 8,500</s>
            <span class="saveChip">Save INR 1,200</span>
          </div>

          <p class="price">INR 7,300</p>

          <div class="btns">
            <a
              href="tel:+911234567890"
              class="btn btn-outline-primary"
              aria-label="Call Now"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linejoin="round"
              >
                <path
                  d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                />
              </svg>
            </a>

            <button
              data-model=".enquire-pop"
              class="btn btn-primary"
            >
              Enquire Now
            </button>
          </div>
        </div>
      </div>


      <!-- Dubai Water Sports -->
      <div class="trip_card">
        <a href="activities-detail.html" target="_blank" class="img">
          <img
            loading="lazy"
            src="assets/images/blog/dubai.jpg"
            alt="Water sports experience on Dubai's coast"
          />
          <span class="save">Save INR 500</span>
        </a>

        <div class="content">
          <div class="rating">
            <span>2 Hours</span>
            <div class="star">
              <svg viewBox="0 0 24 24">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                />
              </svg>
              <span>4.5</span>
              <em>(140)</em>
            </div>
          </div>

          <h3>
            <a href="activities-detail.html" target="_blank">
              Dubai Water Sports
            </a>
          </h3>

          <div class="innerSave">
            <s>INR 3,800</s>
            <span class="saveChip">Save INR 500</span>
          </div>

          <p class="price">INR 3,300</p>

          <div class="btns">
            <a
              href="tel:+911234567890"
              class="btn btn-outline-primary"
              aria-label="Call Now"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linejoin="round"
              >
                <path
                  d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                />
              </svg>
            </a>

            <button
              data-model=".enquire-pop"
              class="btn btn-primary"
            >
              Enquire Now
            </button>
          </div>
        </div>
      </div>


      <!-- Skydiving -->
      <div class="trip_card">
        <a href="activities-detail.html" target="_blank" class="img">
          <img
            loading="lazy"
            src="assets/images/blog/dubai.jpg"
            alt="Skydiving experience over Palm Jumeirah Dubai"
          />
          <span class="save">Save INR 2,000</span>
        </a>

        <div class="content">
          <div class="rating">
            <span>3 Hours</span>
            <div class="star">
              <svg viewBox="0 0 24 24">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                />
              </svg>
              <span>4.9</span>
              <em>(410)</em>
            </div>
          </div>

          <h3>
            <a href="activities-detail.html" target="_blank">
              Skydiving Experience
            </a>
          </h3>

          <div class="innerSave">
            <s>INR 22,000</s>
            <span class="saveChip">Save INR 2,000</span>
          </div>

          <p class="price">INR 20,000</p>

          <div class="btns">
            <a
              href="tel:+911234567890"
              class="btn btn-outline-primary"
              aria-label="Call Now"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linejoin="round"
              >
                <path
                  d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                />
              </svg>
            </a>

            <button
              data-model=".enquire-pop"
              class="btn btn-primary"
            >
              Enquire Now
            </button>
          </div>
        </div>
      </div>


      <!-- Theme Park -->
      <div class="trip_card">
        <a href="activities-detail.html" target="_blank" class="img">
          <img
            loading="lazy"
            src="assets/images/blog/dubai.jpg"
            alt="Dubai theme park rides and attractions"
          />
          <span class="save">Save INR 900</span>
        </a>

        <div class="content">
          <div class="rating">
            <span>Full Day</span>
            <div class="star">
              <svg viewBox="0 0 24 24">
                <path
                  d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z"
                />
              </svg>
              <span>4.6</span>
              <em>(190)</em>
            </div>
          </div>

          <h3>
            <a href="activities-detail.html" target="_blank">
              Dubai Theme Park Experience
            </a>
          </h3>

          <div class="innerSave">
            <s>INR 6,500</s>
            <span class="saveChip">Save INR 900</span>
          </div>

          <p class="price">INR 5,600</p>

          <div class="btns">
            <a
              href="tel:+911234567890"
              class="btn btn-outline-primary"
              aria-label="Call Now"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linejoin="round"
              >
                <path
                  d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z"
                />
              </svg>
            </a>

            <button
              data-model=".enquire-pop"
              class="btn btn-primary"
            >
              Enquire Now
            </button>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

      <!-- ================= GROUP OFFER BANNER ================= -->
<section class="group-offer-banner">
  <div class="container">
    <div class="group-offer-banner__inner">
      <div class="group-offer-banner__content">
        <span class="group-offer-banner__badge">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em">
            <path d="M0 0h24v24H0z" fill="none"/>
            <path fill="currentColor" d="M12 2l1.6 4.8L18 5l-1.8 4.4L21 12l-4.8 1.6L18 19l-4.4-1.8L12 22l-1.6-4.8L6 19l1.8-4.4L3 12l4.8-1.6L6 5l4.4 1.8z"/>
          </svg>
          Dubai Special Offer
        </span>

        <h3>Make Your Dubai Trip More Exciting & Save More</h3>

        <p>
          Enjoy special offers on Dubai activities, sightseeing, desert
          adventures, cruises and unforgettable experiences.
        </p>

        <ul class="group-offer-banner__perks">
          <li>Save on Selected Dubai Activities</li>
          <li>Special Deals on Popular Experiences</li>
          <li>Easy Booking & Flexible Travel Options</li>
        </ul>

        <div class="group-offer-banner__actions">
          <a href="#package-list" class="btn btn-white">
            View Offers
          </a>

          <a href="javascript:void()" data-model=".enquire-pop" class="btn btn-outline-white">
            Get A Quote
          </a>
        </div>
      </div>

      <div class="group-offer-banner__media">

        <div class="group-offer-banner__img group-offer-banner__img--secondary">
          <img
            loading="lazy"
            src="assets/images/listing/banner1.jpg"
            alt="Dubai travel and holiday experiences"
          />
        </div>

      </div>
    </div>
  </div>
</section>

      <!-- ============================= -->
      <!-- ACTIVITY PLANNING GUIDE -->
      <!-- ============================= -->
      <section class="activities-planning">
        <div class="container">
          <div class="planning-head">
            <span class="eyebrow">Plan Ahead</span>
            <h2>Plan Your Dubai Activities</h2>
          </div>

          <h3>Best Time for Dubai Activities</h3>
          <p>
            Outdoor experiences like desert safaris and water sports are most
            comfortable between November and March, when temperatures are
            cooler. Indoor attractions remain enjoyable year-round, including
            during the hot summer months.
          </p>

          <h3>Best Activities for Families</h3>
          <p>
            Families visiting Dubai often enjoy the Dubai Aquarium, theme parks,
            and a relaxed dhow cruise along the Marina. These experiences suit a
            range of ages and require little physical exertion.
          </p>

          <h3>Best Activities for Couples</h3>
          <p>
            Couples looking for a romantic experience tend to prefer a private
            yacht cruise, a dinner cruise along Dubai Marina, or an evening
            visit to the Burj Khalifa observation deck.
          </p>

          <h3>Adventure Activities in Dubai</h3>
          <ul>
            <li>Desert safari with dune bashing and a BBQ dinner</li>
            <li>Skydiving over Palm Jumeirah</li>
            <li>Jet skiing and other water sports along the coast</li>
          </ul>

          <h3>Indoor Activities in Dubai</h3>
          <p>
            On hotter days, the Dubai Aquarium, indoor theme parks, and shopping
            mall attractions offer a comfortable way to keep exploring the city.
          </p>

          <h3>What to Know Before Booking</h3>
          <p>
            Check pickup timings for desert safaris, dress modestly for cultural
            sites, and confirm whether hotel transfers are included with your
            chosen activity before you book.
          </p>
        </div>
      </section>

      <!-- ============================= -->
      <!-- WHY BOOK WITH US -->
      <!-- ============================= -->
      <section class="activities-benefits">
        <div class="container">
          <div class="heading">
            <h3>Why Book <span>With Us?</span></h3>
            <p>
              Enjoy trusted activities, great prices, easy booking, and reliable
              support throughout your Dubai holiday.
            </p>
          </div>

          <div class="activities-benefits-grid">
            <div class="benefit-item">
              <span class="benefit-icon" aria-hidden="true">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="28"
                  height="28"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.8"
                >
                  <path
                    d="M12 2l2.4 6.6L21 11l-6.6 2.4L12 20l-2.4-6.6L3 11l6.6-2.4z"
                  />
                </svg>
              </span>
              <h3>Handpicked Experiences</h3>
              <p>Carefully selected experiences from trusted providers.</p>
            </div>

            <div class="benefit-item">
              <span class="benefit-icon" aria-hidden="true">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="28"
                  height="28"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.8"
                >
                  <circle cx="12" cy="12" r="9" />
                  <path d="M12 7v5l3 3" />
                </svg>
              </span>
              <h3>Best Value</h3>
              <p>Competitive prices and selected destination offers.</p>
            </div>

            <div class="benefit-item">
              <span class="benefit-icon" aria-hidden="true">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="28"
                  height="28"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.8"
                >
                  <path d="M9 12l2 2 4-4" />
                  <circle cx="12" cy="12" r="9" />
                </svg>
              </span>
              <h3>Easy Enquiry</h3>
              <p>Quick and simple activity enquiry process.</p>
            </div>

            <div class="benefit-item">
              <span class="benefit-icon" aria-hidden="true">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="28"
                  height="28"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.8"
                >
                  <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9" />
                  <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                </svg>
              </span>
              <h3>Travel Support</h3>
              <p>Assistance from travel experts.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="categories-sec">
        <div class="container">
          <div class="heading">
            <h3>Popular Related <span>Destinations</span></h3>
            <p>
              Explore popular destinations near Dubai and discover more places,
              experiences and things to do for your next holiday.
            </p>
          </div>

          <div class="category-grid">
            <a
              href="attractions-detail.html"
              target="_blank"
              class="category_card"
            >
              <img
                loading="lazy"
                src="assets/images/blog/mount.jpg"
                alt="Vietnam"
              />
              <div class="content">
                <span class="pill">Vietnam</span>
                <p class="desc">
                  Discover stunning landscapes, vibrant cities, rich culture and
                  unforgettable travel experiences.
                </p>
              </div>
            </a>

            <a
              href="attractions-detail.html"
              target="_blank"
              class="category_card"
            >
              <img
                loading="lazy"
                src="assets/images/blog/beach.jpg"
                alt="Malaysia"
              />
              <div class="content">
                <span class="pill">Malaysia</span>
                <p class="desc">
                  Explore modern cities, tropical escapes, cultural attractions
                  and exciting things to do across Malaysia.
                </p>
              </div>
            </a>

            <a
              href="attractions-detail.html"
              target="_blank"
              class="category_card"
            >
              <img
                loading="lazy"
                src="assets/images/blog/histroical.avif"
                alt="Thailand"
              />
              <div class="content">
                <span class="pill">Thailand</span>
                <p class="desc">
                  Experience beautiful beaches, lively cities, island adventures
                  and Thailand's vibrant local culture.
                </p>
              </div>
            </a>

            <a
              href="attractions-detail.html"
              target="_blank"
              class="category_card"
            >
              <img
                loading="lazy"
                src="assets/images/blog/wild.avif"
                alt="Singapore"
              />
              <div class="content">
                <span class="pill">Singapore</span>
                <p class="desc">
                  Discover iconic landmarks, family attractions, modern
                  architecture and exciting city experiences.
                </p>
              </div>
            </a>

            <a
              href="attractions-detail.html"
              target="_blank"
              class="category_card"
            >
              <img
                loading="lazy"
                src="assets/images/blog/travel.avif"
                alt="Bangkok"
              />
              <div class="content">
                <span class="pill">Bangkok</span>
                <p class="desc">
                  Explore grand temples, bustling markets, local cuisine and the
                  vibrant streets of Bangkok.
                </p>
              </div>
            </a>

            <a
              href="attractions-detail.html"
              target="_blank"
              class="category_card"
            >
              <img
                loading="lazy"
                src="assets/images/blog/culture.avif"
                alt="Pattaya"
              />
              <div class="content">
                <span class="pill">Pattaya</span>
                <p class="desc">
                  Enjoy beautiful beaches, island trips, entertainment and
                  exciting activities in Pattaya.
                </p>
              </div>
            </a>
          </div>
        </div>
      </section>

     

      <!-- ============================= -->
      <!-- SEO INTERNAL LINKING (existing, untouched) -->
      <!-- ============================= -->
      <section class="seo-links-sec">
        <div class="container">
          <div class="heading">
            <h3>Explore More <span>About Dubai</span></h3>
            <p>
              Discover popular Dubai tours, activities, places to visit and
              experiences to make your journey unforgettable.
            </p>
          </div>

          <div class="seo-links-wrapper">
            <div class="seo-link-block">
              <h4>Popular Dubai Tours</h4>
              <div class="seo-link-wrap">
                <a href="/dubai/tour-packages/">Dubai Tour Packages</a>
                <a href="/dubai/family-packages/">Dubai Family Packages</a>
                <a href="/dubai/honeymoon-packages/"
                  >Dubai Honeymoon Packages</a
                >
                <a href="/dubai/luxury-tours/">Dubai Luxury Tours</a>
                <a href="/dubai/group-tours/">Dubai Group Tours</a>
              </div>
            </div>

            <div class="seo-link-block">
              <h4>Things to Do in Dubai</h4>
              <div class="seo-link-wrap">
                <a href="/dubai/places-to-visit/">Places to Visit in Dubai</a>
                <a href="/dubai/best-time-to-visit/"
                  >Best Time to Visit Dubai</a
                >
                <a href="/dubai/travel-guide/">Dubai Travel Guide</a>
                <a href="/dubai/things-to-do/">Things to Do in Dubai</a>
                <a href="/dubai/city-tour/">Dubai City Tour</a>
              </div>
            </div>

            <div class="seo-link-block">
              <h4>Popular Dubai Activities</h4>
              <div class="seo-link-wrap">
                <a href="/dubai/activities/desert-safari/"
                  >Dubai Desert Safari</a
                >
                <a href="/dubai/activities/marina-cruise/"
                  >Dubai Marina Cruise</a
                >
                <a href="/dubai/activities/water-sports/">Dubai Water Sports</a>
                <a href="/dubai/activities/yacht-tour/">Dubai Yacht Tour</a>
                <a href="/dubai/activities/theme-parks/">Dubai Theme Parks</a>
              </div>
            </div>

            <div class="seo-link-block">
              <h4>Dubai Tour Packages From Popular Cities</h4>
              <div class="seo-link-wrap">
                <a href="/dubai/tour-packages/from-delhi/"
                  >Dubai Tour Packages From Delhi</a
                >
                <a href="/dubai/tour-packages/from-mumbai/"
                  >Dubai Tour Packages From Mumbai</a
                >
                <a href="/dubai/tour-packages/from-bangalore/"
                  >Dubai Tour Packages From Bangalore</a
                >
                <a href="/dubai/tour-packages/from-ahmedabad/"
                  >Dubai Tour Packages From Ahmedabad</a
                >
                <a href="/dubai/tour-packages/from-hyderabad/"
                  >Dubai Tour Packages From Hyderabad</a
                >
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ============================= -->
      <!-- FINAL CTA -->
      <!-- ============================= -->
      <section class="activities-cta">
        <div class="container">
          <h2>Ready to Experience Dubai?</h2>
          <p>
            Tell us what you want to experience in Dubai and our travel experts
            will help you choose the right activity.
          </p>

          <div class="activities-cta-actions">
            <a href="javascript:void(0)" class="btn btn-white">
              Talk to a Travel Expert
              <i class="icon-arrow"></i>
            </a>
            <a href="/dubai/tours/" class="btn btn-outline"
              >Explore Dubai Tours</a
            >
          </div>
        </div>
      </section>
    </main>

    @endsection