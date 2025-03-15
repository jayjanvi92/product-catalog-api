<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected CategoryRepository $categoryRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->categoryRepository = app(CategoryRepository::class);
    }

    public function test_it_can_fetch_nested_categories()
    {
        $parentCategory = Category::factory()->create();
        $childCategory = Category::factory()->create(['parent_category_id' => $parentCategory->id]);

        $categories = $this->categoryRepository->getNestedCategories();

        $this->assertNotEmpty($categories);
        $this->assertEquals(1, $categories->count());
        $this->assertEquals(1, $categories->first()->children->count());
    }
}

