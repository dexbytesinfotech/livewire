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
           
            <!-- Card Basic Info -->
            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Add {{Str::ucfirst($this->role == '' ? 'User' :  $this->role) }}</h5>
                    <p>Create New {{Str::ucfirst($this->role == '' ? 'User' : $this->role) }}</p>
                </div>
                <div class="card-body pt-0">
                    <form wire:submit.prevent="store">
                        <div class="row">

                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Full Name *</label>
                                    <input wire:model.lazy="name" type="text" class="form-control" placeholder="Enter a full name">
                                </div>
                                @error('name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-2  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Country Code *</label>
                                    <select class="form-control input-group input-group-dynamic" wire:model.lazy="country_code" id="countryCode" onfocus="focused(this)" onfocusout="defocused(this)">
                                            @foreach ($countries  as $countryValue)
                                                <option value="{{ $countryValue['country_code'] }}">{{ $countryValue['country_code']}}</option>
                                            @endforeach
                                     </select>
                                </div>
                                @error('country_code')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-10 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Phone Number *</label>
                                    <input aria-label="Text input with dropdown button" wire:model.lazy="phone" type="tel" class="form-control" placeholder="Enter a Phone Number without country code e.g 5056440289">
                                </div>
                                @error('phone')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Email *</label>
                                    <input wire:model.lazy="email" type="email" class="form-control" placeholder="Enter a Email">
                                </div>
                                @error('email')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-6 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Password *</label>
                                    <input wire:model.lazy="password" type="password" class="form-control" placeholder="Enter a Password">
                                </div>
                                @error('password')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-6 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Confirmation Password *</label>
                                    <input wire:model.lazy="passwordConfirmation" type="text" class="form-control" placeholder="Enter a Confirmation Password">
                                </div>
                                @error('passwordConfirmation')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        
                            @if(!$this->role)
                                <div class="col-12 mb-4">
                                    <div class="input-group input-group-static">
                                        <label>Select Role *</label>
                                        <select class="form-control" wire:model="role_id"
                                            data-style="select-with-transition" title="Role" data-size="100" id="role">
                                            <option>Select a Role</option>
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">
                                                {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('role_id')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            @endif

                         </div>
        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mt-4">
                                    <a  href="{{ route('user-management') }}" class="btn btn-light m-0">Cancel</a>
                                    <button type="submit" name="submit" class="btn bg-gradient-dark m-0 ms-2">Create
                                        User</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</div>
@push('js')
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
@endpush
