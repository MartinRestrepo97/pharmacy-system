<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FailedJobResource\Pages;
use App\Models\FailedJob;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;

class FailedJobResource extends Resource
{
    protected static ?string $model = FailedJob::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('uuid')
                    ->label('UUID')
                    ->required()
                    ->maxLength(255),
                Textarea::make('connection')
                    ->label('Connection')
                    ->required(),
                Textarea::make('queue')
                    ->label('Queue')
                    ->required(),
                Textarea::make('payload')
                    ->label('Payload')
                    ->required(),
                Textarea::make('exception')
                    ->label('Exception')
                    ->required(),
                TextColumn::make('failed_at')
                    ->label('Failed At')
                    ->dateTime(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('uuid')->label('UUID'),
                TextColumn::make('connection')->label('Connection')->limit(30),
                TextColumn::make('queue')->label('Queue')->limit(30),
                TextColumn::make('failed_at')->label('Failed At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // Consider if editing failed jobs is appropriate
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFailedJobs::route('/'),
            // 'create' => Pages\CreateFailedJob::route('/create'), // Usually you don't create failed jobs manually
            // 'view' => Pages\ViewFailedJob::route('/{record}'),
            // 'edit' => Pages\EditFailedJob::route('/{record}/edit'),
        ];
    }
}