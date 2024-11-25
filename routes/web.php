<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware(['auth','verified'])->group(function () {
    // Dashboard
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');

    Route::resources([
        // Users
        'user' => \App\Http\Controllers\UserController::class,
        // DD House
        'ddHouse' => \App\Http\Controllers\DdHouseController::class,
        // Rso
        'rso' => \App\Http\Controllers\RsoController::class,
        // Retailer
        'retailer' => \App\Http\Controllers\RetailerController::class,

        // Itop Replace
        'itopReplace' => \App\Http\Controllers\ItopReplaceController::class,

        // Commission
        'commission' => \App\Http\Controllers\CommissionController::class,
    ]);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
