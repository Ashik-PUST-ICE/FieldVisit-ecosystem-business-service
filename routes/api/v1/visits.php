<?php

use App\Http\Controllers\Api\V1\Business\VisitController;
use Illuminate\Support\Facades\Route;

Route::get('visits', [VisitController::class, 'index']);
Route::post('visits', [VisitController::class, 'store']);
Route::get('visits/{visit}', [VisitController::class, 'show']);
Route::put('visits/{visit}', [VisitController::class, 'update']);
Route::delete('visits/{visit}', [VisitController::class, 'destroy']);
Route::post('visits/{visit}/photos', [VisitController::class, 'uploadPhoto']);
Route::post('outlets/verify-qr', [VisitController::class, 'verifyQr']);
Route::post('visits/start', [VisitController::class, 'startVisit']);
Route::post('visits/{visit}/verify-location', [VisitController::class, 'verifyLocation']);
Route::post('visits/{visit}/complete', [VisitController::class, 'completeVisit']);
Route::get('visits/history', [VisitController::class, 'history']);
Route::post('visits/sync', [VisitController::class, 'sync']);
