<?php
namespace App\Repositories\Interfaces;

use App\BO\ProductBO;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function getAll(int $perPage): LengthAwarePaginator;
    public function findById(int $id): ?Product;
    public function create(ProductBO $productBO): Product;
    public function update(int $id, ProductBO $productBO): bool;
    public function delete(int $id): bool;
}
