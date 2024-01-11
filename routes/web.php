<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentAccountController;
use App\Http\Controllers\ScanqrController;
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

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');
Route::get('/book', function () {
    return view('book');
})->name('book');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/available-rooms', function () {
//     return view('available-rooms');
// })->name('available-rooms');

// Route::get('/rooms', function () {
//     return view('rooms');
// })->middleware(['auth', 'verified'])->name('rooms');

Route::get('/book', [RoomController::class, 'get_services'])->name('book');
Route::get('/rooms', [RoomController::class, 'index'])->middleware(['auth', 'verified'])->name('rooms');

Route::get('/reservation', [ReservationController::class, 'index'])->middleware(['auth', 'verified'])->name('reservation');
Route::get('/view-reservation/{reservation_id}', [ReservationController::class, 'view_details'])->middleware(['auth', 'verified'])->name('view-reservation');
Route::get('/view-reservation/add-ons/{reservation_id}', [ReservationController::class, 'view_add_ons'])->middleware(['auth', 'verified'])->name('add-ons');
Route::get('/services', [ServicesController::class, 'index'])->middleware(['auth', 'verified'])->name('services');
Route::get('/payment', [PaymentController::class, 'index'])->middleware(['auth', 'verified'])->name('payment');
Route::get('/payment-account', [PaymentAccountController::class, 'index'])->middleware(['auth', 'verified'])->name('payment-account');
Route::get('/invoice/{payment_id}', [PaymentController::class, 'invoice'])->middleware(['auth', 'verified'])->name('invoice');
Route::get('/scanqr', [ScanqrController::class, 'index'])->middleware(['auth', 'verified'])->name('scanqr');


Route::get('/users', [UsersController::class, 'index'])->name('users');
Route::post('/login-user', [UsersController::class, 'login'])->name('login-user');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
