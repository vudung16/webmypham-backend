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
        Route::post('delete', 'App\Http\Controllers\Admin\VoucherController@deleteVoucher')->name('admin.deleteVoucher');
        Route::post('create', 'App\Http\Controllers\Admin\VoucherController@createVoucher')->name('admin.createVoucher');
        Route::post('update', 'App\Http\Controllers\Admin\VoucherController@updateVoucher')->name('admin.updateVoucher');
    });
// });

?>
