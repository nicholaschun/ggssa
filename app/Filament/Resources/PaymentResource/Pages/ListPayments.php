<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\ImportField;


class ListPayments extends ListRecords
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make()
            ->handleBlankRows(true)
            ->fields([
                ImportField::make('gngc_staff_number_key')->label('GNGC Staff Number')->required(),
                ImportField::make('month')->label('Month')->required(),
                ImportField::make('year')->label('Year')->required(),
                ImportField::make('amount')->label('Amount')->required(),
            ])
            ->label('Import Excel')
        ];
    }
}
