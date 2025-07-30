<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantManager\TenantManagerController;

Route::middleware(['auth.tenantManager'/* , 'XSS' */])
  ->name('tenant-manager.')
  ->prefix('tenant-manager')
  ->namespace('App\Http\Controllers\TenantManager')->group(function () {

    Route::get('/', [TenantManagerController::class, 'index'])->name('index');
  });
