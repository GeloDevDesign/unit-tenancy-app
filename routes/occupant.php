<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Occupant\OccupantController;

Route::middleware(['role:tenant,owner'/* , 'XSS' */])
  ->name('occupant.')
  ->prefix('occupant')
  ->namespace('App\Http\Controllers\Tenant')->group(function () {

    Route::get('/', [OccupantController::class, 'index'])->name('index');
    Route::get('/{unit}', [OccupantController::class, 'show'])->name('show');
    Route::post('/', [OccupantController::class, 'show'])->name('store');
  });
