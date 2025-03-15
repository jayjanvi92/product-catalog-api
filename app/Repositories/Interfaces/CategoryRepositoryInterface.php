<?php
namespace App\Repositories\Interfaces;

use App\BO\CategoryBO;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?Category;
    public function create(CategoryBO $categoryBO): Category;
}
