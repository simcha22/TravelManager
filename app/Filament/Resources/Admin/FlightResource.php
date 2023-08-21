<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\FlightResource\Pages;
use App\Filament\Resources\Admin\FlightResource\RelationManagers;
use App\Models\Flight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlightResource extends Resource
{
    protected static ?string $model = Flight::class;

    protected static ?string $navigationIcon = 'forkawesome-plane';

    protected static ?string $navigationGroup = 'ManageTravels';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Flight Details')
                        ->schema([
                            Forms\Components\Select::make('airport_from_id')
                                ->label('From Airport')
                                ->relationship('airportFrom', 'name')
                                ->required()
                                ->searchable(),
                            Forms\Components\Select::make('airport_to_id')
                                ->label('To Airport')
                                ->relationship('airportTo', 'name')
                                ->required()
                                ->searchable(),
                            Forms\Components\DateTimePicker::make('start_time')
                                ->label('Departure')
                                ->native(false)
                                ->minutesStep(15)
                                ->seconds(false)
                                ->minDate(now())
                                ->required(),
                            Forms\Components\DateTimePicker::make('end_time')
                                ->label('Landing')
                                ->native(false)
                                ->minutesStep(15)
                                ->seconds(false)
                                ->required()
                                ->after('start_time'),
                            Forms\Components\TextInput::make('code')
                                ->label('Flight Code')
                                ->required(),
                            Forms\Components\TextInput::make('place')
                                ->required(),
                        ])->columns(2),
                    Forms\Components\Wizard\Step::make('More Details')
                        ->schema([
                            Forms\Components\Select::make('flight_company_id')
                                ->relationship('flightCompany', 'name')
                                ->required()
                                ->searchable(),
                            Forms\Components\Radio::make('type')
                                ->options([
                                    'away' => 'Away',
                                    'return' => 'Return',
                                ])
                                ->required(),
                            Forms\Components\Select::make('user_id')
                                ->relationship('user', 'name')
                                ->required()
                                ->searchable(),
                            Forms\Components\Select::make('travel_id')
                                ->relationship('travel', 'name')
                                ->required()
                                ->searchable(),
                        ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('flightCompany.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('airportFrom.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('airportTo.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('travel.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('place')
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFlights::route('/'),
            'create' => Pages\CreateFlight::route('/create'),
            'edit' => Pages\EditFlight::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
