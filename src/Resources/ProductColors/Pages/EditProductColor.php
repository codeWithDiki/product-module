<?php

namespace CodeWithDiki\ProductModule\Resources\ProductColors\Pages;

use CodeWithDiki\ProductModule\Resources\ProductColors\ProductColorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProductColor extends EditRecord
{
    protected static string $resource = ProductColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
