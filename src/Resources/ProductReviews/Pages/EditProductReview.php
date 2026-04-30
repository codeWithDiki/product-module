<?php

namespace CodeWithDiki\ProductModule\Resources\ProductReviews\Pages;

use CodeWithDiki\ProductModule\Resources\ProductReviews\ProductReviewResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProductReview extends EditRecord
{
    protected static string $resource = ProductReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
