<?php

namespace App\Filament\Resources\Admin\AttractionResource\Pages;

use App\Filament\Resources\Admin\AttractionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttractions extends ListRecords
{
    protected static string $resource = AttractionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
