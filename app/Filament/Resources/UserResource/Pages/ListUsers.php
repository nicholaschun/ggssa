<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use App\Models\User;
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
                    ImportField::make('emergency_contact')->label('Emergency Contact'),
                    ImportField::make('emergency_contact_name')->label('Emergency Contact Name'),
                    ImportField::make('relationship_with_emergency_contact')->label('Emergency Contact Relation'),
                    ImportField::make('next_of_kin')->label('Next of kin'),
                    ImportField::make('next_of_kin_contact')->label('Next of kin contact'),
                    ImportField::make('relationship_with_next_of_kin')->label('Next of kin relation')
                ])
                ->label('Import Excel')
                ->visible(auth()->user()->can('add-members'))
                ->mutateBeforeCreate(function($data) {
                    $data['password'] = bcrypt(strtolower($data['first_name']) . '@1234');
                    $data['status'] = true;
                    $data['email'] = $data['gngc_email'];
                    $data['profile_set'] = false;
                    $data['profile_photo'] = 'https://ggssa-public.s3.us-east-1.amazonaws.com/image-placeholder.jpg';
                    $data['name'] = $data['first_name'] . 
                    (!empty($data['middle_name'] ?? '') ? ' ' . $data['middle_name'] . ' ' : ' ') . 
                    $data['last_name'];

                    $lastRecord = User::latest()->first();
                    $nextNumber = $lastRecord ? (int)$lastRecord->ggssa_member_id + 1 : 1;

                    $data['ggssa_member_id'] = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
                    $data['email_verified_at'] = date('Y-m-d H:i:s');
                    $data['password_changed'] = false;
                    return $data;
                })
              
        ];
    }
}