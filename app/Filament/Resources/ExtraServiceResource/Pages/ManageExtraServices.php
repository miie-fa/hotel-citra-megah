<?php

namespace App\Filament\Resources\ExtraServiceResource\Pages;

use App\Filament\Resources\ExtraServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageExtraServices extends ManageRecords
{
    protected static string $resource = ExtraServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
