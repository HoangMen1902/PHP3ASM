<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutAddress extends Model
{
    protected $fillable = ['user_id', 'address', 'username_address', 'province_name', 'district_name', 'ward_name','phone', 'province_id', 'district_id', 'ward_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
