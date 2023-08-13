<div class="d-flex flex-row justify-content-between mx-4">
<div class="d-flex mb-3">
    <x-input.select  wire:model="perPage" id="entries">
        <option value="10">10</option>
        <option selected value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </x-input.select>
</div>
</div>
