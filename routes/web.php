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

Route::get('/', [
    IndexController::class, 'index'
])->name('index');

Route::get('/resume', [
    IndexController::class, 'index'
])->name('resume');

Route::get('/resume/show/{id}', [
    ResumeController::class, 'showPersonResume'
]);

Route::get('/resume/add', [
    ResumeController::class, 'showAddPersonPage'
])->name('resumeAdd');

Route::get('/resume/edit/{id}', [
    ResumeController::class, 'showEditPersonPage'
]);

Route::post('/resume/add', [
    ResumeController::class, 'addResume'
]);

Route::post('/resume/edit/{id}', [
    ResumeController::class, 'updateResume'
]);

Route::post('/resume/delete/{id}', [
    ResumeController::class, 'deleteResume'
]);