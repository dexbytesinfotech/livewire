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
                    <h5>Edit User</h5>
                </div>
                <div class="card-body pt-0">
                    <form wire:submit.prevent="update">
                        <div class="row">

                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Full Name *</label>
                                    <input wire:model.lazy="user.name" type="text" class="form-control" placeholder="Enter a full name">
                                </div>
                                @error('user.name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-2  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Country Code *</label>
                                    <select class="form-control input-group input-group-dynamic" wire:model.lazy="user.country_code" id="countryCode" onfocus="focused(this)" onfocusout="defocused(this)">
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
                                    <input aria-label="Text input with dropdown button" wire:model.lazy="user.phone" type="tel" class="form-control" placeholder="Enter a Phone Number without country code e.g 5056440289">
                                </div>
                                @error('user.phone')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Email *</label>
                                    <input wire:model.lazy="user.email" type="email" class="form-control" placeholder="Enter a Email">
                                </div>
                                @error('user.email')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                         @if ($user->id != auth()->id() || $user->id  != 1)
                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Select a Role *</label>  
                                    <select class="form-control" wire:model="role_id"
                                        data-style="select-with-transition" title="Role" data-size="100" id="role">
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
                                    <button type="submit" name="submit" class="btn bg-gradient-dark m-0 ms-2">Update
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
<script src="{{ asset('assets') }}/js/plugins/quill.min.js"></script>
@endpush
