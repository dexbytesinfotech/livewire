@props([
    'sortable' => null,
    'direction' => null,
])      
<th style="padding: 0.75rem 0.5rem">
    @unless ($sortable)
        <span class="text-xs text-secondary text-uppercase">{{ $slot }}</span>
    @else
        <a {{ $attributes->except('class') }} class="text-xs text-secondary text-uppercase">
            <span>{{ $slot }}</span>

            <span>
                @if ($direction === 'asc')
                    <i class="fas fa-sort-up cursor-pointer"></i>
                @elseif ($direction === 'desc')
                    <i class="fas fa-sort-down cursor-pointer"></i>
                @else
                    <i class="fas fa-sort cursor-pointer"></i>
                @endif
            </span>
        </a>
    @endif
</th>