@props([
    'icon' => null
])
<button   class="fixed-plugin-button-nav btn btn-outline-secondary mb-0 mt-sm-0 mt-1" type="button" name="button">
@if ($icon)
<i class="material-icons text-sm">filter_alt</i>
@endif {{ (empty(trim($slot))) ? __('component.Filter') : $slot}} </button> 