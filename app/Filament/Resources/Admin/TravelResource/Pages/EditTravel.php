<?php

namespace App\Filament\Resources\Admin\TravelResource\Pages;

use App\Filament\Resources\Admin\TravelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTravel extends EditRecord
{
    protected static string $resource = TravelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
