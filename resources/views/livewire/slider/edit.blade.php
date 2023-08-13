{{-- Page Title --}}
@section('page_title')
    @lang("components/slider.edit_slider_title")
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

        {{-- Card Header --}}
        <x-slot name="header">
            Slider Info
        </x-slot>
        {{-- Card Body --}}
        <x-slot name="body">
            {{-- Form --}}
            <x-form.form submitText="update slider" submit-target="edit" cancel-route="{{ route('slider-management') }}">

                {{-- Input-group --}}
                <x-input.group colspan="col-12" for="name" label="Name *" :error="$errors->first('slider.name')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="slider.name" placeholder="Enter a slider" />
                </x-input.group>

                <x-input.group colspan="col-12" for="description" label="Description *" :error="$errors->first('slider.description')">
                    {{-- Rech text --}}
                    <x-input.rich-text wire:model.lazy="slider.description">
                        {!! $slider->description !!}
                    </x-input.rich-text>
                </x-input.group>

                <x-input.group colspan="col-6 mt-4" for="from_date" label="Start Date Time *" :error="$errors->first('slider.start_date_time')">
                    {{-- Rech text --}}
                    <x-input.date id="from_date" wire:model.lazy="slider.start_date_time" placeholder="Enter a Start Date Time"/>
                </x-input.group>
                
                <x-input.group colspan="col-6 mt-4" for="to_date" label="End Date Time *" :error="$errors->first('slider.end_date_time')">
                    {{-- Rech text --}}
                    <x-input.date id="to_date" wire:model.lazy="slider.end_date_time" placeholder="Enter a End Date Time"/>
                </x-input.group>
                

                <x-input.group inline colspan="col-12" for="is_default" label="Is Default *" :error="$errors->first('slider.is_default')">
                    {{-- Input text --}}
                    <x-input.checkbox wire:model.lazy="slider.is_default" />
                </x-input.group>


            </x-form.form>
        </x-slot>
    </x-core.card>


    <x-core.card class="col-lg-9 mt-4 col-12 p-3 mx-auto position-relative">
        {{-- Card Header --}}
        <x-slot name="header">
            Slider Image
        </x-slot>
        {{-- Card Body --}}
        <x-slot name="body">
            <div class="d-flex justify-content-end me-3 mt-sm-n6">
                <x-button.bg-gradient-dark wire:click="resetInputFields" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add
                </x-button.bg-gradient-dark>
            </div>

            <x-table>
                <x-slot name="head">
                    <x-table.heading>ID
                    </x-table.heading>                        
                    <x-table.heading>Image
                    </x-table.heading>
                    <x-table.heading>Status
                    </x-table.heading>
                    <x-table.heading>Created At
                    </x-table.heading>
                    <x-table.heading>Actions</x-table.heading>
                
                </x-slot>
                    
                <x-slot name="body">
                    @foreach ($sliderImage as $slider)
                    <x-table.row  wire:key="row-{{$slider['id']}}">  
                        <x-table.cell>{{ $slider['id'] }}</x-table.cell>
                        <x-table.cell>
                            <div class="d-flex">
                                <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($slider['image']) }} " alt="picture"
                                    class="w-10 ms-3 shadow-sm">
                            </div>
                        </x-table.cell>
                        <x-table.cell>
                            <div class="form-check form-switch ms-3">
                                <input class="form-check-input"  type="checkbox" id="flexSwitchCheckDefault35"  wire:change="statusUpdate({{$slider['id'] }},{{$slider['status']}})"
                                    @if($slider['status']) checked="" @endif>
                            </div>
                        </x-table.cell>
                        <x-table.cell>{{ $slider['created_at']}}</x-table.cell>
                        <x-table.cell>    
                           <div class="dropdown dropup dropleft">
                                <a class="btn " data-original-title="Remove" title="Remove" wire:click="destroyConfirm({{$slider['id'] }})"> <span class="material-symbols-outlined">
                                delete
                                </span></a> 
                            </div>
                        </x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
            @if(count($sliderImage) == 0) 
                <p class="text-center">No Slider Images</p>
            @endif
        </x-slot>
    </x-core.card>
    <x-modal>
        <x-slot name="title">
            Add New Slider Image
        </x-slot>
        <x-slot name="content">
            <div class="avatar avatar-xl m-2 position-relative">
                <div class="position-relative preview">
                    <label>Image</label>
                    <label for="file-input"
                        class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                        <i wire:loading.remove class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="" aria-hidden="true" data-bs-original-title="Select Image"
                            aria-label="Select Image"></i><span class="sr-only">Select Image</span>
                            <div wire:loading wire:target="image">
                                <x-spinner></x-spinner>
                            </div>
                    </label>
                    <span class="h-9 w-16 overflow-hidden bg-gray-100 ">
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" alt="Profile Photo">
                        @else
                            <img src="{{ asset('assets') }}/img/default-food-avatar.jpg" alt="avatar">
                        @endif</span>
                        <input  wire:loading.attr="disabled" wire:model="image" type="file" id="file-input">
                </div>
            </div>
    
            @error('image')
                <p class='text-danger inputerror m-3 ms-0'>{{ $message }} </p>
            @enderror
    
             <p class="mt-4">(Recommended dimensions 16:9 ratio)</p>
    
        </x-slot>
        <x-slot name="footer">
            <x-button.light data-bs-dismiss="modal">Cancel</x-button.light>
            <x-button.bg-gradient-dark  wire:click.prevent='storeImage()' id="storeImage" class="close-modal">Save</x-button.bg-gradient-dark>
        </x-slot>
    </x-modal>
</x-core.container>

@push('js')
<script src="{{ asset('assets') }}/js/plugins/flatpickr.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        window.addEventListener('closeModal', function (event) {
            $('#exampleModal').modal('hide');
        });
    });   
</script>
@endpush


