<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebugController;
use Illuminate\Support\Facades\Route;

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

// Route::get("/login", [AuthController::class, 'login'])->name("login");


Route::middleware("guest")->group(function () {
    Route::get("/login", [AuthController::class, 'login'])->name("login");
    Route::post("/login", [AuthController::class, 'authenticate']);
});
Route::middleware("auth:web")->group(function () {
    Route::get("/", [DashboardController::class, 'index']);
    Route::get("/logout", [AuthController::class, 'logout']);
});



// testing
Route::prefix("/debug")->get("/ldap", [DebugController::class, 'ldap_debug']);
