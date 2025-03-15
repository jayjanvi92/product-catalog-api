<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $products = [
            ['name' => 'iPhone 14', 'description' => 'Latest Apple iPhone', 'sku' => 'IPH14', 'price' => 999.99, 'category_id' => 2],
            ['name' => 'Samsung Galaxy S23', 'description' => 'Newest Samsung smartphone', 'sku' => 'SGS23', 'price' => 899.99, 'category_id' => 2],
            ['name' => 'MacBook Pro', 'description' => 'Apple MacBook Pro 16-inch', 'sku' => 'MBP16', 'price' => 2499.99, 'category_id' => 3],
            ['name' => 'Men’s T-Shirt', 'description' => 'Cotton round-neck t-shirt', 'sku' => 'MTSHIRT', 'price' => 19.99, 'category_id' => 5],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
