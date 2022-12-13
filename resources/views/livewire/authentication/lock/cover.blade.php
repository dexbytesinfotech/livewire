
    <main class="main-content main-content-bg mt-0">
      <div class="page-header align-items-start min-vh-50 m-3 border-radius-lg" style="background-image: url('https://images.unsplash.com/photo-1526450589365-188216d2abbe?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1650&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mt-">Mike Praisler</h1>
              <p class="text-lead text-white">Enter password to unlock your account</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-md-n6 mt-n5 justify-content-center">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card">
              <div class="card-header text-center py-0">
                <div class="mt-n5">
                  <img class="avatar avatar-xxl shadow-lg" alt="Image placeholder" src="{{ asset('assets') }}/img/team-2.jpg">
                </div>
              </div>
              <div class="card-body text-center">
                <form role="form">
                  <div class="input-group input-group-outline">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control">
                  </div>
                  <div class="text-center">
                    <button type="button" class="btn btn-lg w-100 bg-gradient-primary mt-4 mb-0">Unlock</button>
                  </div>
                </form>
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