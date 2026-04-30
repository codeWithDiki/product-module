<?php

namespace CodeWithDiki\ProductModule\Data;

class ProductReviewData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public int $product_id,
        public string $from,
        public float $rating,
        public ?string $message = null,
    ) {
    }
}