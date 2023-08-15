<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\PlanResource\Pages;
use App\Filament\Resources\Admin\PlanResource\RelationManagers;
use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Main Data')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\Radio::make('type_of_calk')
                            ->options([
                                'monthly' => 'Monthly',
                                'yearly' => 'Yearly',
                                'lifetime' => 'Lifetime',
                                'experience' => 'Experience'
                            ])
                            ->required(),
                        Forms\Components\Toggle::make('status')
                            ->onColor('info')
                            ->offColor('danger')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-o-x-mark')
                    ])->columns(3),
                Forms\Components\Fieldset::make('Plan Uses')
                    ->schema([
                        Forms\Components\TextInput::make('count_of_users')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('count_of_groups')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('count_of_travels')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('count_of_travel_operations')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('count_of_advertisements')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('count_of_tracks')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('count_of_documents')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('count_of_notifications')
                            ->required()
                            ->numeric(),
                    ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('count_of_users')
                    ->label('Users')
                    ->numeric()
                    ->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('count_of_groups')
                    ->label('Groups')
                    ->numeric()
                    ->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('count_of_travels')
                    ->label('Travels')
                    ->numeric()
                    ->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('count_of_advertisements')
                    ->label('Advertisements')
                    ->numeric()
                    ->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('count_of_tracks')
                    ->label('Tracks')
                    ->numeric()
                    ->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('count_of_documents')
                    ->label('Documents')
                    ->numeric()
                    ->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('count_of_travel_operations')
                    ->label(new HtmlString('Travel<br> Operations'))
                    ->numeric()
                    ->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('count_of_notifications')
                    ->label('Notifications')
                    ->numeric()
                    ->sortable()->toggleable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->onColor('info')
                    ->offColor('danger'),
                Tables\Columns\TextColumn::make('type_of_calk')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'monthly' => 'primary',
                        'yearly' => 'danger',
                        'lifetime' => 'info',
                        'experience' => 'success'
                    })
                    ->label('Type')
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
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('price', 'desc')
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
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'view' => Pages\ViewPlan::route('/{record}'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
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
