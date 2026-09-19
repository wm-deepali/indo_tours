@extends('layouts.app')

@section('title', ($contactPage->banner_heading ?? 'Contact Us') . ' | Indo Tours & Adventures')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/contact/contact.css') }}" />
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
                            <a href="{{ route('contact.us') }}" class="active">Contact Us</a>
                        </li>
                    </ul>
                </nav>
                <img loading="lazy"
                    src="{{ $contactPage && $contactPage->banner_image ? asset('storage/' . $contactPage->banner_image) : asset('assets/images/contact/banner.avif') }}" />
                <div class="container">
                    <div class="banner-wrapper">
                        <div class="content">
                            <h1>{{ $contactPage->banner_heading ?? 'Travel With Us' }}</h1>
                            <p>
                                {{ $contactPage->banner_description ?? "Have a question or need help planning your trip? Get in touch with our travel experts and let's create a journey made just for you." }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-secA">
            <div class="container">
                <div class="grid">
                    <!-- Left: form -->
                    <div class="form_wrapper">
                        <h3>Email us</h3>

                        @if(session('contact_success'))
                            <div class="alert alert-success" style="margin-bottom:16px;">{{ session('contact_success') }}</div>
                        @endif

                        <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                            @csrf

                            <div class="field-row">
                                <div class="field">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.6">
                                        <circle cx="12" cy="8" r="3.2" />
                                        <path d="M5 20c1-4 4-6 7-6s6 2 7 6" stroke-linecap="round" />
                                    </svg>
                                    <input type="text" name="first_name" placeholder=" "
                                        class="field__input has-icon @error('first_name') is-invalid @enderror"
                                        value="{{ old('first_name') }}" required />
                                    <label class="field__label">First name<span>*</span></label>
                                    @error('first_name')
                                    <div class="form-error">{{ $message }}</div>@enderror
                                </div>

                                <div class="field">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.6">
                                        <circle cx="12" cy="8" r="3.2" />
                                        <path d="M5 20c1-4 4-6 7-6s6 2 7 6" stroke-linecap="round" />
                                    </svg>
                                    <input type="text" name="last_name" placeholder=" "
                                        class="field__input has-icon @error('last_name') is-invalid @enderror"
                                        value="{{ old('last_name') }}" required />
                                    <label class="field__label">Last name<span>*</span></label>
                                    @error('last_name')
                                    <div class="form-error">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="field-row">
                                <div class="field">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.6">
                                        <rect x="3" y="5" width="18" height="14" rx="2" />
                                        <path d="M4 6.5l8 6 8-6" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <input type="email" name="email" placeholder=" "
                                        class="field__input has-icon @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required />
                                    <label class="field__label">Email<span>*</span></label>
                                    @error('email')
                                    <div class="form-error">{{ $message }}</div>@enderror
                                </div>

                                <div class="field-row field-row--phone">
                                    <div class="code-select">
                                        +91 <i class="fas fa-chevron-down"></i>
                                    </div>
                                    <div class="field" style="margin-bottom: 0">
                                        <input type="tel" name="phone" placeholder=" "
                                            class="field__input @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}" required />
                                        <label class="field__label">Phone<span>*</span></label>
                                        @error('phone')
                                        <div class="form-error">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="field field--textarea">
                                <textarea name="message" placeholder=" "
                                    class="field__input @error('message') is-invalid @enderror" rows="5"
                                    required>{{ old('message') }}</textarea>
                                <label class="field__label">How can we help?<span>*</span></label>
                                @error('message')
                                <div class="form-error">{{ $message }}</div>@enderror
                            </div>

                            <label class="checkbox_field">
                                <input type="checkbox" name="newsletter" value="1" {{ old('newsletter') ? 'checked' : '' }} />
                                <span class="box"></span>
                                <span class="text">
                                    <strong>Watermark E-newsletter</strong>
                                    Yes please, sign me up for emails, updates, special offers,
                                    and the latest insider information from all our
                                    destinations.
                                </span>
                            </label>

                            <button type="submit" class="btn-primary smt">Submit</button>
                        </form>
                    </div>

                    <!-- Right: details -->
                    <div class="detail-grid">
                        <div class="detail_card">
                            <h4>{{ $contactPage->touch_heading ?? 'Get in touch' }}</h4>
                            <p>
                                {{ $contactPage->touch_description ?? 'We love to chat about your travel plans and are happy to talk if you have any questions.' }}
                            </p>

                            <ul class="contact_list">
                                @if(!empty($contactPage->phone))
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.6">
                                            <path d="M4 5c0 8.5 6.5 15 15 15l2-4-5-3-2 2c-2-1-4-3-5-5l2-2-3-5z"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <a
                                            href="tel:{{ preg_replace('/[^0-9+]/', '', $contactPage->phone) }}">{{ $contactPage->phone }}</a>
                                    </li>
                                @endif
                                @if(!empty($contactPage->email))
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.6">
                                            <rect x="3" y="5" width="18" height="14" rx="2" />
                                            <path d="M4 6.5l8 6 8-6" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <a href="mailto:{{ $contactPage->email }}">{{ $contactPage->email }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        @if(!empty($contactPage->opening_hours))
                            <div class="detail_card">
                                <h4>Opening hours</h4>

                                @foreach($contactPage->opening_hours as $block)
                                    <div class="hours_block">
                                        <span class="range">{{ $block['range'] ?? '' }}</span>
                                        <p>{!! nl2br(e($block['text'] ?? '')) !!}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if(!empty($contactPage->offices))
                            @foreach($contactPage->offices as $office)
                                <div class="detail_card">
                                    <h4>{{ $office['heading'] ?? 'Office' }}</h4>
                                    <p>{{ $office['address'] ?? '' }}</p>
                                    @if(!empty($office['map_url']))
                                        <a href="{{ $office['map_url'] }}" target="_blank" class="btn btn-outline-primary">View on
                                            Google maps</a>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @if(!empty($contactPage->offices))
            @foreach($contactPage->offices as $office)
                @if(!empty($office['map_embed_url']))
                    <div class="map">
                        <div class="container">
                            <div class="map_wrap">
                                <iframe src="{{ $office['map_embed_url'] }}" width="100%" height="450" style="border: 0"
                                    allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif

        @if(!empty($contactPage->faqs))
            <section class="contact-secB">
                <div class="container">
                    <div class="heading">
                        <h3>{{ $contactPage->faqs_heading ?? "Have Questions? We're Here to Help." }}</h3>
                    </div>

                    <div class="accordion-wrapper">
                        @foreach($contactPage->faqs as $faq)
                            <div class="accordion-item">
                                <div class="accordion-body">
                                    <div class="accordion-header @if($loop->first) active @endif">
                                        <h4>{{ $faq['question'] ?? '' }}</h4>
                                        <span class="accordion-icon">{{ $loop->first ? '−' : '+' }}</span>
                                    </div>

                                    <div class="accordion-content">
                                        <p>{{ $faq['answer'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- APP DOWNLOAD / NEWSLETTER BANNER -->
        <section class="app-promo">
            <div class="container">
                <div class="app-promo-inner">
                    <div class="app-promo-text">
                        <span class="eyebrow">{{ $contactPage->promo_eyebrow ?? 'Stay Updated' }}</span>
                        <h3>{!! nl2br(e($contactPage->promo_heading ?? "Ready to Start \nYour Journey?")) !!}</h3>
                        <p>
                            {{ $contactPage->promo_description ?? "Tell us where you want to go, and we'll help you plan the rest." }}
                        </p>

                        <div class="form form-grid">
                            <div class="form-group">
                                <input name="txtJoinNowEmail" type="email" placeholder=" " class="form-control" required />
                                <label for="txtJoinNowEmail">Enter your email address</label>
                            </div>
                            <a href="javascript:void(0)" class="sbmt btn btn-white">
                                Join Now
                                <svg viewBox="0 0 24 24" fill="none">
                                    <path d="M5 12h14m0 0-6-6m6 6-6 6" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="app-promo-visual">
                        <div class="phone phone--back">
                            <img loading="lazy"
                                src="{{ $contactPage && $contactPage->promo_image ? asset('storage/' . $contactPage->promo_image) : asset('assets/images/home/mobile.png') }}"
                                alt="App preview" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection