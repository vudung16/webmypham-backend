<?php

use Illuminate\Http\Request;
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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('home-slide', 'App\Http\Controllers\Api\WebviewController@homeSlide')->name('api.home.slide');
Route::get('home-product', 'App\Http\Controllers\Api\WebviewController@homeProduct')->name('api.home.product');
Route::get('product-discount', 'App\Http\Controllers\Api\WebviewController@productDiscount')->name('api.home.discount');
Route::get('product-selling', 'App\Http\Controllers\Api\WebviewController@productSelling')->name('api.home.selling');
Route::post('product-detail', 'App\Http\Controllers\Api\WebviewController@productDetail')->name('api.home.productdetail');
Route::get('category', 'App\Http\Controllers\Api\WebviewController@category')->name('api.home.category');
Route::get('brand', 'App\Http\Controllers\Api\WebviewController@brand')->name('api.home.brand');
// Route::post('add-to-cart', 'App\Http\Controllers\Api\WebviewController@addToCart')->name('api.home.addtocart');
Route::post('payment', 'App\Http\Controllers\Api\WebviewController@payment')->name('api.home.payment');
Route::get('return-vnpay', 'App\Http\Controllers\Api\WebviewController@returnVnpay')->name('api.home.returnvnpay');
Route::get('return-momo', 'App\Http\Controllers\Api\WebviewController@returnMomo')->name('api.home.returnMomo');
Route::get('list-voucher', 'App\Http\Controllers\Api\WebviewController@listVoucher')->name('api.home.listvoucher');
Route::post('check-voucher', 'App\Http\Controllers\Api\WebviewController@checkVoucher')->name('api.home.checkvoucher');
Route::post('category-product', 'App\Http\Controllers\Api\WebviewController@categoryProduct')->name('api.home.categoryproduct');
Route::post('rating', 'App\Http\Controllers\Api\WebviewController@rating')->name('api.home.rating');
Route::post('comment', 'App\Http\Controllers\Api\WebviewController@comment')->name('api.comment');
Route::post('info-order', 'App\Http\Controllers\Api\WebviewController@infoOrder')->name('api.infoOrder');

Route::post('reset-password', 'App\Http\Controllers\Api\ResetPasswordController@sendMail');
Route::post('reset', 'App\Http\Controllers\Api\ResetPasswordController@reset');
Route::get('testt',function(){
    return view('mail');
  });

//Login
Route::post('auth/login', 'App\Http\Controllers\Api\AuthController@login');
Route::post('auth/register', 'App\Http\Controllers\Api\AuthController@register');
Route::group(['middleware' => 'jwt.auth'], function(){
  Route::post('auth/logout', 'App\Http\Controllers\Api\AuthController@logout');
  Route::get('auth/user', 'App\Http\Controllers\Api\AuthController@user');
  Route::post('auth/update-user', 'App\Http\Controllers\Api\AuthController@updateUser');
  Route::post('add-to-cart', 'App\Http\Controllers\Api\WebviewController@addToCart')->name('api.home.addtocart');
  Route::post('get-cart', 'App\Http\Controllers\Api\WebviewController@getCart')->name('api.getcart');
  Route::post('user-rate', 'App\Http\Controllers\Api\WebviewController@userRate')->name('api.userRate');
});
Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::get('auth/refresh', 'App\Http\Controllers\Api\AuthController@refresh');
});
