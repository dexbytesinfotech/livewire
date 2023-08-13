{{-- Page Title --}}
@section('page_title')
    @lang('components/device.page_title')
@endsection

<x-core.container wire:init="init">

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
                <x-dropdown label="{{ __('components/device.Actions') }}">
                    <x-dropdown.item wire:click="destroyMultiple()" class="dropdown-item text-danger">
                        @lang('components/device.Delete')
                    </x-dropdown.item>
                </x-dropdown>


                {{-- Filter Action  --}}
                <x-dropdown class="px-2 py-3 dropdown-md" label="{{ __('component.Filter') }}">
                    <x-input.group inline for="filters.status" label="{{ __('components/device.Status') }}">
                        <x-input.select wire:model="filters.status"
                            placeholder="{{ __('components/device.Any Status') }}">
                            @foreach ($allStatus as $key => $value)
                                <option value="{{ $key }}"> {{ __('components/device.' . ucfirst($value)) }}
                                </option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-button.link wire:click="resetFilters" class="mt-2"> @lang('component.Reset Filters') </x-button.link>

                </x-dropdown>

                @can('add-user')
                    {{-- button with icon,href --}}
                    <x-table.button.add icon href="{{ route('add-device') }}">@lang('components/device.Add Device') </x-table.button.add>
                @endcan

            </x-core.card-toolbar>
        </x-slot>
        <x-slot name="body">

            {{--  Table with perPage and pagination --}}
            <x-table perPage total="{{ $devices->total() }}" id="users-list" paginate="{{ $devices->links() }}">
                <x-slot name="head">

                    {{-- Select-all checkbox  --}}
                    <x-table.heading-selected total="{{ $devices->total() }}" />

                    {{-- Dynamic columns heading --}}
                    <x-table.heading columns />
                    <x-table.heading> @lang('components/device.Actions') </x-table.heading>

                </x-slot>
                <x-slot name="body">
                    {{-- Select records count (which rows checkbox checked) --}}
                    <x-table.row-selected-count selectPage="{{ $selectPage }}" selectedAll="{{ $selectAll }}"
                        count="{{ $devices->count() }}" total="{{ $devices->total() }}" />

                    {{-- Table row --}}
                    @forelse ($devices as $device)
                        <x-table.row wire:key="row-{{ $device->id }}">

                            {{-- Select checkbox --}}
                            <x-table.cell-selected value="{{ $device->id }}" />

                            <x-table.cell column="device_name" href="">{{ $device->device_name }}</x-table.cell>
                            <x-table.cell column="device_model_id" href="">
                                {{ $device->device_model_id }}</x-table.cell>
                            @if ($device->agency != null)
                                <x-table.cell column="agency_name"
                                    href="">{{ $device->agency->agency_name }}</x-table.cell>
                            @else
                                <x-table.cell column="agency_name" href="">---</x-table.cell>
                            @endif
                            @if ($device->driver != null)
                                <x-table.cell column="driver_name"
                                    href="">{{ $device->driver->driver_name }}</x-table.cell>
                            @else
                                <x-table.cell column="driver_name" href="">---</x-table.cell>
                            @endif
                            <x-table.cell-date column="created_at">{{ $device->created_at }}</x-table.cell-date>

                            <x-table.cell column="status">{{ $allStatus[$device->status] }}</x-table.cell>

                            {{-- Action , examples- edit, view, delete  --}}
                            <x-table.cell-dropdown>
                                @if ($device->agency == null)
                                    <x-table.dropdown-item class="dropdown-item"
                                        title="{{ __('components/device.Assign Agency') }}"
                                        wire:click="$emit('openModal', 'devices.assign-agency', {{ json_encode(['deviceId' => $device->id]) }})">
                                        {{ __('components/device.Assign Agency') }}
                                    </x-table.dropdown-item>
                                @else
                                    <x-table.dropdown-item class="dropdown-item"
                                        title="{{ __('components/device.Remove Agency') }}"
                                        wire:click="removeAgencyConfirm({{ $device->id }})">{{ __('components/device.Remove Agency') }}
                                    </x-table.dropdown-item>
                                @endif
                                @can('edit-device')
                                    <x-table.dropdown-item class="dropdown-item" title="{{ __('components/device.Edit') }}"
                                        href="{{ route('edit-device', $device) }}">
                                        {{ __('components/device.Edit') }}
                                    </x-table.dropdown-item>
                                @endcan
                                <x-table.dropdown-item class="dropdown-item text-danger"
                                    title="{{ __('components/device.Delete') }}"
                                    wire:click="destroyConfirm({{ $device->id }})">
                                    {{ __('components/device.Delete') }}
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
