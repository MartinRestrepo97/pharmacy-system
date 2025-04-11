<?php

namespace App\Filament\Resources\PasswordResetTokenResource\Pages;

use App\Filament\Resources\PasswordResetTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPasswordResetToken extends EditRecord
{
    protected static string $resource = PasswordResetTokenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
