<?php
 

use Illuminate\Support\Facades\Route;
 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('sign-in');
});


Route::group(['namespace' => 'App\Http\Livewire'], function()
{
    foreach (glob(__DIR__. '/web/*') as $router_files){
        (basename($router_files =='web.php')) ? : (require_once $router_files);
    }
 
});

 
