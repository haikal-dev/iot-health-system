<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ESP32Controller;
use App\Http\Controllers\DashboardController as Dashboard;

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

Route::get('/', [Dashboard::class, 'index']);

Route::get('/iot/esp32', [ESP32Controller::class, 'index']);
