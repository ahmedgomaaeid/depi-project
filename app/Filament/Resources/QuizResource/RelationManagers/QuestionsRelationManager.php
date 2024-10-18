<?php

namespace App\Filament\Resources\QuizResource\RelationManagers;

use App\Models\ProductImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('option1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('option2')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('option3')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('option4')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('answer')
                    ->options([
                        '1' => 'Option 1',
                        '2' => 'Option 2',
                        '3' => 'Option 3',
                        '4' => 'Option 4',
                    ])
                    ->required(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('option1')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('option2')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('option3')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('option4')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('answer')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                // Any filters if necessary
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
