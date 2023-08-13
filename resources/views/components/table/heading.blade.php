@props([
    'sortable' => null,
    'direction' => null,
    'columns' => false,
])
@empty($columns)
<th style="padding: 0.75rem 0.5rem">
    @unless ($sortable)
        <span class="text-xs text-secondary text-uppercase">{{ $slot }}</span>
    @else
        <a {{ $attributes->except('class') }} class="text-xs text-secondary text-uppercase">
            <span>{{ $slot }}</span>

            <span>
                @if ($direction === 'asc')
                    <i class="fas fa-sort-up cursor-pointer"></i>
                @elseif ($direction === 'desc')
                    <i class="fas fa-sort-down cursor-pointer"></i>
                @else
                    <i class="fas fa-sort cursor-pointer"></i>
                @endif
            </span>
        </a>
    @endif
</th>
@else

@isset($this->columns)
@foreach ($this->columns as $column)
<th class='{{ isset($column['cellClasses']) ? $column['cellClasses'] : '' }}' style="padding: 0.75rem 0.5rem" 
@if(!in_array($column['field'],$this->selectedColumns))
        hidden
@endif
    @if($column['sortable'])
        wire:click="sortBy('{{ $column['field'] }}','{{ $column['translate'] }}')"
    @endif
    @if($column['direction'])
    :direction="$this->sorts[$column['field']] ?? null"
    @endif
    >
    
    @unless ($column['sortable'])
        <span class="text-xs text-secondary text-uppercase">{{ $column['label'] }}</span>
    @else
        <a {{ $attributes->except('class') }} class="text-xs text-secondary text-uppercase">
            <span>{{ $column['label'] }}</span>
            
            <span>
                @if (isset($this->sorts[$column['field']]) && $this->sorts[$column['field']] === 'asc')
                    <i class="fas fa-sort-up cursor-pointer"></i>
                @elseif (isset($this->sorts[$column['field']]) && $this->sorts[$column['field']] === 'desc')
                    <i class="fas fa-sort-down cursor-pointer"></i>
                @else
                    <i class="fas fa-sort cursor-pointer"></i>
                @endif
            </span>
        </a>
    @endif
</th>
@endforeach
@endisset
@endempty
