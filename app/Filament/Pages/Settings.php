<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Exception;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Type\VoidType;


class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    public array $updateProfileInformationState = [];

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.settings';
    protected static bool $shouldRegisterNavigation = true;
    protected static ?int $navigationSort = 9;

    public ?array $settingsData = [];
    public ?array $passwordData = [];

    public function mount(): void
    {
        $this->fillForms();
    }

    protected function getForms(): array
    {
        return [
            'editSettingsForm',
            'editPasswordForm',
        ];
    }

    public function editSettingsForm(Form $form): Form
    {
        return $form->schema([
            // 'updateProfileInformationForm' => $this->makeForm(),
            Section::make('Profile Information')
            ->description('Update your account\'s profile information and email address.')
            ->schema([
                FileUpload::make('profile_photo')
                ->image()
                ->avatar()
                ->disk('s3')
                ->directory('profile-photo')
                ->rules(['nullable', 'mimes:jpg,jpeg,png', 'max:1024']),
                // TextInput::make('email')
                // ->email()
                // ->required()
            ])
            ->model(User::class)
            ->statePath('')
        ]);
    }

    public function editPasswordForm(Form $form): Form
    {
        return $form->schema([
            Section::make('Update Password')
           ->description('Ensure your account is using long, random password to stay secure.')
           ->schema([
            TextInput::make('Current password')
           ->password()
           ->required()
           ->currentPassword(),
            TextInput::make('password')
           ->password()
           ->required()
           ->rule(Password::default())
           ->autocomplete('new-password')
           ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
           ->live(debounce: 500)
           ->same('passwordConfirmation'),
            TextInput::make('passwordConfirmation')
           ->password()
           ->required()
           ->dehydrated(false),
            ]),
            ])
           ->model($this->getUser())
           ->statePath('passwordData');
            
    }

    public function getUser(): Authenticatable & Model
    {
        $user = Filament::auth()->user();
        if (!$user instanceof Model) {
            throw new Exception('The authenticated user object must be an Eloquent model to allow the profile page to update it.');
             }
            return $user;
    }

    public function fillForms(): void
    {

        $data = $this->getUser()->attributesToArray();
        // $this->editSettingsForm->fill($data);
        $this->editPasswordForm->fill();
    }

    public function updateSettings(): void
    {
        $data = $this->editSettingsForm->getState();
        $this->handleRecordUpdate($this->getUser(), $data);
        $this->sendSuccessNotification(); 
    }
    public function updatePassword(): void
    {
        $data = $this->editPasswordForm->getState();
        $this->handleRecordUpdate($this->getUser(), $data);
        if (request()->hasSession() && array_key_exists('password', $data)) {
            request()->session()->put(['password_hash_' . Filament::getAuthGuard() => $data['password']]);
        }
        $this->editSettingsForm->fill();
        Filament::auth()->logout();
        $this->redirect('/login');
        // $this->sendSuccessNotification(); 
    }
    private function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);
        return $record;
    }

    protected function getUpdateProfileFormActions(): array
    {
        return [
            Action::make('updateSettingsAction')
                ->label('Save Changes')
                ->submit('editSettingsForm'),
        ];
    }
    protected function getUpdatePasswordFormActions(): array
    {
        return [
            Action::make('updatePasswordAction')
                ->label('Update Password')
                ->submit('editPasswordForm'),
        ];
    }

    private function sendSuccessNotification():void{
        Notification::make()
        ->success()
        ->title(__('filament-panels::pages/auth/edit-profile.notifications.saved.title'))
        ->send();
    }

    // public function updateProfilePhoto()
    // {
    //     $this->user->updateProfilePhoto($this->updateProfileInformationForm->getState());
    // }



}
