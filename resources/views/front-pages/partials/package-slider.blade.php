@if($tourPackages->isNotEmpty())
    <section class="listing-secA" id="packages">
        <div class="container">
            <div class="heading">
                <h3>{{ $title }} <span>Tour Packages</span></h3>
                <p>
                    Choose from our handpicked travel experiences, designed to make
                    every journey unforgettable.
                </p>
            </div>

            <div class="swiper-wrap">
                <div class="swiper thirdSilder">
                    <div class="swiper-wrapper">
                        @foreach($tourPackages as $package)
                            <div class="swiper-slide">
                                <div class="trip_card2">
                                    <a href="{{ route('tourpackage.show', ['slug' => $package->slug] + ($ref ?? [])) }}" target="_blank" class="img">
                                        @if($package->main_image)
                                            <img loading="lazy" src="{{ asset('storage/' . $package->main_image) }}"
                                                alt="{{ $package->name }}" />
                                        @endif
                                        @if($package->old_price && $package->price && $package->old_price > $package->price)
                                            <span class="save">Save INR
                                                {{ number_format($package->old_price - $package->price) }}</span>
                                        @endif
                                    </a>

                                    <div class="content">
                                        <div class="rating">
                                            @if($package->duration_text)
                                                <span>{{ $package->duration_text }}</span>
                                            @endif
                                        </div>

                                        <h3>
                                            <a href="{{ route('tourpackage.show', ['slug' => $package->slug] + ($ref ?? [])) }}"
                                                target="_blank">{{ $package->name }}</a>
                                        </h3>

                                        @if($package->old_price && $package->price && $package->old_price > $package->price)
                                            <div class="innerSave">
                                                <s>INR {{ number_format($package->old_price) }}</s>
                                                <span class="saveChip">Save INR
                                                    {{ number_format($package->old_price - $package->price) }}</span>
                                            </div>
                                        @endif

                                        @if($package->price)
                                            <p class="price">INR {{ number_format($package->price) }}</p>
                                        @endif

                                        <div class="btns">
                                            <a href="tel:+91 000 000 00" class="btn btn-outline-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                                    <path
                                                        d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                                </svg>
                                            </a>
                                            <button data-model=".enquire-pop" data-package-id="{{ $package->id }}"
                                                class="btn btn-primary">Enquire Now</button>
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