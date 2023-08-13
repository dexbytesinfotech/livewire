@props([
    'label' => null,
    'for' => null,
])

<div class="form-check">
    <input  {{ $attributes }}   {{  $attributes->merge(['class' => 'form-check-input']) }} type="checkbox" value="" id="{{ $for }}">
    <label class="custom-control-label" for="{{ $for }}">{{ $label }}</label>
</div>