<?php

namespace CodeWithDiki\ProductModule\Models;

use CodeWithDiki\ProductModule\Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[UseFactory(CategoryFactory::class)]
class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products() : \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(config("product-module.product_class"));
    }

}