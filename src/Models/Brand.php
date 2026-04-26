<?php

namespace CodeWithDiki\ProductModule\Models;

use CodeWithDiki\ProductModule\Database\Factories\BrandFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[UseFactory(BrandFactory::class)]
class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(config("product-module.product_class"));
    }

}