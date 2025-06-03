<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required'
        ]);
        
        $cart = session()->get('cart');
        $total = 0;
        
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $total,
            'shipping_address' => $request->shipping_address
        ]);
        
        foreach($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);
        }
        
        session()->forget('cart');
        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}

