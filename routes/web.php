<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;

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

Route::get('/', function () {
    return view('welcome');
});

// Campaign routes
Route::prefix('campaign')->name('campaign.')->group(function () {
    Route::get('/create', [CampaignController::class, 'create'])->name('create');
    Route::get('/step/{step}', [CampaignController::class, 'step'])->name('step');
    Route::post('/step/{step}', [CampaignController::class, 'storeStep'])->name('store.step');
    Route::get('/back/{step}', [CampaignController::class, 'back'])->name('back');
});