<?php

use App\Http\Controllers\Api\V1\Business\ProductController;
use App\Http\Controllers\Api\V1\Business\ProductCategory\ProductCategoryController;
use App\Http\Controllers\Api\V1\Business\Unit\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('products', [ProductController::class, 'index']);
Route::post('products', [ProductController::class, 'store']);
Route::get('products/{product}', [ProductController::class, 'show']);
Route::put('products/{product}', [ProductController::class, 'update']);
Route::delete('products/{product}', [ProductController::class, 'destroy']);

Route::get('product-categories', [ProductCategoryController::class, 'index']);
Route::post('product-categories', [ProductCategoryController::class, 'store']);
Route::get('product-categories/{category}', [ProductCategoryController::class, 'show']);
Route::put('product-categories/{category}', [ProductCategoryController::class, 'update']);
Route::delete('product-categories/{category}', [ProductCategoryController::class, 'destroy']);

Route::get('units', [UnitController::class, 'index']);
Route::post('units', [UnitController::class, 'store']);
Route::get('units/{unit}', [UnitController::class, 'show']);
Route::put('units/{unit}', [UnitController::class, 'update']);
Route::delete('units/{unit}', [UnitController::class, 'destroy']);
