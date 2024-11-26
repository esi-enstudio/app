<?php

use App\Http\Controllers\Api\RetailerController;
use App\Http\Controllers\Api\RsoController;
use App\Http\Controllers\Api\SupervisorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('supervisors', SupervisorController::class);
Route::get('rsos', RsoController::class);
Route::get('retailers', RetailerController::class);
