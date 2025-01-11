<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;


class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Member registered')
            ->body('Member has been created successfully.');
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                TextInput::make('first_name')->required(),
                TextInput::make('middle_name'),
                TextInput::make('last_name')->required(),
                TextInput::make('gender')->required(),
                DateTimePicker::make('employment_date')->required(),
                DateTimePicker::make('join_ggssa_date')->required(),
                TextInput::make('gngc_staff_number')->required(),
                TextInput::make('department')->required(),
                TextInput::make('gngc_job_title')->required(),
                TextInput::make('workstation')->required(),
                TextInput::make('contact_number')->required(),
                TextInput::make('whatsapp_number')->required(),
                TextInput::make('gngc_email')->required(),
                TextInput::make('marital_status')->required(),
                TextInput::make('number_of_children')->required(),
                TextInput::make('date_of_birth')->required(),
                TextInput::make('religion')->required(),
                TextInput::make('emergency_contact')->required(),
                TextInput::make('emergency_contact_name'),
                TextInput::make('relationship_with_emergency_contact'),
                TextInput::make('next_of_kin'),
                TextInput::make('next_of_kin_contact'),
                TextInput::make('relationship_with_next_of_kin')
            ]);
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = bcrypt(strtolower($data['first_name']) . '@1234');
        $data['status'] = true;
        $data['email'] = $data['gngc_email'];
        $data['profile_set'] = false;
        $data['profile_photo'] = 'https://ggssa-public.s3.us-east-1.amazonaws.com/image-placeholder.jpg';
        $data['name'] = $data['first_name'] . ' ' . $data['middle_name'] . ' ' . $data['last_name'];

        $lastRecord = User::latest()->first();
        $nextNumber = $lastRecord ? (int)$lastRecord->ggssa_member_id + 1 : 1;

        $data['ggssa_member_id'] = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        $data['email_verified_at'] = date('Y-m-d H:i:s');
        $data['password_changed'] = false;
        return $data;
    }

    protected function afterCreate(): void
    {
        $this->record->assignRole('member');
    }

}
