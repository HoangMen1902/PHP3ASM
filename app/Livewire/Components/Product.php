<?php

namespace App\Livewire\Components;

use App\Models\Category;
use App\Models\Product as ModelsProduct;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Product extends Component
{
    public $search = '';
    public $data;
    public $categories;
    public function searchProduct()
    {
        $this->data = ModelsProduct::select(
            'products.*',
            DB::raw('(SELECT MIN(price) FROM product_skus WHERE product_skus.product_id = products.id) AS min_price'),
            DB::raw('(SELECT MAX(price) FROM product_skus WHERE product_skus.product_id = products.id) AS max_price')
        )
            ->where('name', 'like', '%' . $this->search . '%')
            ->get();

        $this->categories = Category::select(
            'categories.*',
            DB::raw('(SELECT COUNT(*) FROM products WHERE products.category_id = categories.id) AS count_products')
        )->get();
    }
    public function render()
    {
        
        $products = $this->data ?? ModelsProduct::select(
            'products.*',
            DB::raw('(SELECT MIN(price) FROM product_skus WHERE product_skus.product_id = products.id) AS min_price'),
            DB::raw('(SELECT MAX(price) FROM product_skus WHERE product_skus.product_id = products.id) AS max_price')
        )->get();

        $categories = $this->categories ?? Category::select(
            'categories.*',
            DB::raw('(SELECT COUNT(*) FROM products WHERE products.category_id = categories.id) AS count_products')
        )->get();
        $this->data = $products;
        $this->categories = $categories;
        return view('livewire.components.product', [
            'data' => $products,
            'categories' => $categories
        ]);
    }
}
