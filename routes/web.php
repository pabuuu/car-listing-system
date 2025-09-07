<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

// Home → show all cars
Route::get('/', [CarController::class, 'index'])->name('home');

// Cars for guests
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');

// Auth routes
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes only for logged-in users
Route::middleware('auth')->group(function () {

    // Account page
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::post('/account', [AccountController::class, 'update'])->name('account.update');

    // My Listings page
    Route::get('/listings', [CarController::class, 'myListings'])->name('cars.myListings');

    // Car CRUD
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
});
