<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\UserResource\Pages;
use App\Filament\Resources\Admin\UserResource\RelationManagers;
use App\Models\City;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'ManageUsers';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make()->tabs([
                    Forms\Components\Tabs\Tab::make('User data')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required(),
                            Forms\Components\TextInput::make('email')
                                ->required()
                                ->email()
                                ->unique(ignoreRecord: true),
                            Forms\Components\TextInput::make('password')
                                ->required()
                                ->visibleOn('create')
                                ->password(),
                        ]),
                    Forms\Components\Tabs\Tab::make('Roles')
                        ->schema([
                            Forms\Components\Select::make('roles')
                                ->relationship('roles', 'name')
                                ->multiple(),
                        ]),
                    Forms\Components\Tabs\Tab::make('Profile Data')
                        ->schema([
                            Forms\Components\Fieldset::make('profile')
                                ->relationship('profile')
                                ->schema([
                                    TextInput::make('first_name')
                                        ->required(),
                                    TextInput::make('last_name')
                                        ->required(),
                                    TextInput::make('email')
                                        ->required()
                                        ->email()
                                        ->unique(ignoreRecord: true),
                                    TextInput::make('phone')
                                        ->required()->tel(),
                                    Forms\Components\DatePicker::make('birthday')
                                        ->required()->maxDate(now()),
                                    Forms\Components\Radio::make('gender')
                                        ->options([
                                            'male' => 'Male',
                                            'female' => 'Female',
                                            'other' => 'Other',
                                        ])
                                        ->required(),
                                    Forms\Components\Select::make('country_id')
                                        ->relationship('country', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required(),
                                    Forms\Components\Select::make('city_id')
                                        ->relationship('city', 'name')
                                        ->options(function (Forms\Get $get) {
                                            if (!$get('country_id')) {
                                                return [];
                                            }
                                            return City::where('country_id', $get('country_id'))->pluck('name', 'id')->toArray();
                                        })->live()
                                        ->searchable()
                                        ->preload()
                                        ->required(),
                                    Forms\Components\TextInput::make('address')
                                        ->required(),
                                    Forms\Components\Select::make('plan_id')
                                        ->relationship('plan', 'name')
                                        ->required(),
                                ]),

                        ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('changePassword')
                    ->form([
                        TextInput::make('new_password')
                            ->password()
                            ->label('New Password')
                            ->required()
                            ->rule(Password::default()),
                        TextInput::make('new_password_confirmation')
                            ->password()
                            ->label('Confirm New Password')
                            ->required()
                            ->same('new_password')
                            ->rule(Password::default())
                    ])->icon('heroicon-m-arrow-path')
                    ->color('info')
                    ->action(function (User $record, array $data) {
                        $record->update([
                            'password' => Hash::make($data['new_password'])
                        ]);

                        Notification::make()
                            ->title('New Password Saved successfully')
                            ->sendToDatabase($record);
                    }),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('User Data')
                    ->schema([
                        Infolists\Components\TextEntry::make('name'),
                        Infolists\Components\TextEntry::make('email')
                            ->icon('heroicon-m-envelope'),
                        Infolists\Components\TextEntry::make('roles.name')->badge(),
                        Infolists\Components\TextEntry::make('roles.permissions.name')
                            ->label('Permissions')
                            ->badge(),
                    ])->columns(4),
                Infolists\Components\Split::make([
                    Infolists\Components\Section::make('Profile Data')
                        ->description('User profile data')
                        ->schema([
                            Infolists\Components\TextEntry::make('profile.first_name')->label('First Name'),
                            Infolists\Components\TextEntry::make('profile.last_name')->label('Last Name'),
                            Infolists\Components\TextEntry::make('profile.email')
                                ->label('Email')
                                ->icon('heroicon-m-envelope'),
                            Infolists\Components\TextEntry::make('profile.phone')
                                ->icon('heroicon-s-phone')
                                ->label('Phone'),
                            Infolists\Components\TextEntry::make('profile.country.name')
                                ->label('Country')
                                ->icon('heroicon-s-building-office-2'),
                            Infolists\Components\TextEntry::make('profile.city.name')
                                ->label('City')
                                ->icon('heroicon-s-building-office-2'),
                            Infolists\Components\TextEntry::make('profile.address')
                                ->label('Address')
                                ->icon('heroicon-s-building-office-2'),
                            Infolists\Components\TextEntry::make('profile.plan.name')->label('Plan')->badge(),
                        ])->columns(4),
                ])->columnSpanFull()->from('xl')
            ]);
    }
}
