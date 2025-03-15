<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\BO\ProductBO;
use Illuminate\Foundation\Testing\RefreshDatabase; 
use App\Models\Category;

class ProductRepositoryTest extends TestCase
{
    //use RefreshDatabase;

    protected ProductRepository $productRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');

      
        $parentCategory = Category::factory()->create([
            'name' => 'Grocery',
            'parent_category_id' => null, 
        ]);

        // Category::factory()->create([
        //     'name' => 'Kitchen',
        //     'parent_category_id' => $parentCategory->id, 
        // ]);

        
        $this->productRepository = app(ProductRepository::class);
    }

    public function test_it_can_create_a_product()
    {
        $productData = [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'sku' => 'TEST123',
            'price' => 100,
            'category_id' => 1,
        ];
    
        $productBO = new ProductBO($productData); 
        $product = $this->productRepository->create($productBO);
    
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }

    public function test_it_can_fetch_all_products()
    {
        Product::query()->delete();
        Product::factory()->count(5)->create();     

        $products = $this->productRepository->getAll(10);
        $this->assertEquals(5, $products->total());
    }

    public function test_it_can_find_a_product_by_id()
    {
        $product = Product::factory()->create();
        $foundProduct = $this->productRepository->findById($product->id);

        $this->assertEquals($product->id, $foundProduct->id);
    }
}
