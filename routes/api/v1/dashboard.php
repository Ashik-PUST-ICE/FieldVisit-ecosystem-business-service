<?php

use App\Http\Controllers\Api\V1\Business\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [DashboardController::class, 'index']);
