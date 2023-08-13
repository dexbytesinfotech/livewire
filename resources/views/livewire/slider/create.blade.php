{{-- Page Title --}}
@section('page_title')
    @lang("components/slider.add_slider_title")
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
            <x-form.form submitText="create slider" submit-target="store" cancel-route="{{ route('slider-management') }}">

                {{-- Input-group --}}
                <x-input.group colspan="col-12" for="name" label="Name *" :error="$errors->first('name')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="name" placeholder="Enter a slider name" />
                </x-input.group>

                <x-input.group colspan="col-12" for="description" label="Description *" :error="$errors->first('description')">
                    {{-- Rech text --}}
                    <x-input.rich-text wire:model.lazy="description">
                        {{ $description }}
                    </x-input.rich-text>
                </x-input.group>

                <x-input.group colspan="col-6 mt-4" for="from_date" label="Start Date Time *" :error="$errors->first('start_date_time')">
                    {{-- Rech text --}}
                    <x-input.date id="from_date" wire:model.lazy="start_date_time" placeholder="Enter a Start Date Time"/>
                </x-input.group>

                <x-input.group colspan="col-6 mt-4" for="to_date" label="End Date Time *" :error="$errors->first('end_date_time')">
                    {{-- Rech text --}}
                    <x-input.date id="to_date" wire:model.lazy="end_date_time" placeholder="Enter a End Date Time"/>
                </x-input.group>


            </x-form.form>
        </x-slot>
    </x-core.card>
</x-core.container>


@push('js')
<script src="{{ asset('assets') }}/js/plugins/flatpickr.min.js"></script>

@endpush
