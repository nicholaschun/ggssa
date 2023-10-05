<?php

namespace App\Filament\Resources\MessagesResource\Pages;

use App\Filament\Resources\MessagesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;


class CreateMessages extends CreateRecord
{
    protected static string $resource = MessagesResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Message registered')
            ->body('Message has been created successfully.');
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function form(Form $form): Form
    {
          return $form
              ->schema([
                  TextInput::make('title')->required()->label('Title'),
                  Textarea::make('message')->required(),
                  Select::make('channel')
                    ->required()
                    ->options([
                        'sms' => 'SMS',
                        'email' => 'Email',
                        'sms,email' => 'SMS & Email',
                    ]),
                    Select::make('receipients')
                    ->required()
                    ->options([
                        'all' => 'All members',
                    ]),
              ]);
      }
}
