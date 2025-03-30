<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkuValue extends Model
{
    protected $table = 'sku_values';
    protected $fillable = ['id', 'sku_id', 'option_id', 'value_id'];
    
    public function productSku() {
        return $this->belongsTo(ProductSku::class, 'sku_id');
    }

    public function option() {
        return $this->belongsTo(Option::class);
    }

    public function optionValue() {
        return $this->belongsTo(OptionValue::class);
    }
}
