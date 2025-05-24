<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductLogService;

class ProductLogController extends Controller
{
    protected $logService;

    public function __construct(ProductLogService $logService)
    {
        $this->logService = $logService;
    }

    // Show all logs with optional search
    public function index(Request $request)
    {
        $search = $request->input('search'); 
        $logs = $this->logService->getAllLogs($search);
        return view('admin.products.logs.index', compact('logs', 'search'));
    }

    // Show logs for a specific product with optional search
    public function byProduct(Request $request, $productId)
    {
        $search = $request->input('search');
        $logs = $this->logService->getLogsByProduct($productId, $search);
        return view('admin.products.logs.index', compact('logs', 'search'));
    }
}
