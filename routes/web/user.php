<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\UserManagement\Create as UserManagementCreate;
use App\Http\Livewire\UserManagement\Edit as UserManagementEdit;
use App\Http\Livewire\UserManagement\Index as UserManagementIndex;
use App\Http\Livewire\UserManagement\View as  UserManagementView;
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

    Route::get('users/list/{role?}', UserManagementIndex::class)->name('user-management');
    Route::get('users/edit/{id}', UserManagementEdit::class)->name('edit-user');
    Route::get('users/create', UserManagementCreate::class)->name('add-user');
    Route::get('users/view/{id}', UserManagementView::class)->name('view-user');
});