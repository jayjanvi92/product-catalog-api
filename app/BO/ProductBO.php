<?php
namespace App\BO;

class ProductBO
{
    public string $name;
    public string $description;
    public string $sku;
    public float $price;
    public int $category_id;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->sku = $data['sku'];
        $this->price = $data['price'];
        $this->category_id = $data['category_id'];
    }
}
