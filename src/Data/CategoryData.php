<?php

namespace CodeWithDiki\ProductModule\Data;

class CategoryData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public string $name,
        public string $slug,
        public ?string $thumbnail_url = null,
        public ?string $description = null,
        public bool $is_active = false
    ) {
    }
}