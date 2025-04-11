<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SessionResource\Pages;
use App\Forms\Components\TextInput;
use App\Models\Session;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class SessionResource extends Resource
{
    protected static ?string $model = Session::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name') // Adjust display column as needed
                    ->nullable(),
                Forms\Components\TextInput::make('ip_address')
                    ->maxLength(45),
                Forms\Components\Textarea::make('user_agent')
                    ->nullable(),
                Forms\Components\Textarea::make('payload')
                    ->required(),
                Forms\Components\DateTimePicker::make('last_activity')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('user.name') // Adjust display column as needed
                    ->nullable(),
                TextColumn::make('ip_address'),
                TextColumn::make('user_agent')
                    ->wrap(),
                TextColumn::make('last_activity')
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
            'index' => Pages\ListSessions::route('/'),
            // 'create' => Pages\CreateSession::route('/create'),
            // 'edit' => Pages\EditSession::route('/{record}/edit'),
        ];
    }
}