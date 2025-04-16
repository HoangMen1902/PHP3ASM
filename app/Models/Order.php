<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['status', 'total_price', 'user_id', 'address'];

    protected $table = 'orders';

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }
}
