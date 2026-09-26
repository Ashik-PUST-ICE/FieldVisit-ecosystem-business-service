<?php

use App\Http\Controllers\Api\V1\Business\CompetitorController;
use Illuminate\Support\Facades\Route;

Route::get('competitors', [CompetitorController::class, 'index']);
Route::post('competitors', [CompetitorController::class, 'store']);
Route::get('competitors/{competitor}', [CompetitorController::class, 'show']);
Route::put('competitors/{competitor}', [CompetitorController::class, 'update']);
Route::delete('competitors/{competitor}', [CompetitorController::class, 'destroy']);
