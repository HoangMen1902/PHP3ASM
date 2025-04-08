<?php

namespace App\Filament\Resources\ChairsResource\Pages;

use App\Filament\Resources\ChairsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChairs extends ListRecords
{
    protected static string $resource = ChairsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
