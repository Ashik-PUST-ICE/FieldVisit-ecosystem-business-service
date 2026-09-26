<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Modules\Inventory\UnitController;
use App\Http\Controllers\Api\V1\Modules\Inventory\BrandController;
use App\Http\Controllers\Api\V1\Modules\Inventory\TjBoxController;
use App\Http\Controllers\Api\V1\Modules\Inventory\VendorController;
use App\Http\Controllers\Api\V1\Modules\Inventory\ProductController;
use App\Http\Controllers\Api\V1\Modules\Inventory\PurchaseController;
use App\Http\Controllers\Api\V1\Modules\Inventory\StockOutController;
use App\Http\Controllers\Api\V1\Modules\Inventory\WorkDoneController;
use App\Http\Controllers\Api\V1\Modules\Inventory\PatchCardController;
use App\Http\Controllers\Api\V1\Modules\Inventory\OnuDetailsController;
use App\Http\Controllers\Api\V1\Modules\Inventory\RequisitionController;
use App\Http\Controllers\Api\V1\Modules\Inventory\StockReportController;
use App\Http\Controllers\Api\V1\Modules\Inventory\StockReturnController;
use App\Http\Controllers\Api\V1\Modules\Inventory\CableDetailsController;
use App\Http\Controllers\Api\V1\Modules\Inventory\PurchaseItemController;
use App\Http\Controllers\Api\V1\Modules\Inventory\VendorReturnController;
use App\Http\Controllers\Api\V1\Modules\Inventory\StockCategoryController;
use App\Http\Controllers\Api\V1\Modules\Inventory\StockTransferController;
use App\Http\Controllers\Api\V1\Modules\Inventory\Invoice\InvoiceController;
use App\Http\Controllers\Api\V1\Modules\Inventory\CollectedProductController;
use App\Http\Controllers\Api\V1\Modules\Inventory\BandwidthPurchaseController;
use App\Http\Controllers\Api\V1\Modules\Inventory\ClientDeviceDetailsController;
use App\Http\Controllers\Api\V1\Modules\Inventory\Invoice\InvoicePaymentController;

Route::group(['prefix' => 'admin', 'middleware' => ['verify.jwt']], function () {
    Route::prefix('inventory')->group(function () {
        Route::controller(UnitController::class)->group(function () {
            Route::get('units/list', 'list');
            Route::apiResource('units', UnitController::class);
            Route::patch('units/status/{id}', 'status');
        });
        Route::controller(StockCategoryController::class)->group(function () {

            Route::get('stock-categories/list', 'list');
            Route::apiResource('stock-categories', StockCategoryController::class);
            Route::patch('stock-categories/status/{id}', 'status');
        });
        Route::controller(BrandController::class)->group(function () {
            Route::get('brands/list', 'list');
            Route::apiResource('brands', BrandController::class);
            Route::patch('brands/status/{id}', 'status');
        });

        Route::controller(ProductController::class)->group(function () {
            Route::get('products/list', 'list');
            Route::apiResource('products', ProductController::class);
            Route::patch('products/status/{id}', 'status');
            Route::get('products/available/{productId}', 'getAvailableList');
        });
        Route::controller(VendorController::class)->group(function () {
            Route::get('vendors/list', 'list');
            Route::apiResource('vendors', VendorController::class);
            Route::patch('vendors/status/{id}', 'status');
        });

        Route::controller(RequisitionController::class)->group(function () {
            Route::apiResource('requisitions', RequisitionController::class);
            Route::patch('requisitions/{id}/approve', 'approve');
        });
        Route::apiResource('purchases', PurchaseController::class);
        Route::get('histories/{networkId}', [StockOutController::class, 'stockHistory']);
        Route::apiResource('stock-outs', StockOutController::class);
        Route::controller(StockTransferController::class)->group(function () {
            Route::get('stock-transfers/available-serials/{productId}', 'getAvailableSerials');
            Route::apiResource('stock-transfers', StockTransferController::class);
        });

        Route::apiResource('bandwidth-purchases', BandwidthPurchaseController::class);
        Route::controller(PurchaseItemController::class)->group(function () {
            Route::get('purchase-items/list', 'list');
            Route::apiResource('purchase-items', PurchaseItemController::class);
            Route::patch('purchase-items/status/{id}', 'status');
        });
        Route::controller(StockReturnController::class)->group(function () {
            Route::get('stock-returns/assigned-products', 'getAssignedProductsForReturn');
            Route::get('stock-returns/available-products', 'getAvailableProducts');
            Route::apiResource('stock-returns', StockReturnController::class);
        });
        Route::apiResource('vendor-returns', VendorReturnController::class);
        Route::apiResource('collected-products', CollectedProductController::class);
        Route::get('stock-reports', [StockReportController::class, 'index']);

        Route::controller(ClientDeviceDetailsController::class)->group(function () {
            Route::get('client-device-details', 'index');
            Route::get('client-device-details/{id}', 'show');
            Route::put('client-device-details/{id}', 'update');
        });

        Route::controller(OnuDetailsController::class)->group(function () {
            Route::get('onu-details', 'index');
            Route::post('onu-details', 'store');
            Route::get('onu-details/{id}', 'show');
            Route::get('get-available-onu-list', 'getAvailableOnuList');
        });
        Route::controller(TjBoxController::class)->group(function () {
            Route::get('tj-boxes', 'index');
            Route::post('tj-boxes', 'store');
            Route::get('get-tj-box-list', 'getAvailableList');
        });

        Route::controller(PatchCardController::class)->group(function () {
            Route::get('patch-cards', 'index');
            Route::post('patch-cards', 'store');
            Route::get('get-patch-cards-list', 'getAvailableList');
        });

        Route::controller(CableDetailsController::class)->group(function () {
            Route::get('cable-details/fiber-products', 'getFiberProducts');
            Route::get('cable-details/product/{productId}', 'getProductDetails');
            Route::post('cable-details', 'store');
        });

        Route::controller(WorkDoneController::class)->group(function () {
            Route::get('work-dones', 'index');
            Route::post('work-dones', 'store');
        });


        Route::controller(InvoiceController::class)->group(function () {
            Route::get('invoices/infos/{id}', 'invoiceDetails');
            Route::get('invoices/recurring', 'getRecurringInvoices');
            Route::get('invoices/list', 'list');
            Route::apiResource('invoices', InvoiceController::class);
            Route::patch('invoices/status/{id}', 'status');
        });

        Route::controller(InvoicePaymentController::class)->group(function () {
            Route::apiResource('invoice-payments', InvoicePaymentController::class);
        });


    });
});
