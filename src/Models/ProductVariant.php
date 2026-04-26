<?php

namespace CodeWithDiki\ProductModule\Models;

use CodeWithDiki\ProductModule\Database\Factories\ProductVariantFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[UseFactory(ProductVariantFactory::class)]
class ProductVariant extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config("product-module.product_class"));
    }

}