@section('page_title')
    Store Details
@endsection
<div class="container-fluid my-3 py-3">
    <div class="row mb-5">
    
        @if(env('GOOGLE_MAP_KEY') == '')
            <div class="col-lg-10 col-10 mx-auto position-relative">
                <div class="row mb-5 text-center">
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning! </strong>Get the coordinates of a stores, You will need to set your API Key. <a class="btn-link">Set Google API Key now</a>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-lg-3">
            <div class="card position-sticky top-1">
                <ul class="nav flex-column bg-white border-radius-lg p-3">
                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#profile">
                            <i class="material-icons text-lg me-2">person</i>
                            <span class="text-sm">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#basic-info">
                            <i class="material-icons text-lg me-2">receipt_long</i>
                            <span class="text-sm">Basic Info</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#commission-info">
                            <i class="material-icons text-lg me-2">payments</i>
                            <span class="text-sm">Commission Settings</span>
                        </a>
                    </li>

                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#address-info">
                            <i class="material-icons text-lg me-2">location_on</i>
                            <span class="text-sm">Address</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#accounts">
                            <i class="material-icons text-lg me-2">badge</i>
                            <span class="text-sm">Accounts</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#bussinessHours">
                            <i class="material-icons text-lg me-2">settings_applications</i>
                            <span class="text-sm">Bussiness Hours</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#delete">
                            <i class="material-icons text-lg me-2">delete</i>
                            <span class="text-sm">Delete Account</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#suspended">
                            <i class="material-icons text-lg me-2">person_off</i>
                            <span class="text-sm">Account Suspended</span>
                        </a>
                    </li>

                    
                </ul>
            </div>
        </div>

        <div class="col-lg-9 mt-lg-0 mt-4">

            <!-- Card Profile -->
            <div class="card card-body" id="profile">
                <div class="row align-items-center">
                    @error('logo_path')
                    <p class='text-danger'>{{ $message }} </p>
                    @enderror
                    <div class="col-sm-auto col-4">
                          
                            <div class="avatar avatar-xl position-relative preview">
                                @if($logo_path)
                                <img src="{{ $logo_path->temporaryUrl() }}" class="w-100 rounded-circle shadow-sm"
                                    alt="Profile Photo">
                                @elseif ($store->logo_path)
                                <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($store->logo_path)}}" alt="avatar"
                                    class="w-100 rounded-circle shadow-sm">
                                @else
                                <img src="{{ asset('assets') }}/img/default-avatar.png" alt="avatar"
                                    class="w-100 rounded-circle shadow-sm">
                                @endif
 
                                <label for="file-input" 
                                    class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                    <i wire:loading.remove class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        aria-hidden="true" data-bs-original-title="Edit Image"
                                        aria-label="Edit Image"></i>
                                        <span class="sr-only">Edit Image</span>

                                    <div wire:loading wire:target="logo_path">
                                        <x-spinner></x-spinner>
                                    </div>

                               </label>

                               <input wire:model='logo_path' wire:loading.attr="disabled" type="file" id="file-input">
                            </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="h-100">
                            <h5 class="mb-1 font-weight-bolder">
                                {{ $store->name }} 
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                + {{ $store->phone }}
                            </p>
                        </div>
                    </div>
                </div>
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
      
        <!-- Card Basic Info -->
    <form wire:submit.prevent="update">

        <div class="card mt-4" id="basic-info">
            <div class="card-header">
                <h5>Basic Info</h5>
            </div>
            <div class="card-body pt-0">               
                    <div class="row">
                        <div class="col-6 mb-4">
                            <div class="input-group input-group-static">
                                <label>Name *</label>
                                <input wire:model.lazy="store.name" type="text" class="form-control" placeholder="Enter a Name">
                            </div>
                            @error('store.name')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-6 mb-4">
                            <div class="input-group input-group-static">
                                <label>Store Type *</label>
                                <select class="form-control input-group input-group-dynamic" wire:model.lazy="store.store_type"  id="projectName" onfocus="focused(this)" onfocusout="defocused(this)">
                                    <option value=''>Choose Your Store Type</option>
                                    @foreach ($store_type as $value)
                                    <option value="{{ $value['name'] }}">{{ $value['name']}}</option>
                                    @endforeach
                                 </select>
                            </div>
                            @error('store.store_type')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                       
                      <div class="row">
                        <div class="col-2  mb-4">
                            <div class="input-group input-group-static">
                                <label>Country Code *</label>
                                <select class="form-control input-group input-group-dynamic" wire:model.lazy="store.country_code" id="countryCode" onfocus="focused(this)" onfocusout="defocused(this)">
                                   <option value = '' selected>Select</option>
                                        @foreach ($countries  as $countryValue)
                                            <option value="{{ $countryValue['country_code'] }}">{{ $countryValue['country_code']}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            @error('store.country_code')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                                
                        <div class="col-4  mb-4">
                            <div class="input-group input-group-static">
                                <label>Phone *</label>
                                <input wire:model.lazy="store.phone" type="text" class="form-control" placeholder="Enter a Phone Number">
                            </div>
                            @error('store.phone')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div> 

                        <div class="col-6  mb-4">
                            <div class="input-group input-group-static">
                                <label>Email *</label>
                                <input wire:model.lazy="store.email" type="text" class="form-control" placeholder="Enter a email">
                            </div>
                            @error('store.email')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div> 
                      </div> 
                                           
                    <div class="row">
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
                   
            </div>
        </div> 


          <!-- commission info Time -->
          <div class="card mt-4" id="commission-info">
            <div class="card-header">
                <h5>Commission Settings</h5>
            </div>
            <div class="card-body pt-0">                
                <div class="row">

                    <div class="col-12  mb-4">
                    
                        <div class="form-check">
                            <input  wire:loading.attr="disabled"  wire:model.lazy="is_global_commission" class="form-check-input" type="checkbox"  id="is_global_commission">
                            <label class="form-check-label" for="is_global_commission">
                                Enable Global Commission
                            </label>
                        </div>
                    </div>

                    @if(!$is_global_commission)
                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>Commission (In {{$store->commission_type}}) *</label>
                                <input wire:model.lazy="commission_value" type="text" class="form-control" placeholder="Enter {{$store->commission_type}}">
                            </div>
                            @error('commission_value')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    @endif    
                
                </div>
            </div>
        </div> 



         <!-- Card Address Info -->
        <div class="card mt-4" id="address-info">
            <div class="card-header">
                <h5>Store Address</h5>
            </div>
            <div class="card-body pt-0">                 
                    <div class="row">
                        <div class="col-12  mb-4">
                            <div  class="input-group input-group-static">
                                <label>Address *</label>
                                <input wire:model.lazy="storeAddress.address_line_1"  type="text" class="form-control" placeholder="Enter a Address">
                            </div>
                            @error('storeAddress.address_line_1')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div> 

                        <div class="col-6 mb-4">
                            <div class="input-group input-group-static">
                                <label>Landmark (GPS Coordinates)*</label>
                                <input wire:model.lazy="storeAddress.landmark" type="text"  id="googleMapAutocomplete"  class="form-control" placeholder="Enter a Landmark">
                                <input wire:model.lazy='storeAddress.latitude' type="hidden" id="latitude" class="form-control">
                                <input wire:model.lazy='storeAddress.longitude' type="hidden"  id="longitude" class="form-control">
                            </div>
                            @if($storeAddress->latitude && $storeAddress->longitude)
                                <p class='text-info inputerror'>Latitude: {{$storeAddress->latitude}}, Longitude: {{$storeAddress->longitude}}</p>
                            @endif
                            @error('storeAddress.landmark')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                        
                        <div class="col-6 mb-4">
                            <div class="input-group input-group-static">
                                <label> Zip Post Code *</label>
                                <input wire:model.lazy="storeAddress.zip_post_code" type="text" class="form-control" placeholder="Enter a Zip Post Code">
                            </div>
                            @error('storeAddress.zip_post_code')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div> 

                        <div class="col-4  mb-4">
                            <div class="input-group input-group-static">
                                <label >Country *</label>
                                <select class="form-control input-group input-group-dynamic"  wire:model.lazy="storeAddress.country"  wire:change="$emit('updatedCountry')" id="countryName" onfocus="focused(this)" onfocusout="defocused(this)">
                                    <option value = '' selected>Select</option>

                                    @foreach ($countries  as $countryValue)
                                        <option value="{{ $countryValue['id'] }},{{ $countryValue['name'] }}">{{ $countryValue['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('storeAddress.country')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>       
                        
                        <div class="col-4  mb-4">
                            <div class="input-group input-group-static">
                                <label>State *</label>
                                <select class="form-control input-group input-group-dynamic" wire:loading.attr="disabled"  wire:model.lazy="storeAddress.state" wire:change="$emit('updatedState')"  id="stateName" onfocus="focused(this)" onfocusout="defocused(this)">
                                    <option>Select State</option>  
                                    @foreach ($states  as $stateValue)
                                        <option value="{{ $stateValue['id'] }},{{ $stateValue['name'] }}">{{ $stateValue['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('storeAddress.state')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>   
                        
                        <div class="col-4  mb-4">
                            <div class="input-group input-group-static">
                                <label>City *</label>
                                <select class="form-control input-group input-group-dynamic"  wire:loading.attr="disabled"  wire:model.lazy="storeAddress.city" id="cityName">
                                    <option>Select City</option>  
                                    @foreach ($cities as $cityValue)
                                        <option value="{{ $cityValue['name'] }}">{{ $cityValue['name']}}</option>
                                    @endforeach
                                    </select>
                            </div>
                            @error('storeAddress.city')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>    
                    </div>
                </div>
        </div> 

        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-end mt-4">
                    <button  type="submit" name="submit"  class="btn bg-gradient-dark m-0 ms-2">
                        <span wire:loading.remove wire:target="update"> Update</span>
                        <span wire:loading wire:target="update"><x-buttonSpinner></x-buttonSpinner></span>
                    </button>
                </div>
            </div>
        </div>

        </form>

        <!-- Card Accounts -->
        <div class="card mt-4" id="accounts">
            <div class="card-header">
                <div class="row">
                    <div class="col col-6">
                        <h5>Accounts</h5>                      
                    </div>
                    <div class="col col-6 text-end">
                        <button type="button" class="btn bg-gradient-dark mb-0 me-4" data-bs-toggle="modal" data-bs-target="#addModalProvider">
                            Add Provider
                        </button>                    
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading> ID
                        </x-table.heading>
                        <x-table.heading> Name
                        </x-table.heading> 
                        <x-table.heading>Phone Number
                        </x-table.heading>
                       <x-table.heading>Status
                        </x-table.heading>                      
                        <x-table.heading>
                            Creation Date
                        </x-table.heading>                        
                        <x-table.heading>Actions</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($accounts as $account)
                        <x-table.row wire:key="row-{{ $account->id }}">
                            <x-table.cell>{{ $account->user->id }}</x-table.cell>
                            <x-table.cell><a href="{{ route('view-user',  $account->user) }}">{{ $account->user->name }}</a></x-table.cell>     
                            <x-table.cell><a href="{{ route('view-user',  $account->user) }}">{{ $account->user->phone }}</a></x-table.cell>
                            
                            <x-table.cell><div class="form-check form-switch ms-3">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault35"  wire:change="statusAccountUpdate({{ $account->user->id }}, {{ $account->user->status}})"
                                    @if($account->user->status) checked="" @endif>
                            </div>
                            </x-table.cell>                            
                            <x-table.cell>{{ $account->created_at }}</x-table.cell>
                            <x-table.cell>
                                <a  href="javascript:void(0)"  wire:click="destroyOwnerConfirm({{ $account->id }})">
                                <span class="material-symbols-outlined" >
                                delete
                                </span>
                                </a>
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                @if(empty($accounts))
                    <div>
                        <p class="text-center">No account assign to store!</p>
                    </div> 
                @endif
            </div>
        </div> 



        <!-- Card Business Hours -->
        <div class="card mt-4" id="bussinessHours">
            <div class="card-header">
                <h5>Bussiness Hours</h5>
            </div>
            <div class="card-body pt-0">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading> Day
                        </x-table.heading>
                        <x-table.heading> Open
                        </x-table.heading> 
                        <x-table.heading>Opening time
                        </x-table.heading>
                       <x-table.heading>Closing Time
                        </x-table.heading> 
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($bussinessHours as $mainKey => $bussiness)
                        <x-table.row >
                            <x-table.cell>{{ ucfirst($bussiness['days']) }}</x-table.cell>
                            <x-table.cell> 
                                <div class="form-group">                                    
                                    <div class="form-check">
                                        <input  wire:click="editBussinessHour({{$mainKey}})" class="form-check-input"  wire:loading.attr="disabled"  wire:model.lazy="bussinessHours.{{$mainKey}}.status"  type="checkbox">
                                     </div>
                                </div>
                            </x-table.cell>  
                            <x-table.cell class="text-center">
                                <div class="input-group input-group-static mb-1 text-center"> 
                                    <select wire:change="changeOpeningTime({{$mainKey}},$event.target.value)" wire:model.lazy="bussinessHours.{{$mainKey}}.opening_time"  class="form-control" id="OpeningTime">
                                      @foreach ($timeOptionsList as $openingKey => $openingTime)
                                        <option  value="{{$openingKey}}" class="text-center">{{$openingTime}}</option>
                                      @endforeach
                                    </select>
                                    @error('bussinessHours.'.$mainKey.'.opening_time')
                                        <p  class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </x-table.cell>
                            <x-table.cell> 
                                <div class="input-group input-group-static mb-1 text-center"> 
                                    <select wire:change="changeClosingTime({{$mainKey}},$event.target.value)" wire:model.lazy="bussinessHours.{{$mainKey}}.closing_time"   class="form-control" id="OpeningTime">
                                        @foreach ($timeOptionsList as $closingKey => $closingTime)
                                            <option value="{{$closingKey}}" class="text-center" >{{$closingTime}}</option>
                                        @endforeach
                                </select>
                                 @error('bussinessHours.'.$mainKey.'.closing_time')
                                        <p style="width:40px" class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            </x-table.cell>
                         </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                
            </div>
        </div> 

            <!-- Card Delete Account -->
            <div class="card mt-4" id="delete">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-sm-0 mb-4">
                        <div class="w-50">
                            <h5>Delete Account</h5>
                            <p class="text-sm mb-0">Once you delete this account, there is no going back. Please
                                be certain.</p>
                        </div>
                        <div class="w-50 text-end">
                            <button  wire:loading.attr="disabled"  class="btn bg-gradient-danger mb-0 ms-2" type="button" name="button" wire:click="destroyConfirm({{ $store->id }})">Delete
                                Account</button>
                        </div>
                    </div>
                </div>
            </div>
            
             <!-- Card Delete Account -->
            <div class="card mt-4" id="suspended">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-sm-0 mb-4">
                        <div class="w-50">
                            <h5>Account Suspended</h5>
                            <p class="text-sm mb-0">Once you suspended this account, It means that the store has remove temporarily.</p>
                        </div>
                        <div class="w-50 text-end">
                            <button  wire:loading.attr="disabled"  class="btn bg-gradient-{{ $store->application_status == 'suspended' ? 'success' : 'warning' }} mb-0 ms-2" type="button" name="button" wire:click="suspendedConfirm({{ $store }})">{{ $store->application_status == 'suspended' ? 'Re-Active Account' : 'Account suspended' }}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <!-- Modal -->

<div wire:ignore.self class="modal fade" id="addModalProvider" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-m modal-dialog-scrollable " role="document">
        
    <div  class="modal-content">
        <div class="card-header pb-0 text-left">
            <h5 class="">Add provider</h5>
            <p class="mb-0">Find a providers are not associated with stores.</p>
        </div>
        <div class="modal-body p-0">
        <div class="card card-plain">            
            <div class="card-body pb-3">    

                <div class="input-group input-group-outline my-3 focused is-focused">
                    <label class="form-label">Search Provider</label>
                    <input type="text" wire:model="search"  id ="search" placeholder="Search by Name, Mobile Number"  class="form-control">
                </div>  
 
                @if($search != '')
                  @if(!empty($searchResultProviders))
                        @foreach ($searchResultProviders as $spKey => $searchProviders) 
                            <ul class="list-group list-group-flush list my--3">
                                <li style="cursor: pointer;" class="list-group-item px-0 border-0" wire:click="selectedUser({{ $searchProviders->id }})">
                                    <div class="row align-items-center searchResult">
                                        <div class="col-auto">                                            
                                            @if($selected_user_id == $searchProviders->id)
                                                <span class="material-symbols-outlined text-success">
                                                    check_circle
                                                </span>
                                            @else
                                                <span class="material-symbols-outlined">
                                                    radio_button_unchecked
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col">
                                            <h6 class="text-sm font-weight-normal mb-0 searchProviders">{{ $searchProviders->name }}</h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                  @endif
                    @if($searchResultProviders->count() == 0)
                        <p class="text-sm text-center">
                            No record matched!
                        </p>
                    @endif
                @endif              
             </div>
           </div>
        </div>
        <div class="modal-footer">
            <button type="button"  wire:loading.attr="disabled"  wire:click.prevent="resetField()" class="btn btn-light " data-bs-dismiss="modal">Close</button>
            <button type="button"  wire:loading.attr="disabled"  class="btn bg-gradient-dark submit" id="submitProvider" @if(!$selected_user_id) disabled @endif wire:click="$emit('providerSubmit')" >Submit</button>
        </div>
    
        </div>
    </div>
    </div>
</div>

    
</div>




@push('js') 


<script type="text/javascript">
        $(document).ready(function() {
            $('#submitProvider').on('click',function(){
                    $('#addModalProvider').modal('hide');
            });
        });
</script>
 
@endpush
 
