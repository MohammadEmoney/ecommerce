<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnitPriceResource\Pages;
use App\Filament\Resources\UnitPriceResource\RelationManagers;
use App\Models\UnitPrice;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnitPriceResource extends Resource
{
    protected static ?string $model = UnitPrice::class;

    protected static ?string $navigationGroup = 'General';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('symbole'),
                TextInput::make('iso'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('symbole'),
                TextColumn::make('iso'),
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
            'index' => Pages\ListUnitPrices::route('/'),
            'create' => Pages\CreateUnitPrice::route('/create'),
            'edit' => Pages\EditUnitPrice::route('/{record}/edit'),
        ];
    }
}
