<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0">Pages</h5>
                        </div>
                        <div class="col-6 text-end">
                            @can('add-page')
                                <a class="btn bg-gradient-dark mb-0 me-4" href="{{ route('add-page') }}"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Page</a>
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
                        <x-table.heading sortable wire:click="sortBy('title')"
                            :direction="$sortField === 'title' ? $sortDirection : null"> Title
                        </x-table.heading>   
                        <x-table.heading> Slug
                        </x-table.heading>                       
                        <x-table.heading sortable wire:click="sortBy('created_at')"
                            :direction="$sortField === 'created_at' ? $sortDirection : null">
                            Creation Date
                        </x-table.heading>
                        <x-table.heading>
                        Published
                        </x-table.heading>
                        <x-table.heading>Actions</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($pages as $page)
                        <x-table.row wire:key="row-{{ $page->id }}">
                            <x-table.cell>{{ $page->id }}</x-table.cell>
                            <x-table.cell>{{ $page->title }}</x-table.cell>  
                            <x-table.cell>{{ $page->slug }}</x-table.cell>                                                  
                            <x-table.cell>{{ $page->created_at->format(config('app_settings.date_format.value')) }}</x-table.cell>
                            <x-table.cell> 
                                @if(!in_array($page->slug, $this->defaultPages) )  
                                    <div class="form-check form-switch ms-3">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault35"  wire:change="statusUpdate({{ $page->id }}, '{{ $page->status}}')"
                                            @if($page->status == 'published') checked="" @endif>
                                    </div>
                                @endif   
                            </x-table.cell> 
                         
                            <x-table.cell>                               
                                <div class="dropdown dropup dropleft">
                                    <button class="btn bg-gradient-default" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="material-icons">
                                            more_vert
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @can('edit-page')
                                            <li><a class="dropdown-item"  data-original-title="Edit" title="Edit" href="{{ route('edit-page', $page) }}">Edit</a></li>
                                        @endcan
                                        @if(!in_array($page->slug, $this->defaultPages) )  
                                            <li><a class="dropdown-item text-danger"  data-original-title="Remove" title="Remove" wire:click="destroyConfirm({{ $page->id }})">Delete</a></li>
                                        @endif 
                                    </ul>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                <div id="datatable-bottom">
                    {{ $pages->links() }}
                </div>
                     @if($pages->total() == 0)
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
