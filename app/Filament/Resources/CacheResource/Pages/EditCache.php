<?php

namespace App\Filament\Resources\CacheResource\Pages;

use App\Filament\Resources\CacheResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCache extends EditRecord
{
    protected static string $resource = CacheResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
