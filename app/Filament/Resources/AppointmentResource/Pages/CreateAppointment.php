<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAppointment extends CreateRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function afterCreate(): void
    {
        $services = $this->data['services'] ?? [];

        if (!empty($services)) {
            $this->record->services()->sync($services);
        }
    }
}
