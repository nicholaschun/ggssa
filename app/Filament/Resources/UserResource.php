<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static ?string $label = 'Members';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ggssa_member_id')->label("Member Id")->getStateUsing(function (Model $record) :string {
                    return 'GGSSA-'. str_pad($record->ggssa_member_id, 4, '0', STR_PAD_LEFT);
                })->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Full Name')->searchable(),
                // Tables\Columns\TextColumn::make('gender')->label('Gender'),
                // Tables\Columns\TextColumn::make('employment_date')->label('Employment Date'),
                Tables\Columns\TextColumn::make('gngc_staff_number')->label('Staff Number'),
                Tables\Columns\TextColumn::make('department')->label('Department'),
                Tables\Columns\TextColumn::make('gngc_job_title')->label('Job Title'),
                // Tables\Columns\TextColumn::make('date_of_birth')->label('Birthday'),
                Tables\Columns\TextColumn::make('contact_number')->label('Contact Number'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}'),
            'payment' => Pages\UserPayments::route('/{record}/payments')
        ];
    }    
}
