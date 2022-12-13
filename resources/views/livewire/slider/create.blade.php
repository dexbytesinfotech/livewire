<div class="container-fluid py-4 bg-gray-200">
    <div class="row mb-5">
        <div class="col-lg-9 col-12 mx-auto position-relative">
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
           
            <!-- Card Basic Info -->
            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Add Slider</h5>
                </div>
                <div class="card-body pt-0">
                    <form wire:submit.prevent="store">
                        <div class="row mt-3">
                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Name *</label>
                                    <input wire:model.lazy="name" class="multisteps-form__input form-control" type="text" placeholder="Enter a name" />
                                </div>
                                @error('name')
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
                                            x-on:quill-text-change.debounce.2000ms="@this.set('description', $event.detail)">
        
                                            {!! $description !!}
                                        </div>
                                    </div>
                                </div>
                                @error('description')
                                <p class='text-danger inputerror mt-5'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-6">
                            <div class="col-12 col-sm-6">
                                <div class="input-group input-group-static" wire:ignore x-data x-init="flatpickr($refs.picker, {allowInput: false, enableTime: 'true',
                                dateFormat: 'Y-m-d H:i'});">
                                    <label>Start Date Time *</label>
                                    <input wire:model.lazy="start_date_time"  x-ref="picker" class="form-control" type="text" placeholder="Enter a Start Date Time" />
                                </div>
                                @error('start_date_time')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="input-group input-group-static " wire:ignore x-data x-init="flatpickr($refs.picker, {allowInput: false,enableTime: 'true',
                                    dateFormat: 'Y-m-d H:i'});">
                                        <label>End Date Time *</label>
                                
                                        <input wire:model.lazy="end_date_time"  x-ref="picker" class="form-control flatpickr" type="text"  placeholder="Enter a End Date Time" />
                                </div>
                            
                                @error('end_date_time')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mt-4">
                                    <a  href="{{ route('slider-management') }}" class="btn btn-light m-0">Cancel</a>
                                <button type="submit" name="submit" class="btn bg-gradient-dark m-0 ms-2">Create
                                        Slider</button>
                                </div>
                            </div>
                        </div>
                    </form>   
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
