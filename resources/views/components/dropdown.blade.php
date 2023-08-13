@props(['label' => ''])
<div class="btn-group dropdown">
<button type="button" class="btn  btn-outline-secondary dropdown-toggle mb-0" id="navbarDropdownMenuLink2" data-bs-toggle="dropdown" >
    {{ $label }}
</button>
<ul {{ $attributes->merge(['class' => 'dropdown-menu px-2 py-3']) }}  aria-labelledby="navbarDropdownMenuLink2">
    {{ $slot }}
</ul>
</div>