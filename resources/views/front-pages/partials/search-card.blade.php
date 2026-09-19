{{-- resources/views/front-pages/partials/search-card.blade.php --}}
@php
    $isTour = $type === 'tour';

    $image = $item->main_image
        ? asset('storage/' . $item->main_image)
        : asset('assets/images/blog/dubai.jpg');

    if ($isTour) {
        $detailUrl = url('/tour-package/' . $item->slug);
        $location  = collect([$item->city?->name, $item->state?->name, $item->country?->name])->filter()->implode(', ');
        $duration  = $item->duration_days . ' Days' . ($item->duration_nights > 0 ? ' & ' . $item->duration_nights . ' Nights' : '');
        $highlights = $item->highlights->pluck('text')->take(4);
        $category  = $item->subCategory?->name;

        $stays = $item->hotelStays;
        $star  = $stays->map(fn($s) => $s->hotel?->star_rating)->filter()->max();

        $b = $stays->contains('breakfast_included', true);
        $l = $stays->contains('lunch_included', true);
        $d = $stays->contains('dinner_included', true);
        $meals = ($b && $l && $d) ? 'All Meals'
            : (($b && $d) ? 'Breakfast + Dinner'
            : ($b ? 'Breakfast Included' : null));

        $oldPrice = $item->old_price;
        $price    = $item->price;
        $unit     = $item->price_unit_text ?: 'Per Person';
        $rating   = $item->rating;
        $reviews  = $item->review_count;
        $badge    = $item->featured ? ['Featured', ''] : (($oldPrice && $price && $oldPrice > $price) ? ['Special Offer', 'badge-offer'] : null);
    } else {
        $detailUrl = url('/activity/' . $item->slug);   // <-- change if your activity detail route differs
        $location  = $item->location_label ?: collect([$item->city?->name, $item->country?->name])->filter()->implode(', ');
        $duration  = $item->duration_text;
        $highlights = collect($item->highlights ?? [])->take(4);
        $category  = $item->category?->name;

        $star = null;
        $meals = null;

        $oldPrice = null;
        $price    = $item->starting_price;
        $unit     = $item->price_unit ?: 'Per Person';
        $rating   = $item->rating;
        $reviews  = $item->review_count;
        $badge    = $item->featured ? ['Featured', ''] : null;
    }

    $save = ($oldPrice && $price && $oldPrice > $price) ? $oldPrice - $price : null;
@endphp

<article class="trip-card">
    <a href="{{ $detailUrl }}" class="trip-card__media">
        <img loading="lazy" src="{{ $image }}" alt="{{ $item->name }}" />
        @if($badge)
            <span class="badge {{ $badge[1] }}">{{ $badge[0] }}</span>
        @endif
    </a>
    <div class="trip-card__body">
        <div class="trip-card__top">
            <div class="trip-card__meta">
                @if($category)
                    <span class="category">{{ $category }}</span>
                    <span class="divider">•</span>
                @endif
                @if($location)
                    <span class="location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="10" r="3" />
                            <path
                                d="M12 2a8 8 0 0 0-8 8c0 1.892.402 3.13 1.5 4.5L12 22l6.5-7.5c1.098-1.37 1.5-2.608 1.5-4.5a8 8 0 0 0-8-8" />
                        </svg>
                        {{ $location }}
                    </span>
                    <span class="divider">•</span>
                @endif
                <span class="duration">{{ $duration }}</span>
            </div>

            @if($rating)
                <div class="rating">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="m12 17.27 4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72 3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                    </svg>
                    <span>{{ number_format($rating, 1) }}</span>
                    <em>({{ $reviews }} Reviews)</em>
                </div>
            @endif
        </div>

        <a href="{{ $detailUrl }}" class="trip-card__title">
            <h5>{{ $item->name }}</h5>
        </a>

        @if($highlights->isNotEmpty())
            <ul class="trip-card__highlights">
                @foreach($highlights as $h)
                    <li>{{ $h }}</li>
                @endforeach
            </ul>
        @endif

        @php $hasInfo = $star || $meals || (!$isTour && $item->free_cancellation_text); @endphp
        @if($hasInfo)
            <div class="trip-card__info">
                @if($star)
                    <span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M3 21h18M5 21V8l7-4 7 4v13M9 21v-6h6v6" />
                        </svg>
                        {{ $star }} Star Hotel
                    </span>
                @endif
                @if($meals)
                    <span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 0 1-3.46 0" />
                        </svg>
                        {{ $meals }}
                    </span>
                @endif
                @if(!$isTour && $item->free_cancellation_text)
                    <span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M20 6 9 17l-5-5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        {{ $item->free_cancellation_text }}
                    </span>
                @endif
            </div>
        @endif

        <div class="trip-card__footer">
            <div class="trip-card__price">
                @if($save)
                    <div class="price-row">
                        <s>{{ $inr($oldPrice) }}</s>
                        <span class="save-chip">Save {{ $inr($save) }}</span>
                    </div>
                @endif
                @if($price)
                    <p class="price">{{ $inr($price) }} <em>/ {{ strtolower(str_replace('Per ', '', $unit)) }}</em></p>
                @else
                    <p class="price"><em>Price on request</em></p>
                @endif
            </div>

            <div class="trip-card__actions">
                <a href="tel:+910000000000" class="btn btn-outline-primary btn-icon" aria-label="Call">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                        <path
                            d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                    </svg>
                </a>
                <a href="https://wa.me/0000000000" target="_blank" rel="noopener" class="btn btn-outline-primary btn-icon"
                    aria-label="WhatsApp">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path fill="currentColor"
                            d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                    </svg>
                </a>
                <div class="btns">
                    <a href="{{ $detailUrl }}" class="btn btn-outline-primary">View Details</a>
                    <button type="button" class="btn btn-primary js-open-enquiry">Enquire Now</button>
                </div>
            </div>
        </div>
    </div>
</article>