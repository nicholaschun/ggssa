<?php

namespace App\Filament\Resources\IssuesResource\Pages;

use App\Filament\Resources\IssuesResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;


use Filament\Resources\Pages\CreateRecord;

class CreateIssues extends CreateRecord
{
    protected static string $resource = IssuesResource::class;


    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Issue registered')
            ->body('Issue has been created successfully.');
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('/');
    }
    public function form(Form $form): Form
    {
          return $form
              ->schema([
                  TextInput::make('name')->required()->label('Full Name'),
                  TextInput::make('email')->required(),
                  Textarea::make('message')->required(),
              ]);
      }
}
