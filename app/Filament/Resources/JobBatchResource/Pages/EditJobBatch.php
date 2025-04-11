<?php

namespace App\Filament\Resources\JobBatchResource\Pages;

use App\Filament\Resources\JobBatchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobBatch extends EditRecord
{
    protected static string $resource = JobBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
