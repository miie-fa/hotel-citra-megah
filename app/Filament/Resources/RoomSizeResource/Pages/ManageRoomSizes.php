<?php

namespace App\Filament\Resources\RoomSizeResource\Pages;

use App\Filament\Resources\RoomSizeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRoomSizes extends ManageRecords
{
    protected static string $resource = RoomSizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
