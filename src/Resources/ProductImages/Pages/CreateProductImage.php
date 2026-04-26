<?php

namespace CodeWithDiki\ProductModule\Resources\ProductImages\Pages;

use CodeWithDiki\ProductModule\Resources\ProductImages\ProductImageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductImage extends CreateRecord
{
    protected static string $resource = ProductImageResource::class;
}
