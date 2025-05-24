<?php

namespace App\Services;

use App\Repositories\ProductLogRepository;

class ProductLogService
{
    protected $productLogRepo;

    public function __construct(ProductLogRepository $productLogRepo)
    {
        $this->productLogRepo = $productLogRepo;
    }

    public function getAllLogs($search = null)
    {
        return $this->productLogRepo->getAllWithRelationsPaginated($search);
    }

    public function getLogsByProduct($productId, $search = null)
    {
        return $this->productLogRepo->getByProductId($productId, $search);
    }
}
