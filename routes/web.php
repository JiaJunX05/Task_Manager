<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\UserAuth;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Set the middleware for all routes
Route::group(['middleware' => [UserAuth::class]], function() {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [TaskController::class, 'fetchAllTasks'])->name('dashboard');
    Route::get('/done/{id}', [TaskController::class, 'doneTask'])->name('doneTask');
    Route::get('/reset/{id}', [TaskController::class, 'resetTask'])->name('resetTask');

    Route::get('/create', [TaskController::class, 'showCreateForm'])->name('create');
    Route::post('/create', [TaskController::class, 'create'])->name('create.submit');

    Route::get('/view/{id}', [TaskController::class, 'viewTask'])->name('viewTask');

    Route::get('/edit/{id}', [TaskController::class, 'showEditForm'])->name('editTask');
    Route::put('/edit/{id}', [TaskController::class, 'edit'])->name('edit.submit');

    Route::delete('/delete/{id}', [TaskController::class, 'destroy'])->name('deleteTask');
});