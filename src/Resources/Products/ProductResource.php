<?php

namespace CodeWithDiki\ProductModule\Resources\Products;

use CodeWithDiki\ProductModule\Resources\Products\Pages\CreateProduct;
use CodeWithDiki\ProductModule\Resources\Products\Pages\EditProduct;
use CodeWithDiki\ProductModule\Resources\Products\Pages\ListProducts;
use CodeWithDiki\ProductModule\Resources\Products\Pages\ViewProduct;
use CodeWithDiki\ProductModule\Resources\Products\Schemas\ProductForm;
use CodeWithDiki\ProductModule\Resources\Products\Schemas\ProductInfolist;
use CodeWithDiki\ProductModule\Resources\Products\Tables\ProductsTable;
use BackedEnum;
use CodeWithDiki\ProductModule\Models\Product;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBolt;

    protected static null|\UnitEnum|string $navigationGroup = 'Product Management';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CategoriesRelationManager::class,
            RelationManagers\VariantsRelationManager::class,
            RelationManagers\ImagesRelationManager::class,
            RelationManagers\ReviewsRelationManager::class,
            RelationManagers\ColorsRelationManager::class,
            RelationManagers\SizesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'view' => ViewProduct::route('/{record}'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
