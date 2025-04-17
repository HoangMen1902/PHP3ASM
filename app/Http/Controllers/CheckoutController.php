<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentHistory;
use App\Models\ProductSku;
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
                'username' => $request->input('username'),
                'phone' => $request->input('phone')
            ];
            session(['checkout_data' => $checkoutData]);
            return redirect()->away($paymentSession->url);
        } elseif ($request->input('payment-method') === 'cash') {
            $this->processOrder($request);
            return redirect('/profile/order');
        } else {
            return redirect()->back()->with(['error' => 'Phương thức thanh toán không hợp lệ.']);
        }
    }

    public function processOrder($request, $payment_method = 'cash')
    {
        $cartData = Cart::where('user_id', '=', Auth::id())->with('productSku')->get();
        $totalPrice = 0;

        foreach($cartData as $data) {
            $totalPrice += $data->quantity * $data->productSku->price;
        }

        $username = $request['username'] ?? $request->input('username');
        $phone = $request['phone'] ?? $request->input('phone');
        $address = $request['address'] ?? $request->input('Address');
        $provinceName = $request['province_name'] ?? $request->input('province_name');
        $districtName = $request['district_name'] ?? $request->input('district_name');
        $wardName = $request['ward_name'] ?? $request->input('ward_name');

        $order = Order::create([
            'user_id' => Auth::id(),
            'address' => $address . ', ' . $wardName . ', ' . $districtName . ', ' . $provinceName,
            'total_price' => $totalPrice,
            'address_username' => $username,
            'address_phone' => $phone,
            'status' => $payment_method === 'cash' ? 1 : 2,

        ]);
        foreach ($cartData as $cart) {
            OrderDetail::create([
                'order_id' => $order->id,
                'sku_id' => $cart->sku_id,
                'price' => $cart->productSku->price,
                'quantity' => $cart->quantity
            ]);
            ProductSku::where('id', $cart->sku_id)
                ->decrement('quantity', $cart->quantity);
        }
        $cartData->each->delete();

        return $order;
    }

    public function internationalCompleted($checkout_id)
    {

        $session = session('checkout_data');
        $order = $this->processOrder($session, 'international');
        $charge_id = StripeService::getChargeId($checkout_id);
        PaymentHistory::create([
            'payment_id' => $charge_id,
            'order_id' => $order->id
        ]);
        session()->forget('checkout_data');
        return redirect('/profile/order');
    }

    public function internationalCancel()
    {
        session()->forget('checkout_data');
        return redirect('/checkout')->with('error', 'Thanh toán không thành công');
    }
}
