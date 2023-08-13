
<main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-90 m-3 border-radius-xl" style="background-image: url('{{ asset('assets') }}/img/bg-home.jpg');">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-7 mx-auto">
            <div class="card z-index-0 my-auto">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 text-center">
                  <h4 class="font-weight-bolder text-white mb-0 mt-1">Reset password</h4>
                  
                </div>
              </div>
              <div class="card-body">
                @if (Session::has('status'))
                <div class="alert alert-success alert-dismissible text-white" role="alert">
                    <span class="text-sm">{{ Session::get('status') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                  <form wire:submit.prevent="verifyOtp" class="text-start">

                      <div class="input-group input-group-outline my-3 @if(strlen($otp ?? '') > 0) is-filled @endif">
                        <label class="form-label">OTP*</label>
                          <input wire:model="otp" type="password" class="form-control rounded-3" id="otp">
                          <a class="material-symbols-outlined password-visibility"  onclick="showHidePassword('otp', this)">
                            visibility_off
                          </a>
                      </div>
                      @error('otp')
                      <p class='text-danger inputerror'>{{ $message }} </p>
                      @enderror
                      <div class="text-center">
                          <button  type="submit" class="btn bg-gradient-dark btn-lg w-100 my-4 mb-2">Submit OTP</button>
                      </div>
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
  
          var input = $(".input-group input");
          input.focusin(function () {
              $(this).parent().addClass("focused is-focused");
          });

          input.focusout(function () {
              $(this).parent().removeClass("focused is-focused");
          });
      });
  
  </script>
  <script>
    function showHidePassword(id, element) {
     let x = document.getElementById(id);
      if (x.type === "password") {
            x.type = "text";
            element.innerHTML='visibility';
      } else {
            x.type = "password";
            element.innerHTML='visibility_off';
      }
    }
</script>
  @endpush