<?php

use App\Http\Controllers\CommissionController;
use App\Http\Controllers\LiftingController;
use App\Http\Controllers\ProductController;
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

    // Filter Commission
    Route::post('/commission/filter', [ CommissionController::class, 'filter'])->name('commission.filter');
    Route::get('/commission/export', [CommissionController::class, 'export'])->name('commission.export');


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
        'commission' => CommissionController::class,

        // Lifting
        'lifting' => LiftingController::class,

        // Product
        'product' => ProductController::class,
    ]);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
