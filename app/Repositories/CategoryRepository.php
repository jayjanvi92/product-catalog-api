<?php
namespace App\Repositories;

use App\BO\CategoryBO;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return Category::with('children')->get();
    }

    public function findById(int $id): ?Category
    {
        return Category::find($id);
    }

    public function create(CategoryBO $categoryBO): Category
    {
        return Category::create((array) $categoryBO);
    }

    public function getNestedCategories()
    {
        return Category::with('children')->whereNull('parent_category_id')->get();
    }
}
