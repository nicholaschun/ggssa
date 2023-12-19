<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;



class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Dues created')
            ->body('Dues has been created successfully.');
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('gngc_staff_number_key')->required()->label('GNGC Staff Number'),
                DatePicker::make('date'),
                TextInput::make('amount')->required()->label('Amount'),
            ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['year'] = date('y', strtotime($data['date']));
        $data['month'] = date('m', strtotime($data['date']));
        return $data;
    }
}
