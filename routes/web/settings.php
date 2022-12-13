<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Site\Index as SiteIndex;
use App\Http\Livewire\Site\Cache as CacheIndex;
use App\Http\Livewire\Ecommerce\Settings as SettingsEcommerce;

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

Route::get('site/settings', SiteIndex::class)->name('site-settings');
Route::get('system/cache', CacheIndex::class)->name('site-cache');
Route::get('ecommerce/settings', SettingsEcommerce::class)->name('ecommerce-settings');  
