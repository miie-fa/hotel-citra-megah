<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateRoom extends CreateRecord
{
    protected static string $resource = RoomResource::class;

    public function getAmenitiesAttribute()
    {
    return explode(',', $this->attributes['amenities']);
    }

    protected function getRedirectUrl(): string
    {
        $name = Auth::user()->name;
        Notification::make()
            ->success()
            ->title('Room Has Created By '. $name)
            ->body('New Room Has Been Saved')
            ->sendToDatabase(User::get());

        return $this->getResource()::getUrl('index');
    }
}
