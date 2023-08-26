<?php

use App\Http\Controllers\ArchivedMissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\client\clientController;

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

// dashboard routes
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('/mission', MissionController::class)->names('dashboard.mission');
    Route::patch('/mission/complete/{id}', [MissionController::class, 'complete'])->name('dashboard.mission.complete');
    Route::patch('/mission/approve/{id}', [MissionController::class, 'approve'])->name('dashboard.mission.approve');
    Route::get('/mission/print/{id}', [MissionController::class, 'printMission'])->name('dashboard.mission.printMission');
    Route::get('/mission/print/reimbursement/{id}', [MissionController::class, 'printReimbursement'])->name('dashboard.mission.printReimbursement');

    Route::resource('/archive', ArchivedMissionController::class)->names('dashboard.archive');
    Route::post('/archive/restore/{id}', [ArchivedMissionController::class, 'restore'])->name('dashboard.archive.restore');


    Route::resource('/groups', GroupController::class)->names('dashboard.group');

    Route::resource('/users', UserController::class)->names('dashboard.user');
    Route::get('/print-users', [UserController::class, 'printAll'])->name('dashboard.user.print');
    Route::patch('/users/change-password/{id}', [UserController::class, 'changePassword'])->name('dashboard.user.changePassword');
});

// client routes
Route::get('/', [clientController::class, 'index'])->name('client.index');
