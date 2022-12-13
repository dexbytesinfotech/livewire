 <div  class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
               <!-- Card header -->
               <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0">Transactions</h5>
                        </div>
                    </div>
                </div>
           
                <div class="d-flex flex-row justify-content-between mx-4">
                    <div class="d-flex mt-3 align-items-center justify-content-center">
                        <p class="text-secondary pt-2">Show&nbsp;&nbsp;</p>
                        <select wire:model="perPage" class="form-control mb-2" id="entries">
                            <option value="10">10</option>
                            <option selected value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <p class="text-secondary pt-2">&nbsp;&nbsp;entries</p>
                    </div>

                    <div class="d-flex mt-3 align-items-center justify-content-center">
                        <p class="text-secondary pt-2">Status&nbsp;&nbsp;</p>
                        <select wire:model="filter.status" class="form-control mb-2" id="status">
                            <option value="">Any Status</option>
                            @foreach($allPaymentStatus as $paymentStatus)
                                <option value={{ $paymentStatus }}>{{  ucfirst($paymentStatus) }}</option>
                            @endforeach
                        </select>
                    </div>
                @if(auth()->user()->hasRole('Admin'))
                    <div class="d-flex mt-3 align-items-center justify-content-center">
                        <p class="text-secondary pt-2">Store&nbsp;&nbsp;</p>
                        <select wire:model="filter.store_id" class="form-control mb-2" id="roles">
                            <option value="">Any Store</option>
                            @foreach ($stores as $store)
                                <option value="{{ $store->id }}"> {{ $store->name }}</option>
                            @endforeach                       
                        </select>
                    </div>
                @endif
                    <div class="d-flex mt-3 align-items-center justify-content-center">
                        <p class="text-secondary pt-2">Date&nbsp;&nbsp;</p>
                        <div class="input-group input-group-static  mb-2" wire:ignore x-data x-init="flatpickr($refs.picker, {allowInput: false, enableTime: 'false',
                        dateFormat:  '{{config('app_settings.date_format.value')}}' });">
                            <input wire:model="filter.created_at"  x-ref="picker" class="form-control" type="text" placeholder="Any Date" />
                        </div>
                    </div>
                    <div class="mt-3">
                        <input wire:model="search" type="text" class="form-control" placeholder="Search...">
                    </div>
                </div>

                <x-table>
                    <x-slot name="head">
                        <x-table.heading>S. NO
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('order_id')"
                        :direction="$sortField === 'order_id' ? $sortDirection : null">  Order Number
                        </x-table.heading> 
                        <x-table.heading sortable wire:click="sortBy('user_id')"
                        :direction="$sortField === 'user_id' ? $sortDirection : null"> Customer
                        </x-table.heading> 
                        <x-table.heading>Amount
                        </x-table.heading>  
                        <x-table.heading>Payment Method
                        </x-table.heading>     
                        <x-table.heading>Status
                        </x-table.heading>                   
                        <x-table.heading >
                            Creation Date
                        </x-table.heading>
                        <x-table.heading >
                            Action
                        </x-table.heading>                         
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($transactions as $transaction)
                        <x-table.row wire:key="row-{{$transaction->id }}">
                            <x-table.cell>{{ $transaction->id }}</x-table.cell>
                            <x-table.cell><a href="{{ route('order-details', $transaction->order) }}">#{{ $transaction->order->order_number }}</a></x-table.cell>     
                            <x-table.cell><a href="{{ route('view-user',  $transaction->user) }}">{{ $transaction->user->name  }}</a></x-table.cell>
                            <x-table.cell>{{  \Utils::ConvertPrice($transaction->amount) }}</x-table.cell>
                            <x-table.cell>{{ ucfirst($transaction->payment_mode)  }}</x-table.cell>
                            <x-table.cell>{{ ucfirst($transaction->status) }}</x-table.cell>                            
                            <x-table.cell>{{ $transaction->created_at->format(config('app_settings.date_format.value').' '.config('app_settings.time_format.value')) }}</x-table.cell>
                            <x-table.cell>                                
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                <div id="datatable-bottom">
                    {{ $transactions->links() }}
                </div>
                @if( $transactions->total() == 0)
                    <div>
                        <p class="text-center">No records found!</p>
                    </div> 
                @endif
            </div>
        </div>
    </div>
</div>
 
@push('js')
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/flatpickr.min.js"></script>
@endpush
