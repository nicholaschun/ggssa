<?php

namespace App\Filament\Resources\MessagesResource\Pages;

use App\Filament\Resources\MessagesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Messages;





class EditMessages extends EditRecord
{
    protected static string $resource = MessagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Send Message')
            ->action(fn () => $this->sendMessages($this->getRecord())),
            Actions\DeleteAction::make()
        ];
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
                Textarea::make('message')->required(),
                Select::make('channel')
                    ->required()
                    ->options([
                        'sms' => 'SMS',
                        'email' => 'Email',
                        'sms,email' => 'SMS & Email',
                    ]),
                Select::make('receipients')
                    ->required()
                    ->options([
                        'all' => 'All members',
                    ]),
            ]);
    }

    public function sendMessages($record): string
    {
        // improve this to use a queue
        foreach ( User::all()->where('status', 1) as $user) {
            $basicToken = base64_encode(config('sms.hubtel.username').':'.config('sms.hubtel.password'));
            Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '. $basicToken
            ])->post(config('sms.hubtel.url'), [
                'from' => config('sms.hubtel.senderId'),
                'to' => $user->contact_number,
                'content' => $record->message
            ]);
        }
        $message = Messages::find($record->id);
        $message->status = 'sent';
        $message->save();
        return $this->getRedirectUrl();
    }
}