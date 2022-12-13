<?php

use App\Http\Livewire\Order\Details;
use Illuminate\Support\Facades\Route;

 
use App\Http\Livewire\Order\Index as OrderIndex; 
 
 
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
 
Route::group(['middleware' => 'auth'], function () {

    Route::get('orders/list/{order_status?}', OrderIndex::class)->name('order-management');
    Route::get('order-details/{id}' , Details::class )->name('order-details');
 
});