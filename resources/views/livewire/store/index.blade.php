<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col col-6">
                            <h5 class="mb-0">
                            @if($this->application_status == 'waiting')
                                Unverified Stores
                            @else
                                Stores
                            @endif
                            </h5>
                        </div>
                        <div class="col col-6 text-end">
                            @can('add-store') 
                                <a class="btn bg-gradient-dark mb-0 me-4" href="{{ route('add-store') }}"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Store</a>
                            @endcan
                        </div>
                    </div>
                </div>
                @if (Session::has('status'))
                <div class="alert alert-success alert-dismissible text-white mx-4" role="alert">
                    <span class="text-sm">{{ Session::get('status') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif (Session::has('error'))
                <div class="alert alert-danger alert-dismissible text-white mx-4" role="alert">
                    <span class="text-sm">{{ Session::get('error') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
               
               
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
                            <option value="1">Active</option>
                            <option value="0">In Active</option>                           
                        </select>
                    </div>

                    <div class="d-flex mt-3 align-items-center justify-content-center">
                        <p class="text-secondary pt-2">Store Type&nbsp;&nbsp;</p>
                        <select wire:model="filter.store_type" class="form-control mb-2" id="roles">
                            <option value="">Any Type</option>
                            @foreach ($storeTypes as $storeType)
                                <option value="{{ $storeType->name }}"> {{ $storeType->name }}</option>
                            @endforeach                       
                        </select>
                    </div>
                    <div class="mt-3 ">
                        <input wire:model="search" type="text" class="form-control" placeholder="Search...">
                    </div>
                </div>
                <x-table>

                    <x-slot name="head">
                        <x-table.heading sortable wire:click="sortBy('id')"
                            :direction="$sortField === 'id' ? $sortDirection : null"> ID
                        </x-table.heading>
                        <x-table.heading> Logo
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('name')"
                            :direction="$sortField === 'name' ? $sortDirection : null">Store Name
                        </x-table.heading>
                       
                        <x-table.heading>Email
                        </x-table.heading>
                        <x-table.heading>Phone
                        </x-table.heading> 
                        <x-table.heading>Status
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('created_at')"
                            :direction="$sortField === 'created_at' ? $sortDirection : null">
                            Creation Date
                        </x-table.heading>                     
                        <x-table.heading>Actions</x-table.heading>
                    
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($stores as $store)
                        {{-- @dd($store) --}}
                        <x-table.row wire:key="row-{{ $store->id }}">
                            <x-table.cell>{{ $store->id }}</x-table.cell>
                            <x-table.cell class="position-relative">
                                @if($store->logo_path)
                                <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($store->logo_path)}}" alt="picture"
                                    class="avatar avatar-sm me-3">
                                @else
                                <img src="{{ asset('assets') }}/img/default-avatar.png" alt="avatar"
                                    class="avatar avatar-sm me-3">
                                @endif
                            </x-table.cell>
                            <x-table.cell><a href="{{ route('edit-store' , $store) }}">{{ $store->name }}</a></x-table.cell>
                       
                            <x-table.cell>{{ $store->email }} </x-table.cell>
                            <x-table.cell>{{ $store->phone }}</x-table.cell>
                            <x-table.cell> 
                                <div class="form-check form-switch ms-3">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault35"  wire:change="statusUpdate({{ $store->id }},{{ $store->status}})"
                                        @if($store->status) checked="" @endif>
                                </div>
                            </x-table.cell>
                            <x-table.cell>{{  $store->created_at->format(config('app_settings.date_format.value'))  }}</x-table.cell>
                            <x-table.cell>
                              
                            @if($this->application_status == 'waiting')
                                <button type="button" class="btn btn-success btn-link" data-original-title="Approve" title="Approve"
                                wire:click="applicationConfirm({{ $store->id }}, 'approved')">
                                    <i class="material-icons">check</i>
                                    <div class="ripple-container"></div>
                                </button>
                                <button type="button" class="btn btn-danger btn-link" data-original-title="Reject" title="Reject"
                                wire:click="applicationConfirm({{ $store->id }}, 'rejected')">
                                    <i class="material-icons">close</i>
                                    <div class="ripple-container"></div>
                                </button>
                            @else 
                                <div class="dropdown dropup dropleft">
                                    <button class="btn bg-gradient-default" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="material-icons">
                                            more_vert
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @can('edit-store')
                                            <li><a class="dropdown-item"  data-original-title="Searchable" title="Searchable" wire:click="searchableConfirm({{ $store }})">{{ $store->is_searchable ? 'Remove to Searchable' : 'Mark as Searchable'}}</a></li>
                                        @endcan
                                        @can('edit-store')
                                            <li><a class="dropdown-item"  data-original-title="Top Restaurants" title="Top Restaurants" wire:click="featuresConfirm({{ $store }})">{{ $store->is_features ? 'Remove to Top Restaurants' : 'Mark as Top Restaurants'}}</a></li>
                                        @endcan
                                        @can('edit-store')
                                            <li><a class="dropdown-item"  data-original-title="Edit" title="Edit" href="{{ route('edit-store' , $store) }}">Edit</a></li>
                                        @endcan
                                        @if ($store->is_primary == 0)
                                            <li><a class="dropdown-item text-danger"  data-original-title="Remove" title="Remove"  wire:click="destroyConfirm({{ $store->id }})">Delete</a></li>
                                        @endif 
                                    </ul>
                                </div>


                            @endif  
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                <div id="datatable-bottom">
                    {{ $stores->links() }}
                </div>
                @if($stores->total() == 0)
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
