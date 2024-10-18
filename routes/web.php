<?php

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

Route::get('/', [App\Http\Controllers\SiteController::class, 'index'])->name('index');
Route::get('/category/{id}', [App\Http\Controllers\SiteController::class, 'category'])->name('category');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/enroll/{id}', [App\Http\Controllers\SiteController::class, 'enroll'])->name('enroll');
    Route::get('/course/{id}', [App\Http\Controllers\SiteController::class, 'course'])->name('course.show');
    Route::get('/lesson/{id}', [App\Http\Controllers\SiteController::class, 'lesson'])->name('lesson.show');
    Route::get('/my-courses', [App\Http\Controllers\SiteController::class, 'myCourses'])->name('my.courses');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'authenticate'])->name('post.login');
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'store'])->name('post.register');
});
