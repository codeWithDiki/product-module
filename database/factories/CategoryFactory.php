<?php

namespace CodeWithDiki\ProductModule\Database\Factories;

use CodeWithDiki\ProductModule\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph()
        ];
    }
}
