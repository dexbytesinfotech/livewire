
    <main class="main-content  mt-0">
      <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1448375240586-882707db888b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1650&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
          <div class="row">
            <div class="col-lg-4 col-md-8 mx-auto">
              <div class="card z-index-0">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Register with</h4>
                    <div class="row mt-3">
                      <div class="col-2 text-center ms-auto">
                        <a class="btn btn-link px-3" href="javascript:;">
                          <i class="fa fa-facebook text-white text-lg"></i>
                        </a>
                      </div>
                      <div class="col-2 text-center px-1">
                        <a class="btn btn-link px-3" href="javascript:;">
                          <i class="fa fa-github text-white text-lg"></i>
                        </a>
                      </div>
                      <div class="col-2 text-center me-auto">
                        <a class="btn btn-link px-3" href="javascript:;">
                          <i class="fa fa-google text-white text-lg"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row px-xl-5 px-sm-4 px-3">
                  <div class="mt-2 position-relative text-center">
                    <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                      or
                    </p>
                  </div>
                </div>
                <div class="card-body">
                  <form role="form">
                    <div class="input-group input-group-dynamic mb-3">
                      <label class="form-label">Name</label>
                      <input type="text" class="form-control" aria-label="Name">
                    </div>
                    <div class="input-group input-group-dynamic mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" class="form-control" aria-label="Email">
                    </div>
                    <div class="input-group input-group-dynamic mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" class="form-control" aria-label="Password">
                    </div>
                    <div class="form-check text-start">
                      <input class="form-check-input bg-dark border-dark" type="checkbox" value="" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                      </label>
                    </div>
                    <div class="text-center">
                      <button type="button" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                    </div>
                    <p class="text-sm mt-3 mb-0">Already have an account? <a href="javascript:;" class="text-dark font-weight-bolder">Sign in</a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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