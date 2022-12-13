<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0">Categories</h5>
                        </div>
                        <div class="col-6 text-end">
                            @can('add-category')
                            <a class="btn bg-gradient-dark mb-0 me-4" href="{{ route('add-category') }}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add category</a>
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
                        <x-table.heading> Image
                        </x-table.heading>  
                        <x-table.heading sortable wire:click="sortBy('name')"
                            :direction="$sortField === 'name' ? $sortDirection : null"> Name
                        </x-table.heading> 
                        @if(auth()->user()->hasRole('Admin'))
                        <x-table.heading sortable wire:click="sortBy('store_id')"
                        :direction="$sortField === 'store_id' ? $sortDirection : null"> Store Name
                        </x-table.heading> 
                        @endif    
                       <x-table.heading sortable wire:click="sortBy('created_at')"
                            :direction="$sortField === 'created_at' ? $sortDirection : null">
                            Creation Date
                        </x-table.heading>
                        <x-table.heading> Status
                        </x-table.heading>  
                        
                        <x-table.heading>Actions</x-table.heading>
                         
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($categories as $category)
                        <x-table.row wire:key="row-{{  $category->id }}">
                            <x-table.cell>{{  $category->id }}</x-table.cell>
                            <x-table.cell >
                                    @if ($category->image)
                                    <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($category->image) }} " alt="picture"
                                        class="avatar avatar-sm me-3">
                                    @else
                                    <img src="{{ asset('assets') }}/img/default-food-avatar.jpg" alt="avatar"
                                        class="avatar avatar-sm me-3">
                                    @endif            
                            </x-table.cell>
                            <x-table.cell>{{ $category->name }}</x-table.cell>
                            @if(auth()->user()->hasRole('Admin')) 
                                <x-table.cell>
                                    @if ($category->store_id)
                                        {{ $category->store->name}}
                                    @endif  
                                </x-table.cell>
                            @endif
                           <x-table.cell>{{  $category->created_at->format(config('app_settings.date_format.value')) }}</x-table.cell>
                           <x-table.cell> <div class="form-check form-switch ms-3">
                             @if((array_key_exists('store_id', $filter) && $filter['store_id'] == $category->store_id) || (auth()->user()->hasRole('Admin')))
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault35"  wire:change="statusUpdate({{  $category->id }},{{ $category->status}})"
                                    @if( $category->status) checked="" @endif>
                                @else
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault35"
                                    @if( $category->status) checked="" @endif disabled>
                             @endif
                            </div></x-table.cell>
                            <x-table.cell>
                                                           
                               
                                @if((array_key_exists('store_id', $filter) && $filter['store_id'] == $category->store_id) || (auth()->user()->hasRole('Admin')))
                                     
                                    <div class="dropdown dropup dropleft">
                                        <button class="btn bg-gradient-default" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="material-icons">
                                                more_vert
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @can('edit-category')
                                            <li><a class="dropdown-item"  data-original-title="Edit" title="Edit" href="{{ route('edit-category', $category) }}">Edit</a></li>
                                            @endcan
                                            <li><a class="dropdown-item text-danger"  data-original-title="Remove" title="Remove" wire:click="destroyConfirm({{ $category->id }})">Delete</a></li>
                                        </ul>
                                    </div>

                                @endif



                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                <div id="datatable-bottom">
                    {{  $categories->links() }}
                </div>
                @if( $categories->total() == 0)
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
