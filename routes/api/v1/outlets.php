<?php

use App\Http\Controllers\Api\V1\Business\OutletController;
use Illuminate\Support\Facades\Route;

Route::get('outlets', [OutletController::class, 'index']);
Route::post('outlets', [OutletController::class, 'store']);
Route::get('outlets/{outlet}', [OutletController::class, 'show']);
Route::put('outlets/{outlet}', [OutletController::class, 'update']);
Route::delete('outlets/{outlet}', [OutletController::class, 'destroy']);
