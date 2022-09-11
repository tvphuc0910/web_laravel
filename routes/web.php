<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

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



Route::group(attributes: ['prefix' => 'courses', 'as' => 'course.'], routes: function(){
    Route::get('/',action:[CourseController::class, 'index']);
    Route::get('/create',action:[CourseController::class, 'create'])->name('create');
    Route::post('/create',action:[CourseController::class, 'store'])->name('store');
});
