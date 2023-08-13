<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-5">
            <div class="row signin-margin">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Reset Password</h4>
                            </div>
                            <div class="card-body">
                                @if (Session::has('email'))
                                <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ Session::get('email') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <form wire:submit.prevent="update" class="text-start">

                                    <div class="input-group input-group-outline mt-3 @if(strlen($email ?? '') > 0) is-filled @endif">
                                        <label class="form-label">Email</label>
                                        <input wire:model="email" type="email" class="form-control">
                                    </div>
                                    @error('email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror

                                    <div class="input-group input-group-outline mt-3 @if(strlen($password ?? '') > 0) is-filled @endif">
                                        <label class="form-label">New Password</label>
                                        <input wire:model="password" type="password" class="form-control">
                                    </div>
                                    @error('password')
                                    <div class="text-danger inputerror">{{ $message }}</div>
                                    @enderror

                                    <div class="input-group input-group-outline mt-3 @if(strlen($passwordConfirmation ?? '') > 0) is-filled @endif">
                                        <label class="form-label">Confirm Password</label>
                                        <input wire:model="passwordConfirmation" type="password" class="form-control" 
                                            >
                                            @error('passwordConfirmation')
                                            <div class="text-danger inputerror">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Change
                                            password</button>
                                    </div>
                                    <p class="mt-4 text-sm text-center">
                                        Don't have an account?
                                        <a href="{{ route('register') }}"
                                            class="text-primary text-gradient font-weight-bold">Sign
                                            up</a>
                                    </p>
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
    @endpush