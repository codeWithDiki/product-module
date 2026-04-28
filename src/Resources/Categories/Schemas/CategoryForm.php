<?php

namespace CodeWithDiki\ProductModule\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Category Information")
                    ->components([
                        FileUpload::make("thumbnail_url")
                            ->label("Image")
                            ->image()
                            ->directory("categories"),
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
                        Toggle::make("is_active")
                            ->label("Is Active")
                            ->default(true)
                    ])
                    ->aside()
            ])
            ->columns((1));
    }
}
