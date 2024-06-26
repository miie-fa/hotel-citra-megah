<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\RelationManagers\TagsRelationManager;
use App\Filament\Resources\PostResource\Widgets\StatsOverview;
use App\Models\Category;
use Filament\Forms;
use App\Models\Post;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Infolists\Infolist;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Filament\Resources\PostResource\RelationManagers\CommentsRelationManager;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Infolists\Components\Grid as ComponentsGrid;
use Filament\Infolists\Components\Group as ComponentsGroup;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as ComponentsSection;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Tables\Actions\Contracts\HasTable;
use Filament\Tables\Contracts\HasTable as ContractsHasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use stdClass;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('title')
                    ->translateLabel()
                    ->required()
                    ->live(debounce: '1000')
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')
                    ->required()
                    ->readOnly(),
                    RichEditor::make('content')
                    ->required(),
                    BelongsToSelect::make('category_id')
                        ->relationship('category', 'name'),
                    Toggle::make('is_published'),
                ]),
                Section::make('Image')->schema([
                    FileUpload::make('thumbnail')
                    ->image()
                    ->maxSize(2000)
                    ->label('')
                    ->required()
                    ->columns(1)
                    ->directory('posts')
                    ->storeFileNamesIn('original_filename'),
                ])
                ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->state(
                    static function (ContractsHasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('title')->limit('30')->searchable()->sortable(),
                TextColumn::make('slug')->limit('30'),
                ToggleIconColumn::make('is_published')
                    ->label(__('Publish'))
                    ->onIcon('heroicon-s-eye')
                    ->offIcon('heroicon-o-eye-slash')
            ])
            ->filters([
                Filter::make('Published')
                    ->query(fn (Builder $query): Builder => $query->where('is_published', true)),
                Filter::make('UnPublished')
                    ->query(fn (Builder $query): Builder => $query->where('is_published', false)),
                SelectFilter::make('category')
                    ->relationship('category', 'name')
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
                            ComponentsGrid::make(2)
                                ->schema([
                                    ComponentsGroup::make([
                                        TextEntry::make('title'),
                                        TextEntry::make('slug'),
                                        TextEntry::make('created_at')
                                            ->badge()
                                            ->date()
                                            ->color('success'),
                                    ]),
                                    ComponentsGroup::make([
                                        TextEntry::make('category.name'),
                                        TextEntry::make('tags.name')
                                            ->badge(),
                                            // ->getStateUsing(fn () => ['one', 'two', 'three', 'four']),
                                    ]),
                                ]),
                                ImageEntry::make('thumbnail')
                                    ->hiddenLabel()
                                    ->grow(false),
                            ])->from('lg'),
                        ]),
                    ComponentsSection::make('Content')
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
            TagsRelationManager::class,
            CommentsRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
