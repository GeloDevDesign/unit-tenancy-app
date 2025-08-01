<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Property\PropertyController;

Route::middleware(['role:property_manager'])
  ->name('property.')
  ->prefix('property')
  ->group(function () {

    Route::get('/', [PropertyController::class, 'index'])->name('index');
    Route::get('/create', [PropertyController::class, 'create'])->name('create');
    Route::post('/', [PropertyController::class, 'store'])->name('store');
    Route::get('/{property}', [PropertyController::class, 'edit'])->name('edit');
    Route::put('/{property}', [PropertyController::class, 'update'])->name('update');
    Route::delete('/{property}', [PropertyController::class, 'destroy'])->name('destroy');
  });
