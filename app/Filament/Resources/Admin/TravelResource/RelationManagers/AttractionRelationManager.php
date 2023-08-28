<?php

namespace App\Filament\Resources\Admin\TravelResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class AttractionRelationManager extends RelationManager
{
    protected static string $relationship = 'attraction';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('travel.name')
                    ->sortable()
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('opening_time')
                    ->label(new HtmlString('Opening<br>Time'))
                    ->time()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('closing_time')
                    ->label(new HtmlString('Closing<br>End Time'))
                    ->time()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('preferred_visiting_time')
                    ->label(new HtmlString('visiting<br>Time'))
                    ->time()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('preferred_visiting_day')
                    ->label(new HtmlString('visiting<br>day'))
                    ->date()
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
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
