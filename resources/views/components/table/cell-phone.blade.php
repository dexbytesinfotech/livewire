@props([
    'code' => null,
    'value' => null
])
<x-table.cell {{ $attributes }}> + {{ $code}} {{ $value  }}</x-table.cell>
