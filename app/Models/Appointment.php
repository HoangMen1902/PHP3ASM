<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    protected $table = 'appointments';
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'date',
        'time',
        'branch_id',
        'chair_id',
        'user_id',
        'status'
    ];
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function chair()
    {
        return $this->belongsTo(Chair::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'appointment_services')->withTimestamps();
    }
    
}
