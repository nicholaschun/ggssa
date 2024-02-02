<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Actions;
use Filament\Forms\Components\Builder;
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
                ImportField::make('date')->label('Date')->required(),
                ImportField::make('amount')->label('Amount')->required(),
            ])
            ->label('Import Excel')
            ->visible(auth()->user()->can('upload-payments'))
            ->mutateBeforeCreate(function($row) {
                $row['year'] = date('y', strtotime($row['date']));
                $row['month'] = date('m', strtotime($row['date']));
                return $row;
            })
        ];
    }

}
