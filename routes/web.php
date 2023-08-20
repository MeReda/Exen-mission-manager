<?php

use App\Http\Controllers\ArchivedMissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\PrintAllUsersController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// dashboard controller
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::resource('/mission', MissionController::class)->names('dashboard.mission');
Route::patch('/mission/complete/{id}', [MissionController::class, 'complete'])->name('dashboard.mission.complete');
Route::patch('/mission/approve/{id}', [MissionController::class, 'approve'])->name('dashboard.mission.approve');

Route::resource('/archive', ArchivedMissionController::class)->names('dashboard.archive');
Route::post('/archive/restore/{id}', [ArchivedMissionController::class, 'restore'])->name('dashboard.archive.restore');


Route::resource('/groups', GroupController::class)->names('dashboard.group');

Route::resource('/users', UserController::class)->names('dashboard.user');
Route::get('/print-users', [UserController::class, 'printAll'])->name('dashboard.user.print');
