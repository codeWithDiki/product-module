<?php

namespace CodeWithDiki\ProductModule\Resources\ProductColors\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductColorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Color Information")
                    ->schema([
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required(),
                        TextInput::make('label')
                            ->required(),
                        ColorPicker::make('color_hex')
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
