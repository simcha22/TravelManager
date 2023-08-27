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

class FlightRelationManager extends RelationManager
{
    protected static string $relationship = 'flight';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('airline.name')
                    ->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('airportFrom.name')
                    ->label(new HtmlString('Departure<br>Airport'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('airportTo.name')
                    ->label(new HtmlString('Landing<br>Airport'))
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_time')
                    ->label(new HtmlString('Departure<br>Time'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->label(new HtmlString('Landing<br>Time'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('place')
                    ->searchable()->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
