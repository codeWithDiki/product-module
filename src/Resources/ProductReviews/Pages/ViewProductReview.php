<?php

namespace CodeWithDiki\ProductModule\Resources\ProductReviews\Pages;

use CodeWithDiki\ProductModule\Resources\ProductReviews\ProductReviewResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProductReview extends ViewRecord
{
    protected static string $resource = ProductReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
