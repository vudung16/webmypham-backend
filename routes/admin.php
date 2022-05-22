<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware([
//     'auth.admin', 'permission'
//     ])->group(function () {
    Route::post('dashboard', 'App\Http\Controllers\Admin\DashBoardController@dashboard')->name('admin.dashboard');
    Route::group(['prefix' => 'slide'], function(){
        Route::post('list', 'App\Http\Controllers\Admin\SlideController@getSlide')->name('admin.getSlide');
        Route::post('delete', 'App\Http\Controllers\Admin\SlideController@deleteSlide')->name('admin.deleteSlide');
        Route::post('create', 'App\Http\Controllers\Admin\SlideController@createSlide')->name('admin.createSlide');
        Route::post('update', 'App\Http\Controllers\Admin\SlideController@updateSlide')->name('admin.updateSlide');
    });
    Route::group(['prefix' => 'category'], function(){
        Route::post('list', 'App\Http\Controllers\Admin\CategoryController@getCategory')->name('admin.getCategory');
        Route::post('delete', 'App\Http\Controllers\Admin\CategoryController@deleteCategory')->name('admin.deleteCategory');
        Route::post('create', 'App\Http\Controllers\Admin\CategoryController@createCategory')->name('admin.createCategory');
        Route::post('update', 'App\Http\Controllers\Admin\CategoryController@updateCategory')->name('admin.updateCategory');
    });
    Route::group(['prefix' => 'brand'], function(){
        Route::post('list', 'App\Http\Controllers\Admin\BrandController@getBrand')->name('admin.getBrand');
        Route::post('delete', 'App\Http\Controllers\Admin\BrandController@deleteBrand')->name('admin.deleteBrand');
        Route::post('create', 'App\Http\Controllers\Admin\BrandController@createBrand')->name('admin.createBrand');
        Route::post('update', 'App\Http\Controllers\Admin\BrandController@updateBrand')->name('admin.updateBrand');
    });
    Route::group(['prefix' => 'voucher'], function(){
        Route::post('list', 'App\Http\Controllers\Admin\VoucherController@getVoucher')->name('admin.getVoucher');
        Route::post('detail', 'App\Http\Controllers\Admin\VoucherController@detailVoucher')->name('admin.detailVoucher');
        Route::post('delete', 'App\Http\Controllers\Admin\VoucherController@deleteVoucher')->name('admin.deleteVoucher');
        Route::post('create', 'App\Http\Controllers\Admin\VoucherController@createVoucher')->name('admin.createVoucher');
        Route::post('update', 'App\Http\Controllers\Admin\VoucherController@updateVoucher')->name('admin.updateVoucher');
    });
    Route::group(['prefix' => 'product'], function(){
        Route::post('list', 'App\Http\Controllers\Admin\ProductController@getProduct')->name('admin.getProduct');
        Route::post('detail', 'App\Http\Controllers\Admin\ProductController@detailProduct')->name('admin.detailProduct');
        Route::post('delete', 'App\Http\Controllers\Admin\ProductController@deleteProduct')->name('admin.deleteProduct');
        Route::post('create', 'App\Http\Controllers\Admin\ProductController@createProduct')->name('admin.createProduct');
        Route::post('update', 'App\Http\Controllers\Admin\ProductController@updateProduct')->name('admin.updateProduct');
        Route::post('delete-image', 'App\Http\Controllers\Admin\ProductController@deleteImage')->name('admin.deleteImage');
    });
    Route::group(['prefix' => 'order'], function(){
        Route::post('list', 'App\Http\Controllers\Admin\OrderController@getOrder')->name('admin.getOrder');
        Route::post('detail', 'App\Http\Controllers\Admin\OrderController@detailOrder')->name('admin.detailOrder');
        Route::post('change-action', 'App\Http\Controllers\Admin\OrderController@changeAction')->name('admin.changeAction');
        Route::post('cancel-order', 'App\Http\Controllers\Admin\OrderController@cancelOrder')->name('admin.cancelOrder');
    });
    Route::group(['prefix' => 'import'], function(){
        Route::post('get-product', 'App\Http\Controllers\Admin\ImportController@getProductImport')->name('admin.getProductImport');
        Route::post('import-warehouse', 'App\Http\Controllers\Admin\ImportController@importWarehouse')->name('admin.importWarehouse');
    });
// });

?>
