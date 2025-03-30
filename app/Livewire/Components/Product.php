<?php

namespace App\Livewire\Components;

use App\Models\Category;
use App\Models\Product as ModelsProduct;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Product extends Component
{

    public function render()
    {
        $products = ModelsProduct::select('products.*', DB::raw('(SELECT MIN(price) FROM product_skus WHERE product_skus.product_id = products.id) AS min_price'), DB::raw('(SELECT MAX(price) FROM product_skus WHERE product_skus.product_id = products.id) AS max_price'))->get();
        $categories = Category::select('categories.*',  DB::raw('(SELECT COUNT(*) FROM products WHERE products.category_id = categories.id) AS count_products'))->get();
        return view('livewire.components.product', ['data' => $products, 'categories' => $categories]);
    }
}
