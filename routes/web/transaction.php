<?php

 
use App\Http\Livewire\Transaction\Index as TransactionIndex ;
use App\Http\Livewire\Transaction\Edit as TransactionEdit;
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

    Route::get('transactions', TransactionIndex::class)->name('transaction-management');
    Route::get('transactions/edit/{id}', TransactionEdit::class)->name('edit-transaction');
     
});