<x-core.card class="col-lg-12 col-12 position-relative text-bold" header="Add Agency Manager">

    {{-- Card Body --}}
    <x-slot name="body">
        {{-- Form --}}
        <x-form.form submit-target="store">

            {{-- Input-group --}}
            <x-input.group colspan="col-6" for="first_name" label="First Name *" :error="$errors->first('first_name')">
                {{-- Input text --}}
                <x-input.text wire:model.lazy="first_name" placeholder="Enter a First Name" />
            </x-input.group>
            <x-input.group colspan="col-6" for="last_name" label="Last Name *" :error="$errors->first('last_name')">
                {{-- Input text --}}
                <x-input.text wire:model.lazy="last_name" placeholder="Enter a Last Name" />
            </x-input.group>

            <x-input.group colspan="col-5" for="email" label="Email *" :error="$errors->first('email')">
                {{-- Input text --}}
                <x-input.text wire:model.lazy="email" placeholder="Enter a Email" />
            </x-input.group>

            <x-input.group colspan="col-3" for="country_code" label="Country Code *" :error="$errors->first('country_code')">
                {{-- Input text --}}
                <select class="form-control input-group input-group-dynamic" wire:model.lazy="country_code"
                    id="countryCode" onfocus="focused(this)" onfocusout="defocused(this)">
                    <option value='' selected>Select</option>
                    @foreach ($countries as $countryValue)
                        <option value="{{ $countryValue['country_code'] }}">
                            + {{ $countryValue['country_code'] }}</option>
                    @endforeach
                </select>
            </x-input.group>

            <x-input.group colspan="col-4" for="phone" label="Phone Number *" :error="$errors->first('phone')">
                <x-input.text wire:model.lazy="phone" placeholder="Enter a Phone Number" />
            </x-input.group>

            {{-- Password with confirm and show icon --}}
            <x-input.password confirm icon />
           
        </x-form.form>
    </x-slot>
</x-core.card>

