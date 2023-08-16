<?php

namespace App\Filament\Resources\Admin\CountryResource\Pages;

use App\Filament\Resources\Admin\CountryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCountries extends ManageRecords
{
    protected static string $resource = CountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
