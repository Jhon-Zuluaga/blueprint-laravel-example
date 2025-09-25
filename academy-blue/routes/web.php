<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('categories.index');
});


Route::resource('categories', CategoryController::class);

Route::resource('courses', CourseController::class);

Route::resource('lessons', App\Http\Controllers\LessonController::class)->except('show');

Route::resource('enrollments', App\Http\Controllers\EnrollmentController::class)->except('show');
