{{-- Page Title --}}
@section('page_title')
    @lang("components/slider.edit_slider_title") ({{ $languages }})
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
            <x-form.form submitText="Update Slider" submit-target="editTranslate" cancel-route="{{ route('slider-management') }}">

                {{-- Input-group --}}
                <x-input.group colspan="col-12" for="name" label="Name *" :error="$errors->first('slider.name')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="slider.name" placeholder="Enter a slider name" />
                </x-input.group>

                <x-input.group colspan="col-12" for="description" label="Description *" :error="$errors->first('slider.description')">
                    {{-- Rech text --}}
                    <x-input.rich-text wire:model.lazy="slider.description">
                        {!!  $slider->description !!}
                    </x-input.rich-text>
                </x-input.group>

            </x-form.form>
        </x-slot>
    </x-core.card>
</x-core.container>



