<?php
use App\Http\Livewire\Account\Profile\Edit as EditProfile;
use App\Http\Livewire\Auth\ForgetPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Dashboard\Index;
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

Route::get('sign-up', Register::class)->name('register');
Route::get('sign-in', Login::class)->name('login');
Route::get('forget-password', ForgetPassword::class)->middleware('guest')->name('forget-password');
Route::get('reset-password/{id}', ResetPassword::class)->middleware('guest')->name('reset-password');



Route::group(['middleware' => 'auth','scopes:admin'], function () {

    Route::get('account/profile', EditProfile::class)->name('edit-profile');
    Route::get('dashboard', Index::class)->name('dashboard');
    
});