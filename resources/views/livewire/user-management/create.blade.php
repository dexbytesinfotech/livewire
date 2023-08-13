{{-- Page Title --}}
@section('page_title')
    @lang("components/user.page_title_add")
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
            <x-form.form submitText="create user" submit-target="store" cancel-route="{{ route('user-management') }}">

                {{-- Input-group --}}
                <x-input.group colspan="col-6" for="first_name" label="First Name *" :error="$errors->first('first_name')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="first_name" placeholder="Enter a first name" />
                </x-input.group>

                <x-input.group colspan="col-6" for="last_name" label="Last Name *" :error="$errors->first('last_name')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="last_name" placeholder="Enter a last name" />
                </x-input.group>

                <x-input.group colspan="col-3" for="country_code" label="Country Code *" :error="$errors->first('country_code')">
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

                <x-input.group colspan="col-9" for="phone" label="Phone Number *" :error="$errors->first('phone')">
                    <x-input.text wire:model.lazy="phone"
                        placeholder="Enter a Phone Number without country code e.g 5056440289" />
                </x-input.group>

                <x-input.group colspan="col-12" for="email" label="Email *" :error="$errors->first('email')">
                    {{-- Input-email --}}
                    <x-input.email wire:model.lazy="email" placeholder="Enter an Email" />
                </x-input.group>

                {{-- Password with confirm and show icon --}}
                <x-input.password confirm icon />

                @if (!$this->role)
                    <x-input.group colspan="col-12" for="role_id" label="Select Role *" :error="$errors->first('role_id')">
                        <x-input.select class="form-control" wire:model="role_id" id="role_id"
                            placeholder="Select a Role">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}"> {{ $role->name }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>
                @endif
            </x-form.form>
        </x-slot>
    </x-core.card>
</x-core.container>