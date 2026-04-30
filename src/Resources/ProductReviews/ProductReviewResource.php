<?php

namespace CodeWithDiki\ProductModule\Resources\ProductReviews;

use CodeWithDiki\ProductModule\Resources\ProductReviews\Pages\CreateProductReview;
use CodeWithDiki\ProductModule\Resources\ProductReviews\Pages\EditProductReview;
use CodeWithDiki\ProductModule\Resources\ProductReviews\Pages\ListProductReviews;
use CodeWithDiki\ProductModule\Resources\ProductReviews\Pages\ViewProductReview;
use CodeWithDiki\ProductModule\Resources\ProductReviews\Schemas\ProductReviewForm;
use CodeWithDiki\ProductModule\Resources\ProductReviews\Schemas\ProductReviewInfolist;
use CodeWithDiki\ProductModule\Resources\ProductReviews\Tables\ProductReviewsTable;
use BackedEnum;
use CodeWithDiki\ProductModule\Models\ProductReview;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductReviewResource extends Resource
{
    protected static ?string $model = ProductReview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleOvalLeftEllipsis;

    protected static string|\UnitEnum|null $navigationGroup = "Product Management";

    protected static ?string $recordTitleAttribute = 'from';

    public static function form(Schema $schema): Schema
    {
        return ProductReviewForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductReviewInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductReviewsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductReviews::route('/'),
            'create' => CreateProductReview::route('/create'),
            'view' => ViewProductReview::route('/{record}'),
            'edit' => EditProductReview::route('/{record}/edit'),
        ];
    }
}
