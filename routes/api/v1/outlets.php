<?php

use App\Http\Controllers\Api\V1\Business\OutletController;
use App\Http\Controllers\Api\V1\Business\OutletAssignment\OutletAssignmentController;
use Illuminate\Support\Facades\Route;

Route::get('outlets', [OutletController::class, 'index']);
Route::post('outlets', [OutletController::class, 'store']);
Route::get('outlets/{outlet}', [OutletController::class, 'show']);
Route::put('outlets/{outlet}', [OutletController::class, 'update']);
Route::delete('outlets/{outlet}', [OutletController::class, 'destroy']);

Route::get('outlet-assignments', [OutletAssignmentController::class, 'index']);
Route::post('outlet-assignments', [OutletAssignmentController::class, 'store']);
Route::get('outlet-assignments/{assignment}', [OutletAssignmentController::class, 'show']);
Route::put('outlet-assignments/{assignment}', [OutletAssignmentController::class, 'update']);
Route::delete('outlet-assignments/{assignment}', [OutletAssignmentController::class, 'destroy']);
