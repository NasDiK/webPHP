<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ResumeController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [
    IndexController::class, 'index'
])->name('index')->middleware('auth');

Route::get('/add', [
    IndexController::class, 'add'
])->name('add')->middleware('auth');

Route::post('/add', [
    IndexController::class, 'storeNews'
])->name('storeNews');


Route::get('/rubric/{id}', [
    IndexController::class, 'rubric'
])->name('rubric')->middleware('auth');

Route::get('/statya/{id}', [
    IndexController::class, 'statya'
])->name('statya')->middleware('auth');

Route::delete('/statya/{id}/{from}', [
    IndexController::class, 'deleteNews'
])->name('deleteNews');
