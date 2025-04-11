<?php

namespace App\Filament\Resources\PasswordResetTokenResource\Pages;

use App\Filament\Resources\PasswordResetTokenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePasswordResetToken extends CreateRecord
{
    protected static string $resource = PasswordResetTokenResource::class;
}
