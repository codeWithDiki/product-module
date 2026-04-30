<?php

namespace CodeWithDiki\ProductModule\Resources\ProductImages;

use CodeWithDiki\ProductModule\Resources\ProductImages\Pages\CreateProductImage;
use CodeWithDiki\ProductModule\Resources\ProductImages\Pages\EditProductImage;
use CodeWithDiki\ProductModule\Resources\ProductImages\Pages\ListProductImages;
use CodeWithDiki\ProductModule\Resources\ProductImages\Pages\ViewProductImage;
use CodeWithDiki\ProductModule\Resources\ProductImages\Schemas\ProductImageForm;
use CodeWithDiki\ProductModule\Resources\ProductImages\Schemas\ProductImageInfolist;
use CodeWithDiki\ProductModule\Resources\ProductImages\Tables\ProductImagesTable;
use BackedEnum;
use CodeWithDiki\ProductModule\Models\ProductImage;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductImageResource extends Resource
{
    protected static ?string $model = ProductImage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCamera;

    protected static null|\UnitEnum|string $navigationGroup = 'Product Management';

    protected static ?string $recordTitleAttribute = 'image_url';

    public static function getModel(): string
    {
        return config('product-module.product_image_class', ProductImage::class);
    }

    public static function form(Schema $schema): Schema
    {
        return ProductImageForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductImageInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductImagesTable::configure($table);
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
            'index' => ListProductImages::route('/'),
            'create' => CreateProductImage::route('/create'),
            'view' => ViewProductImage::route('/{record}'),
            'edit' => EditProductImage::route('/{record}/edit'),
        ];
    }
}
