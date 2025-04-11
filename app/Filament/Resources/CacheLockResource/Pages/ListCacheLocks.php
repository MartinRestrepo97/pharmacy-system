<?php

namespace App\Filament\Resources\CacheLockResource\Pages;

use App\Filament\Resources\CacheLockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCacheLocks extends ListRecords
{
    protected static string $resource = CacheLockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
