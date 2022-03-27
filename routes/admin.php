<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware([
//     'auth.admin', 'permission'
//     ])->group(function () {
    Route::post('dashboard', 'App\Http\Controllers\Admin\DashBoardController@dashboard')->name('admin.dashboard');
// });

?>
