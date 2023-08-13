<div class="container-fluid py-4 bg-gray-200">
    <div class="row mb-5">
        <div class="col-lg-9 col-12 mx-auto position-relative">
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
            <form wire:submit.prevent="store">
            <!-- Card Basic Info -->
            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Add Role</h5>
                    <p>Create new role</p>
                </div>
                <div class="card-body pt-0">
                        <div class="row ">
                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Name *</label>
                                    <input wire:model.lazy="name" type="text" class="form-control" placeholder="Enter a role name">
                                </div>
                                @error('name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-12  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Role Description</label>
                                    <input wire:model.lazy="content" type="text" class="form-control"
                                        placeholder="Enter a role short description">
                                </div>
                                @error('content')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>  
                        </div>
                </div>
            </div>

            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Permissions</h5>
                </div>
                <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <div class="row justify-content-start row-cols-3">
                                        @foreach($permissions as $permission)
                                            <div class="form-check">
                                                <input wire:model.defer="selectedPermissions" name="selectedPermissions" class="form-check-input" type="checkbox" value="{{ $permission->name }}">
                                                <label class="custom-control-label">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @error('selectedPermissions')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mt-4">
                                    <a  href="{{ route('role-management') }}" class="btn btn-light m-0">Cancel</a>
                                    <button wire:loading.attr="disabled" type="submit" name="submit" class="btn bg-gradient-dark m-0 ms-2">
                                        <span wire:loading.remove wire:target="store"> Create Role</span>
                                        <span wire:loading wire:target="store"><x-buttonSpinner></x-buttonSpinner></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
 