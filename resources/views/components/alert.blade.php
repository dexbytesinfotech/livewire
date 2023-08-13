<div class="row">
    <div class="col-sm-12">
        <div {{ $attributes->merge(['class' => 'alert  alert-dismissible text-white mt-3']) }} role="alert">
            <span class="text-sm"> {{ $slot }}</span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>