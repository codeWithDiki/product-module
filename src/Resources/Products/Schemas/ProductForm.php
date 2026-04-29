<?php

namespace CodeWithDiki\ProductModule\Resources\Products\Schemas;

use CodeWithDiki\ProductModule\Enums\ProductType;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Product Information")
                    ->components([
                        Select::make('brand_id')
                        ->relationship('brand', 'name'),
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
                        Select::make('type')
                            ->options(ProductType::class)
                            ->required(),
                        Textarea::make('description')
                            ->columnSpanFull(),
                        Grid::make([
                            "lg" => 2,
                            "default" => 1
                        ])
                        ->schema([
                            TextInput::make('price')
                                ->required()
                                ->numeric()
                                ->prefix('Rp.'),
                            TextInput::make('discount_price')
                                ->numeric()
                                ->prefix('Rp.'),
                        ]),
                        TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->default(0),
                        TextInput::make('sku')
                            ->label('SKU'),
                        Toggle::make('is_active')
                            ->required(),
                        TagsInput::make('tags')
                            ->label('Tags')
                            ->columnSpanFull(),
                        KeyValue::make('meta_data')
                            ->columnSpanFull(),
                    ])
                    ->aside()
            ])
            ->columns(1);
    }
}
