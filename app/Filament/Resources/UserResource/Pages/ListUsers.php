<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\ImportField;
use Filament\Forms\Components\FileUpload;


class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
                ->fields([
                    ImportField::make('title')->label('Title')->required(),
                    ImportField::make('first_name')->label('First Name')->required(),
                    ImportField::make('middle_name')->label('Middle Name'),
                    ImportField::make('last_name')->label('Last Name')->required(),
                    ImportField::make('gender')->label('Gender')->required(),
                    ImportField::make('employment_date')->label('Employment Date')->required(),
                    ImportField::make('join_ggssa_date')->label('Join GGSSA Date')->required(),
                    ImportField::make('gngc_staff_number')->label('GNGC Staff Number')->required(),
                    ImportField::make('department')->label('Department')->required(),
                    ImportField::make('gngc_job_title')->label('GNGC Job Title')->required(),
                    ImportField::make('workstation')->label('Workstation')->required(),
                    ImportField::make('date_of_birth')->label('Date Of Birth')->required(),
                    ImportField::make('contact_number')->label('Contact Number')->required(),
                    ImportField::make('whatsapp_number')->label('Whatsapp Number')->required(),
                    ImportField::make('gngc_email')->label('GNGC Email')->required(),
                    ImportField::make('marital_status')->label('Marital Status')->required(),
                    ImportField::make('number_of_children')->label('Number of Children')->required(),
                    ImportField::make('religion')->label('Religion')->required(),
                    ImportField::make('emergency_contact')->label('Emergency Contact')->required()
                ])
                ->label('Import Excel')
                ->mutateBeforeCreate(function($row) {
                    $row['password'] = bcrypt($row['first_name'] . '@1234');
                    $row['status'] = true;
                    $row['email'] = $row['gngc_email'];
                    $row['name'] = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                })
              
        ];
    }
}