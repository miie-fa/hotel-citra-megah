<?php

namespace App\Filament\Pages;

use App\Models\Setting as ModelsSetting;
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
use Filament\Navigation\NavigationGroup;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\HasRoutes;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Filament\Panel as FilamentPanel;
use Filament\Panel\Concerns\HasRoutes as ConcernsHasRoutes;
use Filament\Support\Enums\Alignment;
use Filament\Support\Exceptions\Halt;
use Filament\Tables\Columns\Layout\Panel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Setting extends Page
{
    use InteractsWithFormActions;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Setting Website';

    protected static string $view = 'filament.pages.setting';

    public static ?string $navigationGroup = 'Settings';

    public ?array $data = [];

     public static function routes(FilamentPanel $panel): void
    {
        $slug = static::getSlug();

        Route::get("/{$slug}", static::class)
            ->middleware(static::getRouteMiddleware($panel))
            ->name('setting');
    }

    public function mount(): void
    {
        $this->fillForm();
    }

    public function getSetting(): Model
    {
        $settings = ModelsSetting::first();

        if (! $settings instanceof Model) {
            throw new Exception('Model is not compile');
        }

        return $settings;
    }

    protected function fillForm(): void
    {
        $data = $this->getSetting()->attributesToArray();

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

            $this->handleRecordUpdate($this->getSetting(), $data);

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

    protected function getLogoFormComponent(): Component
    {
        return FileUpload::make('logo')
            ->label('Logo')
            ->autofocus()
            ->image()
            ->maxSize(2000)
            ->required()
            ->directory('setting')
            ->storeFileNamesIn('original_filename');
    }

    protected function getFaviconFormComponent(): Component
    {
        return FileUpload::make('favicon')
            ->label('Favicon')
            ->autofocus()
            ->image()
            ->maxSize(2000)
            ->required()
            ->directory('setting')
            ->storeFileNamesIn('original_filename');
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
                        $this->getLogoFormComponent(),
                        $this->getFaviconFormComponent(),
                        TextInput::make('name')
                            ->label('Name of the Hotel')
                            ->columnSpan([
                                'xl' => 2,
                            ]),
                        TextArea::make('description')
                            ->columnSpan([
                                'xl' => 2,
                            ]),
                        TextInput::make('phone')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->columnSpan([
                                'xl' => 2,
                            ]),
                        TextInput::make('fax')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->columnSpan([
                                'xl' => 2,
                            ]),
                        TextInput::make('email')
                            ->columnSpan([
                                'xl' => 2,
                            ]),
                        TextArea::make('address')
                            ->columnSpan([
                                'xl' => 2,
                            ]),
                        TextInput::make('facebook')
                            ->columnSpan([
                                'xl' => 2,
                            ]),
                        TextInput::make('linkedin')
                            ->columnSpan([
                                'xl' => 2,
                            ]),
                        TextInput::make('instagram')
                            ->columnSpan([
                                'xl' => 2,
                            ]),
                        TextInput::make('twitter')
                            ->columnSpan([
                                'xl' => 2,
                            ]),
                        TextInput::make('analytic_id')
                            ->columnSpan([
                                'xl' => 2,
                            ]),
                    ]),
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
                    ->model($this->getSetting())
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
            ->label(__('filament-panels::pages/auth/edit-profile.actions.cancel.label'))
            ->url(filament()->getUrl())
            ->color('gray');
    }
}
