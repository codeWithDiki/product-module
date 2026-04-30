<?php

namespace CodeWithDiki\ProductModule\Resources\ProductReviews\Pages;

use CodeWithDiki\ProductModule\Resources\ProductReviews\ProductReviewResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductReview extends CreateRecord
{
    protected static string $resource = ProductReviewResource::class;
}
