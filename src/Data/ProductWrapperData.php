<?php

namespace CodeWithDiki\ProductModule\Data;

class ProductWrapperData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $product_id,
        public ?int $product_variant_id = null,
        public ?int $product_color_id = null,
        public ?int $product_size_id = null,
    ) {
    }
}