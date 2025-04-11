<?php

namespace App\Filament\Resources\PasswordResetTokenResource\Pages;

use App\Filament\Resources\PasswordResetTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPasswordResetTokens extends ListRecords
{
    protected static string $resource = PasswordResetTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
