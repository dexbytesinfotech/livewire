@props([
    'paginate' => null,
    'total' => 0,
    'perPage' => null,
])
<div class="table-responsive mx-3">
    <table class="table table-flush">
        <thead class="thead-light">
            <tr>
                {{ $head ?? '' }}
            </tr>
        </thead>
        <tbody class="align-middle">
            {{ $body ?? '' }}
        </tbody>
    </table>

    <div class="row">
    <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
        <div class="dataTables_length" id="kt_ecommerce_sales_table_length">
            @isset ($perPage)
                @if ($this->perPage < $total)
                    <x-table.per-page></x-table.per-page>                    
                @endif
            @endif 
        </div>
    </div>
    <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
        <div class="dataTables_paginate paging_simple_numbers" id="kt_ecommerce_sales_table_paginate">
    <div id="datatable-bottom">
        {!!html_entity_decode($paginate)!!}
    </div>
        </div>
    </div>
</div>
</div>