<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\OrderdetailsRelationManager;
use App\Models\Order;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use stdClass;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Room';

    public static function getNavigationLabel(): string
    {
        return __('Orders');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(10)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->translateLabel()
                    ->date()
                    ->sortable(),
                TextColumn::make('order_no')
                    ->label('Number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('payment_method')
                    ->label('Payment'),
                TextColumn::make('paid_amount'),
                BadgeColumn::make('status')
                    ->colors([
                        'danger' => fn ($state) => in_array($state, ['EXPIRED', 'FAILED']),
                        'warning' => 'WAIT',
                        'success' => fn ($state) => in_array($state, ['SUCCESS', 'Completed']),
                    ]),
            ])
            ->filters([

            ])
            ->actions([
                Action::make('Invoice')
                    ->icon('heroicon-o-document-arrow-up')
                    ->url(fn(Order $record) => route('order.invoice.download', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make(),
            ])
            ->emptyStateActions([
            ]);
    }

    protected function mutateFormDataBeforeFill(array $data, $model): array
    {
        $data_user['user_id'] = User::find('id', $model->id);

        return $data_user;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        Split::make([
                            Grid::make(2)
                                ->schema([
                                    Group::make([
                                        TextEntry::make('order_no')
                                            ->label('Number'),
                                        TextEntry::make('status')
                                            ->badge()
                                            ->colors([
                                                'danger' => fn ($state) => in_array($state, ['EXPIRED', 'FAILED']),
                                                'warning' => 'WAIT',
                                                'success' => fn ($state) => in_array($state, ['SUCCESS', 'Completed']),
                                            ]),
                                        TextEntry::make('created_at')
                                            ->badge()
                                            ->date()
                                            ->color('success'),
                                    ]),
                                    Group::make([
                                        TextEntry::make('user.name')
                                            ->label('Name'),
                                        TextEntry::make('user.address')
                                            ->label('Address'),
                                        TextEntry::make('user.phone')
                                            ->label('Phone'),
                                        TextEntry::make('link'),
                                        TextEntry::make('session_id'),
                                    ]),
                                ]),
                                ImageEntry::make('thumbnail')
                                    ->hiddenLabel()
                                    ->grow(false),
                            ])->from('lg'),
                        ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            OrderdetailsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            // 'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }



    // public static function getLabel(): ?string
    // {
    //     $locale = app()->getLocale();

    //     if ($locale == 'id') {
    //         return "Pesanan";
    //     } else {
    //         return "Order";
    //     }
    // }
}
