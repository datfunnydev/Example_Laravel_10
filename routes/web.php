<?php

use App\Http\Controllers\Admin\LogActivityController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MyProfileController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\View\LanguageController;
use App\Http\Controllers\View\SetupController;
use Illuminate\Support\Facades\Route;

//Setup
Route::group(['prefix' => 'setup'], function () {
    Route::get('/', [SetupController::class, 'view_step1']);
    Route::get('/step-1', [SetupController::class, 'view_step1']);
    Route::get('/step-2', [SetupController::class, 'view_step2']);
    Route::post('/step-2', [SetupController::class, 'setup_step2']);
    Route::get('/step-3', [SetupController::class, 'view_step3']);
    Route::post('/step-3', [SetupController::class, 'setup_step3']);
    Route::get('/step-4', [SetupController::class, 'view_step4']);
    Route::post('/step-4', [SetupController::class, 'setup_step4']);
    Route::get('/final', [SetupController::class, 'view_final']);
    Route::get('/new-key', [SetupController::class, 'new_key']);
});

//Language
Route::get('/language/{language}', [LanguageController::class, 'change']);

//Auth
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/forgot-pass', [ForgotPasswordController::class, 'forgot_pass']);
Route::post('/reset-pass', [ResetPasswordController::class, 'reset_pass']);

Route::group(['middleware' => ['auth', 'permission']], function () {
    //User
    Route::get('/profile', [MyProfileController::class, 'index']);
    Route::put('/profile', [MyProfileController::class, 'update']);
    Route::get('/change-pass', [ChangePasswordController::class, 'index']);
    Route::put('/change-pass', [ChangePasswordController::class, 'update']);

    //Log Activity
    Route::group(['prefix' => 'log-activities'], function () {
        Route::get('/', [LogActivityController::class, 'index'])->name('log_activity.index');
    });

    //User
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('{id}', [UserController::class, 'show'])->name('user.show');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::put('{id}', [UserController::class, 'update'])->name('user.update');
        Route::put('restore/{id}', [UserController::class, 'restore'])->name('user.restore');
        Route::delete('{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    //Role
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('{id}', [RoleController::class, 'show'])->name('role.show');
        Route::post('/', [RoleController::class, 'store'])->name('role.store');
        Route::put('{id}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    });
});
