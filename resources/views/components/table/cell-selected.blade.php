@props([
    'value' => null
])
<x-table.cell class="pr-0">
    <x-input.checkbox  wire:model="selected" value="{{ $value }}" />
</x-table.cell>