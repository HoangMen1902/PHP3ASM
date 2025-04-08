<?php

namespace App\Filament\Resources\ChairsResource\Pages;

use App\Filament\Resources\ChairsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChairs extends EditRecord
{
    protected static string $resource = ChairsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
