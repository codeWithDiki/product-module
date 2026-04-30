<?php

namespace CodeWithDiki\ProductModule\Resources\ProductSizes\Pages;

use CodeWithDiki\ProductModule\Resources\ProductSizes\ProductSizeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductSizes extends ListRecords
{
    protected static string $resource = ProductSizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
