@props([
    'colspan' => null,
    'confirm' => false,
    'modelName' => 'password',
    'confirmModelName' => 'passwordConfirmation',
    'icon' => null,
])

<x-input.group autocomplete="new-password" colspan="{{ $colspan ? $colspan : ' col-6 ' }}" for="password" label="{{ __('component.Password') }}" :error="$errors->first($modelName)">
    <x-input.text type="password" wire:model.lazy="{{ $modelName }}" placeholder="{{ __('component.Enter a Password') }}" />
</x-input.group>
@if ($confirm)
    <x-input.group autocomplete="new-password" colspan="{{ $colspan ? $colspan : ' col-6 ' }}" for="passwordConfirmation" label="{{ __('component.Confirm Password') }}" :error="$errors->first($confirmModelName)">
        <x-input.text id="repassword" type="password" wire:model.lazy="{{ $confirmModelName }}" placeholder="{{ __('component.Enter a Confirm Password') }}" />
        @if ($icon)            
        <input type="checkbox" id="checkbox" onclick="showHidePassword()"><div class="text-sm m-1"> @lang('component.Show Password') </div>
        @endif
    </x-input.group>    
@endif

@push('js')
<script> 
function showHidePassword() {
    var x = document.getElementById("checkbox");
    var y = document.getElementById("repassword");
    if (x.checked == true){
      y.type = "text";
  } else {
    y.type = "password";
  }
    
  }
</script>
@endpush