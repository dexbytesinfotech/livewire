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
                    <h5>Add Category</h5>
                </div>
                <div class="card-body pt-0">

                    <form wire:submit.prevent="store" 
                         enctype="multipart/form-data">

                        <div class="row ">
                            <div class="col-12  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Name *</label>
                                    <input wire:model.lazy="name" type="text" class="form-control" placeholder="Enter a Name">
                                </div>
                                @error('name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-12  mb-5">
                                <div class="input-group input-group-static">
                                    <label>Description *</label>
                                    <div wire:ignore class="h-200 m-2 me-1 ms-auto w-100">
                                        <div x-data x-ref="quill" x-init="quill = new Quill($refs.quill, {theme: 'snow',});
                                                quill.on('text-change', function () {
                                                $dispatch('quill-text-change', quill.root.innerHTML);
                                               });"
                                            x-on:quill-text-change.debounce.200ms="@this.set('description', $event.detail)">
        
                                            {!! $description !!}
                                        </div>
                                    </div>
                                </div>
                                @error('description')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>        
                            <div class="col-12 mb-2">
                                <div class="form-group">                                    
                                    <div class="form-check">
                                        <input wire:model="status" class="form-check-input" type="checkbox"  id="flexCheckFirst">
                                        <label class="form-check-label">Status</label>
                                     </div>
                                </div>
                                @error('status')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>  
                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                <div class="avatar avatar-xl m-2 position-relative rounded-circle">
                                    <div class="position-relative preview">
                                        <label> Image *</label>
                                        <label for="file-input"
                                            class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="" aria-hidden="true" data-bs-original-title="Select Image"
                                                aria-label="Select Image"></i><span class="sr-only">Select Image</span>
                                        </label>
                                        <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100 ">
                                            @if ($image)
                                            <img src="{{ $image->temporaryUrl() }}" alt="Profile Photo">

                                            @else
                                            <img src="{{ asset('assets') }}/img/default-food-avatar.jpg" alt="avatar">
                                            @endif</span>
    
                                        <input wire:model="image" type="file" id="file-input">
                                    </div>
                                </div>
                                </div>
                                @error('image')
                                <p class='text-danger inputerror m-3 ms-0'>{{ $message }} </p>
                                @enderror
                            </div>    

                        </div>
        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mt-4">
                                    <a  href="{{ route('product-category-management') }}" class="btn btn-light m-0">Cancel</a>
                                    <button type="submit" name="submit" class="btn bg-gradient-dark m-0 ms-2">Create
                                        Category</button>
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
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/quill.min.js"></script>
@endpush