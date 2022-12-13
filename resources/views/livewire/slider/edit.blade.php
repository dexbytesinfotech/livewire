 
<div class="container-fluid py-4 bg-gray-200 ">
    <div class="row mb-5">
        <div class="col-lg-9 col-12 mx-auto position-relative">
           
            <!-- Card Basic Info -->
            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Edit Slider</h5>
                </div>
               
                <div class="card-body pt-0">
                    <form wire:submit.prevent="edit">
                                <div class="row mt-3">
                                    <div class="col-12 mb-4">
                                        <div class="input-group input-group-static">
                                            <label>Name *</label>
                                            <input wire:model.lazy="slider.name" class="multisteps-form__input form-control" type="text" placeholder="Enter a name" />
                                        </div>
                                        @error('slider.name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <div class="col-12 mt-3 mt-sm-0">
                                        <div class="input-group input-group-static">
                                            <label> Description *</label>
                                            <div wire:ignore class="m-2 me-1 ms-auto w-100">
                                                <div x-data x-ref="quill" x-init="quill = new Quill($refs.quill, {theme: 'snow',});
                                                        quill.on('text-change', function () {
                                                        $dispatch('quill-text-change', quill.root.innerHTML);
                                                    });"
                                                    x-on:quill-text-change.debounce.2000ms="@this.set('slider.description', $event.detail)">
                
                                                    {!! $slider->description !!}
                                                </div>
                                            </div>
                                        </div>
                                        @error('slider.description')
                                        <p class='text-danger inputerror mt-5'>{{ $message }} </p>
                                        @enderror
                                    </div>  
                                </div>
                            
                                <div class="row mt-6">
                                    <div class="col-12 col-sm-6">
                                        <div class="input-group input-group-static" wire:ignore x-data x-init="flatpickr($refs.picker, {allowInput: false ,enableTime: 'true',
                                        dateFormat: 'Y-m-d H:i'});">
                                            <label>Start Date Time *</label>
                                            <input wire:model.lazy="slider.start_date_time"  x-ref="picker" class="form-control" type="text" placeholder="Enter a Start Date Time" />
                                        </div>
                                        @error('slider.start_date_time')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="input-group input-group-static" wire:ignore x-data x-init="flatpickr($refs.picker, {allowInput: false , enableTime: 'true',
                                        dateFormat: 'Y-m-d H:i'});">
                                                <label>End Date Time *</label>
                                                <input wire:model.lazy="slider.end_date_time"  x-ref="picker" class="form-control" type="text" placeholder="Enter a End Date Time" />
                                        </div>
                                    
                                        @error('slider.end_date_time')
                                         <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-sm-6 mt-4">
                                        <div class="input-group input-group-static">
                                            <div class="form-check form-switch ms-3">
                                                <label>Is Default</label>
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault35" wire:model="slider.is_default">
                                            </div>
                                            @error('slider.is_default')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>                              
                            
                                <div class="row  mt-4">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end mt-4">
                                            <a  href="{{ route('slider-management') }}" class="btn btn-light m-0">Cancel</a>
                                        <button type="submit" name="submit"  class="btn bg-gradient-dark m-0 ms-2">Update
                                                Slider</button>
                                        </div>
                                    </div>
                                </div>
                    </form>   
                </div>     
            </div>

            
            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Slider Image</h5>
               </div>                
                <div class="card-body px-0 pb-0">
                    <div class="d-flex justify-content-end me-3 mt-sm-n6"><button  type="button" class="btn bg-gradient-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD</button></div>
                </div>
                @if (session('status'))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-success alert-dismissible text-white mt-3" role="alert">
                            <span class="text-sm">{{ Session::get('status') }}</span>
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif
        
                <x-table>
                    <x-slot name="head">
                        <x-table.heading>SNO
                        </x-table.heading>                        
                        <x-table.heading>Image
                        </x-table.heading>
                        <x-table.heading>Status
                        </x-table.heading>
                        <x-table.heading>Created At
                        </x-table.heading>
                        <x-table.heading>Actions</x-table.heading>
                    
                    </x-slot>
                        
                    <x-slot  name="body">
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
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault35"  wire:change="statusUpdate({{$slider['id'] }},{{ $slider['status']}})"
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
            </div>
        </div>

            <!--Modal -->
        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">                        
                <div wire:poll.visible class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Slider Image</h5>
                    </div>
                    <div class="modal-body ms-6">
                        
                        <div class="avatar avatar-xl m-2 position-relative  ">
                            <div class="position-relative preview">
                                <label>Image</label>
                                <label for="file-input"
                                    class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                    <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="" aria-hidden="true" data-bs-original-title="Select Image"
                                        aria-label="Select Image"></i><span class="sr-only">Select Image</span>
                                </label>
                                <span class="h-9 w-16 overflow-hidden bg-gray-100 ">
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" alt="Profile Photo">
                                    @else
                                        <img src="{{ asset('assets') }}/img/default-food-avatar.jpg" alt="avatar">
                                    @endif</span>
                                    <input wire:model="image" type="file" id="file-input">
                            </div>
                        </div>
                        @error('image')
                            <p class='text-danger inputerror m-3 ms-0'>{{ $message }} </p>
                        @enderror

                         <p class="mt-4">(Recommended dimensions 16:9 ratio)</p>
                        </div> 
                           
                      
                        <div class="modal-footer mt-2">
                            <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
                            <button type="button"  wire:click.prevent='storeImage()' class="btn bg-gradient-dark" data-dismiss="modal">Save changes</button>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
</div>
 
@push('js')
<script src="{{ asset('assets') }}/js/plugins/flatpickr.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/quill.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
@endpush
