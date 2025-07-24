<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepositsController;
use App\Http\Controllers\BotsController;
use App\Http\Controllers\MarketsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/deposit', [DepositsController::class, 'index'])->name('deposit.create');
    Route::get('/markets', [MarketsController::class, 'index'])->name('markets.create');
    Route::get('/bots', [BotsController::class, 'index'])->name('bots.create');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth', function () {
    return view('auth.auth');
})->name('custom.auth');

require __DIR__.'/auth.php';
