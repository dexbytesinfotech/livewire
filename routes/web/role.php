<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Roles\Create as RolesCreate;
use App\Http\Livewire\Roles\Edit as RolesEdit;
use App\Http\Livewire\Roles\Index as RolesIndex;
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

Route::get('roles', RolesIndex::class)->name('role-management');
Route::get('roles/edit/{id}', RolesEdit::class)->name('edit-role');
Route::get('roles/create', RolesCreate::class)->name('new-role');
