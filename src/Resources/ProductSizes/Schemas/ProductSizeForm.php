<?php

namespace CodeWithDiki\ProductModule\Resources\ProductSizes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductSizeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Size Information")
                    ->schema([
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required(),
                        TextInput::make('label')
                            ->required(),
                        TextInput::make('value')
                            ->required(),
                        TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->required(),
                        Toggle::make('is_primary')
                            ->required(),
                    ])
                    ->aside()
            ])
            ->columns(1);
    }
}
