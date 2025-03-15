<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'sku' => $this->faker->unique()->bothify('SKU###??'),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'category_id' => Category::factory()->create()->id, 
        ];
    }
}
