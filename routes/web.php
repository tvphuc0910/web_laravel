<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
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


Route::resource('courses',CourseController::class)->except([
    'show',
]);
Route::get('courses/api', [CourseController::class, 'api'])->name('courses.api');
Route::get('courses/api/name', [CourseController::class, 'apiName'])->name('courses.api.name');


Route::resource('students', StudentController::class)->except([
    'show',
]);
Route::get('students/api', [StudentController::class, 'api'])->name('students.api');
//Route::group(attributes: ['prefix' => 'courses', 'as' => 'course.'], routes: function(){
//    Route::get('/',action:[CourseController::class, 'index'])->name('index');
//    Route::get('/create',action:[CourseController::class, 'create'])->name('create');
//    Route::post('/create',action:[CourseController::class, 'store'])->name('store');
//    Route::delete('/destroy/{course}',action:[CourseController::class, 'destroy'])->name('destroy');
//    Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('edit');
//    Route::put('/edit/{course}', [CourseController::class, 'update'])->name('update');
//});
