<?php

namespace CodeWithDiki\ProductModule\Resources\ProductColors\Pages;

use CodeWithDiki\ProductModule\Resources\ProductColors\ProductColorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProductColor extends ViewRecord
{
    protected static string $resource = ProductColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
