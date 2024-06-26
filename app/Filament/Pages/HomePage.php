<?php

namespace App\Filament\Pages;

use App\Models\Home;
use Filament\Pages\Page;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\HasRoutes;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Panel as FilamentPanel;
use Filament\Panel\Concerns\HasRoutes as ConcernsHasRoutes;
use Filament\Support\Enums\Alignment;
use Filament\Support\Exceptions\Halt;
use Filament\Tables\Columns\Layout\Panel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class HomePage extends Page
{
    use InteractsWithFormActions;

    protected static ?string $navigationLabel = 'Home Page';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.home-page';

    public static ?string $navigationGroup = 'Pages';

    public ?array $data = [];

    public static function routes(FilamentPanel $panel): void
    {
        $slug = static::getSlug();

        Route::get("/{$slug}", static::class)
            ->middleware(static::getRouteMiddleware($panel))
            ->name('home-page');
    }

    public function mount(): void
    {
        $this->fillForm();
    }

    public function getFonteeNotification(): Model
    {
        $fontee = Home::first();

        if (! $fontee instanceof Model) {
            throw new Exception('Model must be a Model');
        }

        return $fontee;
    }

    protected function fillForm(): void
    {
        $data = $this->getFonteeNotification()->attributesToArray();

        $this->form->fill($data);

        $this->callHook('afterFill');
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }

    public function save(): void
    {
        try {
            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeSave($data);

            $this->callHook('beforeSave');

            $this->handleRecordUpdate($this->getFonteeNotification(), $data);

            $this->callHook('afterSave');
        } catch (Halt $exception) {
            return;
        }

        $this->getSavedNotification()?->send();

        if ($redirectUrl = $this->getRedirectUrl()) {
            $this->redirect($redirectUrl);
        }
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        return $record;
    }

    protected function getSavedNotification(): ?Notification
    {
        $title = $this->getSavedNotificationTitle();

        if (blank($title)) {
            return null;
        }

        return Notification::make()
            ->success()
            ->title($this->getSavedNotificationTitle());
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return __('Saved');
    }

    protected function getRedirectUrl(): ?string
    {
        return null;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Section 1')
                    ->schema([
                        TextInput::make('sec_1_title')
                            ->label('Title'),
                        TextArea::make('sec_1_subtitle')
                            ->label('Subtitle')
                            ->autosize(),
                        TextInput::make('sec_1_limit')
                            ->label('Limit Card'),
                        Toggle::make('sec_1_is_view')
                            ->label('Active'),
                    ])->collapsed(),

                Section::make('Section 2')
                    ->schema([
                        FileUpload::make('sec_2_image')
                            ->label('Image')
                            ->maxSize(300)
                            ->directory('home')
                            ->image()
                            ->imageEditor()
                            ->nullable(),
                        TextInput::make('sec_2_title')
                            ->label('Title'),
                        TextArea::make('sec_1_subtitle')
                            ->label('Subtitle')
                            ->autosize(),
                        TextInput::make('sec_2_button')
                            ->label('Button'),
                        TextInput::make('sec_2_button_target')
                            ->label('Button Target'),
                        Toggle::make('sec_2_is_view')
                            ->label('Active'),
                    ])->collapsed(),

                Section::make('Section 3')
                    ->schema([
                        FileUpload::make('sec_3_image')
                            ->label('Image')
                            ->maxSize(300)
                            ->directory('home')
                            ->image()
                            ->imageEditor()
                            ->nullable(),
                        TextInput::make('sec_3_title')
                            ->label('Title'),
                        TextArea::make('sec_3_subtitle')
                            ->label('Subtitle')
                            ->autosize(),
                        Fieldset::make('Card')
                            ->schema([
                                Section::make('Card 1')
                                    ->schema([
                                        TextInput::make('sec_3_icon_1')
                                            ->label('Icon Card 1'),
                                        TextInput::make('sec_3_title_1')
                                            ->label('Title Card 1'),
                                        TextArea::make('sec_3_subtitle_1')
                                            ->label('Subtitle Card 1'),
                                    ]),
                                Section::make('Card 2')
                                    ->schema([
                                        TextInput::make('sec_3_icon_2')
                                            ->label('Icon Card 2'),
                                        TextInput::make('sec_3_title_2')
                                            ->label('Title Card 2'),
                                        TextArea::make('sec_3_subtitle_2')
                                            ->label('Subtitle Card 2'),
                                    ]),
                                Section::make('Card 3')
                                    ->schema([
                                        TextInput::make('sec_3_icon_3')
                                            ->label('Icon Card 3'),
                                        TextInput::make('sec_3_title_3')
                                            ->label('Title Card 3'),
                                        TextArea::make('sec_3_subtitle_3')
                                            ->label('Subtitle Card 3'),
                                    ]),
                            ])->columns(1),
                        Toggle::make('sec_3_is_view')
                            ->label('Active'),
                    ])->collapsed(),

                Section::make('Section 4')
                    ->schema([
                        TextInput::make('sec_4_title')
                            ->label('Title'),
                        Fieldset::make('Button')
                            ->schema([
                                TextInput::make('sec_4_button')
                                    ->label('Button Title'),
                                TextInput::make('sec_4_button_target')
                                    ->label('Button Target'),
                            ]),
                        TextInput::make('sec_4_limit')
                            ->label('Limit Card'),
                        Toggle::make('sec_4_is_view')
                            ->label('Active'),
                    ])->collapsed(),

                Section::make('Section 5')
                    ->schema([
                        TextInput::make('sec_5_title')
                            ->label('Title'),
                        TextArea::make('sec_5_subtitle')
                            ->label('Subtitle')
                            ->maxLength(100)
                            ->autosize(),
                        Fieldset::make('Detail')
                            ->schema([
                                Section::make('Card 1')
                                    ->schema([
                                        FileUpload::make('sec_5_image_1')
                                            ->label('Image')
                                            ->maxSize(300)
                                            ->directory('home')
                                            ->image()
                                            ->imageEditor()
                                            ->nullable(),
                                        TextInput::make('sec_5_title_1')
                                            ->label('Title'),
                                    ])->collapsible(),

                                    Section::make('Card 2')
                                    ->schema([
                                        FileUpload::make('sec_5_image_2')
                                            ->label('Image')
                                            ->maxSize(300)
                                            ->directory('home')
                                            ->image()
                                            ->imageEditor()
                                            ->nullable(),
                                        TextInput::make('sec_5_title_2')
                                            ->label('Title'),
                                    ])->collapsible(),

                                    Section::make('Card 3')
                                    ->schema([
                                        FileUpload::make('sec_5_image_3')
                                            ->label('Image')
                                            ->maxSize(300)
                                            ->directory('home')
                                            ->image()
                                            ->imageEditor()
                                            ->nullable(),
                                        TextInput::make('sec_5_title_3')
                                            ->label('Title'),
                                    ])->collapsible(),
                            ]),
                        Toggle::make('sec_5_is_view')
                            ->label('Active'),
                    ])->collapsed(),

                Section::make('Section 6')
                    ->schema([
                        TextInput::make('sec_6_title')
                            ->label('Title'),
                        TextArea::make('sec_6_subtitle')
                            ->label('Subtitle')
                            ->maxLength(100)
                            ->autosize(),
                        Fieldset::make('Detail')
                            ->schema([
                                Section::make('Card 1')
                                    ->schema([
                                        FileUpload::make('sec_6_image_1')
                                            ->label('Image')
                                            ->maxSize(300)
                                            ->directory('home')
                                            ->image()
                                            ->imageEditor()
                                            ->nullable(),
                                        TextInput::make('sec_6_title_1')
                                            ->label('Title'),
                                        TextArea::make('sec_6_subtitle_1')
                                            ->label('Subtitle')
                                            ->maxLength(100)
                                            ->autosize(),
                                    ])->collapsible(),

                                    Section::make('Card 2')
                                    ->schema([
                                        FileUpload::make('sec_6_image_2')
                                            ->label('Image')
                                            ->maxSize(300)
                                            ->directory('home')
                                            ->image()
                                            ->imageEditor()
                                            ->nullable(),
                                        TextInput::make('sec_6_title_2')
                                            ->label('Title'),
                                        TextArea::make('sec_6_subtitle_2')
                                            ->label('Subtitle')
                                            ->maxLength(100)
                                            ->autosize(),
                                    ])->collapsible(),

                                    Section::make('Card 3')
                                    ->schema([
                                        FileUpload::make('sec_6_image_3')
                                            ->label('Image')
                                            ->maxSize(300)
                                            ->directory('home')
                                            ->image()
                                            ->imageEditor()
                                            ->nullable(),
                                        TextInput::make('sec_6_title_3')
                                            ->label('Title'),
                                        TextArea::make('sec_6_subtitle_3')
                                            ->label('Subtitle')
                                            ->maxLength(100)
                                            ->autosize(),
                                    ])->collapsible(),
                            ]),
                        Toggle::make('sec_6_is_view')
                            ->label('Active'),
                    ])->collapsed(),

                Section::make('Section 7')
                    ->schema([
                        TextInput::make('sec_7_title')
                            ->label('Title'),
                        TextInput::make('sec_7_limit')
                            ->label('Limit Card'),
                        TextArea::make('sec_7_subtitle')
                            ->label('Subtitle')
                            ->maxLength(100)
                            ->autosize(),
                        Toggle::make('sec_7_is_view')
                            ->label('Active'),
                    ])->collapsed(),

                Section::make('Section 8')
                    ->schema([
                        TextInput::make('sec_8_title')
                            ->label('Title'),
                        Toggle::make('sec_8_is_view')
                            ->label('Active'),
                    ])->collapsed(),

                Section::make('Section 9')
                    ->schema([
                        TextInput::make('sec_9_title')
                            ->label('Title'),
                        Fieldset::make('Button')
                            ->schema([
                                TextInput::make('sec_9_button')
                                    ->label('Button Title'),
                                TextInput::make('sec_9_button_target')
                                    ->label('Button Target'),
                            ]),
                        Toggle::make('sec_9_is_view')
                            ->label('Active'),
                    ])->collapsed(),
            ]);
    }

    /**
     * @return array<int | string, string | Form>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->operation('edit')
                    ->model($this->getFonteeNotification())
                    ->statePath('data'),
            ),
        ];
    }

    /**
     * @return array<Action | ActionGroup>
     */
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
            $this->getCancelFormAction(),
        ];
    }

    protected function getCancelFormAction(): Action
    {
        return $this->backAction();
    }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label('Save')
            ->submit('save')
            ->keyBindings(['mod+s']);
    }

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }

    public function getFormActionsAlignment(): string | Alignment
    {
        return Alignment::Start;
    }

    public function hasLogo(): bool
    {
        return false;
    }

    /**
     * @deprecated Use `getCancelFormAction()` instead.
     */
    public function backAction(): Action
    {
        return Action::make('back')
            ->label('back')
            ->url(filament()->getUrl())
            ->color('gray');
    }
}
