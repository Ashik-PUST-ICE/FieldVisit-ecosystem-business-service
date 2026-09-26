<?php

use App\Http\Controllers\Api\V1\Modules\Finance\AccountController;
use App\Http\Controllers\Api\V1\Modules\Finance\AccountTypeController;
use App\Http\Controllers\Api\V1\Modules\Finance\CentralAccountController;
use App\Http\Controllers\Api\V1\Modules\Finance\ConveyanceController;
use App\Http\Controllers\Api\V1\Modules\Finance\ExpenseController;
use App\Http\Controllers\Api\V1\Modules\Finance\FinanceCategoryController;
use App\Http\Controllers\Api\V1\Modules\Finance\FundTransferController;
use App\Http\Controllers\Api\V1\Modules\Finance\TransactionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['verify.jwt']], function () {

    Route::prefix('finance')->group(function () {

        Route::apiResource('central-accounts', CentralAccountController::class);
        Route::patch('central-accounts/status/{id}', [CentralAccountController::class, 'toggleStatus']);

        Route::apiResource('account-types', AccountTypeController::class);
        Route::patch('account-types/status/{id}', [AccountTypeController::class, 'toggleStatus']);

        Route::get('accounts/list', [AccountController::class, 'list']);
        Route::apiResource('accounts', AccountController::class);
        Route::patch('accounts/status/{id}', [AccountController::class, 'status']);

        Route::apiResource('finance-categories', FinanceCategoryController::class);
        Route::patch('finance-categories/status/{id}', [FinanceCategoryController::class, 'toggleStatus']);

        Route::apiResource('fund-transfers', FundTransferController::class);

        Route::get('transactions', [TransactionController::class, 'index']);
        Route::get('transactions/{id}', [TransactionController::class, 'show']);

        Route::apiResource('expenses', ExpenseController::class);
        Route::patch('expenses/status/{id}', [ExpenseController::class, 'toggleStatus']);

        Route::apiResource('conveyances', ConveyanceController::class);
    });

});
