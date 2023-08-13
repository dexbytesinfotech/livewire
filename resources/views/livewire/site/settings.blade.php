@section('page_title')
    Site Settings
@endsection
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

            @if($is_updated)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-warning alert-dismissible text-white mt-3" role="alert">
                            <span class="text-sm">When you don't see the changes after updating data. Please clear cache</span>
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
                    <h5>General</h5>
                </div>
                <div class="card-body pt-0">
                   <form wire:submit.prevent="updateGeneral">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>{{ $settings['app_name']['label'] }} *</label>
                                    <input wire:model.lazy="app_name" class="form-control" type="text"/>
                                </div>
                                @error('app_name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <div class="input-group input-group-static">
                                    <label>{{ $settings['app_logo']['label'] }} *</label>
                                    <div class="avatar avatar-xl position-relative preview">
                                        @if($app_logo_dark)
                                        <img src="{{ $app_logo_dark->temporaryUrl() }}" class="w-100 rounded-circle shadow-sm"
                                            alt="Profile Photo">
                                        @elseif ($app_logo)
                                            <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($app_logo) }}" alt="avatar"
                                            class="w-100 rounded-circle shadow-sm">
                                        @else
                                        <img src="{{ asset('assets') }}/img/logo-ct-dark.png" alt="avatar"
                                            class="w-100 rounded-circle shadow-sm">
                                        @endif
                                        <label for="file-input-logo"
                                            class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                            <i wire:loading.remove class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                aria-hidden="true" data-bs-original-title="Edit Image"
                                                aria-label="Edit Image"></i><span class="sr-only">Edit Image</span>
                                                <div wire:loading wire:target="app_logo_dark">
                                                    <x-spinner></x-spinner>
                                                </div>
                                        </label>
                                    
                                        <input wire:loading.attr="disabled" wire:model='app_logo_dark' type="file" id="file-input-logo">
                                    </div>
                                </div>
                                @error('app_logo_dark')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                <p class="text-sm">Recommended file size 120x120</p>
                            </div>
                            
                            <div class="col-12 mb-4">
                                <hr>
                                <div class="input-group input-group-static">
                                    <label>{{ $settings['app_favicon_logo']['label'] }} *</label>
                                    <div class="avatar avatar-xl position-relative preview">
                                        @if($app_favicon_logo_dark)
                                        <img src="{{ $app_favicon_logo_dark->temporaryUrl() }}" class="w-100 rounded-circle shadow-sm"
                                            alt="Profile Photo">
                                        @elseif ($app_favicon_logo)
                                            <img src="{{ Storage::disk(config('app_settings.filesystem_disk.value'))->url($app_favicon_logo) }}" alt="avatar"
                                            class="w-100 rounded-circle shadow-sm">
                                        @else
                                        <img src="{{ asset('assets') }}/img/logo-ct-dark.png" alt="avatar"
                                            class="w-100 rounded-circle shadow-sm">
                                        @endif
                                        <label for="file-input-flogo"
                                            class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                            <i wire:loading.remove class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                aria-hidden="true" data-bs-original-title="Edit Image"
                                                aria-label="Edit Image"></i><span class="sr-only">Edit Image</span>
                                                <div wire:loading wire:target="app_favicon_logo_dark">
                                                    <x-spinner></x-spinner>
                                                </div>
                                        </label>
                                       
                                        <input wire:loading.attr="disabled" wire:model='app_favicon_logo_dark' type="file" id="file-input-flogo">
                                    </div>
                               </div>
                               @error('app_favicon_logo_dark')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                               <p  class="text-sm">Recommended file size 76x76</p>
                            </div>
             
                            <!-- <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>{{ $settings['app_url']['label'] }} *</label>
                                    <input wire:model.lazy="app_url" class="form-control" type="text" readonly/>
                                </div>
                                @error('app_url')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>{{ $settings['app_api_url']['label'] }} *</label>
                                    <input wire:model.lazy="app_api_url" class="form-control" type="text" />
                                </div>
                                @error('app_api_url')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div> -->

                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>{{ $settings['support_number']['label'] }} *</label>
                                    <input wire:model.lazy="support_number" class="form-control" type="text"/>
                                </div>
                                @error('support_number')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <div class="input-group input-group-static">
                                    <label>{{ $settings['support_email']['label'] }} *</label>
                                    <input wire:model.lazy="support_email" class="form-control" type="text"/>
                                </div>
                                @error('support_email')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mt-4">
                                    <button wire:loading.attr="disabled" type="submit" name="submit" class="btn bg-gradient-dark m-0 ms-2">Update General</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>                
            </div>


            
             <!-- Card Store URL Info -->
             <div class="card mt-4" id="Store-info">
                <div class="card-header">
                    <h5>Store URL</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['apple_store_app_url']['label'] }} *</label>
                                <input wire:model.lazy="apple_store_app_url" class="form-control" type="text"/>
                            </div>
                            @error('apple_store_app_url')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['play_store_app_url']['label'] }} *</label>
                                <input wire:model.lazy="play_store_app_url" class="form-control" type="text"/>
                            </div>
                            @error('play_store_app_url')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


             <!-- Card Location Info -->
            <div class="card mt-4" id="Location-info">
                <div class="card-header">
                    <h5>Location settings</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['timezone']['label'] }} *</label>
                                <select class="form-control input-group input-group-dynamic" wire:model.lazy="timezone"  id="timezone" onfocus="focused(this)" onfocusout="defocused(this)">
                                    @foreach ($timezones as $tkey => $timezonesValue)
                                        <option value='{{ $tkey }}'>{{$timezonesValue['value']}}</option>
                                    @endforeach
                                </select>
                                <p>Now Time: {{Carbon\Carbon::now()->format(config('app_settings.date_format.value').' '.config('app_settings.time_format.value')) }}</p>
                            </div>
                            @error('timezone')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['default_locale']['label'] }} *</label>
                                <select class="form-control input-group input-group-dynamic" wire:model.lazy="default_locale"  id="default_locale" onfocus="focused(this)" onfocusout="defocused(this)">
                                    @foreach ($languages as $lkey => $languageValue)
                                        <option value='{{ $lkey }}'>{{ $languageValue }} ({{ $lkey }})</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('default_locale')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

           
            <!-- Card Basic Info -->
            <div class="card mt-4" id="DateAndTime-info">
                <div class="card-header">
                    <h5>Date & Time Format</h5>
                </div>
                <div class="card-body pt-0">
                    
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['date_format']['label'] }} *</label>
                                <select class="form-control input-group input-group-dynamic" wire:model.lazy="date_format"  id="date_format" onfocus="focused(this)" onfocusout="defocused(this)">
                                    <option value='d/m/Y'>d/m/Y</option>
                                    <option value='m/d/Y'>m/d/Y</option>
                                    <option value='Y-m-d'>Y-m-d</option>
                                    <option value='F j, Y'>F j, Y</option>
                                    <option value='j F, Y'>j F, Y</option>
                                    </select>
                            </div>
                            @error('date_format')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['time_format']['label'] }} *</label>
                                <select class="form-control input-group input-group-dynamic" wire:model.lazy="time_format"  id="time_format" onfocus="focused(this)" onfocusout="defocused(this)">
                                    <option value='g:i a'>g:i a</option>
                                    <option value='g:i A'>g:i A</option>
                                    <option value='H:i'>H:i</option>
                                    </select>
                            </div>
                            @error('time_format')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                    </div>
                    
                </div>
            </div>

             <!-- Card Basic Info -->
            <div class="card mt-4" id="Currency-info">
                <div class="card-header">
                    <h5>Currency options</h5>
                    <p>The following options affect how prices are displayed on the frontend.</p>
                </div>
                <div class="card-body pt-0">
                    
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['currency']['label'] }} *</label>
                                <select class="form-control input-group input-group-dynamic" wire:model.lazy="currency"  id="currency" onfocus="focused(this)" onfocusout="defocused(this)">
                                @foreach ($all_currency as $ckey => $currencyValue)
                                    <option value='{{ $ckey }}'>{{$currencyValue['name']}} ({{$currencyValue['symbol']}})</option>
                                @endforeach
                               </select>
                            </div>
                            @error('currency')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['currency_position']['label'] }} *</label>
                                <select class="form-control input-group input-group-dynamic" wire:model.lazy="currency_position"  id="currency_position" onfocus="focused(this)" onfocusout="defocused(this)">
                                    <option value='left'>Left</option>
                                    <option value='left_with_space'>Left with space</option>
                                    <option value='right'>Right</option>
                                    <option value='right_with_space'>Right with space</option>
                                </select>
                            </div>
                            @error('currency_position')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                    
                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['decimal_separator']['label'] }} *</label>
                                <input wire:model.lazy="decimal_separator" class="form-control" type="text"/>
                            </div>
                            @error('decimal_separator')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['thousand_separator']['label'] }} *</label>
                                <input wire:model.lazy="thousand_separator" class="form-control" type="text"/>
                            </div>
                            @error('thousand_separator')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>

                        <div class="col-12 mb-4">
                            <div class="input-group input-group-static">
                                <label>{{ $settings['number_of_decimals']['label'] }} *</label>
                                <input wire:model.lazy="number_of_decimals" class="form-control" type="text"/>
                            </div>
                            @error('number_of_decimals')
                            <p class='text-danger inputerror'>{{ $message }} </p>
                            @enderror
                        </div>
                    

                    </div>
                    
                </div>
            </div>
 
        </div>
    </div>
</div>
 