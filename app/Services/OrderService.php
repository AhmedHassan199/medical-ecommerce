<?php


namespace App\Services;

use App\Events\DashboardUpdated;
use App\Services\DashboardService;
use App\Repositories\OrderRepository;
use App\Services\CartService;

class OrderService
{
    protected $orderRepository;
    protected $cartService;
    protected $dashboardService;

    public function __construct(OrderRepository $orderRepository, CartService $cartService,  DashboardService $dashboardService)
    {
        $this->orderRepository = $orderRepository;
        $this->cartService = $cartService;
        $this->dashboardService = $dashboardService;
    }

    public function createOrder(array $validatedData)
    {
        $cart = $this->cartService->getCart();

        if (empty($cart)) {
            throw new \Exception('Cart is empty.');
        }

        $items = [];
        $total = 0;

        foreach ($cart as $item) {
            $items[] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ];
            $total += $item['quantity'] * $item['price'];
        }

        $validatedData['total_price'] = $total;
        $validatedData['items'] = $items;

        $order = $this->orderRepository->create($validatedData);

        $this->cartService->clear();

        return $order;
    }

    public function getCart()
    {
        return $this->cartService->getCart();
    }

    public function getTotal()
    {
        return $this->cartService->getTotal();
    }
}
