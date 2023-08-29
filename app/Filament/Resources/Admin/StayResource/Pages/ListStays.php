<?php

namespace App\Filament\Resources\Admin\StayResource\Pages;

use App\Filament\Resources\Admin\StayResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStays extends ListRecords
{
    protected static string $resource = StayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
