
<div class="display-center">
    <div class="card-header pb-0 text-left">
        <h5 class="text-bold">Add Agency</h5>
        <p class="mb-0">Retrieve the agency through its name and proceed to assign it to this device.</p>
    </div>

    <div class="card card-plain">
        <div class="card-body pb-3">
            <div class="input-group input-group-outline my-3 focused is-focused">
                <input type="text" wire:model="search" id="search" placeholder="Search by Agency Name" class="form-control">
            </div>

            @if ($search != '')
                @if (!empty($searchResultAgencies))
                    @foreach ($searchResultAgencies as $spKey => $searchAgencies)
                        <ul class="list-group list-group-flush list my--3">
                            <li style="cursor: pointer;" class="list-group-item px-0 border-0"
                                wire:click="selectedAgency({{ $searchAgencies['id'] }})">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        @if ($selected_agency_id == $searchAgencies['id'])
                                            <span class="material-symbols-outlined text-success">
                                                check_circle
                                            </span>
                                        @else
                                            <span class="material-symbols-outlined">
                                                radio_button_unchecked
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <h6 class="text-sm font-weight-normal mb-0">
                                            {{ $searchAgencies['agency_name'] }}</h6>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                @endif
                @if (count($searchResultAgencies) == 0)
                    <p class="text-sm text-center">
                        No record matched!
                    </p>
                @endif
            @endif

        </div>
    </div>

    <div class="modal-footer">
        <button type="button" wire:click.prevent="resetField()" class="btn btn-secondary" wire:loading.attr="disabled"
            data-dismiss="modal">Close</button>
        <button type="button" wire:loading.attr="disabled" class="btn bg-gradient-dark submit" id="submitAgency"
            @if (!$selected_agency_id) disabled @endif wire:click="$emit('agencySubmit')">Submit</button>
    </div>

</div>

