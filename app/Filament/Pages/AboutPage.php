<?php

namespace App\Filament\Pages;

use App\Models\AboutUs;
use Filament\Pages\Page;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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

class AboutPage extends Page
{
    use InteractsWithFormActions;

    protected static ?string $navigationLabel = 'About Page';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.about-page';

    public static ?string $navigationGroup = 'Pages';

    public ?array $data = [];

    public static function routes(FilamentPanel $panel): void
    {
        $slug = static::getSlug();

        Route::get("/{$slug}", static::class)
            ->middleware(static::getRouteMiddleware($panel))
            ->name('about-page');
    }

    public function mount(): void
    {
        $this->fillForm();
    }

    public function getFonteeNotification(): Model
    {
        $fontee = AboutUs::first();

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
                Section::make()
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                    ])
                    ->schema([
                        FileUpload::make('banner')
                            ->directory('about')
                            ->image()
                            ->imageEditor()
                            ->columnSpan([
                                'xl' => 2
                            ]),
                        TextInput::make('title_banner')
                            ->columnSpan([
                                'xl' => 2
                            ]),
                        FileUpload::make('image')
                            ->maxSize(300)
                            ->directory('about')
                            ->image()
                            ->imageEditor(),
                        TextArea::make('content')
                            ->autosize(),
                    ]),
                Section::make('Visi & Misi')
                    ->schema([
                        TextArea::make('visi')
                            ->autosize(),
                        TextArea::make('misi')
                            ->autosize(),
                    ])->collapsible()->columns(2),
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
