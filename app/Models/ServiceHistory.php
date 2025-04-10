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
}
