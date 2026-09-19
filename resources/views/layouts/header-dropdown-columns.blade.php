{{-- resources/views/partials/header-dropdown-columns.blade.php --}}
{{-- Usage: @include('partials.header-dropdown-columns', ['groups' => $indiaGroups]) --}}
@php
    // Column icons cycle in this order (same icons as the static design)
    $icons = [
        'M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5',
        'M20.8 4.6a5.5 5.5 0 00-7.8 0L12 5.6l-1-1a5.5 5.5 0 10-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 000-7.8z',
        'M17 20v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2M10 10a4 4 0 100-8 4 4 0 000 8zM23 20v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75',
        'M3 12l18-7-7 18-3-8-8-3z',
    ];
@endphp

<div class="dropdown-inner">
    @foreach($groups as $group)
        <div class="dropdown-col">
            <h4>
                <span class="col-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="{{ $icons[$loop->index % count($icons)] }}" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                {{ $group['title'] }}
            </h4>
            @foreach($group['items'] as $item)
                <a href="{{ $item->url }}">{{ $item->label }}</a>
            @endforeach
        </div>
    @endforeach
</div>