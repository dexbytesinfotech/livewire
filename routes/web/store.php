<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Stores\Create as StoresCreate;
use App\Http\Livewire\Stores\Edit as StoresEdit;
use App\Http\Livewire\Stores\Index as StoresIndex;
use App\Http\Livewire\StoreTypes\Create as StoreTypesCreate;
use App\Http\Livewire\StoreTypes\Edit as StoreTypesEdit;
use App\Http\Livewire\StoreTypes\Index as StoreTypesIndex;
use App\Http\Livewire\Account\Store\Edit as AccountStore;
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

    Route::get('stores/{application_status?}', StoresIndex::class)->name('store-management');
    Route::get('stores/edit/{id}', StoresEdit::class)->name('edit-store');
    Route::get('stores/create/new', StoresCreate::class)->name('add-store');
    Route::get('unverified/stores', StoresIndex::class)->name('unverified-stores');

    Route::get('store-types', StoreTypesIndex::class)->name('store-type-management');
    Route::get('store-types/edit/{id}', StoreTypesEdit::class)->name('edit-store-type');
    Route::get('store-types/create', StoreTypesCreate::class)->name('add-store-type');
});

Route::group(['middleware' => 'auth'], function () {
     Route::get('settings/store', AccountStore::class)->name('provider-manage-store'); 
});