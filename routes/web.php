<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IndexController;

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

Auth::routes();

Route::get('/home', [
    App\Http\Controllers\HomeController::class, 'index'
])->name('home');

Route::get('/', [
    IndexController::class, 'index'
])->name('index')->middleware('auth');

Route::get('/course/{id}', [
    IndexController::class, 'course'
])->name('course')->middleware('auth');

Route::get('/courseAdd', [
    IndexController::class, 'courseAdd'
])->name('courseAdd')->middleware('auth');

Route::post('/courseAdd', [
    IndexController::class, 'storeCourse'
])->name('storeCourse')->middleware('auth');

Route::delete('/deleteCourse/{id}', [
    IndexController::class, 'deleteCourse'
])->name('deleteCourse')->middleware('auth');

Route::post('/courseRegister/{id}', [
    IndexController::class, 'courseRegister'
])->name('courseRegister')->middleware('auth');

Route::post('/courseUnRegister/{id}', [
    IndexController::class, 'courseUnRegister'
])->name('courseUnRegister')->middleware('auth');

Route::get('/profile', [
    IndexController::class, 'profile'
])->name('profile')->middleware('auth');

Route::delete('/deleteRecord/{id}', [
    IndexController::class, 'deleteRecord'
])->name('deleteRecord')->middleware('auth');

Route::get('/admin', [
    IndexController::class, 'admin'
])->name('admin')->middleware('auth');

Route::get('/courseRecords', [
    IndexController::class, 'courseRecords'
])->name('courseRecords');

Route::delete('/deleteRecordInAdminPage/{id}', [
    IndexController::class, 'deleteRecordInAdminPage'
])->name('deleteRecordInAdminPage')->middleware('auth');

Route::get('/language/{id}', [
    IndexController::class, 'language'
])->name('language')->middleware('auth');

Route::get('/list', [
    IndexController::class, 'list'
])->name('list')->middleware('auth');
