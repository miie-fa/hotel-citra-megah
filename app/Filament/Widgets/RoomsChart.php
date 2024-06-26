<?php

namespace App\Filament\Widgets;

use App\Models\Room;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class RoomsChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Room';

    protected function getData(): array
    {
        $rooms = Room::select('created_at', 'total_rooms')->get()->groupBy(function($rooms) {
            return Carbon::parse($rooms->created_at)->format('F');
        });
        $total_rooms = [];
        foreach ($rooms as $room => $value) {
            array_push($total_rooms, $value->pluck('total_rooms')->sum());
        }

        return [
            'datasets' => [
                [
                    'label' => 'Rooms in Available',
                    'data' => $total_rooms,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $rooms->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}