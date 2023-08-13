@section('page_title')
    @lang('components/agency.page_title_create')
@endsection

<x-core.container>

    {{-- Alert message - alert-success, examples- alert-danger, alert-warning, alert-primary  --}}
    @if (session('status'))
        <x-alert class="alert-success">{{ Session::get('status') }}</x-alert>
    @endif

    {{-- Card --}}
    <x-core.card class="col-lg-9 col-12 p-3 mx-auto position-relative">

        {{-- Card Body --}}
        <x-slot name="body">
            {{-- Form --}}
            <x-form.form submitText="Create Agency" submit-target="store"
                cancel-route="{{ route('agency-management') }}">

                {{-- Input-group --}}
                <x-input.group colspan="col-12" for="agency_name" label="Agency Name *" :error="$errors->first('agency_name')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="agency_name" placeholder="Enter a Agency Name" />
                </x-input.group>

                <x-input.group colspan="col-2" for="country_code" label="Country Code *" :error="$errors->first('country_code')">
                    {{-- Input-select --}}
                    <x-input.select class="form-control" wire:model.lazy="country_code" id="countryCode"
                        onfocus="focused(this)" onfocusout="defocused(this)">
                        <option value='' selected>Select</option>
                        @foreach ($countries as $countryValue)
                            <option value="{{ $countryValue['country_code'] }}">+ {{ $countryValue['country_code'] }}
                            </option>
                        @endforeach
                    </x-input.select>
                </x-input.group>

                <x-input.group colspan="col-5" for="phone_number" label="Phone Number *" :error="$errors->first('phone_number')">
                    <x-input.text wire:model.lazy="phone_number" placeholder="Enter a Phone Number" />
                </x-input.group>

                <x-input.group colspan="col-5" for="city" label="City *" :error="$errors->first('city')">
                    <x-input.select class="form-control" wire:model="city" id="city" onfocus="focused(this)"
                        onfocusout="defocused(this)" placeholder="Choose Your City">
                        @foreach ($cities as $cityValue)
                            <option value="{{ $cityValue['name'] }}">{{ $cityValue['name'] }}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>

                <x-input.group colspan="col-12" for="address" label="Address *" :error="$errors->first('address')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="address" placeholder="Enter Address" />
                </x-input.group>

            </x-form.form>
        </x-slot>
    </x-core.card>
</x-core.container>


