<?php
use App\Http\Livewire\Account\Profile\Edit as EditProfile;
use App\Http\Livewire\Auth\ForgetPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\AllLogin;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\Policies;
use App\Http\Livewire\Auth\VerifyOtp as VerifyOtp;
use App\Http\Livewire\Auth\ChangePassword as ChangePassword;
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

// Route::get('sign-up', Register::class)->name('register');
Route::get('sign-in', Login::class)->name('login');
Route::get('forget-password', ForgetPassword::class)->middleware('guest')->name('forget-password');
Route::get('reset-password/{id}', ResetPassword::class)->middleware('guest')->name('reset-password');
Route::get('otp-verification/{token}', VerifyOtp::class)->middleware('guest','verifytoken')->name('otp-verification');
Route::get('change-password/{user_id}', ChangePassword::class)->middleware('guest','verifytoken')->name('change-password');

Route::get('login', AllLogin::class)->middleware('guest');
Route::get('privacy-policy', Policies::class)->name('privacy-policy');

Route::group(['middleware' => 'auth','scopes:admin'], function () {

    Route::get('account/profile', EditProfile::class)->name('edit-profile');
    Route::get('dashboard', Index::class)->name('dashboard');
    Route::get('/setLang/{lang}', function ($locale) {
        app()->setLocale($locale);
         Session::put('locale', $locale); // This should also work
         config(['app.locale' => $locale]);     
         return back();
       })->name('locale.setting');   
});