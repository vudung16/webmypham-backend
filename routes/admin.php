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
    });
// });

?>
