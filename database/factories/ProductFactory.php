<?php

namespace CodeWithDiki\ProductModule\Database\Factories;

use CodeWithDiki\ProductModule\Enums\ProductType;
use CodeWithDiki\ProductModule\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'stock' => $this->faker->numberBetween(1, 100),
            'type' => $this->faker->randomElement(collect(ProductType::cases())->map(fn ($case) => $case->value)->toArray()),
            'discount_price' => $this->faker->randomFloat(2, 0, 50),
            'sku' => $this->faker->unique()->bothify('SKU-####-????'),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
