<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col col-6">
                            <h5 class="mb-0">
                            @if($this->account_status == 'waiting')
                                Unverified {{Str::ucfirst($this->filter['role'] == '' ? 'All User' :  $this->filter['role']) }}s 
                            @else
                                {{Str::ucfirst($this->filter['role'] == '' ? 'All User' :  $this->filter['role']) }}s
                            @endif
                            </h5>
                        </div>
                        <div class="col col-6 text-end">
                            @if($this->filter['role'] == '' || $this->filter['role'] == 'provider')
                                @can('add-user')
                                    <a class="btn bg-gradient-dark mb-0 me-4" href="{{ route('add-user', ['role' => $this->filter['role']]) }}"><i
                                            class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New</a>
                                @endcan
                            @endif
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
                    <div class="d-flex mt-3">
                        <p class="text-secondary pt-2">Show&nbsp;&nbsp;</p>
                        <select wire:model="perPage" class="form-control mb-2" id="entries">
                            <option value="10">10</option>
                            <option selected value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <p class="text-secondary pt-2">&nbsp;&nbsp;entries</p>
                    </div>

                    <div class="d-flex mt-3">
                        <p class="text-secondary pt-2">Status&nbsp;&nbsp;</p>
                        <select wire:model="filter.status" class="form-control mb-2" id="status">
                            <option value="">Any Status</option>
                            <option value="1">Active</option>
                            <option value="0">In Active</option>                           
                        </select>
                    </div>
                    
                    <div class="d-flex mt-3">
                        <p class="text-secondary pt-2">Role&nbsp;&nbsp;</p>
                        <select wire:model="filter.role" class="form-control mb-2" id="roles">
                            <option value="">Any Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}"> {{ $role->name }}</option>
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
                        <x-table.heading> Photo
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('name')"
                            :direction="$sortField === 'name' ? $sortDirection : null"> Name
                        </x-table.heading>
                        <!-- <x-table.heading>Email
                        </x-table.heading> -->
                        <x-table.heading>Phone
                        </x-table.heading>
                        <x-table.heading>Status
                        </x-table.heading>
                        @if(!empty(Route::current()->parameter('role')) && Route::current()->parameter('role') == 'driver')
                            <x-table.heading>Status
                            </x-table.heading>
                        @endif
                       
                        @if(empty($this->filter['role']))
                            <x-table.heading>Role
                            </x-table.heading>
                        @endif
                        <x-table.heading sortable wire:click="sortBy('created_at')"
                            :direction="$sortField === 'created_at' ? $sortDirection : null">
                            Creation Date
                        </x-table.heading>
                     
                        <x-table.heading>Actions</x-table.heading>
                    
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($users as $user)
                        <x-table.row wire:key="row-{{ $user->id }}">
                            <x-table.cell>{{ $user->id }}</x-table.cell>
                            <x-table.cell class="position-relative">
                                @if ($user->profile_photo)
                                <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($user->profile_photo)}}" alt="picture"
                                    class="avatar avatar-sm me-3">
                                @else
                                <img src="{{ asset('assets') }}/img/default-avatar.png" alt="avatar"
                                    class="avatar avatar-sm me-3">
                                @endif
                            </x-table.cell>
                            <x-table.cell><a href="{{ route('view-user', $user) }}">{{ $user->name }}</a></x-table.cell>                          
                            <x-table.cell>+{{$user->country_code}} {{ substr($user->phone , +(strlen($user->country_code)))  }}</x-table.cell>
                            <x-table.cell> 
                            @if ($user->id != auth()->id() || $user->id  != 1)
                                <div class="form-check form-switch ms-3">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault35"  wire:change="statusUpdate({{ $user->id }},{{ $user->status}})"
                                        @if($user->status) checked="" @endif   @if($this->account_status == 'waiting') disabled @endif>
                                </div>
                            @endif
                            </x-table.cell>
                            @if(!empty($this->filter['role']) && $this->filter['role'] == 'driver')
                            <x-table.cell>
                                <span class="badge badge-dot me-4">
                                   @if($user->driver && $user->driver->is_live)
                                    <i class="bg-success"></i>
                                    <span class="text-dark text-xs">Online</span>
                                    @else
                                    <i class="bg-danger"></i>
                                    <span class="text-dark text-xs">Offline</span>
                                    @endif
                                </span>
                            </x-table.cell>
                            @endif

                            @if(empty($this->filter['role']))
                                <x-table.cell>{{ $user->getRoleNames()->implode(',') }}
                                </x-table.cell>
                            @endif
                            <x-table.cell>{{ $user->created_at->format(config('app_settings.date_format.value')) }}</x-table.cell>
                            <x-table.cell>                              
                            
                            @if($this->account_status == 'waiting')
                                <button type="button" class="btn btn-success btn-link" data-original-title="Approve" title="Approve" 
                                wire:click="applicationConfirm({{ $user->id }}, 'approved')">
                                    <i class="material-icons">check</i>
                                    <div class="ripple-container"></div>
                                </button>
                                <button type="button" class="btn btn-danger btn-link" data-original-title="Reject" title="Reject"
                                wire:click="applicationConfirm({{ $user->id }}, 'rejected')">
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
 
                                        @can('view-user')
                                            <li><a class="dropdown-item"  data-original-title="view" title="view" href="{{ route('view-user', $user) }}">Edit</a></li>
                                        @endcan
                                        @if ($user->id != auth()->id() || $user->id  != 1)
                                            <li><a class="dropdown-item text-danger"  data-original-title="Remove" title="Remove" wire:click="destroyConfirm({{ $user->id }})">Delete</a></li>
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
                    {{ $users->links() }}
                </div>
                
                    @if($users->total() == 0)
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
