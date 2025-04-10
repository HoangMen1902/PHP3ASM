<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Chair extends Model
{
    use HasFactory;
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
