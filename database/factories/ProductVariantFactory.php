<?php

namespace CodeWithDiki\ProductModule\Database\Factories;

use CodeWithDiki\ProductModule\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'stock' => $this->faker->numberBetween(1, 100),
            'discount_price' => $this->faker->randomFloat(2, 0, 50),
            'sku' => $this->faker->unique()->bothify('SKU-####-????')
        ];
    }
}
