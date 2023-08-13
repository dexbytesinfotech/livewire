@section('page_title')
    @lang("components/pages.add_page_title")
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
            <x-form.form submitText="Create Page" submit-target="store" cancel-route="{{ route('page-management') }}">

                {{-- Input-group --}}
                <x-input.group colspan="col-12" for="title" label="Title *" :error="$errors->first('title')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="title" placeholder="Enter a page title" />
                </x-input.group>

                <x-input.group colspan="col-12" for="content" label="Content *" :error="$errors->first('content')">
                    {{-- Rech text --}}
                    <x-input.rich-text wire:model.lazy="content">
                        {{ $content }}
                    </x-input.rich-text>
                </x-input.group>

                <x-input.group colspan="col-12" for="status" label="Select Status" :error="$errors->first('status')">
                    <x-input.select class="form-control" wire:model="status" id="status" onfocus="focused(this)" onfocusout="defocused(this)"
                        placeholder="Choose a status">
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                        <option value="unpublished">Unpublished</option>
                    </x-input.select>
                </x-input.group>

            </x-form.form>
        </x-slot>
    </x-core.card>
</x-core.container>


