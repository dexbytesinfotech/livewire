<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Page\Create as PagesCreate;
use App\Http\Livewire\Page\Edit as PagesEdit;
use App\Http\Livewire\Page\Index as PagesIndex;
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
    Route::get('pages', PagesIndex::class)->name('page-management');
    Route::get('pages/edit/{id}/{ref_lang?}', PagesEdit::class)->name('edit-page');
    Route::get('pages/create', PagesCreate::class)->name('add-page');
});