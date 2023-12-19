<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Notifications\Notification;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;

use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Tables;
use Filament\Tables\Table;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;


    public static function table(Table $table): Table
    {
        return $table
        ->columns([
          Tables\Columns\TextColumn::make('gngc_staff_number')->label('Staff Number'),
          Tables\Columns\TextColumn::make('amount')->label('Amount'),
        ]);
    }

    public function form(Form $form): Form
    {
          return $form
              ->schema([
                TextInput::make('id')->disabled()->label('Member Id'),
                  Select::make('title')
                      ->required()
                      ->options([
                          'Mr.' => 'Mr.',
                          'Mrs' => 'Mrs',
                          'Miss' => 'Miss',
                      ]),
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
                  TextInput::make('religion')->required(),
                  TextInput::make('emergency_contact')->required()
              ]);
      }  

protected function mutateFormDataBeforeFill(array $data): array
{
    $data['id'] = 'GGSSA-'. str_pad($data['id'], 6, '0', STR_PAD_LEFT);
    return $data;
}
}
