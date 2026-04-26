<?php

namespace CodeWithDiki\ProductModule\Resources\Products\RelationManagers;

use CodeWithDiki\ProductModule\Resources\ProductImages\ProductImageResource;
use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $relatedResource = ProductImageResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
                AttachAction::make(),
            ]);
    }
}
