<?php

namespace App\Filament\Resources\AmenityResource\Pages;

use App\Filament\Resources\AmenityResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAmenities extends ManageRecords
{
    protected static string $resource = AmenityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // Change Title In Totle
    public function getTitle(): string
    {
        return "Amenity";
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'icon'];
    }
}
