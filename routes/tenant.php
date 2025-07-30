<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenant\TenantController;

Route::middleware(['auth.tenant'/* , 'XSS' */])
  ->name('tenant.')
  ->prefix('tenant')
  ->namespace('App\Http\Controllers\Tenant')->group(function () {

    Route::get('/', [TenantController::class, 'index'])->name('index');
  });
