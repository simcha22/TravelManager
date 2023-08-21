<?php

namespace App\Filament\Resources\Admin\AirportResource\Pages;

use App\Filament\Resources\Admin\AirportResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAirports extends ManageRecords
{
    protected static string $resource = AirportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
