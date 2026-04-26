<?php

namespace CodeWithDiki\ProductModule\Models;

use CodeWithDiki\ProductModule\Database\Factories\ProductImageFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[UseFactory(ProductImageFactory::class)]
class ProductImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config("product-module.product_class"));
    }
}