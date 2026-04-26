<?php

namespace CodeWithDiki\ProductModule\Resources\ProductImages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Product Image Information")
                    ->components([
                        FileUpload::make("image_url")
                            ->label("Image")
                            ->image()
                            ->directory("product-images"),
                        Select::make("product_id")
                            ->relationship("product", "name")
                            ->searchable()
                            ->preload()
                            ->label("Product"),
                        Toggle::make("is_primary")
                            ->label("Is Primary?"),
                    ])
                    ->aside()
            ])
            ->columns((1));
    }
}
