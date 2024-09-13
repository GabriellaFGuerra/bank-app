<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BalanceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/balance', [BalanceController::class, 'index'])->name('balance.index');
    Route::get('/balance/{date}', [BalanceController::class, 'dailyHistory'])->name('balance.daily');
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/new', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/transaction/{id}', [TransactionController::class, 'show'])->name('transaction.show');

});

require __DIR__.'/auth.php';
