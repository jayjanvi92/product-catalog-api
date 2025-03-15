<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts($perPage)
    {
        return $this->productRepository->getAll($perPage);
    }
}
