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
    
            $totalPrice = \App\Models\Service::whereIn('id', $services)->sum('price');
    
            \App\Models\ServiceHistory::create([
                'appointment_id' => $this->record->id,
                'total_price' => $totalPrice,
                'status' => 2, 
            ]);
        }
    }
    
}
