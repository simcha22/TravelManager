<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\DestinationResource\Pages;
use App\Filament\Resources\Admin\DestinationResource\RelationManagers;
use App\Models\Destination;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DestinationResource extends Resource
{
    protected static ?string $model = Destination::class;

    protected static ?string $navigationIcon = 'forkawesome-map-signs';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationGroup = 'ManageTravels';

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
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('travel.name')
                    ->badge(),
                Tables\Columns\TextColumn::make('order')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->badge()->color('info'),
                Tables\Columns\TextColumn::make('country.name')
                    ->badge()->color('info'),
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

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDestinations::route('/'),
        ];
    }
}
