<?php

namespace CodeWithDiki\ProductModule\Resources\ProductImages\Pages;

use CodeWithDiki\ProductModule\Resources\ProductImages\ProductImageResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProductImage extends ViewRecord
{
    protected static string $resource = ProductImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
