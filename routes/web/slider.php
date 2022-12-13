<?php

 
use App\Http\Livewire\Slider\Index as SliderIndex ;
use App\Http\Livewire\Slider\Create as SliderCreate;
use App\Http\Livewire\Slider\Edit as SliderEdit;
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

    Route::get('slider', SliderIndex::class)->name('slider-management');
    Route::get('slider/edit/{id}', SliderEdit::class)->name('edit-slider');
     Route::get('slider/create', SliderCreate::class)->name('add-slider');
});