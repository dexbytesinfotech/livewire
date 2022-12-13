<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Taxes\Create as TaxesCreate;
use App\Http\Livewire\Taxes\Edit as TaxesEdit;
use App\Http\Livewire\Taxes\Index as TaxesIndex;
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
    Route::get('taxes', TaxesIndex::class)->name('tax-management');
    Route::get('taxes/edit/{id}', TaxesEdit::class)->name('edit-tax');
    Route::get('taxes/create', TaxesCreate::class)->name('add-tax');
});