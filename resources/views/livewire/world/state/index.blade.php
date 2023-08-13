{{-- Page Title --}}
@section('page_title')
    @lang("components/state.page_title")
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
                    <x-dropdown label="{{ __('components/state.Actions') }}">
                        <x-dropdown.item wire:click="exportSelected">
                            @lang('components/state.Export')
                        </x-dropdown.item>

                        
                        <x-dropdown.item wire:click="destroyMultiple()" class="dropdown-item text-danger">
                            @lang('components/state.Delete')
                        </x-dropdown.item>
                    </x-dropdown>


                     {{-- Filter Action  --}}
                     <x-dropdown class="px-2 py-3 dropdown-md" label="{{ __('component.Filter') }}">
                        <x-input.group inline for="filters.status" label="{{ __('components/state.Status') }}">
                            <x-input.select wire:model="filters.status" placeholder="{{ __('components/state.Any Status') }}">
                                <option value="1"> @lang('components/state.Active') </option>
                                <option value="0"> @lang('components/state.Inactive') </option>
                            </x-input.select>
                        </x-input.group>
                    
                        {{-- Date renge filter --}}
                        <x-table.filter-date-input />

                        <x-button.link wire:click="resetFilters" class="mt-2"> @lang('component.Reset Filters') </x-button.link>

                    </x-dropdown>

                    {{--  Hide & show columns dropdown --}}
<x-table.view-columns/>

                    @can('add-user')
                        {{-- button with icon,href --}}
                        <x-table.button.add icon href="{{ route('add-state') }}" >  @lang('components/state.Add State') </x-table.button.add>
                    @endcan

                </x-core.card-toolbar>
        </x-slot>
        <x-slot name="body">

            {{--  Table with perPage and pagination --}}
            <x-table perPage total="{{ $states->total() }}" id="state-list" paginate="{{ $states->links() }}">
                <x-slot name="head">

                    {{-- Select-all checkbox  --}}
                    <x-table.heading-selected total="{{ $states->total() }}" />

                    {{-- Dynamic columns heading --}}
                    <x-table.heading columns />
                    <x-table.heading> @lang('components/state.Actions') </x-table.heading>

                </x-slot>
                <x-slot name="body">
                    {{-- Select records count (which rows checkbox checked) --}}
                    <x-table.row-selected-count selectPage="{{ $selectPage }}" selectedAll="{{ $selectAll }}"
                        count="{{ $states->count() }}" total="{{ $states->total() }}" />

                        {{-- Table row --}}
                        @forelse ($states as $state)
                        <x-table.row wire:key="row-{{ $state->id }}">

                            {{-- Select checkbox --}}
                            <x-table.cell-selected value="{{ $state->id }}" />
                        
                            <x-table.cell column="name" href="">{{ $state->name }}</x-table.cell>
                            <x-table.cell column="country_id" href="">{{ $state->country->name }}</x-table.cell>

                            <x-table.cell-date column="created_at">{{ $state->created_at }}</x-table.cell-date>

                            <x-table.cell-switch column="status" status="{{ $state->status }}"
                                wire:change="statusUpdate({{ $state->id }},{{ $state->status }})">
                            </x-table.cell-switch>

                        
                            {{-- Action , examples- edit, view, delete  --}}
                            <x-table.cell-dropdown>
                                @can('edit-state')
                                <x-table.dropdown-item class="dropdown-item" 
                                    title="{{ __('components/state.Edit') }}" href="{{ route('edit-state', $state) }}">
                                    {{ __('components/state.Edit') }}
                                </x-table.dropdown-item>
                                @endcan
                                <x-table.dropdown-item class="dropdown-item text-danger" 
                                    title="{{ __('components/state.Delete') }}" wire:click="destroyConfirm({{ $state->id }})">
                                    {{ __('components/state.Delete') }}
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
