<?php

use App\Http\Controllers\Api\V1\Business\BeatController;
use App\Http\Controllers\Api\V1\Business\CompetitorController;
use App\Http\Controllers\Api\V1\Business\DashboardController;
use App\Http\Controllers\Api\V1\Business\OrderController;
use App\Http\Controllers\Api\V1\Business\OrderItem\OrderItemController;
use App\Http\Controllers\Api\V1\Business\OutletAssignment\OutletAssignmentController;
use App\Http\Controllers\Api\V1\Business\OutletController;
use App\Http\Controllers\Api\V1\Business\ProductCategory\ProductCategoryController;
use App\Http\Controllers\Api\V1\Business\ProductController;
use App\Http\Controllers\Api\V1\Business\ReportController;
use App\Http\Controllers\Api\V1\Business\Unit\UnitController;
use App\Http\Controllers\Api\V1\Business\VisitController;
use Illuminate\Support\Facades\Route;

Route::prefix('outlets')->group(function () {
    Route::get('/', [OutletController::class, 'index']);
    Route::post('/', [OutletController::class, 'store']);
    Route::get('{outlet}', [OutletController::class, 'show']);
    Route::put('{outlet}', [OutletController::class, 'update']);
    Route::delete('{outlet}', [OutletController::class, 'destroy']);
    Route::post('verify-qr', [VisitController::class, 'verifyQr']);
});

Route::prefix('outlet-assignments')->group(function () {
    Route::get('/', [OutletAssignmentController::class, 'index']);
    Route::post('/', [OutletAssignmentController::class, 'store']);
    Route::get('{assignment}', [OutletAssignmentController::class, 'show']);
    Route::put('{assignment}', [OutletAssignmentController::class, 'update']);
    Route::delete('{assignment}', [OutletAssignmentController::class, 'destroy']);
});

Route::prefix('visits')->group(function () {
    Route::get('/', [VisitController::class, 'index']);
    Route::post('/', [VisitController::class, 'store']);
    Route::get('{visit}', [VisitController::class, 'show']);
    Route::put('{visit}', [VisitController::class, 'update']);
    Route::delete('{visit}', [VisitController::class, 'destroy']);
    Route::post('{visit}/photos', [VisitController::class, 'uploadPhoto']);
    Route::post('start', [VisitController::class, 'startVisit']);
    Route::post('{visit}/verify-location', [VisitController::class, 'verifyLocation']);
    Route::post('{visit}/complete', [VisitController::class, 'completeVisit']);
    Route::get('history', [VisitController::class, 'history']);
    Route::post('sync', [VisitController::class, 'sync']);
});

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('/', [OrderController::class, 'store']);
    Route::get('{order}', [OrderController::class, 'show']);
    Route::put('{order}', [OrderController::class, 'update']);
    Route::delete('{order}', [OrderController::class, 'destroy']);

    Route::prefix('{order}/items')->group(function () {
        Route::get('/', [OrderItemController::class, 'index']);
        Route::post('/', [OrderItemController::class, 'store']);
        Route::get('{orderItem}', [OrderItemController::class, 'show']);
        Route::put('{orderItem}', [OrderItemController::class, 'update']);
        Route::delete('{orderItem}', [OrderItemController::class, 'destroy']);
    });
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('{product}', [ProductController::class, 'show']);
    Route::put('{product}', [ProductController::class, 'update']);
    Route::delete('{product}', [ProductController::class, 'destroy']);
});

Route::prefix('product-categories')->group(function () {
    Route::get('/', [ProductCategoryController::class, 'index']);
    Route::post('/', [ProductCategoryController::class, 'store']);
    Route::get('{category}', [ProductCategoryController::class, 'show']);
    Route::put('{category}', [ProductCategoryController::class, 'update']);
    Route::delete('{category}', [ProductCategoryController::class, 'destroy']);
});

Route::prefix('units')->group(function () {
    Route::get('/', [UnitController::class, 'index']);
    Route::post('/', [UnitController::class, 'store']);
    Route::get('{unit}', [UnitController::class, 'show']);
    Route::put('{unit}', [UnitController::class, 'update']);
    Route::delete('{unit}', [UnitController::class, 'destroy']);
});

Route::prefix('beats')->group(function () {
    Route::get('/', [BeatController::class, 'index']);
    Route::get('today', [BeatController::class, 'today']);
    Route::post('/', [BeatController::class, 'store']);
    Route::get('{beat}', [BeatController::class, 'show']);
    Route::put('{beat}', [BeatController::class, 'update']);
    Route::delete('{beat}', [BeatController::class, 'destroy']);
});

Route::prefix('competitors')->group(function () {
    Route::get('/', [CompetitorController::class, 'index']);
    Route::post('/', [CompetitorController::class, 'store']);
    Route::get('{competitor}', [CompetitorController::class, 'show']);
    Route::put('{competitor}', [CompetitorController::class, 'update']);
    Route::delete('{competitor}', [CompetitorController::class, 'destroy']);
});

Route::prefix('reports')->group(function () {
    Route::get('visits', [ReportController::class, 'visits']);
    Route::get('orders', [ReportController::class, 'orders']);
    Route::get('officer-performance', [ReportController::class, 'officerPerformance']);
});

Route::get('dashboard', [DashboardController::class, 'index']);
