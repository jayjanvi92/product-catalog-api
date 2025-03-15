<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'parent_category_id' => null],
            ['name' => 'Mobile Phones', 'parent_category_id' => 1],
            ['name' => 'Laptops', 'parent_category_id' => 1],
            ['name' => 'Fashion', 'parent_category_id' => null],
            ['name' => 'Men’s Clothing', 'parent_category_id' => 4],
            ['name' => 'Women’s Clothing', 'parent_category_id' => 4],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
