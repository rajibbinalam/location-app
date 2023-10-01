<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\LocationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/login', [LoginController::class, 'login']);


Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('loggout', [LoginController::class, 'loggout']);


    // Send Location From Register User Account
    Route::post('/send-location', [LocationController::class, 'sendLocation']);


});

// Get Location From Any ( public / Non Register)
Route::get('/get-location', [LocationController::class, 'getLocation']);


