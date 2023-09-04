<?php

use App\Http\Controllers\ArchivedMissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\MissionRequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// dashboard home page
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// missions
Route::resource('/mission', MissionController::class)->names('dashboard.mission');
Route::patch('/mission/complete/{id}', [MissionController::class, 'complete'])->name('dashboard.mission.complete');
Route::patch('/mission/approve/{id}', [MissionController::class, 'approve'])->name('dashboard.mission.approve');
Route::get('/mission/print/{id}', [MissionController::class, 'printMission'])->name('dashboard.mission.printMission');
Route::get('/mission/print/reimbursement/{id}', [MissionController::class, 'printReimbursement'])->name('dashboard.mission.printReimbursement');

// mission requests
Route::get('/mission-requests', [MissionRequestController::class, 'index'])->name('dashboard.mission.requests');
Route::patch('/mission-requests/reject/{mission_request}', [MissionRequestController::class, 'reject'])->name('dashboard.mission.requests.reject');

// archived missions
Route::resource('/archive', ArchivedMissionController::class)->names('dashboard.archive');
Route::post('/archive/restore/{id}', [ArchivedMissionController::class, 'restore'])->name('dashboard.archive.restore');

// groups
Route::resource('/groups', GroupController::class)->names('dashboard.group');

// users
Route::resource('/users', UserController::class)->names('dashboard.user');
Route::get('/print-users', [UserController::class, 'printAll'])->name('dashboard.user.print');
Route::patch('/users/change-password/{id}', [UserController::class, 'changePassword'])->name('dashboard.user.changePassword');
