<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckSuperAdminMiddleware;
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
Route::get('login', [AuthController::class, 'login'])->name('login') ;
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login') ;
Route::group([
    'middleware' => CheckLoginMiddleware::class,
], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('courses',CourseController::class)->except([
        'show',
        'destroy',
    ]);
    Route::get('courses/api', [CourseController::class, 'api'])->name('courses.api');
    Route::get('courses/api/name', [CourseController::class, 'apiName'])->name('courses.api.name');


    Route::resource('students', StudentController::class)->except([
        'show',
    ]);
    Route::get('students/api', [StudentController::class, 'api'])->name('students.api');
    Route::group([
        'middleware' => CheckSuperAdminMiddleware::class,
    ], function () {
        Route::delete('courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
        Route::delete('students/{student}', [CourseController::class, 'destroy'])->name('students.destroy');

    });

    //Route::group(attributes: ['prefix' => 'courses', 'as' => 'course.'], routes: function(){
//    Route::get('/',action:[CourseController::class, 'index'])->name('index');
//    Route::get('/create',action:[CourseController::class, 'create'])->name('create');
//    Route::post('/create',action:[CourseController::class, 'store'])->name('store');
//    Route::delete('/destroy/{course}',action:[CourseController::class, 'destroy'])->name('destroy');
//    Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('edit');
//    Route::put('/edit/{course}', [CourseController::class, 'update'])->name('update');
//});
});

