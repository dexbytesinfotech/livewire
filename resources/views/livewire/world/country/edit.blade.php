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
                    <h5 class="mb-0">Edit Country</h5>
                </div>
                <div class="card-body pt-0">
                    
                    <form wire:submit.prevent="edit">

                        <div class="row ">
                            <div class="col-12  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Name *</label>
                                    <input wire:model.lazy="country.name" type="text" class="form-control" placeholder="Enter a Country name">
                                </div>
                                @error('country.name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-12  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Country Code *</label>
                                    <input wire:model.lazy="country.country_code" type="text" class="form-control"
                                        placeholder="Enter a country code e.g. 1, 91, 966 etc..">
                                </div>
                                @error('country.country_code')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>  

                            <div class="col-12  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Country Iso Code *</label>
                                    <input wire:model.lazy="country.country_ios_code" type="text" class="form-control"
                                        placeholder="Enter a country ios code">
                                </div>
                                @error('country.country_ios_code')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>        
                            
                            <div class="col-12  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Nationality</label>
                                    <input wire:model.lazy="country.nationality" type="text" class="form-control"
                                        placeholder="Enter a Nationality">
                                </div>
                                @error('country.nationality')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>      
                            <div class="col-12">
                                <div class="form-group">
                                    
                                    <div class="form-check">
                                        <input wire:model="country.is_default" class="form-check-input" type="checkbox"  id="flexCheckFirst">
                                        <label class="form-check-label">Is Default</label>
                                     </div>
                                </div>
                                @error('country.is_default')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>   
                            <div class="col-12">
                                <div class="form-group ">
                                  
                                     <div class="form-check">
                                        <input wire:model="country.status" class="form-check-input" type="checkbox"  id="flexCheckFirst">
                                        <label class="form-check-label">Active</label>
                                     </div>
                                </div>
                                @error('country.status')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>    
                    

                        </div>
        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mt-4">
                                    <a  href="{{ route('country-management') }}" class="btn btn-light m-0">Cancel</a>
                                    <button type="submit" name="submit" class="btn bg-gradient-dark m-0 ms-2">Update Country
                                        </button>
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
@endpush
