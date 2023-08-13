<?php

use App\Http\Livewire\Devices\Create as DeviceCreate;
use App\Http\Livewire\Devices\Edit as DeviceEdit;
use App\Http\Livewire\Devices\Index as DeviceIndex;
use Illuminate\Support\Facades\Route;  
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['auth']], function () {

    Route::get('device', DeviceIndex::class)->name('device-management');
    Route::get('device/edit/{id}', DeviceEdit::class)->name('edit-device');
    Route::get('device/create', DeviceCreate::class)->name('add-device');
});
