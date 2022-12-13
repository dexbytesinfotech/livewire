<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0">Requests</h5>
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
                        <x-table.heading sortable wire:click="sortBy('id')"
                            :direction="$sortField === 'id' ? $sortDirection : null"> ID
                        </x-table.heading>
                        <x-table.heading>Title
                        </x-table.heading> 
                        <x-table.heading>Customer Name
                        </x-table.heading>     
                        <x-table.heading> Status
                        </x-table.heading>               
                        <x-table.heading sortable wire:click="sortBy('created_at')"
                        :direction="$sortField === 'created_at' ? $sortDirection : null"> Date
                        </x-table.heading>                          
                        <x-table.heading>Actions</x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($tickets as $ticket)
                        <x-table.row wire:key="row-{{ $ticket->id }}">
                            <x-table.cell>{{ $ticket->id }}</x-table.cell>
                            <x-table.cell>{{ $ticket->title }} <br>
                                @if($ticket->category->name == 'update-mobile-number')
                                    <em> @php $newMobile = json_decode($ticket->content, true) @endphp
                                    {{  $ticket->user->country_code.' '.substr($ticket->user->phone , +(strlen($ticket->user->country_code)))  }} <b>-></b> {{ $newMobile['country_code']  }} {{ $newMobile['mobile']  }} 
                                    </em>
                                @endif
                            </x-table.cell> 
                            <x-table.cell><a href="{{ route('view-user',  $ticket->user) }}">{{ $ticket->user->name }}</a></x-table.cell> 
                            <x-table.cell>{{ ucfirst($ticket->status) }}</x-table.cell> 
                            <x-table.cell>{{ $ticket->created_at }}</x-table.cell> 
                            <x-table.cell>
                                <div class="dropdown dropup dropleft">
                                    <button class="btn bg-gradient-default" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="material-icons">
                                            more_vert
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if($ticket->status == 'open')
                                            <li><a class="dropdown-item text-success"  data-original-title="Approve" title="Approve" wire:click="statusUpdate({{ $ticket }}, 'closed')">Approve</a></li>
                                            <li><a class="dropdown-item text-warning "  data-original-title="Reject" title="Reject" wire:click="statusUpdate({{ $ticket }}, 'rejected')">Reject</a></li>
                                            <li><hr></li>
                                        @endif
                                        <li><a class="dropdown-item text-danger"  data-original-title="Remove" title="Remove" wire:click="destroyConfirm({{ $ticket->id }})">Delete</a></li>
                                   </ul>
                                </div>   

                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                <div id="datatable-bottom">
                    {{ $tickets->links() }}
                </div>
                    @if($tickets->total() == 0)
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
