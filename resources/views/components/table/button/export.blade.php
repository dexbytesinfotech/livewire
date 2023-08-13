@props([
    'icon' => null
])
<button wire:click="export" class="btn btn-outline-secondary me-1 mb-0 mt-sm-0 mt-1" type="button" name="button">
@if ($icon)
<i class="material-icons text-sm">download</i>
@endif {{ (empty(trim($slot))) ? __('component.Export') : $slot}} </button> 