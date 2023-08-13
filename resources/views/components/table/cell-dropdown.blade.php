@props(['label' => ''])
<x-table.cell {{ $attributes }}>
    <div class="dropdown dropup dropleft">
        <button class="btn bg-gradient-default mb-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" >
            @empty ($label)
            <span class="material-icons">
                more_vert
            </span>
            @else
            {{ $label }}
            @endempty 
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            {{ $slot }}
        </ul>
</div>
</x-table.cell>