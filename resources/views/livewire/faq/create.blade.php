@section('page_title')
    @lang("components/faq.page_title_create")
@endsection

<x-core.container>

    {{-- loader --}}
    {{-- <x-loder /> --}}

    {{-- Alert message - alert-success, examples- alert-danger, alert-warning, alert-primary  --}}
    @if (session('status'))
        <x-alert class="alert-success">{{ Session::get('status') }}</x-alert>
    @endif

    {{-- Card --}}
    <x-core.card class="col-lg-9 col-12 p-3 mx-auto position-relative">

        {{-- Card Body --}}
        <x-slot name="body">
            {{-- Form --}}
            <x-form.form submitText="Create Faq" submit-target="store" cancel-route="{{ route('faq-management') }}">

                {{-- Input-group --}}
                <x-input.group colspan="col-12" for="title" label="Title *" :error="$errors->first('title')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="title" placeholder="Enter a Title" />
                </x-input.group>

                <x-input.group colspan="col-12" for="description" label="Description *" :error="$errors->first('descriptions')">
                    {{-- Rech text --}}
                    <x-input.rich-text wire:model.lazy="descriptions">
                        {{ $descriptions }}
                    </x-input.rich-text>
                </x-input.group>

                <x-input.group colspan="col-12" for="role_type" label="Select Role *" :error="$errors->first('role_type')">
                    <x-input.select class="form-control" wire:model="role_type" id="role_type" onfocus="focused(this)" onfocusout="defocused(this)"
                        placeholder="Select a Role">
                        @foreach ($role as $value)
                            <option value="{{ strtolower($value['name']) }}"> {{ $value['name']}} </option>
                        @endforeach
                    </x-input.select>
                </x-input.group>


                <x-input.group inline colspan="col-12" for="status" label="Status" :error="$errors->first('name')">
                    {{-- Input text --}}
                    <x-input.checkbox wire:model.lazy="status" label="Active"/>
                </x-input.group>

            </x-form.form>
        </x-slot>
    </x-core.card>
</x-core.container>

