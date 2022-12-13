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
           
            <!-- Card Promotion Info -->
            <div class="card mt-4" id="promotion-info">
                <div class="card-header">
                    <h5>Edit Promotion</h5>
                </div>

                <div class="card-body pt-0">
                    <form wire:submit.prevent="edit">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Title *</label>
                                    <input wire:model.lazy="promotion.title" type="text" class="form-control" placeholder="Enter a Title">
                                </div>
                                @error('promotion.title')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>


                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Stores *</label>

                                    <div class="form-check mt-2 floating-man"> 
                                        <label class="form-check-label" for="all_store">
                                        <input wire:model="promotion.discount_on" class="form-check-input" type="radio"
                                            value='all_store' id="all_store" >
                                            All
                                            </label>
                                            <label class="form-check-label ms-5" for="selected_store">
                                            <input wire:model="promotion.discount_on" class="form-check-input" type="radio" id="selected_store"
                                            value='selected_store'>
                                                Selected (Joined stores only)
                                            </label>
                                    </div>
                                    <div class="form-check">
                                    
                                    </div>
                                </div>
                                @error('promotion.discount_on')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            
                            <div class="col-6  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Discount Type *</label>        
                                    <select class="form-control input-group input-group-dynamic" wire:model.lazy="promotion.type_option"  id="projectName" onfocus="focused(this)" onfocusout="defocused(this)">
                                        <option value=''>Choose Your  Discount Type</option>
                                            @foreach ($typeOptions as $toKey => $toValue)
                                                <option value="{{ $toKey }}">{{   $toValue  }}</option>
                                            @endforeach
                                     </select>                                    
                                </div>
                                @error('promotion.type_option')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>           
                        
                            <div class="col-6 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Value *</label>
                                    <input wire:model.lazy="promotion.value" @if($promotion->type_option == 'free_shipping') readonly @endif type="text" class="form-control" placeholder="Enter a Value">
                                </div>
                                @error('promotion.value')
                                  <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
  
                            <div class="col-12 mb-4" >
                                <div class="input-group input-group-static">
                                    <label>Target *</label>
                                    <select  class="form-control input-group input-group-dynamic"wire:model.lazy="promotion.target"  id="target" onfocus="focused(this)" onfocusout="defocused(this)">
                                       <option value=''>Choose Your Target</option>
                                        @foreach ($targetOptions as $tKey => $tValue)
                                            <option value="{{ $tKey }}">{{   $tValue  }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('promotion.target')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>


                            
                            
                            @if($promotion->target == 'amount_minimum_order' )
                                <div class="col-12 mb-4">
                                    <div class="input-group input-group-static">
                                        <label>Minimum Order Amount *</label>
                                        <input wire:model.lazy="promotion.min_order_price" type="text" class="form-control" placeholder="Enter a Amount">
                                    </div>
                                    @error('promotion.min_order_price')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            @endif

                            <div class="col-12 mb-4">                                
                                <div class="input-group input-group-static" x-data x-init="flatpickr($refs.start_date, {allowInput: false, enableTime: 'true',
                                    dateFormat: 'Y-m-d H:i'});">
                                        <label>Start Date *</label>
                                        <input wire:model.lazy="promotion.start_date" x-ref="start_date" class="form-control" type="text" placeholder="Enter a Start Date Time" />
                                </div>
                                @error('promotion.start_date')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror                              
                            </div>
                        
                            <div class="col-12 mb-4">
                                <div class="form-group">                                    
                                    <div class="form-check">
                                        <input wire:model="never_expired" class="form-check-input" type="checkbox" value="1"  id="never_expired">
                                        <label class="form-check-label">Never Expired</label>
                                     </div>
                                </div>
                                @error('never_expired')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div> 

                            @if(!$never_expired)
                                <div class="col-12 mb-4">
                                    <div  class="input-group input-group-static" x-data x-init="flatpickr($refs.end_date, {allowInput: false,enableTime: 'true',
                                            dateFormat: 'Y-m-d H:i'});">
                                            <label>End Date *</label>
                                            <input wire:model.lazy="promotion.end_date" x-ref="end_date" class="form-control flatpickr" type="text"  placeholder="Enter a End Date Time" />
                                    </div> 
                                    @error('promotion.end_date')
                                        <p class='text-danger m-0 mt-n3 inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>                             
                            @endif

                            <div class="col-12 mb-4">
                                <div class="form-group">                                    
                                    <div class="form-check">
                                        <input wire:model="promotion.status" class="form-check-input" type="checkbox"  id="flexCheckActive">
                                        <label class="form-check-label">Active</label>
                                     </div>
                                </div>
                                @error('promotion.status')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>  
                        
                        {{--    @if($promotion->discount_on == 'selected_store')
                                <div  class="col-12 mb-4">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" wire:model.lazy="promotion.allow_participant"  type="checkbox" Checked>
                                            <label class="form-check-label">Allow Participants to join</label>
                                            </div>
                                    </div>
                                    @error('promotion.allow_participant')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div> 
                            @endif
                        --}}

                        {{--     @if($promotion->discount_on == 'selected_store')
                                <div class="col-12 mb-4">
                                    <div class="input-group input-group-static" >
                                        <label>Stores *</label>
                                        <select class="form-control input-group input-group-dynamic"  multiple="multiple"  wire:model="store_ids" id="storeIds" data-style="select-with-transition" title="Stores" data-size="100" >   
                                            <option value=''>Choose Your stores</option>
                                            @foreach ($stores as $store )
                                                <option value="{{ $store['id'] }}">{{ $store['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('store_ids')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>                           
                            @endif  --}}


                        </div>
        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mt-4">
                                    <a  href="{{ route('promotion-management') }}" class="btn btn-light m-0">Cancel</a>
                                    <button type="submit" name="submit" class="btn bg-gradient-dark m-0 ms-2">Create
                                        Promotion</button>
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
<script src="{{ asset('assets') }}/js/plugins/flatpickr.min.js"></script>


  
<script>   
    $(document).ready(function() {
        window.initSelectStores=()=>{
            $('#storeIds').select2({
                placeholder: 'Select a stores',
                allowClear: true});
        }
        initSelectStores();

        $('#storeIds').on('change', function (e) { alert('load')
            var selected_element = $(e.currentTarget);
            var select_val = selected_element.val();   console.log(select_val);
            window.livewire.emit('selectedStores', select_val);
        });

        window.livewire.on('select2',()=>{ 
            initSelectStores();
        });

    });
</script>

@endpush

 