<?php

namespace App\Filament\Resources\Admin\AttractionResource\Pages;

use App\Filament\Resources\Admin\AttractionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAttraction extends ViewRecord
{
    protected static string $resource = AttractionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
