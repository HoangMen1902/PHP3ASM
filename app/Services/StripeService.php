<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\Refund;
use Stripe\Stripe;

class StripeService
{
    /**
     * Phương thức này sẽ tạo ra một session cho người dùng checkout
     * Xem docs tại đây https://docs.stripe.com/api/checkout/sessions/create
     * @return session
     */
    public function createCheckoutSession()
    {
        $lineItems = $this->formatItem();
        $session = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => $_ENV['APP_URL'] . "/international-success/{CHECKOUT_SESSION_ID}",
            'cancel_url' => $_ENV['APP_URL'] . '/international-cancel',
        ]);
        return $session;
    }

    public static function handleRefund(int $order_id): bool|Refund {
        $paymentHistory = PaymentHistory::where('payment_histories.order_id', '=', $order_id)
        ->join('orders', 'orders.id', '=', 'payment_histories.order_id')
        ->where('orders.status', '=', 3)  
        ->select('payment_histories.payment_id')  
        ->first();

        if($paymentHistory) {
            return Refund::create([
                'charge' => $paymentHistory->payment_id
            ]); 
        } 
        return false;
    }

    public static function getChargeId(string $checkoutId): mixed {
        $session = Session::retrieve($checkoutId);
        $paymentIntentId = $session->payment_intent;


        $findIntent = PaymentIntent::retrieve($paymentIntentId);
        return $findIntent->latest_charge;
    }

    /**
     * Hàm này sẽ điều chỉnh cấu trúc dữ liệu gửi lên stripe
     * @return array
     */
    public function formatItem(): array
    {
        $userId = Auth::id();
        $cartData = Cart::where('user_id', $userId)->get();


        $lineItems = $cartData->map(function ($item): array {
            return [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->productSku->product->name,
                        'description' => $item->productSku->sku,
                    ],
                    'unit_amount' => $item->productSku->price*100,
                ],
                'quantity' => $item->quantity
            ];
        })->toArray();
        return $lineItems;
    }
}
