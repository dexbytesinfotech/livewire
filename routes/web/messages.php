<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Messages\Index as MessagesIndex;
use App\Http\Livewire\Messages\Show as MessagesShow;

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
    Route::get('messages', MessagesIndex::class)->name('message-management');
    Route::get('messages/show/{orderId}/{role}', MessagesShow::class)->name('show-message');
});