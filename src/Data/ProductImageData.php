<?php

namespace CodeWithDiki\ProductModule\Data;

class ProductImageData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $product_id,
        public ?string $image_url = null,
        public ?bool $is_primary = false,
    ) {
    }
}