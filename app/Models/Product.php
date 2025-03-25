<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'total_quantity', 'thumbnail', 'short_description', 'status', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function productSkus() {
        return $this->hasMany(ProductSku::class);
    }
    public function optionValues() {
        return $this->hasMany(OptionValue::class);
    }
    
}
