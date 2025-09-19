<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\ImpersonationController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Client\CampaignController as ClientCampaignController;
use App\Http\Middleware\EnsureEmailIsVerifiedIfEnabled;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/email/verify', 'auth.verify-email')->name('verification.notice');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/2fa', [TwoFactorController::class, 'show'])->name('2fa.show');
Route::post('/2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');

// Social login placeholders
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');

Route::middleware([EnsureEmailIsVerifiedIfEnabled::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'avatar'])->name('profile.avatar');
});

Route::prefix('admin')->name('admin.')->middleware([EnsureEmailIsVerifiedIfEnabled::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/registrations', [DashboardController::class, 'registrations'])->name('dashboard.registrations');

    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::post('/users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

    Route::get('/users/{user}/impersonate', [ImpersonationController::class, 'start'])->name('users.impersonate');
    Route::get('/impersonate/stop', [ImpersonationController::class, 'stop'])->name('impersonate.stop');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'save'])->name('settings.save');

    Route::get('/backups', [BackupController::class, 'index'])->name('backups.index');
    Route::post('/backups', [BackupController::class, 'run'])->name('backups.run');

    Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index');
});

// Client campaign wizard
Route::prefix('client/campaign')->name('client.campaign.')->group(function () {
    Route::get('/step-1', [ClientCampaignController::class, 'step1Show'])->name('step1.show');
    Route::post('/step-1', [ClientCampaignController::class, 'step1Store'])->name('step1.store');

    Route::get('/step-2', [ClientCampaignController::class, 'step2Show'])->name('step2.show');
    Route::post('/step-2', [ClientCampaignController::class, 'step2Store'])->name('step2.store');

    Route::get('/step-3', [ClientCampaignController::class, 'step3Show'])->name('step3.show');
    Route::post('/step-3', [ClientCampaignController::class, 'step3Store'])->name('step3.store');

    Route::get('/step-4', [ClientCampaignController::class, 'step4Show'])->name('step4.show');
    Route::post('/step-4', [ClientCampaignController::class, 'step4Store'])->name('step4.store');
});