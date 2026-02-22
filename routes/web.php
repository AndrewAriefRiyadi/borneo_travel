<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReportController;
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

    Route::get('/trip/edit/{id}', [TripController::class, 'edit'])->name('trip.edit');
    Route::get('/deposit/edit/{id}', [DepositController::class, 'edit'])->name('deposit.edit');
    Route::post('/deposit/edit/{id}', [DepositController::class, 'store_payment'])->name('deposit.payment');

    Route::middleware(['role:admin'])->group(function () {
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

        Route::put('/trip/edit/{id}', [TripController::class, 'update'])->name('trip.update');
        Route::delete('/trip/edit/{id}', [TripController::class, 'delete'])->name('trip.delete');

        Route::get('/deposit', [DepositController::class, 'index'])->name('deposit.index');
        Route::get('/deposit/create', [DepositController::class, 'create'])->name('deposit.create');
        Route::post('/deposit/create', [DepositController::class, 'store'])->name('deposit.store');
        Route::put('/deposit/edit/{id}', [DepositController::class, 'update'])->name('deposit.update');
        Route::delete('/deposit/edit/{id}', [DepositController::class, 'delete'])->name('deposit.delete');

        Route::get('/report', [ReportController::class, 'index'])->name('report.index');

        Route::get('/report/driver-income', [ReportController::class, 'driverIncome'])->name('report.driver-income');
        Route::get(
            '/report/driver-income/print',
            [ReportController::class, 'driverIncomePrint']
        )->name('report.driver-income.print');

        Route::get('/report/repair-recap', [ReportController::class, 'repairRecap'])->name('report.repair-recap');
        Route::get(
            '/report/repair/print',
            [ReportController::class, 'printRepairRecap']
        )->name('report.repair.print');

        Route::get(
            'report/third-party-fee',
            [ReportController::class, 'thirdPartyFee']
        )->name('report.third-party-fee');

        Route::get(
            'report/third-party-fee/print',
            [ReportController::class, 'printThirdPartyFee']
        )->name('report.third-party-fee.print');

        Route::get(
            'report/koperasi-payment',
            [ReportController::class, 'koperasiPayment']
        )->name('report.koperasi-payment');

        Route::get(
            'report/koperasi-payment/print',
            [ReportController::class, 'printKoperasiPayment']
        )->name('report.koperasi-payment.print');

        Route::get('/report/car-usage', [ReportController::class, 'carUsage'])
            ->name('report.car-usage');

        Route::get('/report/car-usage/print', [ReportController::class, 'printCarUsage'])
            ->name('report.car-usage.print');


    });

    Route::middleware(['role:user'])->group(function () {
        Route::get('/my-trips', [TripController::class, 'myTrips'])->name('my-trips.index');
        Route::get('/trip/create', [TripController::class, 'create'])->name('trip.create');
        Route::post('/trip/create', [TripController::class, 'store'])->name('trip.store');
    });
});

require __DIR__ . '/auth.php';
