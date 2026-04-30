<?php

namespace CodeWithDiki\ProductModule\Resources\Products\RelationManagers;

use CodeWithDiki\ProductModule\Resources\ProductReviews\ProductReviewResource;
use Filament\Actions\CreateAction;
use Filament\Actions\AttachAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';

    protected static ?string $relatedResource = ProductReviewResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
                AttachAction::make(),
            ]);
    }
}
