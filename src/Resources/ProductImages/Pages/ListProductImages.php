<?php

namespace CodeWithDiki\ProductModule\Resources\ProductImages\Pages;

use CodeWithDiki\ProductModule\Resources\ProductImages\ProductImageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductImages extends ListRecords
{
    protected static string $resource = ProductImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
