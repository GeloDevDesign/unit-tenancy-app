<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Occupant\OccupantController;

Route::middleware(['role:tenant_manager'/* , 'XSS' */])
  ->name('tenant-manager.')
  ->prefix('tenant-manager')
  ->namespace('App\Http\Controllers\TenantManager')->group(function () {

    Route::get('/', [OccupantController::class, 'index'])->name('index');
  });
