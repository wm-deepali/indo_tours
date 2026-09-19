@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/other/other.css') }}" />
@endpush

@section('content')

  <main>
      <section class="comman-banner">
        <img loading="lazy" src="{{ asset('assets/images/about/Philosophy.jpg') }}" alt="" />

        <div class="container">
          <div class="bg-wrapper">
            <div class="heading">
              <h1>{{ $heading ?? 'Thank You!' }}</h1>

              <p>
                {{ $message ?? "Thank you for reaching out to IND Tour Adventure. We've received your enquiry and our travel expert will get in touch with you shortly." }}
              </p>

              <a href="{{ route('home') }}" class="btn btn-primary bt"> Back To Home </a>
            </div>
          </div>
        </div>
      </section>
    </main>

@endsection