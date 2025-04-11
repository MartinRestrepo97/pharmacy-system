<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleResource\Pages;
use App\Forms\Components\Select;
use App\Forms\Components\Textarea;
use App\Forms\Components\TextInput;
use App\Models\Sale;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'first_name') // Adjust display column as needed
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name') // Adjust display column as needed
                    ->required(),
                Forms\Components\DateTimePicker::make('sale_date')
                    ->required(),
                Forms\Components\TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('payment_method')
                    ->maxLength(255),
                Forms\Components\Textarea::make('notes')
                    ->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('customer.first_name'), // Adjust display column as needed
                TextColumn::make('user.name'), // Adjust display column as needed
                TextColumn::make('sale_date')
                    ->dateTime(),
                TextColumn::make('total_amount'),
                TextColumn::make('payment_method'),
                TextColumn::make('notes')
                    ->wrap(),
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
            'index' => Pages\ListSales::route('/'),
            // 'create' => Pages\CreateSale::route('/create'),
            // 'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }
}