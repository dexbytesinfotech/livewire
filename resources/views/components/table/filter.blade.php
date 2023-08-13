@props([
    'label' => null,
    'icon' => null,
])
<div {{ $attributes }} class="fixed-plugin ps" >
<div class="card shadow-lg mt-7 overflow-auto" style="height:82%" @mouseover.away = "open = false">
    <div class="card-header pb-0 pt-3">
        <div class="float-start">
            <h5 class="mt-3 mb-0">@if ($icon)
                <i class="material-icons mt-1">filter_alt</i>
                @endif {{ (empty($label)) ? __('component.Filter') : $label }}</h5>
        </div>
        <div class="float-end mt-4">
            <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
            </button>
        </div>
    </div>
    <div class="card-body pt-sm-3 pt-0">
        <div class="w-1/2 pl-2 space-y-4">
           {{ $slot }}
            <x-button.link wire:click="resetFilters" class="mt-2"> @lang('component.Reset Filters') </x-button.link>
    </div>
</div>
</div>
</div>