<?php

use App\Http\Controllers\AccademicYearController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Inv\AssignLectureController;
use App\Http\Controllers\Inv\AssingCourseController;
use App\Http\Controllers\Inv\UpdateAccademicController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix("/department")->name("department.")->group(function () {
    Route::resource("departments", DepartmentController::class);
    Route::resource("lectures", LectureController::class);
    Route::resource("years", AccademicYearController::class);
    Route::resource("students", StudentController::class);
});
Route::prefix("/course")->name("course.")->group(function () {
    Route::resource("courses", CourseController::class);
    Route::resource("modules", ModuleController::class);
});

Route::prefix("/user")->name("user.")->group(function () {
    Route::resource("users", UserController::class);
});
Route::post("accademic/{year}", UpdateAccademicController::class)->name("accadmic.year");
Route::post("lectures/{lecture}", AssignLectureController::class)->name("lecture.assign");
Route::post("courses/assign/{course}", AssingCourseController::class)->name("course.assign");

Route::prefix("/comment")->name("comment.")->group(function () {
    Route::resource("commets", CommentController::class);
});
