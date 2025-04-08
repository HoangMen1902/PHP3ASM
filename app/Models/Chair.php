<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chair extends Model
{
    protected $table = 'chairs';
    protected $fillable = [
        'name',
        'status',
        'branch_id'
    ];
    
    public function branch() {
        return $this->belongsTo(Branch::class);
    }
}
