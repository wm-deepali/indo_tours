{{-- resources/views/admin/tourpackage/_duration-fields.blade.php --}}
{{-- Create: @include('admin.tourpackage._duration-fields', ['package' => null]) --}}
{{-- Edit:   @include('admin.tourpackage._duration-fields', ['package' => $tourPackage]) --}}
@php
    $days   = old('duration_days', $package?->duration_days);
    $nights = old('duration_nights', $package?->duration_nights);
    $unit   = old('price_unit_text', $package?->price_unit_text ?? 'Per Person');

    $units = config('search.price_units');
    if ($unit && !in_array($unit, $units, true)) {
        $units[] = $unit;   // keep an older free-text value selectable
    }
@endphp

<div class="form-row-3">
    <div class="form-field">
        <label for="duration_days">Days</label>
        <select id="duration_days" name="duration_days"
            class="form-control-styled @error('duration_days') is-invalid @enderror" required>
            <option value="">Select</option>
            @for($i = 1; $i <= 30; $i++)
                <option value="{{ $i }}" {{ (string) $days === (string) $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        @error('duration_days')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    <div class="form-field">
        <label for="duration_nights">Nights</label>
        <select id="duration_nights" name="duration_nights"
            class="form-control-styled @error('duration_nights') is-invalid @enderror" required>
            <option value="">Select</option>
            @for($i = 0; $i <= 30; $i++)
                <option value="{{ $i }}" {{ (string) $nights === (string) $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        @error('duration_nights')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    <div class="form-field">
        <label for="price_unit_text">Price Unit</label>
        <select id="price_unit_text" name="price_unit_text" class="form-control-styled">
            @foreach($units as $u)
                <option value="{{ $u }}" {{ $unit === $u ? 'selected' : '' }}>{{ $u }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="hint" style="margin: -10px 0 18px;">
    Shows on the site as: <strong id="duration-preview">—</strong>
    <span> — Nights fills in as Days − 1 by default; change it if the trip differs.</span>
</div>

<script>
    (function () {
        var daysSel = document.getElementById('duration_days');
        var nightsSel = document.getElementById('duration_nights');
        var preview = document.getElementById('duration-preview');
        var nightsTouched = {{ ($nights !== null && $nights !== '') ? 'true' : 'false' }};

        function render() {
            var d = parseInt(daysSel.value, 10);
            var n = parseInt(nightsSel.value, 10);

            if (!d) { preview.textContent = '—'; return; }
            if (isNaN(n)) n = Math.max(d - 1, 0);

            var longText = d + (d > 1 ? ' Days' : ' Day') + (n > 0 ? ' & ' + n + (n > 1 ? ' Nights' : ' Night') : '');
            var shortText = n > 0 ? d + 'D / ' + n + 'N' : d + 'D';
            preview.textContent = shortText + '  ·  ' + longText;
        }

        daysSel.addEventListener('change', function () {
            if (!nightsTouched && this.value) {
                nightsSel.value = Math.max(parseInt(this.value, 10) - 1, 0);
            }
            render();
        });

        nightsSel.addEventListener('change', function () {
            nightsTouched = true;
            render();
        });

        render();
    })();
</script>