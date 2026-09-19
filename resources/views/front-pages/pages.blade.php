@extends('layouts.app')

@section('title', $page->meta_title ?: $page->title . ' | Indo Tours & Adventures')
@section('meta_description', $page->meta_description ?: Str::limit(strip_tags($page->content), 160))
@section('canonical', $page->canonical_url ?: url()->current())
@section('robots', $page->robots ?: 'index, follow')

@section('og_title', $page->og_title ?: $page->meta_title ?: $page->title)
@section('og_description', $page->og_description ?: $page->meta_description ?: Str::limit(strip_tags($page->content), 160))
@section('og_image', $page->og_image ? asset('storage/' . $page->og_image) : asset('assets/images/default-og.jpg'))

@section('twitter_title', $page->og_title ?: $page->meta_title ?: $page->title)
@section('twitter_description', $page->og_description ?: $page->meta_description ?: Str::limit(strip_tags($page->content), 160))
@section('twitter_image', $page->twitter_card_image ? asset('storage/' . $page->twitter_card_image) : asset('assets/images/default-og.jpg'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sass/other/other.css') }}" />
@endpush

@section('content')

    <main>
        <section class="privacy-secA">
            <div class="container">
                <nav class="breadcrumb left breadcrumb-dark" aria-label="Breadcrumb">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>

                        <li>
                            <span class="breadcrumb-separator">/</span>
                        </li>

                        <li>
                            <a href="{{ route('pages.show', $page) }}" class="active">{{ $page->title }}</a>
                        </li>
                    </ul>
                </nav>
                <div class="website-content">
                    <h1 class="heading">{{ $page->h1 ?: $page->title }}</h1>

                    <p><strong>Last updated:</strong> {{ $page->updated_at->format('F j, Y') }}</p>

                    {!! $page->content !!}
                </div>
            </div>
        </section>
    </main>

@endsection