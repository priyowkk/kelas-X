<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckoutMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('cart') || count(session('cart')) == 0) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }
        
        return $next($request);
    }
}