<?php

use Illuminate\Support\Facades\Route;
use Mughal\AdminAuth\Controllers\LoginController;

Route::prefix('admin')->group(function () {
    // Guest routes
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [LoginController::class, 'show_login_form'])->name('admin.showlogin');
        Route::post('/login', [LoginController::class, 'process_login'])->name('admin.storelogin');
        Route::get('/register', [LoginController::class, 'show_signup_form'])->name('admin.showregister');
        Route::post('/register', [LoginController::class, 'process_signup'])->name('admin.storeregister');
        Route::get('reset_password', [LoginController::class,'passwordResetForm'])->name('admin.reset-form');
        Route::post('reset_password_forgot', [LoginController::class,'forgot'])->name('admin.forgot');
        Route::get('confirm-form', [LoginController::class,'confirmForm'])->name('admin.confirm-form');
        Route::post('reset_password_confirm', [LoginController::class,'reset'])->name('admin.pass.code');
        Route::get('resetCodeForm', [LoginController::class,'resetCodeForm'])->name('admin.resetCodeForm');
        Route::post('verify_email', [LoginController::class,'verifyEmail'])->name('admin.verify_email');
        Route::get('change-password', [LoginController::class,'changePassword'])->name('admin.change-password');
        Route::post('confirm-code', [LoginController::class,'confirmCode'])->name('admin.confirm-code');
    });

    // Logout route
    Route::post('/logout',[LoginController::class,'logout'])->name('admin.logout');
});
