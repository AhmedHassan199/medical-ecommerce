<?php


namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    protected $orderRepository;

    public function __construct(OrderService $orderService, OrderRepository $orderRepository)
    {
        $this->orderService = $orderService;
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->all();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = $this->orderRepository->find($id);
        return view('admin.orders.show', compact('order'));
    }

    public function checkout()
    {
        $cart = $this->orderService->getCart();
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }
        $total = $this->orderService->getTotal();
        return view('client.orders.checkout', compact('cart', 'total'));
    }

    public function store(OrderRequest $request)
    {
        try {
            $order = $this->orderService->createOrder($request->validated());
            return redirect()->route('orders.confirmation', $order->id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function confirmation($id)
    {
        $order = $this->orderRepository->find($id);
        return view('client.orders.confirmation', compact('order'));
    }
}
