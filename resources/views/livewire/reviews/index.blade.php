<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0">Reviews</h5>
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
                   
                    <div class="d-flex mt-3 align-items-center justify-content-center">
                        <p class="text-secondary pt-2">Driver&nbsp;&nbsp;</p>
                        <select wire:model="filter.receiver_id" class="form-control mb-2" id="roles">
                            <option value="">Any Driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}"> {{ $driver->name }}</option>
                            @endforeach                       
                        </select>
                    </div>
                
                    <div class="d-flex mt-3 align-items-center justify-content-center">
                        <p class="text-secondary pt-2 ">Date&nbsp;&nbsp;</p> 
                        <div class="input-group input-group-static mb-2" wire:ignore x-data x-init="flatpickr($refs.picker, {allowInput: false, enableTime: 'false',
                        dateFormat:  '{{config('app_settings.date_format.value')}}' });">
                            <input wire:model="filter.created_at"  x-ref="picker" class="form-control" type="text" placeholder="Any Date" />
                        </div>
                    </div>
                @endif
                    <div class="mt-3 ">
                        <input wire:model="search" type="text" class="form-control" placeholder="Search...">
                    </div>
                </div>
                <x-table>
                    <x-slot name="head">
                        <x-table.heading>ID
                        </x-table.heading>
                        <x-table.heading>Order Number
                        </x-table.heading> 
                        <x-table.heading>Reviewer
                        </x-table.heading> 
                        <x-table.heading>Reviewee
                        </x-table.heading> 
                        <x-table.heading sortable wire:click="sortBy('rating')"
                            :direction="$sortField === 'rating' ? $sortDirection : null">Rating
                        </x-table.heading> 
                        <x-table.heading>Creation Date
                        </x-table.heading> 
                        <x-table.heading>Actions
                        </x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($orderReviews as $orderReview)
                        <x-table.row wire:key="row-{{ $orderReview->id }}">
                            <x-table.cell>{{ $orderReview->id }}</x-table.cell>
                            <x-table.cell><a href="{{ route('order-details', $orderReview->order) }}">#{{ $orderReview->order->order_number }}</a></x-table.cell> 
                            <x-table.cell><a href="{{ route('view-user', $orderReview->sender) }}">{{ $orderReview->sender->name }}</a></x-table.cell> 
                            <x-table.cell>{{ $orderReview->rating_for == 'customer' || $orderReview->rating_for == 'driver' ?  $orderReview->receiver->name: $orderReview->order->store->name}}
                              <em>({{ $orderReview->rating_for }})</<em>
                            </x-table.cell> 
                            <x-table.cell>
                                {{ $orderReview->rating }}
                                @if($orderReview->remark) 
                                   <a data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $orderReview->remark }}" data-container="body" data-animation="true"><span class="material-symbols-outlined">reviews</span></a> 
                                @endif
                            </x-table.cell>
                            <x-table.cell>{{ $orderReview->created_at->format(config('app_settings.date_format.value'))   }}</x-table.cell>
                           
                            <x-table.cell> @can('review-delete')    
                                    <div class="dropdown dropup dropleft">
                                    <a class="btn" data-original-title="Remove" title="Remove" wire:click="destroyConfirm({{$orderReview['id'] }})"> <span class="material-symbols-outlined">
                                    delete
                                    </span></a> 
                                </div> @endcan
                            </x-table.cell> 
                           
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                <div id="datatable-bottom">
                    {{ $orderReviews->links() }}
                </div>
                    @if($orderReviews->total() == 0)
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
