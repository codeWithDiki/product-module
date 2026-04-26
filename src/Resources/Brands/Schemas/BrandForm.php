<?php

namespace CodeWithDiki\ProductModule\Resources\Brands\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Brand Information")
                    ->components([
                        FileUpload::make("thumbnail_url")
                            ->label("Image")
                            ->image()
                            ->directory("brands"),
                        TextInput::make("name")
                            ->required()
                            ->lazy()
                            ->afterStateUpdated(fn (string $state, callable $set) => $set("slug", str()->slug($state)))
                            ->label("Name"),
                        TextInput::make("slug")
                            ->required()
                            ->unique(ignorable: fn ($record) => $record)
                            ->label("Slug"),
                        Textarea::make("description")
                            ->label("Description"),
                    ])
                    ->aside()
            ])
            ->columns((1));
    }
}
