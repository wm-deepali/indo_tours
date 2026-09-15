{{-- resources/views/front-pages/partials/tour-package-card.blade.php --}}
<div class="package_card">
    <a href="{{ route('tourpackage.show', $package->slug) }}" target="_blank" class="img">
        @if($package->main_image)
            <img loading="lazy" src="{{ asset('storage/' . $package->main_image) }}" alt="{{ $package->name }}" />
        @else
            <img loading="lazy" src="{{ asset('assets/images/blog/default.jpg') }}" alt="{{ $package->name }}" />
        @endif

        @if($package->banner_tag_text)
            <span class="badge">{{ $package->banner_tag_text }}</span>
        @endif

        @if($package->duration_text)
            <span class="duration-badge">{{ $package->duration_text }}</span>
        @endif
    </a>

    <div class="content">
        <p class="dest-tag">{{ $package->location_text }}</p>

        @if($package->reviews_count > 0)
            <div class="rating">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                </svg>
                {{ number_format($package->reviews_avg_rating, 1) }} <span>({{ $package->reviews_count }} reviews)</span>
            </div>
        @endif

        <h5><a href="{{ route('tourpackage.show', $package->slug) }}" target="_blank">{{ $package->name }}</a></h5>

        @if($package->banner_intro)
            <p class="desc">{{ $package->banner_intro }}</p>
        @endif

        <div class="foot">
            <p class="price">
                <small>From</small>
                @if($package->price)
                    ₹{{ number_format($package->price) }}{{ $package->price_unit_text ? ' ' . $package->price_unit_text : '' }}
                @else
                    Price on request
                @endif
            </p>
            <button data-model=".enquire-pop" class="btn btn-outline-primary" data-package-id="{{ $package->id }}">
                Enquire Now
            </button>
        </div>
    </div>
</div>