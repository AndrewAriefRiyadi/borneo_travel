<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TripController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/driver', [DriverController::class, 'index'])->name('driver.index');
    Route::get('/driver/create', [DriverController::class, 'create'])->name('driver.create');
    Route::post('/driver/create', [DriverController::class, 'store'])->name('driver.store');
    Route::get('/driver/edit/{id}', [DriverController::class, 'edit'])->name('driver.edit');
    Route::put('/driver/edit/{id}', [DriverController::class, 'update'])->name('driver.update');
    Route::delete('/driver/edit/{id}', [DriverController::class, 'delete'])->name('driver.delete');


    Route::get('/car', [CarController::class, 'index'])->name('car.index');
    Route::post('/car', [CarController::class, 'store'])->name('car.store');
    Route::delete('/car/{id}', [CarController::class, 'delete'])->name('car.delete');

    Route::get('/trip', [TripController::class, 'index'])->name('trip.index');
    Route::get('/trip/create', [TripController::class, 'create'])->name('trip.create');
    Route::post('/trip/create', [TripController::class, 'store'])->name('trip.store');
    Route::get('/trip/edit/{id}', [TripController::class, 'edit'])->name('trip.edit');
    Route::put('/trip/edit/{id}', [TripController::class, 'update'])->name('trip.update');
    Route::delete('/trip/edit/{id}', [TripController::class, 'delete'])->name('trip.delete');
});

require __DIR__ . '/auth.php';
