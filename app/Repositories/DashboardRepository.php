<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    public function getTotalRevenue()
    {
        return DB::table('orders')->sum('total_price');
    }

    public function getTopProducts()
    {
        return DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(order_items.price * order_items.quantity) as total_sales'))
            ->groupBy('products.name')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();
    }

    public function getRevenueChanges()
    {
        $oneMinuteAgo = now()->subMinute();

        return DB::table('orders')
            ->where('created_at', '>', $oneMinuteAgo)
            ->sum('total_price');
    }

    public function getOrderCount()
    {
        $oneMinuteAgo = now()->subMinute();

        return DB::table('orders')
            ->where('created_at', '>', $oneMinuteAgo)
            ->count();
    }
}
