<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServicesController;
use App\Http\Middleware\Authenticate;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'user'], function () {
    Route::post('/user_add', [UsersController::class, 'create']);
});
Route::group(['prefix' => 'room'], function () {
    Route::post('/room_add', [RoomController::class, 'create']);
    Route::post('/room_delete', [RoomController::class, 'delete']);
});
Route::group(['prefix' => 'reservation'], function () {
    Route::post('/add_reservation', [ReservationController::class, 'create']);
});
Route::group(['prefix' => 'services'], function () {
    Route::post('/add_services', [ServicesController::class, 'create']);
});

