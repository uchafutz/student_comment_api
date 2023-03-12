<?php

use App\Http\Controllers\AccademicYearController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("/department")->name("api.")->group(function () {
    Route::resource("departments", DepartmentController::class);
    Route::resource("lectures", LectureController::class);
    Route::resource("years", AccademicYearController::class);
    Route::resource("students", StudentController::class);
});
Route::prefix("/course")->name("api.")->group(function () {
    Route::resource("courses", CourseController::class);
    Route::resource("modules", ModuleController::class);
});
Route::prefix("/user")->name("api.")->group(function () {
    Route::resource("users", UserController::class);
});
Route::prefix("/comment")->name("api.")->group(function () {
    Route::resource("comments", CommentController::class);
});
