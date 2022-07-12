<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function success(Request $request){
        $total = 0;
        foreach (session('cart') as $item){
            $total += $item['price'] * $item['quantity'];
        }
        $order = Order::create([
            'user_id' => auth()->user()->getAuthIdentifier(),
            'num_items' => count(session('cart')),
            'total' => $total
        ]);
        foreach (session('cart') as $item){
            Cart::create([
                'order_id' => $order->id,
                'menu_id' => $item['mid'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        $request->session()->forget('cart');

        return view('order.thank-you');
    }


    public function checkout(){
        return view('order.checkout');
    }
}
