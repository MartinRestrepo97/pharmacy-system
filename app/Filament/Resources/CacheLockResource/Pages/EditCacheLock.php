<?php

namespace App\Filament\Resources\CacheLockResource\Pages;

use App\Filament\Resources\CacheLockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCacheLock extends EditRecord
{
    protected static string $resource = CacheLockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
