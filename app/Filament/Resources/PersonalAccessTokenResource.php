<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonalAccessTokenResource\Pages;
use App\Models\PersonalAccessToken;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class PersonalAccessTokenResource extends Resource
{
    protected static ?string $model = PersonalAccessToken::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('tokenable_type')
                    ->required()
                    ->maxLength(255),
                TextInput::make('tokenable_id')
                    ->required()
                    ->numeric(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('token')
                    ->required()
                    ->unique()
                    ->maxLength(64),
                Textarea::make('abilities')
                    ->nullable(),
                DateTimePicker::make('last_used_at')
                    ->nullable(),
                DateTimePicker::make('expires_at')
                    ->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('tokenable_type'),
                TextColumn::make('tokenable_id'),
                TextColumn::make('name'),
                TextColumn::make('token'),
                TextColumn::make('last_used_at')
                    ->dateTime(),
                TextColumn::make('expires_at')
                    ->dateTime(),
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('updated_at')
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
            'index' => Pages\ListPersonalAccessTokens::route('/'),
            // 'create' => Pages\CreatePersonalAccessToken::route('/create'),
            // 'edit' => Pages\EditPersonalAccessToken::route('/{record}/edit'),
        ];
    }
}