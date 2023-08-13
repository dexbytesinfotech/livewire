@section('page_title')
    Agency Details
@endsection
<div class="container my-3 py-3">
    <div class="row mb-5 mr-1">

        @if (env('GOOGLE_MAP_KEY') == '')
            <div class="col-lg-10 col-10 mx-auto position-relative">
                <div class="row mb-5 text-center">
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning! </strong>Get the coordinates of a stores, You will need to set your API Key. <a
                            class="btn-link">Set Google API Key now</a>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-lg-3">
            <div class="card position-sticky top-1">
                <ul class="nav flex-column bg-white border-radius-lg p-3">
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#basic-info">
                            <i class="material-icons text-lg me-2">receipt_long</i>
                            <span class="text-sm">Basic Info</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#accounts">
                            <i class="material-icons text-lg me-2">badge</i>
                            <span class="text-sm">Accounts</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#delete">
                            <i class="material-icons text-lg me-2">delete</i>
                            <span class="text-sm">Delete Account</span>
                        </a>
                    </li>
                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#suspended">
                            <i class="material-icons text-lg me-2">person_off</i>
                            <span class="text-sm">Account Suspended</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-9 mt-lg-0 mt-4">
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
            <form wire:submit.prevent="edit">

                <div class="card" id="basic-info">
                    <div class="card-header">
                        <h5>Basic Info</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Agency Name *</label>
                                    <input wire:model.lazy="agency.agency_name" type="text" class="form-control"
                                        placeholder="Enter a Agency Name">
                                </div>
                                @error('agency.agency_name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-2 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Country Code *</label>
                                    <select class="form-control input-group input-group-dynamic"
                                        wire:model.lazy="country_code" id="countryCode" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                        <option value='' selected>Select</option>
                                        @foreach ($countries as $countryValue)
                                            <option value="{{ $countryValue['country_code'] }}">
                                                + {{ $countryValue['country_code'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('agency.country_code')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-6 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Phone Number *</label>
                                    <input aria-label="Text input with dropdown button"
                                        wire:model.lazy="agency.phone_number" type="tel" class="form-control"
                                        placeholder="Enter a Phone Number without country code e.g 5056440289">
                                </div>
                                @error('agency.phone_number')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-4 mb-4">
                                <div class="input-group input-group-static">
                                    <label>City *</label>
                                    <select class="form-control input-group input-group-dynamic"
                                        wire:loading.attr="disabled" wire:model.lazy="agency.city" id="cityName">
                                        <option>Select City</option>
                                        @foreach ($cities as $cityValue)
                                            <option value="{{ $cityValue['name'] }}">{{ $cityValue['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('agency.city')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-9 mb-4">
                                <div class="input-group input-group-static">
                                    <label>Address *</label>
                                    <input wire:model.lazy="agency.address" type="text" class="form-control"
                                        placeholder="Enter Address">
                                </div>
                                @error('agency.address')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" name="submit" class="btn bg-gradient-dark m-0 ms-2">
                                Update
                            </button>
                        </div>
                    </div>
                </div>

            </form>

            <!-- Card Accounts -->
            <div class="card mt-4" id="accounts">
                <div class="card-header">
                    <div class="row">
                        <div class="col col-6">
                            <h5>Accounts</h5>
                        </div>
                        <div class="col col-6 text-end">
                            <button type="button" class="btn bg-gradient-dark m-0 ms-2"
                                wire:click="$emit('openModal', 'agencies.create-manager', {{ json_encode(['agencyId' => $agencyId]) }})">
                                Add Manager
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 align-center">
                    <x-table>
                        <x-slot name="head">
                            <x-table.heading> ID
                            </x-table.heading>
                            <x-table.heading> Name
                            </x-table.heading>
                            <x-table.heading>Email
                            </x-table.heading>
                            <x-table.heading>Phone Number
                            </x-table.heading>
                            <x-table.heading>Status
                            </x-table.heading>
                            <x-table.heading>
                                Creation Date
                            </x-table.heading>
                            <x-table.heading>Actions</x-table.heading>
                        </x-slot>

                        <x-slot name="body">
                            @foreach ($usersWithManagerRole as $user)
                                <x-table.row wire:key="row-{{ $user->id }}">
                                    <x-table.cell>{{ $user->id }}</x-table.cell>
                                    <x-table.cell>{{ $user->first_name }} {{ $user->last_name }}</x-table.cell>
                                    <x-table.cell>{{ $user->email }}</a></x-table.cell>
                                    <x-table.cell>+{{ $user->country_code }} {{ $user->phone }}</a></x-table.cell>

                                    <x-table.cell>
                                        <div class="form-check form-switch ms-3">
                                            <input class="form-check-input" type="checkbox"
                                                id="flexSwitchCheckDefault35"
                                                wire:change="statusAccountUpdate({{ $user->id }}, {{ $user->status }})"
                                                @if ($user->status) checked="" @endif>
                                        </div>
                                    </x-table.cell>
                                    <x-table.cell-date>{{ $user->created_at }}</x-table.cell-date>
                                    <x-table.cell>
                                        <a href="javascript:void(0)"
                                            wire:click="destroyManagerConfirm({{ $user->id }})">
                                            <span class="material-symbols-outlined">
                                                delete
                                            </span>
                                        </a>
                                    </x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-slot>
                    </x-table>
                    @if (count($usersWithManagerRole) == 0)
                        <div>
                            <p class="text-center">No account assign to agency!</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Card Delete Account -->
            <div class="card mt-4" id="delete">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-sm-0 mb-4">
                        <div class="w-50">
                            <h5>Delete Account</h5>
                            <p class="text-sm mb-0">Once you delete this account, there is no going back. Please
                                be certain.</p>
                        </div>
                        <div class="w-50 text-end">
                            <button wire:loading.attr="disabled" class="btn bg-gradient-danger mb-0 ms-2"
                                type="button" name="button"
                                wire:click="destroyConfirm({{ $agencyId }})">Delete
                                Account</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Delete Account -->
            <div class="card mt-4" id="suspended">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-sm-0 mb-4">
                        <div class="w-50">
                            <h5>Account Suspended</h5>
                            <p class="text-sm mb-0">Once you suspended this account, It means that the agency has
                                remove
                                temporarily.</p>
                        </div>
                        <div class="w-50 text-end">
                            <button wire:loading.attr="disabled"
                                class="btn bg-gradient-{{ $agency->account_status == 'suspended' ? 'success' : 'warning' }} mb-0 ms-2"
                                type="button" name="button"
                                wire:click="suspendedConfirm({{ $agency }})">{{ $agency->account_status == 'suspended' ? 'Re-Active Account' : 'Account suspended' }}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('js')
    
    <script> 
        function showHidePassword() {
            var x = document.getElementById("checkbox");
            var y = document.getElementById("repassword");
            if (x.checked == true){
              y.type = "text";
          } else {
            y.type = "password";
          }
            
          }
    </script>  
@endpush
