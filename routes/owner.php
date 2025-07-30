<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\OwnerController;

Route::middleware(['auth.owner'/* , 'XSS' */])
  ->name('owner.')
  ->prefix('owner')
  ->namespace('App\Http\Controllers\Property')->group(function () {

    Route::get('/', [OwnerController::class, 'index'])->name('index');
  });
