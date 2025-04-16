<?php

namespace App\Livewire\Components;

use App\Models\Cart;
use App\Models\CheckoutAddress;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On;


class Checkout extends Component
{
    public $data;
    public $user;
    public $address;
    public $address_username;
    public $phone;
    public $province_name;
    public $district_name;
    public $ward_name;
    public function mount()
    {
        $this->user = User::find(auth::id());
        $this->data = Cart::where('user_id', '=', Auth::id())->get();
    }

    #[On('changedAddress')]
    public function updateAddress($id)
    {
        if (!is_int($id) && !is_numeric($id)) {
            $this->dispatch('contentUpdated');

            return;
        }
        $queryAddress = CheckoutAddress::find($id);
        if ($queryAddress->user_id === auth::id()) {
            $this->address = $queryAddress->address;
            $this->address_username = $queryAddress->username_address;
            $this->phone = $queryAddress->phone;
            $this->province_name = $queryAddress->province_name;
            $this->district_name = $queryAddress->district_name;
            $this->ward_name = $queryAddress->ward_name;
            $this->dispatch('contentUpdated');
        } else {
            abort(403);
        }
    }
    public function render()
    {
        return view('livewire.components.checkout');
    }
}
