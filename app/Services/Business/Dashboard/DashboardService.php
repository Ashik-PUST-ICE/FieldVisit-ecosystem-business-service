<?php

namespace App\Services\Business\Dashboard;

use App\Models\Business\Visit;
use App\Models\Business\Order;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function index(): array
    {
        return [
            'total_outlets' => DB::table('outlets')->count(),
            'total_visits_today' => Visit::whereDate('started_at', now()->toDateString())->count(),
            'total_orders_today' => Order::whereDate('ordered_at', now()->toDateString())->count(),
            'total_revenue_today' => Order::whereDate('ordered_at', now()->toDateString())->sum('total_amount'),
        ];
    }
}
