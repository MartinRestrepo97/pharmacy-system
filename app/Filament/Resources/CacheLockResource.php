<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CacheLockResource\Pages;
use App\Models\CacheLock;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class CacheLockResource extends Resource
{
    protected static ?string $model = CacheLock::class;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('key')
                    ->required()
                    ->maxLength(255),
                TextInput::make('owner')
                    ->maxLength(255),
                DateTimePicker::make('expiration')
                    ->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('key'),
                TextColumn::make('owner'),
                TextColumn::make('expiration')
                    ->dateTime(),
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
            'index' => Pages\ListCacheLocks::route('/'),
            'create' => Pages\CreateCacheLock::route('/create'),
            // 'edit' => Pages\EditCacheLock::route('/{record}/edit'),
        ];
    }
}