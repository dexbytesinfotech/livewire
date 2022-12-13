<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default values for commerce data
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache connection that gets used while
    | using this caching library. This connection is used when another is
    | not explicitly specified when executing a given caching function.
    |
    */

    'pagination_per_page' => env('PAGINATION_PER_PAGE', 25),
    'price'               => env('PRICE', 'SR'),


];