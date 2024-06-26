<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Orders per month';

    protected static ?int $sort = 2;
    protected static string $color = 'warning';
    public ?string $filter = 'today';

    protected function getData(): array
    {
        $data = Trend::model(Order::class)
        ->between(
            start: now()->startOfMonth(),
            end: now()->endOfMonth(),
        )
        ->perDay()
        ->count();
        // $data = $this->getOrderPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    // 'data' => $data['orderPerMonth'],
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
            // 'labels' => $data['month'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    // private function getOrderPerMonth(): array
    // {
    //     $now = Carbon::now();

    //     $orderPerMonth = [];
    //     $months = collect(range(1, 12))->map(function($month) use ($now, $orderPerMonth){
    //         $count = Order::whereMonth('created_at', Carbon::parse($now->month($month)->format('Y-m')))->count();
    //         $orderPerMonth[] = $count;

    //         return $now->month($month)->format('M');
    //     })->toArray();

    //     return [
    //         'orderPerMonth' => $orderPerMonth,
    //         'month' => $months,
    //     ];
    // }
}
