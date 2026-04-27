<?php

namespace CodeWithDiki\ProductModule\Resources\ProductVariants\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductVariantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Product Variant Information")
                    ->components([
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required(),
                        Grid::make([
                            "lg" => 2,
                            "default" => 1
                        ])
                        ->schema([
                            TextInput::make('name')
                            ->lazy()
                            ->afterStateUpdated(fn (string $state, callable $set) => $set('slug', str()->slug($state)))
                            ->required(),
                            TextInput::make('slug')
                                ->required(),
                        ]),
                        Textarea::make('description')
                            ->columnSpanFull(),
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                        TextInput::make('discount_price')
                            ->numeric()
                            ->prefix('Rp'),
                        TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->default(0),
                        TextInput::make('sku')
                            ->label('SKU'),
                        Toggle::make('is_active')
                            ->required(),
                    ])
                    ->aside()
            ])
            ->columns(1);
    }
}
