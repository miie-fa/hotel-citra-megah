<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Infolist;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable as ContractsHasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use stdClass;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationGroup = 'Room';
    protected static ?int $navigationSort = -1;

    public static function form(Form $form): Form
    {
        return $form
                ->schema([
                    Wizard::make([
                        Step::make('Personal Information')
                            ->schema([
                                FileUpload::make('avatar')
                                    ->maxSize(300)
                                    ->directory('users')
                                    ->image()
                                    ->imageEditor(),
                                TextInput::make('name')
                                    ->required()
                                    ->minLength(2)
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                TextInput::make('phone')
                                    ->required()
                                    ->prefix(62),
                                Select::make('role')
                                    ->required()
                                    ->options([
                                        '1' => 'Admin',
                                        '0' => 'User',
                                    ]),
                                TextInput::make('password')
                                    ->required()
                                    ->password()
                                    ->mutateDehydratedStateUsing(fn ($state) => Hash::make($state))
                                    ->visible(fn ($livewire) => $livewire instanceof CreateUser)
                                    ->rule(Password::default()),
                                TextInput::make('new_password')
                                    ->nullable()
                                    ->password()
                                    ->rule(Password::default())
                                    ->visible(fn ($livewire) => $livewire instanceof EditUser),
                                TextInput::make('password_confirmation')
                                    ->password()
                                    ->same('new_password')
                                    ->requiredWith('new_password')
                                    ->visible(fn ($livewire) => $livewire instanceof EditUser)
                            ])->columns(1)->icon('heroicon-o-user'),
                        Step::make('Address')
                            ->schema([
                                Textarea::make('address')
                                    ->nullable(),
                                Select::make('country')
                                    ->options([
                                        'indonesia' => 'Indonesia',
                                    ])
                            ])->icon('heroicon-o-home'),
                    ])->columnSpan(['lg' => fn (?User $record) => $record === null ? 3 : 2]),
                    Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (User $record): ?string => $record->created_at?->diffForHumans()),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (User $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?User $record) => $record === null),
                ])->columns([
                    'sm' => 3,
                    'lg' => null,
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->state(
                    static function (ContractsHasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('name'),
                TextColumn::make('email')
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500),
                TextColumn::make('role'),
                TextColumn::make('phone'),
                TextColumn::make('country'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ComponentsSection::make()
                    ->schema([
                        Split::make([
                            Grid::make(2)
                                ->schema([
                                    Group::make([
                                        TextEntry::make('name'),
                                        TextEntry::make('email'),
                                        TextEntry::make('phone'),
                                    ]),
                                    Group::make([
                                        TextEntry::make('address'),
                                        TextEntry::make('country'),
                                        TextEntry::make('created_at')
                                            ->badge()
                                            ->date()
                                            ->color('success'),
                                    ]),
                                ]),
                                ImageEntry::make('avatar')
                                    ->hiddenLabel()
                                    ->grow(false),
                            ])->from('lg'),
                        ]),
                    ComponentsSection::make('Detail Information')
                    ->schema([
                        TextEntry::make('content')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\Profile::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
