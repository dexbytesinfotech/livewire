@section('page_title')
    @lang("components/country.add_country_title")
@endsection
<x-core.container>

    {{-- loader --}}
    <x-loder />

    {{-- Alert message - alert-success, examples- alert-danger, alert-warning, alert-primary  --}}
    @if (session('status'))
        <x-alert class="alert-success">{{ Session::get('status') }}</x-alert>
    @endif

    {{-- Card --}}
    <x-core.card class="col-lg-9 col-12 p-3 mx-auto position-relative">

        {{-- Card Body --}}
        <x-slot name="body">
            {{-- Form --}}
            <x-form.form submitText="Create Country" submit-target="store" cancel-route="{{ route('country-management') }}">

                {{-- Input-group --}}
                <x-input.group colspan="col-12" for="name" label="Name *" :error="$errors->first('name')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="name" placeholder="Enter a country name" />
                </x-input.group>

                <x-input.group colspan="col-12" for="country_code" label="Country Code *" :error="$errors->first('country_code')">
                    <x-input.text wire:model.lazy="country_code" placeholder="Enter a country code e.g. 1, 91, 966 etc.." />
                </x-input.group>

                <x-input.group colspan="col-12" for="country_ios_code" label="Country iso Code *" :error="$errors->first('country_ios_code')">
                    <x-input.text wire:model.lazy="country_ios_code" placeholder="Enter a country ios code" />
                </x-input.group>

                <x-input.group colspan="col-12" for="nationality" label="Nationality" :error="$errors->first('nationality')">
                    <x-input.text wire:model.lazy="nationality" placeholder="Enter a Nationality" />
                </x-input.group>

                <x-input.checkbox wire:model.lazy="is_default" label="Is Default"/>
                <x-input.checkbox wire:model.lazy="status" label="Active"/>


            </x-form.form>
        </x-slot>
    </x-core.card>
</x-core.container>