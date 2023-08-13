@props([
    'url' => null,
    'alt' => null,
])
<x-table.cell {{ $attributes }} class="position-relative">
    @if ($url)
    <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($url)}}" alt="{{ $alt }}"
        class="avatar avatar-sm me-3">
    @else
    <img src="{{ asset('assets') }}/img/default-avatar.png" alt="{{ $alt }}"
        class="avatar avatar-sm me-3">
    @endif
</x-table.cell>