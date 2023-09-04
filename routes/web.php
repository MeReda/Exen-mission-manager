<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\client\clientController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'CheckUser'])->group(function () {
    Route::get('/', [clientController::class, 'index'])->name('client.index');

    Route::get('/mission/{id}', [clientController::class, 'show'])->name('client.show');

    Route::post('/expense', [clientController::class, 'storeExpense'])->name('client.storeExpense');

    Route::get('/settings', [clientController::class, 'settings'])->name('client.settings');
    Route::put('/settings', [clientController::class, 'updateInfo'])->name('client.updateInfo');
    Route::put('/settings/password', [clientController::class, 'updatePassword'])->name('client.updatePassword');

    Route::delete('/expense/{id}', [clientController::class, 'destroyExpense'])->name('client.destroyExpense');

    Route::get('/mission/print/reimbursement/{id}', [clientController::class, 'printReimbursement'])->name('client.printReimbursement');

    Route::post('/mission-request', [clientController::class, 'storeMissionRequest'])->name('client.storeMissionRequest');
    Route::get('/mission-request/{id}', [clientController::class, 'showMissionRequest'])->name('client.showMissionRequest');
    Route::put('/mission-request/{id}', [clientController::class, 'updateMissionRequest'])->name('client.updateMissionRequest');
    Route::delete('/mission-request/{id}', [clientController::class, 'destroyMissionRequest'])->name('client.destroyMissionRequest');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
