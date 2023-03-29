<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Frontend\IndexController;
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

// Frontend
Route::get('/',[IndexController::class,'index'])->name('home');

//Authentication
Route::get('user/login-register-form',[IndexController::class,'userLoginRegister'])->name('user.auth');
Route::post('user/login',[IndexController::class,'userLogin'])->name('user.login');

//Product Category Section
Route::get('product-category/{slug}',[IndexController::class,'productCategory'])->name('product.category');
Route::get('product-details/{slug}',[IndexController::class,'productDetails'])->name('product.details');

//----------------------------------------------------------------

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

//Admin Dashboard
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::get('/',[\App\Http\Controllers\AdminController::class,'admin'])->name('admin');
//Banner Section
    Route::resource('/banner',BannerController::class);
    Route::post('/banner-status',[BannerController::class,'bannerStatus'])->name('banner.status');
//Category Section
    Route::resource('/category',CategoryController::class);
    Route::post('/category-status',[CategoryController::class,'categoryStatus'])->name('category.status');
//Brand Section
    Route::resource('/brand',BrandController::class);
    Route::post('/brand-status',[BrandController::class,'brandStatus'])->name('brand.status');
//Product Section
    Route::resource('/product',ProductController::class);
    Route::post('/product-status',[ProductController::class,'productStatus'])->name('product.status');
//User Section
    Route::resource('/user',UserController::class);
    Route::post('/user-status',[UserController::class,'userStatus'])->name('user.status');
});


