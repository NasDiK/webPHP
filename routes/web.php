<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [
    IndexController::class, 'index'
])->name('index');

Route::get('/home', [
    App\Http\Controllers\HomeController::class, 'index'
])->name('home');

Route::get('/activity', [
    IndexController::class, 'activity'
])->name('activity');

Route::get('/profile', [
    IndexController::class, 'profile'
])->name('profile')->middleware('auth');

Route::get('/addMasterClass', [
    IndexController::class, 'addMasterClass'
])->name('addMasterClass')->middleware('auth');

Route::post('/storeMasterClass', [
    IndexController::class, 'storeMasterClass'
])->name('storeMasterClass')->middleware('auth');

Route::get('/registration/{id}', [
    IndexController::class, 'registration'
])->name('registration')->middleware('auth');

Route::post('/course-register/{id}', [
    IndexController::class, 'courseRegister'
])->name('course-register')->middleware('auth');

Route::get('/masterClass/{id}', [
    IndexController::class, 'masterClass'
])->name('masterClass')->middleware('auth');

Route::put('/masterClass/{id}', [
    IndexController::class, 'updateMasterClass'
])->name('updateMasterClass')->middleware('auth');

Route::get('/getEmptyTimeByDate', [
    IndexController::class, 'getEmptyTimeByDate'
])->name('getEmptyTimeByDate')->middleware('auth');
