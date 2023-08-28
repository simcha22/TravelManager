<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\TravelResource\Pages;
use App\Filament\Resources\Admin\TravelResource\RelationManagers;
use App\Models\Travel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class TravelResource extends Resource
{
    protected static ?string $model = Travel::class;

    protected static ?string $navigationIcon = 'gmdi-card-travel-o';

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationGroup = 'ManageTravels';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Travel Name')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required(),
                            Forms\Components\RichEditor::make('description')
                                ->required(),
                            Forms\Components\Toggle::make('status')
                                ->onColor('info')
                                ->offColor('danger')
                                ->onIcon('heroicon-m-check')
                                ->offIcon('heroicon-o-x-mark'),
                            Forms\Components\Select::make('user_id')
                                ->relationship('user', 'name')
                                ->required(),
                        ]),
                    Forms\Components\Wizard\Step::make('Travel Time')
                        ->schema([
                            Forms\Components\DateTimePicker::make('start_time')
                                ->native(false)
                                ->minutesStep(15)
                                ->seconds(false)
                                ->minDate(now())
                                ->required(),
                            Forms\Components\DateTimePicker::make('end_time')
                                ->native(false)
                                ->minutesStep(15)
                                ->seconds(false)
                                ->required()
                                ->after('start_time'),
                        ]),
                    Forms\Components\Wizard\Step::make('Travel Data')
                        ->schema([
                            Forms\Components\TextInput::make('count_of_travelers')
                                ->required()->numeric(),
                            Forms\Components\TextInput::make('count_of_targets')
                                ->required()->numeric(),
                            Forms\Components\TextInput::make('number_of_days')
                                ->required()->numeric(),
                        ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label(new HtmlString('Travel<br>Start Time'))
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->label(new HtmlString('Travel<br>End Time'))
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('count_of_travelers')
                    ->label('Passengers')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('number_of_days')
                    ->label('Days')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('count_of_targets')
                    ->label('Targets')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->onColor('info')
                    ->offColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make('start_time')
                    ->form([
                        Forms\Components\DatePicker::make('start_time'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_time'],
                                fn(Builder $query, $date): Builder => $query->whereDate('start_time', '>=', $date),
                            );
                    }),
                Tables\Filters\Filter::make('end_time')
                    ->form([
                        Forms\Components\DatePicker::make('end_time'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['end_time'],
                                fn(Builder $query, $date): Builder => $query->whereDate('end_time', '>=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->defaultSort('created_at', 'desc')
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
            RelationManagers\DestinationRelationManager::class,
            RelationManagers\TravelerRelationManager::class,
            RelationManagers\FlightRelationManager::class,
            RelationManagers\AttractionRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTravel::route('/'),
            'create' => Pages\CreateTravel::route('/create'),
            'edit' => Pages\EditTravel::route('/{record}/edit'),
            'view' => Pages\viewTravel::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Travel Data')
                    ->schema([
                        Infolists\Components\TextEntry::make('name'),
                        Infolists\Components\TextEntry::make('user.name'),
                        Infolists\Components\TextEntry::make('description')
                            ->html()->columns(2),
                    ])->columns(4),
                Infolists\Components\Section::make('Travel Times')
                    ->schema([
                        Infolists\Components\TextEntry::make('start_time')
                        ->dateTime(),
                        Infolists\Components\TextEntry::make('end_time')
                        ->dateTime(),
                        Infolists\Components\TextEntry::make('count_of_travelers'),
                        Infolists\Components\TextEntry::make('count_of_targets'),
                        Infolists\Components\TextEntry::make('number_of_days'),
                        Infolists\Components\TextEntry::make('status'),
                    ])->columns(4),
            ]);
    }
}
