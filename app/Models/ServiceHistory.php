<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    protected $fillable = [
        'total_price',
        'appointment_id',
        'status'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
