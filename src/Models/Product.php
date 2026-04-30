<?php

namespace CodeWithDiki\ProductModule\Models;

use CodeWithDiki\ProductModule\Database\Factories\ProductFactory;
use CodeWithDiki\ProductModule\Enums\ProductType;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

#[UseFactory(ProductFactory::class)]
class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = [
        "primary_image_url"
    ];
    protected $casts = [
        "type" => ProductType::class,
        "meta_data" => "json",
        "tags" => "json"
    ];

    public function brand() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config("product-module.brand_class"));
    }

    public function categories() : \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(config("product-module.category_class"));
    }

    public function variants() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(config("product-module.product_variant_class"));
    }

    public function images() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(config("product-module.product_image_class"));
    }

    public function reviews() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(config("product-module.product_review_class"));
    }

    public function wrappers() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(config("product-module.product_wrapper_class"));
    }

    public function colors() : HasMany
    {
        return $this->hasMany(config("product-module.product_color_class"));
    }

    public function sizes() : HasMany
    {
        return $this->hasMany(config("product-module.product_size_class"));
    }

    public function getPrimaryImageUrlAttribute() : ?string
    {
        if(!$this->images()->where("is_primary", true)->exists()) {
            return null;
        }

        return Storage::url($this->images()->where("is_primary", true)->first()->image_url);
    }

    

}