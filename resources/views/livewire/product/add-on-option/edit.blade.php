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
                    <h5>Edit AddOn Option</h5>
                </div>
                <div class="card-body pt-0">
                    <form wire:submit.prevent="edit">
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6">
                                        <div class="input-group input-group-static">
                                            <label>Name *</label>
                                            <input wire:model.lazy="addonOption.name" class="multisteps-form__input form-control" type="text" placeholder="Enter a Addon Option name" />
                                        </div>
                                        @error('addonOption.name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <div class="input-group input-group-static">
                                            <label>Small Description *</label>
                                            <input wire:model.lazy="addonOption.small_descriptions" class="multisteps-form__input form-control" type="text" placeholder="Enter a small Description" />
                                        </div>
                                        @error('addonOption.small_descriptions')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6">
                                        <div class="input-group input-group-static">
                                            <label>Type *</label>
                                            <select class="form-control input-group input-group-static"wire:model.lazy="addonOption.input_type_code"  id="projectName" onfocus="focused(this)" onfocusout="defocused(this)">
                                                <option value=''>Choose Your type</option>
                                                <option value='multichoice'>Multi Choice</option>
                                                <option value='singlechoice'>Single Choice</option>
                                                <option value='limitedchoice'>Limited Choice</option>
                                             </select>
                                        </div>
                                        @error('addonOption.input_type_code')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="input-group input-group-static">
                                            <label>Addon Type *</label>

                                            <div class="form-check mt-2 floating-man"> 
                                                <label class="form-check-label" for="add">
                                                <input wire:model="addonOption.addon_type" class="form-check-input" type="radio"
                                                 value='add' id="add">
                                                Add
                                                 </label>
                                                 <label class="form-check-label ms-5" for="remove">
                                                    <input wire:model="addonOption.addon_type" class="form-check-input" type="radio" id="remove"
                                                    value='remove'>
                                                     Remove
                                                   </label>
                                            </div>
                                             <div class="form-check">
                                               
                                             </div>
                                        </div>
                                        @error('addonOption.addon_type')
                                         <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                    </div>
                                    
                                </div>
                               
                                 @if($addonOption->input_type_code == 'limitedchoice')
                                <div class="row mt-3">
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <div class="input-group input-group-static">
                                                <label>Minimum Select Number</label>
                                               <input type="number" class="multisteps-form__input form-control"  wire:model="addonOption.min_select_numbers" min="0" max="100" placeholder="0">
                                            </div>
                                            @error('addonOption.min_select_numbers')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="input-group input-group-static">
                                                <label>Maximum Select Number</label>
                                                <input type="number" class="multisteps-form__input form-control" wire:model="addonOption.max_select_numbers" min="0" max="100" placeholder=" 0">
                                            </div>
                                            @error('addonOption.max_select_numbers')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                    </div>
                                    
                                </div>
                                @endif
                                <div class="row mt-4">
                                    <div class="col-12 col-sm-6">
                                        <div class="input-group input-group-static">
                                            <div class="form-check form-switch ms-3">
                                                <label>Status</label>
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault35" wire:model="addonOption.status">
                                            </div>
                                            @error('addonOption.status')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <div class="input-group input-group-static">
                                            <div class="form-check form-switch ms-3">
                                                <label>Is Required</label>
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault35" wire:model="addonOption.is_required">
                                            </div>
                                            @error('addonOption.is_required')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>                       
                    </form>
                </div>
            </div>
            


            <div class="card mt-4" id="basic-info">
                <div class="card-header">
                    <h5>Option Value</h5>
                </div>
                <div class="card-body pt-0">
                    <form wire:submit.prevent="edit">
                        <x-table>
                            <x-slot name="head">
                                <x-table.heading>
                                    Name
                                </x-table.heading>
                                <x-table.heading>
                                    Price
                                </x-table.heading>
                            </x-slot>
                            <x-slot name="body">
                                @foreach($optionValues as $key => $optionValue)
                                <x-table.row>
                                    <x-table.cell style="border:none">
                                        <div class="col-12  mb-4">
                                            <div class="input-group input-group-static">
                                                    <label>Name *</label>
                                                    <input wire:model.lazy="optionValues.{{$key}}.option" type="text" class="form-control" placeholder="Enter a value name">
                                            </div>
                                                @error('optionValues.'.$key.'.option')
                                                 <p class='text-danger inputerror'>{{ $message }} </p>
                                                 @enderror
                                        </div>
                                    </x-table.cell>
                                    <x-table.cell style="border:none">
                                        <div class="col-12  mb-4">
                                            <div class="input-group input-group-static">
                                                <label>Price @if($addonOption->addon_type == 'add') * @endif</label>
                                                <input wire:model.lazy="optionValues.{{$key}}.price" type="text" class="form-control"
                                                    placeholder="Enter a Price"  @if($addonOption->addon_type == 'remove') disabled @endif>
                                            </div>
                                            @error('optionValues.'.$key.'.price')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                        </div>
                                    </x-table.cell>
                                    @if($key > 0)
                                    <x-table.cell style="border:none">
                                        <a href="#" wire:click.prevent="removeInput({{$key}})"><span class="material-symbols-outlined">
                                            delete
                                            </span></a>
                                    </x-table.cell>
                                    @endif
                                    
                                </x-table.row>
                              @endforeach
                            </x-slot>    
                        </x-table>
                        <div wire:click="addInput" class="cursor-pointer btn btn-light m-0">
                            <span>
                               + add Option
                                </span>
                                 
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end mt-4">
                                    <a  href="{{ route('product-addon-management') }}" class="btn btn-light m-0">Cancel</a>
                                    <button type="submit" name="submit" class="btn bg-gradient-dark m-0 ms-2">Update
                                        Addon</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>





        </div>
    </div>
</div>
@push('js')
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
@endpush
