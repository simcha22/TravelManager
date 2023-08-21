<?php

namespace App\Filament\Resources\Admin\FlightCompanyResource\Pages;

use App\Filament\Resources\Admin\FlightCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFlightCompanies extends ManageRecords
{
    protected static string $resource = FlightCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
