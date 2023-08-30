<?php

use App\Http\Controllers\ArchivedMissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\UserController;
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
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
