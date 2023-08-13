{{-- Page Title --}}
@section('page_title')
    @lang("components/store.add_store_title")
@endsection
@if(env('GOOGLE_MAP_KEY') == '')
    <x-alert class="alert-warning"><strong>Warning! </strong> Get the coordinates of a stores, You will need to set your API Key. <a class="btn-link">Set Google API Key now</a></x-alert>
@endif
<x-core.container>

    {{-- loader --}}
    <x-loder />

    {{-- Alert message - alert-success, examples- alert-danger, alert-warning, alert-primary  --}}
    @if (session('status'))
        <x-alert class="alert-success">{{ Session::get('status') }}</x-alert>
    @endif

    

    {{-- Card --}}
    <x-core.card class="col-lg-9 col-12 p-3 mx-auto position-relative">

        {{-- Card Body --}}
        <x-slot name="body">
            {{-- Form --}}
            <x-form.form enctype="multipart/form-data" submitText="create store" submit-target="store" cancel-route="{{ route('store-management') }}">

                {{-- Input-group --}}
                <x-input.group colspan="col-12" for="name" label="Full Name *" :error="$errors->first('name')">
                    {{-- Input text --}}
                    <x-input.text wire:model.lazy="name" placeholder="Enter a full name" />
                </x-input.group>

                <x-input.group colspan="col-3" for="country_code" label="Country Code *" :error="$errors->first('country_code')">
                    {{-- Input-select --}}
                    <x-input.select class="form-control" wire:model.lazy="country_code" id="countryCode"
                        onfocus="focused(this)" onfocusout="defocused(this)">
                        @foreach ($countries as $countryValue)
                            <option value="{{ $countryValue['country_code'] }}">{{ $countryValue['country_code'] }}
                            </option>
                        @endforeach
                    </x-input.select>
                </x-input.group>

                <x-input.group colspan="col-9" for="phone" label="Phone Number *" :error="$errors->first('phone')">
                    <x-input.text wire:model.lazy="phone"
                        placeholder="Enter a Phone Number without country code e.g 5056440289" />
                </x-input.group>

                <x-input.group colspan="col-12" for="email" label="Email *" :error="$errors->first('email')">
                    {{-- Input-email --}}
                    <x-input.email wire:model.lazy="email" placeholder="Enter an Email" />
                </x-input.group>

                <x-input.group colspan="col-12" for="store_type" label="Store Type *" :error="$errors->first('store_type')">
                    <x-input.select class="form-control" wire:model="store_type" id="store_type"
                        placeholder="Choose Your Store Type">
                        @foreach($store_types as $value)
                            <option value="{{ $value['name'] }}">{{ $value['name']}}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>
             
                <x-input.group colspan="col-12" for="address_line_1" label="Address *" :error="$errors->first('address_line_1')">
                    <x-input.text wire:model.lazy="address_line_1" placeholder="Enter a Address" />
                </x-input.group>

                {{-- letlong --}}
                <div class="col-12 mb-4">
                    <div class="input-group input-group-static">
                        <label>Landmark (GPS Coordinates)*</label>
                        <input wire:model.lazy="landmark" type="text"  id="googleMapAutocomplete"  class="form-control" placeholder="Enter a Landmark">
                        <input wire:model.lazy='latitude' type="hidden" id="latitude" class="form-control">
                        <input wire:model.lazy ='longitude' type="hidden"  id="longitude" class="form-control">
                    </div>
                    @if($latitude && $longitude)
                        <p class='text-info inputerror'>Latitude: {{$latitude}}, Longitude: {{$longitude}}</p>
                    @endif
                    @error('landmark')
                        <span class='text-danger inputerror'>{{ $message }} </span>
                    @enderror
                    @error('latitude')
                        <span class='text-danger inputerror'>{{ $message }} </span>
                    @enderror
                    @error('longitude')
                        <span class='text-danger inputerror'>{{ $message }} </span>
                    @enderror
                </div>

                <x-input.group colspan="col-12" for="zip_post_code" label="Zip Post Code *" :error="$errors->first('zip_post_code')">
                    <x-input.text wire:model.lazy="zip_post_code" placeholder="Enter a Zip Post Code" />
                </x-input.group>

                <x-input.group colspan="col-12" for="countryName" label="Country *" :error="$errors->first('country')">
                    <x-input.select class="form-control" wire:model="country" id="countryName" onfocus="focused(this)" onfocusout="defocused(this)"
                        placeholder="Choose Your Country">
                        @foreach ($countries  as $countryValue)
                            <option value="{{ $countryValue['id'] }},{{ $countryValue['name'] }}">{{ $countryValue['name']}}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>

                <x-input.group colspan="col-12" for="stateName" label="State *" :error="$errors->first('state')">
                    <x-input.select class="form-control" wire:model="state" id="stateName" onfocus="focused(this)" onfocusout="defocused(this)"
                        placeholder="Choose Your State">
                        @foreach ($states  as $stateValue)
                            <option value="{{ $stateValue['id'] }},{{ $stateValue['name'] }}">{{ $stateValue['name']}}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>

                <x-input.group colspan="col-12" for="cityName" label="City *" :error="$errors->first('city')">
                    <x-input.select class="form-control" wire:model="city" id="cityName" onfocus="focused(this)" onfocusout="defocused(this)"
                        placeholder="Choose Your City">
                        @foreach ($cities as $cityValue)
                            <option value="{{ $cityValue['name'] }}">{{ $cityValue['name']}}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group>


                <x-input.group colspan="col-12 " for="description" label="Description *" :error="$errors->first('descriptions')">
                    {{-- Rech text --}}
                    <x-input.rich-text wire:model.lazy="descriptions">
                        {{ $descriptions }}
                    </x-input.rich-text>
                </x-input.group>

                <div class="div mt-4">
                    <x-input.checkbox  wire:model.lazy="status" label="Status"/>
                </div>


                <div class="col-12 mt-4">
                    <div class="input-group input-group-static">
                    <div class="avatar avatar-xl m-2 position-relative rounded-circle">
                        <div class="position-relative preview">
                            <label>Logo *</label>
                            <label for="file-input"
                                class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                <i wire:loading.remove class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="" aria-hidden="true" data-bs-original-title="Upload Image"
                                    aria-label="Select Image"></i><span class="sr-only">Upload Image</span>
                                    <div wire:loading wire:target="logo_path">
                                        <x-spinner></x-spinner>
                                    </div>
                            </label>
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100 ">
                                @if ($logo_path)
                                    <img src="{{ $logo_path->temporaryUrl() }}" alt="Profile Photo">
                                @else
                                    <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url('dummy/store.png')}}" alt="avatar">
                                @endif</span>    
                            <input wire:loading.attr="disabled" wire:model="logo_path" type="file" id="file-input">

                        </div>
                    </div>
                    </div>
                    @error('logo_path')
                    <p class='text-danger inputerror m-3 ms-0'>{{ $message }} </p>
                    @enderror
                </div>    

            </x-form.form>
        </x-slot>
    </x-core.card>
</x-core.container>


 