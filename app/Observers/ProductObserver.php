<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    public function created(Product $product)
    {
        $this->logAction($product, 'created', $product->getAttributes());
    }

    public function updated(Product $product)
    {
        $changes = $product->getChanges();
        $original = $product->getOriginal();

        $detailedChanges = [];
        foreach ($changes as $field => $newValue) {
            if (!in_array($field, ['updated_at', 'created_at'])) {
                $detailedChanges[$field] = [
                    'old' => $original[$field] ?? null,
                    'new' => $newValue
                ];
            }
        }

        if (!empty($detailedChanges)) {
            $this->logAction($product, 'updated', $detailedChanges);
        }
    }

    public function deleting(Product $product)
    {
        $this->logAction($product, 'deleted', $product->getOriginal());
    }

    protected function logAction(Product $product, string $action, array $changes)
    {
        ProductLog::create([
            'product_id' => $product->id,
            'action' => $action,
            'changed_by' => Auth::id() ?? 1,
            'changes' => $changes,
            'created_at' => now()
        ]);
    }
}
