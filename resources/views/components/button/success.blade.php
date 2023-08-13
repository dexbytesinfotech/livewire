@props([
    "title" => null
])
<x-button {{ $attributes }} {{ $attributes->merge(['class' => 'btn btn-success']) }} title="{{ $title }}">
    {{ $slot }}
</x-button>