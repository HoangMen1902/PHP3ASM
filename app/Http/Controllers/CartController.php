<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return view('pages/cart');
    }

    public function cartInsert(Request $request)
    {
        $userId = Auth::id();
        $existedCart = Cart::where('user_id', '=', $userId)
            ->where('sku_id', '=', $request->input('variant'))
            ->first();
        if($existedCart) {
            $existedCart->quantity += $request->input('quantity');
            $existedCart->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'sku_id' => $request->input('variant'),
                'quantity' => $request->input('quantity')
            ]);
        }
        return redirect('/cart');
    }
}
