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
    Route::get('/balance/history', function () {
        return view('balance.history');
    })->name('balance.history');
    Route::get('/transaction/history', function () {
        return view('transaction.history');
    })->name('transaction.history');
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/new', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/transaction/{id}', [TransactionController::class, 'show'])->name('transaction.show');
});
Route::middleware('auth:sanctum')->get('/api/balance/history', [BalanceController::class, 'balanceHistory']);
Route::middleware('auth:sanctum')->get('/api/transaction/history', [TransactionController::class, 'transactionHistory']);


require __DIR__ . '/auth.php';
