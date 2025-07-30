<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\OwnerController;

Route::middleware(['auth.accountant'/* , 'XSS' */])
  ->name('accountant.')
  ->prefix('accountant')
  ->namespace('App\Http\Controllers\Accountant')->group(function () {

    Route::get('/', [OwnerController::class, 'index'])->name('index');
  });
