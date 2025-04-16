<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stripe\Stripe;

class StripeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Stripe::setApiKey(env('STRIPE_API_SECRET'));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
