<?php

use App\Http\Controllers\Api\V1\Business\BeatController;
use Illuminate\Support\Facades\Route;

Route::get('beats', [BeatController::class, 'index']);
Route::get('beats/today', [BeatController::class, 'today']);
Route::post('beats', [BeatController::class, 'store']);
Route::get('beats/{beat}', [BeatController::class, 'show']);
Route::put('beats/{beat}', [BeatController::class, 'update']);
Route::delete('beats/{beat}', [BeatController::class, 'destroy']);
