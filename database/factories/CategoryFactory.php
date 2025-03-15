<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'parent_category_id' => null,
        ];
    }

    public function withParent()
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_category_id' => Category::factory(),
            ];
        });
    }

    // public function definition()
    // {
    //     return [
    //         'name' => $this->faker->word,
    //         'parent_category_id' => null, 
    //     ];
    // }

    // public function childCategory()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'parent_category_id' => Category::factory(), 
    //         ];
    //     });
    // }
}
