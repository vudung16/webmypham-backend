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
Route::post('add-to-cart', 'App\Http\Controllers\Api\WebviewController@addToCart')->name('api.home.addtocart');
Route::post('payment', 'App\Http\Controllers\Api\WebviewController@payment')->name('api.home.payment');
Route::get('return-vnpay', 'App\Http\Controllers\Api\WebviewController@returnVnpay')->name('api.home.returnvnpay');
Route::get('list-voucher', 'App\Http\Controllers\Api\WebviewController@listVoucher')->name('api.home.listvoucher');
Route::post('check-voucher', 'App\Http\Controllers\Api\WebviewController@checkVoucher')->name('api.home.checkvoucher');
