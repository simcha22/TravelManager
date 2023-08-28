<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\AttractionResource\Pages;
use App\Filament\Resources\Admin\AttractionResource\RelationManagers;
use App\Models\Attraction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class AttractionResource extends Resource
{
    protected static ?string $model = Attraction::class;

    protected static ?string $navigationIcon = 'gmdi-attractions-r';

    protected static ?string $navigationGroup = 'ManageTravels';

    protected static ?int $navigationSort = 13;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Attraction Name')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required(),
                            Forms\Components\RichEditor::make('description')
                                ->required(),
                            Forms\Components\Select::make('user_id')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->required(),
//                            Forms\Components\Select::make('city_id')
//                                ->relationship('city', 'name')
//                                ->live()
//                                ->searchable()
//                                ->preload(),
                            Forms\Components\Select::make('travel_id')
                                ->relationship('travel', 'name')
                                ->searchable()
                                ->preload(),
                        ]),
                    Forms\Components\Wizard\Step::make('Attraction Times')
                        ->schema([
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
                                ->after('opening_time')->before('closing_time'),
                            Forms\Components\DatePicker::make('preferred_visiting_day')
                                ->native(false)
                                ->seconds(false)
                                ->required(),
                            Forms\Components\TextInput::make('visiting_hours')
                                ->required()->numeric(),
                        ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                    ->label(new HtmlString('Closing<br>Time'))
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ExperienceRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttractions::route('/'),
            'create' => Pages\CreateAttraction::route('/create'),
            'view' => Pages\ViewAttraction::route('/{record}'),
            'edit' => Pages\EditAttraction::route('/{record}/edit'),
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
