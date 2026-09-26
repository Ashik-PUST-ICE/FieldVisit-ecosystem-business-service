
<?php

use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'v1'],
    function () {
        require __DIR__.'/api/v1/finance.php';
        require __DIR__.'/api/v1/inventory.php';
        require __DIR__.'/api/v1/webhooks.php';
        require __DIR__.'/api/v1/hrm.php';
    }
);
