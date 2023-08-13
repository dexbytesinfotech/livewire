@props([
    'class' => null,
    'header' => null,
    'body' => null
])
<div {{ $attributes }} class="card {{ $class }}" id="basic-info">
    @isset($header)
        <div class="card-header">
             {{ $header }}
        </div>
    @endisset 
    @isset($body)        
    <div class="card-body">
        {{ $body }}
    </div>
    @endisset
</div>