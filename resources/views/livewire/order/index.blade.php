<div class="container-fluid py-4">
  
    <div class="row">
        <div class="col-12">
            <div class="card">                
                <!-- Card header -->               
                <div class="card-header pb-0">
                    <div class="d-lg-flex">                        
                        <div>
                            <h5 class="mb-0">All Orders</h5>                           
                        </div>
                    </div>
                </div>

                <div class="card-body px-0 pb-0">
                    <div class="d-flex flex-row justify-content-between mx-4">
                        <div class="d-flex mt-3 align-items-center justify-content-center">
                            <p class="text-secondary pt-2">Show&nbsp;&nbsp;</p>
                            <select wire:model="perPage" class="form-control mb-2" id="entries">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option selected value="50">50</option>
                                <option value="100">100</option>                               
                            </select>
                            <p class="text-secondary pt-2">&nbsp;&nbsp;entries</p>
                        </div>

                        <div class="d-flex mt-3 align-items-center justify-content-center">
                            <p class="text-secondary pt-2">Status&nbsp;&nbsp;</p>
                            <select wire:model="filter.order_status" class="form-control mb-2" id="status">
                                <option value="">Any Status</option>
                                @foreach($allOrderStatus as $orderStatus)
                                    <option value={{ $orderStatus }}>{{  ucfirst(str_replace('_', ' ', $orderStatus)) }}</option>
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
                            <div class="input-group input-group-static mb-2" wire:ignore x-data x-init="flatpickr($refs.picker, {allowInput: false, enableTime: 'false',
                            dateFormat: '{{config('app_settings.date_format.value')}}'});">
                               <input wire:model="filter.created_at"  x-ref="picker" class="form-control" type="text" placeholder="Select Any Date" />
                            </div>
                        </div>
                        
                        <div class="mt-3 ">
                            <input wire:model="search" type="text" class="form-control p-2" placeholder="Search...">
                        </div>
                    </div>

                    <x-table class="table table-flush">
                        <x-slot name="head">
                            <x-table.heading> Id
                            </x-table.heading>
                            <x-table.heading> Order Number
                            </x-table.heading>
                            <x-table.heading> Date
                            </x-table.heading>
                            <x-table.heading> Status
                            </x-table.heading>
                            <x-table.heading> Store
                            </x-table.heading>
                            <x-table.heading> Customer
                            </x-table.heading>                           
                            <x-table.heading> Amount
                            </x-table.heading>
                            <x-table.heading>Actions</x-table.heading>
                        
                        </x-slot>
                        <x-slot name="body">
                            @foreach ($orders as $order)

                            <x-table.row wire:key="row-{{$order->id }}">
                                <x-table.cell>{{ $order->id }}</x-table.cell>
                                <x-table.cell><a href="{{ route('order-details', $order) }}">#{{ $order->order_number }}</a></x-table.cell>
                                <x-table.cell>{{ $order->created_at->format(config('app_settings.date_format.value').' '.config('app_settings.time_format.value')) }}</x-table.cell>
                                <x-table.cell><span class="text-{{$statusLabels[$order->order_status]}}"> {{  ucfirst(str_replace('_', ' ', $order->order_status)) }}</span></x-table.cell>
                                <x-table.cell>{{ $order->store->name }}</x-table.cell>
                                <x-table.cell><a href="{{ route('view-user',  $order->user) }}">{{ $order->user->name }}</a></x-table.cell>
                                <x-table.cell>{{ \Utils::ConvertPrice($order->total_amount) }}</x-table.cell>
                                <x-table.cell> 
                                    @can('order-details')                               
                                    <a href="{{ route('order-details', $order) }}" data-bs-toggle="tooltip"
                                        data-bs-original-title="Preview">
                                        <i class="material-icons text-secondary position-relative text-lg">visibility</i>
                                    </a>
                                    @endcan
                                    
                                    <a href="javascript:;" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete"  wire:click="destroyConfirm({{ $order->id }})">
                                        <i class="material-icons text-secondary position-relative text-lg">delete</i>
                                    </a>                                                                    
                                </x-table.cell>
                            </x-table.row>
                            
                            @endforeach
                        </x-slot>
                    </x-table>

                    <div id="datatable-bottom">
                        {{ $orders->links() }}
                    </div>

                    @if( $orders->total() == 0)
                        <div>
                            <p class="text-center">No records found!</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
@push('js')
<script src="{{ asset('assets') }}/js/plugins/flatpickr.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/datatables.js"></script>
  
@endpush
