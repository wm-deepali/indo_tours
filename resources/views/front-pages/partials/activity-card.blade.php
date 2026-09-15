@php
    $bestPackage = $activity->packages->firstWhere('is_recommended', true) ?? $activity->packages->first();
    $oldPrice = $bestPackage->old_price ?? null;
    $newPrice = $bestPackage->new_price ?? $activity->starting_price;
    $saveAmount = ($oldPrice && $newPrice) ? ($oldPrice - $newPrice) : null;
@endphp

<div class="trip_card">
    <a href="{{ route('activities.show', $activity->slug) }}" target="_blank" class="img">
        @if($activity->main_image)
            <img loading="lazy" src="{{ asset('storage/' . $activity->main_image) }}" alt="{{ $activity->name }}" />
        @else
            <img loading="lazy" src="{{ asset('assets/images/blog/dubai.jpg') }}" alt="{{ $activity->name }}" />
        @endif

        @if($saveAmount && $saveAmount > 0)
            <span class="save">Save INR {{ number_format($saveAmount) }}</span>
        @endif
    </a>

    <div class="content">
        <div class="rating">
            <span>{{ $activity->duration_text ?? '—' }}</span>

            @if($activity->rating)
                <div class="star">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                    </svg>
                    <span>{{ $activity->rating }}</span>
                    @if($activity->review_count)
                        <em>({{ $activity->review_count }})</em>
                    @endif
                </div>
            @endif
        </div>

        <h3>
            <a href="{{ route('activities.show', $activity->slug) }}" target="_blank">
                {{ $activity->name }}
            </a>
        </h3>

        @if($oldPrice && $saveAmount && $saveAmount > 0)
            <div class="innerSave">
                <s>INR {{ number_format($oldPrice) }}</s>
                <span class="saveChip">Save INR {{ number_format($saveAmount) }}</span>
            </div>
        @endif

        <p class="price">
            @if($newPrice)
                INR {{ number_format($newPrice) }}
            @else
                Price on request
            @endif
        </p>

        <div class="btns">
            <a href="tel:+910000000000" class="btn btn-outline-primary" aria-label="Call Now">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.5" stroke-linejoin="round">
                    <path
                        d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                </svg>
            </a>

            <button data-model=".enquire-pop" class="btn btn-primary" data-activity-id="{{ $activity->id }}">
                Enquire Now
            </button>
        </div>
    </div>
</div>