<?php

namespace App\Providers;

use App\Models\Requisition;
use App\Models\Transaction;
use App\Observers\RequisitionObserver;
use App\Observers\TransactionObserver;
use App\Services\Applications\Caches\UserCacheService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserCacheService::class, function ($app) {
            return new UserCacheService;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Transaction::observe(TransactionObserver::class);
        Requisition::observe(RequisitionObserver::class);
    }
}
