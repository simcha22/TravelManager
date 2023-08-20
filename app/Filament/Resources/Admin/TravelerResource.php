<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\TravelerResource\Pages;
use App\Filament\Resources\Admin\TravelerResource\RelationManagers;
use App\Models\Traveler;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TravelerResource extends Resource
{
    protected static ?string $model = Traveler::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    protected static ?int $navigationSort = 8;

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
                Tables\Columns\TextColumn::make('age'),
                Tables\Columns\TextColumn::make('travel.name')
                    ->badge(),
                Tables\Columns\TextColumn::make('user.name')
                    ->badge()
                    ->color('info'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                ]),
            ])
            ->emptyStateActions([

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTravelers::route('/'),
        ];
    }
}
