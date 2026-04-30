<?php

namespace CodeWithDiki\ProductModule\Data;

class ProductSizeData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $product_id,
        public string $label,
        public string $value,
        public ?int $stock = 0,
        public ?bool $is_active = false,
        public ?bool $is_primary = false,
    ) {
    }
}