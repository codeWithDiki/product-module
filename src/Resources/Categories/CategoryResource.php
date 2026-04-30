<?php

namespace CodeWithDiki\ProductModule\Resources\Categories;

use CodeWithDiki\ProductModule\Resources\Categories\Pages\CreateCategory;
use CodeWithDiki\ProductModule\Resources\Categories\Pages\EditCategory;
use CodeWithDiki\ProductModule\Resources\Categories\Pages\ListCategories;
use CodeWithDiki\ProductModule\Resources\Categories\Pages\ViewCategory;
use CodeWithDiki\ProductModule\Resources\Categories\Schemas\CategoryForm;
use CodeWithDiki\ProductModule\Resources\Categories\Schemas\CategoryInfolist;
use CodeWithDiki\ProductModule\Resources\Categories\Tables\CategoriesTable;
use BackedEnum;
use CodeWithDiki\ProductModule\Models\Category;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBars3CenterLeft;

    protected static null|\UnitEnum|string $navigationGroup = 'Product Management';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return config('product-module.category_class', Category::class);
    }

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'view' => ViewCategory::route('/{record}'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
