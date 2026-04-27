<?php

namespace CodeWithDiki\ProductModule\Data;

use CodeWithDiki\ProductModule\Enums\ProductType;

class ProductVariantData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $product_id,
        public string $name,
        public string $slug,
        public float $price,
        public ?float $discount_price = null,
        public ?string $description = null,
        public ?int $stock = 0,
        public ?string $sku = null,
        public bool $is_active = false
    ) {
    }
}