<?php

namespace App\Filament\Resources\Admin\TravelerResource\Pages;

use App\Filament\Resources\Admin\TravelerResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTravelers extends ManageRecords
{
    protected static string $resource = TravelerResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
