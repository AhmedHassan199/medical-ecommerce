<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected const CART_KEY = 'cart';

    public function add(Product $product, int $quantity = 1)
    {
        $cart = $this->getCart();
        $productId = $product->id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image
            ];
        }

        $this->saveCart($cart);
    }

    public function remove(int $productId)
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        $this->saveCart($cart);
    }

    public function updateQuantity(int $productId, int $quantity)
    {
        $cart = $this->getCart();
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            $this->saveCart($cart);
        }
    }

    public function getCart()
    {
        return Session::get(self::CART_KEY, []);
    }

    public function clear()
    {
        Session::forget(self::CART_KEY);
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->getCart() as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    protected function saveCart(array $cart)
    {
        Session::put(self::CART_KEY, $cart);
    }
}
