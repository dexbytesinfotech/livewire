<div class="container-fluid py-4 bg-gray-200">
    <div class="row mb-5">
        <div class="col-lg-9 col-12 mx-auto position-relative">         
        
            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Cache Clear</h5>
                    <p>Clear CMS caching: database caching, static blocks... Run this command when you don't see the changes after updating data.</p>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" wire:click="mobileCacheClear" class="btn bg-gradient-info m-0 ms-2">Clear all api cache</button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" wire:click="cacheClear" class="btn bg-gradient-danger m-0 ms-2">Clear all CMS cache</button>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>   


            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Config Clear</h5>
                    <p>You might need to refresh the config caching when you change something on production environment.</p>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" wire:click="configClear" class="btn bg-gradient-warning m-0 ms-2">Clear Config Cache</button>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>  


            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Route Clear</h5>
                    <p>Clear cache routing.</p>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" wire:click="routeClear" class="btn bg-gradient-dark m-0 ms-2">Clear route cache</button>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>  

         </div>
    </div>
</div>
@push('js')
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
@endpush

