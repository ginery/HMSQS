<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\PaymentController;
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
    Route::post('/login-user', [UsersController::class, 'login'])->name('login-user');
});
Route::group(['prefix' => 'room'], function () {
    Route::post('/room_add', [RoomController::class, 'create']);
    Route::post('/room_delete', [RoomController::class, 'delete']);
    Route::post('/rooms_available', [RoomController::class, 'available_rooms']);
});
Route::group(['prefix' => 'reservation'], function () {
    Route::post('/add_reservation', [ReservationController::class, 'create']);
    Route::post('/add_guest_reservation', [ReservationController::class, 'create_guest']);
    Route::post('/check', [ReservationController::class, 'reserve']);
    Route::post('/approve', [ReservationController::class, 'approve']);
    Route::post('/decline', [ReservationController::class, 'decline']);
});
Route::group(['prefix' => 'services'], function () {
    Route::post('/add_services', [ServicesController::class, 'create']);
});
Route::group(['prefix' => 'payment'], function () {
    Route::post('/add_payment', [PaymentController::class, 'create']);
});

// for javascript

Route::get('/get-service-price/{id}', function ($id) {
    $price = getServicePrice($id); // Call the Laravel helper function
    return response()->json(['price' => $price]);
});

Route::get('/get-room-price/{id}', function ($id) {
    $price = getRoomPrice($id); // Call the Laravel helper function
    return response()->json(['price' => $price]);
});



