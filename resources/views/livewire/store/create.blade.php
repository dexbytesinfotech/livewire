
<div class="container-fluid py-4 bg-gray-200"> 
        @if(env('GOOGLE_MAP_KEY') == '')
            <div class="col-lg-10 col-10 mx-auto position-relative">
                <div class="row mb-5 text-center">
                    <div class="alert alert-warning" role="alert">
                    <strong>Warning! </strong>Get the coordinates of a stores, You will need to set your API Key. <a class="btn-link">Set Google API Key now</a>
                </div>
            </div>
        @endif
        
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
                    <h5>Add New Store</h5>
                </div>
                <div class="card-body pt-0">
                    <form wire:submit.prevent="store" enctype="multipart/form-data">
                        <div class="row ">

                            <div class="col-8 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Name *</label>
                                    <input wire:model.lazy="name" type="text" class="form-control" placeholder="Enter a Name">
                                </div>
                                @error('name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-4 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Store Type *</label>
                                    <select class="form-control input-group input-group-dynamic" wire:model.lazy="restaurant_type"  id="projectName" onfocus="focused(this)" onfocusout="defocused(this)">
                                        <option value=''>Choose Your Store Type</option>
                                        @foreach ($store_type as $value)
                                        <option value="{{ $value['name'] }}">{{ $value['name']}}</option>
                                        @endforeach
                                     </select>
                                </div>
                                @error('restaurant_type')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-2  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Country Code *</label>
                                    <select class="form-control input-group input-group-dynamic" wire:model.lazy="country_code" id="countryCode" onfocus="focused(this)" onfocusout="defocused(this)">
                                        <option value = '' selected>Select</option>
                                            @foreach ($countries  as $countryValue)
                                                <option value="{{ $countryValue['country_code'] }}">{{ $countryValue['country_code']}}</option>
                                            @endforeach
                                     </select>
                                </div>
                                @error('country_code')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                                    
                            <div class="col-4  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Phone *</label>
                                    <input wire:model.lazy="phone" type="text" class="form-control" placeholder="Enter a Phone Number">
                                </div>
                                @error('phone')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div> 

                            <div class="col-6  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Email *</label>
                                    <input wire:model.lazy="email" type="text" class="form-control" placeholder="Enter a email">
                                </div>
                                @error('email')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div> 
 
                            <div class="col-6 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Order Preparing Time (In Min) *</label>
                                    <input wire:model.lazy="order_preparing_time" type="text" class="form-control" placeholder="Enter Order Preparing Time e.g 15, 20, 30 etc..">
                                </div>
                                @error('order_preparing_time')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div> 

                            <div class="col-6 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Number Of Branch *</label>
                                    <input wire:model.lazy="number_of_branch" type="text" class="form-control" placeholder="Enter a Number Of Branch e.g 1, 2, 3 etc..">
                                </div>
                                @error('number_of_branch')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div> 

                            <div class="col-12  mb-4">
                                <div  class="input-group input-group-static">
                                    <label>Address *</label>
                                    <input wire:model.lazy="address_line_1"  type="text" class="form-control" placeholder="Enter a Address">
                                </div>
                                @error('address_line_1')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div> 

                            <div class="col-6 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Landmark (GPS Coordinates)*</label>
                                    <input wire:model.lazy="landmark" type="text"  id="googleMapAutocomplete"  class="form-control" placeholder="Enter a Landmark">
                                    <input wire:model.lazy='latitude' type="hidden" id="latitude" class="form-control">
                                    <input wire:model.lazy ='longitude' type="hidden"  id="longitude" class="form-control">
                                </div>
                                @if($latitude && $longitude)
                                    <p class='text-info inputerror'>Latitude: {{$latitude}}, Longitude: {{$longitude}}</p>
                                @endif
                                @error('landmark')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            
                            <div class="col-6 mb-4">
                                <div class="input-group input-group-static">
                                    <label> Zip Post Code *</label>
                                    <input wire:model.lazy="zip_post_code" type="text" class="form-control" placeholder="Enter a Zip Post Code">
                                </div>
                                @error('zip_post_code')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div> 

                            <div class="col-4  mb-4">
                                <div class="input-group input-group-static">
                                    <label >Country *</label>
                                    <select class="form-control input-group input-group-dynamic" wire:model.lazy="country" id="countryName" onfocus="focused(this)" onfocusout="defocused(this)">
                                        <option value='' selected>Choose Your Country</option>
                                            @foreach ($countries  as $countryValue)
                                                <option value="{{ $countryValue['id'] }},{{ $countryValue['name'] }}">{{ $countryValue['name']}}</option>
                                            @endforeach
                                     </select>
                                </div>
                                @error('country')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>       
                           
                            <div class="col-4  mb-4">
                                <div class="input-group input-group-static">
                                    <label>State *</label>  
                                    <select class="form-control input-group input-group-dynamic" wire:model.lazy="state" id="stateName" onfocus="focused(this)" onfocusout="defocused(this)">
                                        <option value=''selected>Choose Your State</option>
                                        @foreach ($states  as $stateValue)
                                        <option value="{{ $stateValue['id'] }},{{ $stateValue['name'] }}">{{ $stateValue['name']}}</option>
                                        @endforeach
                                     </select>
                                </div>
                                @error('state')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>   
                           
                            <div class="col-4  mb-4">
                                <div class="input-group input-group-static">
                                    <label>City *</label>
                                    <select class="form-control input-group input-group-dynamic" wire:model.lazy="city" id="cityName">
                                        <option value=''selected>Choose Your City</option>
                                        @foreach ($cities as $cityValue)
                                        <option value="{{ $cityValue['name'] }}">{{ $cityValue['name']}}</option>
                                        @endforeach
                                     </select>
                                </div>
                                @error('city')
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
                                            x-on:quill-text-change.debounce.200ms="@this.set('descriptions', $event.detail)">
        
                                            {!! $descriptions !!}
                                        </div>
                                    </div>
                                </div>
                                @error('descriptions')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>  

                            <div class="col-12 mb-4">
                                <div class="form-group">                                    
                                    <div class="form-check">
                                        <input wire:model="status" class="form-check-input" type="checkbox"  id="flexCheckFirst" value='0'>
                                        <label class="form-check-label">Status</label>
                                     </div>
                                </div>
                                @error('status')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>  

                            <div class="col-12 mb-6">
                                <div class="input-group input-group-static">
                                <div class="avatar avatar-xl m-2 position-relative rounded-circle">
                                    <div class="position-relative preview">
                                        <label>Logo *</label>
                                        <label for="file-input"
                                            class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="" aria-hidden="true" data-bs-original-title="Upload Image"
                                                aria-label="Select Image"></i><span class="sr-only">Upload Image</span>
                                        </label>
                                        <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100 ">
                                            @if ($logo_path)
                                                <img src="{{ $logo_path->temporaryUrl() }}" alt="Profile Photo">
                                            @else
                                                <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url('dummy/store.png')}}" alt="avatar">
                                            @endif</span>    
                                        <input wire:model="logo_path" type="file" id="file-input">

                                    </div>
                                </div>
                                </div>
                                @error('logo_path')
                                <p class='text-danger inputerror m-3 ms-0'>{{ $message }} </p>
                                @enderror
                            </div>    

                        </div>
        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mt-4">
                                    <a href="{{ route('store-management') }}" class="btn btn-light m-0">Cancel</a>
                                    <button type="submit" name="submit" class="btn bg-gradient-dark m-0 ms-2">Create
                                        Store</button>
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
 