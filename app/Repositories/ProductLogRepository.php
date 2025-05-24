<?php

namespace App\Repositories;

use App\Models\ProductLog;

class ProductLogRepository
{
    public function getAllWithRelationsPaginated($search = null, $perPage = 10)
    {
        return ProductLog::with(['product', 'changedBy'])
            ->when($search, function ($query) use ($search) {
                $query->where('action', 'like', "%{$search}%")
                    ->orWhereHas('product', fn($q) => $q->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('changedBy', fn($q) => $q->where('name', 'like', "%{$search}%"));
            })
            ->latest()
            ->paginate($perPage);
    }

    public function getByProductId($productId, $search = null, $perPage = 10)
    {
        return ProductLog::where('product_id', $productId)
            ->with(['product', 'changedBy'])
            ->when($search, function ($query) use ($search) {
                $query->where('action', 'like', "%{$search}%")
                    ->orWhereHas('changedBy', fn($q) => $q->where('name', 'like', "%{$search}%"));
            })
            ->latest()
            ->paginate($perPage);
    }
}
