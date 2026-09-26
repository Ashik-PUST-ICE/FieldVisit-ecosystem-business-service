<?php

use App\Http\Controllers\Api\V1\Business\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('reports/visits', [ReportController::class, 'visits']);
Route::get('reports/orders', [ReportController::class, 'orders']);
Route::get('reports/officer-performance', [ReportController::class, 'officerPerformance']);
