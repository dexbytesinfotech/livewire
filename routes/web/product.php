<?php


use Illuminate\Support\Facades\Route;


use App\Http\Livewire\Product\Index as ProductIndex;
use App\Http\Livewire\Product\Create as ProductCreate;
use App\Http\Livewire\Product\Edit as ProductEdit;
use App\Http\Livewire\Product\Category\Edit as CategoryEdit;
use App\Http\Livewire\Product\Category\Create as CategoryCreate;
use App\Http\Livewire\Product\Category\Index as CategoryIndex;
use App\Http\Livewire\Product\Addon\Index as AddonOptionsIndex;
use App\Http\Livewire\Product\Addon\Create as AddonOptionsCreate;
use App\Http\Livewire\Product\Addon\Edit as AddonOptionsEdit;
use App\Http\Livewire\Tags\Index as TagsIndex;
use App\Http\Livewire\Tags\Create as TagsCreate;
use App\Http\Livewire\Tags\Edit as TagsEdit;
use App\Models\Product\AddonOption;

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

    Route::get('products/list', ProductIndex::class)->name('product-management');
    Route::get('products/edit/{id}', ProductEdit::class)->name('edit-product');
    Route::get('products/create', ProductCreate::class)->name('add-product');

    Route::get('products/category/create', CategoryCreate::class)->name('add-category');
    Route::get('products/category/edit/{id}',  CategoryEdit::class)->name('edit-category');
    Route::get('products/category', CategoryIndex::class)->name('product-category-management');
  
    Route::get('products/addons', AddonOptionsIndex::class)->name('product-addon-management'); 
    Route::get('products/addons/create', AddonOptionsCreate::class)->name('create-product-addon');
    Route::get('products/addons/edit/{id}', AddonOptionsEdit::class)->name('edit-product-addon');

 
    Route::get('products/tags', TagsIndex::class)->name('product-tag-management');
    Route::get('products/tags/create', TagsCreate::class)->name('new-product-tag');
    Route::get('products/tags/edit/{id}', TagsEdit::class)->name('edit-product-tag');
    
 
});