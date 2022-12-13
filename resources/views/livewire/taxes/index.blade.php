<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0">Taxes</h5>
                        </div>
                        <div class="col-6 text-end">
                            @can('add-tax')
                                <a class="btn bg-gradient-dark mb-0 me-4" href="{{ route('add-tax') }}"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Tax</a>
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
                    <div class="mt-3 ">
                        <input wire:model="search" type="text" class="form-control" placeholder="Search...">
                    </div>
                </div>
                <x-table>

                    <x-slot name="head">
                        <x-table.heading sortable wire:click="sortBy('id')"
                            :direction="$sortField === 'id' ? $sortDirection : null"> ID
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('name')"
                            :direction="$sortField === 'name' ? $sortDirection : null"> Name
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('percentage')"
                            :direction="$sortField === 'percentage' ? $sortDirection : null">
                            Percentage
                        </x-table.heading>
                        <x-table.heading>
                             status
                        </x-table.heading>
                        <x-table.heading>Actions</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($taxes as $tax)
                        <x-table.row wire:key="row-{{ $tax->id }}">
                            <x-table.cell>{{ $tax->id }}</x-table.cell>
                            <x-table.cell>{{ $tax->name }}</x-table.cell>  
                            <x-table.cell>{{ $tax->percentage }} %</x-table.cell>                                                  
                           
                            <x-table.cell> 
                                {{-- @if(!in_array($page->slug, $this->defaultPages) )   --}}
                                    <div class="form-check form-switch ms-3">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault35"  wire:change="statusUpdate({{ $tax->id }}, {{ $tax->status}} )"
                                            @if($tax->status) checked="" @endif>
                                    </div>
                                {{-- @endif    --}}
                            </x-table.cell> 
                         
                            <x-table.cell>                                
                                <div class="dropdown dropup dropleft">
                                    <button class="btn bg-gradient-default" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="material-icons">
                                            more_vert
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @can('edit-tax')
                                            <li><a class="dropdown-item"  data-original-title="Edit" title="Edit" href="{{ route('edit-tax', $tax->id)}}">Edit</a></li>
                                        @endcan
                                        <li><a class="dropdown-item text-danger"  data-original-title="Remove" title="Remove"  wire:click="destroyConfirm({{ $tax->id }})">Delete</a></li>
                                   </ul>
                                </div>                        
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                <div id="datatable-bottom">
                    {{ $taxes->links() }}
                </div>
                     @if($taxes->total() == 0)
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