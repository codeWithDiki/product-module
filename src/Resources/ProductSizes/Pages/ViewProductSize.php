<?php

namespace CodeWithDiki\ProductModule\Resources\ProductSizes\Pages;

use CodeWithDiki\ProductModule\Resources\ProductSizes\ProductSizeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProductSize extends ViewRecord
{
    protected static string $resource = ProductSizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
