@foreach ($sections as $section)
    <section class="{{ $section->style_class }}">
        <div class="container">
            <div class="heading">
                <h3>{{ $section->title }} @if ($section->highlight)<span>{{ $section->highlight }}</span>@endif</h3>
                @if ($section->description)
                    <p>{{ $section->description }}</p>
                @endif
            </div>

            <div class="swiper-wrap">
                <div class="swiper thirdSilder">
                    <div class="swiper-wrapper">
                        @foreach ($section->packages as $package)
                            @php $detailUrl = url('/tour-packages/' . $package->slug); @endphp
                            <div class="swiper-slide">
                                <div class="trip_card">
                                    <a href="{{ $detailUrl }}" target="_blank" class="img">
                                        <img loading="lazy"
                                            src="{{ $package->main_image ? asset('storage/' . $package->main_image) : asset('assets/images/home/card1.jpg') }}"
                                            alt="{{ $package->name }}" />
                                        @if ($package->savings > 0)
                                            <span class="save">Save INR {{ number_format($package->savings) }}</span>
                                        @endif
                                    </a>

                                    <div class="content">
                                        <div class="rating">
                                            <span>{{ $package->duration_text }}</span>
                                            @if ($package->rating)
                                                <div class="star">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path d="m12 17.27l4.15 2.51c.76.46 1.69-.22 1.49-1.08l-1.1-4.72l3.67-3.18c.67-.58.31-1.68-.57-1.75l-4.83-.41l-1.89-4.46c-.34-.81-1.5-.81-1.84 0L9.19 8.63l-4.83.41c-.88.07-1.24 1.17-.57 1.75l3.67 3.18l-1.1 4.72c-.2.86.73 1.54 1.49 1.08z" />
                                                    </svg>
                                                    <span>{{ $package->rating }}</span>
                                                    <em>({{ $package->review_count }})</em>
                                                </div>
                                            @endif
                                        </div>

                                        <h3><a href="{{ $detailUrl }}" target="_blank">{{ $package->name }}</a></h3>

                                        @if ($package->savings > 0)
                                            <div class="innerSave">
                                                <s>INR {{ number_format($package->old_price) }}</s>
                                                <span class="saveChip">Save INR {{ number_format($package->savings) }}</span>
                                            </div>
                                        @endif
                                        <p class="price">INR {{ number_format($package->price) }}</p>

                                        <div class="btns">
                                            <a href="tel:+91 000 000 000" class="btn btn-outline-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linejoin="round">
                                                    <path d="M7.829 16.171a20.9 20.9 0 0 1-4.846-7.614c-.573-1.564-.048-3.282 1.13-4.46l.729-.728a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.42.42a1.81 1.81 0 0 0 0 2.56l3.84 3.841a1.81 1.81 0 0 0 2.56 0l.421-.42a2.11 2.11 0 0 1 2.987 0l1.707 1.707a2.11 2.11 0 0 1 0 2.987l-.728.728c-1.178 1.179-2.896 1.704-4.46 1.131a20.9 20.9 0 0 1-7.614-4.846Z" />
                                                </svg>
                                            </a>
                                            <button data-model=".enquire-pop" class="btn btn-primary">Enquire Now</button>
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
                            <path fill="#ffff" d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0"></path>
                        </svg>
                    </button>
                    <button type="button" class="thirdSilder-next btn-next">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
                            <path fill="#ffff" d="M609.408 149.376L277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0a30.59 30.59 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.59 30.59 0 0 0 0-42.688a29.12 29.12 0 0 0-41.728 0"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="center-btn">
                <a href="{{ $section->view_all_url ?: 'javascript:void(0)' }}" class="btn btn-outline-primary">View All</a>
            </div>
        </div>
    </section>
@endforeach