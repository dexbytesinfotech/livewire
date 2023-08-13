{{-- Page Title --}}
@section('page_title')
    @lang("components/ticket.page_title")
@endsection

<x-core.container wire:init="init">
    <x-loder />

    {{-- Alert message - alert-success, examples- alert-danger, alert-warning, alert-primary  --}}
    <x-slot name="alert">
        @if (session('status'))
            <x-alert class="alert-success">{{ Session::get('status') }}</x-alert>
        @endif
    </x-slot>

    {{-- Card --}}
    <x-core.card class="custom-card">
        <x-slot name="header">

            {{-- Filter row with seachable --}}
            <x-table.container-filter-row seachable />

                <x-core.card-toolbar>
                    {{-- Header Bulk actions  --}}
                    <x-dropdown label="{{ __('components/ticket.Actions') }}">
                        <x-dropdown.item wire:click="exportSelected">
                            @lang('components/ticket.Export')
                        </x-dropdown.item>

                        
                        <x-dropdown.item wire:click="destroyMultiple()" class="dropdown-item text-danger">
                            @lang('components/ticket.Delete')
                        </x-dropdown.item>
                    </x-dropdown>


                     {{-- Filter Action  --}}
                     <x-dropdown class="px-2 py-3 dropdown-md" label="{{ __('component.Filter') }}">
                        <x-input.group inline for="filters.status" label="{{ __('components/ticket.Status') }}">
                            <x-input.select wire:model="filters.status" placeholder="{{ __('components/ticket.Any Status') }}">
                                <option class="optionGroup" value="open">Open</option>            
                                <option class="optionGroup" value="completed">Completed</option>
                                <option class="optionGroup" value="rejected">Rejected</option>                            </x-input.select>
                        </x-input.group>
                    
                        {{-- Date renge filter --}}
                        <x-table.filter-date-input />

                        <x-button.link wire:click="resetFilters" class="mt-2"> @lang('component.Reset Filters') </x-button.link>

                    </x-dropdown>

                    {{--  Hide & show columns dropdown --}}
<x-table.view-columns/>

                </x-core.card-toolbar>
        </x-slot>
        <x-slot name="body">

            {{--  Table with perPage and pagination --}}
            <x-table perPage total="{{ $tickets->total() }}" id="users-list" paginate="{{ $tickets->links() }}">
                <x-slot name="head">

                    {{-- Select-all checkbox  --}}
                    <x-table.heading-selected total="{{ $tickets->total() }}" />

                    {{-- Dynamic columns heading --}}
                    <x-table.heading columns />
                    <x-table.heading> @lang('components/ticket.Actions') </x-table.heading>

                </x-slot>
                <x-slot name="body">
                    {{-- Select records count (which rows checkbox checked) --}}
                    <x-table.row-selected-count selectPage="{{ $selectPage }}" selectedAll="{{ $selectAll }}"
                        count="{{ $tickets->count() }}" total="{{ $tickets->total() }}" />

                        {{-- Table row --}}
                        @forelse ($tickets as $ticket)
                        <x-table.row wire:key="row-{{ $ticket->id }}">

                            {{-- Select checkbox --}}
                            <x-table.cell-selected value="{{ $ticket->id }}" />
                        
                            <x-table.cell column="title" href="">{{ $ticket->title }}</x-table.cell>
                            <x-table.cell column="user_id" href="">{{ $ticket->user->name }}</x-table.cell>

                            <x-table.cell-date column="created_at">{{ $ticket->created_at }}</x-table.cell-date>
                            <x-table.cell column="status">{{ ucfirst($ticket->status) }}</x-table.cell> 

                       
                        
                            {{-- Action , examples- edit, view, delete  --}}
                            <x-table.cell-dropdown>
                                <x-table.dropdown-item class="dropdown-item text-danger" 
                                    title="{{ __('components/ticket.Delete') }}" wire:click="destroyConfirm({{ $ticket->id }})">
                                    {{ __('components/ticket.Delete') }}
                                </x-table.dropdown-item>
                            </x-table.cell-dropdown>
                        </x-table.row>
                    @empty
                        <x-table.no-record-found />
                    @endforelse
                </x-slot>
            </x-table>
        </x-slot>
    </x-core.card>
</x-core.container>
