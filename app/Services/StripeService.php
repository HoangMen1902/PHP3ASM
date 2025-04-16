<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
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
                    'unit_amount' => $item->productSku->price*10,
                ],
                'quantity' => $item->quantity
            ];
        })->toArray();
        return $lineItems;
    }
}
