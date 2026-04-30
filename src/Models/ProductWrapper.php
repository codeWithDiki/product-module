<?php

namespace CodeWithDiki\ProductModule\Models;

use CodeWithDiki\ProductModule\Database\Factories\ProductVariantFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWrapper extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config("product-module.product_class"));
    }

    public function color() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config("product-module.product_color_class"), "color_id");
    }

    public function size() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config("product-module.product_size_class"), "size_id");
    }

    public function variant() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config("product-module.product_variant_class"), "variant_id");
    }

}