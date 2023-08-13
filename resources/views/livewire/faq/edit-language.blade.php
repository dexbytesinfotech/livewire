@section('page_title')
    @lang("components/faq.edit_page_title")  ({{ $languages }})
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
            <x-form.form submitText="Update FAQ" submit-target="editTranslate" cancel-route="{{ route('faq-management') }}">

                {{-- Input-group --}}
                <x-input.group colspan="col-12" for="title" label="Title *" :error="$errors->first('faq.title')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="faq.title" placeholder="Enter a Title" />
                </x-input.group>

                <x-input.group colspan="col-12" for="descriptions" label="Description *" :error="$errors->first('faq.descriptions')">
                    {{-- Rech text --}}
                    <x-input.rich-text wire:model.lazy="faq.descriptions">
                        {!! $faq->descriptions !!}
                    </x-input.rich-text>
                </x-input.group>


            </x-form.form>
        </x-slot>
    </x-core.card>
</x-core.container>


