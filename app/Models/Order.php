<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'total_price', 'user_id', 'address', 'address_username', 'address_phone'];

    protected $table = 'orders';

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
