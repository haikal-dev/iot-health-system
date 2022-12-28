<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ESP32Controller;
use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\APIController as API;
use App\Http\Controllers\PatientController as Patient;
use App\Http\Controllers\DeviceController;

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

Route::middleware(['isAuth'])->group(function(){
    Route::get('/', [Dashboard::class, 'index']);
    Route::get('/logout', [LoginController::class, 'logout']);

    // Patients
    Route::prefix('/patients')->group(function(){
        Route::get('/', [Patient::class, 'index']);
    });

    Route::get('/device', [DeviceController::class, 'index']);
    
    Route::prefix('/v2')->group(function(){
        Route::get('/fetchHeartbeat', [API::class, 'fetchHeartbeat']);
        Route::get('/wifi', [API::class, 'fetchWifi']);
        Route::get('/reset', [API::class, 'resetInfo']);
        Route::get('/temp', [API::class, 'fetchTemp']);
        Route::get('/charts/heartbeat', [API::class, 'fetchHeartbeatChart']);

        Route::prefix('/patient')->group(function(){
            Route::get('/', [Patient::class, 'fetch_approved_lists']);
            Route::get('/id/{id}', [Patient::class, 'fetch_patient_id']);
            Route::put('/id/{id}', [Patient::class, 'update']);
        });

        Route::prefix('/device')->group(function(){
            Route::get('/', [DeviceController::class, 'fetch_device_lists']);
            Route::get('/id/{id}', [DeviceController::class, 'fetch_device_id']);
        });
    });
});

Route::get('/register', [Patient::class, 'register']);
Route::post('/register', [Patient::class, 'create_patient']);

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/v2/token/request', [LoginController::class, 'token_request']);


Route::get('/iot/esp32', [ESP32Controller::class, 'index']);

