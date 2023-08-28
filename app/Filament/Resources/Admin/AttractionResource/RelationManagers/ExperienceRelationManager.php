<?php

namespace App\Filament\Resources\Admin\AttractionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ExperienceRelationManager extends RelationManager
{
    protected static string $relationship = 'experience';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->required(),
                Forms\Components\TimePicker::make('opening_time')
                    ->native(false)
                    ->minutesStep(15)
                    ->seconds(false)
                    ->required(),
                Forms\Components\TimePicker::make('closing_time')
                    ->native(false)
                    ->minutesStep(15)
                    ->seconds(false)
                    ->required()
                    ->after('opening_time'),
                Forms\Components\TimePicker::make('preferred_visiting_time')
                    ->native(false)
                    ->minutesStep(15)
                    ->seconds(false)
                    ->required()
                    ->after('opening_time')
                    ->before('closing_time'),
                Forms\Components\TextInput::make('visiting_minutes')
                    ->required()->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('opening_time')
                    ->label(new HtmlString('Opening<br>Time'))
                    ->time()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('closing_time')
                    ->label(new HtmlString('Closing<br>Time'))
                    ->time()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('preferred_visiting_time')
                    ->label(new HtmlString('visiting<br>Time'))
                    ->time()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
