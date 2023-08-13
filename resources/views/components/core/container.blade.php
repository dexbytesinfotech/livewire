@props([
    'alert' => null
])
<div class="container-fluid py-1">
    <div class="row mt-4 mr-1">
        <div class="col-12">
            {{ $alert }}
                {{ $slot }}
        </div>
    </div>
</div>