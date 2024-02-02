<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\ImportField;


class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
            ->handleBlankRows(true)
                ->fields([
                    ImportField::make('title')->label('Title'),
                    ImportField::make('first_name')->label('First Name')->required(),
                    ImportField::make('middle_name')->label('Middle Name'),
                    ImportField::make('last_name')->label('Last Name')->required(),
                    ImportField::make('gender')->label('Gender'),
                    ImportField::make('employment_date')->label('Employment Date'),
                    ImportField::make('join_ggssa_date')->label('Join GGSSA Date'),
                    ImportField::make('gngc_staff_number')->label('GNGC Staff Number'),
                    ImportField::make('department')->label('Department'),
                    ImportField::make('gngc_job_title')->label('GNGC Job Title'),
                    ImportField::make('workstation')->label('Workstation'),
                    ImportField::make('date_of_birth')->label('Date Of Birth'),
                    ImportField::make('contact_number')->label('Contact Number'),
                    ImportField::make('whatsapp_number')->label('Whatsapp Number'),
                    ImportField::make('gngc_email')->label('GNGC Email')->required(),
                    ImportField::make('marital_status')->label('Marital Status'),
                    ImportField::make('number_of_children')->label('Number of Children'),
                    ImportField::make('religion')->label('Religion'),
                    ImportField::make('emergency_contact')->label('Emergency Contact')
                ])
                ->label('Import Excel')
                ->visible(auth()->user()->can('add-members'))
                ->mutateBeforeCreate(function($row) {
                    $middleName = isset($row['middle_name']) ? $row['middle_name'] : "" ;
                    $row['password'] = bcrypt($row['first_name'] . '@1234');
                    $row['status'] = true;
                    $row['email'] = $row['gngc_email'];
                    $row['name'] = $row['first_name'] . ' ' . $middleName . ' ' . $row['last_name'];
                    return $row;
                })
              
        ];
    }
}