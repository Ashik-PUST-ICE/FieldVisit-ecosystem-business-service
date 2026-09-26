<?php

use App\Http\Controllers\Api\V1\Business\OrderController;
use App\Http\Controllers\Api\V1\Business\OrderItem\OrderItemController;
use Illuminate\Support\Facades\Route;

Route::get('orders', [OrderController::class, 'index']);
Route::post('orders', [OrderController::class, 'store']);
Route::get('orders/{order}', [OrderController::class, 'show']);
Route::put('orders/{order}', [OrderController::class, 'update']);
Route::delete('orders/{order}', [OrderController::class, 'destroy']);

Route::get('orders/{order}/items', [OrderItemController::class, 'index']);
Route::post('orders/{order}/items', [OrderItemController::class, 'store']);
Route::get('orders/{order}/items/{orderItem}', [OrderItemController::class, 'show']);
Route::put('orders/{order}/items/{orderItem}', [OrderItemController::class, 'update']);
Route::delete('orders/{order}/items/{orderItem}', [OrderItemController::class, 'destroy']);
