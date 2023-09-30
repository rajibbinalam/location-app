<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;

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


// Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
//     return auth()->user();
// });
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('loggout', [LoginController::class, 'loggout']);

    Route::get('user', function(){
        try {
            return auth()->user();
        } catch (\Throwable $th) {
            return response()->json('error', $th->getMessage());
        }
    });

});


