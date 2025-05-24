<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;

class ProductService
{
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function listAll()
    {
        return $this->productRepository->all();
    }

    public function listCategories()
    {
        return $this->categoryRepository->all();
    }

    public function create(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('products', 'public');
        }

        return $this->productRepository->create($data);
    }

    public function find($id)
    {
        return $this->productRepository->find($id);
    }

    public function update($id, array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store('products', 'public');
        }
        return $this->productRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    public function filter(array $filters)
    {
        return $this->productRepository->filter($filters);
    }
}
