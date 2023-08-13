
@props([
    'placeholder' => null,
    'trailingAddOn' => null,
])

  <select {{ $attributes->merge(['class' => 'form-select px-2 block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none  focus:border-blue-300 sm:text-sm sm:leading-5' . ($trailingAddOn ? ' rounded-r-none' : '')]) }}>
    @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif

    {{ $slot }}
  </select>

  @if ($trailingAddOn)
    {{ $trailingAddOn }}
  @endif
