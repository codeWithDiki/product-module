<?php

namespace CodeWithDiki\ProductModule\Resources\Products\RelationManagers;

use CodeWithDiki\ProductModule\Resources\ProductColors\ProductColorResource;
use Filament\Actions\CreateAction;
use Filament\Actions\AttachAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ColorsRelationManager extends RelationManager
{
    protected static string $relationship = 'colors';

    protected static ?string $relatedResource = ProductColorResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
                AttachAction::make(),
            ]);
    }
}
