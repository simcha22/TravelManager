<?php

namespace App\Filament\Resources\Admin\AirlineResource\Pages;

use App\Filament\Resources\Admin\AirlineResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAirlines extends ManageRecords
{
    protected static string $resource = AirlineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
