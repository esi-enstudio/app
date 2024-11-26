<?php

use App\Http\Controllers\Api\RetailerController;
use App\Http\Controllers\Api\RsoController;
use App\Http\Controllers\Api\SupervisorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('supervisors/{id?}', SupervisorController::class)->name('api.supervisors');
Route::get('rsos/{id?}', RsoController::class)->name('api.rsos');
Route::get('retailers/{id?}', RetailerController::class)->name('api.retailers');
