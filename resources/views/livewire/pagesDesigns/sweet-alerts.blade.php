<div class="container-fluid py-4 bg-gray-200">
    <div class="row min-vh-75">
        <div class="col-lg-8 col-md-12 mx-auto">
            <div class="places-sweet-alerts mt-5">
                <h2 class="text-center">Sweet Alert</h2>
                <p class="category text-center">A beautiful plugin, that replace the classic alert, Handcrafted
                    by our friend <a target="_blank" href="https://twitter.com/t4t5">Tristan Edwards</a>. Please
                    check out the <a href="https://sweetalert2.github.io/" target="_blank">full
                        documentation.</a></p>
            </div>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="card-text">Basic example</p>
                            <button class="btn bg-gradient-primary mb-0 mx-auto"
                                onclick="material.showSwal('basic')">Try me!</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="card-text">A success message</p>
                            <button class="btn bg-gradient-primary mb-0 mx-auto"
                                onclick="material.showSwal('success-message')">Try me!</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="card-text">Custom HTML description</p>
                            <button class="btn bg-gradient-primary mb-0 mx-auto"
                                onclick="material.showSwal('custom-html')">Try me!</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="card-text">Gitgub avatar request</p>
                            <button class="btn bg-gradient-primary mb-0 mx-auto"
                                onclick="material.showSwal('input-field')">Try me!</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="card-text">A title with a text under</p>
                            <button class="btn bg-gradient-primary mb-0 mx-auto"
                                onclick="material.showSwal('title-and-text')">Try me!</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="card-text">A message with auto close</p>
                            <button class="btn bg-gradient-primary mb-0 mx-auto"
                                onclick="material.showSwal('auto-close')">Try me!</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 mb-5">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="card-text">A warning message, with a function attached to the "Confirm"
                                Button...</p>
                            <button class="btn bg-gradient-primary mb-0 mx-auto"
                                onclick="material.showSwal('warning-message-and-confirmation')">Try me!</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="card-text">...and by passing a parameter, you can execute something else
                                for "Cancel"</p>
                            <button class="btn bg-gradient-primary mb-0 mx-auto"
                                onclick="material.showSwal('warning-message-and-cancel')">Try me!</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="card">
                        <div class="card-body text-center">
                            <p class="card-text">Right-to-left support for Arabic, Persian, Hebrew, and other
                                RTL languages</p>
                            <button class="btn bg-gradient-primary mb-0 mx-auto"
                                onclick="material.showSwal('rtl-language')">Try me!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script src="{{ asset('assets') }}/js/plugins/sweetalert.min.js"></script> 
@endpush
