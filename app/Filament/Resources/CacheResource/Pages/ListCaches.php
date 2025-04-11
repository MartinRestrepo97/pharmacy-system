<?php

namespace App\Filament\Resources\CacheResource\Pages;

use App\Filament\Resources\CacheResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaches extends ListRecords
{
    protected static string $resource = CacheResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
