<?php

namespace App\Filament\Resources\Admin\AttractionResource\Pages;

use App\Filament\Resources\Admin\AttractionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttraction extends EditRecord
{
    protected static string $resource = AttractionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
