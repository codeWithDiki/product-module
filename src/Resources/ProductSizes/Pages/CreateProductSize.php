<?php

namespace CodeWithDiki\ProductModule\Resources\ProductSizes\Pages;

use CodeWithDiki\ProductModule\Resources\ProductSizes\ProductSizeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductSize extends CreateRecord
{
    protected static string $resource = ProductSizeResource::class;
}
