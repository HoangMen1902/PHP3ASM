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
            // Gắn các dịch vụ với appointment
            $this->record->services()->sync($services);
    
            // Tính tổng tiền của các dịch vụ
            $totalPrice = \App\Models\Service::whereIn('id', $services)->sum('price');
    
            // Tạo lịch sử dịch vụ tương ứng
            \App\Models\ServiceHistory::create([
                'appointment_id' => $this->record->id,
                'total_price' => $totalPrice,
                'status' => 0, // Hoặc 1 nếu muốn mặc định là đã xử lý
            ]);
        }
    }
    
}
