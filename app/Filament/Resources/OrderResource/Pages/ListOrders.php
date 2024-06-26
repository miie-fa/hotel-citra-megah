<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderOverview;
use App\Models\Order;
use App\Models\OrderDetail;
use Filament\Actions;
use Filament\Forms\Components\Tabs;
use Filament\Notifications\Collection;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;

class ListOrders extends ListRecords
{
    // public Collection $orderByStatuses;

    protected static string $resource = OrderResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            OrderOverview::class
        ];
    }

    public function getTabs(): array
    {
        return [
            null => ListRecords\Tab::make('All'),
            'success' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'SUCCESS')),
            'failed' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'FAILED')),
            'expired' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'EXPIRED')),
            'completed' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'COMPLETED')),
            'cancelled' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status', 'CANCEL')),
        ];
    }
}
