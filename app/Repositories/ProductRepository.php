<?php
namespace App\Repositories;

use App\BO\ProductBO;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(int $perPage = 10, ?string $search = null, ?int $categoryId = null, int $page = 1): LengthAwarePaginator
    {
        $cacheKey = "products_page_{$page}_limit_{$perPage}_category_{$categoryId}_search_" . ($search ?? 'none');;

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($perPage, $search, $categoryId, $page) {
            $query = Product::query();

            if (!empty($search)) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            }

            if (!empty($categoryId)) {
                $query->where('category_id', $categoryId); // ✅ Filter by category
            }

            return $query->paginate($perPage, ['*'], 'page', $page); // ✅ Ensure page is passed correctly
        });
    }

    // public function getAll(int $perPage = 10, ?string $search = null): LengthAwarePaginator
    // {
    //     $query = Product::query();

    //     if ($search) {
    //         $query->where('name', 'LIKE', "%{$search}%")
    //             ->orWhere('description', 'LIKE', "%{$search}%");
    //     }

    //     return $query->paginate($perPage);
    // }

    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }

    public function create(ProductBO $productBO): Product
    {
        Cache::forget('products_page_10_search_');
        return Product::create((array) $productBO);
    }

    public function update(int $id, ProductBO $productBO): bool
    {
        $product = Product::find($id);

        if (!$product) {
            return false;
        }

        Cache::forget("products_page_10_search_");
        return $product->update((array) $productBO);
    }

    public function delete(int $id): bool
    {
        Cache::forget('products_page_10_search_');
        return Product::destroy($id) > 0;
    }
}
