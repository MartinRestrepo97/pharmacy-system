<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CacheResource\Pages;
use App\Models\Cache;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;

class CacheResource extends Resource
{
    protected static ?string $model = Cache::class;

    protected static ?string $navigationIcon = 'heroicon-o-server';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->label('Key')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('value')
                    ->label('Value')
                    ->required(),
                    Forms\Components\TextInput::make('expiration')
                    ->label('Expiration')
                    ->numeric(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->label('Key'),
                TextColumn::make('expiration')->label('Expiration'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCaches::route('/'),
            // 'create' => Pages\CreateCache::route('/create'),
            // 'edit' => Pages\EditCache::route('/{record}/edit'),
        ];
    }
}
