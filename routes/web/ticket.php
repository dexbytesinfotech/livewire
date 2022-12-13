<?php
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\TicketCategories\Edit as CategoryEdit;
use App\Http\Livewire\TicketCategories\Create as CategoryCreate;
use App\Http\Livewire\TicketCategories\Index as CategoryIndex;
use App\Http\Livewire\Tickets\Index as TicketIndex;


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

    Route::get('tickets/list/{status?}', TicketIndex::class)->name('ticket-management');

   Route::get('tickets/category/create', CategoryCreate::class)->name('add-ticket-category');
   Route::get('tickets/category/edit/{id}',  CategoryEdit::class)->name('edit-ticket-category');
    Route::get('tickets/category', CategoryIndex::class)->name('ticket-category-management');
 
});