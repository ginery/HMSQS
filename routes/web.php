<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReservationController;
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
})->middleware('guest');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/rooms', function () {
//     return view('rooms');
// })->middleware(['auth', 'verified'])->name('rooms');

Route::get('/rooms', [RoomController::class, 'index'])->middleware(['auth', 'verified'])->name('rooms');

Route::get('/reservation', [ReservationController::class, 'index'])->middleware(['auth', 'verified'])->name('reservation');

// Route::get('/users', function () {
//     return view('users');
// })->middleware(['auth', 'verified'])->name('users');
Route::get('/users', [UsersController::class, 'index'])->name('users');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
