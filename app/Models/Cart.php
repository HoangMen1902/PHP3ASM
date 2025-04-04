<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = ['quantity', 'user_id', 'sku_id'];

    public function productSku() {
        return $this->belongsTo(ProductSku::class, 'sku_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
