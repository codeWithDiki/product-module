<?php

namespace CodeWithDiki\ProductModule\Data;

use CodeWithDiki\ProductModule\Enums\ProductType;

class ProductData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public string $name,
        public string $slug,
        public ProductType $type,
        public float $price,
        public ?float $discount_price = null,
        public ?string $description = null,
        public ?int $stock = 0,
        public ?int $brand_id = null,
        public ?string $sku = null,
        public bool $is_active = false,
        public ?array $tags = null,
        public ?array $meta_data
    ) {
    }
}