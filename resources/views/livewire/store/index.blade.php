{{-- Page Title --}}
@section('page_title')
    @if($this->application_status == 'waiting')
        @lang("components/store.page_title") 
    @else
        @lang("components/store.Stores")
    @endif
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
                    <x-dropdown label="{{ __('components/store.Actions') }}">
                        <x-dropdown.item wire:click="exportSelected">
                            @lang('components/store.Export')
                        </x-dropdown.item>

                        
                        <x-dropdown.item wire:click="destroyMultiple()" class="dropdown-item text-danger">
                            @lang('components/store.Delete')
                        </x-dropdown.item>
                    </x-dropdown>


                     {{-- Filter Action  --}}
                     <x-dropdown class="px-2 py-3 dropdown-md" label="{{ __('component.Filter') }}">
                        <x-input.group inline for="filters.status" label="{{ __('components/store.Status') }}">
                            <x-input.select wire:model="filters.status" placeholder="{{ __('components/store.Any Status') }}">
                                <option value="1"> @lang('components/store.Active') </option>
                                <option value="0"> @lang('components/store.Inactive') </option>
                            </x-input.select>
                        </x-input.group>
                    

                        <x-input.group inline for="filters.application_status" label="{{ __('components/store.Account status') }}">
                            <x-input.select wire:model="filters.application_status" placeholder="{{ __('components/store.All Account Status') }}">
                                <option  class="optionGroup"  value="approved">@lang('components/store.Approved')</option>
                                <option  class="optionGroup"  value="suspended">@lang('components/store.Suspend')</option>  
                            </x-input.select>
                        </x-input.group>

                        <x-input.group inline for="filters.store_type" label="{{ __('components/store.Store Type') }}">
                            <x-input.select wire:model="filters.store_type" placeholder="{{ __('components/store.All Type') }}">
                                @foreach ($StoreTypes as $StoreType)
                                    <option  class="optionGroup"  value="{{ $StoreType->name }}"> {{ $StoreType->name }}</option>
                                @endforeach  
                            </x-input.select>
                        </x-input.group>


                        
                    
                        {{-- Date renge filter --}}
                        <x-table.filter-date-input />

                        <x-button.link wire:click="resetFilters" class="mt-2"> @lang('component.Reset Filters') </x-button.link>

                    </x-dropdown>

                    {{--  Hide & show columns dropdown --}}
<x-table.view-columns/>

                    @can('add-store')
                        {{-- button with icon,href --}}
                        <x-table.button.add icon href="{{ route('add-store') }}" > @lang('components/store.Add Store') </x-table.button.add>
                    @endcan

                </x-core.card-toolbar>
        </x-slot>
        <x-slot name="body">

            {{--  Table with perPage and pagination --}}
            <x-table perPage total="{{ $stores->total() }}" id="stores-list" paginate="{{ $stores->links() }}">
                <x-slot name="head">

                    {{-- Select-all checkbox  --}}
                    <x-table.heading-selected total="{{ $stores->total() }}" />

                    {{-- Dynamic columns heading --}}
                    <x-table.heading columns />
                    <x-table.heading> @lang('components/store.Actions') </x-table.heading>

                </x-slot>
                <x-slot name="body">
                    {{-- Select records count (which rows checkbox checked) --}}
                    <x-table.row-selected-count selectPage="{{ $selectPage }}" selectedAll="{{ $selectAll }}"
                        count="{{ $stores->count() }}" total="{{ $stores->total() }}" />

                        {{-- Table row --}}
                        @forelse ($stores as $store)
                        <x-table.row wire:key="row-{{ $store->id }}">

                            {{-- Select checkbox --}}
                            <x-table.cell-selected value="{{ $store->id }}" />
                        
                            <x-table.cell-avatar column="logo_path" url="{{ $store->logo_path }}"
                                class="position-relative" />
                        
                            <x-table.cell column="name" href="{{ route('edit-store' , $store) }}">{{ $store->name }}</x-table.cell>
                            <x-table.cell column="email" >{{ $store->email }}</x-table.cell>

                            <x-table.cell-phone column="phone" code="{{ $store->country_code }}"
                                value="{{ $store->phone }}" />

                            <x-table.cell-switch column="status" status="{{ $store->status }}"
                                wire:change="statusUpdate({{ $store->id }},{{ $store->status }})">
                                @if($store->application_status =='suspended')
                                    <div class="text-xxs text-warning mt-4 mx-2" >{{ __('components/store.Suspended') }}</div>
                                @endif
                            </x-table.cell-switch>

                            @if(count(config('translatable.locales')) > 1)
                                <x-table.cell-lang :data="json_decode($store)" route="edit-store"/>
                            @endif

                            <x-table.cell-date column="created_at">{{ $store->created_at }}</x-table.cell-date>

                            {{-- Action , examples- edit, view, delete  --}}
                                @if($this->application_status == 'waiting')
                                <x-table.cell>
                                    <x-button.success title="@lang('components/store.Approved')"
                                    wire:click="applicationConfirm({{ $store->id }}, 'approved')">
                                        <i class="material-icons">check</i>
                                        <div class="ripple-container"></div>
                                    </x-button.success>

                                    <x-button.danger   title="@lang('components/store.Reject')"
                                    wire:click="applicationConfirm({{ $store->id }}, 'rejected')">
                                        <i class="material-icons">close</i>
                                        <div class="ripple-container"></div>
                                    </x-button.danger>
                                </x-table.cell>
                                @else
                                    <x-table.cell-dropdown>
                                    @can('edit-store')
                                        <x-table.dropdown-item class="dropdown-item" 
                                            title="{{ __('components/store.Searchable') }}" wire:click="searchableConfirm({{ $store }})">
                                            {{ $store->is_searchable ? trans("components/store.Remove to Searchable") : trans("components/store.Mark as Searchable") }}
                                        </x-table.dropdown-item>

                                        <x-table.dropdown-item class="dropdown-item" 
                                            title="{{ __('components/store.Top Store') }}" wire:click="featuresConfirm({{ $store }})">
                                            {{ $store->is_features ? trans("components/store.Remove to Top Store") : trans("components/store.Mark as Top Store") }}
                                        </x-table.dropdown-item>

                                        <x-table.dropdown-item class="dropdown-item" 
                                            title="{{ __('components/store.Edit') }}" href="{{ route('edit-store', $store) }}">
                                            {{ __('components/store.Edit') }}
                                        </x-table.dropdown-item>
                                    @endcan

                                    <x-table.dropdown-item class="dropdown-item text-danger" 
                                        title="{{ __('components/store.Delete') }}" wire:click="destroyConfirm({{ $store->id }})">
                                        {{ __('components/store.Delete') }}
                                    </x-table.dropdown-item>
                                </x-table.cell-dropdown>
                                @endif

                        </x-table.row>
                    @empty
                        <x-table.no-record-found />
                    @endforelse
                </x-slot>
            </x-table>
        </x-slot>
    </x-core.card>
</x-core.container>
