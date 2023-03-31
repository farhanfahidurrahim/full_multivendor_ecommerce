<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use Illuminate\Support\Facades\Auth;

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

// <===========Frontend Part==========>
Route::get('/',[IndexController::class,'index'])->name('home');

//User Authentication
Route::get('user/login-register-form',[IndexController::class,'userLoginRegister'])->name('user.auth');
Route::post('user/login',[IndexController::class,'userLogin'])->name('user.login');
Route::post('user/register',[IndexController::class,'registerSubmit'])->name('user.register');
Route::get('user/logout',[IndexController::class,'logoutSubmit'])->name('user.logout');

//User Profile
Route::get('user/dashboard',[IndexController::class,'userDashboard'])->name('user.myaccount');
Route::get('user/order',[IndexController::class,'userOrder'])->name('user.order');
Route::get('user/address',[IndexController::class,'userAddress'])->name('user.address');
Route::post('user/billing-address/{id}',[IndexController::class,'userBillingAddress'])->name('user.billingaddress.store');
Route::post('user/shipping-address/{id}',[IndexController::class,'userShippingAddress'])->name('user.shippingaddress.store');
Route::get('user/account-details',[IndexController::class,'userAccountDetails'])->name('user.account.details');
Route::post('user/account-update/{id}',[IndexController::class,'userAccountUpdate'])->name('user.account.update');

//Product Category Section
Route::get('product-category/{slug}',[IndexController::class,'productCategory'])->name('product.category');
Route::get('product-details/{slug}',[IndexController::class,'productDetails'])->name('product.details');

// Cart
Route::post('cart-store',[CartController::class,'cartStore'])->name('cart.store');


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


