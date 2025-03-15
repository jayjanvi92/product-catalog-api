<?php
namespace App\BO;

class CategoryBO
{
    public string $name;
    public ?int $parent_category_id;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->parent_category_id = $data['parent_category_id'] ?? null;
    }
}
