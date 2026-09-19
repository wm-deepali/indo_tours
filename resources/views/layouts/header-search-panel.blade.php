{{-- resources/views/layouts/header-search-panel.blade.php --}}
@php
    $searchUrl = url('/search');   // <-- change to your search results route

    $types     = config('search.product_types');
    $durations = config('search.durations');
    $priceMin  = (int) config('search.price.min');
    $priceMax  = (int) config('search.price.max');

    // Accepts "a,b,c" (header panel) or ['a','b','c'] (sidebar form) and returns a clean array
    $csv = function (string $key, string $default = '') {
        $value = request($key, $default);
        $list  = is_array($value) ? $value : explode(',', (string) $value);

        return array_values(array_filter(array_map('trim', $list), fn($v) => $v !== ''));
    };

    $selectedTypes     = $csv('type', 'tour');
    $selectedDurations = $csv('duration');
    $currentMin        = (int) request('min_price', $priceMin);
    $currentMax        = (int) request('max_price', $priceMax);

    // 500000 -> "5L", 150000 -> "1.5L", 0 -> "0"
    $fmt = fn($n) => $n >= 100000 ? (round($n / 100000, 1) + 0) . 'L' : $n;
@endphp

<div class="search-panel" data-dropdown-panel>
    {{-- display: contents keeps the panel's existing flex/scroll layout untouched --}}
    <form action="{{ $searchUrl }}" method="GET" data-search-form style="display: contents;">

        <input type="hidden" name="type" value="{{ implode(',', $selectedTypes) }}">
        <input type="hidden" name="duration" value="{{ implode(',', $selectedDurations) }}">

        <div class="search-panel-inner">
            <div class="panel-field">
                <div class="panel-search-input">
                    <svg width="18" height="18" viewBox="0 0 16 16" fill="none">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4"
                            d="M7.333 12.667A5.333 5.333 0 107.333 2a5.333 5.333 0 000 10.667zM14 14l-2.9-2.9" />
                    </svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search for" />
                </div>
            </div>

            <div class="panel-field">
                <h5>Product Type</h5>
                <div class="chip-group" data-chip-group="type">
                    @foreach($types as $key => $label)
                        <button type="button" class="chip {{ in_array($key, $selectedTypes) ? 'is-active' : '' }}"
                            data-chip-value="{{ $key }}">{{ $label }}</button>
                    @endforeach
                </div>
            </div>

            <div class="panel-divider"></div>

            <div class="panel-field">
                <h5>Trip Duration</h5>
                <div class="chip-group" data-chip-group="duration">
                    @foreach($durations as $key => $d)
                        <button type="button" class="chip {{ in_array((string) $key, $selectedDurations, true) ? 'is-active' : '' }}"
                            data-chip-value="{{ $key }}"
                            data-for-type="{{ implode(',', $d['types']) }}">{{ $d['label'] }}</button>
                    @endforeach
                </div>
            </div>

            <div class="panel-divider"></div>

            <div class="panel-field">
                <h5>Price Range</h5>

                <div class="range-slider" data-range-slider>
                    <div class="range-track"></div>
                    <div class="range-fill" data-range-fill></div>
                    <button type="button" class="range-handle" data-range-handle="min" aria-label="Minimum price">
                        <span class="range-tooltip" data-range-tooltip="min">{{ $fmt($currentMin) }}</span>
                    </button>
                    <button type="button" class="range-handle" data-range-handle="max" aria-label="Maximum price">
                        <span class="range-tooltip" data-range-tooltip="max">{{ $fmt($currentMax) }}</span>
                    </button>
                </div>

                <div class="price-inputs">
                    <label class="price-field">
                        <span>Min</span>
                        <input type="number" name="min_price" data-price="min" data-default="{{ $priceMin }}"
                            value="{{ $currentMin }}" />
                    </label>
                    <label class="price-field">
                        <span>Max</span>
                        <input type="number" name="max_price" data-price="max" data-default="{{ $priceMax }}"
                            value="{{ $currentMax }}" />
                    </label>
                </div>
            </div>

            {{-- Flights only apply to tours --}}
            <div data-for-type="tour">
                <div class="panel-divider"></div>

                <label class="panel-checkbox">
                    <input type="checkbox" name="flights" value="1" {{ request('flights') ? 'checked' : '' }} />
                    <span class="checkbox-box"></span>
                    I want Flights to be included
                </label>
            </div>
        </div>

        <div class="search-panel-footer">
            <button type="button" class="link-btn" data-clear-all>
                Clear All
            </button>
            <button type="submit" class="btn-search">
                Search For Products
            </button>
        </div>
    </form>
</div>

<script>
    (function () {
        var form = document.querySelector('[data-search-form]');
        if (!form) return;

        var typeInput = form.querySelector('input[name="type"]');
        var durationInput = form.querySelector('input[name="duration"]');

        function activeValues(group) {
            var chips = form.querySelectorAll('[data-chip-group="' + group + '"] .chip.is-active');
            return Array.prototype.map.call(chips, function (c) { return c.getAttribute('data-chip-value'); });
        }

        // Reads the chip state AFTER the existing chip/slider scripts have run, then
        // mirrors it into the hidden inputs and shows/hides tour-only options.
        function sync() {
            var types = activeValues('type');

            form.querySelectorAll('[data-for-type]').forEach(function (el) {
                var allowed = el.getAttribute('data-for-type').split(',');
                var show = types.length
                    ? types.some(function (t) { return allowed.indexOf(t) !== -1; })
                    : allowed.indexOf('tour') !== -1;   // no type picked = Tour (default)

                el.style.display = show ? '' : 'none';

                if (!show) {
                    el.classList.remove('is-active');
                    el.querySelectorAll('.chip.is-active').forEach(function (c) { c.classList.remove('is-active'); });
                    el.querySelectorAll('input[type="checkbox"]').forEach(function (i) { i.checked = false; });
                }
            });

            typeInput.value = types.join(',');
            durationInput.value = activeValues('duration').join(',');
        }

        form.addEventListener('click', function (e) {
            var isChip = e.target.closest('.chip');
            var isClear = e.target.closest('[data-clear-all]');
            if (!isChip && !isClear) return;

            setTimeout(function () {
                if (isClear) {
                    form.querySelector('input[name="q"]').value = '';
                    form.querySelectorAll('input[type="checkbox"]').forEach(function (i) { i.checked = false; });
                    form.querySelectorAll('[data-chip-group="duration"] .chip').forEach(function (c) { c.classList.remove('is-active'); });

                    form.querySelectorAll('input[data-price]').forEach(function (i) {
                        i.value = i.getAttribute('data-default');
                        i.dispatchEvent(new Event('input', { bubbles: true }));
                        i.dispatchEvent(new Event('change', { bubbles: true }));
                    });

                    // back to the default product type
                    if (!form.querySelector('[data-chip-group="type"] .chip.is-active')) {
                        var first = form.querySelector('[data-chip-group="type"] .chip');
                        if (first) first.classList.add('is-active');
                    }
                }
                sync();
            }, 0);
        });

        // Keep the URL clean: don't send empty / default values
        form.addEventListener('submit', function () {
            sync();
            form.querySelectorAll('input[name]').forEach(function (i) {
                var isDefaultPrice = i.hasAttribute('data-default') && i.value === i.getAttribute('data-default');
                if (i.type !== 'checkbox' && (i.value === '' || isDefaultPrice)) {
                    i.disabled = true;
                    i.setAttribute('data-tmp-disabled', '1');
                }
            });
        });

        // Coming back with the browser Back button: re-enable what we disabled
        window.addEventListener('pageshow', function () {
            form.querySelectorAll('[data-tmp-disabled]').forEach(function (i) {
                i.disabled = false;
                i.removeAttribute('data-tmp-disabled');
            });
            sync();
        });

        sync();
    })();
</script>