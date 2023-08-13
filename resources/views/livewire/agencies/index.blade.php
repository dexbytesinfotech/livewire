{{-- Page Title --}}
@section('page_title')
    @lang('components/agency.page_title')
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

                @can('add-user')
                    {{-- button with icon,href --}}
                    <x-table.button.add icon href="{{ route('add-agency') }}">@lang('components/agency.Add Agency') </x-table.button.add>
                @endcan

            </x-core.card-toolbar>
        </x-slot>
        <x-slot name="body">

            {{--  Table with perPage and pagination --}}
            <x-table perPage total="{{ $agencies->total() }}" id="users-list" paginate="{{ $agencies->links() }}">
                <x-slot name="head">

                    {{-- Select-all checkbox  --}}
                    <x-table.heading-selected total="{{ $agencies->total() }}" />

                    {{-- Dynamic columns heading --}}
                    <x-table.heading columns />
                    <x-table.heading> @lang('components/device.Actions') </x-table.heading>

                </x-slot>
                <x-slot name="body">
                    {{-- Select records count (which rows checkbox checked) --}}
                    <x-table.row-selected-count selectPage="{{ $selectPage }}" selectedAll="{{ $selectAll }}"
                        count="{{ $agencies->count() }}" total="{{ $agencies->total() }}" />

                    {{-- Table row --}}
                    @forelse ($agencies as $agency)
                        <x-table.row wire:key="row-{{ $agency->id }}">

                            {{-- Select checkbox --}}
                            <x-table.cell-selected value="{{ $agency->id }}" />

                            <x-table.cell column="agency_name" href="{{ route('edit-agency' , $agency) }}">{{ $agency->agency_name }}</x-table.cell>

                            <x-table.cell-phone column="phone_number" code="{{ $agency->country_code }}" 
                                value="{{ $agency->phone_number }}" />

                            <x-table.cell>
                                <div class="form-check form-switch ms-3">
                                    <input class="form-check-input" type="checkbox"
                                        id="flexSwitchCheckDefault35"
                                        wire:change="statusAccountUpdate({{ $agency->id }}, {{ $agency->status }})"
                                        @if ($agency->status) checked="" @endif>
                                </div>
                            </x-table.cell>

                            <x-table.cell-date column="created_at">{{ $agency->created_at }}</x-table.cell-date>

                            {{-- Action , examples- edit, view, delete  --}}
                            <x-table.cell-dropdown>
                                @can('edit-agency')
                                    <x-table.dropdown-item class="dropdown-item" title="{{ __('components/agency.Edit') }}"
                                        href="{{ route('edit-agency', $agency) }}">
                                        {{ __('components/agency.Edit') }}
                                    </x-table.dropdown-item>
                                @endcan
                                <x-table.dropdown-item class="dropdown-item text-danger"
                                    title="{{ __('components/agency.Delete') }}"
                                    wire:click="destroyConfirm({{ $agency->id }})">
                                    {{ __('components/agency.Delete') }}
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
