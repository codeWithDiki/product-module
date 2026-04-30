<?php

namespace CodeWithDiki\ProductModule\Resources\Brands;

use CodeWithDiki\ProductModule\Resources\Brands\Pages\CreateBrand;
use CodeWithDiki\ProductModule\Resources\Brands\Pages\EditBrand;
use CodeWithDiki\ProductModule\Resources\Brands\Pages\ListBrands;
use CodeWithDiki\ProductModule\Resources\Brands\Pages\ViewBrand;
use CodeWithDiki\ProductModule\Resources\Brands\Schemas\BrandForm;
use CodeWithDiki\ProductModule\Resources\Brands\Schemas\BrandInfolist;
use CodeWithDiki\ProductModule\Resources\Brands\Tables\BrandsTable;
use BackedEnum;
use CodeWithDiki\ProductModule\Models\Brand;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAtSymbol;
    
    protected static null|\UnitEnum|string $navigationGroup = 'Product Management';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return config('product-module.brand_class', Brand::class);
    }

    public static function form(Schema $schema): Schema
    {
        return BrandForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BrandInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BrandsTable::configure($table);
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
            'index' => ListBrands::route('/'),
            'create' => CreateBrand::route('/create'),
            'view' => ViewBrand::route('/{record}'),
            'edit' => EditBrand::route('/{record}/edit'),
        ];
    }
}
