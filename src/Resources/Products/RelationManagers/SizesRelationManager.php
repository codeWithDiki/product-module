<?php

namespace CodeWithDiki\ProductModule\Resources\Products\RelationManagers;

use CodeWithDiki\ProductModule\Resources\ProductSizes\ProductSizeResource;
use Filament\Actions\CreateAction;
use Filament\Actions\AttachAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class SizesRelationManager extends RelationManager
{
    protected static string $relationship = 'sizes';

    protected static ?string $relatedResource = ProductSizeResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
                AttachAction::make(),
            ]);
    }
}
