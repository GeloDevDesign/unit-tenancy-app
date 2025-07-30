<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Property\PropertyController;

Route::middleware(['auth.property'/* , 'XSS' */])
  ->name('property.')
  ->prefix('property')
  ->namespace('App\Http\Controllers\Property')->group(function () {

    Route::get('/', [PropertyController::class, 'index'])->name('index');
});
