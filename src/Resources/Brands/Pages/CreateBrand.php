<?php

namespace CodeWithDiki\ProductModule\Resources\Brands\Pages;

use CodeWithDiki\ProductModule\Resources\Brands\BrandResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBrand extends CreateRecord
{
    protected static string $resource = BrandResource::class;
}
