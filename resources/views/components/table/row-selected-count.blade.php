@props(
    [
        'count' => 0,
        'total' => 0,
        'selectedAll' => 0,
        'selectPage' => null
    ]
)
@if ($selectPage)
<x-table.row class="bg-cool-gray-200" wire:key="row-message">
    <x-table.cell colspan="100">
        @unless ($selectedAll)
        <div>
            <span class="text-danger text-bold"> @lang('component.You have selected') <strong>{{ $count }} </strong> @lang('component.Record, do you want to select all') <strong>{{ $total }}</strong>?</span>
            <a href="javascript:void()" wire:click="selectAll" class="ml-1 text-decoration-underline link-info m-1 text-bold"> @lang('component.Select All') </a>
        </div>
        @else
        <span class="text-danger text-bold"> @lang('component.You are currently selecting all',['total' => $total])</span>
        @endif
    </x-table.cell>
</x-table.row>
@endif