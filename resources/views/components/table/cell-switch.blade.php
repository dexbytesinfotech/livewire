@props([
    'status' => null,
    'disabled' => null,
])
<x-table.cell {{ $attributes }}>
<div class="form-check form-switch ms-3">
    <input class="form-check-input"  type="checkbox" id="flexSwitchCheckDefault35"   @if($status) checked="" @endif {{ $disabled }}
    {{ ($disabled == 'disabled') ? 'disabled' : '' }}>
</div>
{{ $slot }}
</x-table.cell>