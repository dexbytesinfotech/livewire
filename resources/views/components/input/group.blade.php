
@props([
    'label',
    'for',
    'error' => false,
    'helpText' => false,
    'inline' => false,
    'paddingless' => true,
    'borderless' => false,
    'colspan' => null,
])

@if($inline)
    <div class="mb-3">
        <label for="{{ $for }}" class="mb-0 block text-sm font-medium leading-5 text-gray-700">{{ $label }}</label>
        <div class="mt-1 relative rounded-md">
            {{ $slot }}

            @if ($error)
                <div class="mt-1 text-danger text-sm">{{ $error }}</div>
            @endif

            @if ($helpText)
                <p class="mt-2 text-sm text-secondary">{{ $helpText }}</p>
            @endif
        </div>
    </div>
@else
<div class="{{ $colspan ? $colspan : ' col-12 ' }} mb-4">
    <div class="input-group input-group-static {{ $borderless ? '' : ' sm:border-t ' }} sm:border-gray-200 {{ $paddingless ? '' : ' sm:py-5 ' }}">
        <label for="{{ $for }}">
            {{ $label }}
        </label>
            {{ $slot }}
    </div>
        @if ($error)
        <div class="mt-1 text-danger text-sm">{{ $error }}</div>
        @endif

        @if ($helpText)
        <p class="mt-2 text-sm text-secondary">{{ $helpText }}</p>
        @endif
</div>
@endif
