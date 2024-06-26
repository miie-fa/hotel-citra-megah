<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomSizeResource\Pages;
use App\Filament\Resources\RoomSizeResource\RelationManagers;
use App\Models\RoomSize;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomSizeResource extends Resource
{
    protected static ?string $model = RoomSize::class;

    protected static ?string $navigationLabel = 'Room Size';
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Room';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->rules(['required', 'max:255']),
                    TextInput::make('size')
                        ->required()
                        ->numeric()
                        ->suffix('m2')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->limit(50)->sortable()->searchable(),
                TextColumn::make('size')
                    ->limit(50)
                    ->sortable()
                    ->suffix('m2'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageRoomSizes::route('/'),
        ];
    }
}
