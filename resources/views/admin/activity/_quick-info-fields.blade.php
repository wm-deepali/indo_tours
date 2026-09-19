{{-- resources/views/admin/activity/_quick-info-fields.blade.php --}}
{{-- Create: @include('admin.activity._quick-info-fields', ['activity' => null]) --}}
{{-- Edit:   @include('admin.activity._quick-info-fields', ['activity' => $activity]) --}}
@php
    $num = fn($v) => ($v === null || $v === '') ? '' : rtrim(rtrim(number_format((float) $v, 2, '.', ''), '0'), '.');

    $from   = old('duration_from', $num($activity?->duration_from));
    $to     = old('duration_to', $num($activity?->duration_to));
    $unit   = old('duration_unit', $activity?->duration_unit ?? 'hours');
    $price  = old('starting_price', $activity?->starting_price);
    $pUnit  = old('price_unit', $activity?->price_unit ?? 'Per Person');
    $cancel = old('free_cancellation_hours', $activity?->free_cancellation_hours);

    $priceUnits = config('search.price_units');
    if ($pUnit && !in_array($pUnit, $priceUnits, true)) {
        $priceUnits[] = $pUnit;   // keep an older free-text value selectable
    }
@endphp

<div class="form-row">
    <div class="form-field">
        <label for="duration_from">Duration (From)</label>
        <input type="number" id="duration_from" name="duration_from" step="0.25" min="0"
            class="form-control-styled @error('duration_from') is-invalid @enderror" value="{{ $from }}"
            placeholder="e.g. 2" required>
        @error('duration_from')<div class="form-error">{{ $message }}</div>@enderror
    </div>
    <div class="form-field">
        <label for="duration_to">Duration (To) — optional</label>
        <input type="number" id="duration_to" name="duration_to" step="0.25" min="0"
            class="form-control-styled @error('duration_to') is-invalid @enderror" value="{{ $to }}"
            placeholder="e.g. 3">
        @error('duration_to')<div class="form-error">{{ $message }}</div>@enderror
    </div>
    <div class="form-field">
        <label for="duration_unit">Unit</label>
        <select id="duration_unit" name="duration_unit"
            class="form-control-styled @error('duration_unit') is-invalid @enderror">
            @foreach(config('search.duration_units') as $key => $label)
                <option value="{{ $key }}" {{ $unit === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @error('duration_unit')<div class="form-error">{{ $message }}</div>@enderror
    </div>
</div>
<div class="hint" style="margin: -10px 0 18px;">
    Shows on the site as: <strong id="activity-duration-preview">—</strong>
</div>

<div class="form-row">
    <div class="form-field">
        <label for="starting_price">Starting Price</label>
        <input type="number" id="starting_price" name="starting_price" min="0" step="0.01"
            class="form-control-styled" value="{{ $price }}" placeholder="e.g. 4675">
    </div>
    <div class="form-field">
        <label for="price_unit">Price Unit</label>
        <select id="price_unit" name="price_unit" class="form-control-styled">
            @foreach($priceUnits as $u)
                <option value="{{ $u }}" {{ $pUnit === $u ? 'selected' : '' }}>{{ $u }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-field">
        <label for="free_cancellation_hours">Free Cancellation</label>
        <select id="free_cancellation_hours" name="free_cancellation_hours" class="form-control-styled">
            <option value="">Not available</option>
            @foreach(config('search.cancellation_hours') as $h)
                <option value="{{ $h }}" {{ (string) $cancel === (string) $h ? 'selected' : '' }}>Up to {{ $h }} hours before</option>
            @endforeach
        </select>
        <div class="hint">"Not available" hides the Free Cancellation badge</div>
    </div>
</div>

<div class="hint" style="margin: -6px 0 18px;">
    Rating and review count are calculated automatically from published reviews.
    @if($activity && $activity->rating)
        Currently <strong>{{ number_format($activity->rating, 1) }}</strong> ({{ $activity->review_count }} reviews).
    @endif
</div>

<script>
    (function () {
        var from = document.getElementById('duration_from');
        var to = document.getElementById('duration_to');
        var unit = document.getElementById('duration_unit');
        var out = document.getElementById('activity-duration-preview');

        function fmt(n) { return String(parseFloat(n.toFixed(2))); }

        function render() {
            var f = parseFloat(from.value);
            var t = parseFloat(to.value);

            if (isNaN(f)) { out.textContent = '—'; return; }

            var isRange = !isNaN(t) && t > f;
            var top = isRange ? t : f;
            var range = isRange ? fmt(f) + '–' + fmt(t) : fmt(f);
            var label = unit.value === 'minutes' ? 'mins'
                : unit.value === 'days' ? (top > 1 ? 'Days' : 'Day')
                    : (top > 1 ? 'hrs' : 'hr');

            out.textContent = range + ' ' + label;
        }

        [from, to, unit].forEach(function (el) {
            el.addEventListener('input', render);
            el.addEventListener('change', render);
        });

        render();
    })();
</script>