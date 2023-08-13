@props([
    'fromdate_label' => null,
    'todate_label' => null,
    'from_date_placeholder' => null,
    'to_date_placeholder' => null,
    'noJs' => null
])
   <x-input.group inline for="from_date" label="{{ (empty($fromdate_label)) ? __('component.From date') : $fromdate_label }}">
        <div class="input-group input-group-static  mb-2 me-2" wire:ignore x-data x-init="flatpickr($refs.picker, {allowInput: false, enableTime: 'false',
        dateFormat:  '{{config('app_settings.date_format.value')}}' });">
            <input id="from_date" name="from_date" wire:model="filters.from_date"  x-ref="picker" class="form-control" type="text" placeholder="{{ (empty($from_date_placeholder)) ? __('component.Any Date') : $from_date__placeholder }}" />
        </div>
    </x-input.group>

    <x-input.group inline for="to_date" label="{{ (empty($todate_label)) ? __('component.To date') : $todate_label }}">
        <div class="input-group input-group-static  mb-2 me-2" wire:ignore x-data x-init="flatpickr($refs.picker, {allowInput: false, enableTime: 'false', 
        dateFormat:  '{{config('app_settings.date_format.value')}}' });">
            <input id="to_date" name ="to_date" wire:model="filters.to_date" x-ref="picker" class="form-control" type="text" placeholder="{{ (empty($to_date_placeholder)) ? __('component.Any Date') : $to_date__placeholder }}" />
        </div>
    </x-input.group>

@if (!$noJs)
    @push('js')
    <script src="{{ asset('assets') }}/js/plugins/flatpickr.min.js"></script> 
    @endpush    
@endif

