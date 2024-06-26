<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Room;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '5s';

    protected static bool $isLazy = true;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Customer', User::where('role', 'user')->count())
                ->description('Increase in customers')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 8, 3, 5, 9, 3, 4])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => '$dispatch("setStatusFilter", "processed")',
                ]),
            Stat::make('Total Room', Room::count())
                ->description('Increase in room')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 8, 3, 5]),
            Stat::make('Total Order', Order::count())
                ->description('Increase in order')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([2, 5, 3, 10]),

        ];
    }
}