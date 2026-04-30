<?php

namespace CodeWithDiki\ProductModule\Resources\ProductVariants;

use CodeWithDiki\ProductModule\Resources\ProductVariants\Pages\CreateProductVariant;
use CodeWithDiki\ProductModule\Resources\ProductVariants\Pages\EditProductVariant;
use CodeWithDiki\ProductModule\Resources\ProductVariants\Pages\ListProductVariants;
use CodeWithDiki\ProductModule\Resources\ProductVariants\Pages\ViewProductVariant;
use CodeWithDiki\ProductModule\Resources\ProductVariants\Schemas\ProductVariantForm;
use CodeWithDiki\ProductModule\Resources\ProductVariants\Schemas\ProductVariantInfolist;
use CodeWithDiki\ProductModule\Resources\ProductVariants\Tables\ProductVariantsTable;
use BackedEnum;
use CodeWithDiki\ProductModule\Models\ProductVariant;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductVariantResource extends Resource
{
    protected static ?string $model = ProductVariant::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEquals;

    protected static null|\UnitEnum|string $navigationGroup = 'Product Management';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return config('product-module.product_variant_class', ProductVariant::class);
    }

    public static function form(Schema $schema): Schema
    {
        return ProductVariantForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductVariantInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductVariantsTable::configure($table);
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
            'index' => ListProductVariants::route('/'),
            'create' => CreateProductVariant::route('/create'),
            'view' => ViewProductVariant::route('/{record}'),
            'edit' => EditProductVariant::route('/{record}/edit'),
        ];
    }
}
