<?php

// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();
        return view('client.cart.index', compact('cart', 'total'));
    }

    public function add(Product $product, Request $request)
    {
        $this->cartService->add($product, $request->quantity ?? 1);
        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function remove($productId)
    {
        $this->cartService->remove($productId);
        return redirect()->back()->with('success', 'Product removed from cart.');
    }

    public function update(Request $request, $productId)
    {
        $this->cartService->updateQuantity($productId, $request->quantity);
        return redirect()->back()->with('success', 'Cart updated.');
    }
}
