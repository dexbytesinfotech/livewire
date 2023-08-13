@props([
    'add' => null,
    'filter' => null,
    'export' =>  null
])

<a class="btn bg-gradient-dark mb-0 me-1" href=""><i
                class="material-icons text-sm">add</i>&nbsp;&nbsp; @lang('component.Add New') </a>

<button wire:click="filter" class="btn btn-outline-secondary me-3 mb-0 mt-sm-0 mt-1" type="button" name="button">
<i class="material-icons text-sm">filter_alt</i> @lang('component.Filter') </button>