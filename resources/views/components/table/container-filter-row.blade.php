@props([
    'perPage' => null,
    'seachable' => null
])

<div class="d-flex flex-row justify-content-end mx-4">
    @isset ($perPage)
        <x-table.per-page></x-table.per-page>
    @endif 
    {{ $slot }}
    @isset($seachable)
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1 input-group input-group-outline">
            <input wire:model="filters.search" type="text" class="form-control form-control-solid w-250px pl-5" placeholder="Search...">
            </div>
        </div>
    @endisset

</div>