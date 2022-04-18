<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\HomeController;

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

Auth::routes([
    'register' => false
]);

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
    Route::resource('disciplines', DisciplineController::class);
    Route::resource('classrooms', ClassroomController::class);

    /*
    |--------------------------------------------------------------------------
    | Web Routes End-Ponit
    |--------------------------------------------------------------------------
    */
    Route::get('loading-disciplines', [ClassroomController::class, 'ajaxLoadingDisciplines'])->name('loading-disciplines');
});
