<?php

namespace App\Filament\Resources\Admin\CarResource\Pages;

use App\Filament\Resources\Admin\CarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCars extends ListRecords
{
    protected static string $resource = CarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}