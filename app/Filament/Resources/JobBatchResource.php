<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobBatchResource\Pages;
use App\Models\JobBatch;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;

class JobBatchResource extends Resource
{
    protected static ?string $model = JobBatch::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('id')
                    ->label('ID')
                    ->maxLength(255),
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('total_jobs')
                    ->label('Total Jobs')
                    ->required()
                    ->numeric(),
                TextInput::make('pending_jobs')
                    ->label('Pending Jobs')
                    ->required()
                    ->numeric(),
                TextInput::make('failed_jobs')
                    ->label('Failed Jobs')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('finished_at')
                    ->label('Finished At'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('name')->label('Name'),
                TextColumn::make('total_jobs')->label('Total Jobs'),
                TextColumn::make('pending_jobs')->label('Pending Jobs'),
                TextColumn::make('failed_jobs')->label('Failed Jobs'),
                TextColumn::make('finished_at')->label('Finished At')->dateTime(),
                TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // Consider if editing job batches is appropriate
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobBatches::route('/'),
            // 'create' => Pages\CreateJobBatch::route('/create'), // Usually job batches are created by the system
            // 'view' => Pages\ViewJobBatch::route('/{record}'),
            // 'edit' => Pages\EditJobBatch::route('/{record}/edit'),
        ];
    }
}