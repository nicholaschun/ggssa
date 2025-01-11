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
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;


class ViewUser extends ViewRecord implements HasTable
{
  use InteractsWithTable;
  // use InteractsWithRecord;


    protected static string $resource = UserResource::class;
    protected static string $view = 'filament.resources.user-resource.pages.user-payments';

    // public string $staffid;

    // public function mount(int | string $record):void
    // {
    //     // $this->form->fill();
    //     $this->record = $this->resolveRecord($record);
    //     static::authorizeResourceAccess();

    // }
    public function table(Table $table): Table
    {
        return $table
        ->query(\App\Models\Payment::query()->where('gngc_staff_number_key', $this->record['gngc_staff_number']))
        ->columns([
          Tables\Columns\TextColumn::make('gngc_staff_number_key')->label('Staff Number')->searchable(),
          Tables\Columns\TextColumn::make('amount')->label('Amount'),
          Tables\Columns\TextColumn::make('month')->label('Month')->searchable(),
          Tables\Columns\TextColumn::make('year')->label('Year')->searchable()
        ]);
    }

    public function form(Form $form): Form
    {
          return $form
              ->schema([
                  TextInput::make('ggssa_member_id')->disabled()->label('Member Id'),
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
                  TextInput::make('religion')->required(),
                  TextInput::make('emergency_contact')->required(),
                  TextInput::make('emergency_contact_name'),
                  TextInput::make('relationship_with_emergency_contact'),
                  TextInput::make('next_of_kin'),
                  TextInput::make('next_of_kin_contact'),
                  TextInput::make('relationship_with_next_of_kin')

              ])->statePath('data')
              ;
      }  

      

      public function getViewData(): array
      {
        return [
          'id' => 'GGSSA',
            'custom_content' => 'Your content here'
        ];
        // $record['id'] = 'GGSSA-'. str_pad($record['id'], 6, '0', STR_PAD_LEFT);
    // return $record;
      }

protected function mutateFormDataBeforeFill(array $data): array
{
    $data['ggssa_member_id'] = 'GGSSA-'. $data['ggssa_member_id'];
    return $data;
}
}
