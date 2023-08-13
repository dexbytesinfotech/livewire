<div class="input-group input-group-static  mb-2 me-2" wire:ignore   x-init="flatpickr($refs.picker, {allowInput: false, enableTime: 'false',dateFormat:  '{{config('app_settings.date_format.value')}}' });">
    <input
        {{ $attributes->whereDoesntStartWith('wire:model') }}
        x-ref="input" {{ $attributes }}
        x-bind:value="value"
        class="form-control rounded-none rounded-r-md flex-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
    />
</div>

