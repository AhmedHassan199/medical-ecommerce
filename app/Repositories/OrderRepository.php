<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public function all()
    {
        return Order::with('items.product')->get();
    }

    public function find($id)
    {
        return Order::with('items.product')->findOrFail($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $order = Order::create([
                'full_name' => $data['full_name'],
                'phone_number' => $data['phone_number'],
                'delivery_address' => $data['delivery_address'],
                'total_price' => $data['total_price'],
            ]);

            foreach ($data['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            return $order;
        });
    }

    public function getSalesData()
    {
        return DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'order_items.product_id',
                'products.name',
                DB::raw('SUM(order_items.price * order_items.quantity) as total_sales')
            )
            ->groupBy('order_items.product_id', 'products.name')
            ->orderByDesc('total_sales')
            ->get();
    }
}
