{{-- Page Title --}}
@section('page_title')
    @lang("components/country.page_title")
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
                    <x-dropdown label="{{ __('components/country.Actions') }}">
                        <x-dropdown.item wire:click="exportSelected">
                            @lang('components/country.Export')
                        </x-dropdown.item>

                        
                        <x-dropdown.item wire:click="destroyMultiple()" class="dropdown-item text-danger">
                            @lang('components/country.Delete')
                        </x-dropdown.item>
                    </x-dropdown>


                     {{-- Filter Action  --}}
                     <x-dropdown class="px-2 py-3 dropdown-md" label="{{ __('component.Filter') }}">
                        <x-input.group inline for="filters.status" label="{{ __('components/country.Status') }}">
                            <x-input.select wire:model="filters.status" placeholder="{{ __('components/country.Any Status') }}">
                                <option value="1"> @lang('components/country.Active') </option>
                                <option value="0"> @lang('components/country.Inactive') </option>
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
                        <x-table.button.add icon href="{{ route('add-country') }}" > @lang('components/country.Add Country')</x-table.button.add>
                    @endcan

                </x-core.card-toolbar>
        </x-slot>
        <x-slot name="body">

            {{--  Table with perPage and pagination --}}
            <x-table perPage total="{{ $countrys->total() }}" id="country-list" paginate="{{ $countrys->links() }}">
                <x-slot name="head">

                    {{-- Select-all checkbox  --}}
                    <x-table.heading-selected total="{{ $countrys->total() }}" />

                    {{-- Dynamic columns heading --}}
                    <x-table.heading columns />
                    <x-table.heading> @lang('components/country.Actions') </x-table.heading>

                </x-slot>
                <x-slot name="body">
                    {{-- Select records count (which rows checkbox checked) --}}
                    <x-table.row-selected-count selectPage="{{ $selectPage }}" selectedAll="{{ $selectAll }}"
                        count="{{ $countrys->count() }}" total="{{ $countrys->total() }}" />

                        {{-- Table row --}}
                        @forelse ($countrys as $country)
                        <x-table.row wire:key="row-{{ $country->id }}">

                            {{-- Select checkbox --}}
                            <x-table.cell-selected value="{{ $country->id }}" />
                        
                            <x-table.cell column="name" href="">{{ $country->name }}</x-table.cell>
                            <x-table.cell column="country_code" href="">{{ $country->country_code }}</x-table.cell>
                            <x-table.cell column="country_ios_code" href="">{{ $country->country_ios_code }}</x-table.cell>

                            <x-table.cell-date column="created_at">{{ $country->created_at }}</x-table.cell-date>

                            <x-table.cell-switch column="status" status="{{ $country->status }}"
                                wire:change="statusUpdate({{ $country->id }},{{ $country->status }})">
                            </x-table.cell-switch>
                        
                            {{-- Action , examples- edit, view, delete  --}}
                            <x-table.cell-dropdown>
                                @can('edit-country')
                                <x-table.dropdown-item class="dropdown-item" 
                                    title="{{ __('components/country.Edit') }}" href="{{ route('edit-country', $country) }}">
                                    {{ __('components/country.Edit') }}
                                </x-table.dropdown-item>
                                @endcan
                                <x-table.dropdown-item class="dropdown-item text-danger" 
                                    title="{{ __('components/country.Delete') }}" wire:click="destroyConfirm({{ $country->id }})">
                                    {{ __('components/country.Delete') }}
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
