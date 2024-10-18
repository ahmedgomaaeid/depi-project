<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user'; // Optional: Use a Heroicon icon in the navigation menu

    protected static ?int $navigationSort = 2;  // Optional: Set the order in the navigation menu

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(User::class, 'email', ignoreRecord: true),
                TextInput::make('phone')
                    ->required(),
                Select::make('role')
                    ->options([
                        '0' => 'User',
                        '1' => 'Admin',
                    ])
                    ->default('0')
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(fn ($livewire) => $livewire instanceof Pages\CreateUser) // Only required on create
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                    ->visible(fn ($livewire) => $livewire instanceof Pages\CreateUser), // Only visible on create
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->sortable(),
                TextColumn::make('phone')->sortable(),
                BadgeColumn::make('role')
                ->label('User Role')
                ->getStateUsing(function ($record) {
                    switch ($record->role) {
                        case '0':
                            return 'User';
                        case '1':
                            return 'Admin';
                        default:
                            return 'Unknown';
                    }
                })
                ->colors([
                    'green' => 'User',
                    'gray' => 'Admin',
                ])
                ->sortable(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
        ];
    }
}
