<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentService extends Model
{
    protected $fillable = [
        'service_id',
        'appointment_id'
    ];

    public function appointments() {
        return $this->belongsTo(Appointment::class);
    }

    public function services() {
        return $this->belongsTo(Service::class);
    }
}
