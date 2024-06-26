<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExtraServiceResource\Pages;
use App\Filament\Resources\ExtraServiceResource\RelationManagers;
use App\Models\ExtraServices;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\SelectAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExtraServiceResource extends Resource
{
    protected static ?string $model = ExtraServices::class;

    protected static ?string $navigationLabel = 'Extra Service';
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Room';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->rules(['required', 'max:255']),
                    Select::make('detail')
                        ->label('Detail')
                        ->options([
                            'nights' => 'Nights',
                            'person' => 'Person',
                        ]),
                    TextInput::make('price')
                        ->required()
                        ->prefix('Rp')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->limit(50)->sortable()->searchable(),
                TextColumn::make('price')->limit(50)->sortable(),
                ToggleColumn::make('status'),
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
            'index' => Pages\ManageExtraServices::route('/'),
        ];
    }
}
