@section('page_title')
    @lang("components/state.add_state_title")
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
            <x-form.form submitText="Create State" submit-target="store" cancel-route="{{ route('state-management') }}">

                {{-- Input-group --}}
                <x-input.group colspan="col-12" for="name" label="Name *" :error="$errors->first('name')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="name" placeholder="Enter a state name" />
                </x-input.group>

                <x-input.group colspan="col-12 mt-4" for="country_id" label="Country *" :error="$errors->first('country_id')">
                    <x-input.select class="form-control" wire:model="country_id" id="role_type" onfocus="focused(this)" onfocusout="defocused(this)"
                        placeholder="Choose Your Country">
                        @foreach ($country  as $value)
                            <option value="{{ $value['id'] }}">{{ $value['name']}}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>
                <x-input.checkbox wire:model.lazy="is_default" label="Is Default"/>
                <x-input.checkbox wire:model.lazy="status" label="Active"/>


            </x-form.form>
        </x-slot>
    </x-core.card>
</x-core.container>