
            <div class="container my-5">
                <div class="row signin-margin">
                    <div class="col-lg-4 col-md-8 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Register</h4>
                                    {{-- <div class="row mt-3">
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
                                    </div> --}}
                                </div>
                            </div>
                            {{-- <div class="row px-xl-5 px-sm-4 px-3">
                                <div class="mt-2 position-relative text-center">
                                    <p
                                        class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                        or
                                    </p>
                                </div>
                            </div> --}}
                            <div class="card-body">
                                <form wire:submit.prevent='store' role="form">

                                    <div class="input-group input-group-dynamic @if(strlen($name?? '') > 0) is-filled @endif">
                                        <label class="form-label">Name</label>
                                        <input wire:model="name" type="text" class="form-control" aria-label="Name" >
                                    </div>
                                    @error('name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror

                                    <div class="input-group input-group-dynamic mt-3 @if(strlen($userName ?? '') > 0) is-filled @endif">
                                        <label class="form-label">User-Name</label>
                                        <input wire:model="user_name" type="text" class="form-control" aria-label="User-Name">
                                    </div>
                                    @error('user_name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror

                                    <div class="input-group input-group-dynamic mt-3 @if(strlen($email ?? '') > 0) is-filled @endif">
                                        <label class="form-label">Email</label>
                                        <input wire:model="email" type="email" class="form-control" aria-label="Email">
                                    </div>
                                    @error('email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror


                                    <div class="input-group input-group-dynamic mt-3 @if(strlen($phone ?? '') > 0) is-filled @endif">
                                        <label class="form-label">Phone</label>
                                        <input wire:model="phone" type="text" class="form-control" aria-label="Phone">
                                    </div>
                                    @error('phone')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror


                                    <div class="input-group input-group-dynamic mt-3 @if(strlen($countryCode ?? '') > 0) is-filled @endif">
                                        <label class="form-label">Country-Code</label>
                                        <input wire:model="country_code" type="text" class="form-control" aria-label="Country-Code">
                                    </div>
                                    @error('country_code')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror

                                    <div class="input-group input-group-dynamic mt-3 @if(strlen($password ?? '') > 0) is-filled @endif">
                                        <label class="form-label">Password</label>
                                        <input wire:model="password" type="password" class="form-control" aria-label="Password">
                                    </div>
                                    @error('password')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror


                                   <label for='phone' class=' mt-3'>Select Role</label>
                                    <div class="input-group input-group-dynamic mb-3">
                                        <select wire:model="role_id" class="form-select p-2" id='select-role'>
                                            <option value=''>Choose a Role-Type</option>
                                            <option value="Super-Admin">Super Admin</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Provider">Provider</option>
                                            <option value="Driver">Driver</option>
                                            <option value="Customer">Customer</option>
                                            <option value="Unverified">Unverified</option>
                                        </select>
                                    </div>
                                    @error('role_id')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign
                                            up</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">Already have an account?
                                        <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in
                                        </a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
