<?php

namespace CodeWithDiki\ProductModule\Database\Factories;

use CodeWithDiki\ProductModule\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph()
        ];
    }
}
