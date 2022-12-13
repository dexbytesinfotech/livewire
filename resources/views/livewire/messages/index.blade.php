<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="{{ $conversationOrderId == 0 ? 'col-12' : 'col-8' }} ">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="mb-0">Messages</h5>
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
                        <x-table.heading sortable wire:click="sortBy('order_number')"
                            :direction="$sortField === 'order_number' ? $sortDirection : null">Order Number
                        </x-table.heading> 
                        <x-table.heading> Role
                        </x-table.heading>                       
                       <x-table.heading sortable wire:click="sortBy('created_at')"
                            :direction="$sortField === 'created_at' ? $sortDirection : null">
                            Creation Date
                        </x-table.heading>
                        <x-table.heading>Actions</x-table.heading>
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($messages as $message) 
                         <x-table.row wire:key="row-{{ $message->id }}">
                            <x-table.cell>{{ $message->id }}</x-table.cell>
                            <x-table.cell><a href="{{ route('order-details', $message->order) }}">#{{ $message->order_number }}</a></x-table.cell> 
                            <x-table.cell>{{ $message->role }}</x-table.cell>                            
                            <x-table.cell>{{ $message->created_at->format(config('app_settings.date_format.value'))  }}</x-table.cell>
                            <x-table.cell>
                                @can('show-message')
                                <a  class="conversation-messages-view" href="javascript:;" wire:click="conversation({{$message->order_id}}, '{{$message->role}}', '{{$message->order_number}}')">
                                    <span class="material-symbols-outlined">
                                        chat
                                    </span>
                                </a>  
                                @if($conversationOrderId == $message->order_id && $message->role == $this->conversationRole)
                                    <span class="material-symbols-outlined">
                                        arrow_right_alt
                                    </span>   
                                @endif  
                                @endcan            
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                <div id="datatable-bottom">
                    {{ $messages->links() }}
                </div>
                @if($messages->total() == 0)
                    <div>
                        <p class="text-center">No records found!</p>
                    </div>
                @endif
            </div>
        </div>

        @if($conversationOrderId)
            <div class="col-4" >
                <div class="card ">
                    <div class="card-header d-flex align-items-center py-3">
                        <div class="d-block d-md-flex align-items-center">
                           <div class="mx-0 mx-md-3">
                                <a href="javascript:;" class="text-dark font-weight-800 text-sm">Message for Order number #{{$this->conversationOrderNumber}}</a>
                                <small class="d-block text-muted">{{$this->conversationRole}}</small>
                            </div>
                        </div>
                        <div class="text-end ms-auto">
                            <button type="button" wire:click="destroyConversationConfirm('{{$conversationOrderId}}', '{{$conversationRole}}')" class="btn btn-sm bg-gradient-primary mb-0">
                               Delete
                            </button>
                        </div>
                    </div>
                    <hr class="dark horizontal">
                    <div class="card-body pt-3">  

                        <div class="conversation-messages h-full w-full overflow-y-auto" id="conversation-messages">
                            @foreach ($conversationMessages as  $conversations)                  
                                <div class="d-flex mt-3">
                                    <div class="flex-shrink-0">
                                        @if ($conversations->sender->profile_photo)
                                            <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($conversations->sender->profile_photo) }}" alt="avatar" class="avatar rounded-circle me-3" >
                                                @else
                                            <img src="{{ asset('assets') }}/img/default-avatar.png" alt="avatar" class="avatar rounded-circle me-3" >
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="h6 mt-0"><a href="{{ route('view-user',  $conversations->sender) }}">{{$conversations->sender->name}} @if($conversations->sender->id == auth()->user()->id) (You) @endif</a></h6>
                                        <p class="text-sm"> 

                                        @php $allowed = array('jpg','png','gif', 'pdf', 'jpeg');
                                        $ext = pathinfo($conversations->message, PATHINFO_EXTENSION); 
                                        @endphp
                                        @if(in_array( $ext, $allowed ) )
                                            <a target="_blank" href="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($conversations->message)}}">   
                                                <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($conversations->message)}}" alt="picture"
                                                class="avatar avatar-xl me-2 rounded-3"> 
                                            </a>
                                        @else
                                            {{ $conversations->message }}
                                        @endif      

                                        </p>
                                        <div class="d-flex">
                                            <div>
                                                <i class="material-icons text-sm me-1 cursor-pointer">calendar_month</i>
                                            </div>
                                            <span class="text-sm me-2">{{ $conversations->created_at->format(config('app_settings.date_format.value').' '.config('app_settings.time_format.value'))  }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    

                        <div class="d-flex mt-4">
                            <div class="flex-shrink-0">
                            @if (auth()->user()->profile_photo)
                                <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url(auth()->user()->profile_photo) }}" alt="avatar" class="avatar rounded-circle me-3" >
                                    @else
                                <img src="{{ asset('assets') }}/img/default-avatar.png" alt="avatar" class="avatar rounded-circle me-3" >
                            @endif
                                
                            </div>

                            <form wire:submit.prevent="send" class="d-flex w-100" onsubmit="conversationScroll()">
                                <div class="flex-grow-1 my-auto">                                   
                                    <div class="input-group input-group-static">
                                        <textarea  wire:model="textMessage"  class="form-control" placeholder="Write your comment" rows="4" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <button class="btn bg-gradient-primary btn-sm mt-auto mb-0 ms-2" id="conversation-send" type="submit" name="button"><i class="material-icons text-sm">send</i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        </div>
    </div>
</div>

@push('js')
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script>
    
    $('.conversation-messages-view').click(function() {
        setTimeout(conversationScroll, 1000);       
    });
    
    function conversationScroll() {   
        const element = document.getElementById('conversation-messages');
        element.scrollTop = element.scrollHeight;
    }
</script>
@endpush
