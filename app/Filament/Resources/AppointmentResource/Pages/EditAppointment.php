<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $services = $this->data['services'] ?? [];

        if (!empty($services)) {
            $this->record->services()->sync($services);
        }
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['services'] = $this->record->services()->pluck('services.id')->toArray();
        return $data;
    }
    
}
