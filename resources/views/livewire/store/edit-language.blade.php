@section('page_title')
    Edit Store ({{ $languages }})
@endsection
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
                <div class="card-body pt-5">
                    <form wire:submit.prevent="editTranslate">

                        <div class="row ">
                            <div class="col-12  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Name *</label>
                                    <input wire:model.lazy="store.name" type="text" class="form-control" placeholder="Enter a Name">
                                </div>
                                @error('store.name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Store Type *</label>
                                    <select class="form-control input-group input-group-dynamic" wire:model.lazy="store.store_type"  id="projectName" onfocus="focused(this)" onfocusout="defocused(this)">
                                        <option value=''>Choose Your Store Type</option>
                                        @foreach ($store_type as $value)
                                        <option value="{{ $value->translate($lang)->name }}"> {{ $value->translate($lang)->name}}</option>
                                        @endforeach
                                     </select>
                                </div>
                                @error('store.store_type')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>    

                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Description *</label>
                                    <div wire:ignore class="h-200 m-1  mb-5  me-1 ms-auto w-100">
                                        <div x-data x-ref="quill" x-init="quill = new Quill($refs.quill, {theme: 'snow',});
                                                quill.on('text-change', function () {
                                                $dispatch('quill-text-change', quill.root.innerHTML);
                                                });"
                                            x-on:quill-text-change.debounce.200ms="@this.set('store.descriptions', $event.detail)">
        
                                            {!! $store->descriptions !!}
                                        </div>
                                    </div>
                                </div>
                                @error('store.descriptions')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>  
                        </div>
        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mt-4">
                                    <a  href="{{ route('store-management') }}" class="btn btn-light m-0">Cancel</a>
                                    <button type="submit" name="submit"  class="btn bg-gradient-dark m-0 ms-2">Update Store</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
 
        </div>
    </div>
</div>

