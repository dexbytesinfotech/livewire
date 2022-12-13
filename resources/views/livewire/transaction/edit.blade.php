
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
                    <h5 class="mb-0">Edit Transaction </h5>
                </div>
                <div class="card-body pt-0">
                        <div class="row ">
                            <div class="col-12  mb-4">

                                <div class="input-group input-group-static">
                                    <label>Order Number </label>
                                    <input type="text" class="form-control" value="{{ $this->transaction->order->order_number}}" disabled>
                                </div>
                                
                            </div>
                            <div class="col-12  mb-4">

                                <div class="input-group input-group-static">
                                    <label>Customer Name </label>
                                    <input type="text" class="form-control" value="{{ $this->transaction->user->name}}" disabled>
                                </div>
                                
                            </div>

                            <div class="col-12  mb-4">

                                <div class="input-group input-group-static">
                                    <label>Store Name </label>
                                    <input type="text" class="form-control" value="{{ $this->transaction->store->name}}" disabled>
                                </div>
                                
                            </div>
                            <div class="col-12  mb-4">

                                <div class="input-group input-group-static">
                                    <label>Amount </label>
                                    <input type="text" class="form-control" value="{{ $transaction->amount }}" disabled>
                                </div>
                                
                            </div>
                            <div class="col-12  mb-4">

                                <div class="input-group input-group-static">
                                    <label>Payment Mode </label>
                                    <input type="text" class="form-control" value="{{ $transaction->payment_mode}}" disabled>
                                </div>
                                
                            </div>
                            <div class="col-12  mb-4">

                                <div class="input-group input-group-static">
                                    <label>Payment Reciver </label>
                                    <input type="text" class="form-control" value="{{ $transaction->payment_receiver }}" disabled>
                                </div>
                                
                            </div>

                            <div class="col-12  mb-4">
                                 
                                <div class="input-group input-group-static">
                                    <label>Status </label>
                                    <select class="form-control input-group input-group-static" name="status" wire:model.lazy="transaction.status"  wire:change="Update('{{ $transaction->id}}',$event.target.value)"  id="projectName" onfocus="focused(this)" onfocusout="defocused(this)">
                                    <option value="{{ $this->orderPaymentStatus['PENDING'] }}">PENDING</option>
                                    <option value="{{ $this->orderPaymentStatus['HOLD'] }}"> HOLD</option>
                                    <option value="{{ $this->orderPaymentStatus['CANCELLED'] }}"> CANCELLED</option>
                                    <option value="{{ $this->orderPaymentStatus['DECLINED'] }}">DECLINED</option>
                                    <option value="{{ $this->orderPaymentStatus['COMPLETED'] }}">COMPLETED</option>
                                    </select>
                                  
                                </div>
                                
                            </div>
                        </div>
        
                       
                    
                </div>
            </div>
 
        </div>
    </div>
</div>
@push('js')
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/quill.min.js"></script>
@endpush
