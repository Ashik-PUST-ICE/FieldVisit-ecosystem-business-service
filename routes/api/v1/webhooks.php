<?php

use App\Http\Controllers\Api\V1\Webhooks\TransactionWebhookController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['verify.jwt']], function () {

    Route::prefix('webhook')->group(function () {
        Route::post('created-transaction', [TransactionWebhookController::class, 'createdTransaction']);
    });
});
