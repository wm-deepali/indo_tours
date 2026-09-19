<div class="accordion-group">
    @foreach($groups as $group)
        <div class="accordion-item">
            <button type="button" class="accordion-trigger">
                {{ $group['title'] }}
                <svg class="chevron" width="10" height="6" viewBox="0 0 10 6" fill="none">
                    <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
            <ul class="accordion-source" hidden>
                @foreach($group['items'] as $item)
                    <li><a href="{{ $item->url }}">{{ $item->label }}</a></li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>