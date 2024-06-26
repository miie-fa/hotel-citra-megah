<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use stdClass;

class LatestOrders extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {

        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Order Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('order_no')
                    ->label('Number')
                    ->searchable(),
                TextColumn::make('payment_method'),
                TextColumn::make('paid_amount'),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('payment_date')
                    ,
            ])
            ->filters([
                Filter::make('Pending')
                    ->label('Pending')
                    ->query(fn (Builder $query): Builder => $query->where('status', 'PENDING')),
                Filter::make('Success')
                    ->label('Success')
                    ->query(fn (Builder $query): Builder => $query->where('status', 'SUCCESS')),
                Filter::make('Expired')
                    ->label('Expired')
                    ->query(fn (Builder $query): Builder => $query->where('status', 'EXPIRED')),
            ])
            ->actions([
                 Tables\Actions\Action::make('open')
                    ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record])),
            ]);
    }
}
