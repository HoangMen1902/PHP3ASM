<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductSku;
use Illuminate\Support\Facades\Log;


class ProductDetail extends Component
{
    public $id;
    public $price;

    public $data;

    public function mount($id)
    {
        $this->id = $id;
        $this->data = Product::find($this->id);
        $this->price = $this->data->productSkus()->min('price');
    }

    public function updatePrice($sku)
    {
        $productSku = ProductSku::find($sku);
        if ($productSku) {
            $this->price = $productSku->price;
        } else {
            $this->price = 0;
        }
        $this->dispatch('updatedPrice');
    }
    public function render()
    {
        return view('livewire.components.product-detail', ['data' => $this->data, 'price' => $this->price]);
    }
}
