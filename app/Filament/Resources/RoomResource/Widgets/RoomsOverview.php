<?php

namespace App\Filament\Resources\RoomResource\Widgets;

use App\Models\Room;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RoomsOverview extends BaseWidget
{
    public static function getAveragePrice()
    {
        return Room::query()->avg('price');
    }

    protected function getStats(): array
    {
        $avgPrice = Room::avg('price');

        return [
            Stat::make('All Room', Room::sum('total_rooms')),
            Stat::make('All Room Type', Room::all()->count()),
            Stat::make('Average Price', 'Rp. '.number_format($avgPrice, 0, ',', '.')),
        ];
    }
}
