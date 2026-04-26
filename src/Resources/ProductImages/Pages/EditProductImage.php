<?php

namespace CodeWithDiki\ProductModule\Resources\ProductImages\Pages;

use CodeWithDiki\ProductModule\Resources\ProductImages\ProductImageResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProductImage extends EditRecord
{
    protected static string $resource = ProductImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
