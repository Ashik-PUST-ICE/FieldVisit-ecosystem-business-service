<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['service' => 'business', 'status' => 'ok']);
});

Route::group(['prefix' => 'v1'], function () {
    require __DIR__ . '/api/v1/outlets.php';
    require __DIR__ . '/api/v1/visits.php';
    require __DIR__ . '/api/v1/orders.php';
    require __DIR__ . '/api/v1/products.php';
    require __DIR__ . '/api/v1/beats.php';
    require __DIR__ . '/api/v1/competitors.php';
    require __DIR__ . '/api/v1/reports.php';
    require __DIR__ . '/api/v1/dashboard.php';
});
