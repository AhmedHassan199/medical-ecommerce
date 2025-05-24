<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductLog;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category_id']);
        $products = $this->productService->filter($filters);
        $categories = $this->productService->listCategories();

        if (auth()->check() && auth()->user()->role_id === 1) {
            return view('admin.products.index', compact('products', 'categories'));
        } else {
            return view('client.products.index', compact('products', 'categories'));
        }
    }


    public function create()
    {
        $categories = $this->productService->listCategories();
        return view('admin.products.create', compact('categories'));
    }

    public function edit($id)
    {
        $product = $this->productService->find($id);
        $categories = $this->productService->listCategories();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->file('image') ?? null;

        $this->productService->create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = $this->productService->find($id);
        return view('admin.products.show', compact('product'));
    }


    public function update(ProductRequest $request, $id)
    {
        $this->productService->update($id, $request->validated());
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

   
}
