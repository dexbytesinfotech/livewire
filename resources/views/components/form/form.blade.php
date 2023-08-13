@props([
    'submitText' => null,
    'submitTarget' => null,
    'cancelText' => null,
    'cancelRoute' => null,
])
<form wire:submit.prevent="{{ $submitTarget }}">
    <div class="row">
        {{ $slot }}
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-end mt-4">
                @if ($cancelRoute)                    
                <a  href="{{ $cancelRoute }}" class="btn btn-light m-0"> {{ empty($cancelText) ? "Cancel" : $cancelText }}</a>
                @endif
                
                <button type="submit" wire:loading.attr="disabled" name="submit" class="btn bg-gradient-dark m-0 ms-2">
                    <span wire:loading.remove wire:target="{{ $submitTarget }}"> {{ empty($submitText) ? "Create" : $submitText }}</span>
                    <span wire:loading wire:target="{{ $submitTarget }}"><x-buttonSpinner></x-buttonSpinner></span>
                </button>
            </div>
        </div>
    </div>
</form>