@props([
    'total' => 0
])
<th style="padding: 0.75rem 0.5rem">
    @if ($total > 0)
            <x-input.checkbox wire:model="selectPage" />
    @else
         <x-input.checkbox disabled wire:model="selectPage" />
    @endif
</th>