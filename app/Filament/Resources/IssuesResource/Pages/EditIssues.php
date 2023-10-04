<?php

namespace App\Filament\Resources\IssuesResource\Pages;

use App\Filament\Resources\IssuesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;

class EditIssues extends EditRecord
{
    protected static string $resource = IssuesResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->label('Full Name')->disabled(),
                TextInput::make('email')->required()->disabled(),
                Textarea::make('message')->required()->disabled(),
            ]);
    }
}