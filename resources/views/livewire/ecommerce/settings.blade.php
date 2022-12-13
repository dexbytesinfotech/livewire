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

            @if($is_updated)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-warning alert-dismissible text-white mt-3" role="alert">
                            <span class="text-sm">When you don't see the changes after updating data. Please clear cache</span>
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
    
       
            <!-- Delivery settings -->
            <div class="card mt-4" id="Driver-info">
                <div class="card-header">
                    <h5>Driver Settings</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row">                     
                       <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['delivery_cost']['label'] }} *</label>
                                <input wire:model.lazy="delivery_cost" class="form-control" type="text"/>
                            </div>
                            @error('delivery_cost')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>



             <!-- Card driver_commission Info -->
             <div class="card mt-4" id="driver-commissions-info">
                <div class="card-header">
                    <h5>Driver Commissions </h5>
                </div>
                <div class="card-body pt-0">
                       <div class="row">

                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['driver_insurance_amount']['label'] }} *</label>
                                <input wire:model.lazy="driver_insurance_amount" class="form-control" type="text"/>
                            </div>
                            @error('driver_insurance_amount')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <!-- <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['driver_commission_type']['label'] }} *</label>
                                <input wire:model.lazy="driver_commission_type" class="form-control" type="text"/>
                            </div>
                            @error('driver_commission_type')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>   -->
                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['driver_commission']['label'] }} (In {{$driver_commission_type}}) *</label>
                                <input wire:model.lazy="driver_commission" class="form-control" type="text"/>
                            </div>
                            @error('driver_commission')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                            <p class="small mt-3">Driver Commission must be less than or equal to delivery cost!</p>
                        </div>                        
                    </div>                        
                </div>                
            </div>


            <!-- Card driver_commission Info -->
            <div class="card mt-4" id="store-commissions-info">
                <div class="card-header">
                    <h5>Store Commissions</h5>
                </div>
                <div class="card-body pt-0">
                       <div class="row">
                        <!-- <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['driver_commission_type']['label'] }} *</label>
                                <input wire:model.lazy="driver_commission_type" class="form-control" type="text"/>
                            </div>
                            @error('driver_commission_type')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>   -->
                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['store_commission']['label'] }} (In {{$store_commission_type}}) *</label>
                                <input wire:model.lazy="store_commission" class="form-control" type="text"/>
                            </div>
                            @error('store_commission')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>                        
                    </div>                        
                </div>                
            </div>


            <div class="card mt-4" id="Delivery-info">
                <div class="card-header">
                    <h5>Delivery Settings</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row">

                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['restaurant_waiting_time']['label'] }} *</label>
                                <input wire:model.lazy="restaurant_waiting_time" class="form-control" type="text"/>
                            </div>
                            @error('restaurant_waiting_time')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['delivery_risk_time']['label'] }} *</label>
                                <input wire:model.lazy="delivery_risk_time" class="form-control" type="text"/>
                            </div>
                            @error('delivery_risk_time')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['delivery_distance']['label'] }} *</label>
                                <input wire:model.lazy="delivery_distance" class="form-control" type="text"/>
                            </div>
                            @error('delivery_distance')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['drivers_closest_value']['label'] }} *</label>
                                <input wire:model.lazy="drivers_closest_value" class="form-control" type="text"/>
                            </div>
                            @error('drivers_closest_value')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['drivers_receive_order_distance']['label'] }} *</label>
                                <input wire:model.lazy="drivers_receive_order_distance" class="form-control" type="text"/>
                            </div>
                            @error('drivers_receive_order_distance')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>     
    </div>
</div>
  
@push('js')
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>

@endpush

