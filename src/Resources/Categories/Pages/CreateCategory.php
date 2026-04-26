<?php

namespace CodeWithDiki\ProductModule\Resources\Categories\Pages;

use CodeWithDiki\ProductModule\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
