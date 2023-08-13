{{-- Page Title --}}
@section('page_title')
    @lang("components/slider.page_title")
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
                    <x-dropdown label="{{ __('components/slider.Actions') }}">
                        <x-dropdown.item wire:click="exportSelected">
                            @lang('components/slider.Export')
                        </x-dropdown.item>

                        
                        <x-dropdown.item wire:click="destroyMultiple()" class="dropdown-item text-danger">
                            @lang('components/slider.Delete')
                        </x-dropdown.item>
                    </x-dropdown>


                     {{-- Filter Action  --}}
                     <x-dropdown class="px-2 py-3 dropdown-md" label="{{ __('component.Filter') }}">
                        <x-input.group inline for="filters.status" label="{{ __('components/slider.Status') }}">
                            <x-input.select wire:model="filters.status" placeholder="{{ __('components/slider.Any Status') }}">
                                <option value="1"> @lang('components/slider.Active') </option>
                                <option value="0"> @lang('components/slider.Inactive') </option>
                            </x-input.select>
                        </x-input.group>
                    
                        {{-- Date renge filter --}}
                        <x-table.filter-date-input >
                            <x-slot name="fromdate_label">
                                {{ trans("components/slider.START DATE TIME") }}
                            </x-slot>
                            <x-slot name="todate_label">
                                {{ trans("components/slider.END DATE TIME") }}
                            </x-slot>
                        </x-table.filter-date-input>

                        <x-button.link wire:click="resetFilters" class="mt-2"> @lang('component.Reset Filters') </x-button.link>

                    </x-dropdown>

                    {{--  Hide & show columns dropdown --}}
<x-table.view-columns/>

                    @can('add-user')
                        {{-- button with icon,href --}}
                        <x-table.button.add icon href="{{ route('add-slider') }}" > @lang("components/slider.Add Slider")</x-table.button.add>
                    @endcan

                </x-core.card-toolbar>
        </x-slot>
        <x-slot name="body">

            {{--  Table with perPage and pagination --}}
            <x-table perPage total="{{ $sliders->total() }}" id="users-list" paginate="{{ $sliders->links() }}">
                <x-slot name="head">

                    {{-- Select-all checkbox  --}}
                    <x-table.heading-selected total="{{ $sliders->total() }}" />

                    {{-- Dynamic columns heading --}}
                    <x-table.heading columns />
                    <x-table.heading> @lang('components/slider.Actions') </x-table.heading>

                </x-slot>
                <x-slot name="body">
                    {{-- Select records count (which rows checkbox checked) --}}
                    <x-table.row-selected-count selectPage="{{ $selectPage }}" selectedAll="{{ $selectAll }}"
                        count="{{ $sliders->count() }}" total="{{ $sliders->total() }}" />

                        {{-- Table row --}}
                        @forelse ($sliders as $slider)
                        <x-table.row wire:key="row-{{ $slider->id }}">

                            {{-- Select checkbox --}}
                            <x-table.cell-selected value="{{ $slider->id }}" />
                        
                            <x-table.cell column="name" href="">{{ $slider->name }}</x-table.cell>

                            <x-table.cell-date column="start_date_time">{{ $slider->start_date_time }}</x-table.cell-date>
                            <x-table.cell-date column="end_date_time">{{ $slider->end_date_time }}</x-table.cell-date>

                            <x-table.cell-switch column="status" status="{{ $slider->status }}"
                                wire:change="statusUpdate({{ $slider->id }},{{ $slider->status }})">
                            </x-table.cell-switch>

                            @if (count(config('translatable.locales')) > 1)
                                <x-table.cell-lang :data="json_decode($slider)" route="edit-slider"/>
                            @endif
                            {{-- Action , examples- edit, view, delete  --}}
                            <x-table.cell-dropdown>
                                @can('edit-slider')
                                <x-table.dropdown-item class="dropdown-item" 
                                    title="{{ __('components/slider.Edit') }}" href="{{ route('edit-slider', $slider) }}">
                                    {{ __('components/slider.Edit') }}
                                </x-table.dropdown-item>
                                @endcan

                                <x-table.dropdown-item class="dropdown-item text-danger" 
                                    title="{{ __('components/slider.Delete') }}" wire:click="destroyConfirm({{ $slider->id }})">
                                    {{ __('components/slider.Delete') }}
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
