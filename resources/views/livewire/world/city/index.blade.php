{{-- Page Title --}}
@section('page_title')
    @lang("components/city.page_title")
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
                    <x-dropdown label="{{ __('components/city.Actions') }}">
                        <x-dropdown.item wire:click="exportSelected">
                            @lang('components/city.Export')
                        </x-dropdown.item>

                        
                        <x-dropdown.item wire:click="destroyMultiple()" class="dropdown-item text-danger">
                            @lang('components/city.Delete')
                        </x-dropdown.item>
                    </x-dropdown>


                     {{-- Filter Action  --}}
                     <x-dropdown class="px-2 py-3 dropdown-md" label="{{ __('component.Filter') }}">
                        <x-input.group inline for="filters.status" label="{{ __('components/city.Status') }}">
                            <x-input.select wire:model="filters.status" placeholder="{{ __('components/city.Any Status') }}">
                                <option value="1"> @lang('components/city.Active') </option>
                                <option value="0"> @lang('components/city.Inactive') </option>
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
                        <x-table.button.add icon href="{{ route('add-city') }}"> @lang('components/city.Add City') </x-table.button.add>
                    @endcan

                </x-core.card-toolbar>
        </x-slot>
        <x-slot name="body">

            {{--  Table with perPage and pagination --}}
            <x-table perPage total="{{ $cities->total() }}" id="users-list" paginate="{{ $cities->links() }}">
                <x-slot name="head">

                    {{-- Select-all checkbox  --}}
                    <x-table.heading-selected total="{{ $cities->total() }}" />

                    {{-- Dynamic columns heading --}}
                    <x-table.heading columns />
                    <x-table.heading> @lang('components/city.Actions') </x-table.heading>

                </x-slot>
                <x-slot name="body">
                    {{-- Select records count (which rows checkbox checked) --}}
                    <x-table.row-selected-count selectPage="{{ $selectPage }}" selectedAll="{{ $selectAll }}"
                        count="{{ $cities->count() }}" total="{{ $cities->total() }}" />

                        {{-- Table row --}}
                        @forelse ($cities as $city)
                        <x-table.row wire:key="row-{{ $city->id }}">

                            {{-- Select checkbox --}}
                            <x-table.cell-selected value="{{ $city->id }}" />
                        
                            <x-table.cell column="name" href="">{{ $city->name }}</x-table.cell>
                            <x-table.cell column="country_id" href="">{{ $city->country->name }}</x-table.cell>
                            <x-table.cell column="state_id" href="">{{ $city->state->name }}</x-table.cell>

                            <x-table.cell-date column="created_at">{{ $city->created_at }}</x-table.cell-date>

                            <x-table.cell-switch column="status" status="{{ $city->status }}"
                                wire:change="statusUpdate({{ $city->id }},{{ $city->status }})">
                            </x-table.cell-switch>

                        
                            {{-- Action , examples- edit, view, delete  --}}
                            <x-table.cell-dropdown>
                                @can('edit-city')
                                <x-table.dropdown-item class="dropdown-item" 
                                    title="{{ __('components/city.Edit') }}" href="{{ route('edit-city', $city) }}">
                                    {{ __('components/city.Edit') }}
                                </x-table.dropdown-item>
                                @endcan
                                <x-table.dropdown-item class="dropdown-item text-danger" 
                                    title="{{ __('components/city.Delete') }}" wire:click="destroyConfirm({{ $city->id }})">
                                    {{ __('components/city.Delete') }}
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
