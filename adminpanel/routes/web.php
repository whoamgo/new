<?php

use Illuminate\Support\Facades\Route;

// Authentication
Route::get('login', [\App\Http\Controllers\Auth\AuthController::class, 'showLogin'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');

Route::get('register', [\App\Http\Controllers\Auth\AuthController::class, 'showRegister'])->name('register');
Route::post('register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);

// Email verification
Route::get('email/verify', [\App\Http\Controllers\Auth\EmailVerificationController::class, 'notice'])
    ->middleware('auth')
    ->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [\App\Http\Controllers\Auth\EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');
Route::post('email/verification-notification', [\App\Http\Controllers\Auth\EmailVerificationController::class, 'send'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// 2FA
Route::middleware('auth')->group(function () {
    Route::get('2fa', [\App\Http\Controllers\Auth\TwoFactorController::class, 'show'])->name('2fa.show');
    Route::post('2fa/enable', [\App\Http\Controllers\Auth\TwoFactorController::class, 'enable'])->name('2fa.enable');
    Route::post('2fa/disable', [\App\Http\Controllers\Auth\TwoFactorController::class, 'disable'])->name('2fa.disable');
    Route::post('2fa/confirm', [\App\Http\Controllers\Auth\TwoFactorController::class, 'confirm'])->name('2fa.confirm');
});

// Social login
Route::get('auth/{provider}', [\App\Http\Controllers\Auth\SocialAuthController::class, 'redirect'])
    ->name('social.redirect');
Route::get('auth/{provider}/callback', [\App\Http\Controllers\Auth\SocialAuthController::class, 'callback'])
    ->name('social.callback');

// Dashboard
Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Admin: users, roles, permissions
Route::middleware(['auth', 'verified', 'role:Admin|SuperAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('users/datatable', [\App\Http\Controllers\Admin\UserController::class, 'datatable'])->name('users.datatable');
    Route::post('users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::put('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::post('users/{user}/impersonate', [\App\Http\Controllers\Admin\UserController::class, 'impersonate'])->name('users.impersonate');
    Route::post('stop-impersonate', [\App\Http\Controllers\Admin\UserController::class, 'stopImpersonate'])->name('users.stopImpersonate');

    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);

    Route::get('activity-log', [\App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity.index');
    Route::get('activity-log/datatable', [\App\Http\Controllers\ActivityLogController::class, 'datatable'])->name('activity.datatable');

    Route::get('settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');

    Route::post('backups/run', [\App\Http\Controllers\BackupController::class, 'run'])->name('backups.run');
    Route::get('backups', [\App\Http\Controllers\BackupController::class, 'index'])->name('backups.index');
    Route::get('backups/download/{file}', [\App\Http\Controllers\BackupController::class, 'download'])->name('backups.download');
});

// Profile
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/avatar', [\App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('profile.avatar');
});

