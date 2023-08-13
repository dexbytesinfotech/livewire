@props([
    "title" => null
])
<x-button {{ $attributes }} {{ $attributes->merge(['class' => 'btn btn-danger']) }} title="{{ $title }}" >
{{ $slot }}
</x-button>
