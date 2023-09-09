<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use App\Models\UnitPrice;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Tags\Tag;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationGroup = 'Product';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('slug')->required(),
                TextInput::make('sku')->required(),
                TextInput::make('price')->required(),
                Select::make('unit_price')->options(UnitPrice::pluck('name', 'id')->toArray())->required(),
                TextInput::make('discount_price'),
                Toggle::make('is_active')->required(),
                Toggle::make('is_featured')->required(),
                Textarea::make('short_description')->columnSpan(2),
                RichEditor::make('description')->columnSpan(2),

                Section::make('Media')
                    ->description('Uploading Product Media')
                    ->schema([
                        // SpatieMediaLibraryFileUpload::make('FeaturedImage')
                        //     ->responsiveImages()
                        //     ->collection('FeaturedImage'),
                        // SpatieMediaLibraryFileUpload::make('Gallery')
                        //     ->responsiveImages()
                        //     ->collection('Gallery'),
                    ]),

                Section::make('Category and Tags')
                    ->description('Categories and Tags')
                    ->schema([
                        Select::make('category_id')->options(Category::pluck('name', 'id')->toArray())->required(),
                        Select::make('tags')->options(Tag::pluck('name', 'id')->toArray())->required(),
                    ]),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
