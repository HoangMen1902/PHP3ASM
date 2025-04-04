<?php

namespace App\Http\Middleware;

use App\Models\ProductSku;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sku = ProductSku::find($request->input('variant'));
        if (!$sku) {
            return redirect()->back()->with('error', 'Sản phẩm không hợp lệ');
        }
        if ($request->input('quantity') > $sku->quantity) {
            return redirect()->back()->with('error', 'Quá số lượng kho hiện có');
        }
        return $next($request);
    }
}
