<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardsController;
use App\Http\Controllers\TaskController;
use App\Models\Boards;
use GuzzleHttp\Middleware;
use App\Http\Controllers\MailController;

Route::get('/', [BoardsController::class, 'index'])->middleware('auth')->name('home');

Route::get('/register',[AuthController::class, 'showRegisterPage'])->name('show.register');
Route::get('/login',[AuthController::class, 'showLoginPage'])->name('show.login');
Route::post('/register',[AuthController::class, 'Register'])->name('register');
Route::post('/login',[AuthController::class, 'Login'])->name('login');
Route::post('/logout',[AuthController::class, 'Logout'])->name('logout');


Route::get('/boards/create', [BoardsController::class, 'create'])->name('boards.create');
Route::get('/boards', [BoardsController::class, 'index'])->name('boards.index')->middleware('auth');
Route::post('/boards',[BoardsController::class, 'store'])->name('boards.store');

Route::delete('/boards/{board}', [BoardsController::class, 'destroy'])->name('boards.destroy'); 

Route::get('/boards/{board}/share', [BoardsController::class, 'shareBoard'])->name('boards.shareBoard');
Route::Post('/boards/{board}/share', [BoardsController::class,    'share'])->name('boards.share');

Route::get('request', [BoardsController::class, 'showRequestPage'])->name('show.request');
Route::post('request/{board}/accept', [BoardsController::class, 'acceptRequest'])->name('accept.request');
Route::post('request/{board}/reject', [BoardsController::class, 'rejectRequest'])->name('reject.request');

Route::get('/boards/shared', [BoardsController::class, 'listSharedBoards'])->name('boards.shared');

Route::get('/boards/show',  [TaskController::class,    'show'])->name('tasks.add');
Route::post('/boards/{board}/tasks',  [TaskController::class,  'store'])->name('tasks.store');
Route::post('/task/update',    [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
Route::post('/task/delete/{task}', [TaskController::class, 'destroy'])->name('tasks.delete');

Route::get('/editask/{task}', [TaskController::class, 'editTask'])->middleware('auth')->name('tasks.edit');
Route::post('/editask/{task}', [TaskController::class, 'updateTask'])->middleware('auth')->name('tasks.update');
// Route::get('/timeline', [TaskController::class, 'index'])->name('tasks.timeling');

Route::get('/editprofile',  [AuthController::class, 'editprofile'])->middleware('auth')->name('editprofile');
Route::post('/editprofile',  [AuthController::class, 'updateprofile'])->middleware('auth')->name('updateprofile');

Route::get('/boards/manage-shared', [BoardsController::class, 'viewManageBoards'])->name('boards.manage-shared');
Route::delete('/boards/{board}/shared/{user}', [BoardsController::class, 'removeShare'])->name('boards.remove-share');

Route::get('/boards/{id}', [BoardsController::class, 'show'])->middleware('auth')->name('boards.show');

Route::get('/', [MailController:: class, 'sendMail']);