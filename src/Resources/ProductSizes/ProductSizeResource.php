<?php

namespace CodeWithDiki\ProductModule\Resources\ProductSizes;

use CodeWithDiki\ProductModule\Resources\ProductSizes\Pages\CreateProductSize;
use CodeWithDiki\ProductModule\Resources\ProductSizes\Pages\EditProductSize;
use CodeWithDiki\ProductModule\Resources\ProductSizes\Pages\ListProductSizes;
use CodeWithDiki\ProductModule\Resources\ProductSizes\Pages\ViewProductSize;
use CodeWithDiki\ProductModule\Resources\ProductSizes\Schemas\ProductSizeForm;
use CodeWithDiki\ProductModule\Resources\ProductSizes\Schemas\ProductSizeInfolist;
use CodeWithDiki\ProductModule\Resources\ProductSizes\Tables\ProductSizesTable;
use BackedEnum;
use CodeWithDiki\ProductModule\Models\ProductSize;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductSizeResource extends Resource
{
    protected static ?string $model = ProductSize::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChevronUpDown;

    protected static string|\UnitEnum|null $navigationGroup = "Product Management";

    protected static ?string $recordTitleAttribute = 'label';

    public static function getModel(): string
    {
        return config('product-module.product_size_class', ProductSize::class);
    }

    public static function form(Schema $schema): Schema
    {
        return ProductSizeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductSizeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductSizesTable::configure($table);
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
            'index' => ListProductSizes::route('/'),
            'create' => CreateProductSize::route('/create'),
            'view' => ViewProductSize::route('/{record}'),
            'edit' => EditProductSize::route('/{record}/edit'),
        ];
    }
}
