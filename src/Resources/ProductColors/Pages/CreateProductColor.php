<?php

namespace CodeWithDiki\ProductModule\Resources\ProductColors\Pages;

use CodeWithDiki\ProductModule\Resources\ProductColors\ProductColorResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductColor extends CreateRecord
{
    protected static string $resource = ProductColorResource::class;
}
