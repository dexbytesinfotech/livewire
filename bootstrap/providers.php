<?php

return [
    App\Providers\AppServiceProvider::class,
        /*
        * Application Service Providers...
        */
    App\Providers\AuthServiceProvider::class,
    // App\Providers\BroadcastServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    //settings
    App\Providers\SettingServiceProvider::class,
    Barryvdh\Debugbar\ServiceProvider::class,
    Maatwebsite\Excel\ExcelServiceProvider::class,
    //Image Resizing
    Intervention\Image\ImageServiceProvider::class
];
