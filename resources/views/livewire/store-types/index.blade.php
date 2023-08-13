{{-- Page Title --}}
@section('page_title')
    @lang("components/StoreType.page_title")
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
                    <x-dropdown label="{{ __('components/StoreType.Actions') }}">
                        <x-dropdown.item wire:click="exportSelected">
                            @lang('components/StoreType.Export')
                        </x-dropdown.item>

                        
                        <x-dropdown.item wire:click="destroyMultiple()" class="dropdown-item text-danger">
                            @lang('components/StoreType.Delete')
                        </x-dropdown.item>
                    </x-dropdown>


                     {{-- Filter Action  --}}
                     <x-dropdown class="px-2 py-3 dropdown-md" label="{{ __('component.Filter') }}">
                        <x-input.group inline for="filters.status" label="{{ __('components/StoreType.Status') }}">
                            <x-input.select wire:model="filters.status" placeholder="{{ __('components/StoreType.Any Status') }}">
                                <option value="1"> @lang('components/StoreType.Active') </option>
                                <option value="0"> @lang('components/StoreType.Inactive') </option>
                            </x-input.select>
                        </x-input.group>
                    
                        {{-- Date renge filter --}}

                        <x-button.link wire:click="resetFilters" class="mt-2"> @lang('component.Reset Filters') </x-button.link>

                    </x-dropdown>

                    {{--  Hide & show columns dropdown --}}
                    <x-table.view-columns/>

                    @can('add-user')
                        {{-- button with icon,href --}}
                        <x-table.button.add icon href="{{ route('add-store-type') }}" >@lang('components/StoreType.Add Store')</x-table.button.add>
                    @endcan

                </x-core.card-toolbar>
        </x-slot>
        <x-slot name="body">

            {{--  Table with perPage and pagination --}}
            <x-table perPage total="{{ $StoreTypes->total() }}" id="users-list" paginate="{{ $StoreTypes->links() }}">
                <x-slot name="head">

                    {{-- Select-all checkbox  --}}
                    <x-table.heading-selected total="{{ $StoreTypes->total() }}" />

                    {{-- Dynamic columns heading --}}
                    <x-table.heading columns />
                    <x-table.heading> @lang('components/StoreType.Actions') </x-table.heading>

                </x-slot>
                <x-slot name="body">
                    {{-- Select records count (which rows checkbox checked) --}}
                    <x-table.row-selected-count selectPage="{{ $selectPage }}" selectedAll="{{ $selectAll }}"
                        count="{{ $StoreTypes->count() }}" total="{{ $StoreTypes->total() }}" />

                        {{-- Table row --}}
                        @forelse ($StoreTypes as $StoreType)
                        <x-table.row wire:key="row-{{ $StoreType->id }}">

                            {{-- Select checkbox --}}
                            <x-table.cell-selected value="{{ $StoreType->id }}" />
                        
                            <x-table.cell column="name" href="">{{ $StoreType->name }}</x-table.cell>

                            <x-table.cell-date column="created_at">{{ $StoreType->created_at }}</x-table.cell-date>

                            <x-table.cell-switch column="status" status="{{ $StoreType->status }}"
                                wire:change="statusUpdate({{ $StoreType->id }},{{ $StoreType->status }})">
                            </x-table.cell-switch>
                           
                            @if (count(config('translatable.locales')) > 1)
                                <x-table.cell-lang :data="json_decode($StoreType)" route="edit-store-type"/>
                            @endif
                            
                            {{-- Action , examples- edit, view, delete  --}}
                            <x-table.cell-dropdown>
                                <x-table.dropdown-item class="dropdown-item" 
                                    title="{{ __('components/StoreType.Edit') }}" href="{{ route('edit-store-type', $StoreType) }}">
                                    {{ __('components/StoreType.Edit') }}
                                </x-table.dropdown-item>
                                <x-table.dropdown-item class="dropdown-item text-danger" 
                                    title="{{ __('components/StoreType.Delete') }}" wire:click="destroyConfirm({{ $StoreType->id }})">
                                    {{ __('components/StoreType.Delete') }}
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
