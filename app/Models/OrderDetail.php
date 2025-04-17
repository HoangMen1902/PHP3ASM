<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id', 'sku_id', 'price', 'quantity'];
    protected $table = 'order_details';



       // Lấy thông tin SKU
       public function sku()
       {
           return $this->belongsTo(ProductSku::class, 'sku_id');
       }
   
       // Lấy thông tin đơn hàng
       public function order()
       {
           return $this->belongsTo(Order::class);
       }
}
