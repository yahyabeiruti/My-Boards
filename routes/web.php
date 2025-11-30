<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardsController;
use App\Http\Controllers\TaskController;
use App\Models\Boards;
use GuzzleHttp\Middleware;

Route::get('/', [BoardsController::class, 'index'])->middleware('auth')->name('home');


Route::get('/register',[AuthController::class, 'showRegisterPage'])->name('show.register');
Route::get('/login',[AuthController::class, 'showLoginPage'])->name('show.login');
Route::post('/register',[AuthController::class, 'Register'])->name('register');
Route::post('/login',[AuthController::class, 'Login'])->name('login');
Route::post('/logout',[AuthController::class, 'Logout'])->name('logout');


Route::get('/boards/create', [BoardsController::class, 'create'])->name('boards.create');
Route::get('/boards', [BoardsController::class, 'index'])->name('boards.index');
Route::get('/boards/{id}', [BoardsController::class, 'show'])->name('boards.show'); 
Route::post('/boards',[BoardsController::class, 'store'])->name('boards.store');

Route::delete('/boards/{board}', [BoardsController::class, 'destroy'])->name('boards.destroy'); 

Route::get('/boards/show',  [TaskController::class,    'show'])->name('tasks.add');
Route::post('/boards/{board}/tasks',  [TaskController::class,  'store'])->name('tasks.store');
Route::post('/task/update',    [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
Route::get('/timeline', [TaskController::class, 'index'])->name('tasks.timeling');

Route::get('/editprofile',  [AuthController::class, 'editprofile'])->middleware('auth')->name('editprofile');
Route::post('/editprofile',  [AuthController::class, 'updateprofile'])->middleware('auth')->name('updateprofile');