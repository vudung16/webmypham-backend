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
// });

?>
