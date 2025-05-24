<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    protected $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    // Fetch all dashboard data
    public function getDashboardData()
    {

        return [
            'total_revenue' => $this->dashboardRepository->getTotalRevenue(),
            'top_products' => $this->dashboardRepository->getTopProducts(),
            'revenue_change' => $this->dashboardRepository->getRevenueChanges(),
            'order_count' => $this->dashboardRepository->getOrderCount(),
        ];
    }
}
