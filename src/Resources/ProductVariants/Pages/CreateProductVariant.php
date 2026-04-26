<?php

namespace CodeWithDiki\ProductModule\Resources\ProductVariants\Pages;

use CodeWithDiki\ProductModule\Resources\ProductVariants\ProductVariantResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductVariant extends CreateRecord
{
    protected static string $resource = ProductVariantResource::class;
}
