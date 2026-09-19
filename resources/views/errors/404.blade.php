@extends('layouts.app')

@section('title', 'Error | Indo Tours & Adventures')

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
            <h1>Oops… 404</h1>

            <p>
              Looks like this page has taken a little detour. The travel
              destination you're looking for could not be found.
            </p>

            <a href="/" class="btn btn-primary bt"> Back To Home </a>
          </div>
        </div>
      </div>
      </div>
    </section>
  </main>

@endsection