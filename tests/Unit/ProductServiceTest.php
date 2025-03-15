<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ProductService;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ProductService $productService;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->productService = app(ProductService::class);
    }

    public function test_it_can_return_products_with_pagination()
    {
        Product::factory()->count(10)->create();
        $perPage = 10;
        $products = $this->productService->getProducts($perPage);

        $this->assertCount($perPage, $products->items());
    }
}

