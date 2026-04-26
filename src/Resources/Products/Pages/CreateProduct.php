<?php

namespace CodeWithDiki\ProductModule\Resources\Products\Pages;

use CodeWithDiki\ProductModule\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
