<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cart extends Component
{
    public $data;
    public function mount() {
        $this->data = \App\Models\Cart::where('user_id', '=', Auth::id())->get();
    }
    public function render()
    {
        
        return view('livewire.components.cart', ['data' => $this->data]);
    }
}
