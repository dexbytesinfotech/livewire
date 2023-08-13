<div wire:ignore  {{ $attributes->merge(['class' => "m-2 me-1 ms-auto h-100 w-100"]) }}>
    <div x-data x-ref="quill" x-init="quill = new Quill($refs.quill, {theme: 'snow',});
            quill.on('text-change', function () {
            $dispatch('quill-text-change', quill.root.innerHTML);
        });"
        x-on:quill-text-change.debounce.500ms="@this.set('{{$attributes->get('wire:model.lazy') }}', $event.detail)">
        {!! $slot !!}
    </div>
</div>

