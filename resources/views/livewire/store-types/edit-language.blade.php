{{-- Page Title --}}
@section('page_title')
    @lang("components/StoreType.edit_store_title") ({{  $languages }})
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
            <x-form.form submitText="Update Store Type" submit-target="editTranslate" cancel-route="{{ route('store-type-management') }}">

                {{-- Input-group --}}
                <x-input.group colspan="col-12" for="name" label="Name *" :error="$errors->first('StoreType.name')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="StoreType.name" placeholder="Enter a store type name" />
                </x-input.group>
            </x-form.form>
        </x-slot>
    </x-core.card>
</x-core.container>