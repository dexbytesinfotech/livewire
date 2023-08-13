<?php

use App\Http\Livewire\Faq\Create as FaqCreate;
use App\Http\Livewire\Faq\Edit as FaqEdit;
use App\Http\Livewire\Faq\Index as FaqIndex;
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

    Route::get('faq', FaqIndex::class)->name('faq-management');
    Route::get('faq/edit/{id}/{ref_lang?}', FaqEdit::class)->name('edit-faq');
    Route::get('faq/create', FaqCreate::class)->name('add-faq');
});
