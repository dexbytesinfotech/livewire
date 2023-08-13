@section('page_title')
    User Details
@endsection

<div class="container-fluid my-3 py-3">
    <div class="row mb-5">
        <div class="col-lg-3">
            <div class="card position-sticky top-1">
                <ul class="nav flex-column bg-white border-radius-lg p-3">
                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#profile">
                            <i class="material-icons text-lg me-2">person</i>
                            <span class="text-sm">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#basic-info">
                            <i class="material-icons text-lg me-2">receipt_long</i>
                            <span class="text-sm">Basic Info</span>
                        </a>
                    </li>

                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#change-password">
                            <i class="material-icons text-lg me-2">lock_reset</i>
                            <span class="text-sm">Change Password</span>
                        </a>
                    </li>
                    @if ($this->user->hasRole('Customer'))
                        <li class="nav-item pt-2">
                            <a class="nav-link text-dark d-flex" data-scroll="" href="#address-info">
                                <i class="material-icons text-lg me-2">location_on</i>
                                <span class="text-sm">Address</span>
                            </a>
                        </li>
                    @endif
                    @if ($this->user->hasRole('Provider'))
                        <li class="nav-item pt-2">
                            <a class="nav-link text-dark d-flex" data-scroll="" href="#stores">
                                <i class="material-icons text-lg me-2">store</i>
                                <span class="text-sm">Stores</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>

        <div class="col-lg-9 mt-lg-0 mt-4">

            <!-- Card Profile -->
            <div class="card card-body" id="profile">
                <div class="row justify-content-center align-items-center">
                    @error('profile_photo')
                        <p class='text-danger inputerror mb-2'>{{ $message }} </p>
                    @enderror
                    <div class="col-sm-auto col-4">
                        <div class="avatar avatar-xl position-relative preview">
                            @if ($profile_photo)
                                <img src="{{ $profile_photo->temporaryUrl() }}"
                                    class="w-100 h-100 rounded-circle shadow-sm" alt="Profile Photo">
                            @elseif ($user->profile_photo)
                                <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($user->profile_photo) }}"
                                    alt="avatar" class="w-100  h-100 rounded-circle shadow-sm">
                            @else
                                <img src="{{ asset('assets') }}/img/default-avatar.png" alt="avatar"
                                    class="w-100  h-100 rounded-circle shadow-sm">
                            @endif
                            <label for="file-input"
                                class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                <i wire:loading.remove class="fa fa-pen top-0" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="" aria-hidden="true"
                                    data-bs-original-title="Edit Image" aria-label="Edit Image"></i><span
                                    class="sr-only">Edit Image</span>

                                <div wire:loading wire:target="profile_photo">
                                    <x-spinner></x-spinner>
                                </div>
                            </label>

                            <input wire:loading.attr="disabled" wire:model='profile_photo' type="file"
                                id="file-input">

                        </div>
                    </div>

                    <div class="col-sm-auto col-8 my-auto">
                        <div class="h-100">
                            <h5 class="mb-1 font-weight-bolder">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                ({{ $user->getRoleNames()->implode(',') }})
                            </p>
                        </div>
                    </div>

                    <div wire:loading.attr="disabled" class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                        <label class="form-check-label mb-0">
                            <small id="profileVisibility">
                                @if ($user->status == 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </small>
                        </label>
                        <div class="form-check form-switch ms-2 my-auto">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault35"
                                wire:click="statusUpdate({{ $user->id }},{{ $user->status }})"
                                @if ($user->status) checked="" @endif>
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
            <form wire:submit.prevent="update">

                <div class="card mt-4" id="basic-info">
                    <div class="card-header">
                        <h5>Basic Info</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-6 mb-4">
                                <div class="input-group input-group-static">
                                    <label>First Name *</label>
                                    <input wire:model.lazy="user.first_name" type="text" class="form-control"
                                        placeholder="Enter a first Name">
                                </div>
                                @error('user.first_name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-6 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Last Name *</label>
                                    <input wire:model.lazy="user.last_name" type="text" class="form-control"
                                        placeholder="Enter a last Name">
                                </div>
                                @error('user.last_name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-4  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Country Code *</label>
                                    <select class="form-control input-group input-group-dynamic"
                                        wire:model.lazy="user.country_code" id="countryCode" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                        <option value='' selected>Select</option>
                                        @foreach ($countries as $countryValue)
                                            <option value="{{ $countryValue['country_code'] }}">
                                                {{ $countryValue['country_code'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user.country_code')
                                    <p class='text-danger inputerror'>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-4  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Phone Number *</label>
                                    <input wire:model.lazy="user.phone" type="text" class="form-control"
                                        placeholder="Enter a Phone Number">
                                </div>
                                @error('user.phone')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-4  mb-4">
                                <div class="input-group input-group-static">
                                    <label>Email </label>
                                    <input wire:model.lazy="user.email" type="text" class="form-control"
                                        placeholder="Enter a email">
                                </div>
                                @error('user.email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            @if ($user->id != auth()->id() || $user->id != 1)
                                <div class="col-12 mb-4">
                                    <div class="input-group input-group-static">
                                        <label>Select Role *</label>
                                        <select multiple="multiple" class="form-control" wire:model="role_id"
                                            data-style="select-with-transition" title="Role" data-size="100"
                                            id="role_id">
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
                                    <button type="submit" wire:loading.attr="disabled" name="submit"
                                        class="btn bg-gradient-dark m-0 ms-2">
                                        <span wire:loading.remove wire:target="update"> Update</span>
                                        <span wire:loading
                                            wire:target="update"><x-buttonSpinner></x-buttonSpinner></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- change-password -->
            <form wire:submit.prevent="passwordUpdate">
                <div class="card mt-4" id="change-password">
                    <div class="card-header">
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-12">
                                @csrf
                                <div class="input-group input-group-static ">
                                    <input wire:model.lazy='new_password' type="password" class="form-control"
                                        placeholder="New Password">
                                </div>
                                @error('new_password')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                <div class="input-group input-group-static mt-4">
                                    <input wire:model="confirmationPassword" id="myInput" type="password"
                                        class="form-control" placeholder="Confirm New Password">
                                    <input type="checkbox" onclick="showHidePassword()">
                                    <div class="text-sm m-1"> Show Password</div>
                                </div>
                                @error('confirmationPassword')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" wire:loading.attr="disabled" name="submit"
                                        class="btn bg-gradient-dark m-0 ms-2">
                                        <span wire:loading.remove wire:target="passwordUpdate"> Update</span>
                                        <span wire:loading
                                            wire:target="passwordUpdate"><x-buttonSpinner></x-buttonSpinner></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <!-- Card Address Info -->
            @if ($this->user->hasRole('Customer'))
                <div class="card mt-4" id="address-info">
                    <div class="card-header">
                        <h5>Address</h5>
                    </div>
                    <div class="pt-0">
                        <x-table>
                            <x-slot name="head">
                                <x-table.heading> SNo
                                </x-table.heading>
                                <x-table.heading>Address
                                </x-table.heading>
                                <x-table.heading>Zip Post Code
                                </x-table.heading>
                                <x-table.heading>City
                                </x-table.heading>
                            </x-slot>
                            <x-slot name="body">
                                @foreach ($address as $key => $value)
                                    <x-table.row>
                                        <x-table.cell>{{ $value->id }}</x-table.cell>
                                        <x-table.cell>
                                            {{ $value->address }}
                                        </x-table.cell>
                                        <x-table.cell>
                                            {{ $value->zip_postcode }}
                                        </x-table.cell>
                                        <x-table.cell>
                                            {{ $value->city }}
                                        </x-table.cell>
                                    </x-table.row>
                                @endforeach
                            </x-slot>
                        </x-table>
                        @if ($address->count() == 0)
                            <div>
                                <p class="text-center">No address added by customer!</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Card Store -->
            @if ($this->user->hasRole('Provider'))
                <div class="card mt-4" id="stores">
                    <div class="card-header">
                        <h5>Stores</h5>
                    </div>
                    <div class="card-body pt-0">
                        <x-table>
                            <x-slot name="head">
                                <x-table.heading> ID
                                </x-table.heading>
                                <x-table.heading> Name
                                </x-table.heading>
                                <x-table.heading> Phone Number
                                </x-table.heading>
                                <x-table.heading>
                                    Creation Date
                                </x-table.heading>
                                <x-table.heading>Actions</x-table.heading>
                            </x-slot>

                            <x-slot name="body">
                                @foreach ($stores as $store)
                                    <x-table.row wire:key="row-{{ $store->id }}">
                                        <x-table.cell><a
                                                href="{{ route('edit-store', $store->store) }}">{{ $store->store->id }}</a></x-table.cell>
                                        <x-table.cell><a
                                                href="{{ route('edit-store', $store->store) }}">{{ $store->store->name }}</a></x-table.cell>
                                        <x-table.cell>{{ $store->store->phone }}</x-table.cell>
                                        <x-table.cell>{{ $store->created_at }}</x-table.cell>
                                        <x-table.cell>
                                            <a href="javascript:void(0)"
                                                wire:click="destroyOwnerConfirm({{ $store->id }})">
                                                <span class="material-symbols-outlined">
                                                    delete
                                                </span>
                                            </a>
                                        </x-table.cell>
                                    </x-table.row>
                                @endforeach
                            </x-slot>
                        </x-table>
                        @if (empty($stores))
                            <div>
                                <p class="text-center">No stores assign to user!</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

 
            @if ($this->user->hasRole('Driver') && $user->driver)
                <!-- Card Other Info -->
                <div class="card mt-4" id="other-info">
                    <div class="card-header">
                        <h5>Other Info</h5>
                    </div>
                    <div class="card-body pt-0">
                        <x-table>
                            <x-slot name="head">
                                <x-table.heading>SNo
                                </x-table.heading>
                                <x-table.heading>Name
                                </x-table.heading>
                                <x-table.heading>Value
                                </x-table.heading>
                            </x-slot>
                            <x-slot name="body">
                                @foreach ($userMeta as $meta => $value)
                                    <x-table.row>
                                        <x-table.cell>{{ $loop->iteration }}</x-table.cell>
                                        <x-table.cell>
                                            {{ ucfirst(str_replace('_', ' ', $value->key)) }}
                                        </x-table.cell>
                                        <x-table.cell>
                                            @php$allowed = ['jpg', 'png', 'gif', 'pdf', 'jpeg'];
                                                                                                $ext = pathinfo($value->value, PATHINFO_EXTENSION);
                                                                                        @endphp ?>
                                            @if (in_array($ext, $allowed))
                                                <div class="images">
                                                    <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($value->value) }}"
                                                        alt="picture" class="avatar avatar-sm me-3">
                                                    <div id="image-viewer">
                                                        <span class="close">&times;</span>
                                                        <img class="full-image" id="full-image">
                                                    </div>
                                                @else
                                                    @if (strcmp($value->key, 'date_of_birth') !== 0)
                                                        {{ ucfirst(str_replace('_', ' ', $value->value)) }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($value->value)->format(config('app_settings.date_format.value')) }}
                                                    @endif
                                            @endif
                                        </x-table.cell>
                                    </x-table.row>
                                @endforeach
                            </x-slot>
                        </x-table>

                        @if ($userMeta->count() == 0)
                            <div>
                                <p class="text-center">No records found!</p>
                            </div>
                        @endif
                    </div>
                </div>
           
                <!-- Card Other Info -->
                <div class="card mt-4" id="device-info">
                    <div class="card-header">
                        <h5>Device Info</h5>
                    </div>
                    <div class="card-body pt-0">
                        <x-table>
                            <x-slot name="head">
                                <x-table.heading>S No
                                </x-table.heading>
                                <x-table.heading>Device Info
                                </x-table.heading>
                                <x-table.heading>App Info
                                </x-table.heading>
                                <x-table.heading>Date
                                </x-table.heading>
                            </x-slot>
                            <x-slot name="body">
                                @foreach ($user->device as $dkey => $device)
                                    <x-table.row>
                                        <x-table.cell>{{ $loop->iteration }}</x-table.cell>
                                        <x-table.cell>
                                            {{ ucfirst($device->device_type) }}({{ $device->device_version }}),
                                            {{ ucfirst($device->device_name) }} @if ($device->device_model)
                                                ({{ $device->device_model }})
                                            @endif
                                        </x-table.cell>
                                        <x-table.cell>
                                            {{ ucfirst($device->app_name . ' App') }} @if ($device->app_version)
                                                ({{ $device->app_version }})
                                            @endif
                                        </x-table.cell>
                                        <x-table.cell>
                                            {{ $device->updated_at->format(config('app_settings.date_format.value')) }}
                                        </x-table.cell>
                                    </x-table.row>
                                @endforeach
                            </x-slot>
                        </x-table>

                        @if ($user->device->count() == 0)
                            <div>
                                <p class="text-center">No records found!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- CardAccount -->
                <div class="card mt-4" id="suspend">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-sm-0 mb-4">
                            <div class="w-50">
                                <h5>Account Suspended</h5>
                                <p class="text-sm mb-0">Once you suspended this account, It means that the user has
                                    remove temporarily.</p>
                            </div>
                            <div class="w-50 text-end">
                                <button wire:loading.attr="disabled"
                                    class="btn bg-gradient-{{ $user->driver->account_status == 'suspended' ? 'success' : 'warning' }} mb-0 ms-2"
                                    type="button" name="button"
                                    wire:click="suspendedConfirm({{ $user }})">{{ $user->driver->account_status == 'suspended' ? 'Re-Active Account' : 'Account suspended' }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@push('js')
   

    <script>
        $(document).ready(function() {

            window.initSelectRole = () => {
                $('#role_id').select2({
                    placeholder: 'Select a Role',
                    allowClear: true
                });
            }
            initSelectRole();

            $('#role_id').on('change', function(e) {
                var selected_element = $(e.currentTarget);
                var select_val = selected_element.val();
                console.log(select_val);
                window.livewire.emit('getRoleIdForInput', select_val);
            });

            window.livewire.on('select2', () => {
                initSelectRole();
            });

        });
    </script>
    <script>
        $(".images img").click(function() {
            $("#full-image").attr("src", $(this).attr("src"));
            $('#image-viewer').show();
        });

        $("#image-viewer .close").click(function() {
            $('#image-viewer').hide();
        });
    </script>
    <script>
        function showHidePassword() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endpush
