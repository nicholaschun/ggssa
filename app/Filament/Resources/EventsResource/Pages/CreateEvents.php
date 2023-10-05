<?php

namespace App\Filament\Resources\EventsResource\Pages;

use App\Filament\Resources\EventsResource;
use Filament\Actions;
use Filament\Forms\Components\Checkbox;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Notifications\Notification;





class CreateEvents extends CreateRecord
{
    protected static string $resource = EventsResource::class;


    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Event registered')
            ->body('Event has been created successfully.');
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
                DateTimePicker::make('date')->required(),
                Textarea::make('description')->required(),
                Checkbox::make('status')->label('Visible')
            ]);
    }
}