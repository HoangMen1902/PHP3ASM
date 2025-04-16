<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentHistory;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('pages/checkout');
    }

    public function checkout(CheckoutRequest $request)
    {
        $validated = $request->validated();
        if ($request->input('payment-method') === 'international') {
            $StripeService = new StripeService;
            $paymentSession = $StripeService->createCheckoutSession();
            $checkoutData = [
                'address' => $request->input('Address'),
                'province_name' => $request->input('province_name'),
                'district_name' => $request->input('district_name'),
                'ward_name' => $request->input('ward_name'),
            ];
            session(['checkout_data' => $checkoutData]);
            return redirect()->away($paymentSession->url);
        } elseif ($request->input('payment-method') === 'cash') {
            $this->processOrder($request);
            return redirect('/thanks-page');
        } else {
            return redirect()->back()->with(['error' => 'Phương thức thanh toán không hợp lệ.']);
        }
    }

    public function processOrder($request)
    {
        $cartData = Cart::where('user_id', '=', Auth::id())->with('productSku')->get();
        $totalPrice = $cartData->sum(function ($cart) {
            return $cart->productSku->price * $cart->quantity;
        });


        $address = $request['address'] ?? $request->input('Address');
        $provinceName = $request['province_name'] ?? $request->input('province_name');
        $districtName = $request['district_name'] ?? $request->input('district_name');
        $wardName = $request['ward_name'] ?? $request->input('ward_name');

        $order = Order::create([
            'user_id' => Auth::id(),
            'address' => $address . ', ' . $wardName . ', ' . $districtName . ', ' . $provinceName,
            'total_price' => $totalPrice,
            'status' => 1,
        ]);
        foreach ($cartData as $cart) {
            OrderDetail::create([
                'order_id' => $order->id,
                'sku_id' => $cart->sku_id,
                'price' => $cart->productSku->price,
                'quantity' => $cart->quantity
            ]);
        }
        $cartData->each->delete();
        return $order;
    }

    public function internationalCompleted($checkout_id)
    {

        $stripe = $checkout_id;
        $session = session('checkout_data');
        $order = $this->processOrder($session);
        PaymentHistory::create([
            'payment_id' => $stripe,
            'order_id' => $order->id
        ]);
        session()->forget('checkout_data');
        return redirect('/thanks-page');
    }

    public function internationalCancel()
    {
        session()->forget('checkout_data');
        return redirect('/checkout')->with('error', 'Thanh toán không thành công');
    }
}
