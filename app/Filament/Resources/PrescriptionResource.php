<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrescriptionResource\Pages;
use App\Forms\Components\DatePicker;
use App\Forms\Components\Select;
use App\Forms\Components\Textarea;
use App\Forms\Components\TextInput;
use App\Models\Prescription;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class PrescriptionResource extends Resource
{
    protected static ?string $model = Prescription::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required(),
                Forms\Components\TextInput::make('doctor_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('doctor_license')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('issue_date')
                    ->required(),
                Forms\Components\DatePicker::make('expiry_date')
                    ->required(),
                Forms\Components\Textarea::make('instructions')
                    ->nullable(),
                Forms\Components\TextInput::make('status')
                    ->maxLength(255),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name'),
                TextColumn::make('doctor_name'),
                TextColumn::make('doctor_license'),
                TextColumn::make('issue_date')
                    ->date(),
                TextColumn::make('expiry_date')
                    ->date(),
                TextColumn::make('status'),
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
            'index' => Pages\ListPrescriptions::route('/'),
            // 'create' => Pages\CreatePrescription::route('/create'),
            // 'edit' => Pages\EditPrescription::route('/{record}/edit'),
        ];
    }
}