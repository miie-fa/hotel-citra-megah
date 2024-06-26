<?php

namespace App\Filament\Resources;

use App\Models\BedType;
use Filament\Forms;
use App\Models\Room;
use Filament\Tables;
use App\Models\Amenity;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Columns\Summarizers\Average;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Actions\SelectAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\CheckboxList;
use App\Filament\Resources\RoomResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Filament\Resources\RoomResource\RelationManagers\CommentsRelationManager;
use App\Filament\Resources\RoomResource\Widgets\RoomsOverview;
use App\Models\RoomSize;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use stdClass;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationGroup = 'Room';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->minLength(2)
                                    ->maxLength(255)
                                    ->live(debounce: '1000')
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->required()
                                    ->readOnly(),
                                RichEditor::make('description')
                                    ->required()
                                    ->columnSpan([
                                        'sm' => 1,
                                        'xl' => 2,
                                    ]),
                                TextInput::make('price')
                                    ->numeric()
                                    ->required()
                                    ->columnSpan([
                                        'sm' => 1,
                                        'xl' => 2,
                                    ])
                                    ->prefix('Rp'),
                                TextInput::make('total_rooms')
                                    ->label('Total Room Amount')
                                    ->numeric(),
                                Select::make('size')
                                    ->label('Room Size')
                                    ->options(RoomSize::all()->pluck('size', 'size'))
                                    ->searchable()
                                    ->suffix('m2'),
                                TextInput::make('adults')
                                    ->label('Total Adult')
                                    ->numeric(),
                                TextInput::make('childrens')
                                    ->label('Total Children')
                                    ->numeric(),
                                    Select::make('amenities')
                                    ->multiple()
                                    ->options(Amenity::all()->pluck('name', 'id'))
                                    ->columnSpanFull(),
                                TextInput::make('total_bathrooms')
                                    ->label('Total Bathroom')
                                    ->numeric(),
                                Select::make('bed_type')
                                    ->label('Bed Type')
                                    ->options(BedType::all()->pluck('name', 'name'))
                                    ->searchable(),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Video')
                            ->schema([
                                TextInput::make('video_id')
                                    ->label('Youtube Video')
                                ])
                            ->collapsible(),

                        Forms\Components\Section::make('Image')
                            ->schema([
                                FileUpload::make('featured_photo')
                                    ->label('')
                                    ->maxSize(300)
                                    ->multiple()
                                    ->directory('rooms')
                                    ->image()
                                    ->imageEditor()
                                ])
                            ->collapsible(),
                    ])
                    ->columnSpan(['lg' => fn (?Room $record) => $record === null ? 3 : 2]),

                Forms\Components\Section::make()
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Available')
                            ->onColor('success')
                            ->offColor('danger'),
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (Room $record): ?string => $record->created_at?->diffForHumans()),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (Room $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Room $record) => $record === null),
            ])
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('No')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                // TextColumn::make('description'),
                TextColumn::make('price')
                    ->prefix('Rp. '),
                TextColumn::make('bed_type')
                    ->label('Bed Type')
                    ->searchable(),
                TextColumn::make('total_rooms')
                    ->label('Rooms'),
                // TextColumn::make('amenities'),
                TextColumn::make('size')
                    ->label('Size')
                    ->suffix('m2'),
                // TextColumn::make('created_at')->since(),
                ToggleColumn::make('is_published')
                    ->label('Available'),
            ])
            ->filters([
                Filter::make('Published')
                    ->label('Available')
                    ->query(fn (Builder $query): Builder => $query->where('is_published', true)),
                Filter::make('UnPublished')
                    ->label('Unavailable')
                    ->query(fn (Builder $query): Builder => $query->where('is_published', false)),
                SelectFilter::make('bed_type')
                    ->options(BedType::all()->pluck('name', 'name')),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                \Filament\Tables\Actions\DeleteAction::make(),
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

    public static function getRelations(): array
    {
        return [
            CommentsRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            RoomsOverview::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
