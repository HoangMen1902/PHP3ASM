<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentService extends Model
{
    protected $fillable = [
        'service_id',
        'appointment_id'
    ];
}
