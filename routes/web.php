<?php

use App\Http\Controllers\MonthlySummaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MonthlySummaryController::class, 'index'])->name('monthly-summary.index');
Route::put('/monthly-summary/{id}', [MonthlySummaryController::class, 'update'])->name('monthly-summary.update');
Route::get('/monthly-summary/{id}/edit', [MonthlySummaryController::class, 'edit'])->name('monthly-summary.edit');