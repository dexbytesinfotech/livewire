@section('page_title')
    @lang("components/device.edit_page_title")
@endsection

<x-core.container>

    {{-- loader
    <x-loder /> --}}

    {{-- Alert message - alert-success, examples- alert-danger, alert-warning, alert-primary  --}}
    @if (session('status'))
        <x-alert class="alert-success">{{ Session::get('status') }}</x-alert>
    @endif

    {{-- Card --}}
    <x-core.card class="col-lg-9 col-12 p-3 mx-auto position-relative">

        {{-- Card Body --}}
        <x-slot name="body">
            {{-- Form --}}
            <x-form.form submitText="Update Device" submit-target="edit" cancel-route="{{ route('device-management') }}">

                {{-- Input-group --}}
                <x-input.group colspan="col-12" for="device_name" label="Device Name *" :error="$errors->first('device.device_name')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="device.device_name" placeholder="Enter a Device Name" />
                </x-input.group>

                <x-input.group colspan="col-12" for="device_model_id" label="Device Model ID *" :error="$errors->first('device.device_model_id')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="device.device_model_id" placeholder="Enter a Device Model ID" />
                </x-input.group>

                <x-input.group colspan="col-12" for="note" label="Note " :error="$errors->first('device.note')">
                    <x-input.textarea cols="80" wire:model.lazy="device.note">{!! $device->note !!}
                    </x-input.textarea>
                </x-input.group>

                <x-input.group colspan="col-12 mt-4" for="status" label="Status *" :error="$errors->first('device.status')">
                    <x-input.select class="form-control" wire:model="device.status" id="status" onfocus="focused(this)" onfocusout="defocused(this)"
                        placeholder="Select a Status">
                        @foreach ($allStatus as $key => $value)
                            <option value="{{ $key }}"> {{ $value }} </option>
                        @endforeach
                    </x-input.select>
                </x-input.group>

            </x-form.form> 
        </x-slot>
    </x-core.card>
</x-core.container>



