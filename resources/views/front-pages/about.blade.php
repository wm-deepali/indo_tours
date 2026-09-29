@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/about/about.css') }}" />
@endpush

@section('content')
    <main>
        <section class="banner">
            <div class="bg">
                <video autoplay muted loop playsinline class="bg-video"
                    src="{{ $content->banner_video ? asset('storage/' . $content->banner_video) : asset('assets/video/trip.mp4') }}"
                    poster="{{ $content->banner_video_poster ? asset('storage/' . $content->banner_video_poster) : asset('assets/video/poster/trip.png') }}">
                    <source src="{{ $content->banner_video ? asset('storage/' . $content->banner_video) : asset('assets/video/home-banner.mp4') }}" type="video/mp4" />
                </video>
                <nav class="breadcrumb left breadcrumb-light" aria-label="Breadcrumb">
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span class="breadcrumb-separator">/</span></li>
                        <li><a href="{{ url('/about') }}" class="active">About Us</a></li>
                    </ul>
                </nav>
                <div class="container">
                    <div class="banner-wrapper">
                        <div class="content">
                            <h1>{{ $content->banner_heading }}</h1>
                            <p>{{ $content->banner_description }}</p>
                            @if ($content->banner_cta_text)
                                <a href="{{ $content->banner_cta_url ?: 'javascript:void(0)' }}" class="btn btn-primary">
                                    {{ $content->banner_cta_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ WHO WE ARE ============ -->
        <section class="about-secA">
            <div class="container">
                <div class="heading">
                    <h3>{{ $content->who_we_are_heading }}</h3>
                    <p>{{ $content->who_we_are_description }}</p>
                </div>
                <div class="stats-layout">
                    <div class="stats-grid">
                        @foreach ($content->stats ?? [] as $stat)
                            <div class="stat-card">
                                <span class="stat-card__icon">
                                    @if (!empty($stat['icon']))
                                        <img src="{{ asset('storage/' . $stat['icon']) }}" alt="{{ $stat['label'] }}" style="width:24px;height:24px;">
                                    @else
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <circle cx="12" cy="12" r="9" />
                                        </svg>
                                    @endif
                                </span>
                                <h3 class="stat-card__number" data-count="{{ $stat['count'] }}" data-suffix="{{ $stat['suffix'] }}">0</h3>
                                <p class="stat-card__label">{{ $stat['label'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="content-card">
                        <div class="content-card__text">
                            <h5>{{ $content->content_card_title }}</h5>
                            <p>{{ $content->content_card_description_1 }}</p>
                            <p>{{ $content->content_card_description_2 }}</p>
                            @if ($content->content_card_cta_text)
                                <a href="{{ $content->content_card_cta_url ?: '#' }}" class="btn btn-primary">
                                    {{ $content->content_card_cta_text }}
                                </a>
                            @endif
                        </div>

                        <div class="content-card__image">
                            <img loading="lazy"
                                src="{{ $content->content_card_image ? asset('storage/' . $content->content_card_image) : asset('assets/images/about/about-img.png') }}"
                                alt="{{ $content->content_card_title }}" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ WHY CHOOSE US ============ -->
        <section class="about-secB">
            <div class="container">
                <div class="heading">
                    <h3>{{ $content->why_choose_heading }}</h3>
                    <p>{{ $content->why_choose_description }}</p>
                </div>

                <div class="grid">
                    @foreach ($content->why_choose_items ?? [] as $item)
                        <div class="item">
                            <div class="icon">
                                @if (!empty($item['icon']))
                                    <img src="{{ asset('storage/' . $item['icon']) }}" alt="{{ $item['title'] }}" style="width:26px;height:26px;">
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="12" r="9" />
                                    </svg>
                                @endif
                            </div>
                            <h4>{{ $item['title'] }}</h4>
                            <p>{{ $item['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ============ OUR MISSION ============ -->
        <section class="about-secC">
            <div class="container">
                <div class="grid">
                    <div class="img">
                        <div class="img__item img__item--one">
                            <img loading="lazy"
                                src="{{ $content->mission_image_one ? asset('storage/' . $content->mission_image_one) : asset('assets/images/about/misson.webp') }}"
                                alt="{{ $content->mission_heading }}" />
                        </div>
                        <div class="img__item img__item--two">
                            <img loading="lazy"
                                src="{{ $content->mission_image_two ? asset('storage/' . $content->mission_image_two) : asset('assets/images/about/misson.webp') }}"
                                alt="{{ $content->mission_heading }}" />
                        </div>
                    </div>

                    <div class="content">
                        <div class="heading">
                            <h3>{{ $content->mission_heading }}</h3>
                            <p>{{ $content->mission_description }}</p>
                        </div>

                        <div class="features">
                            @foreach ($content->mission_features ?? [] as $feature)
                                <div class="feature">
                                    <span class="feature__icon">
                                        @if (!empty($feature['icon']))
                                            <img src="{{ asset('storage/' . $feature['icon']) }}" alt="{{ $feature['title'] }}" style="width:22px;height:22px;">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <circle cx="12" cy="12" r="9" />
                                            </svg>
                                        @endif
                                    </span>
                                    <div class="feature__text">
                                        <h4>{{ $feature['title'] }}</h4>
                                        <p>{{ $feature['description'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($content->mission_cta_text)
                            <a href="{{ $content->mission_cta_url ?: '#' }}" class="btn btn-primary">{{ $content->mission_cta_text }}</a>
                        @endif
                    </div>
                </div>

                <div class="plane">
                    <img loading="lazy" src="{{ asset('assets/images/about/plane-2.svg') }}" alt="" aria-hidden="true" />
                </div>
            </div>
        </section>

        <!-- ============ HOW IT WORKS ============ -->
        <section class="about-secE">
            <div class="container">
                <div class="heading">
                    <h3>{{ $content->how_it_works_heading }}</h3>
                    <p>{{ $content->how_it_works_description }}</p>
                </div>

                <div class="steps">
                    @foreach ($content->how_it_works_steps ?? [] as $i => $step)
                        <div class="step step--{{ $step['color'] }}">
                            <span class="step__number">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <h4>{{ $step['title'] }}</h4>
                            <p>{{ $step['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ============ OUR PHILOSOPHY ============ -->
        <section class="about-secD">
            <div class="bg">
                <img loading="lazy"
                    src="{{ $content->philosophy_image ? asset('storage/' . $content->philosophy_image) : asset('assets/images/about/philosophy.jpg') }}"
                    alt="{{ $content->philosophy_heading }}" />
            </div>

            <div class="overlay"></div>

            <div class="container">
                <div class="content">
                    <span class="eyebrow">{{ $content->philosophy_eyebrow }}</span>
                    <div class="heading">
                        <h3>
                            {{ $content->philosophy_heading }}<br /><span>{{ $content->philosophy_heading_highlight }}</span>
                        </h3>
                        <p>{{ $content->philosophy_description }}</p>
                    </div>
                    @if ($content->philosophy_cta_text)
                        <a href="{{ $content->philosophy_cta_url ?: '#' }}" class="btn btn-primary">{{ $content->philosophy_cta_text }}</a>
                    @endif
                </div>
            </div>
        </section>

        <!-- ============ MEET THE TEAM ============ -->
        <section class="about-secF">
            <div class="container">
                <div class="heading">
                    <h3>{{ $content->team_heading }}</h3>
                    <p>{{ $content->team_description }}</p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper fourSilder">
                        <div class="swiper-wrapper">
                            @foreach ($content->team_members ?? [] as $member)
                                <div class="swiper-slide">
                                    <div class="team_card">
                                        <div class="img">
                                            <img loading="lazy"
                                                src="{{ !empty($member['image']) ? asset('storage/' . $member['image']) : asset('assets/images/about/team1.jpg') }}"
                                                alt="{{ $member['name'] }}" />
                                        </div>
                                        <div class="socials">
                                            @if (!empty($member['instagram_url']))
                                                <a href="{{ $member['instagram_url'] }}" aria-label="Instagram" target="_blank" rel="noopener">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                                        <rect x="3" y="3" width="18" height="18" rx="5" />
                                                        <circle cx="12" cy="12" r="4" />
                                                        <circle cx="17.2" cy="6.8" r="1" />
                                                    </svg>
                                                </a>
                                            @endif
                                            @if (!empty($member['linkedin_url']))
                                                <a href="{{ $member['linkedin_url'] }}" aria-label="LinkedIn" target="_blank" rel="noopener">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                                        <rect x="3" y="3" width="18" height="18" rx="3" />
                                                        <path d="M8 10v7M8 7v.01M12 17v-4.5a2 2 0 0 1 4 0V17" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <h4>{{ $member['name'] }}</h4>
                                            <p>{{ $member['role'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

        <!-- ============ CLIENTS FEEDBACK (Testimonials) ============ -->
        <section class="about-secI">
            <div class="container">
                <div class="heading">
                    <h3>{{ $content->testimonials_heading }}</h3>
                    <p>{{ $content->testimonials_description }}</p>
                </div>

                <div class="swiper TestimonialSlider">
                    <div class="swiper-wrapper">
                        @forelse ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="card">
                                    <div class="header">
                                        <img loading="lazy"
                                            src="{{ $testimonial->image ? asset('storage/' . $testimonial->image) : asset('assets/images/home/client1.png') }}"
                                            alt="{{ $testimonial->name }}" />
                                        <div class="name">
                                            <h6>{{ $testimonial->name }}</h6>
                                            <p>{{ $testimonial->designation }}</p>
                                        </div>
                                        <div class="quotes">
                                            <svg width="34" height="26" viewBox="0 0 44 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.98462 0.5H17.7346C18.1656 0.5 18.5793 0.670839 18.884 0.975586C19.1888 1.28033 19.3596 1.69402 19.3596 2.125V19.1748L19.3635 19.1973C19.3641 19.2053 19.3657 19.216 19.3665 19.2295C19.3688 19.2693 19.3712 19.3295 19.3733 19.4082C19.3775 19.5654 19.3794 19.795 19.3684 20.084C19.3464 20.6625 19.2751 21.4755 19.0823 22.4189C18.6962 24.3078 17.8253 26.6999 15.8987 28.79C13.0414 31.8876 8.68419 33.5 2.85962 33.5H1.23462V28.417L2.53833 28.1582H2.53931C5.54333 27.5578 7.72977 26.3475 8.91138 24.4844L8.91431 24.4785C9.51092 23.5111 9.85011 22.407 9.89966 21.2715L9.9231 20.75H2.85962C2.42864 20.75 2.01495 20.5792 1.71021 20.2744C1.40546 19.9697 1.23462 19.556 1.23462 19.125V4.25C1.23462 2.18227 2.91689 0.5 4.98462 0.5ZM28.3743 0.5H41.1243C41.5552 0.5 41.9689 0.670911 42.2737 0.975586C42.5784 1.28033 42.7493 1.69402 42.7493 2.125V19.1748L42.7532 19.1973C42.7538 19.2053 42.7553 19.2161 42.7561 19.2295C42.7584 19.2693 42.7609 19.3296 42.7629 19.4082C42.7671 19.5654 42.7691 19.7951 42.7581 20.084C42.7359 20.6625 42.6639 21.4755 42.4709 22.4189C42.0846 24.3078 41.214 26.6999 39.2883 28.79C36.431 31.8876 32.0738 33.5 26.2493 33.5H24.6243V28.417L25.929 28.1582C28.9331 27.5578 31.1194 26.3475 32.301 24.4844L32.304 24.4785C32.9006 23.5111 33.2398 22.407 33.2893 21.2715L33.3127 20.75H26.2493C25.8185 20.7499 25.4055 20.5789 25.1008 20.2744C24.7961 19.9697 24.6243 19.556 24.6243 19.125V4.25C24.6243 2.18234 26.3066 0.500123 28.3743 0.5Z"
                                                    fill="white" stroke="#D1D1D1" />
                                            </svg>
                                        </div>
                                    </div>

                                    <p class="quote">“{{ $testimonial->quote }}”</p>

                                    <div class="stars">
                                        @for ($i = 1; $i <= $testimonial->rating; $i++)
                                            <svg viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @empty
                            {{-- no testimonials yet; section renders empty rather than breaking the slider --}}
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ MOMENTS FROM THE JOURNEY ============ -->
        <section class="about-secG">
            <div class="container">
                <div class="heading">
                    <h3>{{ $content->gallery_heading }}</h3>
                    <p>{{ $content->gallery_description }}</p>
                </div>

                <div class="swiper-wrap">
                    <div class="swiper thirdSilder">
                        <div class="swiper-wrapper">
                            @foreach ($content->gallery_items ?? [] as $item)
                                <div class="swiper-slide">
                                    <div class="gallery_img">
                                        <img loading="lazy"
                                            src="{{ !empty($item['image']) ? asset('storage/' . $item['image']) : asset('assets/images/home/card4.jpg') }}"
                                            alt="{{ $item['title'] }}" />
                                        <div class="content">
                                            <h6>{{ $item['title'] }}</h6>
                                            <span>{{ $item['location'] }}</span>
                                        </div>
                                    </div>
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

        <!-- ============ AWARDS AND RECOGNITION ============ -->
        <!-- <section class="about-secH">
            <div class="container">
                <div class="heading">
                    <h3>Awards and <span>Recognition</span></h3>
                </div>

                <div class="swiper logoSlider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img loading="lazy" src="{{ asset('assets/images/home/logos/logo1.png') }}" alt="" /></div>
                        <div class="swiper-slide"><img loading="lazy" src="{{ asset('assets/images/home/logos/logo2.png') }}" alt="" /></div>
                        <div class="swiper-slide"><img loading="lazy" src="{{ asset('assets/images/home/logos/logo3.png') }}" alt="" /></div>
                        <div class="swiper-slide"><img loading="lazy" src="{{ asset('assets/images/home/logos/logo4.png') }}" alt="" /></div>
                        <div class="swiper-slide"><img loading="lazy" src="{{ asset('assets/images/home/logos/logo1.png') }}" alt="" /></div>
                        <div class="swiper-slide"><img loading="lazy" src="{{ asset('assets/images/home/logos/logo2.png') }}" alt="" /></div>
                        <div class="swiper-slide"><img loading="lazy" src="{{ asset('assets/images/home/logos/logo3.png') }}" alt="" /></div>
                        <div class="swiper-slide"><img loading="lazy" src="{{ asset('assets/images/home/logos/logo4.png') }}" alt="" /></div>
                        <div class="swiper-slide"><img loading="lazy" src="{{ asset('assets/images/home/logos/logo3.png') }}" alt="" /></div>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- ============ FAQs ============ -->
        <section class="about-secJ">
            <div class="container">
                <div class="heading">
                    <h3>{{ $content->faq_heading }}</h3>
                </div>

                <div class="accordion-wrapper">
                    @foreach ($content->faqs ?? [] as $i => $faq)
                        <div class="accordion-item">
                            <div class="accordion-body">
                                <div class="accordion-header {{ $i === 0 ? 'active' : '' }}">
                                    <h4>{{ $faq['question'] }}</h4>
                                    <span class="accordion-icon">{{ $i === 0 ? '−' : '+' }}</span>
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
    </main>
@endsection