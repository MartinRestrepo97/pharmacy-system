<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MigrationResource\Pages;
use App\Models\Migration;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;

class MigrationResource extends Resource
{
    protected static ?string $model = Migration::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('migration')
                    ->label('Migration')
                    ->required()
                    ->maxLength(255),
                TextInput::make('batch')
                    ->label('Batch')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('migration')->label('Migration'),
                TextColumn::make('batch')->label('Batch'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // No edit or create for migrations usually
            ])
            ->bulkActions([
                // No delete for migrations usually
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMigrations::route('/'),
            // 'create' => Pages\CreateMigration::route('/create'),
            // 'edit' => Pages\EditMigration::route('/{record}/edit'),
        ];
    }
}