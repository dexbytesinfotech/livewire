@props([
    'href' => null,
    'column' => null
])
<td {{ $attributes }} class="text-sm font-weight-normal align-middle" 
@empty(!$column)
    @if(!in_array($column,$this->selectedColumns))
        hidden
    @endif
@endempty
>
    @empty($href)
        {{ $slot }}
    @else
        <a href="{{ $href }}"> {{ $slot }} </a>
    @endempty
</td>