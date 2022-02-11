<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
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
    return redirect('home');   
});
Route::GET('home','App\Http\Controllers\homeController@lsslide');
Route::get('logout','App\Http\Controllers\loginController@logout');
Route::get('login','App\Http\Controllers\loginController@getLogin');
Route::post('login','App\Http\Controllers\loginController@postLogin');
Route::get('register','App\Http\Controllers\registerController@getRegister');
Route::post('register','App\Http\Controllers\registerController@postRegister');

Route::get('listcart','App\Http\Controllers\orderController@getlistcart');
Route::post('listcart','App\Http\Controllers\orderController@postlistcart');

// Route::get('profile','App\Http\Controllers\orderController@getprofile');

Route::get('profile','App\Http\Controllers\orderController@getprofile');
Route::post('profile','App\Http\Controllers\orderController@editprofile');

Route::get('addprofile/{id}','App\Http\Controllers\orderController@getaddprofile');
Route::post('addprofile/{id}','App\Http\Controllers\orderController@profile');
Route::get('deletewishlist/{product_id}','App\Http\Controllers\wishlistController@deletewishlist');

Route::get('category/{category_id}','App\Http\Controllers\homeController@showListProduct_byIdCate');
Route::get('brand','App\Http\Controllers\homeController@showListProduct_byIdBrand');
Route::get('product/{product_id}','App\Http\Controllers\homeController@showProduct');
Route::get('brand/{brand_id}','App\Http\Controllers\homeController@showListProduct_byIdBrand');
Route::get('product-all','App\Http\Controllers\homeController@showListProduct');

Route::post('addorder/{order_id}','App\Http\Controllers\orderController@addorder');
Route::get('listorder','App\Http\Controllers\orderController@listorder');
Route::get('showdetail/{order_id}','App\Http\Controllers\orderController@Showdetail');


Route::get('addToCart/{product_id}','App\Http\Controllers\homeController@addToCart');

Route::get('search', 'App\Http\Controllers\homeController@search');
Route::post('rate/{id}', 'App\Http\Controllers\rateController@postRate');

Route::group(['prefix' => 'admin', 'middleware' => 'adminCheck'], function () {
	Route::get('/',function(){
		return redirect('admin/home');
	});    
    Route::get('home',function(){
		return view('admin.admin');
	});
    Route::group(['prefix' => 'slide'], function () {
        Route::GET('/','App\Http\Controllers\slideController@index');
        Route::POST('addslide','App\Http\Controllers\slideController@store');
        Route::GET('detailslide/{slide_id}','App\Http\Controllers\slideController@detailslide');
        Route::GET('deleteslide/{slide_id}','App\Http\Controllers\slideController@deleteslide');
        Route::POST('editslide','App\Http\Controllers\slideController@editslide');
    });
    Route::group(['prefix' => 'category'], function () {
        Route::GET('/','App\Http\Controllers\categoryController@index');
        Route::POST('addcategory','App\Http\Controllers\categoryController@addCategory');
        Route::GET('detailcategory/{category_id}','App\Http\Controllers\categoryController@detailCategory');
        Route::GET('deletecategory/{category_id}','App\Http\Controllers\categoryController@deleteCategory');
        Route::POST('editcategory','App\Http\Controllers\categoryController@editCategory');
    });
    Route::group(['prefix' => 'brand'], function () {
        Route::GET('/','App\Http\Controllers\brandController@index');
        Route::POST('addbrand','App\Http\Controllers\brandController@addBrand');
        Route::GET('detailbrand/{brand_id}','App\Http\Controllers\brandController@detailBrand');
        Route::GET('deletebrand/{brand_id}','App\Http\Controllers\brandController@deleteBrand');
        Route::POST('editbrand','App\Http\Controllers\brandController@editBrand');
    });
    Route::group(['prefix' => 'product'], function () {
        Route::GET('/','App\Http\Controllers\productController@index');
        Route::POST('addproduct','App\Http\Controllers\productController@addProduct');
        Route::GET('detailproduct/{product_id}','App\Http\Controllers\productController@detailProduct');
        Route::GET('deleteproduct/{product_id}','App\Http\Controllers\productController@deleteProduct');
        Route::POST('editproduct','App\Http\Controllers\productController@editProduct');
    });
    Route::group(['prefix' => 'productimage'], function () {
        Route::GET('/','App\Http\Controllers\productimageController@index');
        Route::POST('addproductimg','App\Http\Controllers\productimageController@addProductimg');
        Route::GET('detailproductimg/{product_id}','App\Http\Controllers\productimageController@detailProductimg');
        Route::GET('deleteproductimg/{product_id}','App\Http\Controllers\productimageController@deleteProductimg');
        Route::POST('editproductimg','App\Http\Controllers\productimageController@editProductImg');
    });
    Route::group(['prefix' => 'order'], function () {
        Route::GET('/','App\Http\Controllers\orderController@index');
        Route::POST('action/{order_id}','App\Http\Controllers\orderController@action');  
        Route::GET('/product/{order_id}','App\Http\Controllers\orderController@getProductOrder');
        Route::POST('/product/{order_id}','App\Http\Controllers\orderController@postProductOrder');
    });
});



