<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CheckoutController;

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

Auth::routes(['register'=>false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

// <================Frontend Part============>

//Home
Route::get('/',[IndexController::class,'index'])->name('home');

//Shop
Route::get('shop',[IndexController::class,'shop'])->name('shop');

//User Authentication
Route::get('user/auth/login-register',[IndexController::class,'userAuthLoginRegister'])->name('user.auth');
Route::post('user/login',[IndexController::class,'userLogin'])->name('user.login');
Route::post('user/register',[IndexController::class,'registerSubmit'])->name('user.register');
Route::get('user/logout',[IndexController::class,'logoutSubmit'])->name('user.logout');

//User Point
Route::group(['prefix'=>'user'],function(){
    Route::get('/dashboard',[IndexController::class,'userDashboard'])->name('user.myaccount');
    Route::get('/order',[IndexController::class,'userOrder'])->name('user.order');
    Route::get('/address',[IndexController::class,'userAddress'])->name('user.address');
    Route::post('/billing-address/{id}',[IndexController::class,'userBillingAddress'])->name('user.billingaddress.store');
    Route::post('/shipping-address/{id}',[IndexController::class,'userShippingAddress'])->name('user.shippingaddress.store');
    Route::get('/account-details',[IndexController::class,'userAccountDetails'])->name('user.account.details');
    Route::post('/account-update/{id}',[IndexController::class,'userAccountUpdate'])->name('user.account.update');
});

//Product Category Section
Route::get('product-category/{slug}',[IndexController::class,'productCategory'])->name('product.category');
Route::get('product-details/{slug}',[IndexController::class,'productDetails'])->name('product.details');

//Product Review Section
Route::post('product-review/{slug}',[ProductReviewController::class,'productReview'])->name('product.review');

// Cart
Route::get('cart',[CartController::class,'cartIndex'])->name('cart.index');
Route::post('cart-store',[CartController::class,'cartStore'])->name('cart.store');
Route::post('cart-delete',[CartController::class,'cartDelete'])->name('cart.destroy');

Route::post('coupon-add',[CartController::class,'couponAdd'])->name('coupon.add');

//Checkout
Route::get('checkout',[CheckoutController::class,'checkout1'])->name('checkout1')->middleware('user');
Route::post('checkout-store',[CheckoutController::class,'checkout1Store'])->name('checkout1.store');
Route::post('checkout-payment',[CheckoutController::class,'checkout2Store'])->name('checkout2.store');
Route::post('checkout-final',[CheckoutController::class,'checkout3Store'])->name('checkout3.store');
Route::get('checkout-confirm',[CheckoutController::class,'checkoutStore'])->name('checkout4.store');
Route::get('checkout-complete/{order}',[CheckoutController::class,'checkoutComplete'])->name('checkout.complete');


// <================ Backend Part Admin ============>

//Admin Login Auth
Route::group(['prefix'=>'admin'],function(){
    Route::get('/login',[\App\Http\Controllers\Auth\Admin\LoginController::class,'ShowLoginForm'])->name('admin.login.form');
    Route::post('/login',[\App\Http\Controllers\Auth\Admin\LoginController::class,'login'])->name('admin.login');
});
//Admin Point
Route::group(['prefix'=>'admin','middleware'=>['admin']],function(){
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
//Coupon Section
    Route::resource('/coupon',CouponController::class);
    Route::post('/coupon-status',[CouponController::class,'couponStatus'])->name('coupon.status');
//Shipping Section
    Route::resource('/shipping',ShippingController::class);
    Route::post('/shipping-status',[ShippingController::class,'shippingStatus'])->name('shipping.status');
//Order Section
    Route::resource('/order',OrderController::class);
    Route::post('/order-status',[OrderController::class,'orderStatus'])->name('order.status');
//Seller Section
    Route::resource('/seller',SellerController::class);
    Route::post('/seller-status',[SellerController::class,'sellerStatus'])->name('seller.status');
    Route::post('/seller-verified',[SellerController::class,'sellerVerified'])->name('seller.verified');
});

//-----------------------<==============Seller===========>---------------------------------

//Seller Login Auth
Route::group(['prefix'=>'seller'],function(){
    Route::get('/login',[\App\Http\Controllers\Auth\Seller\LoginController::class,'ShowLoginForm'])->name('seller.login.form');
    Route::post('/login',[\App\Http\Controllers\Auth\Seller\LoginController::class,'login'])->name('seller.login');
});

//Seller Point
Route::group(['prefix'=>'seller','middleware'=>['seller']],function(){
    Route::get('/',[\App\Http\Controllers\Seller\SellerController::class,'dashboard'])->name('seller');

//Product Section
    Route::resource('/seller-product',App\Http\Controllers\Seller\ProductController::class);
    Route::post('/product-status',[ProductController::class,'productStatus'])->name('seller.product.status');
});

////////////////////////////
Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
