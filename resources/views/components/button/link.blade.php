
<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'btn btn-outline-secondary me-1 mb-1 mt-1' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
    ]) }}
>
    {{ $slot }}
</button>
