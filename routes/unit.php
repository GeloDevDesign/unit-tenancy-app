<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Unit\UnitController;

Route::middleware(['role:property_manager,admin'])
  ->name('unit.')
  ->prefix('unit')
  ->group(function () {
    Route::get('/', [UnitController::class, 'index'])->name('index');
    Route::get('/create', [UnitController::class, 'create'])->name('create');
    Route::post('/', [UnitController::class, 'store'])->name('store');
    Route::get('/{unit}', [UnitController::class, 'edit'])->name('edit');
    Route::put('/{unit}', [UnitController::class, 'update'])->name('update');
    Route::delete('/{unit}', [UnitController::class, 'destroy'])->name('destroy');
  });
