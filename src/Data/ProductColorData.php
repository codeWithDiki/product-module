<?php

namespace CodeWithDiki\ProductModule\Data;

class ProductColorData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $product_id,
        public string $label,
        public string $color_hex,
        public ?int $stock = 0,
        public ?bool $is_primary = false,
        public ?bool $is_active = false,
    ) {
    }
}