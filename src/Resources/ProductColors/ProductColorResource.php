<?php

namespace CodeWithDiki\ProductModule\Resources\ProductColors;

use CodeWithDiki\ProductModule\Resources\ProductColors\Pages\CreateProductColor;
use CodeWithDiki\ProductModule\Resources\ProductColors\Pages\EditProductColor;
use CodeWithDiki\ProductModule\Resources\ProductColors\Pages\ListProductColors;
use CodeWithDiki\ProductModule\Resources\ProductColors\Pages\ViewProductColor;
use CodeWithDiki\ProductModule\Resources\ProductColors\Schemas\ProductColorForm;
use CodeWithDiki\ProductModule\Resources\ProductColors\Schemas\ProductColorInfolist;
use CodeWithDiki\ProductModule\Resources\ProductColors\Tables\ProductColorsTable;
use BackedEnum;
use CodeWithDiki\ProductModule\Models\ProductColor;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductColorResource extends Resource
{
    protected static ?string $model = ProductColor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSwatch;

    protected static string|\UnitEnum|null $navigationGroup = "Product Management";

    protected static ?string $recordTitleAttribute = 'label';

    public static function getModel(): string
    {
        return config('product-module.product_color_class', ProductColor::class);
    }

    public static function form(Schema $schema): Schema
    {
        return ProductColorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductColorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductColorsTable::configure($table);
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
            'index' => ListProductColors::route('/'),
            'create' => CreateProductColor::route('/create'),
            'view' => ViewProductColor::route('/{record}'),
            'edit' => EditProductColor::route('/{record}/edit'),
        ];
    }
}
