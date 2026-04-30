<?php

namespace CodeWithDiki\ProductModule;


use Filament\Contracts\Plugin;
use Filament\Panel;

class ProductModuleFilament implements Plugin
{
    public function getId(): string
    {
        return 'product-module';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                Resources\Categories\CategoryResource::class,
                Resources\Brands\BrandResource::class,
                Resources\Products\ProductResource::class,
                Resources\ProductVariants\ProductVariantResource::class,
                Resources\ProductImages\ProductImageResource::class,
                Resources\ProductReviews\ProductReviewResource::class,
                Resources\ProductColors\ProductColorResource::class,
                Resources\ProductSizes\ProductSizeResource::class,
            ])
            ->pages([

            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}