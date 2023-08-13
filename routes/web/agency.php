<?php

use App\Http\Livewire\Agencies\Create as AgencyCreate;
use App\Http\Livewire\Agencies\Edit as AgencyEdit;
use App\Http\Livewire\Agencies\Index as AgencyIndex;
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

    Route::get('agency', AgencyIndex::class)->name('agency-management');
    Route::get('agency/edit/{id}', AgencyEdit::class)->name('edit-agency');
    Route::get('agency/create', AgencyCreate::class)->name('add-agency');
});
