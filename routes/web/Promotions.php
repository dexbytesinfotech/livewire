<?php

use App\Http\Livewire\Promotions\Create as PromotionCreate;
use App\Http\Livewire\Promotions\Edit as PromotionEdit;
use App\Http\Livewire\Promotions\Index as PromotionIndex;
use App\Http\Livewire\Promotions\StoreIndex as PromotionStore;
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

    Route::get('promotions', PromotionIndex::class)->name('promotion-management');
     Route::get('promotions/edit/{id}', PromotionEdit::class)->name('edit-promotion');
     Route::get('promotions/create', PromotionCreate::class)->name('add-promotion');
     Route::get('promotions/store/promotion', PromotionStore::class)->name('store-promotion');
});
