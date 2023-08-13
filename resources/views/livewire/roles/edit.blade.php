<div class="container-fluid py-4 bg-gray-200">
    <div class="row mb-5">
        <div class="col-lg-9 col-12 mx-auto position-relative">

                       
            @if(in_array($role->name, $this->defaultRoles)) 
                <div class="row">
                    <div class="col-lg-10 col-10 mx-auto position-relative">
                        <div class="row text-center">
                            <div class="alert alert-warning" role="alert">
                                <strong>Warning! </strong>Permission is not granted to modify default roles.  
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('status'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-success alert-dismissible text-white mt-3" role="alert">
                        <span class="text-sm">{{ Session::get('status') }}</span>
                        <button  type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif
           
            <!-- Card Basic Info -->
            <form wire:submit.prevent="edit">
                <div class="card mt-4" id="basic-info">
                    <div class="card-header">
                        <h5 class="mb-0">Edit Role</h5>
                        <p>Edit your role</p>
                    </div>
                    <div class="card-body pt-0">
                            <div class="row ">
                                <div class="col-12  mb-4">
                                    <div class="input-group input-group-static">
                                        <label>Name *</label>
                                        <input wire:model.lazy="role.name" type="text" class="form-control" placeholder="Enter a role name"  @if(in_array($role->name, $this->defaultRoles)) disabled @endif>
                                    </div>
                                    @error('role.name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="col-12  mb-4">
                                    <div class="input-group input-group-static">
                                        <label>Role Description</label>
                                        <input wire:model.lazy="role.content" type="text" class="form-control"
                                            placeholder="Enter a role short description">
                                    </div>
                                    @error('role.content')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>                    

                            </div>
                    </div>
                </div>
 
                <div class="card mt-4" id="basic-info">
                    <div class="card-header">
                        <h5 class="mb-0">Permissions</h5>                    
                    </div>
                    <div class="card-body pt-0">
                            <div class="row ">
                                <div class="col-12  mb-4">
                                    <div class="input-group input-group-static">
                                        <div class="row justify-content-start row-cols-3">
                                        @foreach($permissions as $key => $permission)
                                            <div class="form-check">
                                                <input  wire:model.defer="selectedPermissions.{{$permission->id}}" name="selectedPermissions.{{$permission->id}}" type="checkbox" value="{{ $permission->id }}" class="form-check-input"
                                                    @if(in_array($permission->id, $selectedPermissions)) checked @endif
                                                    @if(in_array($role->name, $this->defaultRoles)) disabled @endif
                                                >
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
                                            <span wire:loading.remove wire:target="edit"> Update Role</span>
                                        <span wire:loading wire:target="edit"><x-buttonSpinner></x-buttonSpinner></span>
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
 