@props([
    'href' => '#',
    'type' => 'link',
    'icon' => null
])
@if ($type == 'link')   
<a class="btn bg-gradient-dark mb-0 me-4" href="{{ $href }}">
    @if ($icon)
        <i class="material-icons text-sm">add</i>
    @endif 
     {{ (empty(trim($slot))) ? __('component.Add New') : $slot}}</a>    
@else
<button class="btn bg-gradient-dark mb-0 me-4" type="button" name="button">
    @if ($icon)
    <i class="material-icons text-sm">add</i>
    @endif {{ (empty(trim($slot))) ? 'Add New' : $slot}} </button> 
@endif

