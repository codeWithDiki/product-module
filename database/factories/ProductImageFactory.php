<?php

namespace CodeWithDiki\ProductModule\Database\Factories;

use CodeWithDiki\ProductModule\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition()
    {
        return [
            'image_url' => $this->faker->url(),
            'is_primary' => false,
        ];
    }
}
