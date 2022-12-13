<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\World\Country\Create as CountryCreate;
use App\Http\Livewire\World\Country\Edit as CountryEdit;
use App\Http\Livewire\World\Country\Index as CountryIndex;
use App\Http\Livewire\World\State\Index as StateIndex;
use App\Http\Livewire\World\City\Index as CityIndex;
use App\Http\Livewire\World\State\Create as StateCreate;
use App\Http\Livewire\World\State\Edit as StateEdit;
use App\Http\Livewire\World\City\Create as CityCreate;
use App\Http\Livewire\World\City\Edit as CityEdit;
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

    Route::get('location/country/list', CountryIndex::class)->name('country-management');
    Route::get('location/country/edit/{id}', CountryEdit::class)->name('edit-country');
    Route::get('location/country/create', CountryCreate::class)->name('add-country');

    Route::get('location/state/list', StateIndex::class)->name('state-management');
    Route::get('location/state/edit/{id}', StateEdit::class)->name('edit-state');
    Route::get('location/state/create', StateCreate::class)->name('add-state');

    Route::get('location/city/list', CityIndex::class)->name('city-management');
    Route::get('location/city/create', CityCreate::class)->name('add-city');
    Route::get('location/city/edit/{id}', CityEdit::class)->name('edit-city');

});