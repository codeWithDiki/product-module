<?php

namespace CodeWithDiki\ProductModule\Resources\ProductSizes\Pages;

use CodeWithDiki\ProductModule\Resources\ProductSizes\ProductSizeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProductSize extends EditRecord
{
    protected static string $resource = ProductSizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
