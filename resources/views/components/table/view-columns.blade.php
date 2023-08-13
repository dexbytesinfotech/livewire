<x-dropdown>
    <x-slot name="label">
        <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium mui-datatables-i4bv87-MuiSvgIcon-root" focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="ViewColumnIcon"><path d="M14.67 5v14H9.33V5h5.34zm1 14H21V5h-5.33v14zm-7.34 0V5H3v14h5.33z"></path></svg>
    </x-slot>
    @foreach ($this->columns as $column)
        @if($column['viewColumns'])
        <x-dropdown.item>
            <x-input.checkbox label="{{ Str::ucfirst($column['label']) }}"
                wire:model="selectedColumns" value="{{ $column['field'] }}" />
        </x-dropdown.item>
        @endif 
    @endforeach
</x-dropdown>