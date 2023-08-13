@section('page_title')
  Profile
@endsection
<div class="container-fluid my-3 py-3">
    <div class="row mb-5">
        <div class="col-lg-12 mt-lg-0 mt-4">
            <!-- Card Profile -->
            <div class="card card-body" id="profile">
                <div class="row justify-content-center align-items-center">
                    @error('profile_photo')
                    <p class='text-danger'>{{ $message }} </p>
                    @enderror
                    <div class="col-sm-auto col-4">
                        <form wire:submit.prevent="update" enctype="multipart/form-data">
                            <div class="avatar avatar-xl position-relative preview">
                                @if($profile_photo)
                                 <img src="{{ $profile_photo->temporaryUrl() }}" class="w-100 rounded-circle shadow-sm"
                                    alt="Profile Photo">
                                @elseif ($user->profile_photo)
                                    <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($user->profile_photo) }}" alt="avatar"
                                    class="w-100 rounded-circle shadow-sm">
                                @else
                                <img src="{{ asset('assets') }}/img/default-avatar.png" alt="avatar"
                                    class="w-100 rounded-circle shadow-sm">
                                @endif
                                <label for="file-input"
                                    class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                    <i   wire:loading.remove class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        aria-hidden="true" data-bs-original-title="Edit Image"
                                        aria-label="Edit Image"></i><span class="sr-only">Edit Image</span>
                                    <div wire:loading wire:target="profile_photo">
                                        <x-spinner></x-spinner>
                                    </div>
                                </label>
                               
                                <input  wire:loading.attr="disabled"   wire:model='profile_photo' type="file" id="file-input">
                            </div>
                    </div>
                    <div class="col-sm-auto col-8 my-auto">
                        <div class="h-100">
                            <h5 class="mb-1 font-weight-bolder">
                                {{ auth()->user()->name }}
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                             {{ auth()->user()->role }}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                        <label class="form-check-label mb-0">
                            <small id="profileVisibility">
                                Active
                            </small>
                        </label>
                        <div class="form-check form-switch ms-2 my-auto">
                           <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked disabled>
                        </div>
                    </div>
                </div>
            </div>
            @if (session('status'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-success alert-dismissible text-white mt-3" role="alert">
                        <span class="text-sm">{{ Session::get('status') }}</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif
           
            <!-- Card Basic Info -->
            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Basic Info</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-3">
                            <div class="input-group input-group-static">
                                <label>First Name</label>
                                <input wire:model.lazy="user.first_name" type="text" class="form-control" placeholder="Alec">
                            </div>
                            @error('user.first_name')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="col-3">
                            <div class="input-group input-group-static">
                                <label>Last Name</label>
                                <input wire:model.lazy="user.last_name" type="text" class="form-control" placeholder="Deo">
                            </div>
                            @error('user.last_name')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="col-6">

                            <div class="input-group input-group-static">
                                <label>Email</label>
                                <input wire:model.lazy="user.email" type="email" class="form-control"
                                    placeholder="example@email.com" disabled>
                            </div>
                            @error('user.email')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        
                        <div class="col-6">

                            <div class="input-group input-group-static">
                                <label>Phone Number</label>
                                <input wire:model.lazy="user.phone" type="number" class="form-control"
                                    placeholder="966 735 631 620" disabled>
                            </div>
                            @error('user.phone')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type='submit' class="btn bg-gradient-dark btn-sm mt-6 mb-0">
                                <span wire:loading.remove wire:target="update"> Save Changes</span>
                                        <span wire:loading wire:target="update"><x-buttonSpinner></x-buttonSpinner></span>
                                    </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>


            
            <!-- Card Change Password -->
            <div class="card mt-4" id="password">
                <div class="card-header">
                    <h5>Change Password</h5>
                    @if (session('error'))
                    <div class="row">
                        <div class="alert alert-danger alert-dismissible text-white" role="alert">
                            <span class="text-sm">{{ Session::get('error') }}</span>
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @elseif (session('success'))
                    <div class="row">
                        <div class="alert alert-success alert-dismissible text-white" role="alert">
                            <span class="text-sm">{{ Session::get('success') }}</span>
                            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-body pt-0">
                    <form wire:submit.prevent="passwordUpdate">
                        @csrf

                        <div class="input-group input-group-outline">
                            <input wire:model.lazy="old_password" type="password" class="form-control"
                                placeholder="Current Password">
                        </div>
                        @error('old_password')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                        @enderror

                        <div class="input-group input-group-outline mt-4">
                            <input wire:model.lazy='new_password' type="password" class="form-control"
                                placeholder="New Password">
                        </div>
                        @error('new_password')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                        @enderror
                        <div class="input-group input-group-outline mt-4">
                            <input wire:model="confirmationPassword" type="password" class="form-control"
                                placeholder="Confirm New Password">
                        </div>
                        <button class="btn bg-gradient-dark btn-sm mt-6 mb-0">
                            <span wire:loading.remove wire:target="passwordUpdate">  Update password</span>
                            <span wire:loading wire:target="passwordUpdate"><x-buttonSpinner></x-buttonSpinner></span>
                          </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
