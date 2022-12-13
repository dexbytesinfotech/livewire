<main class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div
                        class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-dark h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                            style="background-image: url('{{ asset('assets') }}/img/illustrations/illustration-lock.jpg'); background-size: cover;">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                        <div class="card card-plain py-lg-3">
                            <div class="card-body text-center">
                                <h4 class="mb-0 font-weight-bolder">Mike Priesler</h4>
                                <p class="mb-4">Enter password to unlock your account.</p>
                                <form role="form">
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="text-center">
                                        <button type="button"
                                            class="btn btn-lg w-100 bg-gradient-dark mb-0">Unlock</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@push('js')
<script src="{{ asset('assets') }}/js/plugins/jquery-3.6.0.min.js"></script>
<script>
    $(function () {

        function checkForInput(element) {

            const $label = $(element).parent();

            if ($(element).val().length > 0) {
                $label.addClass('is-filled');
            } else {
                $label.removeClass('is-filled');
            }
        }
        
        var input = $(".input-group input");
        input.focusin(function () {
            $(this).parent().addClass("focused is-focused");
        });

        $('input').on('change keyup', function () {
            checkForInput(this);
        });

        input.focusout(function () {
            $(this).parent().removeClass("focused is-focused");
        });
    });

</script>

@endpush
