<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0">Promotions</h5>
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
                    <div class="mt-3 ">
                        <input wire:model="search" type="text" class="form-control" placeholder="Search...">
                    </div>
                </div>
                <x-table>

                    <x-slot name="head">
                        <x-table.heading  sortable wire:click="sortBy('id')"
                        :direction="$sortField === 'id' ? $sortDirection : null">Sno
                            </x-table.heading>
                            <x-table.heading>Title
                            </x-table.heading> 
                            <x-table.heading>Target
                            </x-table.heading> 
                            <x-table.heading>Value
                            </x-table.heading>
                            <x-table.heading sortable wire:click="sortBy('start_date')"
                            :direction="$sortField === 'start_date' ? $sortDirection : null">Start Date
                            </x-table.heading>                      
                            <x-table.heading sortable wire:click="sortBy('end_date')"
                            :direction="$sortField === 'end_date' ? $sortDirection : null">End Date
                            </x-table.heading> 
                            <x-table.heading>Status
                            </x-table.heading>                      
                        <x-table.heading>Actions</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($promotionsStore as $promotion)
                        <x-table.row wire:key="row-{{ $promotion->id }}">
                            <x-table.cell>{{ $loop->iteration}}</x-table.cell>
                            <x-table.cell>{{ucfirst(str_replace('_', ' ',$promotion->title))}}</x-table.cell>     
                            <x-table.cell>{{ucfirst(str_replace('_', ' ',$promotion->target)) }}</x-table.cell> 
                            <x-table.cell>
                                @if($promotion->type_option == 'percentage')
                                    {{ $promotion->value }}%@
                                elseif($promotion->type_option =='amount')
                                    {{ \Utils::ConvertPrice($promotion->value) }}
                                @elseif($promotion->type_option == 'free_shipping')
                                    {{ \Utils::ConvertPrice($promotion->value) }}
                                @else
                                    -
                                @endif
                            </x-table.cell>
                            <x-table.cell>{{ $promotion->start_date ? $promotion->start_date->format(config('app_settings.date_format.value')): '' }}</x-table.cell>
                            <x-table.cell>{{ $promotion->end_date ? $promotion->end_date->format(config('app_settings.date_format.value')) : 'Never Expired' }}</x-table.cell>
                            <x-table.cell>
                                @if($today >= $promotion->start_date && ($today <= $promotion->end_date || empty($promotion->end_date)))
                                    @if($promotion->status) 
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">In Active</span>
                                    @endif
                                @else
                                    @if($today < $promotion->start_date)
                                        <span class="badge badge-info">Coming</span>
                                    @else
                                        <span class="badge badge-primary">Expired</span>
                                    @endif
                                @endif
                            </x-table.cell>                            
                            <x-table.cell>                                
                                <div class="dropdown dropup dropleft">
                                    @php $promo_status = false;     @endphp
                                    @if($today >= $promotion->start_date && ($today <= $promotion->end_date || empty($promotion->end_date)))
                                        @if($promotion->status) 
                                                @php $promo_status = true;  @endphp
                                        @endif
                                    @else
                                        @if($today < $promotion->start_date)
                                            @php $promo_status = true;  @endphp
                                        @endif
                                    @endif
                            
                                    @if ($promotion->joined_promotion_id)
                                        @if(!$promo_status) Participated   @else 
                                            <button class="btn btn-outline-primary" @if(!$promo_status) disabled @endif data-original-title="Remove" title="Remove" wire:click="destroyConfirm({{ $promotion->id }})">Remove</button>
                                        @endif
                                    @else
                                        @if(!$promo_status) Not participated @else
                                            <button class="btn btn-outline-info"  @if(!$promo_status) disabled @endif data-original-title="Join" title="Join" wire:click="joinPromotion({{ $promotion->id }})"> Join </button>
                                        @endif
                                    @endif
                                </div>                    
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>

                
                <div id="datatable-bottom">
                    {{ $promotionsStore->links() }}
                </div>
                @if($promotionsStore->total() == 0)
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
@endpush
