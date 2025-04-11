<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('queue')
                    ->label('Queue')
                    ->maxLength(255),
                Forms\Components\Textarea::make('payload')
                    ->label('Payload')
                    ->required(),
                TextInput::make('attempts')
                    ->label('Attempts')
                    ->required()
                    ->numeric(),
                TextInput::make('reserved_at')
                    ->label('Reserved At')
                    ->numeric(),
                TextInput::make('available_at')
                    ->label('Available At')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('queue')->label('Queue'),
                TextColumn::make('attempts')->label('Attempts'),
                TextColumn::make('reserved_at')->label('Reserved At'),
                TextColumn::make('available_at')->label('Available At'),
                TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // Consider if editing jobs is appropriate
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobs::route('/'),
            // 'create' => Pages\CreateJob::route('/create'), // Usually jobs are created by the system
            // 'view' => Pages\ViewJob::route('/{record}'),
            // 'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }
}