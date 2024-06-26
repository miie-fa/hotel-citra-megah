<?php

namespace App\Filament\Resources\BedTypeResource\Pages;

use App\Filament\Resources\BedTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBedTypes extends ManageRecords
{
    protected static string $resource = BedTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
