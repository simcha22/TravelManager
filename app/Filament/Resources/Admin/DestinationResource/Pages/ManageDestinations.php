<?php

namespace App\Filament\Resources\Admin\DestinationResource\Pages;

use App\Filament\Resources\Admin\DestinationResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDestinations extends ManageRecords
{
    protected static string $resource = DestinationResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
